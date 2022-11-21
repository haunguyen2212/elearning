<?php

namespace App\Http\Controllers\Front;

use App\Exports\ScoreExamExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuizRequest;
use App\Http\Requests\UpdateQuizRequest;
use App\Libraries\MyCourse;
use App\Libraries\TeacherPolicy;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\NotificationDetailRepositoryInterface;
use App\Repositories\Interfaces\NotificationRepositoryInterface;
use App\Repositories\Interfaces\QuestionRepositoryInterface;
use App\Repositories\Interfaces\QuizDetailRepositoryInterface;
use App\Repositories\Interfaces\TopicRepositoryInterface;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\QuizRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;

class QuizTeacherController extends Controller
{
    private $quiz, $topic, $course, $myCourse, $question, $quizDetail, $policy;
    private $notification, $notificationDetail;

    public function __construct(
        QuizRepositoryInterface $quizRepository,
        TopicRepositoryInterface $topicRepository,
        CourseRepositoryInterface $courseRepository,
        QuestionRepositoryInterface $questionRepository,
        QuizDetailRepositoryInterface $quizDetailRepository,
        NotificationRepositoryInterface $notificationRepository,
        NotificationDetailRepositoryInterface $notificationDetailRepository
    )
    {
        $this->quiz = $quizRepository;
        $this->topic = $topicRepository;
        $this->course = $courseRepository;
        $this->question = $questionRepository;
        $this->quizDetail = $quizDetailRepository;
        $this->notification = $notificationRepository;
        $this->notificationDetail = $notificationDetailRepository;
        $this->myCourse = new MyCourse();
        $this->policy = new TeacherPolicy();
    }

    public function index($course_id, $id){
        $data['course'] = $this->course->getFullById($course_id);
        $data['quiz'] = $this->quiz->getById($id);
        $this->checkIssetQuiz($course_id, $data['quiz']);
        $this->policy->quiz($id);
        $data['questions'] = $this->quiz->getAllQuestion($id);
        $data['listStudent'] = $this->course->getStudentOfCourse($course_id);
        return view('front.teacher.quiz', $data);
    }

    public function viewScore($course_id, $id){
        $data['course'] = $this->course->getFullById($course_id);
        $data['quiz'] = $this->quiz->getById($id);
        $this->checkIssetQuiz($course_id, $data['quiz']);
        $this->policy->quiz($id);
        $data['questions'] = $this->quiz->getAllQuestion($id);
        $data['listStudent'] = $this->course->getStudentOfCourse($course_id);
        $data['scores'] = [];
        foreach($data['listStudent'] as $student){
            $data['scores'][$student->id] = $this->quiz->getScoreOfStudent($id, $student->id);
        }
        return view('front.teacher.score_quiz', $data);
    }

