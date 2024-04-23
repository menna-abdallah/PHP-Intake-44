<?php
require_once  'Conncet.php';

var_dump($_GET);

$std_id = $_GET['id'];
var_dump($std_id);

try{
    $pdo = connect_to_db_pdo();
    var_dump($pdo);

    $delete_query = "DELETE FROM users WHERE id = :id";
    $stmt = $pdo->prepare($delete_query);
    $stmt->bindParam(':id', $std_id, PDO::PARAM_INT);
    $res=$stmt->execute();
    if($stmt->rowCount()==1){
        echo "Deleted Successfully";
    }
    header("Location:DisplayUsers.php");
}catch(PDOException $e){
    echo $e->getMessage();

}