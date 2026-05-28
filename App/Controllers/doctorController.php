<?php

namespace app\controllers;

use app\Models\Doctor;
use app\core\Validator;

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
                        'image' => trim($_POST['image'])
                    ];


                    $validator = new Validator();

                    $validator->required($data['name'], 'name');
                    $validator->required($data['email'], 'email');
                    $validator->required($data['password'], 'password');

                    $errors = $validator->getErrors();

                    if(!empty($errors)){

                        $_SESSION['errors'] = $errors;

                        header('Location:index.php?page=admin-doctor');
                        exit;
                    }


                    $doctorCreated = doctorController::create($pdo, $data);

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
                        'email' => trim($_POST['email']),
                        'phone' => trim($_POST['phone']),
                        'major_id' => trim($_POST['major_id']),
                        'description' => trim($_POST['description']),
                        'image' => trim($_POST['image'])
                    ];


                    $validator = new Validator();

                    $validator->required($data['name'], 'name');
                    $validator->required($data['email'], 'email');

                    $errors = $validator->getErrors();

                    if(!empty($errors)){

                        $_SESSION['errors'] = $errors;

                        header('Location:index.php?page=admin-doctor');
                        exit;
                    }


                    $doctorUpdated = doctorController::update($pdo, $id, $data);

                    if($doctorUpdated){
                        header('Location:index.php?page=admin-doctor');
                        exit;
                    }
                }

                break;


            case 'delete':

                $doctorId = (int) ($_GET['id'] ?? 0);

                if($doctorId){

                    $doctorDeleted = doctorController::delete($pdo, $doctorId);

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