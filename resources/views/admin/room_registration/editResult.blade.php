@extends('template.admin')

@section('title', 'Danh sách đăng ký phòng')

@section('pagetitle', 'Chỉnh sửa kết quả')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('schedule.create') }}">Xếp lịch</a></li>
    <li class="breadcrumb-item"><a href="{{ route('schedule.result.show') }}">Kết quả</a></li>
    <li class="breadcrumb-item active">Chỉnh sửa</li>
@endsection

@php
    $period = session()->get('schedule')['period'];
    $rooms = session()->get('schedule')['rooms'];
    $schedule = session()->get('schedule')['schedule'];
    $deny = session()->get('schedule')['deny'];
@endphp

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="bd-highlight">
                        <h5 class="card-title">Chỉnh sửa kết quả</h5>
                    </div>
                    <div>
                        {{-- <a href="" class="btn btn-sm btn-primary">Chỉnh sửa</a> --}}
                    </div>
                </div>
                
                <div class="table-responsive">
                    <table class="table table-borderless table-bordered" border="1" cellpadding="0" cellspacing="0">
                        <thead>
                            <tr align="center">
                                <th></th>
                                @foreach ($period as $date)
                                    <th>{{ date('d/m/Y', strtotime($date)) }} </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rooms as $room_index => $room)
                                    <tr align="center">
                                        <th style="vertical-align: middle">{{ $room['name'].' ('.$room['capacity'].')' }}</th>
                                        @foreach ($period as $date_index => $date)
                                            <td class="block-date" data-date="{{ date('Y-m-d', strtotime($date)) }}">
                                                @foreach ($schedule[$date_index][$room_index] as $value)
                                                <div class="block-room" data-room="{{ $room['id'] }}">
                                                    <p class="item" 
                                                        data-id="{{ $value['id'] }}" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#EditSchedule"
                                                        style="cursor: pointer"
                                                    >
                                                        <strong>{{ date('H:i', strtotime($value['start_time'])) .' - '. date('H:i', strtotime($value['end_time']))  }}</strong>
                                                        <br><span>{{ $value['purpose'] }}</span>
                                                        <br><span>{{ $value['teacher_name'] }}</span>
                                                        <br><span>Số lượng: {{ $value['amount'] }}</span>
                                                    </p>
                                                </div>      
                                                @endforeach
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                                {{-- <tr align="center" style="background-color: #F5F5F5">
                                    <th style="vertical-align: middle">Bị từ chối</th>
                                    @foreach ($period as $date_index => $date)
                                        <td>
                                            @foreach ($deny[$date_index] as $value)
                                                <p>
                                                    <strong>{{ date('H:i', strtotime($value['start_time'])) .' - '. date('H:i', strtotime($value['end_time']))  }}</strong>
                                                    <br><span>{{ $value['purpose'] }}</span>
                                                    <br><span>{{ $value['teacher_name'] }}</span>
                                                    <br><span>Số lượng: {{ $value['amount'] }}</span>
                                                </p>
                                            @endforeach
                                        </td>
                                    @endforeach
                                </tr> --}}
                        </tbody>
                    </table>
                </div>

                @if (isset($have_deny) && $have_deny)
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Nội dung đăng ký</th>
                                    <th>Ngày</th>
                                    <th>Thời gian</th>
                                    <th>Giáo viên</th>
                                    <th>Số lượng</th>
                                    <th>Sắp phòng</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($period as $date_index => $date)
                                    @foreach ($deny[$date_index] as $key => $value)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $value['purpose'] }}</td>
                                            <td>{{ date('d/m/Y', strtotime($value['date'])) }}</td>
                                            <td>{{ date('H:i', strtotime($value['start_time'])) .' - '. date('H:i', strtotime($value['end_time']))  }}</td>
                                            <td>{{ $value['teacher_name'] }}</td>
                                            <td>{{ $value['amount'] }}</td>
                                            <td><button class="btn btn-sm text-main item" data-id="{{ $value['id'] }}" data-bs-toggle="modal" data-bs-target="#EditSchedule"><i class="bi bi-pencil-square"></i></button></td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                

            </div>
        </div>
    </div>
</div>
@include('admin.room_registration.modal.editSchedule')
@endsection

@section('script')
    <script>
        $('#room-registration-link').removeClass('collapsed');
        $('#room-registration-nav').addClass('show');
        $('#list-schedule').addClass('active');
        $('#list-schedule').attr('href', 'javascript:void(0)');
    </script>
    <script>
        var url = '{{ route('schedule.result.get') }}';
    </script>
    <script src="{{ asset('backend/assets/js/schedule/edit_result.js') }}"></script>
@endsection