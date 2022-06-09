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
            @if( session('status') )
                <div class="auth-form-box login">
                    <article>
                        <div>
                            <small>{{ session('status') }}</small>
                        </div>
                    </article>
                    <br />
                </div>
                <br />
            @endif            
            @if( $errors->any() )
                <div style="margin-bottom: 15px;" class="auth-form-box login">
                    <article>
                        <b><p>Произошла ошибка</p></b>
                        @error('email')
                            <div>
                                <small>{{ $message }}</small>
                            </div>
                        @enderror
                        @error('password')
                            <div>
                                <small>{{ $message }}</small>
                            </div>
                        @enderror
                    </article>
                </div>
            @endif
            <div class="auth-form-box login">
                <h4>Вход</h4>
                <div class="row">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <input type="hidden" checked="checked" name="remember"/>

                        <div class="col-md-12">
                            <label>Email:</label>
                            <input class="uk-input" id="email" type="email" name="email" placeholder="example@gmail.com">
                        </div>
                        <div class="mt-3 col-md-12">
                            <label>Пароль:</label>
                            <input class="uk-input" id="password" type="password" name="password" placeholder="example@gmail.com">
                        </div>
                        <div class="mt-3 col-md-12">
                            <a style="font-size: 12px; display: block; color: #1e87f0;" href="/account/register">Регистрация</a>
                            <a style="font-size: 12px; display: block; color: #1e87f0;" href="/account/reset-password">Забыли пароль?</a>
                        </div>
                        <div class="col-md-6 mt-3">
                            <button type="submit" class="btn btn-red contact-form-btn">Войти</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <x-client.footer.footer-component />
</body>
</html>