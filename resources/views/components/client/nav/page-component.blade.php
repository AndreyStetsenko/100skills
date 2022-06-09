<header class="header container py-3">
    <div class="row align-items-center">
        <div class="col-4 col-md-2 logo">
            <a href="/">
                <img src="/resources/img/logo.svg" alt="100Skills" />
            </a>
        </div>
        <!-- Меню категорий -->
        <div class="col-6 col-md-2">
            <a uk-toggle="target: #offcanvas-category" 
               class="ctegory-btn btn-icon"
               style="cursor: pointer;">
                <svg width="22" height="17" viewBox="0 0 22 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect width="22" height="2.64" rx="1.32" fill="#E61D2B"/>
                    <rect width="22" height="2.64" rx="1.32" fill="#E61D2B"/>
                    <rect x="9.67969" y="14.08" width="12.32" height="2.64" rx="1.32" fill="#E61D2B"/>
                    <rect x="9.67969" y="14.08" width="12.32" height="2.64" rx="1.32" fill="#E61D2B"/>
                    <rect x="3.52051" y="7.04004" width="18.48" height="2.64" rx="1.32" fill="#E61D2B"/>
                    <rect x="3.52051" y="7.04004" width="18.48" height="2.64" rx="1.32" fill="#E61D2B"/>
                    </svg>                        
                Категории
            </a>
            <div id="offcanvas-category" uk-offcanvas="overlay: true">
                <div class="uk-offcanvas-bar">

                    <button class="uk-offcanvas-close" type="button">+</button>

                    
                    <div class="logo">
                        <a href="/">
                            <img src="/resources/img/logo.svg" width="100px" alt="100Skills" />
                        </a>
                    </div>


                    <nav class="site-nav">
                        <ul>
                            <li>
                                <a class="" href="/catalog">Каталог</a>
                            </li>
                            <?php foreach ( (isset($category) ? $category : array()) as $key => $value): ?>
                                <li>
                                    <a class="" href="/catalog/?category_id=<?=$value['id'] ?>"><?=$value['title'] ?></a>
                                </li>
                                <?php if ( !is_null($value["childs"]) ): ?>
                                    <ul data-component="subcategory" 
                                        class="subcat mb-4" 
                                        data-visible="short">
                                        <?php foreach ( (isset($value["childs"]) ? $value["childs"] : array()) as $k => $v): ?>
                                            <?php if ( $k < 4 ): ?>
                                                <li class="visible">
                                                    <a href="/catalog/?category_id=<?=$v['id'] ?>"><?=$v['title'] ?></a>
                                                </li>
                                            <?php else: ?>
                                                <li>
                                                    <a href="/catalog/?category_id=<?=$v['id'] ?>"><?=$v['title'] ?></a>
                                                </li>    
                                            <?php endif ?>
                                        <?php endforeach ?>
                                        <?php if ( count($value["childs"]) > 4 ): ?>
                                            <li class="visible"
                                                data-trigger="short">
                                                <a onclick="event.preventDefault(); event.currentTarget.closest(`[data-component='subcategory']`).dataset.visible = 'long';">Показать все</a>
                                            </li> 
                                            <li class="visible"
                                                data-trigger="long">
                                                <a onclick="event.preventDefault(); event.currentTarget.closest(`[data-component='subcategory']`).dataset.visible = 'short';">Скрыть</a>
                                            </li>    
                                        <?php endif ?>
                                    </ul>
                                <?php endif ?>
                            <?php endforeach ?>
                        </ul>
                    </nav> 
                    
                    <div style="display: none;" class="uk-position-bottom-right mobile-menu-add-course">
                        <?php if ( is_null(Auth::user()) ): ?>
                            <a href="/account/login" class="btn btn-red btn-icon">
                                <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.25 8.75H9.75V4.25C9.75 4.05109 9.67098 3.86032 9.53033 3.71967C9.38968 3.57902 9.19891 3.5 9 3.5C8.80109 3.5 8.61032 3.57902 8.46967 3.71967C8.32902 3.86032 8.25 4.05109 8.25 4.25V8.75H3.75C3.55109 8.75 3.36032 8.82902 3.21967 8.96967C3.07902 9.11032 3 9.30109 3 9.5C3 9.69891 3.07902 9.88968 3.21967 10.0303C3.36032 10.171 3.55109 10.25 3.75 10.25H8.25V14.75C8.25 14.9489 8.32902 15.1397 8.46967 15.2803C8.61032 15.421 8.80109 15.5 9 15.5C9.19891 15.5 9.38968 15.421 9.53033 15.2803C9.67098 15.1397 9.75 14.9489 9.75 14.75V10.25H14.25C14.4489 10.25 14.6397 10.171 14.7803 10.0303C14.921 9.88968 15 9.69891 15 9.5C15 9.30109 14.921 9.11032 14.7803 8.96967C14.6397 8.82902 14.4489 8.75 14.25 8.75Z" fill="white"/>
                                </svg>
                                Разместить курс
                            </a>
                        <?php else: ?>
                            <a href="/account/courses" class="btn btn-red btn-icon">
                                <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.25 8.75H9.75V4.25C9.75 4.05109 9.67098 3.86032 9.53033 3.71967C9.38968 3.57902 9.19891 3.5 9 3.5C8.80109 3.5 8.61032 3.57902 8.46967 3.71967C8.32902 3.86032 8.25 4.05109 8.25 4.25V8.75H3.75C3.55109 8.75 3.36032 8.82902 3.21967 8.96967C3.07902 9.11032 3 9.30109 3 9.5C3 9.69891 3.07902 9.88968 3.21967 10.0303C3.36032 10.171 3.55109 10.25 3.75 10.25H8.25V14.75C8.25 14.9489 8.32902 15.1397 8.46967 15.2803C8.61032 15.421 8.80109 15.5 9 15.5C9.19891 15.5 9.38968 15.421 9.53033 15.2803C9.67098 15.1397 9.75 14.9489 9.75 14.75V10.25H14.25C14.4489 10.25 14.6397 10.171 14.7803 10.0303C14.921 9.88968 15 9.69891 15 9.5C15 9.30109 14.921 9.11032 14.7803 8.96967C14.6397 8.82902 14.4489 8.75 14.25 8.75Z" fill="white"/>
                                </svg>
                                Разместить курс
                            </a>
                        <?php endif ?>
                    </div>

                </div>
            </div>
        </div>
        <!-- /Меню категорий -->
        <div class="m-none col-md-8 right-hrader">
            <nav class="site-nav">
                <ul>
                    <?php foreach ( (isset($menu) ? $menu : array()) as $key => $value): ?>
                        <li><a href="/<?=$value['slug'] ?>"><?=$value['title'] ?></a></li>
                    <?php endforeach ?>
                </ul>
            </nav>
            <div>
                <?php if ( is_null(Auth::user()) ): ?>
                    <a href="/account/login" class="btn btn-red btn-icon">
                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.25 8.75H9.75V4.25C9.75 4.05109 9.67098 3.86032 9.53033 3.71967C9.38968 3.57902 9.19891 3.5 9 3.5C8.80109 3.5 8.61032 3.57902 8.46967 3.71967C8.32902 3.86032 8.25 4.05109 8.25 4.25V8.75H3.75C3.55109 8.75 3.36032 8.82902 3.21967 8.96967C3.07902 9.11032 3 9.30109 3 9.5C3 9.69891 3.07902 9.88968 3.21967 10.0303C3.36032 10.171 3.55109 10.25 3.75 10.25H8.25V14.75C8.25 14.9489 8.32902 15.1397 8.46967 15.2803C8.61032 15.421 8.80109 15.5 9 15.5C9.19891 15.5 9.38968 15.421 9.53033 15.2803C9.67098 15.1397 9.75 14.9489 9.75 14.75V10.25H14.25C14.4489 10.25 14.6397 10.171 14.7803 10.0303C14.921 9.88968 15 9.69891 15 9.5C15 9.30109 14.921 9.11032 14.7803 8.96967C14.6397 8.82902 14.4489 8.75 14.25 8.75Z" fill="white"/>
                        </svg>
                        Разместить курс
                    </a>
                <?php else: ?>
                    <a href="/account/courses" class="btn btn-red btn-icon">
                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.25 8.75H9.75V4.25C9.75 4.05109 9.67098 3.86032 9.53033 3.71967C9.38968 3.57902 9.19891 3.5 9 3.5C8.80109 3.5 8.61032 3.57902 8.46967 3.71967C8.32902 3.86032 8.25 4.05109 8.25 4.25V8.75H3.75C3.55109 8.75 3.36032 8.82902 3.21967 8.96967C3.07902 9.11032 3 9.30109 3 9.5C3 9.69891 3.07902 9.88968 3.21967 10.0303C3.36032 10.171 3.55109 10.25 3.75 10.25H8.25V14.75C8.25 14.9489 8.32902 15.1397 8.46967 15.2803C8.61032 15.421 8.80109 15.5 9 15.5C9.19891 15.5 9.38968 15.421 9.53033 15.2803C9.67098 15.1397 9.75 14.9489 9.75 14.75V10.25H14.25C14.4489 10.25 14.6397 10.171 14.7803 10.0303C14.921 9.88968 15 9.69891 15 9.5C15 9.30109 14.921 9.11032 14.7803 8.96967C14.6397 8.82902 14.4489 8.75 14.25 8.75Z" fill="white"/>
                        </svg>
                        Разместить курс
                    </a>
                <?php endif ?>
            </div>
        </div>
        <!--Мобильное меню-->
        <div class="m-block col-2 uk-text-right">
            <button class="burger-nav" type="button" uk-toggle="target: #offcanvas-flip">
                <img src="/resources/img/burger.svg" width="100%" alt="" />
            </button>

            <div id="offcanvas-flip" uk-offcanvas="flip: true; overlay: true">
                <div class="uk-offcanvas-bar">

                    <button class="uk-offcanvas-close" type="button">+</button>

                    
                    <div class="logo uk-text-left">
                        <a href="/">
                            <img src="/resources/img/logo.svg" width="100px" alt="100Skills" />
                        </a>
                    </div>


                    <nav class="site-nav">
                        <ul>
                            <?php if ( !1 ): ?>
                                <li><a href="/article">Акции</a></li>
                                <li><a href="/school-page">Партнёрам</a></li>
                                <li><a href="/blog">Блог</a></li>
                                <li><a href="/contact">Контакты</a></li>
                                <li><a href="/article">Статья</a></li>
                            <?php endif ?>
                            <?php foreach ( (isset($menu) ? $menu : array()) as $key => $value): ?>
                                <li><a href="/<?=$value['slug'] ?>"><?=$value['title'] ?></a></li>
                            <?php endforeach ?>
                            <?php if ( !1 ): ?>
                                <li><a href="/catalog">Каталог</a></li>
                                <li><a href="/course">Курс</a></li>
                                <li><a href="/school-page">Школа</a></li>
                                <li><a href="/blog">Блог</a></li>
                                <li><a href="/contact">Контакты</a></li>
                            <?php endif ?>
                        </ul>
                    </nav> 
                    
                    <div class="uk-position-bottom-right mobile-menu-add-course">
                        <?php if ( is_null(Auth::user()) ): ?>
                            <a href="/account/login" class="btn btn-red btn-icon">
                                <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.25 8.75H9.75V4.25C9.75 4.05109 9.67098 3.86032 9.53033 3.71967C9.38968 3.57902 9.19891 3.5 9 3.5C8.80109 3.5 8.61032 3.57902 8.46967 3.71967C8.32902 3.86032 8.25 4.05109 8.25 4.25V8.75H3.75C3.55109 8.75 3.36032 8.82902 3.21967 8.96967C3.07902 9.11032 3 9.30109 3 9.5C3 9.69891 3.07902 9.88968 3.21967 10.0303C3.36032 10.171 3.55109 10.25 3.75 10.25H8.25V14.75C8.25 14.9489 8.32902 15.1397 8.46967 15.2803C8.61032 15.421 8.80109 15.5 9 15.5C9.19891 15.5 9.38968 15.421 9.53033 15.2803C9.67098 15.1397 9.75 14.9489 9.75 14.75V10.25H14.25C14.4489 10.25 14.6397 10.171 14.7803 10.0303C14.921 9.88968 15 9.69891 15 9.5C15 9.30109 14.921 9.11032 14.7803 8.96967C14.6397 8.82902 14.4489 8.75 14.25 8.75Z" fill="white"/>
                                </svg>
                                Разместить курс
                            </a>
                        <?php else: ?>
                            <a href="/account/courses" class="btn btn-red btn-icon">
                                <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.25 8.75H9.75V4.25C9.75 4.05109 9.67098 3.86032 9.53033 3.71967C9.38968 3.57902 9.19891 3.5 9 3.5C8.80109 3.5 8.61032 3.57902 8.46967 3.71967C8.32902 3.86032 8.25 4.05109 8.25 4.25V8.75H3.75C3.55109 8.75 3.36032 8.82902 3.21967 8.96967C3.07902 9.11032 3 9.30109 3 9.5C3 9.69891 3.07902 9.88968 3.21967 10.0303C3.36032 10.171 3.55109 10.25 3.75 10.25H8.25V14.75C8.25 14.9489 8.32902 15.1397 8.46967 15.2803C8.61032 15.421 8.80109 15.5 9 15.5C9.19891 15.5 9.38968 15.421 9.53033 15.2803C9.67098 15.1397 9.75 14.9489 9.75 14.75V10.25H14.25C14.4489 10.25 14.6397 10.171 14.7803 10.0303C14.921 9.88968 15 9.69891 15 9.5C15 9.30109 14.921 9.11032 14.7803 8.96967C14.6397 8.82902 14.4489 8.75 14.25 8.75Z" fill="white"/>
                                </svg>
                                Разместить курс
                            </a>
                        <?php endif ?>
                    </div>

                </div>
            </div>
        </div>
        <!--Мобильное меню-->
    </div>
</header>
