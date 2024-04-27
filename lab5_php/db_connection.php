<?php

require_once './db_info.php';

function connect_to_db(){
    try {
        $dsn= "mysql:host=localhost;dbname=php_osport=3306";
        $pdo=  new PDO($dsn, DB_USER, DB_PASSWORD);

        return $pdo;
    }
    catch (Exception $e) {
        echo "<h3 style='color:red'>{$e->getMessage()}</h3>";

        return false;
    }
}

// connect_to_db();
?>