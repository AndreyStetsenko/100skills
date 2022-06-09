<!DOCTYPE html>
<html lang="en">
<head>
    <x-client.head.head-page-component />
</head>
<body>
    <!-- <x-client.form.form-lead-component /> -->
    <x-client.header.header-page-component />

   <main class="main">
        <div class="container auth-page">
            <div class="auth-form-box">
                <h4>Регистрация</h4>
                @if( $errors->any() )
                    <article>
                        <b><p>Произошла ошибка</p></b>
                        @error('name')
                            <div>
                                <p>{{ $name }}</p>
                            </div>
                        @enderror
                        @error('email')
                            <div>
                                <p>{{ $email }}</p>
                            </div>
                        @enderror
                        @error('password')
                            <div>
                                <p>{{ $password }}</p>
                            </div>
                        @enderror
                    </article>
                    <br />
                @endif
                <form method="POST" action="/register">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <label>Имя:</label>
                            <input class="uk-input" type="text" placeholder="Владимир" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label>Email:</label>
                            <input class="uk-input" type="email" placeholder="example@gmail.com" name="email" required>
                        </div>
                        <div class="mt-3 col-md-6">
                            <label>Пароль:</label>
                            <input class="uk-input" type="password" placeholder="Не менее 8-ми символов" name="password" required>
                        </div>
                        <div class="mt-3 col-md-6">
                            <label>Повторите пароль:</label>
                            <input class="uk-input" type="password" placeholder="Повторите пароль" name="password_confirmation" required>
                        </div>
                        <div class="mt-3 col-md-6">
                            <label>
                                <input name="type" value="school" class="uk-checkbox" type="radio" required></td>
                                <span>Школа</span>
                            </label>
                        </div>
                        <div class="mt-3 col-md-6">
                            <label>
                                <input name="type" value="teacher" class="uk-checkbox" type="radio"></td>
                                <span>Преподаватель</span>
                            </label>
                        </div>
                        <div class="mt-3 col-md-12">
                            <a style="font-size: 12px; display: block; color: #1e87f0;" href="/account/login">Войти в аккаунт</a>
                            <a style="font-size: 12px; display: block; color: #1e87f0;" href="/account/reset-password">Забыли пароль?</a>
                        </div>
                        <div class="col-md-6 mt-3">
                            <button type="submit" class="btn btn-red contact-form-btn">Зарегистрироваться</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <x-client.footer.footer-component />
</body>
</html>