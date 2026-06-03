<?php


use App\Models\Major;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Core\Helper;


ob_start();
require_once __DIR__ . "/vendor/autoload.php";
session_start();
define('BASE_URL', '/');

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

    'dashboard',
    'admin-major',
    'create-major',
    'store-major',
    'update-major',
    'admin-doctor',
    'create-doctor',
    'update-doctor',
    'store-doctor',
    'admin-patients',
    'admin-login',
    'admin-logout',
    'admin-doctors',

];

//===============================
$doctorPages = [
    'doctor-dashboard'
];

$isDoctor = false;

if (in_array($page, $doctorPages)) {
    $isDoctor = true;
}

//================================

if (in_array($page, $adminpages)) {
    $isAdmin = true;
}

if ($page === 'logout') {

    session_unset();

    session_destroy();

    header("Location: index.php?page=login");

    exit();

}

if ($isAdmin) {
    include "App/Views/Admin/layouts/header.php";
    include "App/Views/Admin/layouts/nav.php";
    include "App/Views/Admin/layouts/sidebar.php";

    echo "<div class='admin-wrapper'>";
} elseif ($isDoctor) {
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

    case "dashboard":

        require "App/Views/Admin/dashboard.php";
        break;

    case "admin-major":
        require "App/Views/Admin/major/admin-major.php";
        break;

    case "create-major":
        require "App/Views/Admin/major/create-major.php";
        break;
    case "store-major":
        require 'App/controllers/majorController.php';
        break;
    case "update-major":

        require "App/Views/Admin/major/update-major.php";
        break;

    case "delete-major":

        require 'App/controllers/majorController.php';

        break;
    case "login":
        require "App/Views/auth/login.php";
        break;
    case "register":
        require "App/Views/auth/register.php";
        break;

    case "admin-doctor":
        require "App/Views/Admin/doctor/admin-doctor.php";
        break;

    case "doctors":
        require "App/Views/doctor.php";
        break;
    case "create-doctor":
        require "App/Views/Admin/doctor/create-doctor.php";
        break;
    case "store-doctor":
        require 'App/controllers/doctorController.php';
        break;
    case "update-doctor":

        require "App/Views/Admin/doctor/update-doctor.php";
        break;

    case "delete-doctor":

        require 'App/Controllers/doctorController.php';

        break;
    case "admin-patients":
        require "App/Views/Admin/users.php";
        break;
    case "admin-doctors":
        require "App/Views/Admin/doctors.php";
        break;
    case "admin-login":
        require "App/Views/Admin/login.php";
        break;
    case "admin-logout":
        require "App/Views/Admin/logout.php";
        break;

    case "patient-dashboard":
        require "App/Views/patient/patient-dashboard.php";
        break;

    case 'book-appointment':
        require 'App/Views/patient/book-appointment.php';
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

    case "major-doctors":

        require"App/Views/major-doctors.php";

        break;

    // ======================================

    case "doctor-dashboard":

    Helper::requireLogin();
    Helper::requireRole('doctor');

    $doctorId = Helper::doctorId();

    $appointments = Appointment::getDoctorAppointments($pdo, $doctorId);
        if (!isset($_SESSION['doctor_id'])) {
        die("doctor_id is missing in session");
    }

    $doctorId = (int) $_SESSION['doctor_id'];

    $appointments = \App\Models\Appointment::getDoctorAppointments($pdo, $doctorId);

    require "App/Views/doctor-dashboard.php";
    break;

    // ==========================================

    case "login-action":
    require "App/Controllers/AuthController.php";
    break;

}

if ($isAdmin) {
    include "App/Views/Admin/layouts/footer.php";

} elseif ($isDoctor) {
        include "App/Views/Admin/layouts/footer.php";
}
 else {
    include 'App/Views/layouts/footer.php';
}
ob_end_flush();
