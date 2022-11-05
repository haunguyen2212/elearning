@extends('template.master_layout')

@section('title', 'Bài thi')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{-- route('course.view.teacher',$course->id) --}}">{{-- $course->name --}}</a></li>
    <li class="breadcrumb-item active">Thi trắc nghiệm</li>
@endsection

@section('content')
    Thời gian làm bài: 20 phút
@endsection