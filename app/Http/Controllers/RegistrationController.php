<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function save(Request $request){
        if (Auth::check()){
            return redirect()->to(route('user.private'));
        }

        $validateFields = $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        $data =  [
            'email'=>$validateFields['email'],
            'password'=>$validateFields['password'],
            'role'=>'SUPER_ADMIN',
            'enable'=>true
        ];

        $user = User::create($data);

        if($user){
            Auth::login($user);
            return redirect()->to(route('user.private'));
        }

        return redirect(route('user.login'))->withErrors([
            'formError' => 'Error during user creating'
        ]);
    }
}
