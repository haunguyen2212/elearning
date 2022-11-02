<?php

namespace App\Repositories;

use App\Models\Question;
use App\Repositories\Interfaces\QuestionRepositoryInterface;
use Illuminate\Support\Facades\DB;

class QuestionRepository implements QuestionRepositoryInterface{

    protected $question;

    public function __construct(
        Question $question
    )
    {
        $this->question = $question;
    }

    public function getAll($search = [],$offset = 10)
    {
        $query =  $this->question->leftJoin('teachers', 'teacher_id', 'teachers.id')
            ->leftJoin('subjects', 'subject_id', 'subjects.id')
            ->select('questions.*', DB::raw('teachers.name as teacher_name, subjects.name as subject_name'));

        if(isset($search['keyword'])){
            $query->where(function($q) use ($search){
                $q->orWhere('question', 'LIKE', '%'.$search['keyword'].'%')
                    ->orWhere('answer_a', 'LIKE', '%'.$search['keyword'].'%')
                    ->orWhere('answer_b', 'LIKE', '%'.$search['keyword'].'%')
                    ->orWhere('answer_c', 'LIKE', '%'.$search['keyword'].'%')
                    ->orWhere('answer_d', 'LIKE', '%'.$search['keyword'].'%');
            });
        }
        if(isset($search['subject'])){
            $query->where('subject_id', $search['subject']);
        }
        if(isset($search['teacher'])){
            $query->where('teacher_id', $search['teacher']);
        }
        if(isset($search['level'])){
            $query->whereIn('level', $search['level']);
        }
        if(isset($search['shared'])){
            $query->whereIn('shared', $search['shared']);
        }

        return $query->paginate($offset);
    }

    public function getById($id)
    {
        return $this->question->where('id', $id)->first();
    }

}