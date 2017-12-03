@extends('layouts.master')


@section('title')
    Материал добавлен / {{ config('site.site_name') }}
@endsection


@section('content')
    <div class="alert alert-success">
        <strong>Успешно!</strong> Материал добавлен.
    </div>
@endsection