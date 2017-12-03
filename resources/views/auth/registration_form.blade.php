@spaceless<div class="registration-window__background">
    <section class="registration-window">
        <header class="registration-window__header">
            <a href="#" class="registration-window__close" title="Закрыть окно"></a>
            <h2 class="registration-window__title">Регистрация</h2>
        </header>

        <div class="registration-window__body">
            <form class="registration-form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="registration-form__name-line">
                    <input type="text" id='registration__name' class="registration-form__name" name="name" value="{{ old('name') }}" title="Имя пользователя" required minlength="{{ config('site.users.name.min_length') }}" maxlength="{{ config('site.users.name.max_length') }}" autofocus placeholder="Имя пользователя">
                    <div class="registration-form__name__note">латиницией или кириллицей</div>
                </div>

                <div class="registration-form__password-line">
                    <div class="registration-form__password__fields">
                        <input type="password" id='registration__password' class="registration-form__password" name="password" title="Пароль" placeholder="Пароль" minlength="{{ config('site.users.password.min_length') }}" maxlength="{{ config('site.users.password.max_length') }}" required>

                        <input type="password" id='registration__password-confirm' class="registration-form__password-confirm" name="password_confirmation" title="Повторите пароль" placeholder="Повторите пароль" required>
                    </div>
                    <div class="registration-form__password__note">от 6 символов латаницей</div>
                </div>

                <div class="registration-form__email-line">
                    <input type="email" id='registration__email' class="registration-form__email" name="email" value="{{ old('email') }}" title="Ваш e-mail" required minlength="7" autofocus placeholder="Ваш e-mail">
                </div>
                <div class="registration-form__avatar-line">
                    <div class="registration-form__avatar__preview">
                        <img src="" alt="" title="Предпросмотр"></div>
                    <div class="registration-form__avatar__upload">

                        <div class="registration-form__avatar__upload__note">Можете выбрать свой аватар вместо стандартного. JPG/PNG/GIF, не более {{ config('site.users.avatar.max_size') }} КиБ, {{ config('site.users.avatar.max_width') }}×{{ config('site.users.avatar.max_height') }} px</div>
                        <div class="registration-form__avatar__uploader">
                            <label class="registration-form__avatar__uploader__label">
                                <input type="file" name="avatar" class="registration-form__avatar__uploader__input" accept="{{ config('site.users.avatar.accept_mimes') }}">
                            </label>
                        </div>
                    </div>
                </div>

                <div class="registration-form__submit-line">
                    <div class="registration-form__captcha-container">{!! Recaptcha::render() !!}</div>
                    <input type="submit" value="Отправить" class="registration-form__submit">
                </div>
            </form>
        </div>

    </section>
</div>
@endspaceless