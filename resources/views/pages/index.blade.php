@extends('layouts.master')

@section('title'){{ config('site.name') }}@endsection

@section('main_menu')
    <div class="photo">
        @include('common.main_menu')
        <a class="photo__expand" data-lightbox="Olive" href="/images/main.jpg" data-title="Олива, 3 года" title="Посмотреть фотографию"></a>
    </div>
@endsection

@section('content')
    <main class="content_index">
        <div class="post-preview_main__items">
            @include('articles.items')
        </div>
        @if($remaining ?? false)<a class="post-preview_main__more-items" href="{{ route('articles.more_main') }}">Все материалы (+{{ $remaining  }})</a>@endif
    </main>
@endsection
