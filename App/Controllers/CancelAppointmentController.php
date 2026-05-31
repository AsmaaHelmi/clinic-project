<?php

use App\Models\Appointment;
use App\Core\Helper;

if (!isset($_GET['id'])) {

    Helper::redirect('?page=patient-profile');

}

$appointmentId = (int) $_GET['id'];

$result = Appointment::cancel($pdo, $appointmentId);

if ($result) {

    Helper::setMessage(
        'success',
        'Appointment cancelled successfully'
    );

} else {

    Helper::setMessage(
        'danger',
        'Something went wrong'
    );

}

Helper::redirect('?page=patient-profile');