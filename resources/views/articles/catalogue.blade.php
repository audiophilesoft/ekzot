@extends('layouts.master')

@section('styles')
    @parent
    <link href="/css/catalogue.css" rel="stylesheet">
@endsection

@section('title'){{ $catalogue->name }} / {{  config('site.articles.name')  }} / {{ config('site.name') }}@endsection

@section('content')
    <main class="catalogue">

        <div>
            <nav class="breadcrumbs"><span class="breadcrumbs__item" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="/" itemprop="url"><span itemprop="title">Главная</span></a></span><span class="breadcrumbs__item" itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"><a href="#articles" itemprop="url"><span itemprop="title">Статьи</span></a></span></nav><h1 class="catalogue__title">{{ $catalogue->name }}</h1></div>

        <div class="catalogue__content__management">
            <div class="catalogue__materials-counter">
                <div class="catalogue__materials-counter__text">Материалов:</div>
                <div class="catalogue__materials-counter__num">{{ count($catalogue->articles) }}</div>
            </div>
            <div class="catalogue__materials-sorter">
                @foreach([
                'по дате' => 'date',
                'по заголовку' => 'title',
                'по просмотрам' => 'views',
                'по комментариям' => 'comments'
                ] as $anchor => $url)
                    <a class="catalogue__materials-sorter__option{{ (($sort_by=== $url) or (!$order && $loop->first)) ? '_active-'. (($order !=='asc') ? 'desc' : 'asc') : '' }}" href="?sort_by={{  $url }}&order={{ (($sort_by=== $url) && $order ==='desc') || ($loop->first && !$order)  ? 'asc' : 'desc' }}">{{ $anchor }}</a>
                @endforeach
            </div>
        </div>


        <div class="post-preview_catalogue__items">
            @include('articles.items')
        </div>
        @if($remaining)<a class="post-preview_catalogue__more-items" href="{{ route('articles.others', [$catalogue]) }}">Все материалы (+{{ $remaining }})</a>@endif
    </main>
@endsection