<?php

namespace App\Controllers;

use App\Models\Doctor;
use App\Models\User;

use App\Core\Validator;

class doctorController {

    public static function handle($pdo)
    {
        $action = $_GET['action'] ?? null;

        switch($action){

            case 'add':

                if($_SERVER['REQUEST_METHOD'] === 'POST'){

                    $data = [
                       

                        'name' => trim($_POST['name']),
                        'email' => trim($_POST['email']),
                        'password' => trim($_POST['password']),
                        'major_id' => trim($_POST['major_id']),
                        'phone' => trim($_POST['phone']),
                        'description' => trim($_POST['description']),
                        'image' => $_FILES['image']
                    ];


                    $validator = new Validator();
                     $userModel=new User($pdo);

                    $validator->required($data['name'], 'name');
                    $validator->required($data['email'], 'email');
                    $validator->required($data['password'], 'password');

                    $errors = $validator->getErrors();

                    if(!empty($errors)){

                        $_SESSION['errors'] = $errors;

                        header('Location:index.php?page=admin-doctor');
                        exit;
                    }
                $userId = $userModel->createUser( $data['name'], $data['email'],$data['password'],'doctor');
                 $data['user_id'] = $userId;
//                  var_dump($userId);
// exit;



        $doctorCreated = Doctor::create( $pdo,$data['user_id'], $data['major_id'], $data['phone'],

                    $data['description'],
                    $data['image']);

                    if($doctorCreated){
                        header('Location:index.php?page=admin-doctor');
                        exit;
                    }
                }

                break;


            case 'update':

                if($_SERVER['REQUEST_METHOD'] === 'POST'){

                    $id = (int) $_POST['id'];

                    $data = [
                        'name' => trim($_POST['name']),
                        'email' => trim($_POST['email']?? ''),
                        'password' => trim($_POST['password']),

                        'phone' => trim($_POST['phone']),
                        'major_id' => trim($_POST['major_id']),
                        'description' => trim($_POST['description']),
                        //'image' => $_FILES['image'] ?? null
                    ];


                    $validator = new Validator();
                     $userModel=new User($pdo);
                    
               
                    

                    $validator->required($data['name'], 'name');
                    $validator->required($data['email'], 'email');
                    $validator->required($data['password'], 'password');


                    $errors = $validator->getErrors();

                    if(!empty($errors)){

                        $_SESSION['errors'] = $errors;

                        header('Location:index.php?page=admin-doctor'. $id);
                        exit;
                    }$doctor = Doctor::findById($pdo, $id);
                     $userModel->updateUser( $doctor->getUserId(), $data['name'], $data['email'],$data['password'],'doctor');
                // $data['user_id'] = $userId;


                    $doctorUpdated = Doctor::update($pdo, $id, $data['name'], $data['email'],
                    $data['major_id'],$data['phone'], $data['description']);

                    if($doctorUpdated){
                        header('Location:index.php?page=admin-doctor');
                        exit;
                    }
                }

                break;


            case 'delete-doctor':

                $doctorId = (int) ($_GET['id'] ?? 0);

                if($doctorId){

                    $doctorDeleted =Doctor::delete($pdo, $doctorId);

                    if($doctorDeleted){
                        header('Location:index.php?page=admin-doctor');
                        exit;
                    }
                }

                break;
        }
    }
}

doctorController::handle($pdo);