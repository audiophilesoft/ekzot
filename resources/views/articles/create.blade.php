@extends('entries.create')

@section('title')
    Добавить статью / {{ config('site.site_name') }}
@endsection

{{-- This is a workaround to let the form model binding work --}}
@section('form_start')
    {!! Form::model($entry, ['method' => $method, 'class' => 'form-horizontal', 'route' => $route]) !!}
@endsection

@section('fields')
    @foreach ([
    'entries.fields.title',
     'entries.fields.url',
      'articles.fields.description',
       'entries.fields.content',
        'entries.fields.meta_description',
        'entries.fields.meta_tags',
         'entries.fields.is_active',
         'articles.fields.enable_comments',
         'articles.fields.show_on_main',
         'articles.fields.rank',
         ] as $field)
        @include($field)
    @endforeach
@endsection