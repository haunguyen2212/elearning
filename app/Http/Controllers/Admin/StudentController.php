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
    private $studentRepository, $classRepository;

    public function __construct(
        StudentRepositoryInterface $studentRepository,
        ClassRepositoryInterface $classRepository
        )
    {
        $this->studentRepository = $studentRepository;
        $this->classRepository = $classRepository;
    }

    public function index(Request $request)
    {
        if(isset($request->search)){
            $key = $request->search;
            $students = $this->studentRepository->getByKey($key);
            $students->appends(['search' => $key]);
        }
        else{
            $students = $this->studentRepository->getAll();
        }
        return view('admin.student', compact('students'));
    }


    public function create()
    {
        $offset = $this->classRepository->count();
        $classes = $this->classRepository->getAll($offset);
        return view('admin.studentcreate', compact('classes'));
    }

    public function store(StoreStudentRequest $request)
    {
        $collection = $request->except(['_token']);
        $store = $this->studentRepository->create($collection);
        if($store){
            return redirect()->route('student.index')->with('success', 'Thêm tài khoản thành công');
        }
        else{
            return redirect()->route('student.index')->with('error', 'Thêm tài khoản thất bại');
        }
    }

    public function show($id)
    {
        $info = $this->studentRepository->getById($id);
        return view('admin.studentshow', compact('info'));
    }

    public function edit($id)
    {
        $offset = $this->classRepository->count();
        $classes = $this->classRepository->getAll($offset);
        $info = $this->studentRepository->getById($id);
        return view('admin.studentedit', compact('classes', 'info'));
    }

    public function update(UpdateStudentRequest $request, $id)
    {
        $collection = $request->except(['_token', '_method']);
        $update = $this->studentRepository->update($id, $collection);
        if($update){
            return redirect()->route('student.index')->with('success', 'Cập nhật thông tin thành công');
        }
        else{
            return redirect()->route('student.index')->with('error', 'Cập nhật thông tin thất bại');
        }
    }

    public function destroy($id)
    {
        $delete = $this->studentRepository->delete($id);
        if($delete){
            return back()->with('success', 'Xóa tài khoản thành công');
        }
        else{
            return back()->with('error', 'Xóa tài khoản thất bại');
        }
    }

    public function editPassword($id){
        $studentName = $this->studentRepository->getNameById($id)->name;
        return view('admin.studentpassword', compact('studentName'));
    }

    public function updatePassword($id, AdminChangePasswordRequest $request){
        $collection = $request->except(['_token', '_method']);
        $update = $this->studentRepository->updatePasswordById($id, $collection);
        if($update){
            return redirect()->route('student.index')->with('success', 'Đổi mật khẩu thành công');
        }
        else{
            return redirect()->route('student.index')->with('error', 'Đổi mật khẩu thất bại');
        }
    }

}
