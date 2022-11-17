let TAKE_QUIZ = {};

$(document).ready(function(){
    TAKE_QUIZ.init();
})

TAKE_QUIZ.init = function(){
    $('.question-exam').change(function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        var answer = $('input[name=question-'+id+']:checked').val();
        $.ajax({
            type: 'post',
            url: url_submit_question,
            data:{
                _token:_token,
                question_id:id,
                answer:answer,
            },
            success: function(res){
                
            },
            error: function(err){

            }
        })
    })
}