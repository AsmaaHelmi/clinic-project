<?php
require_once '../config/Database.php';

class User extends Database {

    public function register($full_name, $email, $password, $phone) {
        $stmt = mysqli_prepare($this->conn, "SELECT id FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        if (mysqli_stmt_num_rows($stmt) > 0) {
            return "Email already exists";
        }

        $hashed  = password_hash($password, PASSWORD_DEFAULT);

        $stmt = mysqli_prepare($this->conn,
            "INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, 'patient')"
        );
        mysqli_stmt_bind_param($stmt, "sss", $full_name, $email, $hashed);
        mysqli_stmt_execute($stmt);
        $user_id = mysqli_insert_id($this->conn);

        $stmt = mysqli_prepare($this->conn,
            "INSERT INTO patients (user_id, phone) VALUES (?, ?)"
        );
        mysqli_stmt_bind_param($stmt, "is", $user_id, $phone);
        mysqli_stmt_execute($stmt);

        return true;
    }

    public function login($email, $password) {
        $stmt = mysqli_prepare($this->conn, "SELECT * FROM users WHERE email = ?");
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $user   = mysqli_fetch_assoc($result);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function logout() {
        session_destroy();
        header("Location: login.php");
        exit;
    }
}
?>