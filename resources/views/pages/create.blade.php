@extends('entries.create')

@section('title')
    Добавить стараницу / {{ config('site.site_name') }}
@endsection

{{-- This is a workaround to let the form model binding work --}}
@section('form_start')
    {!! Form::model($entry, ['method' => $method, 'class' => 'form-horizontal', 'route' => $route]) !!}
@endsection

