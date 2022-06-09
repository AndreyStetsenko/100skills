<!DOCTYPE html>
<html lang="en">
<head>
    <x-panel.head.head-auth-component />
</head>
<body>
    <section data-component="login-form">
        <div row>
            <h5>
                Зарегистрировать аккаунт
            </h5>
            <br />
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
                    
                    <div class="input-field grey-label">
                      <input id="name" type="text" class="validate" name="name">
                      <label for="name">Имя</label>
                    </div>
                    <div class="input-field grey-label">
                      <input id="email" type="email" class="validate" name="email">
                      <label for="email">Email</label>
                    </div>
                    <div class="input-field grey-label">
                      <input id="password" type="password" class="validate" name="password">
                      <label for="password">Пароль</label>
                    </div>
                    <div class="input-field grey-label">
                      <input id="password_confirmation" type="password" class="validate" name="password_confirmation">
                      <label for="password_confirmation">Повторите пароль</label>
                    </div>
                </div>
                <div class="form-footer">
                    <button class="btn waves-effect" type="submit" name="action">Зарегистрироваться</button>
                    <div>
                        <p>
                            <a href="/login">Уже зарегистрированы?</a>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script>
    var registerNewUser = function(event){
        fetch(`/register`, {
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-Requested-With": "XMLHttpRequest",
                "X-CSRF-Token": this.form.csrf
            },
            method: 'POST',
            body: null
        })
        .then(function(response) {
         
        })
        .then(function(data){
           console.log(data)
            return;
        });
    }
    </script>
</body>
</html>