@extends('template.admin')

@section('title', 'Xếp lịch')

@section('pagetitle', 'Xếp lịch')

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/jquery-ui/jquery-ui.min.css') }}">
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active">Xếp lịch</li>
@endsection

@php
    $now = \Carbon\Carbon::now();
    $nextWeek = $now->addWeek();
    $nextWeekStartDate = $nextWeek->startOfWeek()->format('d-m-Y');
    $nextWeekEndDate = $nextWeek->endOfWeek()->format('d-m-Y');
@endphp

@section('content')
    <div class="row">
        <div class="col-12 col-md-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Gợi ý xếp lịch</h5>

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

                    <form action="{{ route('schedule.handle') }}" method="post" class="row g-3">
                        @csrf

                        <div class="col-12">
                            <label for="from_date" class="form-label">Từ ngày</label>
                            <input type="text" class="form-control" name="from_date" id="from_date" value="{{ old('from_date') ?? $nextWeekStartDate }}">
                            @error('from_date')
                                <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="to_date" class="form-label">Đến ngày</label>
                            <input type="text" class="form-control" name="to_date" id="to_date" value="{{ old('to_date') ?? $nextWeekEndDate }}">
                            @error('to_date')
                                <div class="text-danger ps-1 pt-1">{!! $message !!}</div>
                            @enderror
                        </div>
                        
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-sm btn-main">Xếp lịch</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="{{ asset('backend/assets/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
    $('#room-registration-link').removeClass('collapsed');
    $('#room-registration-nav').addClass('show');
    $('#list-schedule').addClass('active');
    $('#list-schedule').attr('href', 'javascript:void(0)');

    $("#from_date").datepicker({
        dateFormat:"dd-mm-yy",
        minDate: "OD",
        maxDate: "6M"
    });

    $("#to_date").datepicker({
        dateFormat:"dd-mm-yy",
        minDate: "OD",
        maxDate: "6M"
    });

</script>
@endsection