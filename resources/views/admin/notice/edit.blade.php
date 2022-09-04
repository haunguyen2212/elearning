@extends('template.admin')

@section('title', 'Chỉnh sửa thông báo')

@section('pagetitle', 'Chỉnh sửa thông báo')

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/jquery-ui/datetimepicker.css') }}" />
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('notice.index') }}">Thông báo</a></li>
    <li class="breadcrumb-item active">Chỉnh sửa</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Chỉnh sửa thông báo</h5>

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

                    <form action="{{ route('notice.update', ['notice' => $notice->id]) }}" method="post" class="row g-3" enctype="multipart/form-data">
                      @csrf
                      @method('put')

                        <div class="col-12">
                          <label for="name" class="form-label">Nội dung (*)</label>
                          <input type="text" class="form-control" name="name" id="name" value="{{ old('name') ?? $notice->name }}">
                          @error('name')
                            <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                          @enderror
                        </div>

                        <div class="col-12">
                            <label for="link" class="form-label">Link (*)</label>
                            <input type="file" class="form-control" name="link" id="link">
                            @if ($notice->link)
                                <div class="mt-1 cur-file"><a href="{{ asset('backend/assets/document/notices').'/'.$notice->link }}"><i class="bi bi-file-earmark"></i> {{ $notice->link }}</a></div> 
                            @endif
                            @error('link')
                              <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="start_time" class="form-label">Từ ngày (*)</label>
                            <input type="text" class="form-control" name="start_time" id="start_time" value="{{ old('start_time') ?? (date('d-m-Y H:i:s', strtotime($notice->start_time))) }}">
                            @error('start_time')
                              <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="end_time" class="form-label">Đến ngày (*)</label>
                            <input type="text" class="form-control" name="end_time" id="end_time" value="{{ old('end_time') ?? (date('d-m-Y H:i:s', strtotime($notice->end_time))) }}">
                            @error('end_time')
                              <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                            @enderror
                        </div>
                        
                        <div class="text-center mt-4">
                          <button type="submit" class="btn btn-sm btn-primary">Cập nhật</button>
                          <a href="{{ route('notice.index') }}" class="btn btn-sm btn-danger">Trở về</a>
                        </div>
                      </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#notice-nav').addClass('show');
            $('#notice-link').removeClass('collapsed');
            $('#list-notice').addClass('active');
            $('#link').change(function(){
                $('.cur-file').hide();
            });
        });
    </script>
    <script src="{{ asset('backend/assets/vendor/jquery-ui/datetimepicker.js') }}" ></script>
    <script>

        $('#start_time, #end_time').datetimepicker({
            format: 'd-m-Y H:i:s',
            step: 15
        });
    </script>
@endsection