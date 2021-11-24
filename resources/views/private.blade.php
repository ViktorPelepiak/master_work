@extends('layout.app')

@section('title')
    Мої голосування
@endsection

@include('inc.header')

@section('content')
    <link rel="stylesheet" href="/css/mySurveys.css">

    <div class="page-content app-bg-dark flex content justify-center">
        <p class="my-surveys-title">Мої голосування</p>
    </div>
    <div class="app-bg-dark flex content justify-center">
        <div id="survey_container" class="survey-container">
            <?php
                $survey_controller = new \App\Http\Controllers\SurveyController();
                $surveys = $survey_controller->getAllSurveysForLoggedUser();

                if (count($surveys) > 0){
                    echo("<table class='survey-table table table-hover table-dark'>");
                    echo("<tr><th>Питання</th><th>Початок</th><th>Кінець</th><th>Перегляд в процесі</th><th>Запрошено</th><th></th><th></th></tr>");

                    foreach ($surveys as $sur) {
                        $str = "<tr><td>".$sur['question']."</td><td>"
                                        .$sur['start_time']."</td><td>"
                                        .$sur['finish_time']."</td><td>";
                        if ($sur['review_in_process']) {
                            $str = $str."Так</td><td>";
                        } else {
                            $str = $str."Ні</td><td>";
                        }
                        echo ($str.$sur['total']."</td><td><button class='btn btn-success' onclick='surveyReview(".$sur['survey_id'].")'>Переглянути</button></td>".
                                    "<td><button class='btn btn-danger' onclick='deleteSurveyById(".$sur['survey_id'].")'>Видалити</button></td></tr>");
                    }

                    echo "</table>";
                } else {
                    echo "<h3 class=\"surveys-not-exist\">Голосуваня відсутні. Створіть нове опитування натиснувши кнопку \"+\"</h3>";
                }
            ?>



        </div>
    </div>

    <nav class="navbar fixed-bottom">
        <button class="new-survey-btn" onclick="toCreateNewSurveyPage()"><p>+</p></button>
    </nav>

    <script src="/js/newSurvey.js"></script>
    <script src="/js/surveys.js"></script>
@endsection
