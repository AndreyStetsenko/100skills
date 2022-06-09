<!DOCTYPE html>
<html lang="en">
<head>
    <x-panel.head.head-auth-component />
</head>
<body>
        
    <section data-component="login-form">
        <div row>
            <h5>
                Обновление пароля 
            </h5>
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
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                <div class="row grey-checkbox">
                    <div class="input-field grey-label">
                      <input id="email" type="email" class="validate" name="email" value="<?=old('email', $request->email) ?>">
                      <label for="email">Email</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field grey-label">
                      <input id="password" type="password" class="validate" name="password">
                      <label for="password">Пароль</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field grey-label">
                      <input id="password_confirmation" type="password" class="validate" name="password_confirmation">
                      <label for="password_confirmation">Повторите пароль</label>
                    </div>
                </div>
                <div class="form-footer">
                    <button class="btn waves-effect" type="submit" name="action">Обновить пароль</button>
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