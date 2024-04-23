<?php

require_once 'dbInfo.php';

function connect_to_db_pdo(){
    try {
        $dsn = "mysql:host=localhost;dbname=php_os;port=3306";
        $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
        // Set PDO error mode to exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        echo "<h3 style='color:red'>{$e->getMessage()}</h3>";
        return false;
    }
}

function create(){
    $pdo = connect_to_db_pdo();
    if (!$pdo) {
        return;
    }

    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        username VARCHAR(255) UNIQUE,
        email VARCHAR(255) NOT NULL ,
        password VARCHAR(255) NOT NULL,
        room VARCHAR(255) NOT NULL
    )";

    try {
        $pdo->exec($sql);
        // var_dump($pdo);
        // echo "Table 'users' created successfully";
    } catch (PDOException $e) {
        echo "Error creating table: " . $e->getMessage();
    }
}

create(); 

?>
