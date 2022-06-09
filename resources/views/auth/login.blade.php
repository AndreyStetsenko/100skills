<!DOCTYPE html>
<html lang="en">
<head>
    <x-panel.head.head-auth-component />
</head>
<section data-component="login-form">
    <div row>
        <h5>
            Войти в личный кабинет
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
        @endif
        @if( session('status') )
            <article>
                <div>
                    <small>{{ session('status') }}</small>
                </div>
            </article>
            <br />
        @endif
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="row grey-checkbox">
                <div class="input-field grey-label">
                  <input id="email" type="email" class="validate" name="email">
                  <label for="email">Email</label>
                </div>
                <div class="input-field grey-label">
                  <input id="password" type="password" class="validate" name="password">
                  <label for="password">Password</label>
                </div>
                <p>
                    <label>
                        <input type="checkbox" class="filled-in" checked="checked" name="remember"/>
                        <span>Запомнить меня</span>
                    </label>
                </p>
            </div>
            <div class="form-footer">
                <button class="btn waves-effect" type="submit" name="action">Войти</button>
                <div>
                    <p>
                        <a href="/register">Зарегистрироваться</a>
                    </p>
                    <p>
                        <a href="/forgot-password">Забыли пароль?</a>
                    </p>
                </div>
            </div>
        </form>
    </div>
</section>