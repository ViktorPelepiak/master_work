<?php

namespace App\Http\Controllers;

use App\Mail\SurveyMail;
use App\Models\Answer;
use App\Models\AnswerVariant;
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
                'respondents'=>'required',
                'answerVariantList'=>'required'
            ]);

            $dateAndTime = explode('T', $validateFields['datatime_from']);
            $timeFrom = $dateAndTime[0]." ".$dateAndTime[1];
            $dateAndTime = explode('T', $validateFields['datatime_to']);
            $timeTo = $dateAndTime[0]." ".$dateAndTime[1];
            $answerVariantList = explode(',', $validateFields['answerVariantList']);

            $data = array(
                'user_id'=>$validateFields['userId'],
                'question'=>$validateFields['question'],
                'time_of_start'=>$timeFrom,
                'time_of_finish'=>$timeTo,
                'review_in_process'=>$validateFields['reviewInProgressInput']=='true'
            );

            $survey_id = Survey::create($data)->id;

            $i = 0;
            foreach ($answerVariantList as $answer) {
                $data = array(
                    'survey_id'=>$survey_id,
                    'order_number'=>$i,
                    'answer_variant'=>$answer
                );

                $answerVariant = AnswerVariant::create($data);

                $i++;
            }

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
                    'token' => base64_encode($survey_id.';'.$respondent->email),
                    'datetime_of_start' => $timeFrom,
                    'datetime_of_finish' => $timeTo
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

        if (count(Respondent::where('survey_id', $surveyIdAndRespondentEmail[0])
            ->where('email', $surveyIdAndRespondentEmail[1])->get()) == 0) {
            return view('error', ['errorMessage' => 'Вибачте, але голосування не дійсне або видалено адміністратором.', 'root_path' => KeyValues::getKeyValues()['root_path']]);
        }

        $respondent = new Respondent();
        $respondent = $respondent->where('survey_id', $surveyIdAndRespondentEmail[0])
                                 ->where('email', $surveyIdAndRespondentEmail[1])->get()[0];

        date_default_timezone_set('Europe/Kiev');
        $dataAndTime = explode('T', date(DATE_ATOM, microtime(true)));
        $time = explode(':', $dataAndTime[1]);
        $currentTime = $dataAndTime[0].' '.$time[0].':'.$time[1];

        $answerVariants = "";
        foreach (AnswerVariant::where("survey_id", $surveyIdAndRespondentEmail[0])->get() as $answerVariant) {
            $answerVariants = $answerVariants.$answerVariant->answer_variant.",";
        }

        if ($respondent->is_voted) {
            return view('error', [
                'errorMessage' => 'Вибачте, але ви вже проголосували.',
                'root_path'=>KeyValues::getKeyValues()['root_path']
            ]);
        } else {
            $survey = Survey::where('id',$surveyIdAndRespondentEmail[0])->get()[0];

            if ($survey->time_of_start > $currentTime) {
                return view('error', [
                    'errorMessage' => 'Голосування ще не розпочалося, спробуйте пізніше.',
                    'root_path'=>KeyValues::getKeyValues()['root_path']
                ]);
            } elseif ($survey->time_of_finish < $currentTime) {
                return view('error', [
                    'errorMessage' => 'Вибачте, але голосування вже завершено.',
                    'root_path'=>KeyValues::getKeyValues()['root_path']
                ]);
            } else {
                return view('voting', [
                    'survey' => $survey,
                    'respondent' => $respondent,
                    'answer_variants' => rtrim($answerVariants, ","),
                    'root_path' => KeyValues::getKeyValues()['root_path']
                ]);
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

        return view('error', ['errorMessage' => 'Дякуємо! Ваш голос враховано.', 'root_path'=>KeyValues::getKeyValues()['root_path']]);
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
        $answerVariantForDeleting = AnswerVariant::where('survey_id',(int)$id)->get();
        foreach ($answerVariantForDeleting as $answerVariant) {
            $answerVariant->delete();
        }
        Survey::find($id)->delete();
        return redirect(\route('user.private'));
    }

    public function getSurveyInfoById($id) {
        $survey = Survey::find($id);

        $totalQuantity = Respondent::where('survey_id', $id)->count();
        $respondents = Respondent::where('survey_id', $id)->get('email');
        $answerVariants = AnswerVariant::where('survey_id', $id)->orderBy('order_number', 'asc')->get();
        $answerVariantValues = "Не проголосувало";
        $answers = "";
        $votedQuantity = 0;
        foreach ($answerVariants as $variant) {
            $answerVariantValues = $answerVariantValues.",".$variant->answer_variant;
            $tempVotesQuantity = Answer::where('survey_id', $id)->where('value', $variant->order_number)->count();
            $answers = $answers.",".$tempVotesQuantity;
            $votedQuantity += $tempVotesQuantity;
        }
        $answers = ($totalQuantity - $votedQuantity).$answers;

        date_default_timezone_set('Europe/Kiev');
        $dataAndTime = explode('T', date(DATE_ATOM, microtime(true)));
        $time = explode(':', $dataAndTime[1]);

        $canReviewResults = $survey->review_in_process
        or $survey->time_of_finish < $dataAndTime[0].' '.$time[0].':'.$time[1]
        or $totalQuantity == $votedQuantity;


        $data = [
            'question'=>$survey->question,
            'timeOfStart'=>$survey->time_of_start,
            'timeOfFinish'=>$survey->time_of_finish,
            'reviewInProcess'=>$survey->review_in_process,
            'respondents'=>$respondents,
            'root_path'=>KeyValues::getKeyValues()['root_path'],
            'answerVariants'=>$answerVariantValues,
            'answerQuantities'=>$answers,
            'canReviewResults'=>$canReviewResults
        ];

        return view('surveyReview', $data);
    }
}
