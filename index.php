<?php
use app\Models\Major;

require_once __DIR__ . "/vendor/autoload.php";
session_start();

$baseUrl = "http://localhost/CLINIC-PROJECT/";

$host = "localhost";
$dbName = "clinic_project";
$user = "root";
$pass = "";
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbName", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("database connection failed" . $e->getMessage());
}

$page = $_GET['page'] ?? "home";
$isAdmin = false;
$adminpages = [
    'dashboard',
    'admin-major',
    'create-major',
    'store-major',
    'update-major',
];

if (in_array($page, $adminpages)) {
    $isAdmin = true;
}

ob_start();

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
        require "app/views/auth/login.php";
        break;
    case "register":
        require "app/views/auth/register.php";
        break;
    case "logout":
        require "app/views/auth/logout.php";
        break;
    case "patient-dashboard":
        require "app/views/patient/patient-dashboard.php";
        break;
    case "patient-profile":
        require "app/views/patient/profile.php";
        break;
}

if ($isAdmin) {
    echo "</div>";
    include "App/Views/Admin/layouts/footer.php";
} else {
    include 'App/Views/layouts/footer.php';
}

$output = ob_get_clean();
$output = str_replace(
    ['href="./assets/', 'src="./assets/', 'href="assets/', 'src="assets/', 'href="./css/', 'href="./js/'], 
    ['href="'.$baseUrl.'public/assets/', 'src="'.$baseUrl.'public/assets/', 'href="'.$baseUrl.'public/assets/', 'src="'.$baseUrl.'public/assets/', 'href="'.$baseUrl.'public/assets/css/', 'href="'.$baseUrl.'public/assets/js/'], 
    $output
);
echo $output;