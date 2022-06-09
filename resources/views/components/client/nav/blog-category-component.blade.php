<?php if ( !empty($items) ): ?>
    <div class="blog-category container pb-4">
      <nav class="blog-nav m-none">
        <ul>
            <?php foreach ($items as $key => $value): ?>
                <li><a href="/blog?category_id=<?=$value["id"] ?>"><?=$value["title"] ?></a></li>
            <?php endforeach ?>
        </ul>
      </nav>
    </div>
<?php endif ?>