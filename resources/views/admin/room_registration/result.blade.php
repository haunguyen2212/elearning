@extends('template.admin')

@section('title', 'Xếp lịch')

@section('pagetitle', 'Kết quả xếp lịch')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('schedule.create') }}">Xếp lịch</a></li>
    <li class="breadcrumb-item active">Kết quả</li>
@endsection

@php
    $period = session()->get('schedule')['period'];
    $rooms = session()->get('schedule')['rooms'];
    $schedule = session()->get('schedule')['schedule'];
    $deny = session()->get('schedule')['deny'];
    $start_date = date('Y-m-d', strtotime($period[0]));
    $end_date = date('Y-m-d', strtotime($period[count($period)-1]));
@endphp

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="bd-highlight">
                            <h5 class="card-title">Kết quả xếp lịch</h5>
                        </div>
                        <div>
                            <a href="{{ route('schedule.view.edit').'?start='.$start_date.'&end='.$end_date }}" class="btn btn-sm btn-main"><i class="bi bi-pencil-square"></i> Chỉnh sửa</a>
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
                                            <td>
                                                @foreach ($schedule[$date_index][$room_index] as $value)
                                                    <p>
                                                        <strong>{{ date('H:i', strtotime($value['start_time'])) .' - '. date('H:i', strtotime($value['end_time']))  }}</strong>
                                                        <br><span>{{ $value['purpose'] }}</span>
                                                        <br><span>{{ $value['teacher_name'] }}</span>
                                                        <br><span>Số lượng: {{ $value['amount'] }}</span>
                                                    </p>
                                                @endforeach
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                                <tr align="center" style="background-color: #F5F5F5">
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
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <form action="" method="post" id="download-doc">
                        @csrf
                        <input type="hidden" name="content" id="content-download">
                        <button type="button" class="btn btn-sm btn-main btn-download"><i class="bi bi-download"></i> Tải về máy</button>
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
        $('#list-schedule').addClass('active');
        $('#list-schedule').attr('href', 'javascript:void(0)');
    </script>
    <script>
        $('.btn-download').click(function(e){
            e.preventDefault();
            content = $('.table-responsive').html();
            url = '{{ route('schedule.download.docx') }}';
            $('#download-doc').attr('action', url);
            $('#content-download').val(content);
            $(this).attr('type', 'submit');
            $('#download-doc').submit();
        });
    </script>
@endsection