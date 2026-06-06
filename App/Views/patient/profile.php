<?php

use App\core\Helper;

$user = $_SESSION['user'];

$sql = "SELECT a.*, u.name AS doctor_name, m.title AS major_title
        FROM appointments a
        JOIN doctors d ON a.doctor_id = d.id
        JOIN users u ON d.user_id = u.id
        JOIN majors m ON d.major_id = m.id
        WHERE a.patient_id = ?
        ORDER BY a.appointment_date DESC, a.appointment_time DESC";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user['id']]);
$appointments = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
                disabled>

        </div>

        <div class="mb-3">

            <label class="form-label fw-bold">
                Email
            </label>

            <input
                type="email"
                class="form-control"
                value="<?= $user['email']; ?>"
                disabled>

        </div>

    </div>

    <!-- APPOINTMENTS -->

    <h2 class=" mb-4">
        My Appointments
    </h2>
    <?php Helper::showMessage(); ?>
    <?php if (empty($appointments)): ?>

        <div class="alert alert-info text-center">

            No appointments found.

        </div>

    <?php else: ?>

        <div class="d-flex flex-column gap-4">

            <?php foreach ($appointments as $appointment): ?>



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

                        <?php if ($appointment['status'] == 'pending'): ?>

                            <span class="badge bg-warning text-dark">
                                Pending
                            </span>

                        <?php elseif ($appointment['status'] == 'confirmed'): ?>

                            <span class="badge bg-success">
                                Confirmed
                            </span>

                        <?php elseif ($appointment['status'] == 'cancelled'): ?>

                            <span class="badge bg-danger">
                                Cancelled
                            </span>

                        <?php endif; ?>

                    </p>

                    <?php if ($appointment['status'] == 'pending'): ?>

                        <a
                            href="?page=cancel-appointment&id=<?= $appointment['id']; ?>"
                            class="btn btn-danger"
                            onclick="return confirm('Are you sure you want to cancel this appointment?');">
                            Cancel
                        </a>

                    <?php endif; ?>

                </div>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>