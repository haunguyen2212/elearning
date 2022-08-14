<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Libraries\MyCourse;
use App\Repositories\Interfaces\CourseInvolvementRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $course, $courseInvolvement ,$myCourse;

    public function __construct(
        CourseRepositoryInterface $courseRepository,
        CourseInvolvementRepositoryInterface $courseInvolvementRepository
    )
    {
        $this->course = $courseRepository;
        $this->courseInvolvement = $courseInvolvementRepository;
        $this->myCourse = new MyCourse();
    }

    public function index(){
        if(Auth::guard('student')->check()){
            $myCourses = $this->myCourse->getCourseOfStudent();
        }
        else{
            $myCourses = $this->myCourse->getCourseOfTeacher();
        }
        $courses = $this->course->getFullInfo(15);
        return view('home', compact('courses', 'myCourses'));
    }

    public function detail($id){
        if(Auth::guard('student')->check()){
            $myCourses = $this->myCourse->getCourseOfStudent();
        }
        else{
            $myCourses = $this->myCourse->getCourseOfTeacher();
        }
        $course = $this->getCourseById($id);
        return view('front.student.course_enrol', compact('course', 'myCourses'));
    }

    public function enrol($id){
        $course = $this->getCourseById($id);
        if($course->is_enrol == 0){
            return back()->with('error', __('message.enrol_expired'));
        }

        if(!$this->courseInvolvement->checkEnrol(Auth::guard('student')->id(), $id)){
            return back()->with('error', __('message.enrolled'));
        }

        $collection['course_id'] = $id;
        $collection['student_id'] = Auth::guard('student')->id();
        $enrol = $this->courseInvolvement->create($collection);

        if($enrol){
            return redirect()->route('course.index', $id);
        }
        else{
            return back()->with('error', __('message.error'));
        }
    }

    public function getCourseById($id){
        $course = $this->course->getFullById($id);
        if(empty($course)){
            abort(404);
        }
        return $course;
    }
}
