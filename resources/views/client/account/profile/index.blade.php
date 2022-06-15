<!DOCTYPE html>
<html lang="en">
<head>
    <x-client.head.head-page-component />
</head>
<body>
    <!-- <x-client.form.form-lead-component /> -->
    <x-client.header.header-lk-component />

   <main class="main"> 
        <div class="container">
            <div class="m-block">
                <div class="row">
                    <div class="col-9">
                        <h1 class="mt-md-5">Мой профиль</h1>
                    </div>
                    <div class="col-3">
                        <div class="m-block uk-text-right">
                        <button class="burger-nav cat-menu" type="button" uk-toggle="target: #blog-cat-mobile">
                            <img src="/resources/img/burger.svg" width="20" alt="" />
                        </button>

                            <div id="blog-cat-mobile" uk-offcanvas="flip: true; overlay: true">
                                <div class="uk-offcanvas-bar">
                                    <div class="logo uk-text-left">
                                        <a href="/">
                                            <img src="/resources/img/logo.svg" width="100px" alt="100Skills" />
                                        </a>
                                    </div>

                                    <button class="uk-offcanvas-close" type="button">+</button>
                                    
                                    <div class="mt-4">
                                        <nav class="blog-nav mt-5">
                                            <ul>
                                                <li><a href="/account/profile" <?php if ( Route::current()->uri == "account/profile") print("class='current-page'");?>>Аккаунт</a></li>
                                                <li><a href="/account/courses" <?php if ( Route::current()->uri == "account/courses") print("class='current-page'");?>>Мои курсы</a></li>
                                                <li><a href="/account/actions" <?php if ( Route::current()->uri == "account/actions") print("class='current-page'");?>>Мои акции</a></li>
                                                <li><a href="/account/tarif" <?php if ( Route::current()->uri == "account/tarif") print("class='current-page'");?>>Тарифы и оплата</a></li>
                                            </ul>
                                            </nav>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <nav class="site-nav lk-nav mt-5 m-none">
                <ul>
                    <li><a href="/account/profile" <?php if ( Route::current()->uri == "account/profile") print("class='current-page'");?>>Аккаунт</a></li>
                    <li><a href="/account/courses" <?php if ( Route::current()->uri == "account/courses") print("class='current-page'");?>>Мои курсы</a></li>
                    <li><a href="/account/actions" <?php if ( Route::current()->uri == "account/actions") print("class='current-page'");?>>Мои акции</a></li>
                    <li><a href="/account/tarif" <?php if ( Route::current()->uri == "account/tarif") print("class='current-page'");?>>Тарифы и оплата</a></li>
                </ul>
            </nav>

            <div class="row mt-5 justify-content-between align-items-center m-none">
                <div class="col-md-9 row justify-content-between">
                    <div class="col-md-auto mt-3">
                        <span>Телефон</span>
                        <?php if ( isset($item['phone']) && !is_null($item['phone']) ): ?>
                            <a href="tel:<?=$item['phone'] ?>" class="contact-link">
                                <?=$item['phone'] ?>
                            </a>
                        <?php else: ?>
                            <a class="contact-link">
                                -
                            </a>
                        <?php endif ?>
                    </div>
                    <div class="col-md-auto mt-3">
                        <span>Email</span>
                        <?php if ( isset($item['email']) && !is_null($item['email']) ): ?>
                            <a href="mailto:<?=$item['email'] ?>" class="contact-link">
                                <?=$item['email'] ?>
                            </a>
                        <?php else: ?>
                            <a class="contact-link">
                                -
                            </a>
                        <?php endif ?>
                    </div>
                    <div class="col-md-auto mt-3">
                        <span>Адрес</span>
                        <?php if ( isset($item['adress']) && !is_null($item['adress']) ): ?>
                            <a class="contact-link"
                               href="https://yandex.ru/maps/?pt=<?=$item['latitude'] ?>,<?=$item['longitude'] ?>&z=17"
                               target="_blank" 

                                >
                                <?=$item['adress'] ?>
                            </a>
                        <?php else: ?>
                            <a class="contact-link">
                                -
                            </a>
                        <?php endif ?>
                    </div>
                    <div class="col-md-auto mt-3">
                        <span>Сайт</span>
                        <a @if ($item['link']) href="{{ $item['link'] }}" @endif class="contact-link">
                            {{ $item['link'] ?? '-' }}
                        </a>
                    </div>
                </div>
                <div class="col-md-2">
                    <a style="white-space: nowrap;" href="/account/profile/<?=$item['slug'] ?>" class="btn btn-red btn-icon">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 11.9999C20.7348 11.9999 20.4804 12.1053 20.2929 12.2928C20.1054 12.4804 20 12.7347 20 12.9999V18.9999C20 19.2652 19.8946 19.5195 19.7071 19.707C19.5196 19.8946 19.2652 19.9999 19 19.9999H5C4.73478 19.9999 4.48043 19.8946 4.29289 19.707C4.10536 19.5195 4 19.2652 4 18.9999V4.99994C4 4.73472 4.10536 4.48037 4.29289 4.29283C4.48043 4.1053 4.73478 3.99994 5 3.99994H11C11.2652 3.99994 11.5196 3.89458 11.7071 3.70705C11.8946 3.51951 12 3.26516 12 2.99994C12 2.73472 11.8946 2.48037 11.7071 2.29283C11.5196 2.1053 11.2652 1.99994 11 1.99994H5C4.20435 1.99994 3.44129 2.31601 2.87868 2.87862C2.31607 3.44123 2 4.20429 2 4.99994V18.9999C2 19.7956 2.31607 20.5587 2.87868 21.1213C3.44129 21.6839 4.20435 21.9999 5 21.9999H19C19.7956 21.9999 20.5587 21.6839 21.1213 21.1213C21.6839 20.5587 22 19.7956 22 18.9999V12.9999C22 12.7347 21.8946 12.4804 21.7071 12.2928C21.5196 12.1053 21.2652 11.9999 21 11.9999ZM6 12.7599V16.9999C6 17.2652 6.10536 17.5195 6.29289 17.707C6.48043 17.8946 6.73478 17.9999 7 17.9999H11.24C11.3716 18.0007 11.5021 17.9755 11.6239 17.9257C11.7457 17.8759 11.8566 17.8026 11.95 17.7099L18.87 10.7799L21.71 7.99994C21.8037 7.90698 21.8781 7.79637 21.9289 7.67452C21.9797 7.55266 22.0058 7.42195 22.0058 7.28994C22.0058 7.15793 21.9797 7.02722 21.9289 6.90536C21.8781 6.7835 21.8037 6.6729 21.71 6.57994L17.47 2.28994C17.377 2.19621 17.2664 2.12182 17.1446 2.07105C17.0227 2.02028 16.892 1.99414 16.76 1.99414C16.628 1.99414 16.4973 2.02028 16.3754 2.07105C16.2536 2.12182 16.143 2.19621 16.05 2.28994L13.23 5.11994L6.29 12.0499C6.19732 12.1434 6.12399 12.2542 6.07423 12.376C6.02446 12.4979 5.99924 12.6283 6 12.7599ZM16.76 4.40994L19.59 7.23994L18.17 8.65994L15.34 5.82994L16.76 4.40994ZM8 13.1699L13.93 7.23994L16.76 10.0699L10.83 15.9999H8V13.1699Z" fill="white"/>
                            </svg>                            
                        Редактировать
                    </a>
                </div>
            </div>

            <div class="row mt-5">
                <div class="col-md-7 order-2 order-md-1 mt-3 mt-md-0">
                    <h1>
                        <?=(isset($item['title']) && !is_null($item['title'])) ? $item['title'] : "-" ?>
                    </h1>
                    <h2>Краткое описание</h2>
                    <?=(isset($item['body_short']) && !is_null($item['body_short'])) ? $item['body_short'] : "-" ?>
                    <h2>Полное описание</h2>
                    <?=(isset($item['body_long']) && !is_null($item['body_long'])) ? $item['body_long'] : "-" ?>
                </div>
                <div class="col-md-5 uk-text-right school-img order-1 order-md-2 mb-4">
                    <?php if ( $item["gallery"]->first() != null ): ?>
                        <img style="max-height: 300px;  max-width: 300px;" src="<?=$item["gallery"]->first()->src ?>" alt="">
                    <?php else: ?>
                        <img src="/resources/img/school-img.png" alt="">
                    <?php endif ?>
                </div>
            </div>

            <div class="row mt-5 justify-content-between align-items-center m-block section-last">
                <div class="col-md-9 row justify-content-between">
                    <div class="col-md-auto mt-3">
                        <span>Телефон</span>
                        <?php if ( isset($item['phone']) && !is_null($item['phone']) ): ?>
                            <a href="tel:<?=$item['phone'] ?>" class="contact-link">
                                <?=$item['phone'] ?>
                            </a>
                        <?php else: ?>
                            <a class="contact-link">
                                -
                            </a>
                        <?php endif ?>
                    </div>
                    <div class="col-md-auto mt-3">
                        <span>Email</span>
                        <?php if ( isset($item['email']) && !is_null($item['email']) ): ?>
                            <a href="mailto:<?=$item['email'] ?>" class="contact-link">
                                <?=$item['email'] ?>
                            </a>
                        <?php else: ?>
                            <a class="contact-link">
                                -
                            </a>
                        <?php endif ?>
                    </div>
                    <div class="col-md-auto mt-3">
                        <span>Адрес</span>
                        <?php if ( isset($item['adress']) && !is_null($item['adress']) ): ?>
                            <a class="contact-link"
                               href="https://yandex.ru/maps/?pt=<?=$item['latitude'] ?>,<?=$item['longitude'] ?>&z=17"
                               target="_blank" 

                                >
                                <?=$item['adress'] ?>
                            </a>
                        <?php else: ?>
                            <a class="contact-link">
                                -
                            </a>
                        <?php endif ?>
                    </div>
                    <div class="col-md-auto mt-3">
                        <span>Сайт</span>
                        <a @if ($item['link']) href="{{ $item['link'] }}" @endif class="contact-link">
                            {{ $item['link'] ?? '-' }}
                        </a>
                    </div>
                </div>
                <div class="col-md-2">
                    <a href="/account/profile/<?=$item['slug'] ?>" class="btn btn-red btn-icon mt-3">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M21 11.9999C20.7348 11.9999 20.4804 12.1053 20.2929 12.2928C20.1054 12.4804 20 12.7347 20 12.9999V18.9999C20 19.2652 19.8946 19.5195 19.7071 19.707C19.5196 19.8946 19.2652 19.9999 19 19.9999H5C4.73478 19.9999 4.48043 19.8946 4.29289 19.707C4.10536 19.5195 4 19.2652 4 18.9999V4.99994C4 4.73472 4.10536 4.48037 4.29289 4.29283C4.48043 4.1053 4.73478 3.99994 5 3.99994H11C11.2652 3.99994 11.5196 3.89458 11.7071 3.70705C11.8946 3.51951 12 3.26516 12 2.99994C12 2.73472 11.8946 2.48037 11.7071 2.29283C11.5196 2.1053 11.2652 1.99994 11 1.99994H5C4.20435 1.99994 3.44129 2.31601 2.87868 2.87862C2.31607 3.44123 2 4.20429 2 4.99994V18.9999C2 19.7956 2.31607 20.5587 2.87868 21.1213C3.44129 21.6839 4.20435 21.9999 5 21.9999H19C19.7956 21.9999 20.5587 21.6839 21.1213 21.1213C21.6839 20.5587 22 19.7956 22 18.9999V12.9999C22 12.7347 21.8946 12.4804 21.7071 12.2928C21.5196 12.1053 21.2652 11.9999 21 11.9999ZM6 12.7599V16.9999C6 17.2652 6.10536 17.5195 6.29289 17.707C6.48043 17.8946 6.73478 17.9999 7 17.9999H11.24C11.3716 18.0007 11.5021 17.9755 11.6239 17.9257C11.7457 17.8759 11.8566 17.8026 11.95 17.7099L18.87 10.7799L21.71 7.99994C21.8037 7.90698 21.8781 7.79637 21.9289 7.67452C21.9797 7.55266 22.0058 7.42195 22.0058 7.28994C22.0058 7.15793 21.9797 7.02722 21.9289 6.90536C21.8781 6.7835 21.8037 6.6729 21.71 6.57994L17.47 2.28994C17.377 2.19621 17.2664 2.12182 17.1446 2.07105C17.0227 2.02028 16.892 1.99414 16.76 1.99414C16.628 1.99414 16.4973 2.02028 16.3754 2.07105C16.2536 2.12182 16.143 2.19621 16.05 2.28994L13.23 5.11994L6.29 12.0499C6.19732 12.1434 6.12399 12.2542 6.07423 12.376C6.02446 12.4979 5.99924 12.6283 6 12.7599ZM16.76 4.40994L19.59 7.23994L18.17 8.65994L15.34 5.82994L16.76 4.40994ZM8 13.1699L13.93 7.23994L16.76 10.0699L10.83 15.9999H8V13.1699Z" fill="white"/>
                            </svg>                            
                        Редактировать
                    </a>
                </div>
            </div>
        </div>
    </main>

    <x-client.footer.footer-component />
</body>
</html>