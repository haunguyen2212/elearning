<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Libraries\MyCourse;
use App\Repositories\Interfaces\QuestionRepositoryInterface;
use App\Repositories\Interfaces\SubjectRepositoryInterface;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{

    private $teacher, $question, $subject, $myCourse;

    public function __construct(
        TeacherRepositoryInterface $teacherRepository,
        QuestionRepositoryInterface $questionRepository,
        SubjectRepositoryInterface $subjectRepository
    )
    {
        $this->teacher = $teacherRepository;
        $this->question = $questionRepository;
        $this->subject = $subjectRepository;
        $this->myCourse = new MyCourse();
    }

    public function index()
    {
        $data['subjects'] = $this->teacher->getSubject(auth()->guard('teacher')->id());
        $data['myTeacherCourses'] = $this->myCourse->getCourseOfTeacher();
        return view('front.teacher.question', $data);
    }

    public function getDataSearch($request){
        $data = [];
        if(isset($request->keyword)){
            $data['keyword'] = $request->keyword;
        }
        if(isset($request->level)){
            $data['level'] = explode(',', $request->level);
        }
        if(isset($request->shared)){
            $data['shared'] = explode(',', $request->shared);
        }
        return $data;
    }

    public function view($subject_id, Request $request){
        $data['subject'] = $this->subject->getById($subject_id);
        $search = $search = $this->getDataSearch($request);;
        $data['questions'] = $this->question->getQuestionOfTeacher(auth()->guard('teacher')->id(), $subject_id, $search ,1);
        if($search != []){
            $data['questions']->appends($request->toArray());
        }
        return view('front.teacher.question_list', $data);
    }


    public function create()
    {
        //
    }


    public function store($subject_id, Request $request)
    {
        $collection = $request->except(['_token', 'image']);
        $collection['subject_id'] = $subject_id;
        $collection['teacher_id'] = auth()->guard('teacher')->id();
        DB::beginTransaction();
        try{
            $image = $request->file('image');
            if($image){
                $new_name = rand().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('backend/assets/img/question'), $new_name);
                $collection['image'] = $new_name;
            }
            $this->question->create($collection);
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }

    public function show($subject_id, $id)
    {
        $data['subject'] = $this->subject->getById($subject_id);
        $data['question'] = $this->question->getFullById($id);
        return view('front.teacher.question_detail', $data);
    }


    public function edit($subject_id, $id)
    {
        $data['question'] = $this->question->getById($id);
        if(empty($data['question'])){
            return response()->json(['status' => 0]);
        }
        return response()->json(['data' => $data, 'status' => 1]);
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

    public function destroy($subject_id, $id)
    {
        DB::beginTransaction();
        try{
            $question = $this->question->getById($id);
            if(!empty($question->image)){
                $destinationPath = public_path('backend/assets/img/question/').$question->image;
                if(file_exists($destinationPath)){
                    unlink($destinationPath);
                }
            }
            $this->question->delete($id);
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }
}
