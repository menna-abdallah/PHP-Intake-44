<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<?php

if (isset($_GET['errors']))
{
    $errors = json_decode($_GET['errors']);
}

?>
<body>
    <div class="container">
        <h2>Registration Form</h2>
        <form method="POST" action="register.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" >

                <p class='text-danger fw-bold '> 
                <?php 
                echo $errors->name ? $errors->name : ''
                ?>
                </p>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email" >
                <p class="text-danger fw-bold ">
                    <?php 
                    echo $errors->email ? $errors -> email : "" ;
                    ?></p> 
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" >
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" class="form-control" id="confirm_password" name="confirm_password" >
            </div>

            <div class="form-group">
                <label for="room_number">Room Number</label>
                <select class="form-control" id="room_number" name="room_number" required>
                    <option value="application1">Application 1</option>
                    <option value="application2">Application 2</option>
                    <option value="cloud">Cloud</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Profile Picture</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>