<section id="order-section" class="order">
    <div class="container">
        <div class="order-form">
            <div class="section-header">
                <h2 class="section-title">Оформление заказа</h2>
                <p class="section-subtitle">Заполните форму для оформления заказа</p>
            </div>
            <form action="/order.php" method="POST" class="order-form">
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
                <div class="form-group">
                    <label for="comment">Комментарий</label>
                    <textarea name="comment" id="comment" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-large">Оформить заказ</button>
            </form>
        </div>
    </div>
</section> 