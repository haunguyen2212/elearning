@extends('template.admin')

@section('title', 'Danh sách đăng ký phòng')

@section('pagetitle', 'Danh sách đăng ký phòng')

@section('breadcrumb')
    <li class="breadcrumb-item active">Danh sách đăng ký</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="bd-highlight">
                            <h5 class="card-title">Danh sách đăng ký</h5>
                        </div>
                        <div class="bd-highlight">
                            <form class="d-flex align-items-center">
                                <span class="fw-bold" style="width: 150px">Hiển thị: </span>
                                <select class="form-select-sm form-select" name="filter" id="filter" onchange="this.form.submit();">
                                    <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>Tất cả</option>
                                    <option value="non" {{ request('filter') == 'non' ? 'selected' : '' }}>Chưa xếp</option>
                                    <option value="current" {{ request('filter') == 'current' ? 'selected' : '' }}>Tuần này</option>
                                    <option value="next" {{ request('filter') == 'next' ? 'selected' : '' }}>Tuần sau</option>
                                </select>
                            </form>
                        </div>
                    </div>
                    
                    
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                              <tr>
                                <th>STT</th>
                                <th>Ngày</th>
                                <th>Nội dung</th>
                                <th>Thời gian</th>
                                <th>Số lượng</th>
                                <th>Người đăng ký</th>
                                <th>Thời gian đăng ký</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($list_registration as $key => $registration)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ date('d/m/Y', strtotime($registration->date)) }}</td>
                                        <td>{{ $registration->purpose }}</td>
                                        <td>{{ date('H:i', strtotime($registration->start_time)).' - '.date('H:i', strtotime($registration->end_time)) }}</td>
                                        <td>{{ $registration->amount }}</td>
                                        <td>{{ $registration->teacher_name }}</td>
                                        <td>{{ date('d/m/Y H:i', strtotime($registration->updated_at)) }}</td>
                                    </tr>
                                @endforeach 
                            </tbody>
                          </table>  
                    </div>
                    {{ $list_registration->links() }}
                </div>
                
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $('#room-registration-link').removeClass('collapsed');
        $('#room-registration-nav').addClass('show');
        $('#list-registration').addClass('active');
        $('#list-registration').attr('href', 'javascript:void(0)');
    </script>
@endsection