<?php 
    include 'DBConnector.php';
    include 'query_helpers.php';

    //declare
    $errors = [];
    $username = "";
    $email = "";
    $password = "";

    //verify the account
    //check if the name is unique
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $username = $_POST['reg_name'];
        $email = $_POST['reg_email'];
        $password = $_POST['reg_password'];

        //hash password
        $password_hash = $password;
        //password_hash($password, PASSWORD_DEFAULT);


        
        $query = "SELECT * FROM User WHERE User.user_name = '$username'";
        $results = query_ret($conn, $query);

        if ($username === '') {
            $errors['name'] = 'Enter a name';
        } 
        if ($email === '') {
            $errors['email'] = 'Enter an email';
        } 
        if ($password === ''){
            $errors['password'] = 'Enter a password';
        }

        //check if the username is unique
        if (!empty($results[0]['user_name'])) {
            $errors ['name'] = "Has the same username, pick another one";
        } 
        


        if (!empty($results[0]['user_email'])) {
            $errors['email'] = "Has the same email, pick another one";
        } 
        


        //get the user in the database if there is no errors
        if (empty($errors)) {
            $query = "INSERT INTO User (`user_name`, `user_email`, `password_hash`)
                        VALUES('$username', '$email', '$password_hash')";

            $result = query_insert($conn, $query);

            if ($result === false) {
                $errors['general'] = "Insertion did not happen";
            } else {
                //redirect to index, with the new user account
                header("Location: login.php");
            }
        } else {
            $errors['general'] = "There are still errors";
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
        <!-- add registration form -->
        <div class="form-card">
            <form method="POST" action="register.php">
                <!-- Username -->
                <label name="title"> Username </label>
                <input name="reg_name" type="text" value="<?= htmlspecialchars($username) ?? '';?>" > </input>
                <!-- error messages -->
                <div class="field-error"><span><?= $errors['name'] ?? '';?> </span></div>
                

                <!-- Email -->
                <label name=""> Email </label>
                <input name="reg_email" type="text" value="<?= htmlspecialchars($email) ?? '';?>"> </input>
                <div class="field-error"><span><?= $errors['email'] ?? '';?> </span></div>

                <!-- Password -->
                <label name=""> Password </label>
                <input name="reg_password" type="text" value="<?= htmlspecialchars($password) ?? '';?>"> </input>
                <div class="field-error"><span><?= $errors['password'] ?? '';?> </span></div>

                <span>
                        <?= $errors['general'] ?? '';?>
                </span>
                <br>

                <button type="submit">Create Account</button>
            </form>
        </div>

    </div>
</body>
</html>