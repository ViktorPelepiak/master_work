@extends('layout.app')

@section('title')
    Інформаційна сторінка
@endsection

@include('inc.header')

@section('content')
    <div class="page-content app-bg-dark content flex justify-center">
        <h1>{{ $errorMessage }}</h1>
    </div>
@endsection
