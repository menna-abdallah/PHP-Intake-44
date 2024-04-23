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

$errors = [];
$old_data= [];
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

// if (empty($_POST["Email"])){
//     $errors["Email"] = "Email is required";
// } 
// else if (!preg_match('/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/', $_POST["Email"])) 
// {
//     $errors["Email"] = "Invalid email format";
// }
// else {
//         $existing_users = file("users.txt", FILE_IGNORE_NEW_LINES);
//         foreach ($existing_users as $user) {
//             $user_data = json_decode($user, true);
//             if ($user_data['Email'] == $_POST['Email']) {
//                 $errors["Email"] = "Email already exists";
//                 break;
//             }
//         }
//     $old_data['Email'] = $_POST["Email"];
// }


if (empty($_FILES["image"]["name"])) {
    $errors['image'] = "Image is required";
} else {
    $file_name = $_FILES["image"]["name"];
    $file_tmp = $_FILES["image"]["tmp_name"];
    $file_size = $_FILES["image"]["size"];
    $file_type = $_FILES["image"]["type"];
    
    if (!is_uploaded_file($file_tmp)) {
        $errors['image'] = "Error uploading image";
    }
    $allowed_types = array("image/jpeg", "image/png", "image/gif");
    if (!in_array($file_type, $allowed_types)) {
        $errors['image'] = "Invalid file type. Only JPEG, PNG, and GIF files are allowed";
    }
    $max_size = 3 * 1024 * 1024; 
    if ($file_size > $max_size) {
        $errors['image'] = "File size exceeds the maximum limit of 3MB";
    }
    $upload_dir = "images/";
    $destination = $upload_dir . $file_name;
    if (!move_uploaded_file($file_tmp, $destination)) {
        $errors['image'] = "Error moving uploaded file";
    }else{
        $_POST['image'] = $file_name;
        $old_data['image'] = $file_name;
    }
}


// redirect to sign up
if (count($errors)){
    $errors = json_encode($errors);
    $old_data = json_encode($old_data);
    if (! empty($old_data)){
      $url= "errors={$errors}&old_data={$old_data}";
    }else{
        $url= "errors={$errors}";
    }
    header("Location:Form.php?{$url}");
}else{
    // write data
    $_POST['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $data = json_encode($_POST);
    $data = $data."\n";
    $fileobj= fopen("users.txt", "a");
    $res=fwrite($fileobj, $data);
    fclose($fileobj);
    echo "<h1> sign in successfully</h1>";
    echo "<a class='btn btn-dark' href='LogIn.php'> log In </a>";
}

    ?>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
