<section id="contact" class="contacts">
    <div class="container">
        <div class="order-benefits" style="display: flex; flex-direction: row; flex-wrap: nowrap; gap: 14px; justify-content: center; align-items: stretch; margin-bottom: 32px; width: 100%;">
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
        <div class="contacts-row">
            <div class="contacts-info">
                <h2 class="section-title">Контакты</h2>
                <p class="section-subtitle">Свяжитесь с нами — мы всегда на связи!</p>
                <p><b>Телефон:</b> +7 (999) 999-99-99<br>
                <b>Email:</b> info@chisty-dom.ru<br>
                <b>Адрес:</b> г. Москва, ул. Примерная, д. 123<br>
                <b>Время работы:</b> Пн-Вс: 8:00 - 22:00</p>
            </div>
            <div class="contacts-card">
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
            </div>
        </div>
    </div>
</section>

<style>
.order-section::before, .contacts-section::before {
    content: "";
    position: absolute;
    top: 30px;
    right: 30px;
    width: 120px;
    height: 120px;
    background: url('/images/decor-order.svg') no-repeat center/contain;
    opacity: 0.08;
    z-index: 0;
    pointer-events: none;
}
.section-title, .form-title {
    font-size: 2.2rem;
    color: #1e90ff !important;
    font-weight: 800;
    margin-bottom: 8px;
    text-shadow: 0 2px 8px rgba(102,126,234,0.08);
    letter-spacing: -1px;
}
.section-subtitle {
    color: #7B8794;
    font-size: 1.1rem;
    margin-bottom: 0;
}
.btn-primary, .btn-large {
    font-size: 1.15rem;
    padding: 18px 0;
    border-radius: 12px;
    box-shadow: 0 4px 16px rgba(102, 126, 234, 0.10);
    transition: background 0.2s, box-shadow 0.2s, transform 0.2s;
}
.btn-primary:hover {
    background:#0077c2;
    transform: translateY(-2px) scale(1.03);
}
.order-benefits {
    display: flex;
    gap: 24px;
    margin-top: 32px;
    justify-content: center;
}
.benefit {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 1rem;
    color: #667eea;
    background: #f0f4ff;
    border-radius: 8px;
    padding: 10px 18px;
    box-shadow: 0 2px 8px rgba(102,126,234,0.06);
}
.benefit img {
    width: 22px;
    height: 22px;
}
</style> 