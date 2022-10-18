<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Libraries\MyCourse;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\ExerciseRepositoryInterface;
use App\Repositories\Interfaces\SubmitExerciseRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExerciseStudentController extends Controller
{
    private $course, $myCourse, $exercise, $submitExercise;

    public function __construct(
        CourseRepositoryInterface $courseRepository,
        ExerciseRepositoryInterface $exerciseRepository,
        SubmitExerciseRepositoryInterface $submitExerciseRepository
    )
    {
        $this->course = $courseRepository;
        $this->exercise = $exerciseRepository;
        $this->submitExercise = $submitExerciseRepository;
        $this->myCourse = new MyCourse();
    }

    public function index($course_id, $id){
        $data['course'] = $this->course->getFullById($course_id);
        $data['myStudentCourses'] = $this->myCourse->getCourseOfStudent();
        $data['exercise'] = $this->exercise->getById($id);
        $data['submitFiles'] = $this->submitExercise->getAll($id, auth()->guard('student')->id());
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
}
