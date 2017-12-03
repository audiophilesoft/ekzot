@spaceless
<header class="header">
    <div class="header__top-panel">
        <div class="user-links">@if(Auth::check())
                <div class="user-name">{{ Auth::user()->name }}</div>
                <a class="logout-link" href="{{ route('logout') }}">Выход</a>@else
                <a class="user-links__link login-link" href="{{ route('login') }}">Вход</a>
                <span class="user-links__splitter">|</span>
                <a class="user-links__link register-link" href="{{ route('register') }}">Регистрация</a>
            @endif
        </div>
        <div class="site-search">
            <form target="_blank" action="https://www.google.com.ua/search" class="site_search__form">
                <input name="q" type="search" class="site_search__text-field" title="Поисковый запрос" required><input type="submit" value="" class="site_search__submit-button">
            </form>
{{--<script>
    (function() {
        var cx = '007168016930378803176:j_9gtqfo11o';
        var gcse = document.createElement('script');
        gcse.type = 'text/javascript';
        gcse.async = true;
        gcse.src = 'https://cse.google.com/cse.js?cx=' + cx;
        var s = document.getElementsByTagName('script')[0];
        s.parentNode.insertBefore(gcse, s);
    })();
</script>
<gcse:search></gcse:search>--}}

</div>
<a class="contacts-link scroll-to" href="#contacts">Контакты</a>
</div>
<div class="header__site-logo-name-wrapper">

<div class="header__site-logo-wrapper">@if(request()->is('/'))<img src="/images/logo.svg" alt="ЭКЗОТ" class="header__site-logo">@else<a class="header__site-logo" href="/"><img src="/images/logo.svg" alt="ЭКЗОТ"></a>@endif</div>
    @if(request()->is('/'))<h1 class="header__site-name">
Субтропические плодовые растения </h1>@else<a class="header__site-name" href="/">
        Субтропические плодовые растения </a>@endif
</div>
</header>
@endspaceless