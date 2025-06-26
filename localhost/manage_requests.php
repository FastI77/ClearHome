<?php
session_start();
require_once "connect/connect.php";

if ((!isset($_SESSION['admin']) || !$_SESSION['admin']) && (!isset($_SESSION['manager']) || !$_SESSION['manager'])) {
    header("Location: clearprofile.php");
    exit;
}

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['change_status'])) {
    $request_id = (int)$_POST['request_id'];
    $new_status = mysqli_real_escape_string($connect, $_POST['new_status']);

    $query = "UPDATE cleaning_requests SET status = ? WHERE id = ?";
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, "si", $new_status, $request_id);
    
    if (mysqli_stmt_execute($stmt)) {
        $success = "Статус заявки успешно обновлен";
    } else {
        $errors[] = "Ошибка при обновлении статуса: " . mysqli_error($connect);
    }
    mysqli_stmt_close($stmt);
}

$requests_query = "SELECT * FROM cleaning_requests ORDER BY id ASC";
$requests_result = mysqli_query($connect, $requests_query);
$requests = mysqli_fetch_all($requests_result, MYSQLI_ASSOC);

$statuses = ['new', 'in_progress', 'completed', 'cancelled'];
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление заявками</title>
    <link rel="stylesheet" href="/style/manage_requests.css">
</head>
<body>
    <main>
        <div class="admin-container">
            <h1>Управление заявками</h1>
            
            <div class="admin-menu">
                <?php if (isset($_SESSION['admin']) && $_SESSION['admin']): ?>
                    <a href="admin_panel.php">Назад в админ панель</a>
                <?php endif; ?>
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

            <h2>Список заявок</h2>
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Тип здания</th>
                            <th>Тип уборки</th>
                            <th>Площадь (м²)</th>
                            <th>Цена (руб)</th>
                            <th>Имя клиента</th>
                            <th>Телефон</th>
                            <th>Email</th>
                            <th>Дата создания</th>
                            <th>Статус</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($requests as $request): ?>
                        <tr>
                            <td><?= $request['id'] ?></td>
                            <td><?= htmlspecialchars($request['building_type'] ?? 'не указано') ?></td>
                            <td><?= htmlspecialchars($request['repair_type'] ?? 'не указано') ?></td>
                            <td><?= $request['area'] ?></td>
                            <td><?= number_format($request['estimated_price'], 0, '', ' ') ?></td>
                            <td><?= htmlspecialchars(mb_substr($request['name'], 0, 15)) ?></td>
                            <td><?= htmlspecialchars($request['phone']) ?></td>
                            <td><?= htmlspecialchars(mb_substr($request['email'] ?? '-', 0, 15)) ?></td>
                            <td><?= date('d.m.y H:i', strtotime($request['created_at'])) ?></td>
                            <td class="status-<?= $request['status'] ?>">
                                <?= match($request['status']) {
                                    'new' => 'Новая',
                                    'in_progress' => 'В работе',
                                    'completed' => 'Завершена',
                                    'cancelled' => 'Отменена',
                                    default => $request['status']
                                } ?>
                            </td>
                            <td>
                                <form class="action-form" method="post">
                                    <input type="hidden" name="request_id" value="<?= $request['id'] ?>">
                                    <select name="new_status">
                                        <?php foreach ($statuses as $status): ?>
                                            <option value="<?= $status ?>" <?= $request['status'] === $status ? 'selected' : '' ?>>
                                                <?= match($status) {
                                                    'new' => 'Новая',
                                                    'in_progress' => 'В работе',
                                                    'completed' => 'Завершена',
                                                    'cancelled' => 'Отменена'
                                                } ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="submit" name="change_status" class="submit-btn">Изменить</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
</body>
</html>