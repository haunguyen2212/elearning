<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\CheckPasswordQuizRequest;
use App\Libraries\MyCourse;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\QuizRepositoryInterface;
use App\Repositories\Interfaces\TakeQuizRepositoryInterface;
use App\Repositories\Interfaces\TopicRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QuizStudentController extends Controller
{
    private $quiz, $course, $myCourse, $takeQuiz, $topic;

    public function __construct(
        QuizRepositoryInterface $quizRepository,
        CourseRepositoryInterface $courseRepository,
        TakeQuizRepositoryInterface $takeQuizRepository,
        TopicRepositoryInterface $topicRepository
    )
    {
        $this->quiz = $quizRepository;
        $this->course = $courseRepository;
        $this->takeQuiz = $takeQuizRepository;
        $this->topic = $topicRepository;
        $this->myCourse = new MyCourse();
    }

    public function index($course_id, $id){
        $data['course'] = $this->course->getFullById($course_id);
        $data['myStudentCourses'] = $this->myCourse->getCourseOfStudent();
        $data['quiz'] = $this->quiz->getById($id);
        $data['takesQuiz'] = $this->takeQuiz->getTakeQuiz($id, auth()->guard('student')->id());
        $data['num_take_quiz_remaining'] = $data['quiz']->maximum - $this->takeQuiz->countTakeQuiz($id, auth()->guard('student')->id());
        return view('front.student.quiz', $data);
    }

    public function exam($id){
        $data['exam'] = $this->takeQuiz->getById($id);
        $data['quiz'] = $this->quiz->getById($data['exam']->quiz_id);
        $data['topic'] = $this->topic->getById($data['quiz']->topic_id);
        $data['course'] = $this->course->getFullById($data['topic']->course_id);
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
            $collection = [
                'quiz_id' => $id,
                'student_id' => auth()->guard('student')->id(),
                'start_time' => Carbon::now()->format('Y-m-d H:i:s'),
                'end_time' => Carbon::now()->addMinutes($quiz->duration)->format('Y-m-d H:i:s'),
                'total' => $this->quiz->countQuestion($id),
            ];
            $takeQuiz = $this->takeQuiz->create($collection);
            $data['url_next'] = route('student.exam.index', $takeQuiz->id);
            return response()->json(['data' => $data,'status' => 1]);
        }
        else{
            return response()->json(['status' => 1, 'message' => '<i class="bi bi-exclamation-circle"></i> Mật khẩu không chính xác']);
        }
        
    }
}
