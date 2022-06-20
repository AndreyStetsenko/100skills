<?php # dd(__METHOD__, $item); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <x-client.head.head-item-component />

    <title>{{ $course->title ?? config('app.name') }}</title>
    <meta name="description" content="{{ $course->meta_description ?? config('app.name') }}" />
    <meta name="keywords" content="{{ $course->meta_keywords ?? config('app.name') }}" />
    <link rel="canonical" href="{{ $course->meta_canonical ?? '' }}" />
</head>
<body>
    <x-client.nav.page-component />

    <main class="main">
        <div class="container">
            <x-client.nav.breadcrumb-component :links="array(($course->title))"/>
        </div>
        <div class="container course-header mt-5">
            <div class="course-header-wrapper">
                <div class="row justify-content-between">
                    <div class="col-md-6">
                        <h1>
                            {{ $course->title ?? 'Наименование не указано.' }}
                        </h1>
                        <p>
                            {!! $course->body_short ?? 'Краткое описание не указано.' !!}
                        </p>

                        <a href="{{ $course->link }}" class="btn btn-red">
                            <span class="m-none">Перейти на сайт курса</span>
                            <span class="m-block">На сайт</span>
                        </a>
                        <a href="/school/{{ $course->school->slug }}" class="btn btn-light">Подробнее о школе</a>
                    </div>

                    <div class="col-md-4">
                        <div class="uk-panel p-3 border white-bg card-stisky">
                            @if ( $course->gallery->first() != null )
                                <div class="uk-card-photo">
                                    <img data-src="<?=$course->gallery->first()->src ?>" width="100%" alt="">
                                    @if ( $course->action->is_visible??null == 1 )
                                        @if ( ($course->action->date_end ?? null) > now() )
                                        <span class="label-action-end">Акция до {{ date('d.m', strtotime($course->action->date_end)) }}</span>
                                        @endif
                                    @endif
                                </div>
                            @else
                                <div class="uk-card-photo">
                                    <img src="/resources/img/no-photo.png" width="100%" alt="">
                                    @if ( $course->action->is_visible??null == 1 )
                                        @if ( ($course->action->date_end ?? null) > now() )
                                        <span class="label-action-end">Акция до {{ date('d.m', strtotime($course->action->date_end)) }}</span>
                                        @endif
                                    @endif
                                </div>
                            @endif

                            <h5 class="mt-4 mb-2">
                                {{ $course->title ?? 'Наименование не указано.' }}
                            </h5>
                            <span>
                                {{ $course->school->title ?? 'Автор не указан.' }}
                            </span>
                            <div class="uk-clearfix mt-3">
                                <div class="uk-float-left">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M11 2C9.02219 2 7.08879 2.58649 5.4443 3.6853C3.79981 4.78412 2.51809 6.3459 1.76121 8.17317C1.00433 10.0004 0.806299 12.0111 1.19215 13.9509C1.578 15.8907 2.53041 17.6725 3.92894 19.0711C5.32746 20.4696 7.10929 21.422 9.0491 21.8079C10.9889 22.1937 12.9996 21.9957 14.8268 21.2388C16.6541 20.4819 18.2159 19.2002 19.3147 17.5557C20.4135 15.9112 21 13.9778 21 12C21 10.6868 20.7413 9.38642 20.2388 8.17317C19.7363 6.95991 18.9997 5.85752 18.0711 4.92893C17.1425 4.00035 16.0401 3.26375 14.8268 2.7612C13.6136 2.25866 12.3132 2 11 2V2ZM11 20C9.41775 20 7.87104 19.5308 6.55544 18.6518C5.23985 17.7727 4.21447 16.5233 3.60897 15.0615C3.00347 13.5997 2.84504 11.9911 3.15372 10.4393C3.4624 8.88743 4.22433 7.46197 5.34315 6.34315C6.46197 5.22433 7.88743 4.4624 9.43928 4.15372C10.9911 3.84504 12.5997 4.00346 14.0615 4.60896C15.5233 5.21447 16.7727 6.23984 17.6518 7.55544C18.5308 8.87103 19 10.4177 19 12C19 14.1217 18.1572 16.1566 16.6569 17.6569C15.1566 19.1571 13.1217 20 11 20V20ZM14.1 12.63L12 11.42V7C12 6.73478 11.8946 6.48043 11.7071 6.29289C11.5196 6.10536 11.2652 6 11 6C10.7348 6 10.4804 6.10536 10.2929 6.29289C10.1054 6.48043 10 6.73478 10 7V12C10 12 10 12.08 10 12.12C10.0059 12.1889 10.0228 12.2564 10.05 12.32C10.0706 12.3793 10.0974 12.4363 10.13 12.49C10.1574 12.5468 10.1909 12.6005 10.23 12.65L10.39 12.78L10.48 12.87L13.08 14.37C13.2324 14.4564 13.4048 14.5012 13.58 14.5C13.8014 14.5015 14.0171 14.4296 14.1932 14.2953C14.3693 14.1611 14.4959 13.9722 14.5531 13.7583C14.6103 13.5444 14.5948 13.3176 14.5092 13.1134C14.4236 12.9092 14.2726 12.7392 14.08 12.63H14.1Z" fill="#E61D2B"/>
                                    </svg>
                                    <span>
                                        {{ $course->duration ? $course->duration . ' мес.' : 'Длительность не указана.' }}
                                    </span>
                                </div>
                                <div class="uk-float-right">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.50002 6.00002C7.20334 6.00002 6.91333 6.08799 6.66666 6.25281C6.41999 6.41763 6.22773 6.6519 6.1142 6.92599C6.00067 7.20008 5.97096 7.50168 6.02884 7.79265C6.08672 8.08362 6.22958 8.3509 6.43936 8.56068C6.64914 8.77046 6.91641 8.91332 7.20738 8.97119C7.49835 9.02907 7.79995 8.99937 8.07404 8.88584C8.34813 8.7723 8.5824 8.58005 8.74722 8.33337C8.91204 8.0867 9.00002 7.79669 9.00002 7.50002C9.00002 7.10219 8.84198 6.72066 8.56068 6.43936C8.27937 6.15805 7.89784 6.00002 7.50002 6.00002V6.00002ZM21.12 10.71L12.71 2.29002C12.6166 2.19734 12.5058 2.12401 12.3839 2.07425C12.2621 2.02448 12.1316 1.99926 12 2.00002H3.00002C2.7348 2.00002 2.48045 2.10537 2.29291 2.29291C2.10537 2.48045 2.00002 2.7348 2.00002 3.00002V12C1.99926 12.1316 2.02448 12.2621 2.07425 12.3839C2.12401 12.5058 2.19734 12.6166 2.29002 12.71L10.71 21.12C11.2725 21.6818 12.035 21.9974 12.83 21.9974C13.625 21.9974 14.3875 21.6818 14.95 21.12L21.12 15C21.6818 14.4375 21.9974 13.675 21.9974 12.88C21.9974 12.085 21.6818 11.3225 21.12 10.76V10.71ZM19.71 13.53L13.53 19.7C13.3427 19.8863 13.0892 19.9908 12.825 19.9908C12.5608 19.9908 12.3074 19.8863 12.12 19.7L4.00002 11.59V4.00002H11.59L19.71 12.12C19.8027 12.2135 19.876 12.3243 19.9258 12.4461C19.9756 12.5679 20.0008 12.6984 20 12.83C19.9989 13.0924 19.8948 13.3438 19.71 13.53V13.53Z" fill="#E61D2B"/>
                                    </svg>
                                    @if ( $course->action->is_visible??null == 1 )
                                        @if ( 
                                            (($course->action->date_end ?? null) > now())
                                            && (($course->action->date_start ?? null) < now())
                                            )
                                            <small><s>{{ $course->price }} ₽</s></small>
                                            <span>{{ $course->action->new_price??null }} ₽</span>
                                        @else
                                            <span>{{ $course->price }} ₽</span>
                                        @endif
                                    @else
                                        <span>{{ $course->price }} ₽</span>
                                    @endif
                                </div>
                            </div>
                            <a href="" class="btn border-btn-dark btn-block mt-4">Посмотреть курс</a>
                            @if ( $course->action->is_visible??null == 1 )
                                @if ( ($course->action->date_end ?? null) > now() )
                                <span class="d-block mt-2">Срок акции до {{ date('d.m', strtotime($course->action->date_end)) }}</span>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-7">
                        <h2>Чему Вы научитесь:</h2>
                        {!! $course->body_goals ?? 'Текст не указан.' !!}

                        <h2>Описание курса</h2>
                        {!! $course->body_long ?? 'Текст не указан.' !!}
                        

                        <a style="display: block; width: max-content;" href="{{ $course->link }}" class="btn btn-red mt-4">Перейти на сайт курса</a>
                    </div>
                </div>
            </div>
        </section>

        <x-client.catalog.similar-component :id="$course->id" />
    </main>

    <x-client.footer.footer-component />
</body>
</html>