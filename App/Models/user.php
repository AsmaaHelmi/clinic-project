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

    public function createPatient($name, $email, $password) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO {$this->table} (name, email, password, role) VALUES (:name, :email, :password, 'patient')";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword
        ]);
    }
}