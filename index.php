<?php
include 'views/layouts/header.php';
include 'views/layouts/nav.php';


$page=$_GET['page']??"home";
switch($page){
    case 'doctor':
        require 'app/controllers/doctorController.php';
        break;
}


include 'views/layouts/footer.php';
















?>