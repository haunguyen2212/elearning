var _token = $('meta[name="csrf-token"]').attr('content');

$('.btn-delete').click(function(e){
    e.preventDefault();
    var url = $(this).attr('data-url');
    $('#ModalDelete').attr('data-url', url);
});

$('.btn-confirm-delete').click(function(e){
    e.preventDefault();
    var url = $('#ModalDelete').attr('data-url');
    $.ajax({
        type: 'delete',
        url: url,
        data:{
            _token: _token,
        },
        success: function(res){
            if(res.status == 200){
                window.location.reload();
            }
        }
    })
})