@extends('template.admin')

@section('title', 'Quản lý thông báo')

@section('breadcrumb')
    <li class="breadcrumb-item active">Thông báo</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-12">
            <div class="card">
                <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="bd-highlight">
                    <h5 class="card-title">Thông báo</h5>
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
                        <a class="btn btn-sm btn-main" href="{{ route('notice.create') }}">
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
                    <table class="table table-hover" style="min-width: 1000px">
                        <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="30%">Nội dung</th>
                            <th width="25%">Tài liệu</th>
                            <th width="15%">Từ ngày</th>
                            <th width="15%">Đến ngày</th>
                            <th width="10%">Tùy chỉnh</th>
                        </tr>
                        </thead>
                        <tbody>

                            @foreach ($notices as $notice)
                                <tr>
                                    <td>{{ $notice->id }}</td>
                                    <td>{{ $notice->name }}</td>
                                    <td>
                                        @if ($notice->link)
                                            <a class="text-black" href="{{ asset('backend/assets/document/notices').'/'.$notice->link }}">{{ $notice->link }}</a>
                                        @endif
                                    </td>
                                    <td>{{ date('d/m/Y H:i:s', strtotime($notice->start_time)) }}</td>
                                    <td>{{ date('d/m/Y H:i:s', strtotime($notice->end_time)) }}</td>
                                    <td>
                                        <a 
                                        href="{{ route('notice.edit', ['notice' => $notice->id]) }}" 
                                        class="btn btn-sm btn-warning"
                                        data-bs-toggle="tooltip"
                                        title="Sửa"
                                        >
                                        <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <button 
                                        class="btn btn-sm btn-danger btn-delete" 
                                        data-id="{{ $notice->id }}" 
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
                {{ $notices->links() }}
                </div>
                
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title text-main" id="deleteModalLabel">Xoá thông báo</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post">
            @csrf
            @method('delete')
            <h6>Bạn có chắc muốn xóa thông báo này không ?</h6>
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
        $('#notice-link').removeClass('collapsed');
        $('#notice-nav').addClass('show');
        $('#list-notice').addClass('active');
        $('#list-notice').attr('href', 'javascript:void(0)');

        $('.btn-delete').click(function(e){
            e.preventDefault();
            let id = $(this).attr('data-id');
            let url = "{{ asset('/admin/notice') }}/"+id;
            $('#deleteModal form').attr('action', url);
        });

        $('.btn-submit').click(function(e){
            e.preventDefault();
            $('#deleteModal form').submit();
        });
    </script>
@endsection