<?php

$host = 'localhost';
$dbname = 'clearhome';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения к базе данных: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $service_type = isset($_POST['service_type']) ? trim($_POST['service_type']) : '';
    $area = isset($_POST['area']) ? (float)$_POST['area'] : 0;
    $rooms = isset($_POST['rooms']) ? (int)$_POST['rooms'] : 0;
    $order_date = isset($_POST['order_date']) ? trim($_POST['order_date']) : '';
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $comment = isset($_POST['comment']) ? trim($_POST['comment']) : '';

    $estimated_price = 0;
    if (strpos($service_type, 'Поддерживающая уборка') !== false) {
        $estimated_price = $area * 19;
    } elseif (strpos($service_type, 'Генеральная уборка') !== false) {
        $estimated_price = $area * 62;
    } elseif (strpos($service_type, 'Уборка после ремонта') !== false) {
        $estimated_price = $area * 70;
    } elseif (strpos($service_type, 'Химчистка напольных покрытий') !== false) {
        $estimated_price = $area * 95;
    } elseif (strpos($service_type, 'Уход за тканями и твердыми покрытиями') !== false) {
        $estimated_price = $area * 15;
    } elseif (strpos($service_type, 'Мойка витрин и фасадов') !== false) {
        $estimated_price = $area * 60;
    } elseif (strpos($service_type, 'Вынос мусора и отходов') !== false) {
        $estimated_price = 600; // фиксированная цена за смену
    }

    $sql = "INSERT INTO cleaning_requests 
            (service_type, area, estimated_price, name, phone, email, address, status, created_at) 
            VALUES 
            (:service_type, :area, :estimated_price, :name, :phone, :email, :comment, 'new', NOW())";

    try {
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':service_type', $service_type, PDO::PARAM_STR);
        $stmt->bindParam(':area', $area, PDO::PARAM_STR);
        $stmt->bindParam(':estimated_price', $estimated_price, PDO::PARAM_STR);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
        
        $stmt->execute();
        
        header('Location: /order_success.php');
        exit();
        
    } catch (PDOException $e) {
        die("Ошибка при сохранении заявки: " . $e->getMessage());
    }
} else {
    header('Location: /order.php');
    exit();
}
?>