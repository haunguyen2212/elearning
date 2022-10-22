let EXERCISE = {};

$(document).ready(function(){
    EXERCISE.init();
})

EXERCISE.init = function(){
    EXERCISE.create();
    EXERCISE.store();
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