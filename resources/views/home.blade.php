@extends('template.master')

@section('title', 'Trang chủ')

@section('content')
    <div class="row">
        <div class="col-12 col-md-8">
            <div class="card">
              <div class="card-body">
                <h5 class="card-title">Danh sách khoá học</h5>
                <ul class="list-item">

                    @foreach ($courses as $course)
                        <li>
                            <a href=""><i class="bi bi-caret-right-fill"></i> 
                                {{ $course->code }} - {{ $course->name }} 
                            </a>
                            <div class="action-link">
                            <a href="#collapseCourse{{ $course->id }}" data-bs-toggle="collapse" href="#collapseCourse{{ $course->id }}" role="button" aria-expanded="false" aria-controls="collapseCourse{{ $course->id }}"><i class="bi bi-info-circle"></i></a>
                            </div>
                        </li>
                        <div class="collapse info-course" id="collapseCourse{{ $course->id }}">
                            <div class="card card-body">
                                <div>{{ $course->introduce }}</div>
                                <div><strong>Giáo viên: </strong> {{ $course->teacher_name }}</div>
                                <a href="" class="btn-slide01">Ghi danh</a>
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
          <div class="col-12 col-md-4">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body pb-0">
                    <h5 class="card-title">Khóa học của tôi</h5>
                    <ul class="list-item">
                      <li>
                        <a href=""><i class="bi bi-caret-right-fill"></i> CT174 - Toán 12 (Võ Huỳnh Trâm) </a>
                      </li>
                      <li>
                        <a href=""><i class="bi bi-caret-right-fill"></i> CT174 - Toán 12 (Võ Huỳnh Trâm) </a>
                      </li>
                    </ul> 
                  </div>
                </div>
                
              </div>
              <div class="col-12">
                <div class="card">
                  <div class="card-body pt-0">
                    <h5 class="card-title">Thông báo</h5>
                  </div>
                </div>
                
              </div>
            </div>
            
          </div>
        </div>
@endsection