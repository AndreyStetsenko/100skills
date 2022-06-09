<section data-component="component-title">
    <div row>
        <h1>{{ $uri ?? "Панель управления" }}</h1>
        <section data-component='admin-navigation'>
            <div style="padding: 15px 0 5px 0;">
                <b>Доступные модули:</b>
            </div>
            <div navigation>
                <?php foreach ($catalog as $key => $value): ?>
                    <?php if ($value['title'] == $uri): ?>
                        <a>{{ $value['title'] }}</a>
                    <?php else: ?>
                        <a href="/{{ $value['link'] }}">{{ $value['title'] }}</a>
                    <?php endif ?>
                <?php endforeach ?>
            </div>
        </section>
    </div>
</section>