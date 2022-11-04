<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
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


    public function show($id)
    {
        $data['question'] = $this->question->getFullById($id);
        return view('admin.question.show', $data);
    }


    public function edit($id)
    {
        $data['subject'] = $this->subject->getDropdown();
        $data['question'] = $this->question->getById($id);
        if(empty($data['subject']) || empty($data['question'])){
            return response()->json(['status' => 0]);
        }
        return response()->json(['data' => $data, 'status' => 1]);
    }


    public function update(UpdateQuestionRequest $request, $id)
    {
        $collection = $request->except(['_token', '_method', 'image']);
        DB::beginTransaction();
        try{
            $image = $request->file('image');
            if($image){
                $new_name = rand().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('backend/assets/img/question'), $new_name);
                $old_img = $this->question->getById($id)->image;
                if(!empty($old_img)){
                    $destinationPath = public_path('backend/assets/img/question/').$old_img;
                    if(file_exists($destinationPath)){
                        unlink($destinationPath);
                    }
                }
                $collection['image'] = $new_name;
            }
            $this->question->update($id, $collection);
            DB::commit();
            return response()->json(['status' => 1]);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['status' => 0]);
        }
    }


    public function destroy($id)
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
