<?php

use App\Models\Appointment;

$appointments = $pdo->query("
    SELECT
        appointments.*,
        patient.name AS patient_name,
        doctor_user.name AS doctor_name
    FROM appointments

    JOIN users AS patient
    ON appointments.patient_id = patient.id

    JOIN doctors
    ON appointments.doctor_id = doctors.id

    JOIN users AS doctor_user
    ON doctors.user_id = doctor_user.id

    ORDER BY appointments.appointment_date DESC
")->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="content-wrapper">

    <section class="content-header">

        <div class="container-fluid">

            <div class="row mb-2">

                <div class="col-sm-6">

                    <h1>Appointments</h1>

                </div>

            </div>

        </div>

    </section>

    <section class="content">

        <div class="container-fluid">

            <div class="card">

                <div class="card-header">

                    <h3 class="card-title">

                        Appointments List

                    </h3>

                </div>

                <div class="card-body">

                    <table class="table table-bordered table-striped">

                        <thead>

                            <tr>

                                <th>ID</th>

                                <th>Patient</th>

                                <th>Doctor</th>

                                <th>Phone</th>

                                <th>Date</th>

                                <th>Status</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php foreach($appointments as $appointment): ?>

                                <tr>

                                    <td>
                                        <?= $appointment['id'] ?>
                                    </td>

                                    <td>
                                        <?= $appointment['patient_name'] ?>
                                    </td>

                                    <td>
                                        <?= $appointment['doctor_name'] ?>
                                    </td>

                                    <td>
                                        <?= $appointment['phone'] ?>
                                    </td>

                                    <td>
                                        <?= $appointment['appointment_date'] ?>
                                    </td>

                                    <td>
                                        <?= $appointment['status'] ?>
                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </section>

</div>

