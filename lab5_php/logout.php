<?php

session_start(); 
setcookie("PHPSESSID", "", time() - 3600, "/" , "", 0);
session_destroy(); 

echo "logged out successfully";

echo "<a href='login_form.php' class='btn btn-primary'> login  </a>";
?>