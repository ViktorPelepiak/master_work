@extends('layout.app')

@section('title')
    Сторінка голосування
@endsection

@include('inc.header')

@section('content')
    <link rel="stylesheet" href="/css/voting.css">

    <div class="page-content app-bg-dark content flex justify-center">
        <form class="registration-login-form" method="POST" action="{{route('vote')}}">
            @csrf
            <div class="form-group">
                <h3>{{ $survey->question }}</h3>
            </div>

            <input type="hidden" id="survey_id" name="survey_id" value="{{ $survey->id }}">
            <input type="hidden" id="email" name="email" value="{{ $respondent->email }}">
            <input type="hidden" id="answerVariantList" value="{{ $answer_variants }}">

            <div id="answerVariants"></div>

            <input type="hidden" id="answer" name="answer" value="-1">

            <div class="form-group">
                <button id="voteBtn" class="btn btn-submit-registration-login btn-lg btn-primary" type="submit" name="sendMe" value="1" disabled>Зберегти голос</button>
            </div>
        </form>
    </div>

    <script src="/js/voting.js"></script>
@endsection
