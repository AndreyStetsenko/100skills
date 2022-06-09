<!DOCTYPE html>
<html lang="en">
<head>
    <x-client.head.head-page-component />
</head>
<body>
    <x-client.nav.page-component />

    <main class="main">
        <section class="baner">
            <div class="container">
                <div cla="row align-middle">
                    <div class="col-md-6">
                        <span class="subname">ТВОЙ АГРЕГАТОР КУРСОВ</span>
                        <h1 class="mt-2">Самый простой поиск любых курсов 
                            и репетиторов без посредников, наценок и ненужных заявок
                        </h1>
                        <p>Мы отобрали для вас лучшие курсы от ведущих школ и преподавателей страны в одном месте. Обучайтесь всем ключевым направлениям уже сейчас.</p>

                        <x-client.forms.search-component />

                        <div class="m-block">
                            <a href="/catalog" class="btn btn-red">Найти курс</a>
                            <a href="/catalog" class="btn btn-light">В каталог</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="container">
                <div class="row justify-content-between align-items-end">
                    <div class="col-md-5">
                        <h2>Большой ассортимент курсов от новых хобби до новых профессий</h2>
                    </div>
                    <div class="col-md-6">
                        <p>
                            Наша задача помочь учителям и школам найти новых учеников, 
                            ученикам же дать максимально возможный ассортимент курсов, 
                            без долгих заявок и комиссий. Только прямые контакты и только честные цены.
                        </p>
                    </div>
                </div>

                <div class="row mt-5 preim-one-block">
                    <div class="col-6 col-md-3 mt-3">
                        <div class="border light-bg p-2 p-md-4">
                            <img src="/resources/img/registration.svg" alt="" />
                            <h4 class="mb-0 mt-4">Без регистрации</h4>
                            <p class="mt-3 preim-text">Просто выбери подходящий курс и начинай обсучать сразу.</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 mt-3">
                        <div class="border light-bg p-2 p-md-4">
                            <img src="/resources/img/bz-zayavok.svg" alt="" />
                            <h4 class="mb-0 mt-4">Без заявок </h4>
                            <p class="mt-3 preim-text">Не нужно оставлять контакты и ждать пока менеджер перезвонит.</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 mt-3">
                        <div class="border light-bg p-2 p-md-4">
                            <img src="/resources/img/bez-naczenok.svg" alt="" />
                            <h4 class="mb-0 mt-4">Без наценок</h4>
                            <p class="mt-3 preim-text">Никаких лишних платежей и наценок. Просто забирай нужный курс.</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 mt-3">
                        <div class="border light-bg p-2 p-md-4">
                            <img src="/resources/img/pryamye-contacty.svg" alt="" />
                            <h4 class="mb-0 mt-4">Прямые контакты</h4>
                            <p class="mt-3 preim-text">Просто выбери подходящий курс и забирай прямые контакты школ и учителей.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section> 

        <section class="select-course">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-6 m-center">
                        <h2>Выбери направление в котором<br /> хочешь обучаться</h2>
                        <p>В нашем каталоге курсов найдётся всё от курса по вышиванию крестиком до курсов по маркетингу, 
                            программированию, запуску сложных проектов и не только.
                        </p>
                        <a href="/catalog" class="btn btn-red mt-3">Хочу посмотреть каталог</a>
                    </div>
                    <div class="col-md-5">
                        <img src="/resources/img/girl.webp" class="girl" alt="" />
                    </div>
                </div>
            </div>
        </section>

        <x-client.catalog.category-component />
        <x-client.catalog.popular-component />



        <section class="section-last">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-6">
                        <h2>Какие преимущества даёт онлайн обучение</h2>
                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humourЮ</p>

                        <div class="row">
                            <div class="col-6 col-md-6 mt-4">
                                <div class="border light-bg p-2 p-md-4">
                                    <img src="/resources/img/registration.svg" alt="" />
                                    <h4 class="mb-0 mt-4">Без регистрации</h4>
                                    <p class="mt-3 preim-text">Просто выбери подходящий курс и начинай обсучать сразу.</p>
                                </div>
                            </div>
                            <div class="col-6 col-md-6 mt-4">
                                <div class="border light-bg p-2 p-md-4">
                                    <img src="/resources/img/registration.svg" alt="" />
                                    <h4 class="mb-0 mt-4">Без регистрации</h4>
                                    <p class="mt-3 preim-text">Просто выбери подходящий курс и начинай обсучать сразу.</p>
                                </div>
                            </div>
                            <div class="col-6 col-md-6 mt-4">
                                <div class="border light-bg p-2 p-md-4">
                                    <img src="/resources/img/registration.svg" alt="" />
                                    <h4 class="mb-0 mt-4">Без регистрации</h4>
                                    <p class="mt-3 preim-text">Просто выбери подходящий курс и начинай обсучать сразу.</p>
                                </div>
                            </div>
                            <div class="col-6 col-md-6 mt-4">
                                <div class="p-0 p-md-4">
                                    <h5 class="mb-0 mt-4">Начни получать новые знания, навыки и освой новую профессию уже сейчас!</h5>
                                    <a href="/catalog" class="btn btn-red mt-3">
                                        <span class="m-none">Перейти в каталог</span>
                                        <span class="m-block">В каталог</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 m-none">
                        <img src="/resources/img/girl-phone.webp"  alt="" />
                    </div>
                </div>
            </div>
        </section>

        <x-client.catalog.found-component />

        
        <section class="section">
            <div class="partners">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-6 uk-text-center">
                            <h2>Станьте нашим партнёром</h2>
                            <p>Мы предоставляем гибкую систему партнёрских отношений. Расширяйте свою аудиторию вместе с 100Skills.</p>
                            
                            <a href="/account" class="btn btn-red">Стать <span class="m-none">нашим</span> партнёром</a>
                            <a href="/partnership" class="btn border-btn-dark mobile-podrobnee" style="padding: 11px 35px;">
                                <span class="m-none">Узнать больше</span>
                                <span class="m-block">Подробнее</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <x-client.catalog.articles-component />

        
    </main>

    <x-client.footer.footer-component />
</body>
</html>