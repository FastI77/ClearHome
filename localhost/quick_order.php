<?php
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = isset($_POST['name']) ? trim($_POST['name']) : '';
    $phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    
    if (empty($name) || empty($phone)) {
        header('Location: /contact.php?error=empty_fields');
        exit();
    }

    try {
        $sql = "INSERT INTO cleaning_requests 
                (name, phone, email, status, request_type, created_at) 
                VALUES 
                (:name, :phone, :email, 'new', 'callback', NOW())";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        
        header('Location: /contact.php?success=1');
        exit();
        
    } catch (PDOException $e) {
        error_log("Order error: " . $e->getMessage());
        header('Location: /contact.php?error=db_error');
        exit();
    }
} else {
    header('Location: /contact.php');
    exit();
}
?>