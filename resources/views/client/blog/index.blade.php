<!DOCTYPE html>
<html lang="en">
<head>
    <x-client.head.head-page-component />
</head>
<body>
    <x-client.nav.page-component />
    <x-client.nav.blog-category-component />
    <main class="main"> 
      <?php if ( isset($index) && !empty($index) ): ?>
        <div class="container">
            <?php if ( $index["gallery"] != null && $index["gallery"]->last() != null ): ?>
              <div class="first-article uk-light" style="background-image: url(<?=$index['gallery']->last()->src ?>);">
            <?php else: ?>
              <div class="first-article uk-light" style="background-image: url('/public/files/no-image.png');">
              <!-- <div class="first-article uk-light" style="background-image: url('/resources/img/first-article.png');"> -->
            <?php endif ?>
                <div class="col-md-6">
                  <h1><?=$index["title"] ?></h1>
                  <p>
                    <?=$index["subtitle"] ?>
                  </p>
                  <a href="/blog/<?=$index["slug"] ?>" class="btn btn-red">Читать далее</a>
                </div>
            </div>
        </div>
      <?php endif ?>

      <div class="container mt-4">
        <div class="m-block uk-text-right">
          <button class="burger-nav cat-menu" type="button" uk-toggle="target: #blog-cat-mobile">
            Выбрать категорию <img src="/resources/img/burger.svg" width="20" alt="" />
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
                            <li><a href="">Мир</a></li>
                            <li><a href="">Технологии</a></li>
                            <li><a href="">Веб-дизайн</a></li>
                            <li><a href="">Интерфейсы</a></li>
                            <li><a href="">Экономика</a></li>
                            <li><a href="">Мода</a></li>
                            <li><a href="">Интерьер</a></li>
                            <li><a href="">Психология</a></li>
                            <li><a href="">Видеосъёмка</a></li>
                          </ul>
                        </nav>
                      </div>
                    </div>

                </div>
            </div>
        </div>
      </div>

        <div class="container pb-3">
            <div class="row mt-4 mb-2">
              <?php foreach ( (isset($items) ? $items : array()) as $key => $value): ?>
                <div class="col-md-6 mt-2">
                  <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
                      <?php if ( $value["category"] != null && $value["category"]->first() != null ): ?>
                        <strong class="d-inline-block post-tag mt-3"><?=$value["category"]->first()->title ?></strong>
                      <?php else: ?>
                        <strong class="d-inline-block post-tag mt-3">-</strong>
                      <?php endif ?>
                      <h3 class="mb-0 mt-2"><?=$value["title"] ?></h3>
                      <p class="card-text"><?=$value["body_short"] ?></p>
                      <a href="/blog/<?=$value["slug"] ?>" class="stretched-link">                         
                          Подробнее
                          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.8302 11.29L10.5902 7.05001C10.4972 6.95628 10.3866 6.88189 10.2648 6.83112C10.1429 6.78035 10.0122 6.75421 9.88019 6.75421C9.74818 6.75421 9.61747 6.78035 9.49561 6.83112C9.37375 6.88189 9.26315 6.95628 9.17019 7.05001C8.98394 7.23737 8.87939 7.49082 8.87939 7.75501C8.87939 8.0192 8.98394 8.27265 9.17019 8.46001L12.7102 12L9.17019 15.54C8.98394 15.7274 8.87939 15.9808 8.87939 16.245C8.87939 16.5092 8.98394 16.7626 9.17019 16.95C9.26363 17.0427 9.37444 17.116 9.49628 17.1658C9.61812 17.2155 9.74858 17.2408 9.88019 17.24C10.0118 17.2408 10.1423 17.2155 10.2641 17.1658C10.3859 17.116 10.4967 17.0427 10.5902 16.95L14.8302 12.71C14.9239 12.617 14.9983 12.5064 15.0491 12.3846C15.0998 12.2627 15.126 12.132 15.126 12C15.126 11.868 15.0998 11.7373 15.0491 11.6154C14.9983 11.4936 14.9239 11.383 14.8302 11.29Z" fill="#1C1938"/>
                          </svg>
                        </a>
                    </div>
                    <div class="col-auto d-none d-lg-block p-2">
                      <?php if ( $value["gallery"] != null && $value["gallery"]->last() != null ): ?>
                        <img style="height: 270px; width: 190px; object-fit: cover; object-position: left;" 
                             src="<?=$value["gallery"]->last()->src ?>" 
                             width="100%" 
                             alt="">
                      <?php else: ?>
                        <img style="height: 270px; width: 190px; object-fit: cover; object-position: left;" 
                             src="/public/files/no-image.png" 
                             width="100%" 
                             alt="">
                      <?php endif ?>
                    </div>
                  </div>
                </div>
              <?php endforeach ?>    
            </div>
            <?php if ( isset($pagination) ): ?>
              {{ $pagination->links("components.client.catalog.skills-pagination") }}
            <?php endif ?>
            <?php if ( !$items->count() ): ?>
                Записи не найдены.
            <?php endif ?>
        </div>

    </main>

    <x-client.footer.footer-component />
</body>
</html>