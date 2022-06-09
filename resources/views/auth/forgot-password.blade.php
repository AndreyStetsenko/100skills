<!DOCTYPE html>
<html lang="en">
<head>
    <x-panel.head.head-auth-component />
</head>

<body>
        
   <section data-component="login-form">
    <div row>
        <h5>
            Забыли пароль? 
        </h5>
        <small>Нет проблем. Просто сообщите нам свой адрес электронной почты, и мы пришлем вам инструкцию для сброса пароля.</small>
        <br />
        @if( $errors->any() )
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
        @endif
        @if( session('status') )
            <article>
                <div>
                    <small>{{ session('status') }}</small>
                </div>
            </article>
        @endif
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="row grey-label">
                <div class="input-field">
                  <input id="email" type="email" class="validate" name="email">
                  <label for="email">Email</label>
                </div>
            </div>
            <div class="form-footer">
                <button class="btn waves-effect" type="submit" name="action">Восстановить пароль</button>
                <div>
                    <p>
                        <a href="/login">Войти</a>
                    </p>
                </div>
            </div>
        </form>
    </div>
</section>

</body>
</html>