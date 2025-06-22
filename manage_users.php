<?php
session_start();
require_once "connect/connect.php";

// Только администраторы могут управлять пользователями
if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header("Location: clearprofile.php");
    exit;
}

$errors = [];
$success = '';

// Обработка добавления нового пользователя
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_user'])) {
    $login = trim($_POST['login'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $password = $_POST['password'] ?? '';
    $role = $_POST['role'] ?? 'user';

    // Валидация данных
    if (empty($login)) {
        $errors[] = "Логин обязателен";
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Введите корректный email";
    }
    
    if (empty($password) || strlen($password) < 6) {
        $errors[] = "Пароль должен содержать минимум 6 символов";
    }
    
    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $is_admin = ($role === 'admin') ? 1 : 0;
        $is_manager = ($role === 'manager') ? 1 : 0;
        
        $query = "INSERT INTO users (login, email, phone, password, is_admin, is_manager) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($connect, $query);
        mysqli_stmt_bind_param($stmt, "ssssii", $login, $email, $phone, $hashed_password, $is_admin, $is_manager);
        
        if (mysqli_stmt_execute($stmt)) {
            $success = "Пользователь успешно добавлен";
        } else {
            $errors[] = "Ошибка при добавлении пользователя: " . mysqli_error($connect);
        }
        mysqli_stmt_close($stmt);
    }
}

// Обработка удаления пользователя
if (isset($_GET['delete'])) {
    $user_id = (int)$_GET['delete'];
    if ($user_id > 0) {
        $query = "DELETE FROM users WHERE id = ?";
        $stmt = mysqli_prepare($connect, $query);
        mysqli_stmt_bind_param($stmt, "i", $user_id);
        
        if (mysqli_stmt_execute($stmt)) {
            $success = "Пользователь успешно удален";
        } else {
            $errors[] = "Ошибка при удалении пользователя: " . mysqli_error($connect);
        }
        mysqli_stmt_close($stmt);
    }
}

// Получение списка всех пользователей
$users_query = "SELECT id, login, email, phone, is_admin, is_manager FROM users ORDER BY id";
$users_result = mysqli_query($connect, $users_query);
$users = mysqli_fetch_all($users_result, MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление пользователями</title>
    <link rel="stylesheet" href="/style/manage_users.css">
</head>
<body>
    <main>
        <div class="admin-container">
            <h1>Управление пользователями</h1>
            
            <div class="admin-menu">
                <a href="admin_panel.php">Назад в админ панель</a>
                <a href="clearprofile.php">Вернуться в профиль</a>
            </div>

            <?php if (!empty($errors)): ?>
                <div class="message error-message">
                    <?php foreach ($errors as $error): ?>
                        <p><?= htmlspecialchars($error) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <?php if (!empty($success)): ?>
                <div class="message success-message">
                    <p><?= htmlspecialchars($success) ?></p>
                </div>
            <?php endif; ?>

            <h2>Добавить нового пользователя</h2>
            <form method="post">
                <div class="form-group">
                    <label for="login">Логин:</label>
                    <input type="text" id="login" name="login" required>
                </div>
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="phone">Телефон:</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                
                <div class="form-group">
                    <label for="password">Пароль:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                
                <div class="form-group">
                    <label for="role">Роль:</label>
                    <select id="role" name="role">
                        <option value="user">Пользователь</option>
                        <option value="manager">Менеджер</option>
                        <option value="admin">Администратор</option>
                    </select>
                </div>
                
                <button type="submit" name="add_user" class="submit-btn">Добавить пользователя</button>
            </form>

            <h2>Список пользователей</h2>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Логин</th>
                            <th>Email</th>
                            <th>Телефон</th>
                            <th>Роль</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td><?= htmlspecialchars($user['login']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['phone']) ?></td>
                            <td>
                                <?php if ($user['is_admin']): ?>
                                    <span class="role-admin">Администратор</span>
                                <?php elseif ($user['is_manager']): ?>
                                    <span class="role-manager">Менеджер</span>
                                <?php else: ?>
                                    <span class="role-user">Пользователь</span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="?delete=<?= $user['id'] ?>" class="action-btn delete-btn" 
                                   onclick="return confirm('Вы уверены, что хотите удалить этого пользователя?')">Удалить</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <script>
        // Форматирование номера телефона при вводе
        document.getElementById('phone').addEventListener('input', function(e) {
            let x = e.target.value.replace(/\D/g, '').match(/(\d{0,1})(\d{0,3})(\d{0,3})(\d{0,2})(\d{0,2})/);
            e.target.value = !x[2] ? x[1] : x[1] + ' (' + x[2] + ') ' + x[3] + (x[4] ? '-' + x[4] : '') + (x[5] ? '-' + x[5] : '');
        });
    </script>
</body>
</html>