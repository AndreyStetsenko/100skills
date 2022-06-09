<ul class="uk-breadcrumb">
    <li><a href="/">Главная</a></li>
    <li><a href="/catalog">Каталог</a></li>
    <?php if ( !empty($links) ): ?>
        <?php foreach ($links as $key => $value): ?>
            <li><a style="cursor: inherit;"><?=$value ?></a></li>
        <?php endforeach ?>
    <?php endif ?>
    <!-- <li class="uk-disabled"><a>Онлайн курсы</a></li> -->
</ul>