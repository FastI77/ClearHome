<?php
session_start();
require_once "connect/connect.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: clearlogin.php");
    exit;
}

// Получаем данные пользователя
$query = "SELECT * FROM users WHERE id = ?";
$stmt = mysqli_prepare($connect, $query);
mysqli_stmt_bind_param($stmt, "i", $_SESSION['user_id']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$user) {
    session_destroy();
    header("Location: clearlogin.php");
    exit;
}

// Определяем роль пользователя из базы данных
$isAdmin = $user['is_admin'] == 1;
$isManager = $user['is_manager'] == 1;

// Получаем первую букву логина для аватара
$firstLetter = mb_strtoupper(mb_substr($user['login'], 0, 1));

// Безопасное получение email и телефона
$email = $user['email'] ?? 'Не указан';
$phone = $user['phone'] ?? 'Не указан';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Личный кабинет - <?= $isAdmin ? 'Администратор' : ($isManager ? 'Менеджер' : 'Пользователь') ?></title>
    <link rel="stylesheet" href="/style/profile.css">
</head>
<body>
    <?php require_once "header/header.php"; ?>
    <section class="main">
        <main>
            <div class="user-profile">
                <div class="user-avatar"><?= $firstLetter ?></div>
                <div class="user-info">
                    <h1>Здравствуйте, <?= htmlspecialchars($user['login']) ?></h1>
                    <div class="account-status">
                        Статус аккаунта: <span class="status-badge"><?= $isAdmin ? 'Администратор' : ($isManager ? 'Менеджер' : 'Пользователь') ?></span>
                    </div>
                    <?php if ($isAdmin): ?>
                        <a href="admin_panel.php" class="admin-panel-btn">Админ панель</a>
                    <?php elseif ($isManager): ?>
                        <a href="manage_requests.php" class="admin-panel-btn">Панель менеджера</a>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="account-details">
                <h2>Личные данные</h2>
                <div class="info-item">
                    <strong>Ваш логин</strong>
                    <?= htmlspecialchars($user['login']) ?>
                </div>
                
                <div class="info-item">
                    <strong>Ваш Email</strong>
                    <?= htmlspecialchars($email) ?>
                </div>
                
                <div class="info-item">
                    <strong>Телефон</strong>
                    <?= htmlspecialchars($phone) ?>
                </div>
                
                <div class="info-item">
                    <strong>Пароль</strong>
                    ••••••••
                </div>
            </div>
                        
            <div class="actions">
                <a href="edit_profile.php" class="action-btn">Изменить данные</a>
                <a href="logout.php" class="action-btn logout-btn">Выйти из аккаунта</a>
            </div>
            
            <?php if ($isAdmin || $isManager): ?>
            <div class="requests-history">
                <h2>История заявок</h2>
                <div class="table-container">
                    <?php
                    // Проверяем существование таблицы cleaning_requests
                    $table_check = mysqli_query($connect, "SHOW TABLES LIKE 'cleaning_requests'");
                    if (mysqli_num_rows($table_check) > 0) {
                        // Получаем заявки из базы данных
                        $requests_query = "SELECT * FROM cleaning_requests ORDER BY created_at DESC LIMIT 5";
                        $requests_result = mysqli_query($connect, $requests_query);
                        
                        if (mysqli_num_rows($requests_result) > 0): ?>
                            <table>
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Тип услуги</th>
                                        <th>Тип уборки</th>
                                        <th>Площадь (м²)</th>
                                        <th>Цена (руб)</th>
                                        <th>Дата</th>
                                        <th>Статус</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($requests_result)): ?>
                                    <tr>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= htmlspecialchars($row['service_type']) ?></td>
                                        <td><?= htmlspecialchars($row['cleaning_type']) ?></td>
                                        <td><?= $row['area'] ?></td>
                                        <td><?= number_format($row['estimated_price'], 0, '', ' ') ?></td>
                                        <td><?= date('d.m.Y', strtotime($row['created_at'])) ?></td>
                                        <td class="status-<?= $row['status'] ?>">
                                            <?= match($row['status']) {
                                                'new' => 'Новая',
                                                'in_progress' => 'В работе',
                                                'completed' => 'Завершена',
                                                'cancelled' => 'Отменена',
                                                default => $row['status']
                                            } ?>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        <?php else: ?>
                            <p>Нет заявок в базе данных.</p>
                        <?php endif;
                    } else {
                        echo '<p>Таблица заявок не найдена в базе данных.</p>';
                    }
                    ?>
                </div>
            </div>
            <?php endif; ?>
        </main>
    </section>
</body>
</html>