<?php include 'header/header.php'; ?>
<link rel="stylesheet" href="/style/order.css">

<div class="order-section" style="max-width: 100vw; min-height: 100vh; background: url('/images/background.png') center/cover no-repeat; position: relative; display: flex; flex-direction: column; align-items: center; justify-content: center;">
  <div style="position: absolute; inset: 0; background: rgba(0,0,0,0.18); z-index: 1;"></div>
  <div style="position: relative; z-index: 2; width: 100%; max-width: 1100px; margin: 0 auto; text-align: center; padding: 40px; background: white; border-radius: 10px;">
    <h2 style="color: #4CAF50; margin-bottom: 20px;">Заказ успешно оформлен!</h2>
    <p style="font-size: 18px; margin-bottom: 30px;">Спасибо за ваш заказ. Наш менеджер свяжется с вами в ближайшее время для подтверждения деталей.</p>
    <a href="/" class="btn btn-primary" style="padding: 12px 30px;">Вернуться на главную</a>
  </div>
</div>

<?php include 'footer/footer.php'; ?>