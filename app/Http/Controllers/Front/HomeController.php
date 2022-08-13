<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Libraries\MyCourse;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $course, $myCourse;

    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->course = $courseRepository;
        $this->myCourse = new MyCourse();
    }

    public function index(){
        $myCourses = $this->myCourse->getCourseOfStudent();
        $courses = $this->course->getFullInfo(15);
        return view('home', compact('courses', 'myCourses'));
    }

    public function detail($id){
        $myCourses = $this->myCourse->getCourseOfStudent();
        $course = $this->getCourseById($id);
        return view('front.student.course_enrol', compact('course', 'myCourses'));
    }

    public function getCourseById($id){
        $course = $this->course->getFullById($id);
        if(empty($course)){
            abort(404);
        }
        return $course;
    }
}
