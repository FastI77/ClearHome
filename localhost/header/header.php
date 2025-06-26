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
            position: relative;
        }

        .user-icon-text {
            font-size: 20px;
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

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
            margin-bottom: 15px;
            background: #f7fafd;
            transition: border 0.2s;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border: 1px solid #1e90ff;
            outline: none;
        }

        .form-header {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .form-container {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.12);
            padding: 32px 24px;
            max-width: 400px;
            margin: 0 auto;
        }

        .submit-btn {
            width: 100%;
            background: #1e90ff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 14px 0;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.2s;
        }

        .submit-btn:hover {
            background: #0077cc;
        }

        .contacts-row {
            display: flex;
            justify-content: center;
            align-items: stretch;
            gap: 48px;
            margin: 0 auto;
            max-width: 900px;
            padding: 40px 32px 32px 32px;
            background: #fff;
            border-radius: 22px;
            box-shadow: 0 8px 32px rgba(102, 126, 234, 0.10), 0 1.5px 8px rgba(76, 198, 183, 0.08);
        }

        .contacts-info {
            width: 350px;
            max-width: 350px;
            font-size: 16px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .contacts-card {
            flex: 1 1 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: none;
            box-shadow: none;
            border-radius: 0;
            padding: 0;
            margin: 0;
            min-width: 320px;
            max-width: 400px;
        }

        @media (max-width: 900px) {
            .contacts-row {
                flex-direction: column;
                align-items: center;
                gap: 32px;
                padding: 18px 6px 18px 6px;
                max-width: 100%;
            }
            .contacts-info, .contacts-card {
                max-width: 100%;
                width: 100%;
            }
        }
    </style>
    <link rel="stylesheet" href="/styles/contacts.css">
    <link rel="stylesheet" href="/style/order.css">
    <link rel="stylesheet" href="/style/forms.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="/styles/animations.css">
    <!-- <script src="/scripts/main.js" defer></script>
    <script src="/scripts/calculator.js" defer></script>
    <script src="/scripts/main.s" defer></script>
    <script src="/scripts/calculator.js" defer></script> -->
</head>
<header>
    <div class="header-container">
        <a href="/index.php">
            <img src="/images/logo.svg" alt="Логотип ЧистыйДом" class="logo">
        </a>
        <nav>
            <a href="/about.php">О компании</a>
            <a href="/services.php">Услуги</a>
            <a href="/order.php">Заказать уборку</a>
            <a href="/reviews.php">Отзывы</a>
            <a href="/contacts.php">Контакты</a>
            <?php
            if (isset($_SESSION['user_id'])) {

                $user_id = $_SESSION['user_id'];
                $query = "SELECT login FROM users WHERE id = ?";
                $stmt = mysqli_prepare($connect, $query);
                mysqli_stmt_bind_param($stmt, "i", $user_id);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                $user = mysqli_fetch_assoc($result);
                mysqli_stmt_close($stmt);
                
                $first_letter = mb_strtoupper(mb_substr($user['login'], 0, 1));
                echo '<a href="clearprofile.php" class="user-icon"><span class="user-icon-text">'.$first_letter.'</span></a>';
            } else {
                echo '<a href="clearregistr.php" class="user-icon"><img src="/images/unknown.png" alt="Войти" class="user-icon-image"></a>';
            }
            ?>
        </nav>
    </div>
</header>