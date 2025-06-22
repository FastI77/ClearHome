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
    <script
      src="https://kit.fontawesome.com/589e86e2c9.js"
      crossorigin="anonymous"
    ></script>
  </head>
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
    .reviews-container {
      margin-bottom: 40px;
    }
    .reviews_container {
      max-width: 800px;
      margin: 40px auto;
      padding: 20px;
    }
    .reviews_container h1 {
      margin: 40px 0;
    }
    .review {
      background-color: #f9f9f9;
      border-radius: 8px;
      padding: 20px;
      margin-bottom: 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .review h3 {
      margin-top: 0;
      color: #3498db;
    }

    .review h4 {
      margin-top: 0;
      color: #2c3e50;
      font-size: 1.2em;
    }

    .pagination {
      display: flex;
      justify-content: center;
      margin-top: 30px;
    }

    .pagination button {
      background-color: #3498db;
      color: white;
      border: none;
      padding: 8px 16px;
      margin: 0 5px;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    .pagination button:hover {
      background-color: #2980b9;
    }

    .pagination button.active {
      background-color: #2c3e50;
    }

    .read-all {
      text-align: center;
      margin-top: 20px;
    }

    .read-all a {
      color: #3498db;
      text-decoration: none;
      font-weight: bold;
    }

    .read-all a:hover {
      text-decoration: underline;
    }
    /* пагинатор */
    .pagination_2_container {
      margin: 60px auto;
    }
    .pagination_2_container h1 {
      display: flex;
      justify-content: center;
      margin: 40px 0;
    }
    .gallery {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      margin-bottom: 20px;
      justify-content: center;
    }
    .gallery img {
      width: 400px;
      height: 320px;
      object-fit: cover;
      border-radius: 4px;
      transition: transform 0.3s;
    }
    .gallery img:hover {
      transform: scale(1.05);
    }
    .pagination_2 {
      display: flex;
      gap: 5px;
      justify-content: center;
      margin-top: 20px;
    }
    .pagination_2 button {
      padding: 8px 12px;
      cursor: pointer;
      border: 1px solid #ddd;
      background: #f8f9fa;
      border-radius: 4px;
      transition: all 0.3s;
    }
    .pagination_2 button:hover {
      background: #e9ecef;
    }
    .pagination_2 button.active {
      background-color: #007bff;
      color: white;
      border-color: #007bff;
    }
    .pagination_2 button:disabled {
      opacity: 0.5;
      cursor: not-allowed;
    }
    /* faq */
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
  </style>
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
      <div class="reviews_container">
        <h1>Отзывы наших клиентов</h1>

        <div class="reviews-container" id="reviewsContainer">
          <!-- Отзывы будут загружены с помощью JavaScript -->
        </div>

        <div class="pagination" id="pagination">
          <!-- Кнопки пагинации будут созданы с помощью JavaScript -->
        </div>

        <div class="read-all">
          <a href="#">Читать все отзывы</a>
        </div>
      </div>
      <div class="pagination_2_container">
        <h1>Мы на объектах</h1>
        <div class="gallery" id="gallery"></div>
        <div class="pagination_2" id="pagination_2">
          <button id="prevBtn">Назад</button>
          <div id="pageNumbers"></div>
          <button id="nextBtn">Вперед</button>
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
    <?php
      include "footer/footer.php";
    ?>
  </body>
  <script>
    // Массив с отзывами
    const reviews = [
      {
        author: "Илья.Ф",
        title: "Идеальная чистота!",
        content:
          "Огромное спасибо компании «Чистый Дом» за безупречную уборку! Заказывали генеральную уборку после ремонта — квартира засияла, как новая. Мастера работали быстро, аккуратно и с вниманием к деталям. Особенно порадовало, что использовали экологичные средства — никакого запаха химии. Теперь только к вам!",
      },
      {
        author: "Андрей.К",
        title: "Лучший клининг в городе",
        content:
          "Пользуюсь услугами «Чистого Дома» уже полгода — раз в неделю убирают мою квартиру. Всегда пунктуальны, вежливы и делают работу на 100%. Очень нравится, что можно выбрать удобное время и даже попросить особый подход к некоторым зонам (у меня дома две кошки — шерсти нет!). Цены адекватные, качество на высоте.",
      },
      {
        author: "Юлия.М",
        title: "Спасение для занятых",
        content:
          "Я работаю без выходных, и убираться самой просто нет времени. «Чистый Дом» стал для меня настоящим спасением! Раз в две недели приезжают, моют всё от пола до потолка, даже окна протирают. Ни разу не было нареканий — всё идеально. Рекомендую всем, кто ценит своё время.",
      },
      {
        author: "Ольга.С",
        title: "Отличный сервис",
        content:
          "Заказывала химчистку дивана и ковра. Результат превзошел ожидания! Все пятна удалены, вещи выглядят как новые. Сотрудники аккуратные, вежливые, работали в масках и бахилах. Буду рекомендовать знакомым.",
      },
      {
        author: "Дмитрий.П",
        title: "Быстро и качественно",
        content:
          "Нужно было срочно подготовить квартиру к приезду гостей. Ребята приехали через 2 часа после звонка и сделали всё за 3 часа! Убрали даже те места, до которых я сам никогда не добираюсь. Очень доволен сервисом.",
      },
      {
        author: "Екатерина.В",
        title: "Профессионалы своего дела",
        content:
          "Первый раз заказала уборку и немного переживала. Но все прошло замечательно! Особенно порадовало, что уделили внимание кухне и санузлу — теперь блестят! Спасибо за честность и качественную работу.",
      },
    ];

    // Настройки пагинации
    const reviewsPerPage = 2;
    let currentPage = 1;

    // Функция для отображения отзывов
    function displayReviews(page) {
      const container = document.getElementById("reviewsContainer");
      container.innerHTML = "";

      const startIndex = (page - 1) * reviewsPerPage;
      const endIndex = startIndex + reviewsPerPage;
      const paginatedReviews = reviews.slice(startIndex, endIndex);

      paginatedReviews.forEach((review) => {
        const reviewElement = document.createElement("div");
        reviewElement.className = "review";
        reviewElement.innerHTML = `
                    <h3>${review.author}</h3>
                    <h4>${review.title}</h4>
                    <p>${review.content}</p>
                `;
        container.appendChild(reviewElement);
      });
    }

    // Инициализация
    document.addEventListener("DOMContentLoaded", () => {
      setupPagination();
      displayReviews(currentPage);
    });
  </script>
  <script>
    // Массив с URL картинок
    const images = [
      "https://www.anatomiyasna.ru/uploads/files/statya-glavnye-nakopiteli-pyli-v-spalne-3.jpg",
      "https://i.pinimg.com/originals/09/92/68/099268abf46779e5a8852798696f4aad.jpg",
      "https://i2.wp.com/rescuemytimecleaningservice.com/wp-content/uploads/2020/11/how-to-clean-your-bedroom.jpg",
      "https://www.thespruce.com/thmb/fBOdyMFmEBHusOiO6Ryep-Ud9I0=/4000x2667/filters:no_upscale()/SPR-how-to-deep-cleaning-house-7152794-Hero-01-e5cd99973ec24e69b00b5ee6b992f760.jpg",
      "https://exozenfms.com/wp-content/uploads/2023/04/Untitled-design.jpg",
      "https://maidinto.ca/wp-content/uploads/2022/12/Apartment-Cleaning-Services.webp",
    ];

    const itemsPerPage = 3;
    let currentsPage = 1;
    const gallery = document.getElementById("gallery");
    const pageNumbersContainer = document.getElementById("pageNumbers");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");

    // Отображение картинок
    function displayImages(page) {
      gallery.innerHTML = "";

      const startIndex = (page - 1) * itemsPerPage;
      const endIndex = startIndex + itemsPerPage;
      const paginatedImages = images.slice(startIndex, endIndex);

      paginatedImages.forEach((imgUrl) => {
        const img = document.createElement("img");
        img.src = imgUrl;
        img.alt = "Изображение галереи";
        gallery.appendChild(img);
      });
    }

    // Создание пагинации
    function setupPagination() {
      pageNumbersContainer.innerHTML = "";
      const pageCount = Math.ceil(images.length / itemsPerPage);

      // Кнопки страниц
      for (let i = 1; i <= pageCount; i++) {
        const pageBtn = document.createElement("button");
        pageBtn.innerText = i;

        if (i === currentsPage) {
          pageBtn.classList.add("active");
        }

        pageBtn.addEventListener("click", () => {
          currentsPage = i;
          updatePagination();
          displayImages(currentsPage);
        });

        pageNumbersContainer.appendChild(pageBtn);
      }

      // Обновление состояния кнопок
      updatePagination();
    }

    // Обновление состояния пагинации
    function updatePagination() {
      const pageCount = Math.ceil(images.length / itemsPerPage);
      const pageButtons = pageNumbersContainer.querySelectorAll("button");

      pageButtons.forEach((button) => {
        button.classList.remove("active");
        if (parseInt(button.innerText) === currentsPage) {
          button.classList.add("active");
        }
      });

      prevBtn.disabled = currentsPage === 1;
      nextBtn.disabled = currentsPage === pageCount;
    }

    // Обработчики кнопок "Назад" и "Вперед"
    prevBtn.addEventListener("click", () => {
      if (currentsPage > 1) {
        currentsPage--;
        updatePagination();
        displayImages(currentsPage);
      }
    });

    nextBtn.addEventListener("click", () => {
      const pageCount = Math.ceil(images.length / itemsPerPage);
      if (currentsPage < pageCount) {
        currentsPage++;
        updatePagination();
        displayImages(currentsPage);
      }
    });

    // Инициализация
    displayImages(currentsPage);
    setupPagination();
  </script>
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
</html>
