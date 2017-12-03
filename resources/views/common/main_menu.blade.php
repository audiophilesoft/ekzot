@spaceless
<nav class="main-menu">
    <div class="main-menu__open-button">Меню</div>
    <a class="main-menu__item" href="/o_sajte" title="Что это, откуда и зачем">О сайте</a>
    <div class="main-menu__item main-menu__submenu">
        <div class="main-menu__submenu__title">Статьи</div>
        <div class="main-menu__submenu__wrapper" id="articles">
            <div class="main-menu__submenu__items">
                @foreach(App::make(\App\Http\Controllers\ArticlesController::class)->getCats() as $cat)
                    <div class="main-menu__submenu__item">
                        <a class="main-menu__submenu__link" href="/{{ config('site.articles.url') }}/{{ $cat->url }}/" title="{{ $cat->description }}">{{ $cat->name }}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="main-menu__item main-menu__submenu">
        <div class="main-menu__submenu__title">Галерея</div>
        <div class="main-menu__submenu__wrapper">
            <div class="main-menu__submenu__items">
                <div class="main-menu__submenu__item">
                    <span class="main-menu__submenu__link" title="Скоро будет">Новая</span>
                </div>
                <div class="main-menu__submenu__item">
                    <a class="main-menu__submenu__link" href="http://old.ekzot.com/photo/" target="_blank">Старая</a>
                </div>
            </div>
        </div>
    </div>
    <a class="main-menu__item" href="/assortiment_i_ceny" title="Наша витрина">Ассортимент и цены</a>
    <a class="main-menu__item" href="/voprosy_i_otzyvy" title="Отвечаем на ваши вопросы">Вопросы и отзывы</a>
</nav>@endspaceless