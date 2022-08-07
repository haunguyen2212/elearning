<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $course;

    public function __construct(CourseRepositoryInterface $courseRepository)
    {
        $this->course = $courseRepository;
    }

    public function index(){
        $courses = $this->course->getFullInfo(15);
        return view('home', compact('courses'));
    }
}
