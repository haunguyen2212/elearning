<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Http\Requests\UpdateCourseRequest;
use App\Repositories\Interfaces\CourseInvolvementRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    private $course, $teacher, $courseInvolvement;

    public function __construct(
        CourseRepositoryInterface $courseRepository,
        TeacherRepositoryInterface $teacherRepository,
        CourseInvolvementRepositoryInterface $courseInvolvementRepository
    )
    {
        $this->course = $courseRepository;
        $this->teacher = $teacherRepository;
        $this->courseInvolvement = $courseInvolvementRepository;
    }
    
    public function index(Request $request)
    {
        if(isset($request->search)){
            $key = $request->search;
            $data['courses'] = $this->course->getByKey($key);
            $data['courses']->appends(['search' => $key]);
        }
        else{
            $data['courses'] = $this->course->getFullInfo();
        }
        return view('admin.course.index', $data);
    }

    public function create()
    {
        $data['teachers'] = $this->teacher->getAccountActive();
        return view('admin.course.create', $data);
    }

    public function store(StoreCourseRequest $request)
    {
        $collection = $request->except(['_token']);
        $store = $this->course->create($collection);
        if($store){
            return back()->with('success', __('message.create_success', ['name' => 'khóa học']));
        }
        else{
            return back()->with('error', __('message.error'));
        }
    }

    public function show($id)
    {
        $data['course'] = $this->course->getFullById($id);
        $data['num_enrol'] = $this->courseInvolvement->countStudentEnrol($id);
        if(empty($data['course'])){
            abort(404);
        }
        return view('admin.course.show', $data);
    }

    public function edit($id)
    {
        $data['teachers'] = $this->teacher->getAccountActive();
        $data['course'] = $this->course->getFullById($id);
        if(empty($data['course'])){
            abort(404);
        }
        return view('admin.course.edit', $data);
    }

    public function update(UpdateCourseRequest $request, $id)
    {
        $collection = $request->except(['_token', '_method']);
        $update = $this->course->update($id, $collection);
        if($update){
            return back()->with('success', __('message.update_success', ['name' => 'khóa học']));
        }
        else{
            return back()->with('error', __('message.error'));
        }
    }


    public function destroy($id)
    {
        $delete = $this->course->delete($id);
        if($delete){
            return back()->with('success', __('message.delete_success', ['name' => 'khóa học']));
        }
        else{
            return back()->with('error', __('message.error'));
        }
    }

    public function lock($id){
        $update = $this->course->hide($id);
        if($update){
            return back()->with('success', __('message.course_lock'));
        }
        else{
            return back()->with('error', __('message.error'));
        }
    }

    public function unlock($id){
        $update = $this->course->show($id);
        if($update){
            return back()->with('success', __('message.course_unlock'));
        }
        else{
            return back()->with('error', __('message.error'));
        }
    }
}
