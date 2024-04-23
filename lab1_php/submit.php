<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Submitted Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1>User Info</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $gender = $_POST['gender'];
        $mr_mrs = ($gender === 'male') ? 'Mr.' : 'Mrs.';
        
      
        echo "<p>Thanks " . $mr_mrs . " " . $_POST['fName'] . " " . $_POST['lName'] . "</p>";
        echo "<br>";

        echo "<p><strong>Please Review Your Information</strong></p>";
        echo "<p>Name: ". $_POST['fName'] . " " .$_POST['lName'] ."</p>";
        echo "<p>Address: ". $_POST['address'] ."</p>";
        echo "<p>Country: ". $_POST['country'] ."</p>";
        echo "<p>Your Skills: ".implode("<br>" , $_POST['skills']) ."</p>";
        echo "<p>Department: ". $_POST['department'] ."</p>";



    } else {
        echo "<p>No data submitted</p>";
    }
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
