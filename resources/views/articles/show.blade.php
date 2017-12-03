@extends('entries.show')

@section('meta')
    @include('articles.lines.meta')
@endsection

@section('content')
    @spaceless
    <main class="content_article">

        <nav class="breadcrumbs">
            <span class="breadcrumbs__item" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                <a href="/" itemprop="url">
                    <span itemprop="title"> Главная</span>
                </a>
            </span>
            <span class="breadcrumbs__item" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                <a href="#articles" itemprop="url">
                    <span itemprop="title"> Статьи</span>
                </a>
            </span>
            <span class="breadcrumbs__item" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb">
                <a href="." itemprop="url">
                    <span itemprop="title">{{ $entry->catalogue->name }}</span>
                </a>
            </span>
        </nav>

        <article class="article">
            <header class="article__header">
                <h1 class="article__title">{{ $entry->title }}</h1>
            </header>
            <div class="article__content">
                {!!  $entry->content  !!}
            </div>
            <footer class="article__footer">
                <div class="article__footer__wrapper">
                    <div class="article__footer__date">
                        <span class="article__footer__date__value">{{ $entry->created_at->format('d.m.Y') }}</span>
                    </div>
                    <div class="article__footer__views-num">
                        <span class="article__footer__views-num__value">{{ $entry->views_count }}</span>
                    </div>
                    <div class="article__footer__comments-num">
                        <span class="article__footer__comments-num__value">{{ count($entry->comments) }}</span>
                    </div>
                </div>
            </footer>
        </article>
        @endspaceless
        @if($entry->enable_comments)
            <section class="comments_article" id="comments">
                <h2 class="comments__title">Комментарии</h2>

                @include('comments.comments')
            </section>
        @endif
    </main>
@endsection