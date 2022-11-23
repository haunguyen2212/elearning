<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Libraries\MyCourse;
use App\Libraries\SchoolYear;
use App\Repositories\Interfaces\CourseInvolvementRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\NotificationDetailRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    private $course, $courseInvolvement ,$myCourse, $schoolYear, $notificationDetail;

    public function __construct(
        CourseRepositoryInterface $courseRepository,
        CourseInvolvementRepositoryInterface $courseInvolvementRepository,
        NotificationDetailRepositoryInterface $notificationDetailRepository
    )
    {
        $this->course = $courseRepository;
        $this->courseInvolvement = $courseInvolvementRepository;
        $this->notificationDetail = $notificationDetailRepository;
        $this->myCourse = new MyCourse();
        $schoolYear = new SchoolYear();
        $this->schoolYear = $schoolYear->current();
    }

    public function index(Request $request){
        if(Auth::guard('student')->check()){
            $data['myStudentCourses'] = $this->myCourse->getCourseOfStudent();
        }
        else{
            $data['myTeacherCourses'] = $this->myCourse->getCourseOfTeacher();
        }
        if(isset($request->search)){
            $data['courses'] = $this->course->searchByKeyOfCurrent($request->search, $this->schoolYear->id, 15);
            $data['courses']->appends(['search' => $request->search]);
        }
        else{
            $data['courses'] = $this->course->getAllActiveOfCurrent($this->schoolYear->id ,15);
        }
        return view('home', $data);
    }

    public function detail($id){
        if(Auth::guard('student')->check()){
            $data['myStudentCourses'] = $this->myCourse->getCourseOfStudent();
        }
        else{
            $data['myTeacherCourses'] = $this->myCourse->getCourseOfTeacher();
        }
        $data['course'] = $this->getCourseById($id);
        return view('front.student.course_enrol', $data);
    }

    public function enrol($id){
        $course = $this->getCourseById($id);
        if($course->is_enrol == 0){
            return back()->with('error', __('message.enrol_expired'));
        }

        if($this->courseInvolvement->checkEnrol(Auth::guard('student')->id(), $id)){
            return back()->with('error', __('message.enrolled'));
        }

        $collection['course_id'] = $id;
        $collection['student_id'] = Auth::guard('student')->id();
        $enrol = $this->courseInvolvement->create($collection);

        if($enrol){
            return redirect()->route('course.view.student', $id);
        }
        else{
            return back()->with('error', __('message.error'));
        }
    }

    public function watchNotification(){
        DB::beginTransaction();
        try{
            $this->notificationDetail->watch(auth()->guard('student')->id());
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }

    public function viewNotification(){
        DB::beginTransaction();
        try{
            $this->notificationDetail->watch(auth()->guard('student')->id());
            DB::commit();
        }
        catch(\Exception $e){
            DB::rollBack();
        }
        $data['myStudentCourses'] = $this->myCourse->getCourseOfStudent();
        $data['notifies'] = $this->notificationDetail->getAll(auth()->guard('student')->id());
        return view('front.student.notification', $data);
    }

    public function getCourseById($id){
        $course = $this->course->getFullById($id);
        if(empty($course)){
            abort(404);
        }
        return $course;
    }
}
