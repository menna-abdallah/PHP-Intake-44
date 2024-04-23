
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
<div class="container">
<?php

session_start();
if($_SESSION['login']===true) {
    echo "<h1> welcome to home page </h1>";
    echo "<h2>welcome <span style='color: blue'>{$_COOKIE['name']}</span></h2>";

    echo "<a class='btn btn-dark m-3' href='LogOut.php'> logout </a>";
    echo "<a class='btn btn-dark' href='DisplayUsers.php'> Display Users </a>";


}else{
    header("location:LogIn.php");
}

?>
</div>
</body>
</html>