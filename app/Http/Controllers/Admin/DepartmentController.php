<?php

namespace App\Http\Controllers\Admin;

use App\Repositories\Interfaces\DepartmentRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDepartmentRequest;
use App\Http\Requests\UpdateDepartmentRequest;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    
    private $department;

    public function __construct(DepartmentRepositoryInterface $departmentRepository)
    {
        $this->department = $departmentRepository;
    }

    public function index(Request $request)
    {
        if(isset($request->search)){
            $key = $request->search;
            $departments = $this->department->getByKey($key);
            $departments->appends(['search' => $key]);
        }
        else{
            $departments = $this->department->getFullInfo();
        }  
        return view('admin.department.index', compact('departments'));
    }

    public function checkIssetDepartment($id){
        $department = $this->department->getById($id);
        if(empty($department)){
            abort(404);
        }
        return true;
    }

    public function create()
    {
        return view('admin.department.create');
    }

    public function store(StoreDepartmentRequest $request)
    {
        $collection = $request->except(['_token']);
        $store = $this->department->create($collection);
        if($store){
            return back()->with('success', __('message.create_success', ['name' => 'đơn vị']));
        }
        else{
            return back()->with('error', __('message.create_error', ['name' => 'đơn vị']));
        }
    }

    public function show($id)
    {
        $this->checkIssetDepartment($id);
        $info = $this->department->getById($id);
        $countTotal = $this->department->countTotalTeacher($id);
        $total = $countTotal ? $countTotal->total : 0;
        $teachers = $this->department->getTeachersById($id);
        return view('admin.department.show', compact('info', 'total', 'teachers'));
    }

    public function edit($id)
    {
        $this->checkIssetDepartment($id);
        $info = $this->department->getById($id);
        return view('admin.department.edit', compact('info'));
    }


    public function update(UpdateDepartmentRequest $request, $id)
    {
        $this->checkIssetDepartment($id);
        $collection = $request->except(['_token', '_method']);
        $update = $this->department->update($id, $collection);
        if($update){
            return back()->with('success', __('message.update_success', ['name' => 'đơn vị']));
        }
        else{
            return back()->with('error', __('message.update_error', ['name' => 'đơn vị']));
        }
    }

    public function destroy($id)
    {
        $this->checkIssetDepartment($id);
        $delete = $this->department->delete($id);
        if($delete){
            return back()->with('success', __('message.delete_success', ['name' => 'đơn vị']));
        }
        else{
            return back()->with('error', __('message.delete_error', ['name' => 'đơn vị']));
        }
    }
}
