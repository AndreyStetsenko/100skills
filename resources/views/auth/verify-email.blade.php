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
            <div class="auth-form-box login">
                <h4>Спасибо за регистрацию!</h4>
                <p>
                    Пожалуйста подтвердите адрес электронной почты. Следуйте инструкциям в письме, которое мы вам отправили. Если вы не получили письмо, мы с радостью отправим вам новое.
                </p> 
                <div class="mt-3 col-md-12">
                    <a style="font-size: 12px; display: block; color: #1e87f0;" href="/account/register">Регистрация</a>
                    <a style="font-size: 12px; display: block; color: #1e87f0;" href="/account/reset-password">Забыли пароль?</a>
                </div>
                <div class="row">
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <div style="margin: 15px 0 10px 0;">
                            <button type="submit" name="action" class="btn btn-red contact-form-btn">Отправить письмо повторно</button>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <div>
                            <button class="btn btn-red contact-form-btn" type="submit" name="action">Выйти</button>
                        </div>
                    </form>
                    
                </div>
            </div>
        </div>
    </main>

    <x-client.footer.footer-component />
</body>
</html>