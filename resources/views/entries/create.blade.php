@extends('layouts.master')

@section('content')

    <div class="panel-body">
            @include('common.errors')

        @yield('form_start')

        @section('fields')
            @foreach (['title', 'url', 'content', 'meta_tags', 'meta_description', 'is_active'] as $field)
                @include('entries.fields.' . $field)
            @endforeach
        @show


        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-6">
                @section('submit')
                    {!! Form::submit('Добавить', ['class' => 'btn btn-default']) !!}
                @show
            </div>
        </div>

        {!! Form::close() !!}
    </div>
@endsection