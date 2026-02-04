<?php
require_once 'lidhja.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $lidhja->real_escape_string($_POST['username']);
    $email = $lidhja->real_escape_string($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $message = "Fjalekalimet nuk perputhen!";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

        if ($lidhja->query($sql) === TRUE) {
            header("Location: login.php?success=1");
            exit();
        } else {
            $message = "Gabim: " . $lidhja->error;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regjistrimi - HR System</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="auth-page">
    <div class="auth-container">
        <form action="register.php" method="POST" class="auth-form">
            <h1>Krijo Llogari</h1>
            <?php if ($message): ?>
                <div class="alert alert-danger">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="username">Perdoruesi</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Fjalekalimi</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Konfirmo Fjalekalimin</label>
                <input type="password" id="confirm_password" name="confirm_password" required>
            </div>
            <button type="submit" class="btn-primary">Regjistrohu</button>
            <p>Keni nje llogari? <a href="login.php">Login ketu</a></p>
        </form>
    </div>
</body>

</html>