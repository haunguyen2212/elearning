<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Libraries\MyCourse;
use App\Libraries\Policy;
use App\Libraries\StudentPolicy;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\ExerciseRepositoryInterface;
use App\Repositories\Interfaces\TopicDocumentRepositoryInterface;
use App\Repositories\Interfaces\TopicRepositoryInterface;
use Illuminate\Http\Request;

class CourseStudentController extends Controller
{
    private $course, $topic, $topicDocument, $exercises, $myCourse, $policy;

    public function __construct(
        CourseRepositoryInterface $courseRepository,
        TopicRepositoryInterface $topicRepository,
        TopicDocumentRepositoryInterface $topicDocumentRepository,
        ExerciseRepositoryInterface $exerciseRepository
    )
    {
        $this->course = $courseRepository;
        $this->topic = $topicRepository;
        $this->topicDocument = $topicDocumentRepository;
        $this->exercises = $exerciseRepository;
        $this->myCourse = new MyCourse();
        $this->policy = new StudentPolicy();
    }

    public function index($id){
        $this->policy->course($id);
        $course = $this->getCourseById($id);
        $myStudentCourses = $this->myCourse->getCourseOfStudent();
        $topics = $this->topic->getActive($id);
        $documents = [];
        $exercises = [];
        foreach($topics as $key => $topic){
            $documents[$key] = $this->topicDocument->getActive($topic->id);
            $exercises[$key] = $this->exercises->getActive($topic->id);
        }
        return view('front.student.course', compact('course', 'topics', 'documents', 'myStudentCourses', 'exercises'));
    }

    public function getCourseById($id){
        $course = $this->course->getFullById($id);
        if(empty($course)){
            abort(404);
        }
        return $course;
    }
}
