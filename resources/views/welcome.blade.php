@extends('layout.app')

@section('title')
    Main page
@endsection

@section('content')

{{--    @yield('header')--}}
    @include('inc.header')

    <link rel="stylesheet" href="/css/mainPage.css">

    <div class="page-content app-bg-dark content flex justify-center">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6">
                        <img class="big_logo" src="/images/ChNU_Logo.png" alt="Logo">
                    </div>

                    <div class="p-6">
                        @if(\Illuminate\Support\Facades\Auth::check())
                            <button class="btn btn-primary" onclick="mySurveys()">Мої опитування</button>
                        @else
                            <div class="page-content app-bg-dark content flex justify-center">
                                <form class="registration-login-form" method="POST" action="{{route('user.login')}}">
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
@endsection
