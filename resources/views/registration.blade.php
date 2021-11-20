@extends('layout.app')

@section('title')
    Registration
@endsection

@include('inc.header')

@section('content')
    <div class="page-content app-bg-dark content flex justify-center">
    <form class="registration-login-form" method="POST" action="{{route('user.registration')}}">
        @csrf
        <div class="form-group">
            <label for="email" class="col-form-label-lg">Ваш email</label>
            <input class="form-control" id="email" name="email" type="text" value="" placeholder="Email">
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password" class="col-form-label-lg">Пароль</label>
            <input class="form-control" id="password" name="password" type="password" value="" placeholder="Пароль">
            @error('password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="confirm_password" class="col-form-label-lg">Підтвердіть пароль</label>
            <input class="form-control" id="confirm_password" name="confirm_password" type="password" value="" placeholder="Підтвердіть пароль">
            @error('confirm_password')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <button class="btn btn-submit-registration-login btn-lg btn-primary" type="submit" name="sendMe" value="1">Зареєструватись</button>
        </div>
    </form>
    </div>
@endsection
