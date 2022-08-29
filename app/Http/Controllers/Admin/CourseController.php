<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCourseRequest;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    private $course, $teacher;

    public function __construct(
        CourseRepositoryInterface $courseRepository,
        TeacherRepositoryInterface $teacherRepository
    )
    {
        $this->course = $courseRepository;
        $this->teacher = $teacherRepository;
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
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
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
