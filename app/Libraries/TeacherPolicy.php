<?php

namespace App\Libraries;

class TeacherPolicy{

    private $course, $schoolYear, $subject ,$question;

    public function __construct()
    {
        $this->course = app('App\Repositories\Interfaces\CourseRepositoryInterface');
        $this->subject = app('App\Repositories\Interfaces\SubjectRepositoryInterface');
        $this->question = app('App\Repositories\Interfaces\QuestionRepositoryInterface');
        $schoolYear = new SchoolYear();
        $this->schoolYear = $schoolYear->current(); 
    }

    const VIEW_ANY = 1;
    const VIEW = 2;
    const CREATE = 3;
    const UPDATE = 4;
    const DELETE = 5;
    const RESTORE = 6;
    const FORCE_DELETE = 7;

    public function course($course_id){
        if(!$this->course->checkCourseOfTeacher(auth()->guard('teacher')->id(), $course_id)){
            abort(403);
        };
        if(!$this->course->checkCourseOfCurrent($this->schoolYear->id, $course_id)){
            abort(404);
        }
        return true;
    }

    public function subject($subject_id){
        $subject = $this->subject->getById($subject_id);
        if(!$this->subject->checkSubjectOfTeacher(auth()->guard('teacher')->id(), $subject->id)){
            abort(403);
        };
        return true;
    }

    public function question($question_id){
        $question = $this->question->getById($question_id);
        if($question->teacher_id != auth()->guard('teacher')->id()){
            abort(403);
        }
        return true;
    }

}