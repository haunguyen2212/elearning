@extends('template.admin')

@section('title', 'Năm học')

@section('pagetitle', 'Năm học')

@section('style')
    <link rel="stylesheet" href="{{ asset('backend/assets/vendor/jquery-ui/jquery-ui.min.css') }}">
    <style>
    input[type=radio]:checked {
        background-color: var(--main-color);
        border-color: var(--main-color);
        outline: none;
    }

    .radio-active>label>span{
        font-weight: bold;
        color: var(--main-color);
    }
</style>
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item active">Năm học</li>
@endsection

@section('content')
    <div class="row">
        <div class="col-12 col-md-7">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Danh sách năm học</h5>
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
                    <div>
                        <form action="" id="change-school-year">
                            @foreach ($schoolYears as $schoolYear)
                                <div class="form-check {{ $schoolYear->status == 1 ? 'radio-active current' : '' }} ">
                                    <input class="form-check-input {{ $schoolYear->status == 1 ? 'default' : '' }}" type="radio" name="school_year" value="{{ $schoolYear->id }}" id="school_year_{{ $schoolYear->id }}" {{ $schoolYear->status == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="school_year_{{ $schoolYear->id }}">
                                        <span>{{ $schoolYear->name}} <small>{{' ('.date('d/m/Y', strtotime($schoolYear->start_time)).' - '.date('d/m/Y', strtotime($schoolYear->end_time)).') ' }} @if($schoolYear->status == 1)<i>- năm học hiện tại</i>@endif </small></span><small>
                                    </label>
                                    &nbsp;<i class="bi bi-pencil-square txt-edit" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#ModalEdit" 
                                        style="cursor: pointer"
                                        data-url-edit="{{ route('school_year.edit', $schoolYear->id) }}"
                                        data-url-update="{{ route('school_year.update', $schoolYear->id) }}"
                                        data-url-delete="{{ route('school_year.destroy', $schoolYear->id) }}"
                                        ></i></small>
                                </div>
                            @endforeach
                            <div class="text-danger text_err_id"></div>
                        </form>
                        <div type="button" class="fw-bold mt-2 text-primary txt-create" data-bs-toggle="modal" data-bs-target="#ModalCreate">
                            Thêm năm học
                        </div>   
                        <div class="mt-3">{{ $schoolYears->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.school_year.modal.create')
    @include('admin.school_year.modal.change')
    @include('admin.school_year.modal.edit')
    @include('admin.school_year.modal.delete')
@endsection

@section('script')
    <script>
        $('#year-link').removeClass('collapsed');
        $('#year-nav').addClass('show');
        $('#list-year').addClass('active');
        $('#list-year').attr('href', 'javascript:void(0)');
    </script>
    <script src="{{ asset('backend/assets/vendor/jquery-ui/jquery-ui.min.js') }}"></script>
    <script>
        $("#start_time_create, #end_time_create, #start_time_edit, #end_time_edit").datepicker({
            dateFormat:"dd-mm-yy",
        });
    </script>
    <script src="{{ asset('backend/assets/js/school_year/change.js') }}"></script>
    <script src="{{ asset('backend/assets/js/school_year/create.js') }}"></script>
    <script src="{{ asset('backend/assets/js/school_year/edit.js') }}"></script>
@endsection