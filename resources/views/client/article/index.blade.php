<!DOCTYPE html>
<html lang="en">
<head>
    <x-client.head.head-page-component />
</head>
<body>
    <x-client.nav.page-component />

    <main class="main"> 
        <div class="container">
            <ul class="uk-breadcrumb">
                <li><a href="#">Главная</a></li>
                <li><a href="#">Блог</a></li>
                <li class="uk-disabled"><a>Фундаментальный JavaScript. С практикой и проектами</a></li>
            </ul>
        </div>
        
        <div class="page-baner">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 order-2 order-md-1 mt-4 mt-md-0">
                        <strong class="d-inline-block post-tag mt-3 right-line">МОДА</strong>
                        <span class="author">January 1, 2021 by Mark</span>
                        <h1 class="mt-2">Фундаментальный JavaScript. С практикой и проектами</h1>
                        <p>This blog post shows a few different types of content that’s supported and styled with Bootstrap. 
                            Basic typography, lists, tables, images, code, and more are all supported as expected.
                        </p>

                        <p class="mt-5">
                            This is some additional paragraph placeholder content. It has been written to fill the available 
                            space and show how a longer snippet of text affects the surrounding content. 
                            We'll repeat it often to keep the demonstration flowing, so be on the lookout for this exact same string of text.
                        </p>

                        <h2>Blockquotes</h2>
                        <p>This is some additional paragraph placeholder content. It has been written to fill the available 
                            space and show how a longer snippet of text affects the surrounding content. 
                            We'll repeat it often to keep the demonstration flowing, so be on the lookout for this exact same string of text.
                        </p>
                        <p>
                            This is some additional paragraph placeholder content. It's a slightly shorter version of the other highly repetitive body text used throughout. This is an example unordered list:
                        </p>

                        <ul>
                            <li>First list item</li>
                            <li>Second list item with a longer description</li>
                            <li>Third list item to close it out</li>
                            <li>And this is an ordered list</li>
                            <li>First list item</li>
                        </ul>

                        <p>This is some additional paragraph placeholder content. It has been written to fill the available 
                            space and show how a longer snippet of text affects the surrounding content. 
                            We'll repeat it often to keep the demonstration flowing, so be on the lookout for this exact same string of text.
                        </p>
                        <p>
                            This is some additional paragraph placeholder content. It's a slightly shorter version of the other highly repetitive body text used throughout. This is an example unordered list:
                        </p>
                        <p>
                            This is some additional paragraph placeholder content. It has been written to fill the available 
                            space and show how a longer snippet of text affects the surrounding content. 
                            We'll repeat it often to keep the demonstration flowing, so be on the lookout for this exact same string of text.
                            This is some additional paragraph placeholder content. It has been written to fill the available 
                            space and show how a longer snippet of text affects the surrounding content. 
                            We'll repeat it often to keep the demonstration flowing, so be on the lookout for this exact same string of text.
                        </p>
                    </div>
                    <div class="col-md-4 order-md-2 order-1 uk-text-right single-article-image">
                        <div style="z-index: 980;" uk-sticky="offset: 100px; bottom: true">
                            <img src="/resources/img/article-single.png" alt="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <x-client.footer.footer-component />
</body>
</html>