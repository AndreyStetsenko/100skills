<!DOCTYPE html>
<html lang="en">
<head>
    <x-client.head.head-item-component />
    <title>{{ $item['meta_title'] ?? config('app.name') }}</title>
    <meta name="description" content="{{ $item['meta_description'] ?? config('app.name') }}" />
    <meta name="keywords" content="{{ $item['meta_keywords'] ?? config('app.name') }}" />
    <link rel="canonical" href="{{ $item['meta_canonical'] ?? '' }}" />
</head>
<body>
    <x-client.nav.page-component />

    <main class="main"> 
        <div class="container">
            <ul class="uk-breadcrumb">
                <li><a href="/">Главная</a></li>
                <li><a href="/blog">Блог</a></li>
                <li class="uk-disabled"><a><?=$item["title"] ?></a></li>
            </ul>
        </div>
        
        <div class="page-baner">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 order-2 order-md-1 mt-4 mt-md-0">
                        <?php if ( $item["category"]->first() != null ): ?>
                            <strong class="d-inline-block post-tag mt-3 right-line"><?=$item["category"]->first()->title ?></strong>
                        <?php else: ?>
                            <strong class="d-inline-block post-tag mt-3 right-line">-</strong>
                        <?php endif ?>
                        <!-- <span class="author">January 1, 2021 by Mark</span> -->
                        <h1 class="mt-2"><?=$item["title"] ?></h1>
                        <?=$item["body_short"] ?>
                        <?=$item["body_long"] ?>

                    </div>
                    <div class="col-md-4 order-md-2 order-1 uk-text-right single-article-image">
                        <div style="z-index: 980;" uk-sticky="offset: 100px; bottom: true">
                            <?php if ( $item["gallery"]->first() != null ): ?>
                                <img src="<?=$item["gallery"]->first()->src ?>" width="100%" alt="">
                            <?php else: ?>
                                <img src="/resources/img/article-1.png" width="100%" alt="">
                            <?php endif ?>
                            <!-- <img src="/resources/img/article-single.png" alt="" /> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <x-client.footer.footer-component />
</body>
</html>