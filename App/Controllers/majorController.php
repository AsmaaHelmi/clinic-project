<?php
use App\Models\Major;
use App\Core\Validator;
class MajorController{
   


public static function handel($pdo){
     //$object=new Major($pdo,$id,$title,$description);
     $action = $_GET['action'] ?? null;
     switch($action){
        case "add":
if($_SERVER['REQUEST_METHOD'] === "POST"){
   // var_dump($_POST);
    $title=trim($_POST['title']); 
    $description=trim($_POST['description']);    

    $newvalidator=new Validator();
    $newvalidator->required( $title,"title");
   $errors=$newvalidator->getErrors();
if(!empty($errors)){
    $_SESSION['errors'] = $errors;
    header("Location:index.php?page=create-major");
    exit;}
     $newMajor = Major::create($pdo, $title,$description);
    if($newMajor){
        header("Location:index.php?page=admin-major");
        exit;
    }
}
  break;
  case "update":

    if ($_SERVER['REQUEST_METHOD'] === "POST") {

        $id = (int) $_POST['id'];
        $title = trim($_POST['title']);
        $description = trim($_POST['description']);

        $newvalidator = new Validator();
        $newvalidator->required($title, "title");

        $errors = $newvalidator->getErrors();

        if (!empty($errors)) {

            $_SESSION['errors'] = $errors;

            header("Location:index.php?page=update-major&id=" . $id);
            exit;
        }

        $newMajor = Major::update($pdo, $id, $title, $description);

        if ($newMajor) {

            header("Location:index.php?page=admin-major");
            exit;
        }
    }

    

    break;

      case "delete-major":

    $majorId = (int) ($_GET['id'] ?? 0);

    if ($majorId) {
//         var_dump($majorId);
// die;

        $majorDeleted = Major::delete($pdo, $majorId);

        if ($majorDeleted) {
            header("Location: index.php?page=admin-major");
            exit;
        }
    }

    break;

     }
   
}
}
MajorController::handel($pdo);
