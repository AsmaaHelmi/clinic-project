<?php
session_start();
require_once '../../models/Patient.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'patient') {
    header("Location: ../auth/login.php");
    exit;
}

$patient = new Patient();
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $full_name = trim($_POST['full_name']);
    $phone     = trim($_POST['phone']);

    if (empty($full_name) || empty($phone)) {
        $message = '<div class="alert alert-danger" id="alertMessage">برجاء عدم ترك الاسم أو رقم الهاتف فارغاً!</div>';
    } else {
        if ($patient->updateProfile($_SESSION['user_id'], $full_name, $phone)) {
            $_SESSION['user_name'] = $full_name;
            $message = '<div class="alert alert-success" id="alertMessage">تم تحديث البيانات بنجاح!</div>';
        } else {
            $message = '<div class="alert alert-danger" id="alertMessage">حدث خطأ أثناء التحديث، يرجى المحاولة مرة أخرى.</div>';
        }
    }
}

$data      = $patient->getProfile($_SESSION['user_id']);
$myDoctors = $patient->getMyDoctors($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/css/bootstrap.min.css"
        integrity="sha512-Z/def5z5u2aR89OuzYcxmDJ0Bnd5V1cKqBEbvLOiUNWdg9PQeXVvXLI90SE4QOHGlfLqUnDNVAYyZi8UwUTmWQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="../public/assets/styles/pages/main.css">
    <title>My Profile - VCare</title>
</head>
<body>
    <div class="page-wrapper">

        <!-- NAVBAR -->
        <nav class="navbar navbar-expand-lg bg-blue sticky-top">
            <div class="container">
                <!-- Logo / Home -->
                <a class="fw-bold text-white m-0 text-decoration-none h3" href="../index.php">VCare</a>

                <button class="navbar-toggler btn-outline-light border-0 shadow-none" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarContent"
                    aria-controls="navbarContent" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
                    <div class="d-flex gap-3 flex-wrap justify-content-center align-items-center">
                        <!-- Home -->
                        <a href="../index.php" class="btn btn-outline-light">🏠 Home</a>
                        <!-- Dashboard -->
                        <a href="patient-dashboard.php" class="btn btn-outline-light">📋 Dashboard</a>
                        <!-- Username -->
                        <span class="text-white fw-bold">
                            👤 <?= htmlspecialchars($_SESSION['user_name']) ?>
                        </span>
                        <!-- Logout -->
                        <a href="../auth/logout.php" class="btn btn-danger">🚪 Logout</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- CONTENT -->
        <div class="container my-5">
            <div class="row">
                <!-- Profile Form -->
                <div class="col-md-5 mb-4">
                    <h2 class="mb-4">My Profile</h2>

                    <?= $message ?>

                    <div class="card shadow-sm p-4">
                        <form action="profile.php" method="POST" id="profileForm">
                            <div class="mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" name="full_name" id="fullNameInput"
                                    class="form-control"
                                    value="<?= htmlspecialchars($data['full_name'] ?? '') ?>"
                                    readonly disabled required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Email</label>
                                <input type="email" class="form-control bg-light"
                                    value="<?= htmlspecialchars($data['email'] ?? '') ?>"
                                    readonly disabled>
                            </div>
                            <div class="mb-3">
                                <label class="form-label fw-bold">Phone</label>
                                <input type="text" name="phone" id="phoneInput"
                                    class="form-control"
                                    value="<?= htmlspecialchars($data['phone'] ?? '') ?>"
                                    readonly disabled required>
                            </div>

                            <button type="button" id="editBtn" class="btn btn-primary w-100 mt-2">
                                ✏️ Edit Profile
                            </button>
                            <button type="submit" name="update_profile" id="saveBtn"
                                class="btn btn-success w-100 mt-2 d-none" disabled>
                                💾 Save Changes
                            </button>
                            <a href="patient-dashboard.php" class="btn btn-outline-secondary w-100 mt-2">
                                ← Back to Dashboard
                            </a>
                        </form>
                    </div>
                </div>

                <!-- My Doctors -->
                <div class="col-md-7">
                    <h2 class="mb-4">My Doctors</h2>
                    <div class="card shadow-sm p-4">
                        <?php if (!empty($myDoctors)): ?>
                            <div class="table-responsive">
                                <table class="table table-hover align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Doctor Name</th>
                                            <th>Specialization</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($myDoctors as $doc): ?>
                                            <tr>
                                                <td class="fw-bold">Dr. <?= htmlspecialchars($doc['doctor_name']) ?></td>
                                                <td>
                                                    <span class="badge bg-info text-dark">
                                                        <?= htmlspecialchars($doc['specialization']) ?>
                                                    </span>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <p class="text-muted m-0">You haven't booked any appointments yet.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <footer class="container-fluid bg-blue text-white py-3 mt-5">
        <div class="row gap-2">
            <div class="col-sm">
                <h5>VCare</h5>
                <p class="mb-0">Your health is our priority.</p>
            </div>
            <div class="col-sm">
                <h5>Links</h5>
                <div class="links d-flex gap-2 flex-wrap">
                    <a href="../index.php" class="link text-white">Home</a>
                    <a href="patient-dashboard.php" class="link text-white">Dashboard</a>
                    <a href="../auth/logout.php" class="link text-white">Logout</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.min.js"
        integrity="sha512-fHY2UiQlipUq0dEabSM4s+phmn+bcxSYzXP4vAXItBvBHU7zAM/mkhCZjtBEIJexhOMzZbgFlPLuErlJF2b+0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        document.getElementById('editBtn').addEventListener('click', function () {
            const nameInput  = document.getElementById('fullNameInput');
            const phoneInput = document.getElementById('phoneInput');

            nameInput.removeAttribute('readonly');
            nameInput.removeAttribute('disabled');
            phoneInput.removeAttribute('readonly');
            phoneInput.removeAttribute('disabled');

            this.classList.add('d-none');

            const saveBtn = document.getElementById('saveBtn');
            saveBtn.classList.remove('d-none');
            saveBtn.removeAttribute('disabled');
        });

        document.getElementById('profileForm').addEventListener('submit', function (e) {
            const nameInput  = document.getElementById('fullNameInput').value.trim();
            const phoneInput = document.getElementById('phoneInput').value.trim();

            if (nameInput === '' || phoneInput === '') {
                e.preventDefault();
                alert('برجاء ملء الحقول المطلوبة وعدم تركها فارغة!');
            }
        });

        window.addEventListener('DOMContentLoaded', () => {
            const alertMsg = document.getElementById('alertMessage');
            if (alertMsg) {
                setTimeout(() => {
                    alertMsg.style.transition = "opacity 0.5s ease";
                    alertMsg.style.opacity    = "0";
                    setTimeout(() => alertMsg.remove(), 500);
                }, 3000);
            }
        });
    </script>
</body>
</html>