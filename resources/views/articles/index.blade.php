@extends('layouts.master')

@section('content')
    @forelse($articles as $article)
        <div class="blog-post">
            <a href="{{ route('articles.show', ['url' => $article->url], false) }}"><h2 class="blog-post-title">{{ $article->title }}</h2></a>
            <p class="blog-post-meta">{{ $article->created_at->formatLocalized('%d %B %Y') }} by
                <a href="#">{{ $article->user->name }}</a></p>

            {!! $article->description !!}
        </div>

        @if(!$loop->last)<hr/>@endif
    @empty
        There is no articles yet.
    @endforelse
@endsection