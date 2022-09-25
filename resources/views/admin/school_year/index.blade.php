@extends('template.admin')

@section('title', 'Năm học')

@section('pagetitle', 'Năm học')

@section('style')
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
                    <div>
                        <form action="" id="change-school-year">
                            @foreach ($schoolYears as $schoolYear)
                                <div class="form-check {{ $schoolYear->status == 1 ? 'radio-active current' : '' }} ">
                                    <input class="form-check-input {{ $schoolYear->status == 1 ? 'default' : '' }}" type="radio" name="school_year" value="{{ $schoolYear->id }}" id="school_year_{{ $schoolYear->id }}" {{ $schoolYear->status == 1 ? 'checked' : '' }}>
                                    <label class="form-check-label" for="school_year_{{ $schoolYear->id }}">
                                        <span>{{ $schoolYear->name}} <small>{{' ('.date('d/m/Y', strtotime($schoolYear->start_time)).' - '.date('d/m/Y', strtotime($schoolYear->end_time)).') ' }} @if($schoolYear->status == 1)<i>- năm học hiện tại</i>@endif &nbsp;<i class="bi bi-pencil-square"></i></small></span>
                                    </label>
                                </div>
                            @endforeach
                            
                        </form>
                        <div type="button" class="fw-bold mt-2 text-primary" data-bs-toggle="modal" data-bs-target="#ModalCreate">
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
@endsection

@section('script')
    <script>
        $('#year-link').removeClass('collapsed');
        $('#year-nav').addClass('show');
        $('#list-year').addClass('active');
        $('#list-year').attr('href', 'javascript:void(0)');
    </script>
    <script>
        
        jQuery.noConflict();
            (function( $ ) {
                $(function() {
                    $('#change-school-year').change(function(e){
                        e.preventDefault();
                        var school_year = $('input[name="school_year"]:checked').val();
                        $('.form-check').removeClass('radio-active');
                        $('#school_year_'+school_year).parent().addClass('radio-active');
                        if(school_year == $('input[name="school_year"].default').val()){
                            return false;
                        }
                        $('#ModalChange').modal('show');
                    }); 

                    $('.btn-confirm-change').click(function(e){
                        alert('Ok');
                    });
                });
        })(jQuery);
        
    </script>
@endsection