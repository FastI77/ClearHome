<?php
session_start();
require_once "connect/connect.php";

// Проверка прав администратора
if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header("Location: clearprofile.php");
    exit;
}

// Получаем статистику из базы данных
$usersCount = $pdo->query("SELECT COUNT(*) FROM users")->fetchColumn();
$requestsCount = $pdo->query("SELECT COUNT(*) FROM cleaning_requests")->fetchColumn();
$activeRequests = $pdo->query("SELECT COUNT(*) FROM cleaning_requests WHERE status = 'new'")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ панель</title>
    <link rel="stylesheet" href="style/admin_panel.css">
</head>
<body>
    <div class="admin-container">
        <h1>Админ панель</h1>
        
        <div class="admin-menu">
            <a href="manage_users.php">Управление пользователями</a>
            <a href="manage_requests.php">Управление заявками</a>
            <a href="clearprofile.php">Вернуться в профиль</a>
        </div>
        
        <h2>Статистика</h2>
        <div class="stats">
            <p>Всего пользователей: <?= $usersCount ?></p>
            <p>Всего заявок: <?= $requestsCount ?></p>
            <p>Новых заявок: <?= $activeRequests ?></p>
        </div>
    </div>
</body>
</html>