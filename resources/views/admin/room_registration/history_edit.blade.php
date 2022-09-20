@extends('template.admin')

@section('title', 'Chỉnh sửa lịch')

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/jquery-ui/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/jquery-ui/timepicker.css') }}">
    <style>
        .ui-timepicker-container{z-index: 1056 !important};
    </style>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('schedule.view.index').'?start='.$start_date.'&end='.$end_date }}">Lịch sử dụng phòng</a></li>
    <li class="breadcrumb-item active">Chỉnh sửa</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="bd-highlight">
                            <h5 class="card-title">Chỉnh sửa lịch</h5>
                        </div>
                    </div>

                    @if ($deny->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped" style="min-width: 1000px">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Ngày</th>
                                        <th>Nội dung</th>
                                        <th>Thời gian</th>
                                        <th>Số lượng</th>
                                        <th>Người đăng ký</th>
                                        <th>Trạng thái</th>
                                        <th>Tùy chỉnh</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach ($deny as $key => $value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ date('d/m/Y', strtotime($value->date)) }}</td>
                                            <td>{{ $value->purpose }}</td>
                                            <td>{{ date('H:i', strtotime($value->start_time)).' - '.date('H:i', strtotime($value->end_time)) }}</td>
                                            <td>{{ $value->amount }}</td>
                                            <td>{{ $value->teacher_name }}</td>
                                            <td>
                                                @if ($value->status == 0)
                                                    <span class="badge bg-warning">Chưa sắp</span>
                                                @else
                                                    <span class="badge bg-danger">Từ chối</span>
                                                @endif
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-main ms-3 txt-assign"
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#ModalAssign"
                                                        data-url-edit="{{ route('schedule_edit.assign.edit', $value->id) }}"
                                                        data-url-update="{{ route('schedule_edit.assign.update', $value->id) }}"
                                                >
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>    
                        <h5 class="card-title">Lịch sử dụng phòng</h5>     
                    @endif

                    <div class="table-responsive">
                        <table class="table table-borderless table-bordered" border="1" cellpadding="0" cellspacing="0">
                            <thead>
                                <tr align="center">
                                    <th></th>
                                    @foreach ($periods as $date)
                                        <th>{{ date('d/m/Y', strtotime($date)) }} </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rooms as $room_index => $room)
                                    <tr align="center">
                                        <th style="vertical-align: middle">{{ $room['name'].' ('.$room['capacity'].')' }}</th>
                                        @foreach ($periods as $date_index => $date)
                                            <td>
                                                @foreach ($schedule[date('Y-m-d', strtotime($date))] as $value)
                                                    @if ($value->room_id == $room['id'])
                                                        <p style="background: #F5F5F5; border-radius: 3px">
                                                            <strong>{{ date('H:i', strtotime($value->start_time)) .' - '. date('H:i', strtotime($value->end_time))  }}</strong>
                                                            <br><span>{{ $value->purpose }}</span>
                                                            <br><span>{{ $value->teacher_name }}</span>
                                                            <br><span>Số lượng: {{ $value->amount }}</span>
                                                            <br><span>
                                                                <small class="text-warning fw-bold txt-edit" 
                                                                    style="cursor: pointer"
                                                                    data-bs-toggle="modal" 
                                                                    data-bs-target="#ModalEdit"
                                                                    data-url-edit="{{ route('schedule_edit.edit', $value->assignment_id) }}"
                                                                    data-url-update="{{ route('schedule_edit.update', $value->assignment_id) }}"
                                                                >[Sửa]</small>
                                                                <small class="text-danger fw-bold txt-delete" 
                                                                    style="cursor: pointer"
                                                                    data-bs-toggle="modal" 
                                                                    data-bs-target="#ModalDelete"
                                                                    data-url="{{ route('schedule_edit.destroy', $value->assignment_id) }}"
                                                                >
                                                                [Xóa]
                                                                </small>
                                                            </span>
                                                        </p>
                                                    @endif
                                                    
                                                @endforeach
                                                <small class="text-primary fw-bold txt-create" 
                                                        style="cursor: pointer"
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#ModalCreate"
                                                        data-room-id="{{ $room['id'] }}"
                                                        data-room-name="{{ $room['name'] }}"
                                                        data-date="{{ date('Y-m-d', strtotime($date)) }}"
                                                        data-url="{{ route('schedule_edit.create') }}"
                                                    >[Thêm]</small>
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.room_registration.modal.history_create')
    @include('admin.room_registration.modal.history_edit')
    @include('admin.room_registration.modal.history_delete')
    @include('admin.room_registration.modal.history_assign')
@endsection

@section('script')
    <script>
        $('#room-registration-link').removeClass('collapsed');
        $('#room-registration-nav').addClass('show');
        $('#history-schedule').addClass('active');
    </script>
    <script src="{{ asset('backend/assets/vendor/jquery-ui/timepicker.js') }}"></script>
    <script>

        $('#start_time_create, #end_time_create').timepicker({
            'timeFormat': 'HH:mm',
            'scrollDefault': 'now',
            'minTime': '7:00am',
            'maxTime': '5:00pm',
            interval: 5,
        });
    </script>
    <script src="{{ asset('backend/assets/js/schedule_history/create.js') }}"></script>
    <script src="{{ asset('backend/assets/js/schedule_history/edit.js') }}"></script>
    <script src="{{ asset('backend/assets/js/schedule_history/delete.js') }}"></script>
    <script src="{{ asset('backend/assets/js/schedule_history/assign.js') }}"></script>
@endsection

