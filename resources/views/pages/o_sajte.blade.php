@extends('pages.show')


@section('styles')
    @parent
    <link href="/css/about.css" rel="stylesheet">
    @endsection

@section('content')
    <main class="content_about">
        <article class="about">
        <h1 class="about__title">{{ $entry->title }}</h1>

            <div class="about__text">{!! $entry->content !!}</div>
        </article>
    </main>
@endsection
