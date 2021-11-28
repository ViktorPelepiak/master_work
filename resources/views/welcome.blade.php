@extends('layout.app')

@section('title')
    Головна сторінка
@endsection

@section('styles')

@endsection
<link rel="stylesheet" href="/css/mainPage.css">
@section('content')

{{--    @yield('header')--}}
    @include('inc.header')


    <div class="page-content app-bg-dark content flex justify-center">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-8 overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6">
                        <img class="big-logo" src="/images/ChNU_Logo.png" alt="Logo">
                    </div>

                    <div class="p-6">
                        <div style="display: flex; align-items: center; height: 100%; min-width: 22rem;">
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <div style="display: block">
                                <button class="btn btn-primary btn-main-page" onclick="mySurveys()">Мої голосування</button>
                                @if(\App\Models\User::find(\Illuminate\Support\Facades\Auth::id())->role == 'SUPER_ADMIN')
                                    <button class="btn btn-primary btn-main-page" onclick="userManagement()">Управління користувачами</button>
                                @endif
                            </div>
                        @else
                            <div class="flex justify-center" style="width: 100%">
                                <form class="registration-login-form" style="width: 100%; margin-right: 4rem;" method="POST" action="{{route('user.loginFromMainPage')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email" class="col-form-label-lg">Ваш email</label>
                                        <input class="form-control" id="email" name="email" type="email" value="" placeholder="Email">
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
                                        <button class="btn btn-submit-registration-login btn-lg btn-primary" type="submit" name="sendMe" value="1">Увійти</button>
                                    </div>
                                </form>
                            </div>
                        @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
