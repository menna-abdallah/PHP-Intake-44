<?php
require_once  './db_connection.php';
require_once './utils.php';
require_once './db_info.php';
require_once './db_class.php';

var_dump($_GET);
$user_id = $_GET['id'];

try{

    $database = Database::getInstance();

    $res = $database->delete(DB_TABLE,$user_id);

    header("Location:home.php");
    // $pdo = connect_to_db();
    // var_dump($pdo);

    // $delete_query = "DELETE FROM ".DB_TABLE." WHERE id = :id";
    // $stmt = $pdo->prepare($delete_query);
    // $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
    // $res=$stmt->execute();
    // if($stmt->rowCount()==1)
    // {
    //     echo "Deleted";
    // }
}catch(PDOException $e){
    echo $e->getMessage();

}