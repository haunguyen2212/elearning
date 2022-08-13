<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\TopicDocumentRepositoryInterface;
use App\Repositories\Interfaces\TopicRepositoryInterface;
use Illuminate\Http\Request;

class CourseStudentController extends Controller
{
    private $course, $topic, $topicDocument;

    public function __construct(
        CourseRepositoryInterface $courseRepository,
        TopicRepositoryInterface $topicRepository,
        TopicDocumentRepositoryInterface $topicDocumentRepository
    )
    {
        $this->course = $courseRepository;
        $this->topic = $topicRepository;
        $this->topicDocument = $topicDocumentRepository;
    }

    public function index($id){
        $course = $this->getCourseById($id);
        $topics = $this->topic->getActive($id);
        $documents = [];
        foreach($topics as $key => $topic){
            $documents[$key] = $this->topicDocument->getActive($topic->id);
        }
        return view('front.student.course', compact('course', 'topics', 'documents'));
    }

    public function getCourseById($id){
        $course = $this->course->getFullById($id);
        if(empty($course)){
            abort(404);
        }
        return $course;
    }
}
