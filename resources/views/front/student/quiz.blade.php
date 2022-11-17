@extends('template.master_layout')

@section('title', 'Thi trắc nghiệm')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('course.view.student', $course->id) }}">{{ $course->name }}</a></li>
    <li class="breadcrumb-item active">{{ $quiz->name }}</li>
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
                    @if ($takesQuiz->count() > 0)
                        <div class="col-12 col-md-12">
                            <div class="table-responsive">
                                <table class="table" style="min-width: 800px">
                                    <thead>
                                        <tr>
                                            <th>Lần thi</th>
                                            <th>Thời gian bắt đầu</th>
                                            <th>Thời gian nộp</th>
                                            <th>Điểm</th>
                                            <th>Số câu đúng</th>
                                            <th>Làm bài</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($takesQuiz as $key => $takeQuiz)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ date('d/m/Y H:i:s', strtotime($takeQuiz->start_time)) }}</td>
                                                <td>{{ !empty($takeQuiz->submit_time) ?  date('d/m/Y H:i:s', strtotime($takeQuiz->submit_time)) : '' }}</td>
                                                <td>{{ $takeQuiz->score }}</td>
                                                <td>{{ $takeQuiz->number_correct }}/{{ $takeQuiz->total }}</td>
                                                <td><a href="{{ route('student.exam.index', ['id' => $takeQuiz->id]) }}">Làm bài</a></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                    @if ($num_take_quiz_remaining > 0)
                        <div class="col-12 d-flex justify-content-center my-3">
                            <button type="button" class="btn-slide01 mx-1" data-bs-toggle="modal" data-bs-target="#ModalPassword">Làm bài thi</button>
                        </div>
                    @endif
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
              <form action="{{ route('student.exam.check_password', $quiz->id) }}" id="frm-create-exercise" method="post" class="row g-3 px-2">
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

@section('script')
    <script>
        $('.sm-password').click(function(){
            var url = $('#frm-create-exercise').attr('action');
            var password = $('#password-quiz').val();
            $.ajax({
                type: 'post',
                url:url,
                data:{
                    _token:_token,
                    password:password,
                },
                beforeSend: function(){
                    $('.text-danger').html('');
                },
                success: function(res){
                    if(res.status == 1){
                        if(typeof res.message == 'undefined'){
                            window.location.href = res.data.url_next;
                        }
                        else{
                            $('.txt_password').html(res.message);
                        }
                    }
                },
                error: function(err){
                    var errors = err.responseJSON.errors;
                    $.each(errors, function(prefix, val){
                        $('#ModalPassword .txt_'+prefix).html(val);
                    });
                }
            })
        });
    </script>
@endsection