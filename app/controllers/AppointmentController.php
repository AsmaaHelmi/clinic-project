<?php
namespace App\Controllers;

use App\Core\Helper;
use App\Models\Appointment;
use App\Core\Validator;
$validator = new Validator();

if (Helper::checkRequestMethod()) {
    if (

        ! Helper::checkPostInput('doctor_id') ||

        ! Helper::checkPostInput('phone') ||

        ! Helper::checkPostInput('appointment_date') ||

        ! Helper::checkPostInput('appointment_time')

    ) {
        Helper::setMessage('danger','All fields are required');
        Helper::redirect('?page=book-appointment');
    }
var_dump($_SESSION);
die();
    $patientId = $_SESSION['user']['id'];

    $doctorId = (int) $_POST['doctor_id'];

    $phone = trim($_POST['phone']);

    $appointmentDate = trim($_POST['appointment_date']);

    $appointmentTime = trim($_POST['appointment_time']);


    $validator->required($phone, 'phone');
    if (!empty($validator->getErrors())) {
        Helper::setMessage('danger','Phone is required' );
        Helper::redirect('?page=book-appointment');
        exit;
    }

    if ($appointmentDate < date('Y-m-d')) {
        Helper::setMessage(
            'error',
            'Invalid appointment date'
        );
        Helper::redirect('?page=book-appointment');
        exit;

    }

    $appointment = new Appointment($patientId, $doctorId, $phone, $appointmentDate, $appointmentTime);

    if ($appointment->isBooked($pdo)) {
        Helper::setMessage('danger', 'Selected time is no longer available');
        Helper::redirect('?page=book-appointment');
        exit;
    }
    
    $result = $appointment->create($pdo);

    if ($result) {

        Helper::setMessage('success','Appointment booked successfully');

    } else {

        Helper::setMessage('danger', 'Something went wrong');

    }

    Helper::redirect('?page=book-appointment');
    exit;

}
