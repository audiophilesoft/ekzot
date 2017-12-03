@extends('pages.show')


@section('styles')
    @parent
    <link href="/css/shop.css" rel="stylesheet">
@endsection

@section('content')
    <main class="content_shop">
        {!! $entry->content !!}
    </main>
@endsection



