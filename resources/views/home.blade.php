@extends('template.master_layout')

@section('title', 'Trang chủ')

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <div class="bd-highlight">
              <h5 class="card-title mb-0">Danh sách khoá học</h5>
            </div>
            <div class="bd-highlight">
              <div class="d-flex form-inputs">
                <input class="form-control" type="text" id="search" placeholder="Tìm kiếm khóa học..." value="{{ request()->search }}">
                <i class="bi bi-search" id="search-course"></i>
              </div>
            </div>
          </div>
          <ul class="list-item">

              @foreach ($courses as $course)
                  <li>
                      <a href="{{ route('course.detail', $course->id) }}"><i class="bi bi-caret-right-fill"></i> 
                          {{ $course->code }} - {{ $course->name }} 
                      </a>
                      <div class="action-link">
                      <a href="#collapseCourse{{ $course->id }}" data-bs-toggle="collapse" href="#collapseCourse{{ $course->id }}" role="button" aria-expanded="false" aria-controls="collapseCourse{{ $course->id }}"><i class="bi bi-info-circle"></i></a>
                      </div>
                  </li>
                  <div class="collapse info-course" id="collapseCourse{{ $course->id }}">
                      <div class="card card-body">
                          <div><strong>Giáo viên: </strong> {{ $course->teacher_name }}</div>
                          <a href="{{ route('course.detail', $course->id) }}" class="btn-slide02">Xem chi tiết</a>
                      </div>
                  </div>
              @endforeach

          </ul>
          <div class="d-flex justify-content-center">
            {{ $courses->links() }}
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('style')
  <style>
  .form-inputs{
      position:relative;
  }

  .form-inputs .form-control:focus{
      box-shadow:none;
      border:1px solid var(--main-color);
  }

  .form-inputs .form-control{
    border-radius: 20px;
    padding-left: 15px;
    padding-right: 30px;
    color: var(--main-color);
  }

  .form-inputs i{
      height: 50%;
      position:absolute;
      right:12px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--main-color);
      font-weight: bold;
      vertical-align: middle;
      cursor: pointer;
  }

  @media (max-width: 1000px) {
    .form-inputs .form-control{
      width: 160px;
    }

    .form-inputs .form-control:placeholder-shown {
      text-overflow: ellipsis;
    }
}
  </style>
@endsection

@section('script')
  <script src="{{ asset('frontend/home.js') }}"></script>
@endsection