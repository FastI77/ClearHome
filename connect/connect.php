<?php
$host = 'localhost'; // или ваш хост
$dbname = 'clearhome';
$username = 'root'; // или ваш пользователь БД
$password = ''; // или ваш пароль

// Создаем соединение с MySQLi (для файлов, использующих MySQLi)
$connect = mysqli_connect($host, $username, $password, $dbname);
if (!$connect) {
    die("MySQLi connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($connect, "utf8mb4");

// Создаем соединение с PDO (для файлов, использующих PDO)
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("PDO connection failed: " . $e->getMessage());
}
?>