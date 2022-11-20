<?php

namespace App\Libraries;

class TeacherPolicy{

    private $course, $topic ,$schoolYear, $subject ,$question, $document, $quiz, $exercise, $room_registration;

    public function __construct()
    {
        $this->course = app('App\Repositories\Interfaces\CourseRepositoryInterface');
        $this->topic = app('App\Repositories\Interfaces\TopicRepositoryInterface');
        $this->subject = app('App\Repositories\Interfaces\SubjectRepositoryInterface');
        $this->question = app('App\Repositories\Interfaces\QuestionRepositoryInterface');
        $this->document = app('App\Repositories\Interfaces\TopicDocumentRepositoryInterface');
        $this->quiz = app('App\Repositories\Interfaces\QuizRepositoryInterface');
        $this->exercise = app('App\Repositories\Interfaces\ExerciseRepositoryInterface');
        $this->room_registration = app('App\Repositories\Interfaces\RoomRegistrationRepositoryInterface');
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

    public function topic($topic_id){
        $topic = $this->topic->getById($topic_id);
        if(empty($topic)){
            abort(404);
        }
        if(!$this->course->checkCourseOfTeacher(auth()->guard('teacher')->id(), $topic->course_id)){
            abort(403);
        };
        return true;
    }

    public function subject($subject_id){
        $subject = $this->subject->getById($subject_id);
        if(empty($subject)){
            abort(404);
        }
        if(!$this->subject->checkSubjectOfTeacher(auth()->guard('teacher')->id(), $subject->id)){
            abort(403);
        };
        return true;
    }

    public function question($question_id){
        $question = $this->question->getById($question_id);
        if(empty($question)){
            abort(404);
        }
        if($question->teacher_id != auth()->guard('teacher')->id()){
            abort(403);
        }
        return true;
    }

    public function document($document_id){
        $document = $this->document->getById($document_id);
        if(empty($document)){
            abort(404);
        }
        $topic = $this->topic->getById($document->topic_id);
        if(!$this->course->checkCourseOfTeacher(auth()->guard('teacher')->id(), $topic->course_id)){
            abort(403);
        }
        return true;
    }

    public function quiz($quiz_id){
        $quiz = $this->quiz->getById($quiz_id);
        if(empty($quiz)){
            abort(404);
        }
        $topic = $this->topic->getById($quiz->topic_id);
        if(!$this->course->checkCourseOfTeacher(auth()->guard('teacher')->id(), $topic->course_id)){
            abort(403);
        }
        return true;
    }

    public function exercise($exercise_id){
        $exercise = $this->exercise->getById($exercise_id);
        if(empty($exercise)){
            abort(404);
        }
        $topic = $this->topic->getById($exercise->topic_id);
        if(!$this->course->checkCourseOfTeacher(auth()->guard('teacher')->id(), $topic->course_id)){
            abort(403);
        }
        return true;
    }

    public function roomRegistration($registration_id, $teacher_id){
        $registration = $this->room_registration->getById($registration_id);
        if(empty($registration)){
            abort(404);
        }
        if($registration->teacher_id != $teacher_id){
            abort(403);
        }
        if($registration->status != 0){
            abort(404);
        }
        return true;
    }

}