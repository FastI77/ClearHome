<head>
    <link rel="stylesheet" href="style/footer.css">
    <style>
        footer {
            background: rgb(0, 0, 0);
            color: white;
            padding: 40px 30px;
            position: relative;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
        }

        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }

        .footer-icons {
            display: flex;
            gap: 20px;
        }

        .icon-circle {
            width: 40px;
            height: 40px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(255,255,255,0.2);
        }

        .icon-circle:hover {
            background: #1e88e5;
            transform: translateY(-3px) scale(1.1);
            box-shadow: 0 5px 15px rgba(30, 136, 229, 0.4);
        }

        .icon-circle img {
            width: 20px;
            height: 20px;
            transition: all 0.3s ease;
            filter: brightness(0) invert(1);
        }

        footer p {
            font-size: 16px;
            margin: 0;
            opacity: 0.9;
        }

        @media (max-width: 768px) {
            .footer-content {
                flex-direction: column;
                text-align: center;
                gap: 20px;
            }
            
            footer p {
                order: 2;
            }
            
            .footer-icons {
                order: 1;
            }
        }
    </style>
</head>
<footer>
    <div class="footer-content">
        <p>© 2024 «ЧистыйДом». Все права защищены.</p>
        <div class="footer-icons">
            <div class="icon-circle">
                <img src="/images/telegram.svg" alt="Telegram">
            </div>
            <div class="icon-circle">
                <img src="/images/email.svg" alt="Email">
            </div>
            <div class="icon-circle">
                <img src="/images/whatsapp.svg" alt="WhatsApp">
            </div>
            <div class="icon-circle">
                <img src="/images/youtube.svg" alt="Youtube">
            </div>
        </div>
    </div>
</footer>

