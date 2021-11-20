<?php

namespace App\Http\Controllers;

use App\Mail\SurveyMail;
use App\Models\Answer;
use App\Models\Contact;
use App\Models\Respondent;
use App\Models\Survey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use KeyValues;

class SurveyController extends Controller
{
    public function save(Request $request){
        if (Auth::check()){
            $validateFields = $request->validate([
                'userId'=>'required',
                'question'=>'required',
                'datatime_from'=>'required',
                'datatime_to'=>'required',
                'reviewInProgressInput'=>'required',
                'respondents'=>'required'
            ]);

            $dateAndTime = explode('T', $validateFields['datatime_from']);
            $timeFrom = $dateAndTime[0]." ".$dateAndTime[1];
            $dateAndTime = explode('T', $validateFields['datatime_to']);
            $timeTo = $dateAndTime[0]." ".$dateAndTime[1];

            $data = array(
                'user_id'=>$validateFields['userId'],
                'question'=>$validateFields['question'],
                'time_of_start'=>$timeFrom,
                'time_of_finish'=>$timeTo,
                'review_in_process'=>$validateFields['reviewInProgressInput']=='true'
            );

            $survey_id = Survey::create($data)->id;

            $emails = preg_split('[\s]', $validateFields['respondents'], 0, PREG_SPLIT_NO_EMPTY);

            foreach ($emails as $email) {
                $data = array(
                    'survey_id'=>$survey_id,
                    'email'=>$email,
                    'is_voted'=>false
                );

                $respondent = Respondent::create($data);

                $details = [
                    'subject' => 'Запрошення до голосування',
                    'body' => base64_encode($survey_id.';'.$respondent->email)
                ];
                Mail::to($respondent->email)->send(new SurveyMail($details));
            }

            return redirect(\route('user.private'));
        }
    }


    public function getAllSurveysForLoggedUser(): array
    {
        $loggedUserId = Auth::id();

        $surveys = Survey::where('user_id', $loggedUserId)->get();

        $response = array();
        foreach ($surveys as $sur) {
            array_push($response, [
                'survey_id'=>$sur->id,
                'question'=>$sur->question,
                'start_time'=>$sur->time_of_start,
                'finish_time'=>$sur->time_of_finish,
                'review_in_process'=>$sur->review_in_process,
                'total'=>Respondent::where('survey_id', $sur->id)->count()
            ]);
        }
        return $response;
    }

    public function getSurveyInfoByToken($token) {
        $surveyIdAndRespondentEmail = explode(";", base64_decode($token));

        $respondent = new Respondent();
        $respondent = $respondent->where('survey_id', $surveyIdAndRespondentEmail[0])
                                 ->where('email', $surveyIdAndRespondentEmail[1])->get()[0];


        date_default_timezone_set('Europe/Kiev');
        $dataAndTime = explode('T', date(DATE_ATOM, microtime(true)));
        $time = explode(':', $dataAndTime[1]);
        $currentTime = $dataAndTime[0].' '.$time[0].':'.$time[1];

        if ($respondent->is_voted) {
            return view('error', ['errorMessage' => 'Вибачте, але ви вже проголосували.', 'root_path'=>KeyValues::getKeyValues()['root_path']]);
        } else {
            $survey = Survey::where('id',$surveyIdAndRespondentEmail[0])->get()[0];

            if ($survey->time_of_start > $currentTime) {
                return view('error', ['errorMessage' => 'Голосування ще не розпочалося, спробуйте пізніше', 'root_path'=>KeyValues::getKeyValues()['root_path']]);
            } elseif ($survey->time_of_finish < $currentTime) {
                return view('error', ['errorMessage' => 'Вибачте, але голосування вже завершено.', 'root_path'=>KeyValues::getKeyValues()['root_path']]);
            } else {
                return view('voting', ['survey' => $survey, 'respondent'=>$respondent, 'root_path'=>KeyValues::getKeyValues()['root_path']]);
            }
        }
    }

    public function saveAnswer(Request $request) {
        $validateFields = $request->validate([
            'survey_id'=>'required',
            'email'=>'required',
            'answer'=>'required'
        ]);

        $answerData = [
            'survey_id'=>(int)$validateFields['survey_id'],
            'value'=>$validateFields['answer']
        ];

        $answer = Answer::create($answerData);


        $respondent = Respondent::where('survey_id', $answer->survey_id)
                                ->where('email', $validateFields['email'])
                                ->get()[0];
        $respondent->is_voted = true;
        $respondent->save();

        return view('error', ['errorMessage' => 'Дякуємо! Ваша думка важлива для нас.', 'root_path'=>KeyValues::getKeyValues()['root_path']]);
    }

    public function deleteById($id) {
        if (! Auth::check()) {
            return redirect(\route('user.private', KeyValues::getKeyValues()));
        }


        $answersForDeleting = Answer::where('survey_id',(int)$id)->get();
        foreach ($answersForDeleting as $answer) {
            $answer->delete();
        }
        $respondentsForDeleting = Respondent::where('survey_id',(int)$id)->get();
        foreach ($respondentsForDeleting as $respondent) {
            $respondent->delete();
        }
        Survey::find($id)->delete();
        return redirect(\route('user.private'));
    }

    public function getSurveyInfoById($id) {
        $survey = Survey::find($id);

        $totalQuantity = Respondent::where('survey_id', $id)->count();
        $agreeQuantity = Answer::where('survey_id', $id)->where('value', 'YES')->count();
        $disagreeQuantity = Answer::where('survey_id', $id)->where('value', 'NO')->count();
        $respondents = Respondent::where('survey_id', $id)->get('email');

        $data = [
            'question'=>$survey->question,
            'timeOfStart'=>$survey->time_of_start,
            'timeOfFinish'=>$survey->time_of_finish,
            'reviewInProcess'=>$survey->review_in_process,
            'totalQuantity'=>$totalQuantity,
            'agreeQuantity'=>$agreeQuantity,
            'disagreeQuantity'=>$disagreeQuantity,
            'respondents'=>$respondents,
            'root_path'=>KeyValues::getKeyValues()['root_path']
        ];

        return view('surveyReview', $data);
    }
}
