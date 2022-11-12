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

        return $query->orderBy('id', 'desc')->paginate($offset);
    }

    public function getById($id)
    {
        return $this->question->where('id', $id)->first();
    }

    public function getFullById($id)
    {
        return $this->question->leftJoin('teachers', 'teacher_id', 'teachers.id')
            ->leftJoin('subjects', 'subject_id', 'subjects.id')
            ->where('questions.id', $id)
            ->select('questions.*', DB::raw('teachers.name as teacher_name, subjects.name as subject_name'))
            ->first();
    }

    public function create($collection = [])
    {
        return $this->question->create([
            'question' => $collection['question'],
            'answer_a' => $collection['answer_a'],
            'answer_b' => $collection['answer_b'],
            'answer_c' => $collection['answer_c'],
            'answer_d' => $collection['answer_d'],
            'correct_answer' => $collection['correct_answer'],
            'explain' => $collection['explain'] ?? NULL,
            'level' => $collection['level'],
            'shared' => $collection['shared'],
            'teacher_id' => $collection['teacher_id'] ?? NULL,
            'subject_id' => $collection['subject_id'],
            'image' => $collection['image'] ?? NULL,
        ]);
    }

    public function update($id, $collection)
    {
        $query = $this->question->find($id);
        if(!empty($collection['image'])){
            return $query->update([
                'question' => $collection['question'],
                'answer_a' => $collection['answer_a'],
                'answer_b' => $collection['answer_b'],
                'answer_c' => $collection['answer_c'],
                'answer_d' => $collection['answer_d'],
                'correct_answer' => $collection['correct_answer'],
                'explain' => $collection['explain'] ?? NULL,
                'level' => $collection['level'],
                'shared' => $collection['shared'],
                'subject_id' => $collection['subject_id'],
                'image' => $collection['image'],
            ]);
        }
        else{
            return $query->update([
                'question' => $collection['question'],
                'answer_a' => $collection['answer_a'],
                'answer_b' => $collection['answer_b'],
                'answer_c' => $collection['answer_c'],
                'answer_d' => $collection['answer_d'],
                'correct_answer' => $collection['correct_answer'],
                'explain' => $collection['explain'] ?? NULL,
                'level' => $collection['level'],
                'shared' => $collection['shared'],
                'subject_id' => $collection['subject_id'],
            ]);
        }
    }

    public function delete($id)
    {
        return $this->question->find($id)->delete();
    }

    public function getAllQuestionCanUse($quiz_id, $subject_id, $teacher_id)
    {
        $questions = $this->question->where('subject_id', $subject_id)->where(function($q) use($teacher_id){
            $q->orWhere('shared', 1)->orWhere('teacher_id', $teacher_id);
        });

        return $this->question->join('quiz_details', 'question_id', 'questions.id')
            ->where('quiz_id', $quiz_id)
            ->select('questions.*')
            ->union($questions)
            ->get();
    }

    public function getQuestionOfTeacher($teacher_id, $subject_id, $search = [], $is_paginate = 0, $offset = 10)
    {
       $query = $this->question->where('teacher_id', $teacher_id)->where('subject_id', $subject_id);

       if(isset($search['keyword'])){
        $query->where(function($q) use ($search){
            $q->orWhere('question', 'LIKE', '%'.$search['keyword'].'%')
                ->orWhere('answer_a', 'LIKE', '%'.$search['keyword'].'%')
                ->orWhere('answer_b', 'LIKE', '%'.$search['keyword'].'%')
                ->orWhere('answer_c', 'LIKE', '%'.$search['keyword'].'%')
                ->orWhere('answer_d', 'LIKE', '%'.$search['keyword'].'%');
        });
        }
        if(isset($search['level'])){
            $query->whereIn('level', $search['level']);
        }
        if(isset($search['shared'])){
            $query->whereIn('shared', $search['shared']);
        }

        $query->orderBy('id', 'desc');

       if($is_paginate){
        return $query->paginate($offset);
       }
       else{
        return $query->get();
       }
    }

}