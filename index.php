<?php

use App\Models\Major;

require_once __DIR__ . "/vendor/autoload.php";

session_start();

$host = "localhost";
$dbName = "clinic_project";
$user = "root";
$pass = "";

try {

    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbName",
        $user,
        $pass
    );

    $pdo->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );

} catch (PDOException $e) {

    die("database connection failed" . $e->getMessage());

}


$page = $_GET['page'] ?? "home";

$isAdmin = false;

$adminpages = [

    'admin-home',
    'dashboard',

    'admin-major',
    'create-major',
    'store-major',
    'update-major',
    'delete-major',

    'admin-doctor',
    'create-doctor',
    'store-doctor',
    'update-doctor',
    'delete-doctor',

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


    case "admin-home":

        require "App/Views/Admin/dashboard.php";

        break;


    case "dashboard":

        require "App/Views/Admin/dashboard.php";

        break;


    // ===== ADMIN MAJOR =====

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


    // ===== ADMIN DOCTOR =====

    case 'admin-doctor':

        require 'App/Views/Admin/doctor/admin-doctor.php';

        break;


    case 'create-doctor':

        require 'App/Views/Admin/doctor/create-doctor.php';

        break;


    case 'store-doctor':

        require 'App/controllers/doctorController.php';

        break;


    case 'update-doctor':

        require 'App/Views/Admin/doctor/update-doctor.php';

        break;


    case 'delete-doctor':

        require 'App/controllers/doctorController.php';

        break;


    // ===== BOOKING =====

    case 'book-appointment':

        require 'App/Views/patient/book-appointment.php';

        break;


    case 'appointment-controller':

        require 'App/Controllers/AppointmentController.php';

        break;

}


if ($isAdmin) {

    include "App/Views/Admin/layouts/footer.php";

} else {

    include 'App/Views/layouts/footer.php';

}