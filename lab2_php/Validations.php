<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submitted Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>Users Info</h1>
    
<?php

$errors = [];
$old_data= [];
if (empty($_POST["fName"])){
    $errors["fName"] = "first name is required";
}else{
    $old_data['fName'] = $_POST["fName"];
}

if (empty($_POST["lName"])){
    $errors["lName"] = "last name is required";
}else{
    $old_data['lName'] = $_POST["lName"];
}

if (empty($_POST["address"])){
    $errors["address"] = "address is required";
}else{
    $old_data['address'] = $_POST["address"];
}

if (empty($_POST["UName"])){
    $errors["UName"] = "User Name is required";
}else{
    $old_data['UName'] = $_POST["UName"];
}

if (empty($_POST["password"])){
    $errors['password'] = "Password is required";
}

if (empty($_POST["department"])){
    $errors["department"] = "Department is required";
}else{
    $old_data['department'] = $_POST["department"];
}


if (count($errors)){
    var_dump($errors);
    $errors = json_encode($errors);
    $old_data = json_encode($old_data);
    if (! empty($old_data)){
      $url= "errors={$errors}&old_data={$old_data}";
    }else{
        $url= "errors={$errors}";
    }
    header("Location:Form2.php?{$url}");
}else{
    var_dump($_POST);
    $data = json_encode($_POST);
    $data = $data."\n";
    var_dump($data);
    // exit;
    $fileobj= fopen("users.txt", "a");
    var_dump($fileobj);
    $res=fwrite($fileobj, $data);
    fclose($fileobj);
    display_data_in_table("users.txt");
}


function display_data_in_table($filename){
    echo "<table class='table'> <tr> <th>F-name</th> <th> L-name</th></th><th>Address</th><th>Country</th>
            <th>Gender</th><th>Skills</th><th>user-name</th><th>Password</th><th>Department</th>";
    $file_data = file($filename);
    foreach ($file_data as $line){
        $info = json_decode($line);
        echo "<tr>";
        foreach ($info as $item){
            echo "<td> {$item} </td>";
        }
        echo "</tr>";
    }

    echo "</table>";
}

    ?>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
