<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use Illuminate\Http\Request;

class CourseStudentController extends Controller
{
    private $course;

    public function __construct(
        CourseRepositoryInterface $courseRepository
    )
    {
        $this->course = $courseRepository;
    }

    public function index($id){
        $course = $this->course->getFullById($id);
        return view('front.student.course', compact('course'));
    }
}
