<x-panel.head.head-component />
<body>
    <div>
        <x-panel.header.header-component />
        <x-panel.nav.nav-component />

         <!-- Page Content -->
        <main id="app">
            <section data-component="item-list">
                <div row>
                    <article>
                        <div>
                            Добро пожаловать, <span class="text-gray-500">{{ Auth::user()->email }}</span>.
                        </div>
                    </article>
                </div>
                <div row>
                    <article>
                        <div>
                            Вы зашли в панель управления сайтом.
                        </div>
                    </article>
                </div>
            </section>
        </main>
    </div>
</body>
</html>
