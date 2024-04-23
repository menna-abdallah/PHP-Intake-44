<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TITLE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container">
<?php
require 'Conncet.php';


function display_data(){

    try{
        $pdo = connect_to_db_pdo();
        // var_dump($pdo);
        if ($pdo){

            $select_query = 'select * from users;';
            $stmt= $pdo->prepare($select_query); 

            $res= $stmt->execute();
    
            // var_dump($res);
            if($res){
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                display_in_table($rows);
            }
        }
    }catch(Exception $e){
        echo "<h3 style='color:red'>{$e->getMessage()}</h3>";
    }
        }


        function display_in_table($rows){
            echo "<table class='table'> 
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Room</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>";
        
            foreach ($rows as $line) {
                $url_query_string = $line['id'];
                $delete_url = "Delete.php?id={$url_query_string}";
                $edit_url = "Edit.php?id={$url_query_string}";
                echo "<tr>";
                foreach ($line as $key => $value) {
                    // Skip displaying the "Cpassword" field
                    if ($key === "Cpassword") {
                        continue;
                    }
                    echo "<td>$value</td>";
                }
                echo "<td><a href='{$edit_url}' class='btn btn-warning'>Edit</a></td>";
                echo "<td> <a href='{$delete_url}'  class='btn btn-danger'> Delete</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        }
        
        display_data();
?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>