<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<?php

require_once  './db_connection.php';
require_once  './db_info.php';
require_once './db_class.php';

$user_id = $_GET['id'];

if (isset($_GET['errors']))
{
    $errors = json_decode($_GET['errors']);
}

$old_data = [];

if (isset($_GET['old_data']))
{
    $old_data = json_decode($_GET['old_data'], TRUE);
}
else
{
    try
    {
    $database = Database::getInstance();
    
    $old_data = $database->getUserById($_GET['id'])[0];
    }
    catch(PDOException $e)
    {
    echo $e->getMessage();
    }
}

?>
<body>
    <div class="container">
        <h2>Update Form</h2>
        <form method="POST" 
        action=<?php echo "update_user.php?id={$user_id}";?>
        enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" 
                value=<?php echo $old_data['name'] ?>
                >

                <p class='text-danger fw-bold '> 
                <?php 
                echo $errors->name ? $errors->name : ''
                ?>
                </p>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" class="form-control" id="email" name="email"
                value=<?php echo $old_data['email'] ?>
                >
                <p class="text-danger fw-bold ">
                    <?php 
                    echo $errors->email ? $errors -> email : "" ;
                    ?></p> 
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password"
                value=<?php echo $old_data['password'] ?>
                >
            </div>

            <div class="form-group">
                <label for="roomnumber">Room Number</label>
                <select class="form-control" id="roomnumber" name="roomnumber" required>
                    <option value="application1">Application 1</option>
                    <option value="application2">Application 2</option>
                    <option value="cloud">Cloud</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Profile Picture</label>
                <input type="file" class="form-control-file" id="image" name="image">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>