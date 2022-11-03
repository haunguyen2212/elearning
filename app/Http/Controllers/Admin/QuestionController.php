<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionRequest;
use App\Repositories\Interfaces\QuestionRepositoryInterface;
use App\Repositories\Interfaces\SubjectRepositoryInterface;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        $data = $this->subject->getDropdown();
        if(!empty($data)){
            return response()->json(['data' => $data, 'status' => 1]);
        }
        return response()->json(['status' => 0]);
    }

    public function store(StoreQuestionRequest $request)
    {
        $collection = $request->except(['_token', 'image']);
        DB::beginTransaction();
        try{
            $this->question->create($collection);
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        } 
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
