<section class="section-hidden" data-component="section-popular">
    <div class="container">
        <h2>Популярные курсы</h2>
    </div>
        <ul class="uk-subnav uk-subnav-pill mt-5 tabs" uk-switcher>
            <?php foreach ( (isset($items["category"]) ? $items["category"] : array()) as $key => $value): ?>
                <li><a href="#"><?=$value['title'] ?></a></li>
            <?php endforeach ?>
            <?php if ( !1 ): ?>
                <li><a href="#">Маркетинг</a></li>
                <li><a href="#">Финансы</a></li>
                <li><a href="#">Точные науки</a></li>
                <li><a href="#">Иностранные языки</a></li>
                <li><a href="#">Дизайн</a></li>
                <li><a href="#">Бизнес</a></li>
            <?php endif ?>
        </ul>
        
        <ul class="uk-switcher mt-5 course-slides">
        @foreach ($categories as $category)
            <li>
                <div class="uk-position-relative uk-visible-toggle pb-4" tabindex="-1" uk-slider>
                    <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-5@m uk-grid">
                    @foreach ($category->catalog as $item)
                        @include('components.client.catalog.mini-item')
                    @endforeach
                    </ul>
                
                    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>
                </div>
            </li>
        @endforeach
        </ul>
    
</section>