    public function store($topic_id, StoreQuizRequest $request){
        $this->policy->topic($topic_id);
        DB::beginTransaction();
        try{
            $course = $this->topic->getCourse($topic_id);
            $listStudent = $this->course->getStudentOfCourse($course->id);
            $collection = [
                'topic_id' => $topic_id,
                'subject_id' => $course->subject_id,
                'name' => $request->name,
                'duration' => $request->duration,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'password' => $request->password,
                'is_show' => $request->is_show ?? 0,
                'maximum' => $request->maximum ?? 1,
            ];
            $store = $this->quiz->create($collection);
            $url = route('teacher.quiz.index', ['course_id' => $course->id, 'id' => $store->id]);
            if($request->is_show){
                $dataNotification = [
                    'content' => __('notification.create_quiz', ['name' => $course->name]),
                    'link' => route('student.quiz.index', ['course_id' => $course->id, 'id' => $store->id]),
                    'active' => 1,
                ];
                $notification = $this->notification->create($dataNotification);
                foreach($listStudent as $student){
                    $collectionDetail = [
                        'notification_id' => $notification->id,
                        'student_id' => $student->id,
                    ];
                    $this->notificationDetail->create($collectionDetail);
                }
            }
            DB::commit();
            return response()->json(['data' => $url,'status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }

    public function hide($id){
        $this->policy->quiz($id);
        DB::beginTransaction();
        try{
            $this->quiz->hide($id);
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }

    public function show($id){
        $this->policy->quiz($id);
        DB::beginTransaction();
        try{
            $this->quiz->show($id);
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }

    public function edit($id){
        $this->policy->quiz($id);
        $data = $this->quiz->getById($id);
        if(empty($data)){
            return response()->json(['status' => 0]);
        }
        return response()->json(['data' => $data, 'status' => 1]);
    }

    public function update($id, UpdateQuizRequest $request){
        $this->policy->quiz($id);
        $collection = $request->except(['_token', '_method']);
        DB::beginTransaction();
        try{
            $this->quiz->update($id, $collection);
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }

    public function delete($id){
        $this->policy->quiz($id);
        DB::beginTransaction();
        try{
            $this->quiz->delete($id);
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }

    public function editQuestion($course_id, $id){
        $data['course'] = $this->course->getFullById($course_id);
        $data['quiz'] = $this->quiz->getById($id);
        $this->checkIssetQuiz($course_id, $data['quiz']);
        $this->policy->quiz($id);
        $question_details = $this->quiz->getAllQuestion($id);
        $data['question_details'] = [];
        foreach($question_details as $question){
            array_push($data['question_details'], $question->id);
        }
        $data['questions'] = $this->question->getAllQuestionCanUse($data['quiz']->id, $data['course']->subject_id, auth()->guard('teacher')->id());
        return view('front.teacher.change_question', $data);
    }

    public function saveQuestion($course_id, $id, Request $request){
        $quiz = $this->quiz->getById($id);
        $this->checkIssetQuiz($course_id, $quiz);
        $this->policy->quiz($id);
        $ids = $request->ids;
        DB::beginTransaction();
        try{
            $this->quizDetail->deleteAll($quiz->id);
            if(!empty($ids)){
                foreach($ids as $question_id){
                    $collection = [
                        'quiz_id' => $quiz->id,
                        'question_id' => $question_id,
                    ];
                    $this->quizDetail->create($collection);
                }
            }
            DB::commit();
            session()->flash('message', __('message.update_success', ['name' => 'câu hỏi của bài thi']));
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            session()->flash('message', __('message.update_error', ['name' => 'câu hỏi của bài thi']));
            return response()->json(['status' => 0]);
        }
    }

    public function exportScore($course_id, $id){
        $quiz = $this->quiz->getById($id);
        $this->checkIssetQuiz($course_id, $quiz);
        $this->policy->quiz($id);
        $listStudent = $this->course->getStudentOfCourse($course_id);
        $score = [];
        foreach($listStudent as $student){
            $score[$student->id] = $this->quiz->getScoreOfStudent($id, $student->id);
        }
        $data[] = ['Mã số', 'Họ và tên', 'Thời gian bắt đầu', 'Thời gian nộp bài', 'Số câu đúng', 'Tổng số câu', 'Điểm'];
        foreach($listStudent as $student){
            $start_time = $submit_time = $number_correct = $total = $mark = ''; 
            foreach($score[$student->id] as $value){
                $start_time .= date('d/m/Y H:i:s', strtotime($value->start_time)).(($score[$student->id]->last() == $value) ? '' : "\r\n");
                $submit_time .= date('d/m/Y H:i:s', strtotime($value->submit_time)).(($score[$student->id]->last() == $value) ? '' : "\r\n");
                $number_correct .= $value->number_correct.(($score[$student->id]->last() == $value) ? '' : "\r\n");
                $total .= $value->total.(($score[$student->id]->last() == $value) ? '' : "\r\n");
                $mark .= $value->score.(($score[$student->id]->last() == $value) ? '' : "\r\n");
            }
            $data[] = [
                $student->username, $student->name, $start_time, $submit_time, $number_correct, $total, $mark
            ];
        }
        return Excel::download(new ScoreExamExport($data), 'ket-qua-thi-'. Str::slug($quiz->name) .'.xlsx');
    }

    public function checkIssetQuiz($course_id, $quiz){
        if(empty($quiz)){
            abort(404);
        }
        else{
            $topic = $this->topic->getById($quiz->topic_id);
            if($topic->course_id != $course_id){
                abort(404);
            }
        }
        return true;
    }
}
