<?php
require 'Conncet.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];
    $old_data = [];
    
    // Validate Name
    if (empty($_POST["Name"])) {
        $errors["Name"] = "Name is required";
    } else {
        $old_data['Name'] = $_POST["Name"];
    }
    
    // Validate Username
    if (empty($_POST["UName"])) {
        $errors["UName"] = "Username is required";
    } else {
        $old_data['UName'] = $_POST["UName"];
    }
    
    // Validate Email
    if (empty($_POST["Email"])) {
        $errors["Email"] = "Email is required";
    } else if (!filter_var($_POST["Email"], FILTER_VALIDATE_EMAIL)) {
        $errors["Email"] = "Invalid email format";
    } else {
        $old_data['Email'] = $_POST["Email"];
    }
    
    // Validate Room
    if (empty($_POST["room"])) {
        $errors["room"] = "Room is required";
    }
    
    // If there are any errors, redirect back to the edit form with error messages
    if (count($errors) > 0) {
        $errors = json_encode($errors);
        $old_data = json_encode($old_data);
        if (!empty($old_data)) {
            $url = "errors={$errors}&old_data={$old_data}";
        } else {
            $url = "errors={$errors}";
        }
        header("Location: Edit.php?id={$_POST['id']}&{$url}");
        exit();
    }
    
    // If all validations pass, update the user data in the database
    try {
        $pdo = connect_to_db_pdo();
        if ($pdo) {
            $stmt = $pdo->prepare("UPDATE users SET name = :name, username = :username, email = :email, room = :room WHERE id = :id");
            $stmt->bindParam(':name', $_POST['Name']);
            $stmt->bindParam(':username', $_POST['UName']);
            $stmt->bindParam(':email', $_POST['Email']);
            $stmt->bindParam(':room', $_POST['room']);
            $stmt->bindParam(':id', $_POST['id']);
            $stmt->execute();
            
            // Redirect to the display page after successful update
            header("Location: DisplayUsers.php");
            exit();
        }
    } catch (PDOException $e) {
        echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
    }
}
?>
