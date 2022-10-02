<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Libraries\MyCourse;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\TopicDocumentRepositoryInterface;
use App\Repositories\Interfaces\TopicRepositoryInterface;
use Illuminate\Http\Request;

class CourseTeacherController extends Controller
{

    private $myCourse, $course, $topic, $topicDocument;

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
        $data['course'] = $this->getCourseById($id);
        $data['topics'] = $this->topic->getAll($id);
        $data['documents'] = [];
        foreach($data['topics'] as $key => $topic){
            $data['documents'][$key] = $this->topicDocument->getActive($topic->id);
        }
        $data['myTeacherCourses'] = $this->myCourse->getCourseOfTeacher();
        return view('front.teacher.course', $data);
    }

    public function getCourseById($id){
        $course = $this->course->getFullById($id);
        if(empty($course)){
            abort(404);
        }
        return $course;
    }
}
