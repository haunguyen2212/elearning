<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CheckLoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('front.login');
    }

    public function checkLogin(CheckLoginRequest $request){
        $credentials = $request->only(['username', 'password']);
        if(Auth::guard('student')->attempt($credentials)){
            dd(Auth::guard('student')->user());
        }
        
        if(Auth::guard('teacher')->attempt($credentials)){
            dd(Auth::guard('teacher')->user());
        }

        return redirect()->route('login')->with('error', __('message.login_error'));
    }
}
