<?php

namespace App\Repositories\Interfaces;

interface SubjectRepositoryInterface{

    public function getDropdown();
    public function getById($id);
    public function checkSubjectOfTeacher($teacher_id, $subject_id);
    
}