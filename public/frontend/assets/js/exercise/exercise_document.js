let EXERCISE_DOCUMENT = {};

$(document).ready(function(){
    EXERCISE_DOCUMENT.init();
})

EXERCISE_DOCUMENT.init = function(){
    EXERCISE_DOCUMENT.upload();
    EXERCISE_DOCUMENT.delete();
}

EXERCISE_DOCUMENT.upload = function(){
    $('.frm-submit-exercise-document').change(function(e){
        e.preventDefault();
        $(this).submit();
    })
}

EXERCISE_DOCUMENT.delete = function(){
    $('.btn-delete-exercise-document').click(function(e){
        e.preventDefault();
        var url = $(this).attr('data-url');
        $('#ModalDeleteExerciseDocument').attr('data-url', url);
    });

    $('.btn-confirm-delete-exercise-document').click(function(e){
        e.preventDefault();
        var url = $('#ModalDeleteExerciseDocument').attr('data-url');
        $.ajax({
            type: 'delete',
            url:url,
            data:{
                _token:_token,
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