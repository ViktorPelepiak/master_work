@extends('layout.app')

@section('title')
    Login
@endsection

@include('inc.header')

@section('content')
    <div class="page-content app-bg-dark content flex justify-center">
        <h1>{{ $errorMessage }}</h1>
    </div>
@endsection
