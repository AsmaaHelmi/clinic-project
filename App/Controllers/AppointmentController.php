<?php
namespace App\Controllers;

use App\Core\Helper;
use App\Models\Appointment;
use App\Core\Validator;
$validator = new Validator();

$action = $_GET['action'] ?? $_POST['action'] ?? null;

if ($action) {

    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'doctor') {
        Helper::redirect('?page=login');
        exit();
    }

    $appointmentId = (int) ($_GET['id'] ?? 0);

    if ($appointmentId <= 0) {
        Helper::setMessage('danger', 'Invalid appointment ID');
        Helper::redirect('?page=doctor-dashboard');
        exit();
    }

    switch ($action) {

        case 'confirm':
            
            $sql = "UPDATE appointments SET status = 'confirmed' WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$appointmentId]);
            Helper::setMessage('success', 'Appointment confirmed successfully');
            break;

        case 'cancel':
            
            $sql = "UPDATE appointments SET status = 'cancelled' WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$appointmentId]);
            Helper::setMessage('success', 'Appointment cancelled successfully');
            break;

        case 'delete':
            
            $sql = "DELETE FROM appointments WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$appointmentId]);
            Helper::setMessage('success', 'Appointment deleted successfully');
            break;

        default:
            Helper::setMessage('danger', 'Invalid action');
            break;
    }

    Helper::redirect('?page=doctor-dashboard');
    exit();
}


if (Helper::checkRequestMethod()) {
    $doctorId = (int) $_POST['doctor_id'];
    if (

        ! Helper::checkPostInput('doctor_id') ||

        ! Helper::checkPostInput('phone') ||

        ! Helper::checkPostInput('appointment_date') ||

        ! Helper::checkPostInput('appointment_time')

    ) {
        Helper::setMessage('danger','All fields are required');
        Helper::redirect('?page=book-appointment&id=' . $doctorId);
    }

    $patientId = $_SESSION['user']['id'];

    $phone = trim($_POST['phone']);

    $appointmentDate = trim($_POST['appointment_date']);

    $appointmentTime = trim($_POST['appointment_time']);


    $validator->required($phone, 'phone');
    if (!empty($validator->getErrors())) {
        Helper::setMessage('danger','Phone is required' );
        Helper::redirect('?page=book-appointment&id=' . $doctorId);
        exit;
    }

    if ($appointmentDate < date('Y-m-d')) {
        Helper::setMessage(
            'error',
            'Invalid appointment date'
        );
        Helper::redirect('?page=book-appointment&id=' . $doctorId);
        exit;

    }

    $appointment = new Appointment($patientId, $doctorId, $phone, $appointmentDate, $appointmentTime);

    if ($appointment->isBooked($pdo)) {
        Helper::setMessage('danger', 'Selected time is no longer available');
        Helper::redirect('?page=book-appointment&id=' . $doctorId);
        exit;
    }
    
    $result = $appointment->create($pdo);

    if ($result) {

        Helper::setMessage('success','Appointment booked successfully');

    } else {

        Helper::setMessage('danger', 'Something went wrong');

    }

    Helper::redirect('?page=book-appointment&id=' . $doctorId);;
    exit;

}
