@extends('layouts.master')


@section('content')
    <div class="alert alert-success">
        Ваш аккаунт успешно активирован. Воспользуйтесь формой для входа ниже.
    </div>

    @includeWhen(!Auth::check(), 'auth.login_form')
@endsection