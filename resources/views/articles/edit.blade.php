@extends('articles.create')

@section('title')
    @include('entries.lines.edit_title')
@endsection

@section('submit')
    @include('entries.fields.save_button')
@endsection