$('.btn-edit').click(function(e){
    e.preventDefault();
    var url = $(this).attr('data-url');
    $('#ModalEdit').attr('data-url', $(this).attr('data-update'));
    $.ajax({
        type: 'get',
        url: url,
        data:{
            _token:_token,
        },
        success: function(res){
            if(res.status == 1){
                $('#purpose_edit').text(res.data.purpose);
                $('#amount_edit').val(res.data.amount);
                $('#date_edit').val(formatDateInput(res.data.date));
                $('#start_time_edit').val(formatTimeInput(res.data.start_time));
                $('#end_time_edit').val(formatTimeInput(res.data.end_time));
            }     
        },
        error: function(err){

        }
    })
});

$('.btn-update-submit').click(function(e){
    e.preventDefault();
    var url = $('#ModalEdit').attr('data-url');
    var purpose = $('#purpose_edit').val();
    var date = $('#date_edit').val();
    var amount = $('#amount_edit').val();
    var start_time = $('#start_time_edit').val();
    var end_time = $('#end_time_edit').val();
    $.ajax({
        type: 'post',
        url: url,
        data:{
            _token:_token,
            _method:'put',
            purpose:purpose,
            date:date,
            amount:amount,
            start_time:start_time,
            end_time:end_time,
        },
        beforeSend: function(){
            $('span.txt_error').html('');
        },
        success: function(res){
            if(res.status == 1){
                window.location.reload();
            }
        },
        error: function(err){
            if(err.status == 422){
                $.each(err.responseJSON.errors, function(prefix, val){
                    $('span.txt_'+prefix+'_edit').html(val[0]);
                });
            }
        }
    });
})