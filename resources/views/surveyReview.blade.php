@extends('layout.app')

@section('title')
    Login
@endsection

@include('inc.header')

@section('content')
    <link rel="stylesheet" href="/css/displaySurveys.css">

    <div class="page-content app-bg-dark content flex justify-center">
        <div class="global-container">
            <div class="content-block">
                <label for="question">Питання</label>
                <h3 id="question">{{ $question }}</h3>
            </div>
            <div class="content-block flex-container">
                <h5>Доступне від&nbsp;</h5>{{ $timeOfStart }} <h5>&nbsp;до&nbsp;</h5>{{ $timeOfFinish }}
            </div>
            <div class="content-block">
                <label for="respondents">Контакти запрошені до голоування:</label>
                <h5 id="respondents">
                    @foreach($respondents as $resp)
                        {{ $resp['email'] }};
                    @endforeach
                </h5>
            </div>
            <div class="content-block flex-container">
                <label for="respondents">Чи можливий перегляд статистики під час голосування:&nbsp;</label>
                <h5 id="respondents">
                    @if($reviewInProcess)
                        Так
                    @else
                        Ні
                    @endif
                </h5>
            </div>
            @if($reviewInProcess)
            <div class="content-block flex-container">
                <input id="agreeQuantity" type="hidden" value="{{ $agreeQuantity }}">
                <input id="disagreeQuantity" type="hidden" value="{{ $disagreeQuantity }}">
                <input id="notVotedQuantity" type="hidden" value="{{ $totalQuantity - $agreeQuantity - $disagreeQuantity }}">

                <div id="chartContainer" style="height: 370px; width: 100%;"></div>
            </div>
            @endif
        </div>
    </div>

    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="/js/statistic.js"></script>
@endsection
