<footer class="footer">
    <div class="container">
        <div class="row align-items-md-center align-items-start">
            <div class="col-md-4 col-4 order-2 order-md-1 mt-4 mt-md-0">
                <nav class="site-nav footer-nav">
                    <ul>
                        <?php foreach ( (isset($menu) ? $menu : array()) as $key => $value): ?>
                            <li><a href="/<?=$value['slug'] ?>"><?=$value['title'] ?></a></li>
                        <?php endforeach ?>
                    </ul>
                </nav>
            </div>
            <div class="col-md-4 uk-text-center order-1 order-md-2">
                <a href="/">
                    <img src="/resources/img/logo.svg" alt="100Skills" />
                </a>
            </div>
            <div class="col-md-4 col-8 mt-5 mt-md-0 order-3 order-md-3 uk-flex uk-flex-wrap uk-flex-right@m">
                <?php foreach ( (isset($contact) ? $contact : array()) as $key => $value): ?>
                    <?php if ( $value['slug'] == 'phone' ): ?>
                        <a href="<?=$value['href'] ?>" class="contact-link me-md-5">
                            <?=$value['value'] ?>
                        </a>
                    <?php else: ?>
                        <a class="contact-link me-md-5"></a>
                    <?php endif ?>
                    <?php if ( $value['slug'] == 'email' ): ?>
                        <a href="<?=$value['href'] ?>" class="contact-link me-md-5">
                            <?=$value['value'] ?>
                        </a>
                    <?php else: ?>
                        <a class="contact-link"></a>
                    <?php endif ?>                        
                <?php endforeach ?>
            </div>
        </div>
    </div>
</footer>