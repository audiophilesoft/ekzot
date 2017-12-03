@component('mail::message')
# Подтверждение регистрации

<p>Здравствуйте!</p>
<p>Вы успешно зарегистрировались на сайте <a href="{{ config('site.address') }}">«{{ config('site.name') }}»</a>. Ваши данные:</p>

<ul>
    <li>имя пользователя: {{ $user->name }}</li>
    <li>e-mail: {{ $user->email }}</li>
    <li>пароль: пароль указанный при регистрации</li>
</ul>

<p>Для активации учетной записи, пожалуйста, перейдите по ссылке:</p>


@component('mail::button', ['url' => config('site.address') . config('site.registration.confirmation.address') . $user->confirmation_key])
Активировать учетную запись
@endcomponent

@endcomponent
