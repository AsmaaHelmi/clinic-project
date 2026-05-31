<?php

require_once __DIR__ . "/vendor/autoload.php";
session_start();

$host   = "localhost";
$dbName = "clinic_project";
$user   = "root";
$pass   = "";
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("database connection failed" . $e->getMessage());
}

$page       = $_GET['page'] ?? "home";
$isAdmin    = false;
$adminpages = [
    'admin-home',
    'create-major',
    'store-major',

];
if (in_array($page, $adminpages)) {
    $isAdmin = true;
}
if ($isAdmin) {
    include "App/Views/Admin/layouts/header.php";
    include "App/Views/Admin/layouts/nav.php";
    include "App/Views/Admin/layouts/sidebar.php";

    echo "<div class='admin-wrapper'>";
} else {
    include 'App/Views/layouts/header.php';
    include 'App/Views/layouts/nav.php';

}

switch ($page) {
    case "home":
        require "App/Views/home.php";
        break;
    case "major":
        require "App/Views/major.php";
        break;
    case "doctors":
        require "App/Views/doctors.php";
        break;
    case "admin-home":
        require "App/Views/Admin/dashboard.php";
        break;

    case "create-major":
        require "App/Views/Admin/major/create-major.php";
        break;
    case "store-major":
        require 'App/controllers/majorController.php';
        break;
    case 'book-appointment':
        require 'App/views/patient/book-appointment.php';
        break;
    case 'appointment-controller':
        require 'App/controllers/AppointmentController.php';
        break;
    case 'patient-profile':
        require 'App/Views/patient/profile.php';
        break;
    case 'cancel-appointment':

        require 'App/Controllers/CancelAppointmentController.php';
        break;

    case "login":
        require "App/Views/Auth/login.php";
        break;
    case "register":
        require "App/Views/Auth/register.php";
        break;
    case "logout":
        require "App/Views/Auth/logout.php";
        break;
}

if ($isAdmin) {
    include "App/Views/Admin/layouts/footer.php";

} else {
    include 'App/Views/layouts/footer.php';
}