
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <h1>Edit User</h1>
    <?php
    require 'Conncet.php';

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
        try {
            $pdo = connect_to_db_pdo();
            if ($pdo) {
                $id = $_GET['id'];
                $stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
                $stmt->bindParam(':id', $id);
                $stmt->execute();
                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user) {
                    ?>
                <form action="ValidationEdit.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
                        <div class="mb-3">
                            <label for="Name" class="form-label">Name:</label>
                            <input type="text" name="Name" class="form-control" id="Name" value="<?php echo $user['name']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="UName" class="form-label">Username:</label>
                            <input type="text" name="UName" class="form-control" id="UName" value="<?php echo $user['username']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="Email" class="form-label">Email:</label>
                            <input type="text" name="Email" class="form-control" id="Email" value="<?php echo $user['email']; ?>">
                        </div>
                        <div class="mb-3">
                            <label for="room" class="form-label">Room Number:</label>
                            <select id="room" class="form-control w-25" name="room">
                                <option value="Application1" <?php if ($user['room'] === 'Application1') echo 'selected'; ?>>Application1</option>
                                <option value="Application2" <?php if ($user['room'] === 'Application2') echo 'selected'; ?>>Application2</option>
                                <option value="cloud" <?php if ($user['room'] === 'cloud') echo 'selected'; ?>>cloud</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="DisplayUsers.php" class="btn btn-secondary">Cancel</a>
                    </form>
                    <?php
                } else {
                    echo "<div class='alert alert-danger'>User not found</div>";
                }
            }
        } catch (PDOException $e) {
            echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Invalid request</div>";
    }
    ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

