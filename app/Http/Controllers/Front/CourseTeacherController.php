<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTopicRequest;
use App\Libraries\MyCourse;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\TopicDocumentRepositoryInterface;
use App\Repositories\Interfaces\TopicRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function pinTopic($id){
        DB::beginTransaction();
        try{
            $this->topic->pin($id);
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }

    public function unpinTopic($id){
        DB::beginTransaction();
        try{
            $this->topic->unpin($id);
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }

    public function showTopic($id){
        DB::beginTransaction();
        try{
            $this->topic->show($id);
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }

    public function hideTopic($id){
        DB::beginTransaction();
        try{
            $this->topic->hide($id);
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }

    public function storeTopic($id, StoreTopicRequest $request){
        $collection = $request->except(['_token']);
        $collection['course_id'] = $id;
        DB::beginTransaction();
        try{
            $this->topic->create($collection);
            DB::commit();
            return response()->json(['data' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['data' => 0]);
        }
    }

    public function uploadDocument($id ,Request $request){
        $course = $this->topic->getCourse($id);
        $document = $request->file('document');
        if($document){
            $file = $request->file('document')->getClientOriginalName();
            $directory = 'frontend/upload/'.$course->code.'/document';
            if(!(file_exists($directory) && is_dir($directory))){
                mkdir($directory, 0775, true);
            }
            if(file_exists($directory.'/'.$file)){
                return back()->with('error', __('message.file_exists'));
            }
            $document->move(public_path($directory), $file);
            $collection = [
                'topic_id' => $id,
                'name' => $file,
                'link' => $file,
                'type' => 1,
            ];
            $this->topicDocument->create($collection);
        }
        return back();
    }

    public function getCourseById($id){
        $course = $this->course->getFullById($id);
        if(empty($course)){
            abort(404);
        }
        return $course;
    }
}
