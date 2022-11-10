<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Libraries\MyCourse;
use App\Repositories\Interfaces\QuestionRepositoryInterface;
use App\Repositories\Interfaces\SubjectRepositoryInterface;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use Illuminate\Http\Request;

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

    public function view($subject_id){
        $data['subject'] = $this->subject->getById($subject_id);
        $data['questions'] = $this->question->getQuestionOfTeacher(auth()->guard('teacher')->id(), $subject_id, 1);
        return view('front.teacher.question_detail', $data);
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
