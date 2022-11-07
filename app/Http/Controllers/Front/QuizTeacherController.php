<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuizRequest;
use App\Http\Requests\UpdateQuizRequest;
use App\Libraries\MyCourse;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\TopicRepositoryInterface;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\QuizRepositoryInterface;
use Illuminate\Support\Facades\DB;

class QuizTeacherController extends Controller
{
    private $quiz, $topic, $course, $myCourse;

    public function __construct(
        QuizRepositoryInterface $quizRepository,
        TopicRepositoryInterface $topicRepository,
        CourseRepositoryInterface $courseRepository
    )
    {
        $this->quiz = $quizRepository;
        $this->topic = $topicRepository;
        $this->course = $courseRepository;
        $this->myCourse = new MyCourse();
    }

    public function index($course_id, $id){
        $data['course'] = $this->course->getFullById($course_id);
        $data['quiz'] = $this->quiz->getById($id);
        $data['questions'] = $this->quiz->getAllQuestion($id);
        return view('front.teacher.quiz', $data);
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
                'maximum' => $request->maximum ?? 1,
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

    public function hide($id){
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
        $data = $this->quiz->getById($id);
        if(empty($data)){
            return response()->json(['status' => 0]);
        }
        return response()->json(['data' => $data, 'status' => 1]);
    }

    public function update($id, UpdateQuizRequest $request){
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
}
