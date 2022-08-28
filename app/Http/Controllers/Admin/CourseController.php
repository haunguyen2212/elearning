<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use Illuminate\Http\Request;

class CourseController extends Controller
{

    private $course;

    public function __construct(
        CourseRepositoryInterface $courseRepository
    )
    {
        $this->course = $courseRepository;
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
        //
    }

    public function store(Request $request)
    {
        //
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
