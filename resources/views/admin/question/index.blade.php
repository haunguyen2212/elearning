@extends('template.admin')

@section('title', 'Quản lý câu hỏi')

@section('pagetitle', 'Quản lý câu hỏi')

@section('breadcrumb')
    <li class="breadcrumb-item active">Câu hỏi</li>
@endsection

@section('content')
    @php
      function checkedCheckbox($name, $value){
        if(isset(request()->{$name})){
          $listChecked = explode(',', request()->{$name});
          if(!in_array($value, $listChecked)){
            return '';
          }
        }
        return 'checked';
      }
    @endphp
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tìm kiếm nâng cao</h5>
                    <div class="row search-master">
                        <div class="col-12 col-md-4">
                            <div class="mb-3">
                                <label for="keyword" class="form-label fw-bold text-main">Từ khóa</label>
                                <input type="text" class="form-control" id="keyword" placeholder="Nhập từ khóa tìm kiếm" value="{{ request()->keyword ?? '' }}">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-main">Môn học</label>
                                <select class="form-select" id="subject">
                                    <option value="">Tất cả môn học</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}" {{ request()->subject == $subject->id ? 'selected' : '' }}>{{ $subject->name }}</option>
                                    @endforeach
                                  </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-main">Giáo viên</label>
                                <select class="form-select" id="teacher-name">
                                    <option value="">Tất cả giáo viên</option>
                                    @foreach ($teachers as $teacher)
                                        <option value="{{ $teacher->id }}" {{ request()->teacher == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                                    @endforeach
                                  </select>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-main">Cấp độ câu hỏi</label> <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input level" type="checkbox" id="level1" name="level[]" value="1" {{ checkedCheckbox('level', 1) }}>
                                    <label class="form-check-label" for="level1">Dễ</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input level" type="checkbox" id="level2" name="level[]" value="2" {{ checkedCheckbox('level', 2) }}>
                                    <label class="form-check-label" for="level2">Trung bình</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input level" type="checkbox" id="level3" name="level[]" value="3"  {{ checkedCheckbox('level', 3) }}>
                                    <label class="form-check-label" for="level3">Khó</label>
                                  </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-main">Loại câu hỏi</label> <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input shared" type="checkbox" id="shared1" value="1" name="shared[]" {{ checkedCheckbox('shared', 1) }}>
                                    <label class="form-check-label" for="shared1">Chung</label>
                                  </div>
                                  <div class="form-check form-check-inline">
                                    <input class="form-check-input shared" type="checkbox" id="shared0" value="0" name="shared[]" {{ checkedCheckbox('shared', 0) }}>
                                    <label class="form-check-label" for="shared0">Riêng</label>
                                  </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-center align-items-center mt-3">
                            <div>
                                <button class="btn btn-sm btn-outline-main me-1 px-4 btn-clear">Xóa kết quả</button>
                                <button class="btn btn-sm btn-main px-4 btn-search">Tìm kiếm</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="bd-highlight">
                      <h5 class="card-title">Câu hỏi</h5>
                    </div>
                    <div class="bd-highlight">
                      <h5 class="card-title">
                        <a class="btn btn-sm btn-main" href="">
                          <i class="bi bi-plus"></i><span class="text-white"> Thêm mới</span> 
                        </a>
                      </h5>
                    </div>
                  </div>
                  @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  @endif
                  @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  @endif
                  <div class="table-responsive">
                    <table class="table table-hover" style="min-width: 100px">
                        <thead>
                          <tr>
                            <th width="5%">ID</th>
                            <th width="40%">Câu hỏi</th>
                            <th width="12.5%">Môn học</th>
                            <th width="12.5%">Giáo viên</th>
                            <th width="10%">Cấp độ</th>
                            <th width="10%">Loại</th>
                            <th width="10%">Xem</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($questions as $question)
                                <tr>
                                    <td>
                                      <div>{{ $question->id }}</div>
                                    </td>
                                    <td class="question-content">
                                      <span>{!! $question->question !!}</span>
                                      <span>A.&nbsp;{!! $question->answer_a !!}</span>
                                      <span>B.&nbsp;{!! $question->answer_b !!}</span>
                                      <span>
                                        @if (isset($question->answer_c) && $question->answer_c !== '')
                                         C.&nbsp;{!! $question->answer_c !!}
                                        @endif
                                      </span>
                                      <span>
                                        @if (isset($question->answer_d) && $question->answer_d !== '')
                                         D.&nbsp;{!! $question->answer_d !!}
                                        @endif
                                      </span>
                                    </td>
                                    <td>{!! $question->subject_name ?? '' !!}</td>
                                    <td>{!! $question->teacher_name ?? '<strong>Quản trị viên</strong>' !!}</td>
                                    <td>
                                      @switch($question->level)
                                        @case(1)
                                          <span>Dễ</span>
                                          @break
                                        @case(2)
                                          <span>Trung bình</span>
                                          @break
                                        @case(3)
                                          <span>Khó</span>
                                          @break
                                      @endswitch
                                    </td>
                                    <td>
                                      @switch($question->shared)
                                        @case(0)
                                          <span>Riêng</span>
                                          @break
                                        @case(1)
                                          <span>Chung</span>
                                        @break
                                          
                                      @endswitch
                                    </td>
                                    <td>
                                        <a href="" class="btn btn-sm btn-main"><i class="bi bi-pencil-square"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                      </table>
                  </div>
                  {{ $questions->links() }}
                </div>
                
              </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $('#quiz-nav').addClass('show');
        $('#quiz-link').removeClass('collapsed');
        $('#list-question').addClass('active');
        $('#list-question').attr('href', 'javascript:void(0)');
    </script>
    <script src="{{ asset('backend/assets/js/question/question.js') }}"></script>
@endsection