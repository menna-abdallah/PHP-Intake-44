<?php

require_once './db_info.php';
require_once './db_connection.php';
require_once './db_class.php';

try {
    $database = Database::getInstance();
    $email = $_POST['email'] ?? ''; 
    $password = $_POST['password'] ?? ''; 

    $res = $database->findOneUser($email, $password);

    if ($res) {
        session_start(); 
        header('Location: home.php');
        exit(); 
    } else {
        header("Location: login_form.php");
        exit();
    }
} catch(PDOException $e) {
    error_log($e->getMessage());
    header("Location: error_page.php");
    exit(); 
}
?>
