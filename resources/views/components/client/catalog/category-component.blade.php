<section class="section" data-component="section-category">
    <div class="container">
        <div class="row m-none">
            <div class="col-md-3">
                <?php $items["category"] = array_values($items["category"]); ?>
                <?php foreach ( (isset($items["category"]) ? $items["category"] : array()) as $category_key => $category): ?>
                    <?php if ($category_key >= 2) continue;  ?>
                    <div class="border light-bg p-4 <?= ($category_key > 0) ? "mt-4" : "" ?>">
                        <a href="/catalog?category_id=<?=$category['id'] ?>" class="btn border-btn-red"><?=$category['title'] ?></a>
                        <ul class="course-list mt-4">
                            <?php foreach ( (isset($category['childs']) ? $category['childs'] : array()) as $key => $value): ?>
                                <?php if (($key > 3)) continue;  ?>
                                <li><a href="/catalog?category_id=<?=$value['id'] ?>"><?=$value['title'] ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <?php unset($items["category"][$category_key]); ?>
                <?php endforeach ?>
            </div>
            <div class="col-md-3">
                <?php $items["category"] = array_values($items["category"]); ?>
                <?php foreach ( (isset($items["category"]) ? $items["category"] : array()) as $category_key => $category): ?>
                    <?php if ($category_key >= 1) continue;  ?>
                    <div class="border light-bg p-4 <?= ($category_key > 0) ? "mt-4" : "" ?>">
                        <a href="/catalog?category_id=<?=$category['id'] ?>" class="btn border-btn-red"><?=$category['title'] ?></a>
                        <ul class="course-list mt-4">
                            <?php foreach ( (isset($category['childs']) ? $category['childs'] : array()) as $key => $value): ?>
                                <?php if (($key >= 13)) continue;  ?>
                                <li><a href="/catalog?category_id=<?=$value['id'] ?>"><?=$value['title'] ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <?php unset($items["category"][$category_key]); ?>
                <?php endforeach ?>
            </div>
            <div class="col-md-3">
                <?php $items["category"] = array_values($items["category"]); ?>
                <?php foreach ( (isset($items["category"]) ? $items["category"] : array()) as $category_key => $category): ?>
                    <?php if ($category_key >= 2) continue;  ?>
                    <div class="border light-bg p-4 <?= ($category_key > 0) ? "mt-4" : "" ?>">
                        <a href="/catalog?category_id=<?=$category['id'] ?>" class="btn border-btn-red"><?=$category['title'] ?></a>
                        <ul class="course-list mt-4">
                            <?php foreach ( (isset($category['childs']) ? $category['childs'] : array()) as $key => $value): ?>
                                <?php if (($key > 3)) continue;  ?>
                                <li><a href="/catalog?category_id=<?=$value['id'] ?>"><?=$value['title'] ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <?php unset($items["category"][$category_key]); ?>
                <?php endforeach ?>
            </div>
            <div class="col-md-3">
                <?php $items["category"] = array_values($items["category"]); ?>
                <?php foreach ( (isset($items["category"]) ? $items["category"] : array()) as $category_key => $category): ?>
                    <?php if ($category_key >= 1) continue;  ?>
                    <div class="border light-bg p-4 <?= ($category_key > 0) ? "mt-4" : "" ?>">
                        <a href="/catalog?category_id=<?=$category['id'] ?>" class="btn border-btn-red"><?=$category['title'] ?></a>
                        <ul class="course-list mt-4">
                            <?php foreach ( (isset($category['childs']) ? $category['childs'] : array()) as $key => $value): ?>
                                <?php if (($key >= 13)) continue;  ?>
                                <li><a href="/catalog?category_id=<?=$value['id'] ?>"><?=$value['title'] ?></a></li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                    <?php unset($items["category"][$category_key]); ?>
                <?php endforeach ?>
            </div>
        </div>
        <ul class="m-block" uk-accordion>
            <?php foreach ( (isset($items_raw["category"]) ? $items_raw["category"] : array()) as $category_key => $category): ?>
                <li class="">
                    <a class="uk-accordion-title border p-3 light-bg" 
                       href="/catalog?category_id=<?=$category['id'] ?>">
                        <?=$category['title'] ?>    
                    </a>
                    <div class="uk-accordion-content">
                        <div class="p-2">
                            <?php if ( !1 ): ?>
                                <a href="/catalog?category_id=<?=$category['id'] ?>" 
                                   class="btn border-btn-red">
                                    <?=$category['title'] ?>    
                                </a>
                            <?php endif ?>
                            <ul class="course-list mt-4">
                                <?php foreach ( (isset($category['childs']) ? $category['childs'] : array()) as $key => $value): ?>
                                    <li>
                                        <a href="/catalog?category_id=<?=$value['id'] ?>">
                                            <?=$value['title'] ?>    
                                        </a>
                                    </li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
</section>