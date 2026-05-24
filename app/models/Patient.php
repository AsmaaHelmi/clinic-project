<?php
require_once __DIR__ . '/../core/Database.php';

class Patient extends Database {

    public function getProfile($user_id) {
        $stmt = mysqli_prepare($this->conn,
            "SELECT full_name, email, phone FROM users WHERE id = ?"
        );
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        return mysqli_fetch_assoc($result);
    }

    public function updateProfile($user_id, $full_name, $phone) {
        $stmt = mysqli_prepare($this->conn,
            "UPDATE users SET full_name = ?, phone = ? WHERE id = ?"
        );
        mysqli_stmt_bind_param($stmt, "ssi", $full_name, $phone, $user_id);
        return mysqli_stmt_execute($stmt);
    }

    public function getMyDoctors($user_id) {
        return [];
    }
}
?>