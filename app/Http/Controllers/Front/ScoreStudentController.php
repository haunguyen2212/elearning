<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Libraries\MyCourse;
use App\Libraries\SchoolYear;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use Illuminate\Http\Request;

class ScoreStudentController extends Controller
{
    private $student, $myCourse, $schoolYear;

    public function __construct(
        StudentRepositoryInterface $studentRepository
    )
    {
        $this->student = $studentRepository;
        $this->myCourse = new MyCourse();
        $schoolYear = new SchoolYear();
        $this->schoolYear = $schoolYear->current();
    }

    public function index(){
        if(auth()->guard('student')->check()){
            $data['myStudentCourses'] = $this->myCourse->getCourseOfStudent();
        }
        else{
            $data['myTeacherCourses'] = $this->myCourse->getCourseOfTeacher();
        }
        $data['exercises'] = $this->student->getScoreExerciseOfCurrent(auth()->guard('student')->id(), $this->schoolYear->id);
        $data['quizzes'] = $this->student->getScoreQuizOfCurrent(auth()->guard('student')->id(), $this->schoolYear->id);
        return view('front.student.score', $data);
    }
}
