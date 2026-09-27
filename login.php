<?php

include 'DBConnector.php';
include 'query_helpers.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['log_name'];
    $password = $_POST['log_password'];

    //get the user in the database
    $sql = "SELECT * FROM User WHERE User.user_name = '$username'";
    $user = query_ret($conn, $sql);

    if ($user === false) {

        $error['msg'] = "Invalid username or password";

    } else {

        if ($password === $user[0]['password_hash']) {

            $_SESSION['user_id'] = $user[0]['user_id'];

            header("Location: login_test_page.php");
            exit();

        } else {
            $error['msg'] = "Invalid username or password";
        }
    }
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Task</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="page">
        <!-- add login form -->
        <div class="form-card">
            <form method="POST" action="login.php">
                <!-- Username -->
                <label name="title"> Username </label>
                <input name="log_name" type="text"> </input>

                <!-- Password -->
                <label name=""> Password </label>
                <input name="log_password" type="text"> </input>

                <?php if (!empty($error['msg'])): ?>
                        <div class="field-error"><?= $error['msg'] ?></div>
                <?php endif; ?>

                <button type="submit">Log In</button>
                <a href="register.php">Create an account</a>
                
                <!-- a register button -->
            </form>
        </div>

    </div>
</body>
</html>