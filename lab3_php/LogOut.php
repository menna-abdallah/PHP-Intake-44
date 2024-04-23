<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>LogOutn</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

</head>
<body>
<div class="container">
<?php
session_start(); 

    unset($_SESSION['login']);
    setcookie("PHPSESSID", "", time() - 3600, "/" , "", 0);
    setcookie("name", "", time() - 3600, '/');
session_destroy();  

echo "<h1>logged out successfully</h1>";

echo "<a href='LogIn.php' class='btn btn-primary'> Login again </a>";

?>
</div>
</body>
</html>
