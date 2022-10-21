<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExerciseRequest;
use App\Libraries\MyCourse;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\ExerciseDocumentRepositoryInterface;
use Illuminate\Http\Request;
use App\Repositories\Interfaces\ExerciseRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ExerciseTeacherController extends Controller
{
    private $exercise, $course, $myCourse, $exerciseDocument;

    public function __construct(
        ExerciseRepositoryInterface $exerciseRepository,
        CourseRepositoryInterface $courseRepository,
        ExerciseDocumentRepositoryInterface $exerciseDocumentRepository
    )
    {
        $this->exercise = $exerciseRepository;
        $this->course = $courseRepository;
        $this->exerciseDocument = $exerciseDocumentRepository;
        $this->myCourse = new MyCourse();
    }

    public function index($course_id, $id){
        $data['course'] = $this->course->getFullById($course_id);
        $data['exercise'] = $this->exercise->getById($id);
        $data['exerciseDocuments'] = $this->exerciseDocument->getAll($id);
        $data['myTeacherCourses'] = $this->myCourse->getCourseOfTeacher();
        $data['listStudent'] = $this->course->getStudentOfCourse($course_id);
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
            $this->exercise->create($collection);
            DB::commit();
            return response()->json(['status' => 1]);
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
}
