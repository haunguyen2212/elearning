<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Libraries\MyCourse;
use App\Libraries\SchoolYear;
use App\Libraries\TeacherPolicy;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentInformationController extends Controller
{
    private $myCourse, $student, $schoolYear, $course, $policy;

    public function __construct(
        StudentRepositoryInterface $studentRepository,
        CourseRepositoryInterface $courseRepository
    )
    {
        $this->student = $studentRepository;
        $this->course = $courseRepository;
        $this->myCourse = new MyCourse();
        $schoolYear = new SchoolYear();
        $this->schoolYear = $schoolYear->current();
        $this->policy = new TeacherPolicy();
    }

    public function index($course_id, $student_id){
        $this->policy->course($course_id);
        $data['course'] = $this->getCourseById($course_id);
        $data['info'] = $this->student->getByIdOfCurrent($this->schoolYear->id, $student_id);
        if(empty($data['info'])){
            abort(404);
        }
        $data['myTeacherCourses'] = $this->myCourse->getCourseOfTeacher();
        $data['listStudent'] = $this->course->getStudentOfCourse($course_id);
        return view('front.teacher.student_information', $data);
    }

    public function getCourseById($id){
        $course = $this->course->getFullById($id);
        if(empty($course)){
            abort(404);
        }
        return $course;
    }
}
