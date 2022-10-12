<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Libraries\MyCourse;
use App\Libraries\SchoolYear;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentInformationController extends Controller
{
    private $myCourse, $student, $schoolYear;

    public function __construct(
        StudentRepositoryInterface $studentRepository
    )
    {
        $this->student = $studentRepository;
        $this->myCourse = new MyCourse();
        $schoolYear = new SchoolYear();
        $this->schoolYear = $schoolYear->current();
    }

    public function index($id){
        $data['student'] = $this->student->getByIdOfCurrent($this->schoolYear->id, $id);
        $data['myTeacherCourses'] = $this->myCourse->getCourseOfTeacher();
        return view('front.teacher.student_information', $data);
    }
}
