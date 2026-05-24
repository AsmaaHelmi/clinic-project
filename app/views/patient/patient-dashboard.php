<?php
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'patient') {
    header("Location: index.php?page=login");
    exit();
}

use app\models\Appointment;

$appointments = [];

if (isset($_SESSION['user_id'])) {
    $patientId = $_SESSION['user_id'];
    $appointmentModel = new Appointment();
    $appointments = $appointmentModel->getAppointmentsByPatient($patientId);
}
?>

<div class="container my-5">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body p-5 text-center">
            <h1 class="display-5 fw-bold text-primary mb-3">Welcome, <?php echo htmlspecialchars($_SESSION['user_name']); ?> 👋</h1>
            <p class="lead text-muted mb-4">You are now logged into your Patient Dashboard. Here you can manage your appointments and profile.</p>
            <div class="d-flex justify-content-center gap-3 flex-wrap">
                <a href="index.php?page=patient-profile" class="btn btn-outline-primary px-4 py-2 fw-bold">Edit Profile</a>
                <a href="index.php?page=logout" class="btn btn-danger px-4 py-2 fw-bold">Logout</a>
            </div>
        </div>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">
            <h4 class="fw-bold text-secondary mb-4">مواعيدي المحجوزة (My Appointments)</h4>
            
            <?php if (!empty($appointments)): ?>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>رقم الحجز</th>
                                <th>الطبيب</th>
                                <th>التاريخ</th>
                                <th>الوقت</th>
                                <th>الحالة</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($appointments as $app): ?>
                                <tr>
                                    <td>#<?php echo $app['id']; ?></td>
                                    <td><?php echo htmlspecialchars($app['doctor_name'] ?? 'غير محدد'); ?></td>
                                    <td><?php echo $app['appointment_date']; ?></td>
                                    <td><?php echo $app['appointment_time'] ?? '---'; ?></td>
                                    <td>
                                        <?php if (($app['status'] ?? '') === 'completed'): ?>
                                            <span class="badge bg-success">مكتمل</span>
                                        <?php elseif (($app['status'] ?? '') === 'pending'): ?>
                                            <span class="badge bg-warning text-dark">قيد الانتظار</span>
                                        <?php else: ?>
                                            <span class="badge bg-primary">مؤكد</span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info text-center py-4 border-0 mb-0">
                    <p class="mb-0 fw-bold">لا توجد لديكِ أي مواعيد محجوزة حالياً.</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>