<?php

require_once './db_connection.php';
require_once './db_info.php';
require_once './db_class.php';

$errors=[];

if(empty($_POST['name']))
{
    $errors['name'] = 'name is required';
}

if(empty($_POST['email']))
{
    $errors['email'] = 'email is required';
} 

if (!isset($errors['email']) && !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
{
    $errors['email'] = 'email is not correct';
}

if(count($errors))
{
    $errors = json_encode($errors);
    header("Location:form.php?errors={$errors}");
    exit();
}

if (isset($_FILES['image']['tmp_name'])){
    $filename = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $allowed =  array('jpeg','jpg', "png", "gif", "bmp", "JPEG","JPG", "PNG", "GIF", "BMP");
    
    if (!in_array($extension,$allowed))
    {
        $errors['image'] = "Wrong file format";
        // header("Location:form.php");
    }

    $saved = move_uploaded_file($tmp_name, "images/{$filename}");

try
{
    $database = Database::getInstance();
    $columns = '';
    $values = '';
    foreach($_POST as $key=>$value)
    {
        if($key === 'confirm_password') continue;
        if($key === 'roomnumber') $key = 'room_number';
        $columns .= "$key,";
        $values .= "'$value',";
    }
    
    $columns = rtrim($columns , ',');
    $values = rtrim($values , ',');
    
    $res = $database->insert(DB_TABLE,$columns,$values);
    
    header("Location:login_form.php");
}
catch (PDOException $e)
{
    echo $e->getMessage();
}

}


?>