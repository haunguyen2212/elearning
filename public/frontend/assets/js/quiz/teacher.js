let QUIZ = {};

$(document).ready(function(){
    QUIZ.init();
})

QUIZ.init = function(){
    QUIZ.create();
    QUIZ.store();
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