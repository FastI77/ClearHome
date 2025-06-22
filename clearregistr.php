<?php
require_once "connect/connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm-password'] ?? '';
    
    // Валидация данных
    $errors = [];
    
    if (empty($username)) {
        $errors[] = "Введите логин";
    } elseif (strlen($username) > 50) {
        $errors[] = "Логин должен быть не длиннее 50 символов";
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Введите корректный email";
    } elseif (strlen($email) > 100) {
        $errors[] = "Email должен быть не длиннее 100 символов";
    }
    
    $phone = preg_replace('/[^0-9]/', '', $phone);
    if (empty($phone) || strlen($phone) < 10) {
        $errors[] = "Введите корректный номер телефона";
    }
    
    if (empty($password)) {
        $errors[] = "Введите пароль";
    } elseif (strlen($password) < 6) {
        $errors[] = "Пароль должен содержать минимум 6 символов";
    } elseif ($password !== $confirm_password) {
        $errors[] = "Пароли не совпадают";
    }
    
    if (empty($errors)) {
        // Проверка существования пользователя
        $check_query = "SELECT id FROM users WHERE login = ? OR email = ?";
        $stmt = mysqli_prepare($connect, $check_query);
        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        
        if (mysqli_stmt_num_rows($stmt) > 0) {
            $errors[] = "Пользователь с таким логином или email уже существует";
        } else {
            // Регистрация пользователя
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            $insert_query = "INSERT INTO users (login, email, phone, password) VALUES (?, ?, ?, ?)";
            $stmt = mysqli_prepare($connect, $insert_query);
            mysqli_stmt_bind_param($stmt, "ssss", $username, $email, $phone, $hashed_password);
            
            if (mysqli_stmt_execute($stmt)) {
                header("Location: clearlogin.php?registered=1");
                exit;
            } else {
                $errors[] = "Ошибка при регистрации: " . mysqli_error($connect);
            }
        }
        mysqli_stmt_close($stmt);
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link rel="stylesheet" href="/style/registr.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-image: url('/images/reg.phg');
        }
    </style>
</head>
<body>
    <?php require_once "header/header.php"; ?>
    <section class="main">
        <h1>Регистрация</h1>
        <div class="registration-container">
            <?php if (!empty($errors)): ?>
                <div class="error-message">
                    <?php foreach ($errors as $error): ?>
                        <p><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <form action="" method="post">
                <div class="form-group">
                    <label for="username">Введите логин</label>
                    <input type="text" id="username" name="username" required placeholder="Ваше имя">
                </div>
                
                <div class="form-group">
                    <label for="email">Введите ваш Email</label>
                    <input type="email" id="email" name="email" required placeholder="example@gmail.com">
                </div>
                
                <div class="form-group">
                    <label for="phone">Введите ваш номер телефона</label>
                    <input type="tel" id="phone" name="phone" required placeholder="+7 (XXX) XXX-XX-XX">
                </div>
                
                <div class="form-group">
                    <label for="password">Введите пароль</label>
                    <input type="password" id="password" name="password" required placeholder="Пароль">
                </div>
                
                <div class="form-group">
                    <label for="confirm-password">Повторите пароль</label>
                    <input type="password" id="confirm-password" name="confirm-password" required placeholder="Повторите пароль">
                </div>
                
                <button type="submit" class="submit-btn">Зарегистрироваться</button>
            </form>
            
            <div class="login-link">
                Есть аккаунт? <a href="clearlogin.php">Войти</a>
            </div>
        </div>
    </section>
</body>
</html>