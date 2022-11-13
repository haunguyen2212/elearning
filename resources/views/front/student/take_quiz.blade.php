@extends('template.master')

@section('title', 'Làm bài thi')

@section('breadcrumb')
    <li class="breadcrumb-item active">Làm bài thi</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-3">
            <div class="card mb-3">
                <div class="card-header bg-exam text-white fw-bold text-center">B1001 - Võ Thị Thúy An</div>
                <div class="card-text">
                    <div id="tg">
                        <div id="time-header">THỜI GIAN LÀM BÀI</div>
                        <div id="count-down" class="fw-bold text-danger">00:13:27</div>
                        <div class="container-fluid" id="list-answer">
                            <div id="ques-1" class="btn btn-sm btn-answer">1</div>
                            <div id="ques-1" class="btn btn-sm btn-answer">2</div>
                            <div id="ques-1" class="btn btn-sm btn-answer">3</div>
                            <div id="ques-1" class="btn btn-sm btn-answer">4</div>
                            <div id="ques-1" class="btn btn-sm btn-answer">5</div>
                            <div id="ques-1" class="btn btn-sm btn-answer">6</div>
                            <div id="ques-1" class="btn btn-sm btn-answer">6</div>
                            <div id="ques-1" class="btn btn-sm btn-answer">6</div>
                            <div id="ques-1" class="btn btn-sm btn-answer">6</div>							
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-9">
            <div class="card mb-3">
                <div class="card-header bg-exam text-white fw-bold">Thi giữa kỳ</div>
                <div class="card-text">
                    aaaa
                </div>
            </div>
        </div>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/exam.css') }}">
@endsection