<!DOCTYPE html>
<html lang="en">
<head>
    <x-client.head.head-page-component />
</head>
<body>
    <x-client.nav.page-component />

    <main class="main">
        <!-- <div class="container">
            <ul class="uk-breadcrumb">
                <li><a href="#">Главная</a></li>
                <li><a href="#">Блог</a></li>
                <li class="uk-disabled"><a>Фундаментальный JavaScript. С практикой и проектами</a></li>
            </ul>
        </div> -->
        
        <div class="page-baner">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1>Контакты</h1>
                        <div class="row mt-3">
                            <?php foreach ( (isset($items) ? $items : array()) as $key => $value): ?>
                                <div class="col-md-5 mt-3">
                                    <span><?=$value["title"] ?></span>
                                    <?php if ( !is_null($value["href"]) ): ?>
                                        <a href="<?=$value['href'] ?>" class="contact-link"><?=$value["value"] ?></a>
                                    <?php else: ?>
                                        <a class="contact-link"><?=$value["value"] ?></a>
                                    <?php endif ?>
                                </div>
                            <?php endforeach ?>    
                        </div>
                        <img src="/resources/img/contact-image.svg" class="contact-img" alt="" />
                    </div>
                    <div class="col-md-6 mt-5 mt-md-0">
                        <h3 class="m-0">Есть вопрос или предложение?</h3>
                        <p class="mt-2">Просто напишите нам об этом, и мы обязательно ответим!</p>

                        <form action="" method="">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Имя:</label>
                                    <input class="uk-input" type="text" placeholder="Владимир">
                                </div>
                                <div class="col-md-6">
                                    <label>Номер телефона:</label>
                                    <input class="uk-input" type="text" placeholder="Введите номер">
                                </div>
                                <div class="col-md-12 mt-3">
                                    <label>Ваше сообщение:</label>
                                    <textarea class="uk-textarea" rows="5" placeholder="Напишите сюда сообщение или вопрос"></textarea>
                                </div>
                                <div class="col-md-5 mt-3">
                                    <button type="submit" class="btn btn-red btn-block">
                                        Отправить сообщение
                                    </button>
                                </div>
                                <div class="col-md-7 mt-3">
                                    <p class="f-14">
                                        Ваши данные используются исключительно для связи с Вами и не будут переданны третьим лицам.
                                    </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <x-client.footer.footer-component />
</body>
</html>