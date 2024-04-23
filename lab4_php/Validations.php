<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TITLE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container">
<?php
require 'Conncet.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    $old_data = [];

    if (empty($_POST["Name"])){
        $errors["Name"] = "name is required";
    }else{
        $old_data['Name'] = $_POST["Name"];
    }
    
    if (empty($_POST["UName"])){
        $errors["UName"] = "User Name is required";
    }else{
        // Check if username is unique
        $existing_users = file("users.txt", FILE_IGNORE_NEW_LINES);
        foreach ($existing_users as $user) {
            $user_data = json_decode($user, true);
            if ($user_data['UName'] == $_POST['UName']) {
                $errors["UName"] = "Username already exists";
                break;
            }
        }
    
        $old_data['UName'] = $_POST["UName"];
    }
    
    if (empty($_POST["password"])){
        $errors['password'] = "Password is required";
    } else {
        if (strlen($_POST["password"]) !== 8) {
            $errors['password'] = "Password must be exactly 8 characters long";
        }
        elseif (preg_match('/[^a-z0-9_]/', $_POST["password"])) {
            $errors['password'] = "Password can only contain lowercase letters, numbers, and underscores";
        }
    }
    
    if (empty($_POST["Cpassword"])){
        $errors['Cpassword'] = "Confirm your Password";
    }
    else {
        if ($_POST["password"] !== $_POST["Cpassword"]) {
            $errors['Cpassword'] = "Passwords do not match";
        }
    }
    
    if (empty($_POST["room"])){
        $errors['room'] = "Select your Room";
    }
    
    if (empty($_POST["Email"])){
        $errors["Email"] = "Email is required";
    }else if (!filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL)) {
            $errors["Email"] = "Invalid email format";
    }else{
        $existing_users = file("users.txt", FILE_IGNORE_NEW_LINES);
                foreach ($existing_users as $user) {
                    $user_data = json_decode($user, true);
                    if ($user_data['Email'] == $_POST['Email']) {
                        $errors["Email"] = "Email already exists";
                        break;
                    }
                }
        $old_data['Email'] = $_POST["Email"];
    }
    
    if (count($errors) > 0) {
        echo "<div class='alert alert-danger'>";
        foreach ($errors as $error) {
            echo "<p>$error</p>";
        }
        echo "</div>";
    } else {
        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $pdo = connect_to_db_pdo();
        $sql = "INSERT INTO users (name, username, email, password, room) VALUES (:name, :username, :email, :password, :room)";
        $stmt = $pdo->prepare($sql);
        // var_dump($stmt);

        // Bind parameters
        $stmt->bindParam(':name', $_POST['Name']);
        $stmt->bindParam(':username', $_POST['UName']);
        $stmt->bindParam(':email', $_POST['Email']);
        $stmt->bindParam(':password',$pass );
        $stmt->bindParam(':room', $_POST['room']);

        // Execute SQL statement
        try {
            $res = $stmt->execute();
            // var_dump($stmt);
            if($res){

                echo "<div class='alert alert-success'>New record created successfully</div>";
                echo "<a class='btn btn-dark' href='DisplayUsers.php'> Display Users </a>";

            }

        } catch (PDOException $e) {
            echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
        }
    }
}



?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
