@extends('layout.app')

@section('title')
    Сторінка голосування
@endsection

@include('inc.header')

@section('content')


    <div class="page-content app-bg-dark content flex justify-center">
        <form class="registration-login-form" method="POST" action="{{route('vote')}}">
            @csrf
            <div class="form-group">
                <h3>{{ $survey->question }}</h3>
            </div>

            <input type="hidden" id="survey_id" name="survey_id" value="{{ $survey->id }}">
            <input type="hidden" id="email" name="email" value="{{ $respondent->email }}">

            <div class="form-group">
                <input id="answer_yes" name="answer" type="radio" value="" onclick="changeValue()">
                <label for="answer_yes" class="col-form-label-lg">За</label>
            </div>

            <div class="form-group">
                <input id="answer_no" name="answer" type="radio" value="" onclick="changeValue()">
                <label for="answer_no" class="col-form-label-lg">Проти</label>
            </div>

            <input type="hidden" id="answer" name="answer" value="NOT_VOTED">

            <div class="form-group">
                <button class="btn btn-submit-registration-login btn-lg btn-primary" type="submit" name="sendMe" value="1">Увійти</button>
            </div>
        </form>
    </div>

    <script src="/js/voting.js"></script>
@endsection
