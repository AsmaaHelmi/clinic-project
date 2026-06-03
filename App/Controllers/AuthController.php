<?php

use App\Models\User;
use App\Core\Helper;

$userModel = new User();

$email = $_POST['email'];
$password = $_POST['password'];

$user = $userModel->findByEmail($email);

if ($user && password_verify($password, $user['password'])) {

    $_SESSION['user_id'] = $user['id'];
    $_SESSION['user_role'] = $user['role'];

    if ($user['role'] == 'doctor') {

        $doctor = $userModel->getDoctorIdByUserId($user['id']);

        if ($doctor) {

            
            $_SESSION['doctor_id'] = $doctor['id'];
            } else {
    die("Doctor record not found for this user");
}

        header("Location: index.php?page=doctor-dashboard");
        exit();
    }

    if ($user['role'] == 'admin') {
        header("Location: index.php?page=dashboard");
        exit();
    }

    header("Location: index.php?page=home");
    exit();

} else {
    echo "Invalid login";
}