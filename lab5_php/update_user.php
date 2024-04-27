<?php
require_once  './db_connection.php';
require_once  './db_info.php';
require_once './db_class.php';

$user_id = (int)$_GET['id'];
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
    $old_data = json_encode($_POST);
    header("Location:update_form.php?errors={$errors}&old_data={$old_data}");
    exit();
}

try{

    $updates = '';

    foreach($_POST as $key=>$value)
    {
        if ($key === 'roomnumber') $key = 'room_number';
        $updates .= $key."="."'".$value."'".",";
    }

    $updates = rtrim($updates,',');

    $database = Database::getInstance();
    $res = $database->update(DB_TABLE,$user_id,$updates);

    if($res) 
    {
        header("Location:home.php");
    }

}catch(PDOException $e){
    header('Location:update_form.php');

}
?>