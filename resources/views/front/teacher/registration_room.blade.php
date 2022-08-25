@extends('template.master_layout')

@section('title', 'Đăng ký phòng')

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
@endsection

@section('breadcrumb')
     <li class="breadcrumb-item active">Đăng ký phòng</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
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

                    <form action="{{ route('teacher.registration.store') }}" method="post" class="row g-3 px-2">
                    @csrf
                        <div class="col-12">
                            <label for="purpose" class="form-label">Mục đích sử dụng (*)</label>
                            <textarea class="form-control" id="purpose" name="purpose" rows="3">{{ old('purpose') }}</textarea>
                            @error('purpose')
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
                        
                        <div class="text-center my-4 d-flex justify-content-center">
                            <button type="submit" class="btn-main">Đăng ký</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('backend/assets/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
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