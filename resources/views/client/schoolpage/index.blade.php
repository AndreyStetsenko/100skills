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
                <li><a href="{{ route('home') }}">Главная</a></li>
                <li><a href="/catalog">Каталог</a></li>
                <li class="uk-disabled"><a>{{ $school->title }}</a></li>
            </ul>
        </div>

        <div class="page-baner">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <h1>{{ $school->title }}</h1>
                        {!! $school->body_short !!}
                    </div>
                    <div class="col-md-5 uk-text-right school-img">
                        @if (count($school->gallery) != 0)
                            @foreach ($school->gallery as $gal)
                                <img src="{{ $gal->src }}" width="100%" alt="" сlass="img-item-course">
                            @endforeach
                        @else
                            <img src="/resources/img/no-photo.png" width="100%" alt="" сlass="img-item-course">
                        @endif
                    </div>
                </div>

                <hr class="mt-4 mb-0" />
            </div>
        </div>

        <div class="container">
            <a class="btn btn-red right-btn-icon" type="button" uk-toggle="target: #toggle-usage" data-stat="click" data-stat-type="open_contacts">
                Покаказать конткты
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.92 11.6199C17.8724 11.4972 17.801 11.385 17.71 11.2899L12.71 6.28994C12.6168 6.1967 12.5061 6.12274 12.3842 6.07228C12.2624 6.02182 12.1319 5.99585 12 5.99585C11.7337 5.99585 11.4783 6.10164 11.29 6.28994C11.1968 6.38318 11.1228 6.49387 11.0723 6.61569C11.0219 6.73751 10.9959 6.86808 10.9959 6.99994C10.9959 7.26624 11.1017 7.52164 11.29 7.70994L14.59 10.9999H7C6.73478 10.9999 6.48043 11.1053 6.29289 11.2928C6.10536 11.4804 6 11.7347 6 11.9999C6 12.2652 6.10536 12.5195 6.29289 12.707C6.48043 12.8946 6.73478 12.9999 7 12.9999H14.59L11.29 16.2899C11.1963 16.3829 11.1219 16.4935 11.0711 16.6154C11.0203 16.7372 10.9942 16.8679 10.9942 16.9999C10.9942 17.132 11.0203 17.2627 11.0711 17.3845C11.1219 17.5064 11.1963 17.617 11.29 17.7099C11.383 17.8037 11.4936 17.8781 11.6154 17.9288C11.7373 17.9796 11.868 18.0057 12 18.0057C12.132 18.0057 12.2627 17.9796 12.3846 17.9288C12.5064 17.8781 12.617 17.8037 12.71 17.7099L17.71 12.7099C17.801 12.6148 17.8724 12.5027 17.92 12.3799C18.02 12.1365 18.02 11.8634 17.92 11.6199Z" fill="white"/>
                </svg>                                
            </a>
            <div id="toggle-usage" hidden>
                <div class="row">
                    @if ($school->phone)
                    <div class="col-md-auto mt-3">
                        <span>Телефон</span>
                        <a href="#" class="contact-link">{{ $school->phone }}</a>
                    </div>
                    @endif
                    
                    @if ($school->email)
                    <div class="col-md-auto mt-3">
                        <span>Email</span>
                        <a href="#" class="contact-link">{{ $school->email }}</a>
                    </div>
                    @endif
                    
                    @if ($school->adress)
                    <div class="col-md-auto mt-3">
                        <span>Адрес</span>
                        <a href="#" class="contact-link">{{ $school->adress }}</a>
                    </div>
                    @endif
                    
                    @if ($school->link)
                    <div class="col-md-auto mt-3">
                        <span>Сайт</span>
                        <a href="#" class="contact-link" data-stat="click" data-stat-type="move_to_school_site">{{ $school->link }}</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <section class="section-hidden mt-5">
            <div class="container">
                <h2 class="mt-2 mb-5 col-md-4">Курсы школы</h2>
            </div>
            <div class="uk-position-relative uk-visible-toggle pb-4 course-slides" tabindex="-1" uk-slider>

                <ul class="uk-slider-items uk-child-width-1-3 uk-child-width-1-5@m uk-grid">
                @foreach ($course as $item)
                    @include('components.client.catalog.mini-item')
                @endforeach
                </ul>
            
                <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slider-item="next"></a>
            
            </div>
        </section>
    </main>

    <x-client.footer.footer-component />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.0.0-alpha.1/axios.min.js"></script>

    <script>
        $('[data-stat="click"]').on('click', function() {
            var type = $(this).attr('data-stat-type');
            var csrf = $('[name="csrf-token"]').attr('content');

            var request_data = {
                page_id: {{ $school->id }},
                type_page: 'school',
                type: type
            }

            axios.post('/statistic/store-action', {
                headers: {
                    "Content-Type": "application/json",
                    "Accept": "application/json",
                    "X-Requested-With": "XMLHttpRequest",
                    "X-CSRF-Token": csrf
                },
                body: request_data
            })
            .then(function(response){

            })
            .catch(function(error){
                console.log(error);
            });
        });
    </script>
</body>
</html>