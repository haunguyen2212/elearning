<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminChangePasswordRequest;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use Illuminate\Http\Request;

class TeacherController extends Controller
{

    private $teacher, $department;

    public function __construct(
        TeacherRepositoryInterface $teacherRepository,
        DepartmentRepositoryInterface $departmentRepository
        )
    {
        $this->teacher = $teacherRepository;
        $this->department = $departmentRepository;
    }
    
    public function index(Request $request)
    {
        if(isset($request->search)){
            $key = $request->search;
            $teachers = $this->teacher->getByKey($key);
            $teachers->appends(['search' => $key]);
        }
        else{
            $teachers = $this->teacher->getAll(20);
        }
        return view('admin.teacher.index', compact('teachers'));
    }

    public function checkIssetTeacher($id){
        $teacher = $this->teacher->getById($id);
        if(empty($teacher)){
            abort(404);
        }
        return true;
    }

    public function create()
    {
        $departments = $this->department->getAll();
        return view('admin.teacher.create', compact('departments'));
    }

    public function store(StoreTeacherRequest $request)
    {
        $collection = $request->except(['_token']);
        $create = $this->teacher->create($collection);
        if($create){
            return back()->with('success', __('message.create_success', ['name' => 'tài khoản'] ));
        }
        else{
            return back()->with('error', __('message.create_error', ['name' => 'tài khoản']));
        }
    }

    public function show($id)
    {
        $this->checkIssetTeacher($id);
        $info = $this->teacher->getById($id);
        return view('admin.teacher.show', compact('info'));
    }

    public function edit($id)
    {
        $this->checkIssetTeacher($id);
        $departments = $this->department->getAll();
        $info = $this->teacher->getById($id);
        return view('admin.teacher.edit', compact('departments', 'info'));
    }

    public function update(UpdateTeacherRequest $request, $id)
    {
        $this->checkIssetTeacher($id);
        $collection = $request->except(['_token', '_method']);
        $update = $this->teacher->update($id, $collection);
        if($update){
            return back()->with('success', __('message.update_success', ['name' => 'thông tin tài khoản']));
        }
        else{
            return back()->with('error', __('message.update_error', ['name' => 'thông tin tài khoản']));
        }
    }

    public function destroy($id)
    {
        $this->checkIssetTeacher($id);
        $delete = $this->teacher->delete($id);
        if($delete){
            return redirect()->route('teacher.index')->with('success', __('message.delete_success', ['name' => 'tài khoản']));
        }
        else{
            return redirect()->route('teacher.index')->with('error', __('message.delete_error', ['name' => 'tài khoản']));
        }
    }

    public function editPassword($id){
        $this->checkIssetTeacher($id);
        $teacher = $this->teacher->getById($id);
        return view('admin.teacher.changePassword', compact('teacher'));
    }

    public function updatePassword($id, AdminChangePasswordRequest $request){
        $this->checkIssetTeacher($id);
        $collection = $request->except(['_token', '_method']);
        $update = $this->teacher->updatePasswordById($id, $collection);
        if($update){
            return back()->with('success', __('message.change_password_success'));
        }
        else{
            return back()->with('error', __('message.change_password_error'));
        }
    }

    public function changeStatus($id){
        $this->checkIssetTeacher($id);
        $status = $this->teacher->getById($id)->active;
        if($status == 0){
            $this->teacher->unlock($id);
            return back()->with('success', __('message.unlock_success'));
        }
        else{
            $this->teacher->lock($id);
            return back()->with('success', __('message.lock_success'));
        }
    }
}
