<?php 
session_start();

if (!isset($_POST['name']) && !isset($_POST['phone'])) {
    unset($_SESSION['form_error']);
    unset($_SESSION['form_success']);
    unset($_SESSION['form_values']);
}
?>
<?php
if (isset($_SESSION['error'])) {
    echo '<div class="error-message">' . htmlspecialchars($_SESSION['error']) . '</div>';
    unset($_SESSION['error']);
}
if (isset($_SESSION['success'])) {
    echo '<div class="success-message">' . htmlspecialchars($_SESSION['success']) . '</div>';
    unset($_SESSION['success']);
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Чистый дом</title>
    <link rel="stylesheet" href="/style/index.css">
    <style>
        .form-message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }

        .form-message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .form-message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .form-message {
            animation: fadeIn 0.3s ease-out;
        }

        .form-container .success + form {
            display: none;
        }
    </style>
</head>
<body>

    <?php require_once "header/header.php"; ?>

    <section class="hero">
        <div class="container hero-content">
            <div class="hero-text">
                <h1>Компания "Чистый дом"</h1>
                <p>Профессиональные услуги уборки для вашего дома и бизнеса. Наши специалисты — ваша чистота и комфорт!</p>
                <p>Мы предлагаем широкий спектр услуг по поддерживающей, генеральной и послеремонтной уборке, химчистке мебели и выносу мусора. Используем современные методы и экологичные средства.</p>
            </div>
            <div class="form-container">
                <div class="form-header">
                    <div class="form-title">Оставить заявку</div>
                    <div class="form-subtitle">Отправим КП за 30 мин.</div>
                </div>
                
                <?php if (isset($_SESSION['form_error'])): ?>
                    <div class="form-message error"><?= htmlspecialchars($_SESSION['form_error']) ?></div>
                    <?php unset($_SESSION['form_error']); ?>
                <?php endif; ?>
                
                <?php if (isset($_SESSION['form_success'])): ?>
                    <div class="form-message success"><?= htmlspecialchars($_SESSION['form_success']) ?></div>
                    <?php 
                        unset($_SESSION['form_success']);
                        unset($_SESSION['form_values']);
                    ?>
                <?php else: ?>
                    <form action="submit_request.php" method="POST">
                        <div class="form-group">
                            <input type="text" id="name" name="name" placeholder="Имя" required 
                                value="<?= isset($_SESSION['form_values']['name']) ? htmlspecialchars($_SESSION['form_values']['name']) : '' ?>"/>
                        </div>
                        <div class="form-group">
                            <input type="email" id="email" name="email" placeholder="Почта"
                                value="<?= isset($_SESSION['form_values']['email']) ? htmlspecialchars($_SESSION['form_values']['email']) : '' ?>"/>
                        </div>
                        <div class="form-group">
                            <input type="tel" id="phone" name="phone" placeholder="+7 (999) 999-99-99" required
                                value="<?= isset($_SESSION['form_values']['phone']) ? htmlspecialchars($_SESSION['form_values']['phone']) : '' ?>"/>
                        </div>
                        <button type="submit" class="submit-btn">Отправить</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="offers">
        <div class="container">
            <h2>Актуальные акции и предложения</h2>
            <div class="slider">
                <div class="slider-track">
                    <div class="slide">
                        <img src="images/offer1.jpg" alt="Химчистка напольных покрытий">
                        <p>Химчистка напольных покрытий
                            всего 60 руб/м²(действует от 20 м²)
                        </p>
                    </div>
                    <div class="slide">
                        <img src="images/offer2.jpg" alt="Поддерживающая уборка">
                        <p>Поддерживающая уборка
                            всего 15 руб/м²(действует от 30 м²)
                        </p>
                    </div>
                    <div class="slide">
                        <img src="images/offer3.jpg" alt="Вынос мусора">
                        <p>Вынос мусора
                            всего за 500 руб/смена (действует до 01.01.2026)
                        </p>
                    </div>
                </div>
                <button class="slider-btn prev">&#10094;</button>
                <button class="slider-btn next">&#10095;</button>
                <div class="slider-dots">
                    <span class="dot active"></span>
                    <span class="dot"></span>
                    <span class="dot"></span>
                </div>
            </div>
        </div>
    </section>

    <section class="why-us">
        <div class="container">
            <h2>Почему выбирают нас</h2>
            <div class="why-us-content">
                <div class="why-us-block">
                    <h3>Профессиональная уборка бизнес-центров</h3>
                    <ul>
                        <li>Использование только экологичных средств</li>
                        <li>Весь персонал проходит обучение</li>
                        <li>Контроль качества на каждом этапе</li>
                        <li>Гибкая система скидок для постоянных клиентов</li>
                    </ul>
                </div>
                <div class="why-us-block">
                    <h3>Персонал</h3>
                    <ul>
                        <li>Вежливые и опрятные сотрудники</li>
                        <li>Стаж работы от 2 лет</li>
                        <li>Постоянное повышение квалификации</li>
                        <li>Ответственность и пунктуальность</li>
                    </ul>
                </div>
                <div class="why-us-block">
                    <h3>Контроль качества</h3>
                    <ul>
                    <li>Мы тщательно следим за качеством предоставляемых услуг и всегда готовы учесть ваши пожелания.</li>
                    <ul>
                </div>
               
            </div>
        </div>
    </section>

    <section class="reviews">
        <div class="container">
            <h2>Отзывы наших клиентов</h2>
            <div class="reviews-grid">
                <div class="review">
                    <div class="rating">★★★★★</div>
                    <div class="author">Илья.Ф</div>
                    <p>Идеальная чистота! Огромное спасибо компании «Чистый Дом» за безупречную уборку! Заказывали генеральную уборку после ремонта — квартира засияла, как новая. Мастера работали быстро, аккуратно и с вниманием к деталям.</p>
                </div>
                
                <div class="review">
                    <div class="rating">★★★★★</div>
                    <div class="author">Андрей.К</div>
                    <p>Пользуюсь услугами «Чистого Дома» уже полгода — раз в неделю убирают мою квартиру. Всегда пунктуальны, вежливы и делают работу на 100%. Очень нравится, что можно выбрать удобное время.</p>
                </div>
                
                <div class="review">
                    <div class="rating">★★★★★</div>
                    <div class="author">Юлия.М</div>
                    <p>Я работаю без выходных, и убираться самой просто нет времени. «Чистый Дом» стал для меня настоящим спасением! Раз в две недели приезжают, моют всё от пола до потолка, даже окна протирают. Ни разу не было нареканий — всё идеально.</p>
                </div>
            </div>
            <div class="read-all-reviews">
                <a href="reviews.php" class="read-all-btn">Читать все отзывы</a>
            </div>
        </div>
    </section>

    <section class="services">
        <div class="container">
            <h2>Популярные услуги</h2>
            <table>
                <tr>
                    <th>Вид услуги</th>
                    <th>Стоимость (руб/м²)</th>
                </tr>
                <tr>
                    <td>Поддерживающая уборка</td>
                    <td>от 19 руб/м²</td>
                </tr>
                <tr>
                    <td>Генеральная уборка</td>
                    <td>от 62 руб/м²</td>
                </tr>
                <tr>
                    <td>Уборка после ремонта</td>
                    <td>от 70 руб/м²</td>
                </tr>
                <tr>
                    <td>Химчистка напольных покрытий</td>
                    <td>от 95 руб/м²</td>
                </tr>
                <tr>
                    <td>Уход за тканями и твердыми покрытиями</td>
                    <td>от 15 руб/м²</td>
                </tr>
                <tr>
                    <td>Мойка витрин и фасадов</td>
                    <td>от 60 руб/м²</td>
                </tr>
                <tr>
                    <td>Вынос мусора и отходов</td>
                    <td>от 600 руб/смена</td>
                </tr>
            </table>
        </div>
    </section>

    <section class="calculator">
        <div class="container">
            <h2>Рассчитать стоимость уборки</h2>
            <form class="calc-form" id="calculatorForm">
                <select id="serviceSelect" required>
                    <option value="">Выберите услугу</option>
                    <option value="19">Поддерживающая уборка - 19 руб/м²</option>
                    <option value="62">Генеральная уборка - 62 руб/м²</option>
                    <option value="70">Уборка после ремонта - 70 руб/м²</option>
                    <option value="95">Химчистка напольных покрытий - 95 руб/м²</option>
                    <option value="15">Уход за тканями и твердыми покрытиями - 15 руб/м²</option>
                    <option value="60">Мойка витрин и фасадов - 60 руб/м²</option>
                    <option value="600">Вынос мусора и отходов - 600 руб/смена</option>
                </select>
                <input type="number" id="areaInput" placeholder="Площадь, м²" min="1" required>
                <div class="calc-result">
                    <span>Стоимость: </span>
                    <span id="totalPrice">0 руб.</span>
                </div>
                
            </form>
        </div>
    </section>

    <div class="footer" id="footer">
        <div class="container footer-container">
            <div class="footer-map">
                <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3Aefbc37965e446ebce291967416d4505a71b532e3457901ad43887a2cd30dfdf3&amp;width=900&amp;height=360&amp;lang=ru_RU&amp;scroll=true"></script>
            </div>
            <div class="footer-contacts">
                <p>Наши контакты:<br>
                +7(999)999-99-99<br>
                +7(888)888-88-88<br>
                Cleanedome1@mail.ru</p>
            </div>
            <div class="footer-dev">
                Разработчики: Власов Артемий ДИС 232.3/21, Желтышев Илья Дис 232.2/21, Батршин Айдар Дис 232/21.Б, Матвеев Павел Дис 232/21.Б
            </div>
        </div>
        <div class="footer-bottom">
            <?php include "footer/footer.php"; ?>
        </div>
    </div>
    <script>
        const track = document.querySelector('.slider-track');
        const slides = document.querySelectorAll('.slide');
        const prevBtn = document.querySelector('.slider-btn.prev');
        const nextBtn = document.querySelector('.slider-btn.next');
        const dots = document.querySelectorAll('.dot');
        let current = 0;
        
        function showSlide(index) {
            if (index < 0) index = slides.length - 1;
            if (index >= slides.length) index = 0;
            track.style.transform = `translateX(-${index * 100}%)`;
            dots.forEach(dot => dot.classList.remove('active'));
            dots[index].classList.add('active');
            current = index;
        }
        
        prevBtn.onclick = () => showSlide(current - 1);
        nextBtn.onclick = () => showSlide(current + 1);
        dots.forEach((dot, idx) => {
            dot.onclick = () => showSlide(idx);
        });
        
        let auto = setInterval(() => showSlide(current + 1), 5000);
        track.onmouseenter = () => clearInterval(auto);
        track.onmouseleave = () => auto = setInterval(() => showSlide(current + 1), 5000);
        
        showSlide(0);
        
        const calculatorForm = document.getElementById('calculatorForm');
        const serviceSelect = document.getElementById('serviceSelect');
        const areaInput = document.getElementById('areaInput');
        const totalPrice = document.getElementById('totalPrice');
        
        function calculatePrice() {
            const servicePrice = parseFloat(serviceSelect.value);
            const area = parseFloat(areaInput.value);
            
            if (servicePrice && area) {
                let total;
                if (serviceSelect.value === '600') {
                    total = servicePrice;
                } else {
                    total = servicePrice * area;
                }
                totalPrice.textContent = `${total.toLocaleString('ru-RU')} руб.`;
            } else {
                totalPrice.textContent = '0 руб.';
            }
        }
        
        serviceSelect.addEventListener('change', calculatePrice);
        areaInput.addEventListener('input', calculatePrice);
        
        calculatorForm.addEventListener('submit', function(e) {
            e.preventDefault();
            calculatePrice();
        });
    </script>
</body>
</html>