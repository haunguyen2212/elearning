<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ChangeHomeroomTeacherRequest;
use App\Http\Requests\StoreClassRequest;
use App\Http\Requests\UpdateClassRequest;
use App\Libraries\SchoolYear;
use App\Repositories\Interfaces\ClassRepositoryInterface;
use App\Repositories\Interfaces\HomeroomTeacherRepositoryInterface;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClassController extends Controller
{

    private $class, $teacher, $homeroomTeacher, $schoolYear;

    public function __construct(
        ClassRepositoryInterface $classRepository,
        TeacherRepositoryInterface $teacherRepository,
        HomeroomTeacherRepositoryInterface $homeroomTeacherRepository
        )
    {
        $this->class = $classRepository;
        $this->teacher = $teacherRepository;
        $this->homeroomTeacher = $homeroomTeacherRepository;
        $schoolYear = new SchoolYear();
        $this->schoolYear = $schoolYear->current();
    }

    public function index(Request $request)
    {
        if(isset($request->search)){
            $key = $request->search;
            $classes = $this->class->getByKeyOfCurrent($this->schoolYear->id, $key);
            $classes->appends(['search' => $key]);
        }
        else{
            $classes = $this->class->getFullInfoOfCurrent($this->schoolYear->id);
        } 
        
        return view('admin.class.index', compact('classes'));
    }

    public function checkIssetClass($id){
        $class = $this->class->getById($id);
        if(empty($class)){
            abort(404);
        }
        return true;
    }

    public function getIdHomeroomTeachers(){
        $teachersActive = $this->homeroomTeacher->getAllTeacherActiveOfCurrent($this->schoolYear->id);
        foreach($teachersActive as $key => $teacher){
            $arr[$key] = $teacher->id;
        }
        return $arr;
    }

    public function create()
    {
        $arr = $this->getIdHomeroomTeachers();
        $teachers = $this->teacher->getAccountActive()->whereNotIn('id', $arr);
        return view('admin.class.create', compact('teachers'));
    }

    public function store(StoreClassRequest $request)
    {
        $collectionClass = $request->except(['_token']);
        $collectionClass['school_year_id'] = $this->schoolYear->id;
        $storeClass = $this->class->create($collectionClass);
        $collectionHomeroomTeacher['class_id'] = $storeClass->id;
        $collectionHomeroomTeacher['teacher_id'] = $request->homeroom_teacher; 
        $storeHomeroomTeacher = $this->homeroomTeacher->create($collectionHomeroomTeacher);
        if($storeClass && $storeHomeroomTeacher){
            return back()->with('success', __('message.create_success', ['name' => 'lớp học']));
        }
        else{
            return back()->with('error', __('message.create_error', ['name' => 'lớp học']));
        }
    }

    public function show($id)
    {
        $this->checkIssetClass($id);
        $info = $this->class->getById($id);
        $homeroomTeacherActive = $this->class->getHomeroomTeacherActive($id)->name;
        $countTotal = $this->class->countTotalStudent($id);
        $total = $countTotal ? $countTotal->total : 0;
        $students = $this->class->getStudentsById($id);
        return view('admin.class.show', compact('info', 'homeroomTeacherActive', 'total' ,'students'));
    }

    public function edit($id)
    {
        $this->checkIssetClass($id);
        $info['name'] = $this->class->getById($id)->name;
        $teacher = $this->homeroomTeacher->getTeacherActive($id);
        $info['teacher_id'] = $teacher ? $teacher->teacher_id : '';

        $arr = $this->getIdHomeroomTeachers();
        $search = array_search($info['teacher_id'], $arr);
        if($search !== false){
            unset($arr[$search]);
        }
        $teachers = $this->teacher->getAccountActive()->whereNotIn('id', $arr);
        return view('admin.class.edit', compact('info', 'teachers'));
    }

    public function update(UpdateClassRequest $request, $id)
    {
        $this->checkIssetClass($id);
        $collectionClass = $request->except(['_token', '_method']);
        $updateClass = $this->class->update($id, $collectionClass);

        $collectionHomeroomTeacher['class_id'] = $id;
        $collectionHomeroomTeacher['teacher_id'] = $request->homeroom_teacher;

        $homeroom_teacher = $this->homeroomTeacher->getTeacherActive($id);
        $homeroom_teacher_id = $homeroom_teacher ? $homeroom_teacher->id : NULL;
        if($homeroom_teacher_id != NULL){
            $updateHomeroomTeacher = $this->homeroomTeacher->update($homeroom_teacher_id ,$collectionHomeroomTeacher);
        }
        else{
            $updateHomeroomTeacher = $this->homeroomTeacher->create($collectionHomeroomTeacher);
        }
        
        if($updateClass && $updateHomeroomTeacher){
            return back()->with('success', __('message.update_success', ['name' => 'lớp học']));
        }
        else{
            return back()->with('error', __('message.update_error', ['name' => 'lớp học']));
        }

    }

    public function destroy($id)
    {
        $this->checkIssetClass($id);
        $delete = $this->class->delete($id);
        if($delete){
            return back()->with('success', __('message.delete_success', ['name' => 'lớp học']));
        }
        else{
            return back()->with('error', __('message.delete_error', ['name' => 'lớp học']));
        }
    }

    public function editHomeroomTeacher($id){
        $this->checkIssetClass($id);
        $className = $this->class->getById($id)->name;
        $arr = $this->getIdHomeroomTeachers();
        $teachers = $this->teacher->getAccountActive()->whereNotIn('id', $arr);
        return view('admin.class.homeroomTeacher', compact('className', 'teachers'));
    }

    public function updateHomeroomTeacher($id, ChangeHomeroomTeacherRequest $request){
        $this->checkIssetClass($id);
        $collection['class_id'] = $id;
        $collection['teacher_id'] = $request->homeroom_teacher;
        $homeroomTeacher = $this->homeroomTeacher->getTeacherActive($id);
        if($homeroomTeacher !== null){
            $this->homeroomTeacher->setEndDate($homeroomTeacher->id);
        }
        $store = $this->homeroomTeacher->create($collection);
        if($store){
            return back()->with('success', __('message.update_success', ['name' => 'chủ nhiệm']));
        }
        else{
            return back()->with('error', __('message.update_error', ['name' => 'chủ nhiệm']));
        }
    }
}
