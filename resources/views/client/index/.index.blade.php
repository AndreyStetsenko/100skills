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
                            
                            <a href="/partnership" class="btn btn-red">Стать <span class="m-none">нашим</span> партнёром</a>
                            <a href="/partnership/info" class="btn border-btn-dark mobile-podrobnee" style="padding: 11px 35px;">
                                <span class="m-none">Узнать больше</span>
                                <span class="m-block">Подробнее</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section-last">
            <div class="container">
                <div class="row justify-content-between align-items-end">
                    <div class="col-md-4">
                        <h2 class="mb-0">Не только сравниваем курсы, но и делимся знаниями</h2>
                    </div>
                    <div class="col-md-2 mt-mt-0 mt-3">
                        <a href="/blog" class="btn btn-red">Ко всем статьям</a>
                    </div>
                </div>
            </div>

            <div class="blog-carousel mt-5">
                <div class="uk-position-relative uk-visible-togglet" tabindex="-1" uk-slider>
                    <div class="uk-slider-container">
                        <ul class="uk-slider-items uk-grid uk-grid-match">
                            <li class="uk-width-4-5 uk-width-2-5@m">
                                <div>
                                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative post-box">
                                        <div class="col p-4 d-flex flex-column position-static">
                                        <strong class="d-inline-block post-tag mt-3">МОДА</strong>
                                        <h3 class="mb-0 mt-2">Фундаментальный JavaScript. С практикой и проектами</h3>
                                        <p class="card-text">Мы отобрали для вас лучшие курсы от ведущих школ и преподавателей страны в одном месте.</p>
                                        <a href="#" class="stretched-link">                         
                                            Подробнее
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14.8302 11.29L10.5902 7.05001C10.4972 6.95628 10.3866 6.88189 10.2648 6.83112C10.1429 6.78035 10.0122 6.75421 9.88019 6.75421C9.74818 6.75421 9.61747 6.78035 9.49561 6.83112C9.37375 6.88189 9.26315 6.95628 9.17019 7.05001C8.98394 7.23737 8.87939 7.49082 8.87939 7.75501C8.87939 8.0192 8.98394 8.27265 9.17019 8.46001L12.7102 12L9.17019 15.54C8.98394 15.7274 8.87939 15.9808 8.87939 16.245C8.87939 16.5092 8.98394 16.7626 9.17019 16.95C9.26363 17.0427 9.37444 17.116 9.49628 17.1658C9.61812 17.2155 9.74858 17.2408 9.88019 17.24C10.0118 17.2408 10.1423 17.2155 10.2641 17.1658C10.3859 17.116 10.4967 17.0427 10.5902 16.95L14.8302 12.71C14.9239 12.617 14.9983 12.5064 15.0491 12.3846C15.0998 12.2627 15.126 12.132 15.126 12C15.126 11.868 15.0998 11.7373 15.0491 11.6154C14.9983 11.4936 14.9239 11.383 14.8302 11.29Z" fill="#1C1938"/>
                                            </svg>
                                            </a>
                                        </div>
                                        <div class="col-auto d-none d-lg-block p-2">
                                        <img src="/resources/img/article-1.png" width="100%" alt="" />
                                
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="uk-width-4-5 uk-width-2-5@m">
                                <div>
                                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative post-box">
                                        <div class="col p-4 d-flex flex-column position-static">
                                        <strong class="d-inline-block post-tag mt-3">МОДА</strong>
                                        <h3 class="mb-0 mt-2">Фундаментальный JavaScript. С практикой и проектами</h3>
                                        <p class="card-text">Мы отобрали для вас лучшие курсы от ведущих школ и преподавателей страны в одном месте.</p>
                                        <a href="#" class="stretched-link">                         
                                            Подробнее
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14.8302 11.29L10.5902 7.05001C10.4972 6.95628 10.3866 6.88189 10.2648 6.83112C10.1429 6.78035 10.0122 6.75421 9.88019 6.75421C9.74818 6.75421 9.61747 6.78035 9.49561 6.83112C9.37375 6.88189 9.26315 6.95628 9.17019 7.05001C8.98394 7.23737 8.87939 7.49082 8.87939 7.75501C8.87939 8.0192 8.98394 8.27265 9.17019 8.46001L12.7102 12L9.17019 15.54C8.98394 15.7274 8.87939 15.9808 8.87939 16.245C8.87939 16.5092 8.98394 16.7626 9.17019 16.95C9.26363 17.0427 9.37444 17.116 9.49628 17.1658C9.61812 17.2155 9.74858 17.2408 9.88019 17.24C10.0118 17.2408 10.1423 17.2155 10.2641 17.1658C10.3859 17.116 10.4967 17.0427 10.5902 16.95L14.8302 12.71C14.9239 12.617 14.9983 12.5064 15.0491 12.3846C15.0998 12.2627 15.126 12.132 15.126 12C15.126 11.868 15.0998 11.7373 15.0491 11.6154C14.9983 11.4936 14.9239 11.383 14.8302 11.29Z" fill="#1C1938"/>
                                            </svg>
                                            </a>
                                        </div>
                                        <div class="col-auto d-none d-lg-block p-2">
                                        <img src="/resources/img/article-1.png" width="100%" alt="" />
                                
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="uk-width-4-5 uk-width-2-5@m">
                                <div>
                                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative post-box">
                                        <div class="col p-4 d-flex flex-column position-static">
                                        <strong class="d-inline-block post-tag mt-3">МОДА</strong>
                                        <h3 class="mb-0 mt-2">Фундаментальный JavaScript. С практикой и проектами</h3>
                                        <p class="card-text">Мы отобрали для вас лучшие курсы от ведущих школ и преподавателей страны в одном месте.</p>
                                        <a href="#" class="stretched-link">                         
                                            Подробнее
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14.8302 11.29L10.5902 7.05001C10.4972 6.95628 10.3866 6.88189 10.2648 6.83112C10.1429 6.78035 10.0122 6.75421 9.88019 6.75421C9.74818 6.75421 9.61747 6.78035 9.49561 6.83112C9.37375 6.88189 9.26315 6.95628 9.17019 7.05001C8.98394 7.23737 8.87939 7.49082 8.87939 7.75501C8.87939 8.0192 8.98394 8.27265 9.17019 8.46001L12.7102 12L9.17019 15.54C8.98394 15.7274 8.87939 15.9808 8.87939 16.245C8.87939 16.5092 8.98394 16.7626 9.17019 16.95C9.26363 17.0427 9.37444 17.116 9.49628 17.1658C9.61812 17.2155 9.74858 17.2408 9.88019 17.24C10.0118 17.2408 10.1423 17.2155 10.2641 17.1658C10.3859 17.116 10.4967 17.0427 10.5902 16.95L14.8302 12.71C14.9239 12.617 14.9983 12.5064 15.0491 12.3846C15.0998 12.2627 15.126 12.132 15.126 12C15.126 11.868 15.0998 11.7373 15.0491 11.6154C14.9983 11.4936 14.9239 11.383 14.8302 11.29Z" fill="#1C1938"/>
                                            </svg>
                                            </a>
                                        </div>
                                        <div class="col-auto d-none d-lg-block p-2">
                                        <img src="/resources/img/article-1.png" width="100%" alt="" />
                                
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="uk-width-4-5 uk-width-2-5@m">
                                <div>
                                    <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative post-box">
                                        <div class="col p-4 d-flex flex-column position-static">
                                        <strong class="d-inline-block post-tag mt-3">МОДА</strong>
                                        <h3 class="mb-0 mt-2">Фундаментальный JavaScript. С практикой и проектами</h3>
                                        <p class="card-text">Мы отобрали для вас лучшие курсы от ведущих школ и преподавателей страны в одном месте.</p>
                                        <a href="#" class="stretched-link">                         
                                            Подробнее
                                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M14.8302 11.29L10.5902 7.05001C10.4972 6.95628 10.3866 6.88189 10.2648 6.83112C10.1429 6.78035 10.0122 6.75421 9.88019 6.75421C9.74818 6.75421 9.61747 6.78035 9.49561 6.83112C9.37375 6.88189 9.26315 6.95628 9.17019 7.05001C8.98394 7.23737 8.87939 7.49082 8.87939 7.75501C8.87939 8.0192 8.98394 8.27265 9.17019 8.46001L12.7102 12L9.17019 15.54C8.98394 15.7274 8.87939 15.9808 8.87939 16.245C8.87939 16.5092 8.98394 16.7626 9.17019 16.95C9.26363 17.0427 9.37444 17.116 9.49628 17.1658C9.61812 17.2155 9.74858 17.2408 9.88019 17.24C10.0118 17.2408 10.1423 17.2155 10.2641 17.1658C10.3859 17.116 10.4967 17.0427 10.5902 16.95L14.8302 12.71C14.9239 12.617 14.9983 12.5064 15.0491 12.3846C15.0998 12.2627 15.126 12.132 15.126 12C15.126 11.868 15.0998 11.7373 15.0491 11.6154C14.9983 11.4936 14.9239 11.383 14.8302 11.29Z" fill="#1C1938"/>
                                            </svg>
                                            </a>
                                        </div>
                                        <div class="col-auto d-none d-lg-block p-2">
                                        <img src="/resources/img/article-1.png" width="100%" alt="" />
                                
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="blog-slide-nav m-none">
                        <a class="uk-position-center-left-out uk-position-small left" href="#" uk-slider-item="previous">
                            <img src="/resources/img/slide-leftt.svg" width="100%" alt="" />
                        </a>
                        <a class="uk-position-center-right uk-position-small uk-hidden-hover right" href="#" uk-slider-item="next">
                            <img src="/resources/img/slide-right.svg" width="100%" alt="" />
                        </a>
                    </div>
                
                </div>
            </div>
        </section>
    </main>

    <x-client.footer.footer-component />
</body>
</html>