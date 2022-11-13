<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Libraries\MyCourse;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\QuizRepositoryInterface;
use Illuminate\Http\Request;

class QuizStudentController extends Controller
{
    private $quiz, $course, $myCourse;

    public function __construct(
        QuizRepositoryInterface $quizRepository,
        CourseRepositoryInterface $courseRepository
    )
    {
        $this->quiz = $quizRepository;
        $this->course = $courseRepository;
        $this->myCourse = new MyCourse();
    }

    public function index($course_id, $id){
        $data['course'] = $this->course->getFullById($course_id);
        $data['myStudentCourses'] = $this->myCourse->getCourseOfStudent();
        $data['quiz'] = $this->quiz->getById($id);
        return view('front.student.quiz', $data);
    }

    public function exam(){
        return view('front.student.take_quiz');
    }
}
