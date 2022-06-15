<!DOCTYPE html>
<html lang="en">
    <head>
        <x-client.head.head-page-component />
    </head>
    <body>
        <!-- <x-client.form.form-lead-component /> -->
        <x-client.header.header-lk-component />
        <main class="main">
            <div class="container">
                <div class="row m-block">
                    <div class="col-9">
                        <h1 class="mt-5">Мои акции</h1>
                    </div>
                    <div class="col-3">
                    </div>
                </div>
                <nav class="site-nav lk-nav mt-5 m-none">
                    <ul>
                        <li><a href="/account/profile" <?php if ( Route::current()->uri == "account/profile") print("class='current-page'");?>>Аккаунт</a></li>
                        <li><a href="/account/courses" <?php if ( Route::current()->uri == "account/courses") print("class='current-page'");?>>Мои курсы</a></li>
                        <li><a href="/account/actions" <?php if ( Route::current()->uri == "account/actions") print("class='current-page'");?>>Мои акции</a></li>
                        <li><a href="/account/tarif" <?php if ( Route::current()->uri == "account/tarif") print("class='current-page'");?>>Тарифы и оплата</a></li>
                    </ul>
                </nav>
                <section class="section-last">
                    <h1 class="mt-5">
                        Создать акцию
                    </h1>
                    <?php if ( isset($messages) && !empty($messages) ): ?>
                    <ul data-component="toast" class="toast-forever show">
                        <li><?=$messages ?></li>
                    </ul>
                    <?php endif ?>
                    @if($errors->any())
                    <ul data-component="toast" class="toast-forever show">
                        <li><?=$errors->first() ?></li>
                    </ul>
                    @endif
                    <form action="{{ route('actions.store') }}" 
                        method="post">
                        @csrf

                        <div class="row">
                            <div class="col-md-7 row">
                                <div class="col-md-6 mb-4">
                                    <label>Наименование</label>
                                    <input type="text" 
                                        value=""
                                        name="title" class="uk-input" placeholder="Введите наименование" />
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label>Выберите курс</label>
                                    <select name="course_id" id="course_id" class="uk-input course-change-id">
                                        <option value="">Выберите курс</option>
                                        @foreach($courses as $course)
                                        <option value="{{ $course->id }}">{{ $course->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label>Основная цена</label>
                                    <input type="text" 
                                        value=""
                                        name="price_main" class="uk-input" placeholder="Цена" disabled>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label>Акционная цена</label>
                                    <input type="text" 
                                        value=""
                                        name="new_price" class="uk-input" placeholder="Цена">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label>Дата начала</label>
                                    <input type="date" 
                                            name="date_start" 
                                            class="uk-input" 
                                            placeholder="Дата начала"
                                            value="{{ $carbon->toDateString() }}"
                                            disabled>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label>Дата окончания</label>
                                    <input type="date" 
                                            name="date_end" 
                                            class="uk-input" 
                                            placeholder="Дата окончания"
                                            value="{{ $carbon->addDays(30)->toDateString() }}"
                                            disabled>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-red btn-icon">
                                        <svg width="18" height="19" viewBox="0 0 18 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M14.25 8.75H9.75V4.25C9.75 4.05109 9.67098 3.86032 9.53033 3.71967C9.38968 3.57902 9.19891 3.5 9 3.5C8.80109 3.5 8.61032 3.57902 8.46967 3.71967C8.32902 3.86032 8.25 4.05109 8.25 4.25V8.75H3.75C3.55109 8.75 3.36032 8.82902 3.21967 8.96967C3.07902 9.11032 3 9.30109 3 9.5C3 9.69891 3.07902 9.88968 3.21967 10.0303C3.36032 10.171 3.55109 10.25 3.75 10.25H8.25V14.75C8.25 14.9489 8.32902 15.1397 8.46967 15.2803C8.61032 15.421 8.80109 15.5 9 15.5C9.19891 15.5 9.38968 15.421 9.53033 15.2803C9.67098 15.1397 9.75 14.9489 9.75 14.75V10.25H14.25C14.4489 10.25 14.6397 10.171 14.7803 10.0303C14.921 9.88968 15 9.69891 15 9.5C15 9.30109 14.921 9.11032 14.7803 8.96967C14.6397 8.82902 14.4489 8.75 14.25 8.75Z" fill="white"/>
                                        </svg>
                                        Сохранить информацию
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>
            </div>
        </main>
        <x-client.footer.footer-component />

        <script>
            $('.course-change-id').on('change', function() {
                var course_id = $(this).val();
                $.ajax({
                    url: '/account/actions/get-course/' + course_id,
                    type: 'GET',
                    success: function(data) {
                        item = data[0];
                        $('[name="price_main"]').val(item.price);
                    }
                });
            });
        </script>
    </body>
</html>