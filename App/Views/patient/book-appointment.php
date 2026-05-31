<?php

use App\Models\Appointment;
use App\Core\Helper;

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'patient') {
    Helper::redirect("index.php?page=login");
}

global $pdo;


$stmt = $pdo->prepare("
    SELECT doctors.id, users.name 
    FROM doctors 
    JOIN users ON doctors.user_id = users.id
");
$stmt->execute();
$doctors = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (Helper::checkRequestMethod()) {
    $sessionUserId = (int)$_SESSION['user']['id'];
    $formDoctorId = (int)$_POST['doctor_id']; 
    $phone = trim($_POST['phone']);
    $date = $_POST['appointment_date'];
    $time = $_POST['appointment_time'];

    if (!empty($formDoctorId) && !empty($phone) && !empty($date) && !empty($time)) {
        
        $stmtPatient = $pdo->prepare("SELECT id FROM patients WHERE user_id = ?");
        $stmtPatient->execute([$sessionUserId]);
        $patientData = $stmtPatient->fetch(PDO::FETCH_ASSOC);

        $doctorData = ['id' => $formDoctorId];

        if ($patientData && $doctorData) {
            $patientId = (int)$patientData['id'];
            $doctorId = (int)$doctorData['id'];

            $appointmentModel = new Appointment($patientId, $doctorId, $phone, $date, $time);
            
            if ($appointmentModel->isBooked($pdo)) {
                Helper::setMessage('danger', 'This appointment time is already booked by another patient.');
            } else {
                if ($appointmentModel->create($pdo)) {
                    Helper::setMessage('success', 'Appointment booked successfully as pending!');
                } else {
                    Helper::setMessage('danger', 'An error occurred while booking.');
                }
            }
        } else {
            Helper::setMessage('danger', 'Profile error: Patient or Doctor records not found.');
        }
    } else {
        Helper::setMessage('danger', 'All fields are required.');
    }
}
?>

<div class="container">
    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
        <ol class="breadcrumb justify-content-center">
            <li class="breadcrumb-item"><a class="text-decoration-none" href="index.php?page=patient-dashboard">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Book Appointment</li>
        </ol>
    </nav>
    <div class="d-flex flex-column gap-3 account-form mx-auto mt-5" style="max-width: 500px;">
        <form class="form" method="POST" action="index.php?page=book-appointment">
            <div class="form-items">
                <?php if (isset($_SESSION['message'])): ?>
                    <div class="alert alert-<?php echo $_SESSION['message']['type']; ?> py-2">
                        <?php Helper::showMessage(); ?>
                    </div>
                <?php endif; ?>
                <div class="mb-3">
                    <label class="form-label" for="doctor">Choose Doctor</label>
                    <select name="doctor_id" class="form-select" id="doctor" required>
                        <option value="">Select a doctor...</option>
                        <?php foreach ($doctors as $doctor): ?>
                            <option value="<?php echo $doctor['id']; ?>">Dr. <?php echo htmlspecialchars($doctor['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="phone">Phone Number</label>
                    <input type="text" name="phone" class="form-control" id="phone" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="date">Appointment Date</label>
                    <input type="date" name="appointment_date" class="form-control" id="date" required>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="time">Appointment Time</label>
                    <input type="time" name="appointment_time" class="form-control" id="time" required>
                </div>
            </div>
            <button type="submit" class="btn btn-primary w-100">Confirm Booking</button>
        </form>
    </div>
</div>