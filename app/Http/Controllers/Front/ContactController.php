<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Libraries\MyCourse;
use App\Repositories\Interfaces\AdminRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    private $myCourse, $admin;

    public function __construct(
        AdminRepositoryInterface $adminRepository
    )
    {
        $this->admin = $adminRepository;
        $this->myCourse = new MyCourse();
    }
    public function index(){
        if(Auth::guard('student')->check()){
            $data['myStudentCourses'] = $this->myCourse->getCourseOfStudent();
        }
        else{
            $data['myTeacherCourses'] = $this->myCourse->getCourseOfTeacher();
        }
        $data['admins'] = $this->admin->getDropdown();
        return view('front.contact', $data);
    }
}
