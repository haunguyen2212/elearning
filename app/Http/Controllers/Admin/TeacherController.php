<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Interfaces\TeacherRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\AdminChangePasswordRequest;
use App\Http\Requests\StoreTeacherRequest;
use App\Http\Requests\UpdateTeacherRequest;
use App\Repositories\Interfaces\DepartmentRepositoryInterface;
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
            $teachers = $this->teacher->getAll();
        }
        return view('admin.teacher.index', compact('teachers'));
    }

    public function countNumberDepartment(){
        return $this->department->count();
    }

    public function create()
    {
        $offset = $this->countNumberDepartment();
        $departments = $this->department->getAll($offset);
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
        $info = $this->teacher->getById($id);
        if(empty($info)){
            abort(404);
        }
        return view('admin.teacher.show', compact('info'));
    }

    public function edit($id)
    {
        $collection = $this->countNumberDepartment();
        $departments = $this->department->getAll($collection);
        $info = $this->teacher->getById($id);
        if(empty($info)){
            abort(404);
        }
        return view('admin.teacher.edit', compact('departments', 'info'));
    }

    public function update(UpdateTeacherRequest $request, $id)
    {
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
        $delete = $this->teacher->delete($id);
        if($delete){
            return redirect()->route('teacher.index')->with('success', __('message.delete_success', ['name' => 'tài khoản']));
        }
        else{
            return redirect()->route('teacher.index')->with('error', __('message.delete_error', ['name' => 'tài khoản']));
        }
    }

    public function editPassword($id){
        $teacher = $this->teacher->getNameById($id);
        if(empty($teacher)){
            abort(404);
        }
        $teacherName = $teacher->name;
        return view('admin.teacher.changePassword', compact('teacherName'));
    }

    public function updatePassword($id, AdminChangePasswordRequest $request){
        $collection = $request->except(['_token', '_method']);
        $update = $this->teacher->updatePasswordById($id, $collection);
        if($update){
            return back()->with('success', __('message.change_password_success'));
        }
        else{
            return back()->with('error', __('message.change_password_error'));
        }
    }
}
