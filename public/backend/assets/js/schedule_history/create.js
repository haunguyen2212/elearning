var _token = $('meta[name="csrf-token"]').attr('content');

$('.txt-create').click(function(e){
    e.preventDefault();
    $('#ModalCreate .text-danger').html('');
    $('#err-msg-create').html('');
    var url = $(this).attr('data-url');
    var room_id = $(this).attr('data-room-id');
    var room_name = $(this).attr('data-room-name');
    var date = $(this).attr('data-date');
    $('#ModalCreate #ModalCreateLabel').html('Thêm mới ngày '+formatDateShow(date)+' - '+room_name);
    $('#ModalCreate #date_create').val(formatDateInput(date));
    $('#ModalCreate #room_id_create').val(room_id);
    $.ajax({
        type: 'get',
        url: url,
        data:{
            _token:_token,
        },
        success: function(res){
            if(res.status == 1){
                var str = '<option value="">Chọn giáo viên</option>';
                $.each(res.data, function(prefix, val){
                    str += '<option value="'+val.id+'">'+val.name+'</option>';
                });
                $('#ModalCreate #teacher_id_create').html(str);
            }
        },
        error: function(err){

        }
    })
});

$('.sm-create').click(function(e){
    e.preventDefault();
    var url = $('#ModalCreate').attr('data-url');
    var purpose = $('#ModalCreate #purpose_create').val();
    var room_id = $('#ModalCreate #room_id_create').val();
    var date = $('#ModalCreate #date_create').val();
    var amount = $('#ModalCreate #amount_create').val();
    var start_time = $('#ModalCreate #start_time_create').val();
    var end_time = $('#ModalCreate #end_time_create').val();
    var teacher_id = $('#ModalCreate #teacher_id_create').find(":selected").val();
    $.ajax({
        type: 'post',
        url: url,
        data:{
            _token:_token,
            purpose:purpose,
            room_id:room_id,
            date:date,
            amount:amount,
            start_time:start_time,
            end_time:end_time,
            teacher_id:teacher_id,
        },
        beforeSend: function(){
            $('#ModalCreate .text-danger').html('');
        },
        success: function(res){
            console.log(res);
            if(res.status == 1){
                window.location.reload();
            }
            if(res.status == 0){
                if(typeof res.message !== 'undefined'){
                    console.log(res.message);
                    $('#err-msg-create').html(res.message);
                }
            }
        },
        error: function(err){
            var errors = err.responseJSON.errors;
            $.each(errors, function(prefix, val){
                $('#ModalCreate .err-'+prefix).html(val);
            });
        }
    });
})