<div class="reset-password-window__background">
    <section class="reset-password-window">
        <header class="reset-password-window__header">
            <a href="#" class="reset-password-window__close" title="Закрыть окно"></a>
            <h2 class="reset-password-window__title">Смена пароля</h2>
        </header>

        <div class="reset-password-window__body">
            <form class="reset-password-form" method="POST" action="{{ route('password.do_reset') }}">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <input type="password" id='registration__password' class="reset-password-form__password" name="password" title="Новый пароль" placeholder="Новый пароль"  minlength="{{ config('site.users.password.min_length') }}" maxlength="{{ config('site.users.password.max_length') }}" required>

                <input type="password" id='registration__password-confirm' class="reset-password-form__password-confirm" name="password_confirmation" title="Повторите пароль" placeholder="Повторите пароль" required>

                <input type="submit" value="Сменить" class="reset-password-form__submit">
            </form>

        </div>

    </section>
    <script>showResetPasswordWindow()</script>
</div>