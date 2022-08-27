@extends('template.admin')

@section('title', 'Đăng ký phòng')

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/jquery-ui/timepicker.css') }}">
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active">Đăng ký phòng</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-7">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Đăng ký sử dụng phòng</h5>

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

                    <form action="{{ route('admin.registration.store') }}" method="post" class="row g-3 px-2">
                    @csrf
                        <div class="col-12 col-md-6">
                            <label for="purpose" class="form-label">Mục đích sử dụng (*)</label>
                            <input type="text" class="form-control" id="purpose" name="purpose" value="{{ old('purpose') }}">
                            @error('purpose')
                                <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="teacher_id" class="form-label">Người đăng ký (*)</label>
                            <select class="form-select" id="teacher_id" name="teacher_id">
                                <option selected>Chọn tên giáo viên</option>
                                @foreach ($teachers as $teacher)
                                    <option value="{{ $teacher->id }}" {{ old('teacher_id') == $teacher->id ? 'selected' : '' }}>{{ $teacher->name }}</option>
                                @endforeach
                            </select>
                            @error('teacher_id')
                                <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="amount" class="form-label">Số người tham gia (*)</label>
                            <input type="number" class="form-control" name="amount" id="amount" value="{{ old('amount') }}">
                            @error('amount')
                                <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="date" class="form-label">Ngày sử dụng (*)</label>
                            <input type="text" class="form-control" name="date" id="date" value="{{ old('date') }}" autocomplete="off">
                            @error('date')
                                <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="start_time" class="form-label">Thời gian bắt đầu (*)</label>
                            <input type="text" class="form-control" name="start_time" id="start_time" value="{{ old('start_time') }}" autocomplete="off">
                            @error('start_time')
                                <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="end_time" class="form-label">Thời gian kết thúc (*)</label>
                            <input type="text" class="form-control" name="end_time" id="end_time" value="{{ old('end_time') }}" autocomplete="off">
                            @error('end_time')
                                <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                            @enderror
                        </div>
                        
                        <div class="text-center mt-4 d-flex justify-content-center">
                            <button type="submit" class="btn btn-sm btn-main">Đăng ký</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#room-registration-link').removeClass('collapsed');
        $('#room-registration-nav').addClass('show');
        $('#create-registration').addClass('active');
        $('#create-registration').attr('href', 'javascript:void(0)');
    </script>
    <script src="{{ asset('backend/assets/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/jquery-ui/timepicker.js') }}"></script>
    <script>
        $("#date").datepicker({
            dateFormat:"dd-mm-yy",
            minDate: "OD",
            maxDate: "6M"
        });

        $('#start_time, #end_time').timepicker({
            'timeFormat': 'HH:mm',
            'scrollDefault': 'now',
            'minTime': '7:00am',
            'maxTime': '5:00pm',
            interval: 5,
        });
    </script>
@endsection