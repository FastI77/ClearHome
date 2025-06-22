<?php
session_start();
require_once "connect/connect.php";
?>
<head>
    <style>
        header {
            background: #fff;
            padding: 20px 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            position: relative;
            z-index: 100;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .logo {
            height: 50px;
            transition: transform 0.3s ease;
        }

        .logo:hover {
            transform: scale(1.05);
        }

        nav {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        nav a {
            text-decoration: none;
            color: #555;
            font-weight: 600;
            font-size: 16px;
            transition: all 0.3s ease;
            padding: 8px 12px;
            border-radius: 4px;
            white-space: nowrap;
        }

        nav a:hover {
            color: #fff;
            background: #1e88e5;
            transform: translateY(-2px);
        }

        .user-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgb(134, 134, 134);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            margin-left: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            overflow: hidden;
            position: relative; /* Добавлено для правильного позиционирования */
        }

        .user-icon-text {
            font-size: 20px; /* Размер текста для буквы */
            line-height: 1;
        }

        .user-icon-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            position: absolute;
            top: 0;
            left: 0;
        }

        .user-icon:hover {
            transform: scale(1.1);
        }

        .user-icon img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                gap: 15px;
            }
            
            nav {
                width: 100%;
                justify-content: center;
                flex-wrap: wrap;
            }
            
            .user-icon {
                margin-left: 0;
            }
        }
    </style>
</head>
<header>
    <div class="header-container">
        <a href="/about.php">
            <img src="/images/logo.svg" alt="Логотип ЧистыйДом" class="logo">
        </a>
        <nav>
            <a href="/about.php">О компании</a>
            <a href="/services.php">Услуги</a>
            <a href="#">Заказать уборку</a>
            <a href="/reviews.php">Отзывы</a>
            <a href="#">Контакты</a>
            <?php
            if (isset($_SESSION['user_id'])) {
                // Получаем данные пользователя из базы
                $user_id = $_SESSION['user_id'];
                $query = "SELECT login FROM users WHERE id = ?";
                $stmt = mysqli_prepare($connect, $query);
                mysqli_stmt_bind_param($stmt, "i", $user_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $user = mysqli_fetch_assoc($result);
                mysqli_stmt_close($stmt);
                
                // Пользователь авторизован - буква
                $first_letter = mb_strtoupper(mb_substr($user['login'], 0, 1));
                echo '<a href="clearprofile.php" class="user-icon"><span class="user-icon-text">'.$first_letter.'</span></a>';
            } else {
                // Пользователь не авторизован - иконка
                echo '<a href="clearregistr.php" class="user-icon"><img src="/images/unknown.png" alt="Войти" class="user-icon-image"></a>';
            }
            ?>
        </nav>
    </div>
</header>