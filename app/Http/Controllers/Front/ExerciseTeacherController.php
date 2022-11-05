<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExerciseRequest;
use App\Http\Requests\UpdateExerciseRequest;
use App\Libraries\MyCourse;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\ExerciseDocumentRepositoryInterface;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ExerciseRepositoryInterface;
use App\Repositories\Interfaces\ExerciseScoreRepositoryInterface;
use App\Repositories\Interfaces\SubmitExerciseRepositoryInterface;
use App\Repositories\Interfaces\TopicRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ExerciseTeacherController extends Controller
{
    private $exercise, $course, $myCourse, $exerciseDocument, $topic, $submitExercise, $exerciseScore;

    public function __construct(
        ExerciseRepositoryInterface $exerciseRepository,
        CourseRepositoryInterface $courseRepository,
        ExerciseDocumentRepositoryInterface $exerciseDocumentRepository,
        TopicRepositoryInterface $topicRepository,
        SubmitExerciseRepositoryInterface $submitExerciseRepository,
        ExerciseScoreRepositoryInterface $exerciseScoreRepository
    )
    {
        $this->exercise = $exerciseRepository;
        $this->course = $courseRepository;
        $this->exerciseDocument = $exerciseDocumentRepository;
        $this->topic = $topicRepository;
        $this->submitExercise = $submitExerciseRepository;
        $this->exerciseScore = $exerciseScoreRepository;
        $this->myCourse = new MyCourse();
    }

    public function index($course_id, $id){
        $data['course'] = $this->course->getFullById($course_id);
        $data['exercise'] = $this->exercise->getById($id);
        $data['exerciseDocuments'] = $this->exerciseDocument->getAll($id);
        $data['myTeacherCourses'] = $this->myCourse->getCourseOfTeacher();
        $data['listStudent'] = $this->course->getStudentOfCourse($course_id);
        $data['submitExercises'] = [];
        $data['scores'] = [];
        foreach($data['listStudent'] as $student){
            $data['submitExercises'][$student->id] = $this->submitExercise->getOfStudentInExercise($id, $student->id);
            $data['scores'][$student->id] = $this->exercise->getScoreStudent($id, $student->id);
        }
        return view('front.teacher.exercise', $data);
    }

    public function store($topic_id, StoreExerciseRequest $request){
        DB::beginTransaction();
        try{
            $collection = [
                'topic_id' => $topic_id,
                'name' => $request->name,
                'content' => $request->content,
                'expiration_date' => $request->expiration_date,
            ];
            $course = $this->topic->getCourse($topic_id);
            $store = $this->exercise->create($collection);
            $url = route('teacher.exercise.index', ['course_id' => $course->id, 'id' => $store->id]);
            DB::commit();
            return response()->json(['data' => $url,'status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }

    public function upload($course_id, $id, Request $request){
        $course = $this->course->getFullById($course_id);
        $files = $request->file('link');
        $err = [];
        DB::beginTransaction();
        try{
            if($files){
                foreach($files as $file) {
                    $fileName = $file->getClientOriginalName();
                    $directory = 'frontend/upload/'.$course->code.'/exercise';
                    if(!(file_exists($directory) && is_dir($directory))){
                        mkdir($directory, 0775, true);
                    }
                    if(file_exists($directory.'/'.$fileName)){
                        array_push($err, __('message.file_exists', ['name' => $fileName]));
                        continue;
                    }
                    $file->move(public_path($directory), $fileName);
                    $collection = [
                        'exercise_id' => $id,
                        'name' => $fileName,
                        'link' => $fileName,
                    ];
                    $this->exerciseDocument->create($collection);
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

    public function deleteDocument($course_id, $id){
        DB::beginTransaction();
        try{
            $course = $this->course->getFullById($course_id);
            $document = $this->exerciseDocument->getById($id);
            $file = 'frontend/upload/'.$course->code.'/exercise'.'/'.$document->link;
            if(file_exists($file) && is_file($file)){
                unlink($file);
            }
            $this->exerciseDocument->delete($id);
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }

    public function hide($id){
        DB::beginTransaction();
        try{
            $this->exercise->hide($id);
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
            $this->exercise->show($id);
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }

    public function edit($id){
        $data = $this->exercise->getById($id);
        if(empty($data)){
            return response()->json(['status' => 0]);
        }
        return response()->json(['data' => $data, 'status' => 1]);
    }

    public function update($id, UpdateExerciseRequest $request){
        DB::beginTransaction();
        try{
            $collection = $request->except(['_token', '_method']);
            $this->exercise->update($collection, $id);
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }

    public function delete($course_id, $id){
        DB::beginTransaction();
        try{
            $course = $this->course->getFullById($course_id);
            $documents = $this->exerciseDocument->getAll($id);
            foreach($documents as $document){
                $file = 'frontend/upload/'.$course->code.'/exercise'.'/'.$document->link;
                if(file_exists($file) && is_file($file)){
                    unlink($file);
            }
            }
            $this->exercise->delete($id);
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }

    public function updateScore($exercise_id, $student_id, Request $request){
        if(!isset($request->score) || $request->score < 0 || $request->score > 10){
            return response()->json(['status' => 0]);
        }
        DB::beginTransaction();
        try{
            $collection = [
                'exercise_id' => $exercise_id,
                'student_id' => $student_id,
                'score' => $request->score,
            ];
            $count = $this->exerciseScore->getById($exercise_id, $student_id);
            if(empty($count)){  
                $this->exerciseScore->create($collection);
            }
            else{
                $this->exerciseScore->update($collection);
            }
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }
}
