<?php

namespace App\Http\Controllers;

use App\Mail\AdminMail;
use App\Models\Answer;
use App\Models\AnswerVariant;
use App\Models\Respondent;
use App\Models\Survey;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use KeyValues;

class AdminController extends Controller
{
    public function getAllAdmins(Request $request) {
        if (Auth::check() and User::find(Auth::id())->role == 'SUPER_ADMIN') {
            $admins = User::where('role', 'ADMIN')->get();
            $adminDtoList = array();

            foreach ($admins as $admin) {
                array_push($adminDtoList, [
                    'admin_id' => $admin->id,
                    'admin_email' => $admin->email,
                    'enable' => $admin->enable
                ]);
            }

            return view('adminPage', [
                'root_path'=>KeyValues::getKeyValues()['root_path'],
                'admins'=>$adminDtoList
            ]);
        }

        return redirect()->to(route('user.private'));
    }

    public function addNewAdmin(Request $request) {
        $validateFields = $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        $data =  [
            'email'=>$validateFields['email'],
            'password'=>$validateFields['password'],
            'role'=>'ADMIN',
            'enable'=>true
        ];

        User::create($data);

        $details = [
            'subject' => 'Надано права адміністратора',
            'email' => $data['email'],
            'password' => $data['password']
        ];
        Mail::to($data['email'])->send(new AdminMail($details));


        return redirect(route('admin.users'));
    }

    public function deleteAdminById($id) {

        $surveys = Survey::where("user_id", $id)->get();

        foreach ($surveys as $survey) {
            $answersForDeleting = Answer::where('survey_id',$survey->id)->get();
            foreach ($answersForDeleting as $answer) {
                $answer->delete();
            }
            $respondentsForDeleting = Respondent::where('survey_id',$survey->id)->get();
            foreach ($respondentsForDeleting as $respondent) {
                $respondent->delete();
            }
            $answerVariantForDeleting = AnswerVariant::where('survey_id',$survey->id)->get();
            foreach ($answerVariantForDeleting as $answerVariant) {
                $answerVariant->delete();
            }
            Survey::find($survey->id)->delete();
        }

        User::find($id)->delete();
        return redirect(\route('admin.users'));
    }

    public function disableById($id) {
        $user = User::find($id);
        $user->enable = false;
        $user->save();
    }

    public function enableById($id) {
        $user = User::find($id);
        $user->enable = true;
        $user->save();
    }
}
