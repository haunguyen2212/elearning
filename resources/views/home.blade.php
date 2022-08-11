@extends('template.master_layout')

@section('title', 'Trang chủ')

@section('content')
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Danh sách khoá học</h5>
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