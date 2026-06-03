<?php

namespace App\Models;

use PDO;

class User {
   private $db;
   private $table = "users";
 

    public function __construct() {
        global $pdo;
        $this->db = $pdo;
    

     
    }


 
    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
      public function findByid($id) {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
   

    public function createUser($name, $email, $password,$role) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO {$this->table} (name, email, password, role) VALUES (:name, :email, :password, :role)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'role'=>$role
        ]);
         return $this->db->lastInsertId();
    }
   public function updateUser($id,$name, $email, $password,$role) {
      $oldUser = $this->findById($id);

    $oldEmail = $oldUser['email'];
    $oldPassword = $oldUser['password'];
     $newEmail = !empty($email) ? $email : $oldEmail;

       if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    } else {
        $hashedPassword = $oldPassword;
    }


        $sql = "UPDATE {$this->table} SET name = :name, email= :email , password= :password ,  role = :role WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'id'=>$id,
            'name' => $name,
            'email' => $newEmail,

            'password' =>  $hashedPassword,
            'role'=>$role

           
        ]);

   }
    public function getDoctorIdByUserId($userId)
{
    $stmt = $this->db->prepare("
        SELECT id FROM doctors WHERE user_id = ?
    ");
    $stmt->execute([$userId]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

  
}