<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use KeyValues;

class LoginController extends Controller
{
    public function login(Request $request){
        if (Auth::check()){
            return redirect()->to(route('user.private'));
        }

        $formFields = $request->only(['email', 'password']);

        $user = User::where('email', $formFields['email'])->get();
        if (count($user) > 0 and !$user[0]->enable){
            return view('error', [
                'errorMessage' => 'Вибачте, але цей користувач був заблокований адміністратором ресурсу.',
                'root_path'=>KeyValues::getKeyValues()['root_path']
            ]);
        }

        if (Auth::attempt($formFields)){
            return redirect()->intended(route('user.private'));
        }

        return redirect(route('user.login'))->withErrors([
            'email' => 'Wrong login or password'
        ]);
    }

    public function loginFromMainPage(Request $request){
        if (Auth::check()){
            return redirect()->to(route('user.private'));
        }

        $formFields = $request->only(['email', 'password']);

        $user = User::where('email', $formFields['email'])->get();
        if (count($user) > 0 and !$user[0]->enable){
            return view('error', [
                'errorMessage' => 'Вибачте, але цей користувач був заблокований адміністратором ресурсу.',
                'root_path'=>KeyValues::getKeyValues()['root_path']
            ]);
        }

        if (Auth::attempt($formFields)){
            return redirect()->intended(route('user.private'));
        }

        return redirect(route('root'))->withErrors([
            'email' => 'Хибна адреса пошти або пароль'
        ]);
    }
}
