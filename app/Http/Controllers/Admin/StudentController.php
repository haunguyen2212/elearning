<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminChangePasswordRequest;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Repositories\Interfaces\ClassRepositoryInterface;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private $student, $class;

    public function __construct(
        StudentRepositoryInterface $studentRepository,
        ClassRepositoryInterface $classRepository
        )
    {
        $this->student = $studentRepository;
        $this->class = $classRepository;
    }

    public function index(Request $request)
    {
        if(isset($request->search)){
            $key = $request->search;
            $students = $this->student->getByKey($key, 20);
            $students->appends(['search' => $key]);
        }
        else{
            $students = $this->student->getAll(20);
        }
        return view('admin.student.index', compact('students'));
    }

    public function countNumberClass(){
        return $this->class->count();
    }

    public function create()
    {
        $offset = $this->countNumberClass();
        $classes = $this->class->getAll($offset);
        return view('admin.student.create', compact('classes'));
    }

    public function store(StoreStudentRequest $request)
    {
        $collection = $request->except(['_token']);
        $store = $this->student->create($collection);
        if($store){
            return back()->with('success', __('message.create_success', ['name' => 'tài khoản']));
        }
        else{
            return back()->with('error', __('message.create_error', ['name' => 'tài khoản']));
        }
    }

    public function show($id)
    {
        $info = $this->student->getById($id);
        if(empty($info)){
            abort(404);
        }
        return view('admin.student.show', compact('info'));
    }

    public function edit($id)
    {
        $offset = $this->countNumberClass();
        $classes = $this->class->getAll($offset);
        $info = $this->student->getById($id);
        if(empty($info)){
            abort(404);
        }
        return view('admin.student.edit', compact('classes', 'info'));
    }

    public function update(UpdateStudentRequest $request, $id)
    {
        $collection = $request->except(['_token', '_method']);
        $update = $this->student->update($id, $collection);
        if($update){
            return back()->with('success', __('message.update_success', ['name' => 'thông tin tài khoản']));
        }
        else{
            return back()->with('error', __('message.update_error', ['name' => 'thông tin tài khoản']));
        }
    }

    public function destroy($id)
    {
        $delete = $this->student->delete($id);
        if($delete){
            return back()->with('success', __('message.delete_success', ['name' => 'tài khoản']));
        }
        else{
            return back()->with('error', __('message.delete_error', ['name' => 'tài khoản']));
        }
    }

    public function editPassword($id){
        $student = $this->student->getNameById($id);
        if(empty($student)){
            abort(404);
        }
        $studentName = $student->name;
        return view('admin.student.changePassword', compact('studentName'));
    }

    public function updatePassword($id, AdminChangePasswordRequest $request){
        $collection = $request->except(['_token', '_method']);
        $update = $this->student->updatePasswordById($id, $collection);
        if($update){
            return back()->with('success', __('message.change_password_success'));
        }
        else{
            return back()->with('error', __('message.change_password_error'));
        }
    }

}
