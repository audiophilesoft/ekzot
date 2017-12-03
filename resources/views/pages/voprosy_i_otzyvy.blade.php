@extends('pages.show')

@section('styles')
    @parent
    <link href="/css/feedback.css" rel="stylesheet">
@endsection

@section('content')
    <main class="content_feedback">

        <section class="faq feedback__main">

            <header class="faq__header"><h2 class="faq__title">Часто задаваемые вопросы</h2>

                <aside class="faq__message__outer">
                    <div class="faq__message">Благодаря многолетнему опыту общения с любителями плодовых растений я составил список ответов на самые часто задаваемые вопросы, предугадывая возможные трудности.</div>
                </aside>
            </header>

            {!! $entry->content !!}
        </section>

        <aside class="i-recommend feedback__aside">
            <h3 class="i-recommend__title">Рекомендую почитать</h3>

            <div class="i-recommend__body">
                <ol class="i-recommend__list">
                    <li class="i-recommend__list__item">Овсянников И. В., «Плодовые растения в комнате», 1957;</li>
                    <li class="i-recommend__list__item">Дадыкин В. В., «Цитрусовый сад в комнате», 1991;</li>
                    <li class="i-recommend__list__item">Михайловська М. В., Приходько С. М., «Сад на підвіконні», 1990;</li>
                    <li class="i-recommend__list__item">Ядров А. А. и др., «Орехоплодные и субртопические плодовые культуры», 1990;</li>
                    <li class="i-recommend__list__item">Казас А. Н. и др, «Субтропические плодовые и орехоплодные культуры», 2012;</li>
                    <li class="i-recommend__list__item">Гродзинский А. М., «Тропические и субтропические растения закрытого грунта», 1988;</li>
                </ol>
            </div>
        </aside>

        <section class="questions-and-feedback feedback__main">
            <header class="questions-and-feedback__header">
                <h2 class="questions-and-feedback__title">Вопросы и отзывы</h2>

                <aside class="questions-and-feedback__message__outer">
                    <div class="questions-and-feedback__message">Всегда хочется знать, что твой труд, твои знания находят живой отклик.<br> Ваши комментарии и вопросы — лучший ориентир для меня в том, как стоит дальше развиваться сайту и чему больше уделять внимания.
                    </div>
                </aside>
            </header>

            <div class="questions-and-feedback__body">

                @section('comments')
                    @include('comments.comments')
                @show

            </div>
        </section>

        <aside class="feedback__aside"></aside>

    </main>
@endsection