<section class="section-hidden" data-component="section-found">
    <div class="container">
        <span class="subname">У НАС НАЙДЁТСЯ ВСЁ</span>
        <h2 class="mt-2 col-md-4">Выбери онлайн или оффлайн 
            курс по своему вкусу
        </h2>
    </div>
    
        <ul class="uk-subnav uk-subnav-pill mt-md-5 tabs tabs-right" uk-switcher >
            <li><a href="#">Онлайн</a></li>
            <li><a href="#">Оффлайн</a></li>
        </ul>
        <ul class="uk-switcher mt-5 course-slides">
                <li>
                    <div class="uk-position-relative uk-visible-toggle pb-4" tabindex="-1" uk-slider>

                        <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-5@m uk-grid">
                        @foreach ($courses as $item)
                        @if ($item->is_online == '1')
                            @include('components.client.catalog.mini-item')
                        @endif
                        @endforeach
                        </ul>
                    
                        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>
                    
                    </div>
                </li>
            
            <li>
                <div class="uk-position-relative uk-visible-toggle pb-4" tabindex="-1" uk-slider>

                    <ul class="uk-slider-items uk-child-width-1-2 uk-child-width-1-5@m uk-grid">
                        @foreach ($courses as $item)
                        @if ($item->is_online != '1')
                            @include('components.client.catalog.mini-item')
                        @endif
                        @endforeach
                    </ul>
                
                    <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                    <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>
                
                </div>
            </li>
            
        </ul>
    
</section>