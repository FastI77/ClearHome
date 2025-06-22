<?php
session_start();
require_once "connect/connect.php";

// Проверка авторизации
if (!isset($_SESSION['user_id'])) {
    header("Location: bathlogin.php");
    exit;
}

// Получение текущих данных пользователя
$stmt = $pdo->prepare("SELECT id, login, email, phone, is_admin, is_manager FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch();

if (!$user) {
    session_destroy();
    header("Location: bathlogin.php");
    exit;
}

$errors = [];
$success = false;

// Обработка формы
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $new_password = $_POST['new_password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Валидация email
    if (empty($email)) {
        $errors[] = "Email обязателен для заполнения";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Введите корректный email";
    }

    // Валидация телефона
    $phone = preg_replace('/[^0-9]/', '', $phone);
    if (empty($phone) || strlen($phone) < 10) {
        $errors[] = "Введите корректный номер телефона";
    }

    // Валидация пароля (если изменяется)
    if (!empty($new_password)) {
        if (strlen($new_password) < 6) {
            $errors[] = "Пароль должен содержать минимум 6 символов";
        } elseif ($new_password !== $confirm_password) {
            $errors[] = "Пароли не совпадают";
        }
    }

    // Если ошибок нет - обновляем данные
    if (empty($errors)) {
        try {
            // Подготовка данных для обновления
            $updateData = [
                'email' => $email,
                'phone' => $phone,
                'id' => $_SESSION['user_id']
            ];

            $sql = "UPDATE users SET email = :email, phone = :phone";

            // Если указан новый пароль
            if (!empty($new_password)) {
                $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
                $sql .= ", password = :password";
                $updateData['password'] = $hashed_password;
            }

            $sql .= " WHERE id = :id";

            $stmt = $pdo->prepare($sql);
            $stmt->execute($updateData);

            $success = true;
            // Обновляем данные в переменной $user
            $user['email'] = $email;
            $user['phone'] = $phone;
        } catch (PDOException $e) {
            $errors[] = "Ошибка при обновлении данных: " . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование профиля</title>
    <link rel="stylesheet" href="/style/edit_profile.css">
</head>
<body>
    <main>
        <h1>Редактирование профиля</h1>
        
        <?php if (!empty($errors)): ?>
            <div class="error-message">
                <?php foreach ($errors as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="success-message">
                <p>Данные успешно обновлены!</p>
            </div>
        <?php endif; ?>
        
        <form action="" method="post">
            <div class="form-group">
                <label for="login">Логин</label>
                <input type="text" id="login" value="<?= htmlspecialchars($user['login']) ?>" readonly>
            </div>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="phone">Телефон</label>
                <input type="tel" id="phone" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" required>
            </div>
            
            <div class="form-group">
                <label for="new_password">Новый пароль (оставьте пустым, если не хотите менять)</label>
                <input type="password" id="new_password" name="new_password">
            </div>
            
            <div class="form-group">
                <label for="confirm_password">Подтвердите новый пароль</label>
                <input type="password" id="confirm_password" name="confirm_password">
            </div>
            
            <div class="actions">
                <a href="clearprofile.php" class="action-btn cancel-btn">Отмена</a>
                <button type="submit" class="action-btn">Сохранить изменения</button>
            </div>
        </form>
    </main>

    <script>
        // Форматирование номера телефона
        document.getElementById('phone').addEventListener('input', function(e) {
            let x = e.target.value.replace(/\D/g, '').match(/(\d{0,1})(\d{0,3})(\d{0,3})(\d{0,2})(\d{0,2})/);
            e.target.value = !x[2] ? x[1] : x[1] + ' (' + x[2] + ') ' + x[3] + (x[4] ? '-' + x[4] : '') + (x[5] ? '-' + x[5] : '');
        });
    </script>
</body>
</html>