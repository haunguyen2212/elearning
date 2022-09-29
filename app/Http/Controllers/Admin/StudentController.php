<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminChangePasswordRequest;
use App\Http\Requests\StoreImportRequest;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Imports\StudentsImport;
use App\Libraries\SchoolYear;
use App\Repositories\Interfaces\ClassRepositoryInterface;
use App\Repositories\Interfaces\CourseInvolvementRepositoryInterface;
use App\Repositories\Interfaces\StudentRepositoryInterface;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    private $student, $class, $courseInvolvement, $schoolYear;

    public function __construct(
        StudentRepositoryInterface $studentRepository,
        ClassRepositoryInterface $classRepository,
        CourseInvolvementRepositoryInterface $courseInvolvementRepository
        )
    {
        $this->student = $studentRepository;
        $this->class = $classRepository;
        $this->courseInvolvement = $courseInvolvementRepository;
        $schoolYear = new SchoolYear();
        $this->schoolYear = $schoolYear->current();
    }

    public function index(Request $request)
    {
        if(isset($request->search)){
            $key = $request->search;
            $students = $this->student->getByKey($key);
            $students->appends(['search' => $key]);
        }
        else{
            $students = $this->student->getAll(20);
        }
        return view('admin.student.index', compact('students'));
    }

    public function checkIssetStudent($id){
        $student = $this->student->getById($id);
        if(empty($student)){
            abort(404);
        }
        return true;
    }

    public function create()
    {
        $classes = $this->class->getAllOfCurrent($this->schoolYear->id);
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
        $this->checkIssetStudent($id);
        $data['info'] = $this->student->getByIdOfCurrent($this->schoolYear->id, $id);
        $data['courses'] = $this->courseInvolvement->getCourseNameStudent($id);
        return view('admin.student.show', $data);
    }

    public function edit($id)
    {
        $this->checkIssetStudent($id);
        $classes = $this->class->getAllOfCurrent($this->schoolYear->id);
        $info = $this->student->getByIdOfCurrent($this->schoolYear->id, $id);
        return view('admin.student.edit', compact('classes', 'info'));
    }

    public function update(UpdateStudentRequest $request, $id)
    {
        $this->checkIssetStudent($id);
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
        $this->checkIssetStudent($id);
        $delete = $this->student->delete($id);
        if($delete){
            return back()->with('success', __('message.delete_success', ['name' => 'tài khoản']));
        }
        else{
            return back()->with('error', __('message.delete_error', ['name' => 'tài khoản']));
        }
    }

    public function editPassword($id){
        $this->checkIssetStudent($id);
        $student = $this->student->getById($id);
        return view('admin.student.changePassword', compact('student'));
    }

    public function updatePassword($id, AdminChangePasswordRequest $request){
        $this->checkIssetStudent($id);
        $collection = $request->except(['_token', '_method']);
        $update = $this->student->updatePasswordById($id, $collection);
        if($update){
            return back()->with('success', __('message.change_password_success'));
        }
        else{
            return back()->with('error', __('message.change_password_error'));
        }
    }

    public function changeStatus($id){
        $this->checkIssetStudent($id);
        $status = $this->student->getById($id)->active;
        if($status == 0){
            $this->student->unlock($id);
            return back()->with('success', __('message.unlock_success'));
        }
        else{
            $this->student->lock($id);
            return back()->with('success', __('message.lock_success'));
        }
    }

    public function createImport(){
        return view('admin.student.import');
    }

    public function storeImport(StoreImportRequest $request){
        $import = new StudentsImport();
        $import->import($request->file('file'));

        if($import->failures()->isNotEmpty()){
            return back()->withFailures($import->failures());
        }

        return back()->with('success' , __('message.import_success'));

}

}
