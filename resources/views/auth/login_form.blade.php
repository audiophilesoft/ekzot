<div class="login-window__background">
    <section class="login-window">
        <header class="login-window__header">
            <a href="#" class="login-window__close" title="Закрыть окно"></a>
            <h2 class="login-window__title">Вход</h2>
        </header>

        <div class="login-window__body">
            <form class="login-form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

                <input type="email" id='login__email' class="login-form__email" name="email" value="{{ old('email') }}" title="E-mail" required minlength="7" autofocus placeholder="E-mail">

                <input type="password" id='login__password' class="login-form__password" name="password" title="Пароль" placeholder="Пароль" required>

                <div class="login-form__remember-line">
                    <label for="login__remember" class="login-form__remember__label">Запомнить меня</label>
                    <span class="login-form__remember__checkbox"><input type="checkbox" name="remember" id="login__remember" class="login-form__remember" checked><label for="login__remember"></label>
                </span>
                </div>

                <input type="submit" value="Войти" class="login-form__submit">
            </form>

            <div class="login-window__bottom">
                <a href="{{ route('password.request') }}" class="forgot-password-link">Забыли пароль?</a>
            </div>
        </div>

    </section>
</div>