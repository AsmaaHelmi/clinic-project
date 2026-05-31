<?php

use App\core\Helper;
use App\Models\Appointment;


$user = $_SESSION['user'];

$appointments = Appointment::getPatientAppointments(
    $pdo,
    $user['id']
);

?>

<div class="container my-5">

    <h1 class=" mb-5">
        My Profile
    </h1>

    <!-- PROFILE CARD -->

    <div class="card p-4  mb-5" style="max-width: 600px;">

        <div class="mb-3">

            <label class="form-label fw-bold">
                Name
            </label>

            <input
                type="text"
                class="form-control"
                value="<?= $user['name']; ?>"
                disabled
            >

        </div>

        <div class="mb-3">

            <label class="form-label fw-bold">
                Email
            </label>

            <input
                type="email"
                class="form-control"
                value="<?= $user['email']; ?>"
                disabled
            >

        </div>

    </div>

    <!-- APPOINTMENTS -->

    <h2 class=" mb-4">
        My Appointments
    </h2>
    <?php Helper::showMessage(); ?>
    <?php if(empty($appointments)): ?>

        <div class="alert alert-info text-center">

            No appointments found.

        </div>

    <?php else: ?>

        <div class="d-flex flex-column gap-4">

            <?php foreach($appointments as $appointment): ?>

                

                    <div class="card p-3 h-100" style="max-width: 700px;">

                        <h4 class="mb-3">

                            Dr.
                            <?= $appointment['doctor_name']; ?>

                        </h4>

                        <p>

                            <strong>Major:</strong>

                            <?= $appointment['major_title']; ?>

                        </p>

                        <p>

                            <strong>Date:</strong>

                            <?= $appointment['appointment_date']; ?>

                        </p>

                        <p>

                            <strong>Time:</strong>

                            <?= $appointment['appointment_time']; ?>

                        </p>

                        <p>

                            <strong>Status:</strong>

                            <?= $appointment['status']; ?>

                        </p>

                      <?php if($appointment['status'] === 'pending'): ?>

                       <a
                            href="index.php?page=cancel-appointment&id=<?= $appointment['id']; ?>"
                            class="btn btn-danger mt-3 w-auto px-4 align-self-start"
                        >
                            Cancel Appointment
                        </a>

                    <?php endif; ?>

                    </div>

                

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</div>

