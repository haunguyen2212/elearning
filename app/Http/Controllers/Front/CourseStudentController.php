<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Libraries\MyCourse;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\TopicDocumentRepositoryInterface;
use App\Repositories\Interfaces\TopicRepositoryInterface;
use Illuminate\Http\Request;

class CourseStudentController extends Controller
{
    private $course, $topic, $topicDocument, $myCourse;

    public function __construct(
        CourseRepositoryInterface $courseRepository,
        TopicRepositoryInterface $topicRepository,
        TopicDocumentRepositoryInterface $topicDocumentRepository
    )
    {
        $this->course = $courseRepository;
        $this->topic = $topicRepository;
        $this->topicDocument = $topicDocumentRepository;
        $this->myCourse = new MyCourse();
    }

    public function index($id){
        $course = $this->getCourseById($id);
        $myCourses = $this->myCourse->getCourseOfStudent();
        $topics = $this->topic->getActive($id);
        $documents = [];
        foreach($topics as $key => $topic){
            $documents[$key] = $this->topicDocument->getActive($topic->id);
        }
        return view('front.student.course', compact('course', 'topics', 'documents', 'myCourses'));
    }

    public function getCourseById($id){
        $course = $this->course->getFullById($id);
        if(empty($course)){
            abort(404);
        }
        return $course;
    }
}
