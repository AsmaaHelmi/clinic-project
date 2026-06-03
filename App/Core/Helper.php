<?php

namespace App\Core;

class Helper
{
    public static function checkRequestMethod()
    {
        return $_SERVER['REQUEST_METHOD'] === 'POST';
    }

    public static function checkPostInput($input)
    {
        return isset($_POST[$input]);
    }

    public static function setMessage($type, $message)
    {
        $_SESSION['message'] = [
            'type' => $type,
            'text' => $message,
        ];
    }

   public static function showMessage()
    {

        if (isset($_SESSION['message'])) {

             echo '

        <div class="alert alert-' . $_SESSION['message']['type'] . '">

            ' . $_SESSION['message']['text'] . '

        </div>

        ';

            unset($_SESSION['message']);

        }

    }


    public static function redirect($page)
    {
        header("Location: {$page}");
        exit;
    }

    //================================


    public static function requireLogin()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?page=login");
            exit();
        }
    }

    public static function requireRole($role)
    {
        if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== $role) {
            die("403 Unauthorized");
        }
    }

    public static function isAdmin()
    {
        return ($_SESSION['user_role'] ?? null) === 'admin';
    }

    public static function isDoctor()
    {
        return ($_SESSION['user_role'] ?? null) === 'doctor';
    }

    public static function doctorId()
    {
        return $_SESSION['doctor_id'] ?? null;
    }
}

