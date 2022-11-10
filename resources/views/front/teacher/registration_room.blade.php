@extends('template.master')

@section('title', 'Đăng ký phòng')

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/jquery-ui/timepicker.css') }}">
    <style>
        .ui-timepicker-container{z-index: 1056 !important};
    </style>
@endsection

@section('breadcrumb')
     <li class="breadcrumb-item active">Đăng ký phòng</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-7">
            <div class="card main-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="bd-highlight">
                            <h5 class="card-title">Danh sách đăng ký</h5>
                        </div>
                        <div class="bd-highlight">    
                            <h5 class="card-title">    
                                <form class="d-flex align-items-center">
                                    <span class="fw-bold" style="width: 100px; font-size: 15px">Hiển thị: </span>
                                    <select class="form-select form-select-sm" name="filter" id="filter" onchange="this.form.submit();">
                                        <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>Tất cả</option>
                                        <option value="current" {{ request('filter') == 'current' ? 'selected' : '' }}>Đang diễn ra</option>
                                        <option value="future" {{ request('filter') == 'future' ? 'selected' : '' }}>Sắp diễn ra</option>
                                        <option value="past" {{ request('filter') == 'past' ? 'selected' : '' }}>Đã diễn ra</option>
                                    </select>
                                </form>
                            </h5>
                        </div>
                    </div>
                    @if (session('success_edit'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success_edit') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-hover" style="min-width: 600px">
                            <thead>
                                <tr>
                                    <th width="5%">STT</th>
                                    <th width="15%">Ngày đăng ký</th>
                                    <th width="25%">Nội dung</th>
                                    <th width="15%">Thời gian</th>
                                    <th width="12.5%">Số lượng</th>
                                    <th width="12.5%">Phòng</th>
                                    <th width="15%">Tùy chỉnh</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($myRegistration as $key => $registration)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ date('d/m/Y', strtotime($registration->date)) }}</td>
                                        <td>{{ $registration->purpose }}</td>
                                        <td>{{ date('H:i', strtotime($registration->start_time)).' - '.date('H:i', strtotime($registration->end_time)) }}</td>
                                        <td class="ps-4">{{ $registration->amount }}</td>
                                        <td>
                                            @foreach ($room[$registration->id] as $value)
                                                @if ($value->status == 1)
                                                    <span class="badge bg-success">{{ $value->room_name }}</span>
                                                @elseif ($value->status == 0)
                                                    <span class="badge bg-info">Chưa sắp</span>
                                                @elseif ($value->status == -1)
                                                    <span class="badge bg-danger">Từ chối</span>
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @if ($value->status != 1)
                                                <button class="btn btn-sm btn-warning btn-edit"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#ModalEdit"
                                                data-url="{{ route('teacher.registration.edit', $registration->id) }}"
                                                data-update="{{ route('teacher.registration.update', $registration->id) }}"
                                                ><i class="bi bi-pencil-square"></i></button>
                                                <button class="btn btn-sm btn-danger btn-delete" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#ModalDelete"
                                                data-url="{{ route('teacher.registration.destroy', $registration->id) }}"
                                                ><i class="bi bi-x-lg"></i></button>
                                            @endif       
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-5">
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

    @include('front.teacher.modal.edit')
    @include('front.teacher.modal.delete')
@endsection

@section('script')
    <script src="{{ asset('backend/assets/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('backend/assets/vendor/jquery-ui/timepicker.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/registration/edit_registration.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/registration/delete_registration.js') }}"></script>
    <script>
        $("#date, #date_edit").datepicker({
            dateFormat:"dd-mm-yy",
            minDate: "OD",
            maxDate: "6M"
        });

        $('#start_time, #end_time, #start_time_edit, #end_time_edit').timepicker({
            'timeFormat': 'HH:mm',
            'scrollDefault': 'now',
            'minTime': '7:00am',
            'maxTime': '5:00pm',
            interval: 5,
        });
    </script>
@endsection