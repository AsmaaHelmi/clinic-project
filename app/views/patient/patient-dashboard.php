<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'patient') {
    header("Location:../auth/login.php");
    exit;
}
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
    <title>Patient Dashboard - VCare</title>
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
                        <!-- Profile -->
                        <a href="profile.php" class="btn btn-outline-light">
                            👤 <?= htmlspecialchars($_SESSION['user_name']) ?>
                        </a>
                        <!-- Logout -->
                        <a href="../auth/logout.php" class="btn btn-danger">🚪 Logout</a>
                    </div>
                </div>
            </div>
        </nav>

        <!-- CONTENT -->
        <div class="container my-5">
            <h2 class="mb-4">Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?>! 👋</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card text-center p-4 shadow-sm">
                        <div class="mb-3 fs-1">👤</div>
                        <h5>My Profile</h5>
                        <p class="text-muted">View and edit your information</p>
                        <a href="profile.php" class="btn btn-primary">Go</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center p-4 shadow-sm">
                        <div class="mb-3 fs-1">🩺</div>
                        <h5>Doctors</h5>
                        <p class="text-muted">Browse available doctors</p>
                        <a href="../views/doctors/index.php" class="btn btn-primary">Go</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-center p-4 shadow-sm">
                        <div class="mb-3 fs-1">🏥</div>
                        <h5>Majors</h5>
                        <p class="text-muted">Browse specializations</p>
                        <a href="../views/majors.php" class="btn btn-primary">Go</a>
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
                    <a href="profile.php" class="link text-white">Profile</a>
                    <a href="../auth/logout.php" class="link text-white">Logout</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.min.js"
        integrity="sha512-fHY2UiQlipUq0dEabSM4s+phmn+bcxSYzXP4vAXItBvBHU7zAM/mkhCZjtBEIJexhOMzZbgFlPLuErlJF2b+0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>