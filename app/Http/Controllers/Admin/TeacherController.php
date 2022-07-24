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

    private $teacherRepository, $departmentRepository;

    public function __construct(
        TeacherRepositoryInterface $teacherRepository,
        DepartmentRepositoryInterface $departmentRepository
        )
    {
        $this->teacherRepository = $teacherRepository;
        $this->departmentRepository = $departmentRepository;
    }
    
    public function index(Request $request)
    {
        if(isset($request->search)){
            $key = $request->search;
            $teachers = $this->teacherRepository->getByKey($key);
            $teachers->appends(['search' => $key]);
        }
        else{
            $teachers = $this->teacherRepository->getAll();
        }
        return view('admin.teacher.index', compact('teachers'));
    }

    public function create()
    {
        $offset = $this->departmentRepository->count();
        $departments = $this->departmentRepository->getAll($offset);
        return view('admin.teacher.create', compact('departments'));
    }

    public function store(StoreTeacherRequest $request)
    {
        $collection = $request->except(['_token']);
        $create = $this->teacherRepository->create($collection);
        if($create){
            return back()->with('success', 'Thêm tài khoản thành công');
        }
        else{
            return back()->with('error', 'Thêm tài khoản thất bại');
        }
    }

    public function show($id)
    {
        $info = $this->teacherRepository->getById($id);
        return view('admin.teacher.show', compact('info'));
    }

    public function edit($id)
    {
        $collection = $this->departmentRepository->count();
        $departments = $this->departmentRepository->getAll($collection);
        $info = $this->teacherRepository->getById($id);
        return view('admin.teacher.edit', compact('departments', 'info'));
    }

    public function update(UpdateTeacherRequest $request, $id)
    {
        $collection = $request->except(['_token', '_method']);
        $update = $this->teacherRepository->update($id, $collection);
        if($update){
            return back()->with('success', 'Cập nhật thông tin thành công');
        }
        else{
            return back()->with('error', 'Cập nhật thông tin thất bại');
        }
    }

    public function destroy($id)
    {
        $delete = $this->teacherRepository->delete($id);
        if($delete){
            return redirect()->route('teacher.index')->with('success', 'Xóa tài khoản thành công');
        }
        else{
            return redirect()->route('teacher.index')->with('error', 'Xóa tài khoản thất bại');
        }
    }

    public function editPassword($id){
        $teacherName = $this->teacherRepository->getNameById($id)->name;
        return view('admin.teacher.changePassword', compact('teacherName'));
    }

    public function updatePassword($id, AdminChangePasswordRequest $request){
        $collection = $request->except(['_token', '_method']);
        $update = $this->teacherRepository->updatePasswordById($id, $collection);
        if($update){
            return back()->with('success', 'Đổi mật khẩu thành công');
        }
        else{
            return back()->with('error', 'Đổi mật khẩu thất bại');
        }
    }
}
