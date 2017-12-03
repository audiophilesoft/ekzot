{{-- todo: this is horrible. Rework logic --}}

@extends('pages.blank')

@section('content')
@parent

    @include('auth.passwords.reset_form')
@endsection
