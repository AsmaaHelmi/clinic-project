<?php
namespace App\core;

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
    }}
