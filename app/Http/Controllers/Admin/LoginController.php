<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckLoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('admin.auth.login');
    }

    public function checkLogin(CheckLoginRequest $request){
        $credentials = $request->only(['username', 'password']);
        if(Auth::guard('admin')->attempt($credentials)){
            return redirect()->route('admin.home');
        }
        else{
            return redirect()->route('admin.login')->with('error', __('message.login_error'));
        }
    }

    public function logout(){
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
