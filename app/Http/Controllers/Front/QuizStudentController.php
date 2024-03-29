<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckPasswordQuizRequest;
use App\Libraries\MyCourse;
use App\Libraries\StudentPolicy;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\QuizRepositoryInterface;
use App\Repositories\Interfaces\TakeQuizDetailRepositoryInterface;
use App\Repositories\Interfaces\TakeQuizRepositoryInterface;
use App\Repositories\Interfaces\TopicRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizStudentController extends Controller
{
    private $quiz, $course, $myCourse, $takeQuiz, $topic, $takeQuizDetail, $policy;

    public function __construct(
        QuizRepositoryInterface $quizRepository,
        CourseRepositoryInterface $courseRepository,
        TakeQuizRepositoryInterface $takeQuizRepository,
        TopicRepositoryInterface $topicRepository,
        TakeQuizDetailRepositoryInterface $takeQuizDetailRepository
    )
    {
        $this->quiz = $quizRepository;
        $this->course = $courseRepository;
        $this->takeQuiz = $takeQuizRepository;
        $this->topic = $topicRepository;
        $this->takeQuizDetail = $takeQuizDetailRepository;
        $this->myCourse = new MyCourse();
        $this->policy = new StudentPolicy();
    }

    public function index($course_id, $id){
        $data['quiz'] = $this->quiz->getById($id);
        $this->checkIssetQuiz($course_id, $data['quiz']);
        $this->policy->quiz($id);
        $data['course'] = $this->course->getFullById($course_id);
        $data['myStudentCourses'] = $this->myCourse->getCourseOfStudent();
        $data['takesQuiz'] = $this->takeQuiz->getTakeQuiz($id, auth()->guard('student')->id());
        $data['num_take_quiz_remaining'] = $data['quiz']->maximum - $this->takeQuiz->countTakeQuiz($id, auth()->guard('student')->id());
        return view('front.student.quiz', $data);
    }

    public function exam($id){
        $this->policy->exam($id);
        $data['take_quiz'] = $this->takeQuiz->getById($id);
        $now = \Carbon\Carbon::now();
        $end_time = \Carbon\Carbon::parse($data['take_quiz']->end_time);
        if($end_time < $now){
            return redirect()->route('student.exam.submit', ['id' => $id]);
        }
        $data['diff'] = $end_time->diffInSeconds($now);
        $data['exam'] = $this->takeQuiz->getById($id);
        $data['quiz'] = $this->quiz->getById($data['exam']->quiz_id);
        $data['topic'] = $this->topic->getById($data['quiz']->topic_id);
        $data['course'] = $this->course->getFullById($data['topic']->course_id);
        
        $data['id_questions'] = $this->takeQuiz->getIdQuestionOfTakeQuiz($id);
        $data['questions'] = $this->takeQuiz->getQuestionOfTakeQuiz($id, 5);
        return view('front.student.take_quiz', $data);
    }

    public function checkPassword($id, CheckPasswordQuizRequest $request){
        $quiz = $this->quiz->getById($id);
        if(empty($quiz)){
            return response()->json(['status' => 0]);
        }
        if($this->takeQuiz->countTakeQuiz($id, auth()->guard('student')->id()) >= $quiz->maximum){
            return response()->json(['status' => 0]);
        }
        if($quiz->password == $request->password){
            DB::beginTransaction();
            try{
                $collection = [
                    'quiz_id' => $id,
                    'student_id' => auth()->guard('student')->id(),
                    'start_time' => Carbon::now()->format('Y-m-d H:i:s'),
                    'end_time' => Carbon::now()->addMinutes($quiz->duration)->format('Y-m-d H:i:s'),
                    'total' => $this->quiz->countQuestion($id),
                ];
                $takeQuiz = $this->takeQuiz->create($collection);
                $questions = $this->quiz->createQuizForStudent($quiz->id);
                foreach($questions as $question){
                    $collectionDetail = [
                        'take_quiz_id' => $takeQuiz->id,
                        'question_id' => $question->id,
                        'correct' => $question->correct_answer,
                    ];
                    $this->takeQuizDetail->create($collectionDetail);
                }
                $data['url_next'] = route('student.exam.index', $takeQuiz->id);
                DB::commit();
                return response()->json(['data' => $data,'status' => 1]);
            }
            catch(\Exception $e){
                DB::rollBack();
                return response()->json(['status' => 0]);
            }
        }
        else{
            return response()->json(['status' => 1, 'message' => '<i class="bi bi-exclamation-circle"></i> Mật khẩu không chính xác']);
        }
        
    }

    public function chooseQuestion($id, Request $request){
        $take_quiz = $this->takeQuiz->getById($id);
        $now = \Carbon\Carbon::now();
        $end_time = \Carbon\Carbon::parse($take_quiz->end_time);
        if($end_time < $now){
            abort(404);
        }
        DB::beginTransaction();
        try{
            $this->takeQuizDetail->chooseAnswer($id, $request->question_id, $request->answer);
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }

    public function review($id){
        $this->policy->exam($id);
        $data['exam'] = $this->takeQuiz->getById($id);
        $now = \Carbon\Carbon::now();
        $end_time = \Carbon\Carbon::parse($data['exam']->end_time);
        if($end_time < $now){
            return redirect()->route('student.exam.submit', ['id' => $id]);
        }
        $data['diff'] = $end_time->diffInSeconds($now);
        $data['quiz'] = $this->quiz->getById($data['exam']->quiz_id);
        $data['topic'] = $this->topic->getById($data['quiz']->topic_id);
        $data['course'] = $this->course->getFullById($data['topic']->course_id);
        $data['questions'] = $this->takeQuiz->getIdQuestionOfTakeQuiz($id);
        return view('front.student.take_quiz_review', $data);
    }

    public function submit($id){
        DB::beginTransaction();
        try{
            $take_quiz = $this->takeQuiz->getById($id);
            $count = 0;
            $questions = $this->takeQuiz->getIdQuestionOfTakeQuiz($id);
            foreach($questions as $question){
                if($question->choose == $question->correct){
                    $count++;
                }
            }
            $mark = round((10 / $take_quiz->total) * $count, 2);
            $collection = [
                'score' => $mark,
                'number_correct' => $count,
            ];
            $this->takeQuiz->submitExam($id, $collection);
            DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();
        }
        return redirect()->route('student.exam.result', ['id' => $id]);
    }

    public function result($id){
        $this->policy->exam($id);
        $data['exam'] = $this->takeQuiz->getById($id);
        $data['quiz'] = $this->quiz->getById($data['exam']->quiz_id);
        $data['topic'] = $this->topic->getById($data['quiz']->topic_id);
        $data['course'] = $this->course->getFullById($data['topic']->course_id);
        $data['id_questions'] = $this->takeQuiz->getIdQuestionOfTakeQuiz($id);
        $data['questions'] = $this->takeQuiz->getQuestionOfTakeQuiz($id, 5);
        return view('front.student.quiz_result', $data);
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
