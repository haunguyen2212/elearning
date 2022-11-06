let QUIZ = {};

$(document).ready(function(){
    QUIZ.init();
})

QUIZ.init = function(){
    QUIZ.create();
    QUIZ.store();
    QUIZ.hide();
    QUIZ.show();
    QUIZ.edit();
    QUIZ.update();
    QUIZ.delete();
}

QUIZ.create = function(){
    $('.add-quiz').click(function(e){
        e.preventDefault();
        $('.txt_error').html('');
        var url = $(this).attr('data-url');
        $('#ModalCreateQuiz').attr('data-url', url);
    })
}

QUIZ.store = function(){
    $('.btn-store-quiz').click(function(e){
        e.preventDefault();
        var url = $('#ModalCreateQuiz').attr('data-url');
        var name = $('#ModalCreateQuiz #name_quiz_create').val();
        var duration = $('#ModalCreateQuiz #duration_quiz_create').val();
        var start_time = $('#ModalCreateQuiz #start_time_quiz_create').val();
        var end_time = $('#ModalCreateQuiz #end_time_quiz_create').val();
        var password = $('#ModalCreateQuiz #password_quiz_create').val();
        var is_show = $('#ModalCreateQuiz input[name="is_show"]').is(":checked") ? '1' : '0';
        var maximum = $('#ModalCreateQuiz #maximum_quiz_create').val();
        $.ajax({
            type: 'post',
            url:url,
            data:{
                _token:_token,
                name:name,
                duration:duration,
                start_time:start_time,
                end_time:end_time,
                password:password,
                is_show:is_show,
                maximum:maximum,
            },
            beforeSend: function(){
                $('.txt_error').html('');
            },
            success: function(res){
                console.log(res);
                if(res.status == 1){
                    window.location.href = res.data;
                }
            },
            error: function(err){
                var errors = err.responseJSON.errors;
                $.each(errors, function(prefix, val){
                    $('#ModalCreateQuiz .txt_'+prefix).html(val);
                });
            }
        })
    })
}

QUIZ.hide = function(){
    $('.hide-quiz').click(function(e){
        e.preventDefault();
        var url = $(this).attr('data-url');
        $.ajax({
            type: 'post',
            url:url,
            data:{
                _token:_token,
                _method:'patch',
            },
            success: function(res){
                if(res.status == 1){
                    window.location.reload();
                }
            },
            error: function(err){

            }
        })
    })
}

QUIZ.show = function(){
    $('.show-quiz').click(function(e){
        e.preventDefault();
        var url = $(this).attr('data-url');
        $.ajax({
            type: 'post',
            url:url,
            data:{
                _token:_token,
                _method:'patch',
            },
            success: function(res){
                if(res.status == 1){
                    window.location.reload();
                }
            },
            error: function(err){
                
            }
        })
    })
}

QUIZ.edit = function(){
    $('.edit-quiz').click(function(e){
        e.preventDefault();
        $('.txt_error').html('');
        var url = $(this).attr('data-url');
        $('#ModalEditQuiz').attr('data-url', url);
        $.ajax({
            type: 'get',
            url:url,
            data:{
                _token:_token,
            },
            success: function(res){
                if(res.status == 1){
                    $('#ModalEditQuiz #name_quiz_edit').val(res.data.name);
                    $('#ModalEditQuiz #start_time_quiz_edit').val(formatDateTimeMinusSecond(res.data.start_time));
                    $('#ModalEditQuiz #end_time_quiz_edit').val(formatDateTimeMinusSecond(res.data.end_time));
                    $('#ModalEditQuiz #duration_quiz_edit').val(res.data.duration);
                    $('#ModalEditQuiz #password_quiz_edit').val(res.data.password);
                    $('#ModalEditQuiz #maximum_quiz_edit').val(res.data.maximum);
                }
            },
            error: function(err){

            }
        })
    })
}

QUIZ.update = function(){
    $('.btn-update-quiz').click(function(e){
        e.preventDefault();
        var url = $('#ModalEditQuiz').attr('data-url');
        var name = $('#ModalEditQuiz #name_quiz_edit').val();
        var start_time = $('#ModalEditQuiz #start_time_quiz_edit').val();
        var end_time =  $('#ModalEditQuiz #end_time_quiz_edit').val();
        var duration =  $('#ModalEditQuiz #duration_quiz_edit').val();
        var password = $('#ModalEditQuiz #password_quiz_edit').val();
        var maximum = $('#ModalEditQuiz #maximum_quiz_edit').val();
        $.ajax({
            type: 'post',
            url:url,
            data:{
                _token:_token,
                _method:'patch',
                name:name,
                start_time:start_time,
                end_time:end_time,
                duration:duration,
                password:password,
                maximum:maximum,
            },
            beforeSend: function(){
                $('.txt_error').html('');
            },
            success: function(res){
                if(res.status == 1){
                    window.location.reload();
                }
            },
            error: function(err){
                var errors = err.responseJSON.errors;
                $.each(errors, function(prefix, val){
                    $('#ModalEditQuiz .txt_'+prefix).html(val);
                });
            }
        })
    })
}

QUIZ.delete = function(){
    $('.delete-quiz').click(function(e){
        e.preventDefault();
        var url = $(this).attr('data-url');
        $('#ModalDeleteQuiz').attr('data-url', url);
    });

    $('.btn-confirm-delete-quiz').click(function(e){
        e.preventDefault();
        var url = $('#ModalDeleteQuiz').attr('data-url');
        $.ajax({
            type: 'delete',
            url:url,
            data:{
                _token:_token,
            },
            success: function(res){
                if(res.status == 1){
                    if(typeof url_previous === 'undefined'){
                        window.location.reload();
                    }
                    else{
                        window.location.href = url_previous;
                    }
                }
            },
            error: function(err){
                
            }
        })
    })
}