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
            @if( $errors->any() )
                <div class="auth-form-box login" style="margin-bottom: 15px;">
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
                    <br />
                </div>
            @endif
            @if( session('status') )
                <div class="auth-form-box login" style="margin-bottom: 15px;">
                    <article>
                        <div>
                            <small>{{ session('status') }}</small>
                        </div>
                    </article>
                </div>
            @endif
            <div class="auth-form-box login">
                <h4>Восстановление пароля</h4>
                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-12">
                            <label>Email привязанный к аккаунту:</label>
                            <input class="uk-input"  id="email" type="email" name="email" placeholder="example@gmail.com">
                        </div>
                        <div class="mt-3 col-md-12">
                            <a style="font-size: 12px; display: block; color: #1e87f0;" href="/account/login">Войти в аккаунт</a>
                            <a style="font-size: 12px; display: block; color: #1e87f0;" href="/account/register">Регистрация</a>
                        </div>
                        <div class="col-md-6 mt-3">
                            <button type="submit" name="action" class="btn btn-red contact-form-btn">Сбросить пароль</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <x-client.footer.footer-component />
</body>
</html>