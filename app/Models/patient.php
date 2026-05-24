<?php

namespace app\models;

use PDO;

class Patient {
    private $db;
    private $table = "users";

    public function __construct() {
        global $pdo;
        $this->db = $pdo;
    }

    public function getProfile($user_id) {
        $sql = "SELECT name, email FROM {$this->table} WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['id' => $user_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateProfile($user_id, $name) {
        $sql = "UPDATE {$this->table} SET name = :name WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            'name' => $name,
            'id' => $user_id
        ]);
    }
}