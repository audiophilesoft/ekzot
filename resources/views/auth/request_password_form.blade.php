<section class="request-password-window">
    <header class="request-password-window__header">
        <a href="#" class="request-password-window__close" title="Закрыть окно"></a>
        <h2 class="request-password-window__title">Восстановление пароля</h2>
    </header>

    <div class="request-password-window__body">
        <div class="request-password-window__text">Чтобы получить ссылку для восстановления пароля, пожалуйста, укажите Вашу почту:</div>
        <form class="request-password-form" method="POST" action="{{ route('password.email') }}">
            {{ csrf_field() }}
            <input type="email" id='registration__email' class="request-password-form__email" name="email" value="{{ old('email') }}" title="E-mail" required minlength="7" autofocus placeholder="E-mail">
                <div class="request-password-form__captcha-container">{!! Recaptcha::render() !!}</div>
                <input type="submit" value="Отправить" class="request-password-form__submit">
        </form>
    </div>

</section>