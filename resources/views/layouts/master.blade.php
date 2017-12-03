<!DOCTYPE html>
<html lang="ru">
<head>
    @section('head')
        <meta name="viewport" content="width=device-width, initial-scale=1">
                <meta name="yandex-verification" content="f920f9e41f02c4f7" />
        <meta charset="utf-8">
        <meta name="description" content="@yield('meta_description', config('site.description'))">
        <meta name="keywords" content="@yield('meta_tags', 'лимон, апельсин, комнатный, инжир, саженцы')">
                <link rel="icon" type="image/png" href="/favicon.png">
                <link rel="mask-icon" href="/logo.svg" color="blue">
                <link rel="icon" type="image/svg+xml" href="/favicon.svg">

        <title>@yield('title')</title>
                <script src="/js/main.js" type="text/javascript"></script>

                <meta property="og:image" content="@yield('og_image', config('site.logo_png'))">
                <meta property="og:description" content="@yield('og_description', config('site.description'))">


        @section('styles')
        <link href="/css/normalize.css" rel="stylesheet">
        <link href="/css/lightbox.css" rel="stylesheet">
        <link href="/css/style.css" rel="stylesheet">
                @show

            @include('common.counters')
    @show
</head>

<body>


@include('layouts.header')

@section('main_menu')
        @include('common.main_menu')
@show

@yield('content')

@include('layouts.footer')
@include('common.to_top')
@include('flash::message')

@yield('counters_bottom')
</body>
</html>