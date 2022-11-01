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

}