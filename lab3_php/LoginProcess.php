<?php
var_dump($_POST);

$existing_users = file("users.txt", FILE_IGNORE_NEW_LINES);
foreach ($existing_users as $user) {
    $user_data = json_decode($user, true);
    if ($user_data['Email'] == $_POST['Email']) {
        $userPassword = $user_data['password'];
        if (password_verify($_POST['password'], $userPassword)) {
            session_start(); 
            $_SESSION['email'] = $_POST['Email'];
            $_SESSION['login'] = true;
            setcookie("name", $user_data['Name'], time()+3600, '/', "",0);
            header("location:Home.php");
            exit(); 
        } else {
            header("Location:LogIn.php");
            exit(); 
        }
    }
}
header("Location:LogIn.php");

