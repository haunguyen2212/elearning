<?php

namespace App\Libraries;

class StudentPolicy{

    private $course, $courseInvolvement, $schoolYear, $topic, $exercise, $quiz, $takeQuiz;

    public function __construct()
    {
        $this->course = app('App\Repositories\Interfaces\CourseRepositoryInterface');
        $this->topic = app('App\Repositories\Interfaces\TopicRepositoryInterface');
        $this->exercise = app('App\Repositories\Interfaces\ExerciseRepositoryInterface');
        $this->quiz = app('App\Repositories\Interfaces\QuizRepositoryInterface');
        $this->takeQuiz = app('App\Repositories\Interfaces\TakeQuizRepositoryInterface');
        $this->courseInvolvement = app('App\Repositories\Interfaces\CourseInvolvementRepositoryInterface');
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
        if(!$this->courseInvolvement->checkEnrol(auth()->guard('student')->id(), $course_id)){
            abort(403);
        };
        if(!$this->course->checkCourseOfCurrent($this->schoolYear->id, $course_id)){
            abort(404);
        }
        return true;
    }

    public function exercise($exercise_id){
        $exercise = $this->exercise->getById($exercise_id);
        if(empty($exercise) || ($exercise->is_show == 0)){
            abort(404);
        }
        $topic = $this->topic->getById($exercise->topic_id);
        if(!$this->courseInvolvement->checkEnrol(auth()->guard('student')->id(), $topic->course_id)){
            abort(403);
        }
        return true;
    }

    public function quiz($quiz_id){
        $quiz = $this->quiz->getById($quiz_id);
        if(empty($quiz) || ($quiz->is_show == 0)){
            abort(404);
        }
        $topic = $this->topic->getById($quiz->topic_id);
        if(!$this->courseInvolvement->checkEnrol(auth()->guard('student')->id(), $topic->course_id)){
            abort(403);
        }
        return true;
    }

    public function exam($take_quiz_id){
        $exam = $this->takeQuiz->getById($take_quiz_id);
        if(empty($exam)){
            abort(404);
        }
        if($exam->student_id != auth()->guard('student')->id()){
            abort(403);
        }
        return true;
    }

}