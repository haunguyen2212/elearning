<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuizRequest;
use App\Repositories\Interfaces\TopicRepositoryInterface;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\QuizRepositoryInterface;
use Illuminate\Support\Facades\DB;

class QuizTeacherController extends Controller
{
    private $quiz, $topic;

    public function __construct(
        QuizRepositoryInterface $quizRepository,
        TopicRepositoryInterface $topicRepository
    )
    {
        $this->quiz = $quizRepository;
        $this->topic = $topicRepository;
    }

    public function index(){
        return view('front.teacher.quiz');
    }

    public function store($topic_id, StoreQuizRequest $request){
        DB::beginTransaction();
        try{
            $course = $this->topic->getCourse($topic_id);
            $collection = [
                'topic_id' => $topic_id,
                'subject_id' => $course->subject_id,
                'name' => $request->name,
                'duration' => $request->duration,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
                'password' => $request->password,
                'is_show' => $request->is_show ?? 0,
            ];
            $store = $this->quiz->create($collection);
            $url = route('teacher.quiz.index', ['course_id' => $course->id, 'id' => $store->id]);
            DB::commit();
            return response()->json(['data' => $url,'status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }
}
