<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CheckLoginRequest;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    private $student, $teacher;

    public function __construct(
        StudentRepositoryInterface $studentRepository,
        TeacherRepositoryInterface $teacherRepository
        )
    {
        $this->student = $studentRepository;
        $this->teacher = $teacherRepository;
    }

    public function index(){
        return view('front.login');
    }

    public function checkLogin(CheckLoginRequest $request){
        $credentials = $request->only(['username', 'password']);
        
        if(Auth::guard('student')->attempt($credentials)){
            $status = $this->student->getStatusAccount($credentials['username']);
            if($status == '0'){
                Auth::guard('student')->logout();
                return back()->withInput()->with('error', __('message.account_locked'));
            }
            return redirect()->route('home');
        }
        
        if(Auth::guard('teacher')->attempt($credentials)){
            $status = $this->teacher->getStatusAccount($credentials['username']);
            if($status == '0'){
                Auth::guard('teacher')->logout();
                return back()->withInput()->with('error', __('message.account_locked'));
            }
            return redirect()->route('home');
        }

        return back()->withInput()->with('error', __('message.login_error'));
    }

    public function logout(){
        if(Auth::guard('student')->check()){
            Auth::guard('student')->logout();
            return redirect()->route('login');
        }
        
        if(Auth::guard('teacher')->check()){
            Auth::guard('teacher')->logout();
            return redirect()->route('login');
        }
    }
}
