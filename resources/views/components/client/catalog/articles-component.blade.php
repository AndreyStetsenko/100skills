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
                    <?php foreach ( (isset($items) ? $items : array()) as $value): ?>
                        <li class="uk-width-4-5 uk-width-2-5@m">
                            <div>
                                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative post-box">
                                    <div class="col p-4 d-flex flex-column position-static">
                                    <?php if ( $value["category"] != null && $value["category"]->first() != null ): ?>
                                        <strong class="d-inline-block post-tag mt-3"><?=$value["category"]->first()->title ?></strong>
                                    <?php endif ?>
                                    <h3 class="mb-0 mt-2">
                                        <?=$value["title"] ?>
                                    </h3>
                                    <p class="card-text">
                                        <?=$value["body_short"] ?>
                                    </p>
                                    <a href="/blog/<?=$value["slug"] ?>" class="stretched-link">                         
                                        Подробнее
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14.8302 11.29L10.5902 7.05001C10.4972 6.95628 10.3866 6.88189 10.2648 6.83112C10.1429 6.78035 10.0122 6.75421 9.88019 6.75421C9.74818 6.75421 9.61747 6.78035 9.49561 6.83112C9.37375 6.88189 9.26315 6.95628 9.17019 7.05001C8.98394 7.23737 8.87939 7.49082 8.87939 7.75501C8.87939 8.0192 8.98394 8.27265 9.17019 8.46001L12.7102 12L9.17019 15.54C8.98394 15.7274 8.87939 15.9808 8.87939 16.245C8.87939 16.5092 8.98394 16.7626 9.17019 16.95C9.26363 17.0427 9.37444 17.116 9.49628 17.1658C9.61812 17.2155 9.74858 17.2408 9.88019 17.24C10.0118 17.2408 10.1423 17.2155 10.2641 17.1658C10.3859 17.116 10.4967 17.0427 10.5902 16.95L14.8302 12.71C14.9239 12.617 14.9983 12.5064 15.0491 12.3846C15.0998 12.2627 15.126 12.132 15.126 12C15.126 11.868 15.0998 11.7373 15.0491 11.6154C14.9983 11.4936 14.9239 11.383 14.8302 11.29Z" fill="#1C1938"/>
                                        </svg>
                                        </a>
                                    </div>
                                    <div class="col-auto d-none d-lg-block p-2">
                                    <?php if ( $value["gallery"] != null && $value["gallery"]->first() != null ): ?>
                                        <img src="<?=$value["gallery"]->first()->src ?>" 
                                             width="100%" 
                                             alt=""
                                             style="height: 270px; width: 160px; object-fit: cover; object-position: center;">
                                    <?php else: ?>
                                        <img src="/public/files/no-image.png" width="100%"
                                             style="height: 270px; width: 160px; object-fit: cover; object-position: center;">
                                    <?php endif ?>
                            
                                    </div>
                                </div>
                            </div>
                        </li>                       
                    <?php endforeach ?>
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