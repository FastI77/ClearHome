<?php
session_start();
require_once "connect/connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $query = "SELECT * FROM users WHERE login = ?";
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $user = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['admin'] = $user['is_admin'];
        $_SESSION['manager'] = $user['is_manager'];
        
        header("Location: clearprofile.php");
        exit;
    } else {
        $error = "Неверный логин или пароль";
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link rel="stylesheet" href="/style/header.css">
    <link rel="stylesheet" href="/style/login.css">
</head>
<body>
    <?php require_once "header/header.php"; ?>
    <section class="main">
        <h1>Вход</h1>
        <div class="login-container">
            <?php if (!empty($error)): ?>
                <div class="error-message"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>
            
            <form action="#" method="post">
                <div class="form-group">
                    <label for="username">Введите логин</label>
                    <input type="text" id="username" name="username" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Введите пароль</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <button type="submit" class="login-btn">Войти</button>
            </form>
            
            <div class="register-link">
                Нету аккаунта? <a href="clearregistr.php">Зарегистрироваться</a>
            </div>
        </div>
    </section>
</body>
</html>