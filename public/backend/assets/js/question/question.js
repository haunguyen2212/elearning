let QUESTION = {};
var _token = $('meta[name="csrf-token"]').attr('content');

$(document).ready(function(){
    QUESTION.init();
})

QUESTION.init = function(){
    QUESTION.search();
    QUESTION.create();
    QUESTION.store();
    QUESTION.edit();
    QUESTION.update();
    QUESTION.delete();
}

QUESTION.search = function(){
    $('.btn-search').click(function(e){
        e.preventDefault();
        searchSubmit();
    })

    $('.btn-clear').click(function(e){
        e.preventDefault();
        clearSearch();
    })
}

QUESTION.create = function(){
    $('.btn-create').click(function(e){
        e.preventDefault();
        $('.text-danger').html('');
        var url = $('#ModalCreate').attr('data-url');
        $.ajax({
            type: 'get',
            url:url,
            data:{
                _token:_token,
            },
            success: function(res){
                if(res.status == 1){
                    var str = '<option value="">Chưa chọn môn học</option>';
                    $.each(res.data, function(prefix, val){
                        str += '<option value="'+val.id+'">'+val.name+'</option>';
                    });
                    $('#subject_create').html(str);
                }
            },
            error: function(err){

            }
        })
    })
}

QUESTION.store = function(){
    $('.sm-create').click(function(e){
        e.preventDefault();
        var url = $('#frm-create').attr('action');
        var formData = new FormData($('#frm-create')[0]);
        formData.set('question', CKEDITOR.instances['question_create'].getData());
        formData.set('answer_a', CKEDITOR.instances['answer_a_create'].getData());
        formData.set('answer_b', CKEDITOR.instances['answer_b_create'].getData());
        formData.set('answer_c', CKEDITOR.instances['answer_c_create'].getData());
        formData.set('answer_d', CKEDITOR.instances['answer_d_create'].getData());
        formData.set('explain', CKEDITOR.instances['explain_create'].getData());
        $.ajax({
            type: 'post',
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function(){
                $('.text-danger').html('');
            },
            success: function(res){
                if(res.status == 1){
                    window.location.reload();
                }
            },
            error: function(err){
                var errors = err.responseJSON.errors;
                $.each(errors, function(prefix, val){
                    $('#ModalCreate .err-'+prefix).html(val);
                });
            }
        })
    })
}

QUESTION.edit = function(){
    $('.btn-edit').click(function(e){
        e.preventDefault();
        $('.text-danger').html('');
        var url = $(this).attr('data-url-edit');
        $('#ModalEdit').attr('data-url', $(this).attr('data-url-update'));
        $.ajax({
            type: 'get',
            url: url,
            data:{
                _token:_token,
            },
            success: function(res){
                if(res.status == 1){
                    var str = '<option value="">Chưa chọn môn học</option>';
                    $.each(res.data.subject, function(prefix, val){
                        str += '<option value="'+val.id+'">'+val.name+'</option>';
                    });
                    $('#subject_edit').html(str);
                    var question = res.data.question;
                    if(question.image != null){
                        $('.image-question-edit').attr('src', 'assets/img/question/'+question.image);
                        $('.image-question-edit').show();
                    }
                    $('#subject_edit option[value='+question.subject_id+']').attr('selected','selected');
                    $('#correct_answer'+question.correct_answer).prop("checked", true);
                    $('#level'+question.level).prop("checked", true);
                    $('#shared'+question.shared).prop("checked", true);
                    CKEDITOR.instances['question_edit'].setData(question.question);
                    CKEDITOR.instances['answer_a_edit'].setData(question.answer_a);
                    CKEDITOR.instances['answer_b_edit'].setData(question.answer_b);
                    CKEDITOR.instances['answer_c_edit'].setData(question.answer_c);
                    CKEDITOR.instances['answer_d_edit'].setData(question.answer_d);
                    CKEDITOR.instances['explain_edit'].setData(question.explain);
                }
            },
            error: function(err){

            }
        })
    })
}

QUESTION.update = function(){
    $('.sm-edit').click(function(e){
        e.preventDefault();
        var url = $('#ModalEdit').attr('data-url');
        var formData = new FormData($('#frm-edit')[0]);
        formData.set('question', CKEDITOR.instances['question_edit'].getData());
        formData.set('answer_a', CKEDITOR.instances['answer_a_edit'].getData());
        formData.set('answer_b', CKEDITOR.instances['answer_b_edit'].getData());
        formData.set('answer_c', CKEDITOR.instances['answer_c_edit'].getData());
        formData.set('answer_d', CKEDITOR.instances['answer_d_edit'].getData());
        formData.set('explain', CKEDITOR.instances['explain_edit'].getData());
        $.ajax({
            type: 'post',
            url:url,
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function(){
                $('.text-danger').html('');
            },
            success: function(res){
                if(res.status == 1){
                    window.location.reload();
                }
            },
            error: function(err){
                var errors = err.responseJSON.errors;
                $.each(errors, function(prefix, val){
                    $('#ModalEdit .err-'+prefix).html(val);
                });
            }
        })
    })
}

QUESTION.delete = function(){
    $('.btn-delete').click(function(e){
        e.preventDefault();
        var url = $(this).attr('data-url');
        $('#ModalDelete').attr('data-url', url);
    });

    $('.sm-delete').click(function(e){
        var url = $('#ModalDelete').attr('data-url');
        $.ajax({
            type: 'delete',
            url:url,
            data:{
                _token:_token,
            },
            success: function(res){
                console.log(res);
                if(res.status == 1){
                    window.location.href = url_back;
                }
            },
            error: function(err){

            }
        })
    })
}

function searchSubmit() {
    let params = getDataFilter();
    const url_search = window.location.origin + window.location.pathname;
    if (Object.keys(params).length > 0) {
        window.location.href = url_search + '?' + decodeURI($.param(params));
    } else {
        window.location.href = url_search;
    }
}

function clearSearch(){
    window.location.href = window.location.origin + window.location.pathname;
}

function getDataFilter() {
    let params = {};

    if ($('#keyword').val() != '') {
        Object.assign(params, {'keyword': $("#keyword").val()});
    }

    if ($('#subject :selected').val() != "") {
        Object.assign(params, {'subject': $('#subject :selected').val()});
    }

    if ($('#teacher-name :selected').val() != "") {
        Object.assign(params, {'teacher': $('#teacher-name :selected').val()});
    }

    var level = [];
    $('.level').each(function () {
        if ($(this).is(':checked')) {
            level = level.concat($(this).val());
        }
    })
    if (level.length > 0) {
        Object.assign(params, {'level': level.toString()});
    }

    var shared = [];
    $('.shared').each(function () {
        if ($(this).is(':checked')) {
            shared = shared.concat($(this).val());
        }
    })
    if (shared.length > 0) {
        Object.assign(params, {'shared': shared.toString()});
    }

    return params;
}