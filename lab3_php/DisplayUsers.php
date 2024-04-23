<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>    
    <div class="container">
        <?php
        echo "hi";


function display_data_in_table($filename) {
    echo "<table class='table'> 
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Room</th>
            </tr>";

    $file_data = file($filename);
    
    foreach ($file_data as $line) {
        $info = json_decode($line, true); 
        
        echo "<tr>";
        
        if (isset($info['image'])) {
            echo "<td><img src='images/{$info['image']}' width='150' height='150'></td>";
        } else {
            echo "<td>No image</td>";
        }
        
        foreach ($info as $key => $value) {
            if ($key === "image") {
                continue;
            }
            // Display all fields except "Cpassword"
            if ($key !== "Cpassword") {
                echo "<td>$value</td>";
            }
        }
        
        echo "</tr>";
    }
    echo "</table>";
}

display_data_in_table("users.txt");

?>

    </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>