<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePasswordStudentRequest;
use App\Http\Requests\UpdatePasswordTeacherRequest;
use App\Http\Requests\UpdateProfileStudentRequest;
use App\Http\Requests\UpdateProfileTeacherRequest;
use App\Libraries\MyCourse;
use App\Libraries\SchoolYear;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    private $myCourse, $teacher, $student, $schoolYear;

    public function __construct(
        StudentRepositoryInterface $studentRepository,
        TeacherRepositoryInterface $teacherRepository
    )
    {
        $this->teacher = $teacherRepository;
        $this->student = $studentRepository;
        $this->myCourse = new MyCourse();
        $schoolYear = new SchoolYear();
        $this->schoolYear = $schoolYear->current();
    }

    public function index(){
        if(auth()->guard('student')->check()){
            $data['myStudentCourses'] = $this->myCourse->getCourseOfStudent();
            $data['profile'] = $this->student->getByIdOfCurrent($this->schoolYear->id, auth()->guard('student')->id());
        }
        else{
            $data['myTeacherCourses'] = $this->myCourse->getCourseOfTeacher();
            $data['profile'] = $this->teacher->getById(auth()->guard('teacher')->id());
        }
        return view('front.profile', $data);
    }

    public function editProfileStudent(){
        $data = $this->student->getById(auth()->guard('student')->id());
        if(empty($data)){
            return response()->json(['status' => 0]);
        }
        return response()->json(['data' => $data, 'status' => 1]);
    }

    public function updateProfileStudent(UpdateProfileStudentRequest $request){
        $collection = $request->except(['_token', '_method']);
        DB::beginTransaction();
        try{
            $this->student->updateProfile(auth()->guard('student')->id(), $collection);
            DB::commit();
            session()->flash('message', __('message.update_success', ['name' => 'thông tin']));
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            session()->flash('message', __('message.update_error', ['name' => 'thông tin']));
            return response()->json(['status' => 0]);
        }
    }

    public function editProfileTeacher(){
        $data = $this->teacher->getById(auth()->guard('teacher')->id());
        if(empty($data)){
            return response()->json(['status' => 0]);
        }
        return response()->json(['data' => $data, 'status' => 1]);
    }

    public function updateProfileTeacher(UpdateProfileTeacherRequest $request){
        $collection = $request->except(['_token', '_method']);
        DB::beginTransaction();
        try{
            $this->teacher->updateProfile(auth()->guard('teacher')->id(), $collection);
            DB::commit();
            session()->flash('message', __('message.update_success', ['name' => 'thông tin']));
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            session()->flash('message', __('message.update_error', ['name' => 'thông tin']));
            return response()->json(['status' => 0]);
        }
    }

    public function changePasswordStudent(UpdatePasswordStudentRequest $request){
        DB::beginTransaction();
        try{
            $collection['password'] = $request->new_password;
            $this->student->updatePasswordById(auth()->guard('student')->id(), $collection);
            DB::commit();
            session()->flash('message', __('message.update_success', ['name' => 'mật khẩu']));
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            session()->flash('message', __('message.update_error', ['name' => 'mật khẩu']));
            return response()->json(['status' => 0]);
        }
    }

    public function changePasswordTeacher(UpdatePasswordTeacherRequest $request){
        DB::beginTransaction();
        try{
            $collection['password'] = $request->new_password;
            $this->teacher->updatePasswordById(auth()->guard('teacher')->id(), $collection);
            DB::commit();
            session()->flash('message', __('message.update_success', ['name' => 'mật khẩu']));
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            session()->flash('message', __('message.update_error', ['name' => 'mật khẩu']));
            return response()->json(['status' => 0]);
        }
    }
}
