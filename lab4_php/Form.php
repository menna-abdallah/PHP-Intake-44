<?php
    if(isset($_GET['errors'])){
        $errors = json_decode($_GET["errors"], true);

    }

    if(isset($_GET['old_data'])){
        $old_data = json_decode($_GET["old_data"], true);
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>SIGN UP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Fill in Your Information</h1>
    <form action="Validations.php" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="Name" class="form-label">Name:</label>
            <input type="text" name="Name" class="form-control w-50" id="Name"
            value="<?php echo $old_data['Name']? $old_data['Name']: ''; ?>"
            >
            <label style="color: red; font-weight: bold">
                <?php echo $errors['Name']? $errors["Name"]: ""; ?>
            </label>
            <br>

            <label for="username" class="form-label">Username:</label>
            <input type="text" name="UName" class="form-control w-50" id="username"
            value="<?php echo $old_data['UName']? $old_data['UName']: ''; ?>"
            >
            <label style="color: red; font-weight: bold">
                <?php echo $errors['UName']? $errors["UName"]: ""; ?>
            </label>
            <br>

            <label for="Email" class="form-label">Email:</label>
            <input type="text" name="Email" class="form-control w-50" id="Email"
            value="<?php echo $old_data['Email']? $old_data['Email']: ''; ?>"
            >
            <label style="color: red; font-weight: bold">
                <?php echo $errors['Email']? $errors["Email"]: ""; ?>
            </label>
            <br>

            <label for="password" class="form-label">Password:</label>
            <input type="password" name="password" class="form-control w-50" id="password"
            value="<?php echo $old_data['password']? $old_data['password']: ''; ?>"
            >
            <label style="color: red; font-weight: bold">
                <?php echo $errors['password']? $errors["password"]: ""; ?>
            </label>
            <br>

            <label for="Cpassword" class="form-label">Confirm Password:</label>
            <input type="password" name="Cpassword" class="form-control w-50" id="Cpassword"
            >
            <label style="color: red; font-weight: bold">
                <?php echo $errors['Cpassword']? $errors["Cpassword"]: ""; ?>
            </label>
            <br>

            
            <label for="room" class="form-label">Room Number:</label>
            <select id="room" class="form-control w-25" name="room">
                <option value="Application1">Application1</option>
                <option value="Application2">Application2</option>
                <option value="cloud">cloud</option>
            </select>
            <label style="color: red; font-weight: bold">
            <?php echo $errors['room']? $errors["room"]: ""; ?>
            </label>
            
            
            <!-- <label for="" class="form-label">Profile picture</label>
            <input type="file" name="image"
                   class="form-control"  aria-describedby="emailHelp"
            >
            <label style="color: red; font-weight: bold">
            <?php echo $errors['image']? $errors["image"]: ""; ?>
            </label> -->
        
        <button type="submit" class="btn btn-primary m-3">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
