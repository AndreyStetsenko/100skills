<?php if ( !isset($items) ): ?>
    
<?php else: ?>
    <div class="row mt-5 section-last">
        <?php foreach ( (isset($items) ? $items : array()) as $value): ?>
            <div class="col-md-4 order-1 order-md-2">
                <div class="you-tarif p-4 p-md-5 p-relative">
                    <h3 class="m-0"><?=$value["title"] ?></h3>
                    <p></p>
                    <h4 class="mt-6 mb-3">Стоимость тарифа</h4>
                    <p class="tarif-date mt-0 mb-0">1 месяц: <?=$value["price_1"] ?>₽</p>
                    <p class="tarif-date mt-0 mb-4">3 месяца: <?=$value["price_3"] ?>₽</p>
                    <a href="/account/tarif/<?=$value['slug'] ?>" class="btn btn-red">Оплатить тариф</a>
                    <img src="/resources/img/tarif.svg" class="tarif-img" alt="" />
                </div>
            </div>
        <?php endforeach ?> 
    </div> 
<?php endif ?>