<!DOCTYPE html>
<html lang="en">
<head>
    <x-client.head.head-page-component />

    
</head>
<body>
    <x-client.nav.page-component />

    <main class="main"> 
        <div class="container">
            <x-client.nav.breadcrumb-component />
        </div>
        <section class="page-baner catalog-baner">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-6">
                        <h1>Каталог курсов</h1>
                        <p>Мы отобрали для вас лучшие курсы от ведущих школ и преподавателей страны в одном месте. Обучайтесь всем ключевым направлениям уже сейчас.</p>
                    </div>
                    <div class="col-md-5 m-none">
                        <x-client.forms.search-component />
                    </div>
                </div>
            </div>
        </section>

        <section class="section-last">
            <div class="container">
                <div class="row m-none">
                    <x-client.catalog.catalog-navigation-component />
                    <x-client.catalog.catalog-limit-component />
                </div>

                <div class="m-block">
                    <div class="row">
                        <div class="col-5">
                            <button class="filter-btn light-bg-btn border-none" type="button" style="width: 100%;" uk-toggle="target: #filter">
                                <span class="filter-img">Фильтр</span>
                            </button>

                            <div id="filter" uk-offcanvas="flip: true; overlay: true">
                                <div class="uk-offcanvas-bar">

                                    <button class="uk-offcanvas-close" type="button">+</button>
                                    
                                    <div class="mt-4">
                                        <x-client.catalog.filter-component />
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <button class="filter-btn uk-text-left" style="width: 100%;" type="button">
                                <span class="mobile-all-courses">Все курсы</span>
                            </button>
                            <div uk-dropdown="mode: click; boundary: .boundary">
                                <ul class="uk-nav uk-dropdown-nav">
                                    <li class="<?=(request()->getRequestUri() == '/catalog') ? 'uk-active' : '' ?>"> 
                                        <a href="/catalog">Все курсы</a>
                                    </li>
                                    <li class="<?=(request()->getRequestUri() == '/catalog?is_recomended=1') ? 'uk-active' : '' ?>">
                                        <a href="/catalog?is_recomended=1">Мы рекомендуем</a>
                                        
                                    </li>
                                    <li class="<?=(request()->getRequestUri() == '/catalog?is_popular=1') ? 'uk-active' : '' ?>">
                                        <a href="/catalog?is_popular=1">Популярные</a>
                                        
                                    </li>
                                    <li class="<?=(request()->getRequestUri() == '/catalog?is_action=1') ? 'uk-active' : '' ?>">
                                        <a href="/catalog?is_action=1">Акции</a>
                                        
                                    </li>
                                    <li class="<?=(request()->getRequestUri() == '/catalog/nearme') ? 'uk-active' : '' ?>">
                                        <a href="/catalog/nearme">Курсы рядом</a>
                                    </li>                                       
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Список курсов в каталоге-->
                <div class="row mt-5">
                    <div class="col-md-3 m-none" data-media="desktop">
                        <x-client.catalog.filter-component />
                    </div>
                    <div class="col-md-9">
                        <div class="row" data-row="catalog">
                            <?=(isset($template["render"]) ? $template["render"] : "") ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <x-client.footer.footer-component />
</body>
</html>