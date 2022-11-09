let QUESTION = {};

$(document).ready(function(){
    QUESTION.init();
})

QUESTION.init = function(){
    QUESTION.choose();
    QUESTION.saveChange();
}

QUESTION.choose = function(){
    $('#frm-choose-question').change(function(){
        var count = $('input[name="question_check[]"]:checked').length;
        $('.count-question').html(count);
    })
}

QUESTION.saveChange = function(){
    $('.save-change').click(function(e){
        e.preventDefault();
        var url = $(this).attr('data-url');
        var ids = $('input[name="question_check[]"]:checked').map(function () {
            return $(this).val();
        }).get();
        $.ajax({
            type: 'post',
            url:url,
            data:{
                _token:_token,
                ids:ids,
            },
            success: function(res){
                if(res.status == 1){
                    window.location.href = window.location.href;
                }
            },
            error: function(err){

            }
        })
    })
}