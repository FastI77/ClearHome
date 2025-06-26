<?php include 'header/header.php'; ?>
<link rel="stylesheet" href="/style/order.css">
<link rel="stylesheet" href="/style/forms.css">
<div class="order-section" style="max-width: 100vw; min-height: 100vh; background: url('/images/background.png') center/cover no-repeat; position: relative; display: flex; flex-direction: column; align-items: center; justify-content: center;">
  <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.18); z-index: 1;"></div>
  <div style="position: relative; z-index: 2; width: 100%; max-width: 1100px; margin: 0 auto;">
    <div class="order-benefits">
      <div class="benefit-card">
        <img src="/images/111.jpg" alt="Гарантия качества">
        <span>Гарантия качества</span>
      </div>
      <div class="benefit-card">
        <img src="/images/222.jpg" alt="Быстрое оформление">
        <span>Быстрое оформление</span>
      </div>
      <div class="benefit-card">
        <img src="/images/333.webp" alt="Работаем 7 дней в неделю">
        <span>Работаем 7 дней в неделю</span>
      </div>
      <div class="benefit-card">
        <img src="/images/444.webp" alt="Экологичные средства">
        <span>Экологичные средства</span>
      </div>
    </div>
    <div class="order-content-row">
      <div class="order-info-block">
        <h2>Почему выбирают нас?</h2>
        <ul>
          <li>Профессиональные клинеры с опытом</li>
          <li>Контроль качества на каждом этапе</li>
          <li>Индивидуальный подход к каждому клиенту</li>
        </ul>
        <div class="order-mini-contacts">
          <span>Остались вопросы?</span> <a href="tel:+79999999999">+7 (999) 999-99-99</a>
        </div>
      </div>
      <div class="order-form-wrapper">
        <div class="section-header">
          <h2 class="section-title">Оформление заказа</h2>
          <p class="section-subtitle">Заполните форму для оформления заказа</p>
        </div>
        <form class="order-form wide-form" action="/order_submit.php" method="POST">
          <div class="form-row">
            <div class="form-group">
              <label for="service_type">Тип услуги</label>
              <select name="service_type" id="service_type" class="form-control" required>
                <option value="">Выберите услугу</option>
                <option value="Поддерживающая уборка">Поддерживающая уборка - 19 руб/м²</option>
                <option value="Генеральная уборка">Генеральная уборка - 62 руб/м²</option>
                <option value="Уборка после ремонта">Уборка после ремонта - 70 руб/м²</option>
                <option value="Химчистка напольных покрытий">Химчистка напольных покрытий - 95 руб/м²</option>
                <option value="Уход за тканями и твердыми покрытиями">Уход за тканями и твердыми покрытиями - 15 руб/м²</option>
                <option value="Мойка витрин и фасадов">Мойка витрин и фасадов - 60 руб/м²</option>
                <option value="Вынос мусора и отходов">Вынос мусора и отходов - 600 руб/смена</option>
              </select>
            </div>
            <div class="form-group">
              <label for="area">Площадь (м²)</label>
              <input type="number" name="area" id="area" class="form-control" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="rooms">Количество комнат</label>
              <input type="number" name="rooms" id="rooms" class="form-control" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="order_date">Дата</label>
              <input type="date" name="order_date" id="order_date" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="name">Имя</label>
              <input type="text" name="name" id="name" class="form-control" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label for="phone">Телефон</label>
              <input type="tel" name="phone" id="phone" class="form-control" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" name="email" id="email" class="form-control" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group" style="width:100%">
              <label for="comment">Комментарий</label>
              <textarea name="comment" id="comment" class="form-control"></textarea>
            </div>
          </div>
          <button type="submit" class="btn btn-primary btn-large">Оформить заказ</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php include 'footer/footer.php'; ?> 