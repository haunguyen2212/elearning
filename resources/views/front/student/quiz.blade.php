@extends('template.master_layout')

@section('title', 'Bài tập')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('course.view.student', $course->id) }}">{{ $course->name }}</a></li>
    <li class="breadcrumb-item active">Bài tập</li>
@endsection

@section('content')
    <div class="card">
        <div class="card-body px-4">
            <div class="card-title mb-0">{{ $quiz->name }}</div>
            <div class="card-content">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <div>
                            <strong class="text-main">Thời gian mở đề: </strong>
                            <span>{{ date('d/m/Y H:i',strtotime($quiz->start_time)) }}</span>
                        </div>
                        <div>
                            <strong class="text-main">Thời gian kết thúc: </strong>
                            <span>{{ date('d/m/Y H:i',strtotime($quiz->end_time)) }}</span>
                        </div>
                        <div>
                            <strong class="text-main">Thời gian làm bài: </strong>
                            <span class="fw-bold" style="color: #dc3545">{{ $quiz->duration }} phút</span>
                        </div> 
                        <div>
                            <strong class="text-main">Lượt thi tối đa: </strong>
                            <span class="fw-bold">{{ $quiz->maximum }}</span>
                        </div>               
                    </div>
                    <div class="col-12 d-flex justify-content-center my-3">
                        <a href="{{ route('course.view.student', $course->id) }}" class="btn-slide02 mx-1">Về khóa học</a>
                        <button type="button" class="btn-slide01 mx-1" data-bs-toggle="modal" data-bs-target="#ModalPassword">Làm bài thi</button>
                </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade mt-5" id="ModalPassword" tabindex="-1" aria-labelledby="ModalPasswordLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title fw-bold text-main" id="ModalPasswordLabel">Nhập mật khẩu</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="" id="frm-create-exercise" method="post" class="row g-3 px-2">
                    <div class="col-12 col-md-12">
                        <label for="password-quiz" class="form-label">Mật khẩu bài thi (*)</label>
                        <input type="text" class="form-control" id="password-quiz" name="password">
                        <span class="text-danger txt_error txt_password mt-1"></span>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Đóng</button>
              <button type="button" class="btn-sm btn-main sm-password">Xác nhận</button>
            </div>
          </div>
        </div>
    </div>
@endsection