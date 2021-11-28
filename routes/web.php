<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
class KeyValues
{
    public static function getKeyValues(): array
    {
        return [
            'root_path' => env('APP_URL')
        ];
    }
}
Route::get('/', function () {
    return view('welcome', KeyValues::getKeyValues());
})->name('root');

Route::name('user.')->group(function (){
    Route::view('/private', 'private', KeyValues::getKeyValues())->middleware('auth')->name('private');

    Route::get('/login', function (){
        if (Auth::check()){
            return redirect(\route('user.private'));
        }
        return view('login', KeyValues::getKeyValues());
    })->name('login');

    Route::post('/login', [LoginController::class, 'login']);

    Route::post('/loginFromMainPage', [LoginController::class, 'loginFromMainPage'])->name('loginFromMainPage');

    Route::get('/logout', function (){
        Auth::logout();
        return redirect('/');
    })->name('logout');

    Route::get('/registration', function (){
        if (Auth::check()){
            return redirect(\route('user.private', KeyValues::getKeyValues()));
        }
        return view('registration', KeyValues::getKeyValues());
    })->name('registration');

    Route::post('/registration', [RegistrationController::class, 'save']);

    Route::view('/surveys/new', 'addNewSurvey', KeyValues::getKeyValues())->middleware('auth')->name('newSurvey');

    Route::post('/surveys/create', [SurveyController::class, 'save'])->middleware('auth');

    Route::get('/surveys', [SurveyController::class, 'getAllSurveysForLoggedUser'])->middleware('auth');
});

Route::get('/surveys/vote/{token}', [SurveyController::class, 'getSurveyInfoByToken']);

Route::post('/surveys/vote', [SurveyController::class, 'saveAnswer'])->name('vote');

Route::post('/survey/delete/{id}', [SurveyController::class, 'deleteById'])->middleware('auth');

Route::get('/survey/review/{id}', [SurveyController::class, 'getSurveyInfoById'])->middleware('auth');

Route::name('admin.')->group(function (){
    Route::get('/admin/users', [AdminController::class, 'getAllAdmins'])->middleware('auth')->name('users');

    Route::post('/admin/users/new', [AdminController::class, 'addNewAdmin'])->middleware('auth')->name('newAdmin');

    Route::post('/admin/user/disable/{id}', [AdminController::class, 'disableById'])->middleware('auth');

    Route::post('/admin/user/enable/{id}', [AdminController::class, 'enableById'])->middleware('auth');

    Route::post('/admin/user/delete/{id}', [AdminController::class, 'deleteAdminById'])->middleware('auth');
});
