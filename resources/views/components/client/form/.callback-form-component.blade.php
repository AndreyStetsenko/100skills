

    <section class="section-callback container-fixed">
        <div class="container-content">
            <form action="" class="section-callback__form callback-form form" onsubmit="event.preventDefault(); fm.submit(this);">
                <div class="callback-form__group-column flex-column">
                    <h2 class="callback-form__title">Помочь с выбором?</h2>
                    <ul class="callback-form__list">
                        <li class="callback-form__item">Дополнительные скидки до 20% от стоимости помещения.</li>
                        <li class="callback-form__item">Получение уникальных условий по ипотеке и оформление за час.</li>
                        <li class="callback-form__item">База эксклюзивных объектов, которых нет в открытой продаже.</li>
                    </ul>
                </div>
                <div class="callback-form__group-column flex-column">
                    <input class="form__field-text" type="text" required name="name" placeholder="Ваше имя">
                    <input class="form__field-text" type="tel" required name="phone" data-mask="phone" placeholder="+7 (___) ___-__-__">
                    <div class="form__cb-cont">
                        <input class="form__field-cb" type="checkbox" name="politics" id="politics">
                        <label class="form__label-cb" for="politics">Отправляя форму, даю согласие на обработку моих персональных данных в соответствии с <a class="link-underline" href="/policy">Политикой конфиденциальности</a></label>
                    </div>
                    <button class="form__btn-submit btn-color">Жду звонка</button>
                </div>
            </form>
        </div>
    </section>