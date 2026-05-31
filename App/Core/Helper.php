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
            echo $_SESSION['message']['text'];
            unset($_SESSION['message']);
        }
    }

    public static function redirect($page)
    {
        header("Location: {$page}");
        exit;
    }
}