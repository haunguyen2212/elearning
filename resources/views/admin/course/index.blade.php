@extends('template.admin')

@section('title', 'Quản lý khóa học')

@section('pagetitle', 'Quản lý khóa học')

@section('breadcrumb')
    <li class="breadcrumb-item active">Khóa học</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="bd-highlight">
                      <h5 class="card-title">Khóa học</h5>
                    </div>
                    <div class="bd-highlight">
                      <h5 class="card-title">
                        <form class="d-flex">
                          <input class="form-control input-search" name="search" placeholder="Tìm kiếm khoá học..." value="{{ request()->search }}">
                          <button class="btn btn-sm button-search" type="submit">
                            <i class="bi bi-search"></i>
                          </button>
                      </form>
                      </h5>
                    </div>
                    <div class="bd-highlight">
                      <h5 class="card-title">
                        <a class="btn btn-sm btn-main" href="{{ route('course.create') }}">
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
                            <th width="10%">Mã số</th>
                            <th width="30%">Tên khóa học</th>
                            <th width="15%">Giáo viên</th>
                            <th width="15%">Môn học</th>
                            <th width="10%">Trạng thái</th>
                            <th width="15%">Tùy chỉnh</th>
                          </tr>
                        </thead>
                        <tbody>

                            @foreach ($courses as $course)
                                <tr>
                                    <td>{{ $course->id }}</td>
                                    <td>{{ $course->code }}</td>
                                    <td>{{ $course->name }}</td>
                                    <td>{{ $course->teacher_name }}</td>
                                    <td>{!! $course->subject_name !!}</td>
                                    <td>
                                      @if ($course->is_enrol)
                                            <span class="badge bg-success">Mở</span>
                                        @else
                                            <span class="badge bg-danger">Đóng</span>
                                        @endif
                                        @if ($course->is_show)
                                            <span class="badge bg-success">Hiện</span>
                                        @else
                                            <span class="badge bg-danger">Ẩn</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a 
                                          href="{{ route('course.show',['course'=>$course->id]) }}" 
                                          class="btn btn-sm btn-info"
                                          data-bs-toggle="tooltip"
                                          title="Xem"
                                        >
                                          <i class="bi bi-eye"></i>
                                        </a>
                                        <a 
                                          href="{{ route('course.edit', ['course'=>$course->id]) }}" 
                                          class="btn btn-sm btn-warning"
                                          data-bs-toggle="tooltip"
                                          title="Sửa"
                                        >
                                          <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button 
                                          class="btn btn-sm btn-danger btn-delete" 
                                          data-id="{{ $course->id }}" 
                                          data-bs-toggle="modal" 
                                          data-bs-target="#deleteModal"
                                          title="Xóa"
                                        >
                                          <i class="bi bi-x-lg"></i>
                                        </button>
                                        @if ($course->is_show)
                                            <a 
                                                href="{{ route('course.lock', $course->id) }}" 
                                                class="btn btn-sm btn-success"
                                                data-bs-toggle="tooltip"
                                                title="Ẩn"
                                            >
                                                <i class="bi bi-slash-circle"></i>
                                            </a>
                                        @else
                                            <a 
                                                href="{{ route('course.unlock', $course->id) }}" 
                                                class="btn btn-sm btn-success"
                                                data-bs-toggle="tooltip"
                                                title="Hiện"
                                            >
                                                <i class="bi bi-circle"></i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                      </table>
                  </div>
                  {{ $courses->links() }}
                </div>
                
              </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-main" id="deleteModalLabel">Xoá khóa học</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="post">
              @csrf
              @method('delete')
              <h6>Tất cả dữ liệu của khóa học sẽ xóa, bạn có chắc muốn xóa khóa học này không ?</h6>
            </form>    
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-main" data-bs-dismiss="modal">Hủy</button>
            <button type="button" class="btn btn-sm btn-danger btn-submit">Đồng ý</button>
          </div>
        </div>
      </div>
@endsection


@section('script')
    <script>
        $('#course-nav').addClass('show');
        $('#course-link').removeClass('collapsed');
        $('#list-course').addClass('active');
        $('#list-course').attr('href', 'javascript:void(0)');

        $('.btn-delete').click(function(e){
            e.preventDefault();
            let id = $(this).attr('data-id');
            let url = "{{ asset('/admin/course') }}/"+id;
            $('#deleteModal form').attr('action', url);
        });

        $('.btn-submit').click(function(e){
            e.preventDefault();
            $('#deleteModal form').submit();
        });
    </script>
@endsection