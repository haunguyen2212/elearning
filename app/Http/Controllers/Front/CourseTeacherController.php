<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\RenameTopicDocumentRequest;
use App\Http\Requests\StoreLinkDocumentRequest;
use App\Http\Requests\StoreTopicRequest;
use App\Http\Requests\UpdateCourseNoticeRequest;
use App\Http\Requests\UpdateTopicRequest;
use App\Libraries\MyCourse;
use App\Libraries\TeacherPolicy;
use App\Repositories\Interfaces\CourseInvolvementRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\ExerciseRepositoryInterface;
use App\Repositories\Interfaces\NotificationDetailRepositoryInterface;
use App\Repositories\Interfaces\NotificationRepositoryInterface;
use App\Repositories\Interfaces\QuizRepositoryInterface;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Repositories\Interfaces\TopicDocumentRepositoryInterface;
use App\Repositories\Interfaces\TopicRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CourseTeacherController extends Controller
{

    private $myCourse, $course, $topic, $topicDocument, $student, $courseInvolvement, $policy, $exercise, $quiz;
    private $notification, $notificationDetail;

    public function __construct(
        CourseRepositoryInterface $courseRepository,
        TopicRepositoryInterface $topicRepository,
        TopicDocumentRepositoryInterface $topicDocumentRepository,
        StudentRepositoryInterface $studentRepository,
        CourseInvolvementRepositoryInterface $courseInvolvementRepository,
        ExerciseRepositoryInterface $exerciseRepository,
        QuizRepositoryInterface $quizRepository,
        NotificationRepositoryInterface $notificationRepository,
        NotificationDetailRepositoryInterface $notificationDetailRepository
    )
    {
        $this->course = $courseRepository;
        $this->topic = $topicRepository;
        $this->topicDocument = $topicDocumentRepository;
        $this->student = $studentRepository;
        $this->courseInvolvement = $courseInvolvementRepository;
        $this->exercise = $exerciseRepository;
        $this->quiz = $quizRepository;
        $this->notification = $notificationRepository;
        $this->notificationDetail = $notificationDetailRepository;
        $this->myCourse = new MyCourse();
        $this->policy = new TeacherPolicy();
    }

    public function index($id){
        $this->policy->course($id);
        $data['course'] = $this->getCourseById($id);
        $data['topics'] = $this->topic->getAll($id);
        $data['documents'] = [];
        $data['exercises'] = [];
        $data['quizzes'] = [];
        foreach($data['topics'] as $key => $topic){
            $data['documents'][$key] = $this->topicDocument->getAll($topic->id);
            $data['exercises'][$key] = $this->exercise->getAll($topic->id);
            $data['quizzes'][$key] = $this->quiz->getAll($topic->id);
        }
        $data['myTeacherCourses'] = $this->myCourse->getCourseOfTeacher();
        $data['listStudent'] = $this->course->getStudentOfCourse($id);
        return view('front.teacher.course', $data);
    }

    public function pinTopic($id){
        DB::beginTransaction();
        try{
            $this->policy->topic($id);
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
            $this->policy->topic($id);
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
            $this->policy->topic($id);
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
            $this->policy->topic($id);
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
        $course = $this->course->getFullById($id);
        $listStudent = $this->course->getStudentOfCourse($id);
        $collection = $request->except(['_token']);
        $collection['course_id'] = $id;
        DB::beginTransaction();
        try{
            $this->policy->course($id);
            $this->topic->create($collection);
            $dataNotification = [
                'content' => __('notification.create_topic', ['name' => $course->name]),
                'link' => route('course.view.student', ['id' => $id]),
                'active' => 1,
            ];
            $notification = $this->notification->create($dataNotification);
            foreach($listStudent as $student){
                $collectionDetail = [
                    'student_id' => $student->id,
                    'notification_id' => $notification->id,
                ];
                $this->notificationDetail->create($collectionDetail);
            }
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
        $documents = $request->file('document');
        $err = [];
        DB::beginTransaction();
        try{
            $this->policy->topic($id);
            if($documents){
                foreach($documents as $document) {
                    $file = $document->getClientOriginalName();
                    if($document->getSize() > 2000000){
                        array_push($err, __('message.upload_file_too_big', ['name' => $file]));
                        continue;
                    }
                    $directory = 'frontend/upload/'.$course->code.'/document';
                    if(!(file_exists($directory) && is_dir($directory))){
                        mkdir($directory, 0775, true);
                    }
                    if(file_exists($directory.'/'.$file)){
                        array_push($err, __('message.file_exists', ['name' => $file]));
                        continue;
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
            }
            DB::commit();
            if(!empty($err)){
                return back()->with('err_exists_file', $err);
            }   
            return back();
        }
        catch(\Exception $e){
            DB::rollBack();
            return back();
        }
    }

    public function editTopic($id){
        $data = $this->topic->getById($id);
        if(empty($data)){
            session()->flash('error', __('message.not_found', ['name' => 'chủ đề']));
            return response()->json(['status' => 0]);
        }
        $this->policy->topic($id);
        return response()->json(['data' => $data, 'status' => 1]);
    }

    public function updateTopic($id, UpdateTopicRequest $request){
        DB::beginTransaction();
        try{
            $this->policy->topic($id);
            $collection = $request->except(['_token', '_method']);
            $this->topic->update($id, $collection);
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            session()->flash('error', __('message.update_error', ['name' => 'chủ đề']));
            return response()->json(['status' => 0]);
        }
    }

    public function deleteTopic($id){
        DB::beginTransaction();
        try{
            $this->policy->topic($id);
            $course = $this->topic->getCourse($id);
            $documents = $this->topic->getAllDocument($id);
            foreach($documents as $document){
                $file = 'frontend/upload/'.$course->code.'/document'.'/'.$document->link;
                if(file_exists($file) && is_file($file)){
                    unlink($file);
                }
            }
            $this->topic->delete($id);
            DB::commit();
            return response()->json(['data' => $documents,'status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        } 
    }

    public function storeLink($topic_id, StoreLinkDocumentRequest $request){
        DB::beginTransaction();
        try{
            $this->policy->topic($topic_id);
            $collection = [
                'topic_id' => $topic_id,
                'name' => $request->name,
                'link' => $request->link,
                'type' => 3,
            ];
            $this->topicDocument->create($collection);
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }

    public function showDocument($id){
        DB::beginTransaction();
        try{
            $this->policy->document($id);
            $this->topicDocument->show($id);
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }

    public function hideDocument($id){
        DB::beginTransaction();
        try{
            $this->policy->document($id);
            $this->topicDocument->hide($id);
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }

    public function deleteDocument($id){
        DB::beginTransaction();
        try{
            $this->policy->document($id);
            $document = $this->topicDocument->getById($id);
            $course = $this->topicDocument->getCourse($id);
            $file = 'frontend/upload/'.$course->code.'/document'.'/'.$document->link;
            if(file_exists($file) && is_file($file)){
                unlink($file);
            }
            $this->topicDocument->delete($id);
            DB::commit();
            return response()->json(['data' => $file,'status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }

    public function editRenameDocument($id){
        $data = $this->topicDocument->getById($id);
        if(empty($data)){
            return response()->json(['status' => 0]);
        }
        $this->policy->document($id);
        return response()->json(['data' => $data, 'status' => 1]);
    }

    public function updateRenameDocument($id, RenameTopicDocumentRequest $request){
        DB::beginTransaction();
        try{
            $this->policy->document($id);
            $collection = $request->except(['_token', '_method']);
            $this->topicDocument->rename($id, $collection);
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }

    public function confirmDeleteStudent($course_id, $student_id){
        $data = $this->student->getById($student_id);
        if(empty($data)){
            return response()->json(['status' => 0]);
        }
        $this->policy->course($course_id);
        return response()->json(['data' => $data, 'status' => 1]);
    }

    public function deleteStudent($course_id, $student_id){
        DB::beginTransaction();
        try{
            $this->policy->course($course_id);
            $this->courseInvolvement->delete($course_id, $student_id);
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }

    public function updateNotice($id, UpdateCourseNoticeRequest $request){
        DB::beginTransaction();
        try{
            $this->policy->course($id);
            $course = $this->course->getFullById($id);
            $listStudent = $this->course->getStudentOfCourse($id);
            $collection = $request->except(['_token', '_method']);
            $this->course->updateNotice($id, $collection);
            $dataNotification = [
                'content' => __('notification.update_notice', ['name' => $course->name]),
                'link' => route('course.view.student', ['id' => $id]),
                'active' => 1,
            ];
            $notification = $this->notification->create($dataNotification);
            foreach($listStudent as $student){
                $collectionDetail = [
                    'student_id' => $student->id,
                    'notification_id' => $notification->id,
                ];
                $this->notificationDetail->create($collectionDetail);
            }
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }   
    }

    public function changeEnrol($id, $value){
        $status = ($value == 1) ? 1 : 0;
        DB::beginTransaction();
        try{
            $this->policy->course($id);
            $this->course->changeEnrol($id, $status);
            if($status == 1){
                session()->flash('success', __('message.accept_enrol'));
            }
            else{
                session()->flash('success', __('message.deny_enrol'));
            }
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            session()->flash('error', __('message.error'));
            return response()->json(['status' => 0]);
        }
    }

    public function getCourseById($id){
        $course = $this->course->getFullById($id);
        if(empty($course)){
            abort(404);
        }
        return $course;
    }
}
