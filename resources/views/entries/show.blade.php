@extends('layouts.master')

@section('main_menu')
    @include('common.main_menu')
@endsection

@section('title'){{ $entry->title }} / {{ config('site.name') }}@endsection

@section('meta_description'){{ $entry->meta_description }}@endsection

@section('meta_tags'){{ $entry->meta_tags }}@endsection


@if($entry->meta_description)
@section('og_description'){{ $entry->meta_description }}@endsection
@endif


@if($entry->cover)
@section('og_image'){{ config('site.address').'/images/'.request()->path().'/'.$entry->cover }}@endsection
@endif




