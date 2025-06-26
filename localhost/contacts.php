<?php include 'header/header.php'; ?>
<link rel="stylesheet" href="/style/contacts.css">
<link rel="stylesheet" href="/style/forms.css">
<div class="contacts-section" style="min-height: 100vh; background: url('/images/background.png') center/cover no-repeat; position: relative; display: flex; flex-direction: column; align-items: center; justify-content: center;">
  <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.18); z-index: 1;"></div>
  <div style="position: relative; z-index: 2; width: 100%; max-width: 1100px; margin: 0 auto;">
    <div class="order-benefits" style="display: flex; flex-direction: row; flex-wrap: nowrap; gap: 18px; justify-content: center; align-items: stretch; margin-bottom: 32px; width: 100%;">
      <div class="benefit-card" style="min-width: 110px; max-width: 140px; padding: 10px 8px;">
        <img src="/images/111.jpg" alt="Быстрое оформление" style="width: 28px; height: 28px; margin-bottom: 8px;">
        <span style="font-size: 0.95rem;">Быстрое оформление</span>
      </div>
      <div class="benefit-card" style="min-width: 110px; max-width: 140px; padding: 10px 8px;">
        <img src="/images/222.jpg" alt="Гарантия качества" style="width: 28px; height: 28px; margin-bottom: 8px;">
        <span style="font-size: 0.95rem;">Гарантия качества</span>
      </div>
      <div class="benefit-card" style="min-width: 110px; max-width: 140px; padding: 10px 8px;">
        <img src="/images/333.webp" alt="Работаем 7 дней в неделю" style="width: 28px; height: 28px; margin-bottom: 8px;">
        <span style="font-size: 0.95rem;">Работаем 7 дней в неделю</span>
      </div>
    </div>
    <div class="contacts-row" style="display: flex; justify-content: center; align-items: flex-start; gap: 40px;">
      <div class="contacts-info" style="background: #fff; border-radius: 18px; box-shadow: 0 4px 24px rgba(30, 41, 59, 0.10); padding: 36px 32px; min-width: 320px; max-width: 400px; font-family: 'Arial', sans-serif; font-size: 1.08rem; color: #222b45;">
        <h2 class="section-title" style="color: #1e90ff; font-weight: 700; font-family: 'Arial', sans-serif;">Контакты</h2>
        <p class="section-subtitle" style="font-weight: 600; color: #7B8794; font-size: 1rem;">Свяжитесь с нами — мы всегда на связи!</p>
        <p style="font-size: 1rem; color: #222b45;">
          <b>Телефон:</b> +7 (999) 999-99-99<br>
          <b>Email:</b> info@chisty-dom.ru<br>
          <b>Адрес:</b> г. Москва, ул. Примерная, д. 123<br>
          <b>Время работы:</b> Пн-Вс: 8:00 - 22:00
        </p>
        <div style="margin-top: 18px; color: #1e90ff; font-weight: 600; font-size: 1rem;">Мы ценим каждого клиента и всегда готовы помочь!</div>
      </div>
      <div class="contacts-card" style="background: #fff; border-radius: 18px; box-shadow: 0 4px 24px rgba(30, 41, 59, 0.10); padding: 36px 32px; min-width: 320px; max-width: 400px;">
        <form id="contact-page-order-form" class="contacts-feedback-form" method="POST" action="/quick_order.php" novalidate>
          <h3 class="section-title">Заказать звонок</h3>
          <p class="section-subtitle">Оставьте заявку — мы перезвоним в течение 10 минут!</p>
          <div class="form-group">
            <input type="text" name="name" class="form-control" placeholder="Ваше имя" required>
          </div>
          <div class="form-group">
            <input type="tel" name="phone" class="form-control" placeholder="Ваш телефон" required>
          </div>
          <div class="form-group">
            <input type="email" name="email" class="form-control" placeholder="Ваш Email" required>
          </div>
          <button type="submit" class="btn btn-primary btn-large">Заказать звонок</button>
          <div id="contact-page-order-message" style="margin-top: 15px;"></div>
        </form>
        <div style="margin-top: 18px; color: #7B8794; font-size: 1.08rem; text-align: center;">Мы работаем по всей Москве и области. Ваш комфорт — наша забота!</div>
      </div>
    </div>
  </div>
</div>
<?php include 'footer/footer.php'; ?> 