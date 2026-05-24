<?php
session_start();
require_once '../../models/User.php';

$error = '';
$user  = new User();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    $result = $user->login($email, $password);

    if ($result) {
        $_SESSION['user_id']   = $result['id'];
        $_SESSION['user_name'] = $result['full_name'];
        $_SESSION['role']      = $result['role'];

        if ($result['role'] === 'admin') {
            header("Location: ../../views/admin/dashboard.php");
        } else {
            header("Location: ../patient/patient-dashboard.php");
        }
        exit;
    } else {
        $error = "Invalid email or password";
    }
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
    <link rel="stylesheet" href="../../../public/assets/styles/pages/main.css">
    <title>Login - VCare</title>
</head>
<body>
    <div class="page-wrapper">
        <nav class="navbar navbar-expand-lg bg-blue sticky-top">
            <div class="container">
                <a class="fw-bold text-white m-0 text-decoration-none h3" href="../../../index.php">VCare</a>
                <button class="navbar-toggler btn-outline-light border-0 shadow-none" type="button"
                    data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                    <div class="d-flex gap-3 flex-wrap justify-content-center" role="group">
                        <a class="btn btn-outline-light" href="../../../index.php">Home</a>
                        <a class="btn btn-outline-light" href="login.php">Login</a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container">
            <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="fw-bold my-4 h4">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a class="text-decoration-none" href="../../../index.php">Home</a></li>
                    <li class="breadcrumb-item active">Login</li>
                </ol>
            </nav>

            <div class="d-flex flex-column gap-3 account-form mx-auto mt-5">
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
                    <?php unset($_SESSION['success']); ?>
                <?php endif; ?>

                <form class="form" method="POST" action="login.php">
                    <div class="mb-3">
                        <label class="form-label required-label" for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label required-label" for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>

                <div class="d-flex justify-content-center gap-2">
                    <span>Don't have an account?</span>
                    <a class="link" href="register.php">Create account</a>
                </div>
            </div>
        </div>
    </div>

    <footer class="container-fluid bg-blue text-white py-3">
        <div class="row gap-2">
            <div class="col-sm">
                <h5>Links</h5>
                <div class="links d-flex gap-2 flex-wrap">
                    <a href="../../../index.php" class="link text-white">Home</a>
                    <a href="login.php" class="link text-white">Login</a>
                    <a href="register.php" class="link text-white">Register</a>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.1/js/bootstrap.min.js"
        integrity="sha512-fHY2UiQlipUq0dEabSM4s+phmn+bcxSYzXP4vAXItBvBHU7zAM/mkhCZjtBEIJexhOMzZbgFlPLuErlJF2b+0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>