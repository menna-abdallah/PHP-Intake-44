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
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Fill in Your Information</h1>
    <form action="Validations.php" method="POST">
        <div class="mb-3">
            <label for="firstName" class="form-label">First Name:</label>
            <input type="text" name="fName" class="form-control w-50" id="firstName"
            value="<?php echo $old_data['fName']? $old_data['fName']: ''; ?>"
            >
            <label style="color: red; font-weight: bold">
                <?php echo $errors['fName']? $errors["fName"]: ""; ?>
            </label>
            <br>
            
            <label for="lastName" class="form-label">Last Name:</label>
            <input type="text" name="lName" class="form-control w-50" id="lastName"
            value="<?php echo $old_data['lName']? $old_data['lName']: ''; ?>"
            >
            <label style="color: red; font-weight: bold">
                <?php echo $errors['lName']? $errors["lName"]: ""; ?>
            </label>
            <br>

            <label for="address" class="form-label">Address:</label>
            <textarea class="form-control w-50" placeholder="Write your address here" cols="50" rows="6" id="address" name="address"
            value="<?php echo $old_data['address']? $old_data['address']: ''; ?>"
            ></textarea>
            <label style="color: red; font-weight: bold">
                <?php echo $errors['address']? $errors["address"]: ""; ?>
            </label>
            <br>
            
            <label for="country" class="form-label">Your Country:</label>
            <select id="country" class="form-control w-25" name="country">
                <option value="Egypt">Egypt</option>
                <option value="India">India</option>
                <option value="France">France</option>
                <option value="England">England</option>
            </select>
            
            <label class="form-label">Your Gender:</label>
            <div>
                <input type="radio" name="gender" value="male" id="male" class="form-check-input">
                <label for="male" class="form-check-label">Male</label>
                
                <input type="radio" name="gender" value="female" id="female" class="form-check-input">
                <label for="female" class="form-check-label">Female</label>
            </div>
            
            <label class="form-label">Your Skills:</label>
            <div>
                <input type="checkbox" name="skills[]" value="HTML" class="form-check-input">HTML
                <input type="checkbox" name="skills[]" value="CSS" class="form-check-input">CSS
                <input type="checkbox" name="skills[]" value="PHP" class="form-check-input">PHP
            </div>
            
            <label for="username" class="form-label">Username:</label>
            <input type="text" name="UName" class="form-control w-50" id="username"
            value="<?php echo $old_data['UName']? $old_data['UName']: ''; ?>"
            >
            <label style="color: red; font-weight: bold">
                <?php echo $errors['UName']? $errors["UName"]: ""; ?>
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
            
            <label for="department" class="form-label">Your Department:</label>
            <input type="text" class="form-control w-50" name="department"
            value="<?php echo $old_data['department']? $old_data['department']: ''; ?>"
            >
            <label style="color: red; font-weight: bold">
                <?php echo $errors['department']? $errors["department"]: ""; ?>
            </label>
            <br>
            
            <label for="code" class="form-label">Enter the code: KJw3$124</label>
            <input type="text" class="form-control w-50" id="code">
        </div>
        
        <button type="submit" class="btn btn-primary m-3">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
