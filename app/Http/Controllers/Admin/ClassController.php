<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\ClassRepositoryInterface;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use Illuminate\Http\Request;

class ClassController extends Controller
{

    private $class, $teacher;

    public function __construct(
        ClassRepositoryInterface $classRepository,
        TeacherRepositoryInterface $teacherRepository
        )
    {
        $this->class = $classRepository;
        $this->teacher = $teacherRepository;
    }

    public function index()
    {
        $classes = $this->class->getFullInfo();
        return view('admin.class.index', compact('classes'));
    }

    public function create()
    {
        $teachers = $this->teacher->getAll();
        dd($teachers);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $info = $this->class->getById($id);
        $homeroomTeacherActive = $this->class->getHomeroomTeacherActive($id)->name;
        $countTotal = $this->class->countTotalStudent($id);
        $total = $countTotal ? $countTotal->total : 0;
        $students = $this->class->getStudentsById($id);
        return view('admin.class.show', compact('info', 'homeroomTeacherActive', 'total' ,'students'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
