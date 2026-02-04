<?php
session_start();
require_once 'lidhja.php';

$message = "";

if (isset($_GET['success'])) {
    $message = "Llogaria u krijua me sukses! Ju lutem logohuni.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $lidhja->real_escape_string($_POST['username']);
    $password = $_POST['password'];

    $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
    $result = $lidhja->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            $message = "Fjalekalim i gabuar!";
        }
    } else {
        $message = "Perdoruesi nuk ekziston!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - HR System</title>
    <link rel="stylesheet" href="style.css">
</head>

<body class="auth-page">
    <div class="auth-container">
        <form action="login.php" method="POST" class="auth-form">
            <h1>Miresevini Perseri</h1>
            <?php if ($message): ?>
                <div class="alert <?php echo isset($_GET['success']) ? 'alert-success' : 'alert-danger'; ?>">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
            <div class="form-group">
                <label for="username">Perdoruesi</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Fjalekalimi</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn-primary">Login</button>
            <p>Nuk keni llogari? <a href="register.php">Regjistrohu ketu</a></p>
        </form>
    </div>
</body>

</html>