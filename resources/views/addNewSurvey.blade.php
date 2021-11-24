@extends('layout.app')

@section('title')
    Створення голосування
@endsection

@include('inc.header')

@section('styles')
    <link rel="stylesheet" href="/css/newSurvey.css">
@endsection

@section('content')
    <div class="page-content app-bg-dark content flex justify-center">
        <form class="survey-form" method="POST" action="/surveys/create">
            @csrf

            <input id="userId" name="userId" hidden type="text" value="{{ \Illuminate\Support\Facades\Auth::id() }}">

            <label for="question" class="survey-form-label">Питання до голосування</label>
            <textarea name="question" id="question" class="form-control" placeholder="Питання" onchange="validateForm()"></textarea>
            <label for="question" id="questionRequirement" class="required" style="display: none;">Це поле обов'язкове до заповнення</label>

            <div class="grid grid-cols-1 md:grid-cols-2">
                <div class="p-6" style="padding-left: 0;">
                    <label for="datatime_from" class="survey-form-label">Дата і час початку голосування</label>
                    <input id="datatime_from" name="datatime_from" class="form-control" type="datetime-local" onchange="validateForm()">
                    <label for="datatime_from" id="datatime_fromRequirement" class="required" style="display: none;">Це поле обов'язкове до заповнення</label>
                </div>
                <div class="p-6" style="padding-right: 0;">
                    <label for="datatime_to" class="survey-form-label">Дата і час завершення голосування</label>
                    <input id="datatime_to" name="datatime_to" class="form-control" type="datetime-local" onchange="validateForm()">
                    <label for="datatime_to" id="datatime_toRequirement" class="required" style="display: none;">Це поле обов'язкове до заповнення</label>
                </div>
            </div>

            <div class="form-check">
                <input id="reviewInProgressInput" name="reviewInProgressInput" type="text" hidden value="false">
                <input class="form-check-input" type="checkbox" value="" id="reviewInProgress" name="reviewInProgress" onclick="switchReviewInProgress()">
                <label class="form-check-label" for="reviewInProgress">
                    Чи можна переглядати статистику в процесі голосування?
                </label>
            </div>

            <label for="respondents" class="survey-form-label">Респонденти</label>
            <textarea name="respondents" id="respondents" class="form-control" onchange="validateForm()"></textarea>
            <label for="respondents" id="respondentsRequirement" class="required" style="display: none;">Поле порожнє або одина чи декілька адрес вказані некоректно</label>

            <button id="saveVoting" class="btn btn-primary new-survey-btn" type="submit" disabled>Створити голосування</button>
        </form>

    </div>

    <script src="/js/newSurvey.js"></script>
@endsection
