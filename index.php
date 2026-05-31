<?php
use App\Models\Major;



require_once __DIR__ . "/vendor/autoload.php";
session_start();

$host = "localhost";
$dbName = "clinic_project";
$user = "root";
$pass = "";
try{
$pdo = new PDO("mysql:host=$host;dbname=$dbName", $user, $pass);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);}
catch(PDOException $e){
    die("database connection failed".$e->getMessage());
}





$page=$_GET['page']??"home";
$isAdmin=false;
$adminpages=[
    
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
if (in_array($page, $adminpages)) {
    $isAdmin = true;
}
if($isAdmin){
    include "App/Views/Admin/layouts/header.php";
    include "App/Views/Admin/layouts/nav.php";
    include "App/Views/Admin/layouts/sidebar.php";

    echo "<div class='admin-wrapper'>";
}
else{
    include 'App/Views/layouts/header.php';
    include 'App/Views/layouts/nav.php';

   
}

switch($page){
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
        require "App/Views/patient/profile.php";
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
      
                require 'App/controllers/doctorController.php';

         break;
          case "admin-patients":
        require "App/views/Admin/users.php";
        break;
    case "admin-doctors":
        require "App/views/Admin/doctors.php";
        break;
    case "admin-login":
        require "App/views/Admin/login.php";
        break;
    case "admin-logout":
        require "App/views/Admin/logout.php";
        break;
    case "login":
        require "App/views/auth/login.php";
        break;
    case "register":
        require "App/views/auth/register.php";
        break;
    case "logout":
        require "App/views/auth/logout.php";
        break;
    case "patient-dashboard":
        require "App/views/patient/patient-dashboard.php";
        break;
    case "patient-profile":
        require "App/views/patient/profile.php";
        break;
    case "book-appointment":
        require "App/views/patient/book-appointment.php";
        break;
}

if($isAdmin){
    include "App/Views/Admin/layouts/footer.php";

}else{
include 'App/Views/layouts/footer.php';}
















?>