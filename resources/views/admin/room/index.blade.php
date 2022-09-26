@extends('template.admin')

@section('title', 'Danh sách phòng học')

@section('pagetitle', 'Danh sách phòng')

@section('breadcrumb')
    <li class="breadcrumb-item active">Danh sách phòng</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-7">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="bd-highlight">
                            <h5 class="card-title">Phòng học</h5>
                        </div>
                        <div class="bd-highlight">
                          <h5 class="card-title">
                            <form class="d-flex">
                              <input class="form-control form-control-sm rounded-0 border-main" name="search" placeholder="Tìm kiếm ..."  value="{{ request()->search }}">
                              <button class="btn btn-sm btn-main rounded-0" type="submit">
                                <i class="bi bi-search"></i>
                              </button>
                          </form>
                          </h5>
                        </div>
                        <div class="bd-highlight">
                          <h5 class="card-title">
                            <a class="btn btn-sm btn-main" href="{{ route('room.create') }}">
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
                        <table class="table table-hover">
                            <thead>
                              <tr>
                                <th width="20%">STT</th>
                                <th width="40%">Phòng</th>
                                <th width="20%">Sức chứa</th>
                                <th width="20%">Tùy chỉnh</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $key => $room)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $room->name }}</td>
                                        <td>{{ $room->capacity }}</td>
                                        <td>
                                            <a href="{{ route('room.edit', $room->id) }}" class="btn btn-sm btn-success"><i class="bi bi-pencil-square"></i></a>
                                            <button class="btn btn-sm btn-danger btn-delete"
                                                data-id="{{ $room->id }}" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#deleteModal"
                                                title="Xóa"
                                            >
                                                <i class="bi bi-x-lg"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach 
                            </tbody>
                          </table>  
                    </div>
                    {{ $rooms->links() }}
                </div>
                
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-main" id="deleteModalLabel">Xoá phòng học</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post">
                @csrf
                @method('delete')
                <h6>Bạn có chắc muốn xóa phòng học này không ?</h6>
              </form>    
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-sm btn-main" data-bs-dismiss="modal">Hủy</button>
              <button type="button" class="btn btn-sm btn-danger btn-submit">Đồng ý</button>
            </div>
          </div>
        </div>
      </div>
@endsection


@section('script')
    <script>
        $('#room-registration-link').removeClass('collapsed');
        $('#room-registration-nav').addClass('show');
        $('#list-room').addClass('active');
        $('#list-room').attr('href', 'javascript:void(0)');
    </script>
    <script>
        $('.btn-delete').click(function(e){
        e.preventDefault();
            let id = $(this).attr('data-id');
            let url = "{{ asset('/admin/room') }}/"+id;
            $('#deleteModal form').attr('action', url);
        });

        $('.btn-submit').click(function(e){
            e.preventDefault();
            $('#deleteModal form').submit();
        });
    </script>
@endsection