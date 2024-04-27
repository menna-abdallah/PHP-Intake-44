<?php 
require './utils.php';
require_once './db_class.php';


echo "<h1> Welcome !!! </h1>";

$database = Database::getInstance();

$rows = $database->getAllUsers();

display_table($rows);


echo "<a class='btn btn-dark m-5' href='logout.php'> logout </a>";

?>