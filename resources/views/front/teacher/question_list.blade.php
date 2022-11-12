@extends('template.master')

@section('title', 'Câu hỏi trắc nghiệm')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('teacher.question.index') }}">Câu hỏi trắc nghiệm</a></li>
    <li class="breadcrumb-item active">Danh sách câu hỏi</li>
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
        <div class="col-12 col-md-8">
            <div class="card main-card">
                <div class="card-body px-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="bd-highlight">
                        <h5 class="card-title">Câu hỏi môn {{ $subject->name }}</h5>
                        </div>
                        <div class="bd-highlight">
                            <button type="button" class="btn-slide01 btn-create" data-url="{{ route('teacher.question.store', $subject->id) }}" data-bs-toggle="modal" data-bs-target="#ModalCreateQuestion">
                                <i class="bi bi-plus"></i>&nbsp;Thêm câu hỏi
                            </button>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="table-responsive">
                            <table class="table table-hover custom-question" style="min-width: 800px">
                                <thead>
                                    <tr>
                                        <th width="5%">STT</th>
                                        <th width="50%">Câu hỏi</th>
                                        <th width="10%">Đáp án</th>
                                        <th width="15%">Độ khó</th>
                                        <th width="10%">Loại</th>
                                        <th width="10%">Xem</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($questions as $key  => $question)
                                        <tr>
                                            <td>
                                                {{ $key + 1 }}
                                            </td>
                                            <td class="question-content">
                                                <span>{!! $question->question !!}</span>
                                                @if (!empty($question->image))
                                                    <img class="mt-2" src="{{ asset('backend/assets/img/question/'.$question->image) }}" alt="image" style="max-width: 120px">
                                                @endif
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
                                            <td>
                                                <span class="fw-bold ps-3">
                                                    @switch($question->correct_answer)
                                                        @case(1)
                                                            A
                                                            @break
                                                        @case(2)
                                                            B
                                                            @break
                                                        @case(3)
                                                            C
                                                            @break
                                                        @case(4)
                                                            D
                                                            @break
                                                    @endswitch
                                                </span>
                                            </td>
                                            <td class="public-status">
                                                @switch($question->level)
                                                @case(1)
                                                    <span style="background: #ffffcc">Dễ</span>
                                                    @break
                                                @case(2)
                                                    <span style="background: #C6EAD8">Trung bình</span>
                                                    @break
                                                @case(3)
                                                    <span style="background: #FFC7C7">Khó</span>
                                                    @break
                                                @endswitch
                                            </td>
                                            <td class="public-status">
                                                @switch($question->shared)
                                                @case(1)
                                                    <span style="background: #C6EAD8">Chung</span>
                                                    @break
                                                @case(0)
                                                    <span style="background: #FFC7C7">Riêng</span>
                                                    @break
                                                @endswitch
                                            </td>
                                            <td>
                                                <a href="{{ route('teacher.question.show', [$subject->id, $question->id]) }}" class="fw-bold text-main btn"><i class="bi bi-pencil-square"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="d-flex justify-content-center">{{ $questions->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Tìm kiếm nâng cao</h5>
                    <div class="row search-master">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="keyword" class="form-label fw-bold text-main">Từ khóa</label>
                                <input type="text" class="form-control" id="keyword" placeholder="Nhập từ khóa tìm kiếm" value="{{ request()->keyword ?? '' }}">
                            </div>
                        </div>
                        <div class="col-12">
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
                        <div class="col-12">
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
                            <button class="btn-slide02 me-2 btn-clear">Xóa kết quả</button>
                            <button class="btn-slide01 btn-search">Tìm kiếm</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('front.teacher.modal.create_question')
@endsection

@section('script')
    <script src="{{ asset('backend/assets/vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('question_create');
        CKEDITOR.replace('answer_a_create');
        CKEDITOR.replace('answer_b_create');
        CKEDITOR.replace('answer_c_create');
        CKEDITOR.replace('answer_d_create');
        CKEDITOR.replace('explain_create');
    </script>
    <script src="{{ asset('frontend/assets/js/question/teacher.js') }}"></script>
@endsection