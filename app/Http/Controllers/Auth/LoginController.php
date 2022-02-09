<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginForm(){
        return view('auth.login');
    }

    public function postLogin(LoginRequest $request){
        $email = $request->email;
        $password = $request->password;
        if(Auth::attempt(['email' => $email, 'password' => $password], $request->remember)){
            return redirect(route('students.show', ['student' => Auth::user()->id]));
        }
        return back()->with([
            'msg' => 'Incorrect account/password',
            'email' => $email,
        ]);
    }
}
