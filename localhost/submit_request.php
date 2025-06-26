<?php
session_start();
require_once "connect/connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    
    if (empty($name) || empty($phone)) {
        $_SESSION['form_error'] = 'Пожалуйста, заполните обязательные поля (Имя и Телефон)';
    } else {
        $query = "INSERT INTO cleaning_requests (name, phone, email, status, created_at) 
                  VALUES (?, ?, ?, 'new', NOW())";
        $stmt = mysqli_prepare($connect, $query);
        mysqli_stmt_bind_param($stmt, "sss", $name, $phone, $email);
        
        if (mysqli_stmt_execute($stmt)) {
            $_SESSION['form_success'] = 'Ваша заявка успешно отправлена! Мы свяжемся с вами в ближайшее время.';
        } else {
            $_SESSION['form_error'] = 'Ошибка при отправке заявки. Пожалуйста, попробуйте позже.';
        }
        mysqli_stmt_close($stmt);
    }
    
    $_SESSION['form_values'] = [
        'name' => $name,
        'email' => $email,
        'phone' => $phone
    ];
    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit;
}
    $building_type = isset($_POST['building_type']) ? trim($_POST['building_type']) : null;
    $repair_type = isset($_POST['repair_type']) ? trim($_POST['repair_type']) : null;

    $query = "INSERT INTO cleaning_requests (name, phone, email, building_type, repair_type, status, created_at) 
            VALUES (?, ?, ?, ?, ?, 'new', NOW())";
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, "sssss", $name, $phone, $email, $building_type, $repair_type);
?>