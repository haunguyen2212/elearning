<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\QuestionRepositoryInterface;
use App\Repositories\Interfaces\SubjectRepositoryInterface;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    private $question, $teacher, $subject;

    public function __construct(
        QuestionRepositoryInterface $questionRepository,
        TeacherRepositoryInterface $teacherRepository,
        SubjectRepositoryInterface $subjectRepository
    )
    {
        $this->question = $questionRepository;
        $this->teacher = $teacherRepository;
        $this->subject = $subjectRepository;
    }

    public function index(Request $request)
    {
        $search = $this->getDataSearch($request);
        $data['questions'] = $this->question->getAll($search);
        $data['subjects'] = $this->subject->getDropdown();
        $data['teachers'] = $this->teacher->getDropdown();
        return view('admin.question.index', $data);
    }

    public function getDataSearch($request){
        $data = [];
        if(isset($request->keyword)){
            $data['keyword'] = $request->keyword;
        }
        if(isset($request->subject)){
            $data['subject'] = $request->subject;
        }
        if(isset($request->teacher)){
            $data['teacher'] = $request->teacher;
        }
        if(isset($request->level)){
            $data['level'] = explode(',', $request->level);
        }
        if(isset($request->shared)){
            $data['shared'] = explode(',', $request->shared);
        }
        return $data;
    }


    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
