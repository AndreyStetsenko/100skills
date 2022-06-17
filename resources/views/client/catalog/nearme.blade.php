<!DOCTYPE html>
<html lang="en">
<head>
    <x-client.head.head-page-component />
<script>

    var renderNearmeCourse = function(template = "") {
        console.log("render done");
        document.querySelector(`[data-row="catalog"]`).insertAdjacentHTML("afterbegin", template);
        return;
    }
    var renderTemplate = function(template = "") {
        console.log("render done");
        document.querySelector(`[data-row="catalog"]`).innerHTML = template;
        return;
    }
    document.addEventListener("DOMContentLoaded", function () {
        navigator.geolocation.getCurrentPosition(position => {
            var latitude = position.coords.longitude;
            var longitude = position.coords.latitude;
            console.log(position.coords)
            // const { latitude, longitude } = position.coords;
            var request_data = {
                latitude: latitude,
                longitude: longitude,
            };
            
            fetch(`/api/geocode/point`, {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": document.querySelector(`[name="csrf-token"]`).getAttribute("content"),
                },
                method: 'POST',
                body: JSON.stringify(request_data)
            })
            .then(function(response) {
                if( response.status != 200 && response.status != 422 ){
                    /* если ответ не 200 - что-то случилось, обработаем ошибку */
                    /* если ответ не 422 - ответ от валидатора Request */
                    // vm.showToasts([`Ошибка на стороне сервера.`, `Повторите попытку позже и обратитесь к администратору сайта.`]);
                }
                return response.json();
            })
            .then(function(data){
                // renderNearmeCourse(data['result']['template']);
                renderTemplate(data["template"]["render"]);
            });
            return;
        });
    });
</script>
</head>
<body>
    <x-client.nav.page-component />

    <main class="main"> 
        <div class="container">
            <x-client.nav.breadcrumb-component />
        </div>
        <section class="page-baner catalog-baner">
            <div class="container">
                <div class="row justify-content-between">
                    <div class="col-md-6">
                        <h1>Каталог курсов</h1>
                        <p>Мы отобрали для вас лучшие курсы от ведущих школ и преподавателей страны в одном месте. Обучайтесь всем ключевым направлениям уже сейчас.</p>
                    </div>
                    <div class="col-md-5 m-none">
                        <x-client.forms.search-component />
                    </div>
                </div>
            </div>
        </section>

        <section class="section-last">
            <div class="container">
                <div class="row m-none">
                    <x-client.catalog.catalog-navigation-component />
                    <x-client.catalog.catalog-limit-component />
                </div>

                <div class="m-block">
                    <div class="row">
                        <div class="col-5">
                            <button class="filter-btn light-bg-btn border-none" type="button" style="width: 100%;" uk-toggle="target: #filter">
                                <span class="filter-img">Фильтр</span>
                            </button>

                            <div id="filter" uk-offcanvas="flip: true; overlay: true">
                                <div class="uk-offcanvas-bar">

                                    <button class="uk-offcanvas-close" type="button">+</button>
                                    
                                    <div class="mt-4">
                                        <x-client.catalog.filter-component />
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-7">
                            <button class="filter-btn uk-text-left" style="width: 100%;" type="button">
                                <span class="mobile-all-courses">Все курсы</span>
                            </button>
                            @include('client.catalog.nav-filter')
                        </div>
                    </div>
                </div>

                <!--Список курсов в каталоге-->
                <div class="row mt-5">
                    <div class="col-md-3 m-none">
                        <x-client.catalog.filter-component />
                    </div>
                    <div class="col-md-9">
                        <div class="row" data-row="catalog">
                        </div>
                        <div class="row">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <x-client.footer.footer-component />
</body>
</html>