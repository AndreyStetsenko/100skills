<!DOCTYPE html>
<html lang="en">
<head>
    <x-client.head.head-page-component />
    <?php if ( !1 ): ?>
	    <title><?=@$item->pages['meta_title'] ?></title>
			<meta name="keywords" content="<?=@$item->pages['meta_description'] ?>" />
			<meta name="description" content="<?=@$item->pages['meta_keywords'] ?>">
    <?php endif ?>
</head>
<body>
	<x-client.nav.page-component />

	<main class="main"> 
        <div class="container">
            <ul class="uk-breadcrumb">
                <li><a href="/">Главная</a></li>
                <li><a href="/blog">Блог</a></li>
            </ul>
        </div>
        
        <div class="page-baner">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 order-2 order-md-1 mt-4 mt-md-0">
                        <!-- <strong class="d-inline-block post-tag mt-3 right-line">МОДА</strong> -->
                        <!-- <span class="author">January 1, 2021 by Mark</span> -->
                        <h1><?=@$item->pages['meta_title'] ?></h1>
                        <?=(isset($item->pages['body']) && !empty($item->pages['body']) ? $item->pages['body'] : "Контент страницы не добавлен.") ?>

                    </div>
                </div>
            </div>
        </div>
    </main>

    <x-client.footer.footer-component />

  </body>
</html>