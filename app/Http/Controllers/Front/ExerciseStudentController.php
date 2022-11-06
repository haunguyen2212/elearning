<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Libraries\MyCourse;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\ExerciseDocumentRepositoryInterface;
use App\Repositories\Interfaces\ExerciseRepositoryInterface;
use App\Repositories\Interfaces\ExerciseScoreRepositoryInterface;
use App\Repositories\Interfaces\SubmitExerciseRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExerciseStudentController extends Controller
{
    private $course, $myCourse, $exercise, $submitExercise, $exerciseDocument, $exerciseScore;

    public function __construct(
        CourseRepositoryInterface $courseRepository,
        ExerciseRepositoryInterface $exerciseRepository,
        SubmitExerciseRepositoryInterface $submitExerciseRepository,
        ExerciseDocumentRepositoryInterface $exerciseDocumentRepository,
        ExerciseScoreRepositoryInterface $exerciseScoreRepository
    )
    {
        $this->course = $courseRepository;
        $this->exercise = $exerciseRepository;
        $this->submitExercise = $submitExerciseRepository;
        $this->exerciseDocument = $exerciseDocumentRepository;
        $this->exerciseScore = $exerciseScoreRepository;
        $this->myCourse = new MyCourse();
    }

    public function index($course_id, $id){
        $data['course'] = $this->course->getFullById($course_id);
        $data['myStudentCourses'] = $this->myCourse->getCourseOfStudent();
        $data['exercise'] = $this->exercise->getById($id);
        $data['exerciseDocuments'] = $this->exerciseDocument->getActive($id);
        $data['submitFiles'] = $this->submitExercise->getAll($id, auth()->guard('student')->id());
        $data['score'] = $this->exerciseScore->getScore($id, auth()->guard('student')->id());
        return view('front.student.exercise', $data);
    }

    public function upload($course_id, $id, Request $request){
        $student = auth()->guard('student')->user();
        $course = $this->course->getFullById($course_id);
        $files = $request->file('link');
        $err = [];
        DB::beginTransaction();
        try{
            if($files){
                foreach($files as $file) {
                    $fileName = $file->getClientOriginalName();
                    $fileName = $file->getClientOriginalName();
                    if($file->getSize() > 2000000){
                        array_push($err, __('message.upload_file_too_big', ['name' => $fileName]));
                        continue;
                    }
                    $directory = 'frontend/upload/'.$course->code.'/'.$student->username;
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
                        'student_id' => $student->id,
                        'link' => $fileName,
                    ];
                    $this->submitExercise->create($collection);
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

    public function delete($course_id, $id){
        DB::beginTransaction();
        try{
            $document = $this->submitExercise->getById($id);
            $course = $this->course->getFullById($course_id);
            $file = 'frontend/upload/'.$course->code.'/'.auth()->guard('student')->user()->username.'/'.$document->link;
            if(file_exists($file) && is_file($file)){
                unlink($file);
            }
            $this->submitExercise->delete($id);
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }
}
