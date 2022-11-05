let EXERCISE = {};

$(document).ready(function(){
    EXERCISE.init();
})

EXERCISE.init = function(){
    EXERCISE.create();
    EXERCISE.store();
    EXERCISE.hide();
    EXERCISE.show();
    EXERCISE.delete();
    EXERCISE.edit();
    EXERCISE.update();
    EXERCISE.editScore();
    EXERCISE.updateScore();
}

EXERCISE.create = function(){
    $('.add-exercise').click(function(e){
        e.preventDefault();
        $('.txt_error').html('');
        var url = $(this).attr('data-url');
        $('#ModalCreateExercise').attr('data-url', url);
    })
}

EXERCISE.store = function(){
    $('.btn-store-exercise').click(function(e){
        e.preventDefault();
        var url = $('#ModalCreateExercise').attr('data-url');
        var name = $('#ModalCreateExercise #name_exercise_create').val();
        var content = CKEDITOR.instances['content_exercise_create'].getData();
        var expiration_date = $('#ModalCreateExercise #expiration_date_exercise_create').val();
        $.ajax({
            type: 'post',
            url:url,
            data:{
                _token:_token,
                name:name,
                content:content,
                expiration_date:expiration_date,
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
                    $('#ModalCreateExercise .txt_'+prefix).html(val);
                });
            }
        })
    })
}

EXERCISE.hide = function(){
    $('.hide-exercise').click(function(e){
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

EXERCISE.show = function(){
    $('.show-exercise').click(function(e){
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

EXERCISE.delete = function(){
    $('.delete-exercise').click(function(e){
        e.preventDefault();
        var url = $(this).attr('data-url');
        $('#ModalDeleteExercise').attr('data-url', url);
    });

    $('.btn-confirm-delete-exercise').click(function(e){
        e.preventDefault();
        var url = $('#ModalDeleteExercise').attr('data-url');
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

EXERCISE.edit = function(){
    $('.edit-exercise').click(function(e){
        e.preventDefault();
        $('.txt_error').html('');
        var url = $(this).attr('data-url');
        $('#ModalEditExercise').attr('data-url', url);
        $.ajax({
            type: 'get',
            url:url,
            data:{
                _token:_token,
            },
            success: function(res){
                if(res.status == 1){
                    $('#ModalEditExercise #name_exercise_edit').val(res.data.name);
                    $('#ModalEditExercise #expiration_date_exercise_edit').val(formatDateTimeMinusSecond(res.data.expiration_date));
                    CKEDITOR.instances['content_exercise_edit'].setData(res.data.content);
                }
            },
            error: function(err){

            }
        })
    })
}

EXERCISE.update = function(){
    $('.btn-update-exercise').click(function(e){
        e.preventDefault();
        var url = $('#ModalEditExercise').attr('data-url');
        var name = $('#ModalEditExercise #name_exercise_edit').val();
        var expiration_date = $('#ModalEditExercise #expiration_date_exercise_edit').val();
        var content = CKEDITOR.instances['content_exercise_edit'].getData();
        $.ajax({
            type: 'post',
            url:url,
            data:{
                _token:_token,
                _method:'put',
                name:name,
                expiration_date:expiration_date,
                content:content,
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
                    $('#ModalEditExercise .txt_'+prefix).html(val);
                });
            }
        })
    })
}

EXERCISE.editScore = function(){
    $('.edit-score').click(function(e){
        e.preventDefault();
       $(this).removeAttr('readonly');
    })
}

EXERCISE.updateScore = function(){
    $('.edit-score').change(function(e){
        var url = $(this).attr('data-url');
        var score = $(this).val();
        if(score < 0 || score > 10){
            $(this).addClass('error');
        }
        else{
            $(this).removeClass('error');
        }
        $.ajax({
            type: 'post',
            url:url,
            data:{
                _token:_token,
                _method:'patch',
                score:score,
            },
            success: function(res){
                console.log(res);
            },
            error: function(err){

            }
        })
    })
}