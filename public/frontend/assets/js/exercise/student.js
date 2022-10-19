let EXERCISE = {};

$(document).ready(function(){
    EXERCISE.init();
});

EXERCISE.init = function(){
   EXERCISE.upload();
   EXERCISE.delete();
}

EXERCISE.upload = function(){
    $('.frm-submit-exercise').change(function(e){
        e.preventDefault();
        $(this).submit();
    })
}

EXERCISE.delete = function(){
    $('.btn-delete-exercise').click(function(e){
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
                    window.location.reload();
                }
            },
            error: function(err){
                
            }
        })
    });
}