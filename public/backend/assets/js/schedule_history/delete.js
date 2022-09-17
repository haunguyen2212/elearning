var _token = $('meta[name="csrf-token"]').attr('content');

$('.txt-delete').click(function(e){
    e.preventDefault();
    var url = $(this).attr('data-url');
    $('#ModalDelete').attr('data-url', url);
});

$('.sm-delete').click(function(e){
    e.preventDefault();
    var url = $('#ModalDelete').attr('data-url');
    $.ajax({
        type: 'delete',
        url: url,
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
    });
});