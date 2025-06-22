<?php
session_start();
include "connect/connect.php";
?>
<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Клининговая компания</title>
    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: "Arial", sans-serif;
      }
      body {
        background-color: #eee;
      }
      .hero-image {
        width: 100%;
        height: 1080px;
        max-height: 100vh;
        background-image: url("images/background.png");
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        position: relative;
        margin-top: -1px; /* Убираем возможный зазор */
      }
      .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.3);
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        color: white;
        text-align: center;
        padding: 20px;
      }
      .hero-content {
        display: flex;
        gap: 20px;
      }
      .hero-content h1 {
        width: 40%;
        margin-bottom: 30px;
      }
      .hero-content p {
        width: 40%;
      }
      .services-container {
        max-width: 700px;
        margin: 0 auto;
      }

      /* Заголовок блока */
      .services-header {
        color: fff;
        padding: 30px;
        text-align: center;
      }

      .services-header h2 {
        font-size: 32px;
        font-weight: 600;
        line-height: 1.3;
        margin: 0;
      }

      /* Список услуг */
      .services-list {
        padding: 0 30px;
      }

      .service-item {
        display: flex;
        align-items: center;
        padding: 10px 0;
        font-size: 18px;
      }

      .form-container {
        background-color: white;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        padding: 40px;
        width: 100%;
        max-width: 400px;
        max-height: 420px;
      }

      .form-header {
        margin-bottom: 25px;
      }

      .form-title {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333;
      }

      .form-subtitle {
        font-size: 16px;
        color: #666;
      }

      .form-group {
        margin-bottom: 20px;
      }

      .form-group label {
        display: block;
        margin-bottom: 8px;
        font-size: 14px;
        color: #555;
      }

      .form-group input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 16px;
        box-sizing: border-box;
      }

      .submit-btn {
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        padding: 14px 20px;
        font-size: 16px;
        cursor: pointer;
        width: 100%;
        transition: background-color 0.3s;
      }

      .submit-btn:hover {
        background-color: #0056b3;
      }
      .content-block {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        margin-bottom: 50px;
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        margin: 100px 15%;
      }

      .text-section {
        flex: 1;
        min-width: 300px;
        padding: 0 20px;
      }

      .image-section {
        flex: 1;
        min-width: 300px;
        display: flex;
        justify-content: center;
        align-items: center;
      }

      .image-placeholder {
        width: 100%;
        height: 300px;
        border-radius: 8px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 18px;
      }
      .highlight {
        font-style: italic;
        color: #666;
        margin-top: 20px;
        font-size: 15px;
      }
      .text-section ul li {
        list-style-type: none;
      }
      .faq-container {
        background-color: rgb(255, 255, 255);
        padding: 30px;
        max-width: 700px;
        margin: 0 auto;
      }

      .faq-item {
        margin-bottom: 20px;
        border-bottom: 1px solid #eee;
        padding-bottom: 20px;
      }

      .faq-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
      }

      .faq-question {
        font-weight: bold;
        font-size: 18px;
        color: #000000;
        margin-bottom: 10px;
        position: relative;
        padding-left: 30px;
        cursor: pointer;
      }
      h1 {
        text-align: center;
        color: #000000;
        margin-bottom: 30px;
        font-size: 28px;
      }

      .faq-question:before {
        content: "•";
        color: #000000;
        font-size: 24px;
        position: absolute;
        left: 0;
        top: -3px;
      }

      .faq-answer {
        padding-left: 30px;
        color: #313131;
        display: none;
      }

      .faq-item.active .faq-answer {
        display: block;
      }
      .contacts-container {
        display: flex;
        width: 100%;
        margin-top: 20px;
      }

      .contacts-info {
        background-color: #19408a;
        padding: 30px;
        width: 40%;
      }

      .contacts-info h1 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #ffffff;
      }

      .contacts-info p {
        margin: 10px 0;
        font-size: 16px;
        line-height: 1.5;
        color: #fff;
      }

      .map-container {
        width: 60%;
        height: 400px;
      }
      .calculator {
        border: 1px solid #ddd;
        padding: 20px;
        border-radius: 8px;
        margin: 40px auto;
        max-width: 600px;
        background-color: #fff;
      }
      .form-group {
        margin-bottom: 15px;
      }
      .calculator label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
      }
      .calculator input,
      select {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
        box-sizing: border-box;
      }
      .calculator button {
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
      }
      .calculator button:hover {
        background-color: #004c9e;
      }
      #result {
        margin-top: 20px;
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 4px;
        display: none;
      }
      .price-details {
        margin-top: 10px;
        font-size: 0.9em;
        color: #555;
      }
      .footer {
        margin-top: 80px;
      }
      @media (max-width: 768px) {
        .contacts-container {
          flex-direction: column;
        }

        .contacts-info,
        .map-container {
          width: 100%;
        }

        .map-container {
          height: 300px;
        }
      }
      @media (max-width: 600px) {
        .faq-container {
          padding: 20px 15px;
        }

        .faq-question {
          font-size: 16px;
          padding-left: 25px;
        }

        .faq-question:before {
          left: -5px;
        }

        .faq-answer {
          padding-left: 25px;
        }
      }
      @media (max-width: 768px) {
        .content-block {
          flex-direction: column;
        }

        .text-section,
        .image-section {
          width: 100%;
          padding: 0;
        }

        .image-section {
          margin-top: 20px;
        }
      }
      /* Адаптивность */
      @media (max-width: 768px) {
        .services-header h2 {
          font-size: 26px;
        }

        .services-list {
          padding: 30px 20px;
        }

        .service-item {
          font-size: 16px;
        }
      }
    </style>
  </head>
  <body>
    <?php
      include "header/header.php";
    ?>
    <main>
      <div class="hero-image">
        <div class="hero-overlay">
          <div class="hero-content">
            <div class="services-container">
              <!-- Заголовок -->
              <div class="services-header">
                <h2 align="left">
                  Комплексное обслуживание для организаций – эффективно,
                  надёжно, с гарантией
                </h2>
              </div>

              <!-- Список услуг -->
              <div class="services-list">
                <div class="service-item">
                  <div>Уборка помещений</div>
                </div>
                <div class="service-item">
                  <div>Уборка прилегающей территории</div>
                </div>
                <div class="service-item">
                  <div>Обслуживание инженерных систем</div>
                </div>
                <div class="service-item">
                  <div>Обслуживание подъемного оборудования</div>
                </div>
                <div class="service-item">
                  <div>Обслуживание противопожарных систем</div>
                </div>
                <div class="service-item">
                  <div>Аутсорсинг/Аутстаффинг персонала</div>
                </div>
              </div>
            </div>
            <div class="form-container">
              <div class="form-header">
                <div class="form-title">Оставить заявку</div>
                <div class="form-subtitle">Отправим КП за 30 мин.</div>
              </div>

              <form>
                <div class="form-group">
                  <input
                    type="text"
                    id="name"
                    name="name"
                    placeholder="Имя"
                    required
                  />
                </div>

                <div class="form-group">
                  <input
                    type="email"
                    id="email"
                    name="email"
                    placeholder="Почта"
                    required
                  />
                </div>

                <div class="form-group">
                  <input
                    type="tel"
                    id="phone"
                    name="phone"
                    placeholder="+7 (999) 999-99-99"
                    required
                  />
                </div>

                <button type="submit" class="submit-btn">Отправить</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="content-block">
        <div class="text-section">
          <p>
            <strong>Профессиональная уборка бизнес-центров</strong><br /><br />
            "Привлекательность бизнес-центра начинается с его чистоты. Убедитесь
            в здоровье и комфорте всех пользователей помещений с нашим
            профессиональным клинингом от «Солиадо». Мы предоставляем: Разовые
            услуги для моментальной чистоты. Долгосрочные договоры для
            постоянного обслуживания. Выбирайте наш опыт и профессионализм для
            идеального бизнес-центра."
          </p>

          <p>Мы предоставляем:</p>
          <br />
          <ul>
            <li>Разовые услуги для моментальной чистоты</li>
            <li>Долгосрочные договоры для постоянного обслуживания</li>
          </ul>

          <p class="highlight">
            Выбирайте наш опыт и профессионализм для идеального бизнес-центра.
          </p>
        </div>

        <div class="image-section">
          <div class="image-placeholder">
            <img src="images/img1.png" height="300" />
          </div>
        </div>
      </div>
      <div class="content-block">
        <div class="image-section">
          <div class="image-placeholder">
            <img src="images/img2.png" height="300" />
          </div>
        </div>

        <div class="text-section">
          <p>
            <strong>Чистый дом</strong> - это команда высококвалифицированных
            профессионалов. Наши сотрудники - это специалисты, прошедшие строгий
            отбор и обучение.
          </p>

          <p>
            Мы уделяем большое внимание профессиональному росту нашей команды:
          </p>
          <br />
          <ul>
            <li>Обучение под руководством опытных наставников</li>
            <li>Стажировка перед тем как сотрудник приступит к работе</li>
            <li>Большой опыт работы на одном объекте, в среднем более 3 лет</li>
          </ul>

          <p class="highlight">
            С нашей командой вы можете быть уверены в высоком качестве и
            надежности наших услуг.
          </p>
        </div>
      </div>
      <div class="content-block">
        <div class="text-section">
          <p>
            <strong>Оборудование</strong><br /><br />
            "Мы располагаем более 110 высококлассных уборочных машин и обладаем
            широким арсеналом Мы гордимся тем, что наша команда придает
            приоритет качеству при выборе химии и оборудования, а не цене. Для
            нас важно, чтобы каждая единица оборудования и каждая капля химии
            соответствовали высоким стандартам и помогали нам обеспечивать
            безупречную чистоту."
          </p>

          <p>Мы предоставляем:</p>
          <br />
          <ul>
            <li>Разовые услуги для моментальной чистоты</li>
            <li>Долгосрочные договоры для постоянного обслуживания</li>
          </ul>

          <p class="highlight">
            Выбирайте наш опыт и профессионализм для идеального бизнес-центра.
          </p>
        </div>

        <div class="image-section">
          <div class="image-placeholder">
            <img src="images/img3.png" height="300" />
          </div>
        </div>
      </div>
      <div class="content-block">
        <div class="image-section">
          <div class="image-placeholder">
            <img src="images/img4.png" height="300" />
          </div>
        </div>

        <div class="text-section">
          <p>
            <strong>Контроль качества</strong><br /><br />
            "Наш отдел контроля качества (ОКK) осуществляет более 10 проверок
            сотрудников каждый месяц. Мы придерживаемся строгих стандартов
            безопасности, ГОСТов и инструкций, и наши выездные проверки на
            объекты позволяют нам Мы делаем все возможное, чтобы обеспечить
            высший уровень качества наших услуг."
          </p>

          <p class="highlight">
            С нашей командой вы можете быть уверены в высоком качестве и
            надежности наших услуг.
          </p>
        </div>
      </div>

      <div class="faq-container">
        <h1>Часто задаваемые вопросы</h1>

        <div class="faq-item">
          <div class="faq-question">
            Какой опыт у вашей компании в области клининга?
          </div>
          <div class="faq-answer">
            – Более 10 лет на рынке, работаем с офисами, квартирами, магазинами
            и складами.
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question">
            Какие услуги входят в стандартный пакет и есть ли дополнительные
            услуги за дополнительную плату?
          </div>
          <div class="faq-answer">
            – Мытье полов, чистка санузлов, протирка пыли, вынос мусора.
            Дополнительно: химчистка, дезинфекция, уборка после ремонта.
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question">
            Как часто будет проводиться уборка и можно ли настроить график под
            наши потребности?
          </div>
          <div class="faq-answer">
            – Гибкий: ежедневно, еженедельно или разово. Подстроимся под ваш
            режим.
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question">
            Какие меры безопасности принимаются при проведении уборки в наших
            помещениях?
          </div>
          <div class="faq-answer">
            – Проверенные сотрудники, безопасная химия, фотоотчеты при
            необходимости.
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question">
            Есть ли у вашей компании все необходимые лицензии и страховки?
          </div>
          <div class="faq-answer">
            – Да, все официально: страховка, сертифицированные средства,
            соблюдение норм.
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question">
            Как поддерживается качество работы вашего персонала, и какое
            обучение они проходят?
          </div>
          <div class="faq-answer">
            – Персонал обучается, проходит аттестации, регулярные проверки.
          </div>
        </div>

        <div class="faq-item">
          <div class="faq-question">
            Какова процедура решения возможных проблем или конфликтов?
          </div>
          <div class="faq-answer">
            – Быстро реагируем на замечания, исправляем недочеты в течение 24
            часов.
          </div>
        </div>
      </div>
      <div class="calculator">
        <h2>Калькулятор стоимости уборки</h2>

        <div class="form-group">
          <label for="cleaning-type">Тип уборки:</label>
          <select id="cleaning-type">
            <option value="standard">Стандартная уборка</option>
            <option value="general">Генеральная уборка</option>
            <option value="after-renovation">Уборка после ремонта</option>
            <option value="window">Мойка окон</option>
          </select>
        </div>

        <div class="form-group">
          <label for="area">Площадь помещения (м²):</label>
          <input type="number" id="area" min="1" value="50" />
        </div>

        <button onclick="calculate()">Рассчитать стоимость</button>

        <div id="result">
          <h3>Результат расчета</h3>
          <p>Общая стоимость: <span id="total-cost">0</span> руб.</p>
          <div class="price-details">
            <p>Тип уборки: <span id="selected-type"></span></p>
            <p>Площадь: <span id="selected-area"></span> м²</p>
            <p>Цена за м²: <span id="price-per-meter"></span> руб.</p>
            <p>Минимальная стоимость: <span id="min-price"></span> руб.</p>
          </div>
        </div>
      </div>
    </main>
    <div class="footer">
      <div class="contacts-container">
        <div class="contacts-info">
          <h1>Наши контакты</h1>
          <p>Клининг компания "Чистый дом"</p>
          <p>+7 (999) 999-99-99</p>
          <p>+7 (999) 777-77-77</p>
          <p>chistiydom@mvek.spo</p>
        </div>

        <div id="map" class="map-container"></div>
      </div>
    </div>
    <script>
      document.querySelectorAll(".faq-question").forEach((question) => {
        question.addEventListener("click", () => {
          const item = question.parentNode;
          item.classList.toggle("active");
        });
      });
    </script>
    <!-- Подключаем API Яндекс.Карт -->
    <script
      src="https://api-maps.yandex.ru/2.1/?apikey=d98761ef-7135-46b7-b5b4-5060a3aceeee&lang=ru_RU"
      type="text/javascript"
    ></script>
    <script>
      // Инициализация карты после загрузки API
      ymaps.ready(init);

      function init() {
        // Координаты Клининг компании "Чистый дом" (примерные)
        var myMap = new ymaps.Map("map", {
          center: [56.8528, 53.2115], // Ижевск
          zoom: 15,
        });

        // Добавляем метку
        var myPlacemark = new ymaps.Placemark([56.8528, 53.2115], {
          hintContent: 'Клининг компания "Чистый дом""',
          balloonContent: 'Клининг компания "Чистый дом""',
        });

        myMap.geoObjects.add(myPlacemark);

        // Убираем ненужные элементы с карты
        myMap.controls.remove("geolocationControl");
        myMap.controls.remove("searchControl");
        myMap.controls.remove("trafficControl");
        myMap.controls.remove("typeSelector");
        myMap.controls.remove("fullscreenControl");
        myMap.controls.remove("zoomControl");
        myMap.controls.remove("rulerControl");
      }
    </script>
    <script>
      // Цены за разные типы уборки (руб/м²)
      const PRICES = {
        standard: 50,
        general: 80,
        "after-renovation": 120,
        window: 150,
      };

      // Минимальные стоимости для разных типов уборки
      const MIN_PRICES = {
        standard: 2000,
        general: 2000,
        "after-renovation": 2000,
        window: 2000,
      };

      function calculate() {
        // Получаем выбранные значения
        const cleaningType = document.getElementById("cleaning-type").value;
        const area = parseInt(document.getElementById("area").value);

        // Проверяем корректность площади

        // Рассчитываем стоимость
        const pricePerMeter = PRICES[cleaningType];
        const calculatedPrice = pricePerMeter * area;
        const minPrice = MIN_PRICES[cleaningType];
        const totalCost = Math.max(calculatedPrice, minPrice);

        // Отображаем результат
        document.getElementById("total-cost").textContent = totalCost;
        document.getElementById("selected-type").textContent =
          document.getElementById("cleaning-type").options[
            document.getElementById("cleaning-type").selectedIndex
          ].text;
        document.getElementById("selected-area").textContent = area;
        document.getElementById("price-per-meter").textContent = pricePerMeter;
        document.getElementById("min-price").textContent = minPrice;

        // Показываем блок с результатом
        document.getElementById("result").style.display = "block";
      }
    </script>
    <?php
      include "footer/footer.php";
    ?>
  </body>
</html>
