@include("layouts.panel.template.head")
<section data-component="login-form">
    <div row>
        <h5>
            Подтверждение пароля
        </h5>
        <small>
            Пожалуйста подтвердите пароль для продолжения.
        </small>
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
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <div class="row grey-label">
                <div class="input-field">
                  <input id="password" type="password" class="validate" name="password">
                  <label for="password">Пароль</label>
                </div>
            </div>
            <div class="form-footer">
                <button class="btn waves-effect" type="submit" name="action">Подтвердить</button>
            </div>
        </form>
    </div>
</section>