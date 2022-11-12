<?php

namespace App\Repositories;

use App\Models\Subject;
use App\Repositories\Interfaces\SubjectRepositoryInterface;

class SubjectRepository implements SubjectRepositoryInterface{

    private $subject;

    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
    }

    public function getDropdown()
    {
        return $this->subject->select('id', 'name')->get();
    }

    public function getById($id)
    {
        return $this->subject->find($id);
    }

    public function checkSubjectOfTeacher($teacher_id, $subject_id)
    {
        return $this->subject->join('courses', 'courses.subject_id', 'subjects.id')
                ->where('teacher_id', $teacher_id)
                ->where('subjects.id', $subject_id)
                ->count() > 0;
    }

}