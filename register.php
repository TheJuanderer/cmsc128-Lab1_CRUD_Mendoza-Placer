<?php 
    include 'DBConnector.php';
    include 'query_helpers.php';
    include 'user_helpers.php';

    $errors = [];
    $username = "";
    $email = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['reg_name'] ?? '');
        $email    = trim($_POST['reg_email'] ?? '');
        $password = $_POST['reg_password'] ?? '';
        $confirm  = $_POST['reg_confirm'] ?? '';

        // Validation checks with clear HCI error messages
        if ($username === '') {
            $errors['name'] = 'Please enter a username.';
        } elseif (!preg_match('/^[A-Za-z0-9_]{3,30}$/', $username)) {
            $errors['name'] = 'Username must be 3-30 characters long (letters, numbers, or underscores only).';
        }

        if ($email === '') {
            $errors['email'] = 'Please enter an email address.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Please enter a valid email address (e.g., user@example.com).';
        }

        if ($password === '') {
            $errors['password'] = 'Please enter a password.';
        } elseif (strlen($password) < 8) {
            $errors['password'] = 'Password must be at least 8 characters long.';
        }

        if ($confirm === '') {
            $errors['confirm'] = 'Please confirm your password.';
        } elseif ($password !== $confirm && !isset($errors['password'])) {
            $errors['confirm'] = 'Passwords do not match. Please re-enter.';
        }

        // Database duplication check
        if (empty($errors)) {
            $taken = find_user_conflicts($conn, $username, $email);
            if ($taken['name']) {
                $errors['name'] = "This username is already taken. Please choose another.";
            } 
            if ($taken['email']) {
                $errors['email'] = "An account with this email address already exists.";
            } 
        }

        // Save account if validation passes
        if (empty($errors)) {
            $password_hash = password_hash($password, PASSWORD_DEFAULT);
            $result = create_user($conn, $username, $email, $password_hash);

            if ($result === false) {
                $errors['general'] = "Unable to register at this time. Please try again later.";
            } else {
                $_SESSION['flash_success'] = "Account created successfully! Please log in.";
                header("Location: login.php");
                exit();
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Account</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="page">
        <div class="form-card">
            <form method="POST" action="register.php" novalidate>
                <!-- Username -->
                <label for="reg_name">Username</label>
                <input id="reg_name" name="reg_name" type="text" value="<?= htmlspecialchars($username); ?>">
                <div class="field-error" style="color: red;"><?= htmlspecialchars($errors['name'] ?? ''); ?></div>

                <!-- Email -->
                <label for="reg_email">Email</label>
                <input id="reg_email" name="reg_email" type="email" value="<?= htmlspecialchars($email); ?>">
                <div class="field-error" style="color: red;"><?= htmlspecialchars($errors['email'] ?? ''); ?></div>

                <!-- Password -->
                <label for="reg_password">Password</label>
                <input id="reg_password" name="reg_password" type="password">
                <div class="field-error" style="color: red;"><?= htmlspecialchars($errors['password'] ?? ''); ?></div>

                <!-- Confirm Password -->
                <label for="reg_confirm">Confirm Password</label>
                <input id="reg_confirm" name="reg_confirm" type="password">
                <div class="field-error" style="color: red;"><?= htmlspecialchars($errors['confirm'] ?? ''); ?></div>

                <?php if (!empty($errors['general'])): ?>
                    <div class="field-error" style="color: red; margin-top: 5px;"><?= htmlspecialchars($errors['general']); ?></div>
                <?php endif; ?>

                <br>
                <button type="submit">Create Account</button>
                <p><a href="login.php">Already have an account? Log in</a></p>
            </form>
        </div>
    </div>
</body>
</html>