var _token = $('meta[name="csrf-token"]').attr('content');

$('.txt-edit').click(function(e){
    e.preventDefault();
    var url = $(this).attr('data-url-edit');
    $('#ModalEdit').attr('data-url', $(this).attr('data-url-update'));
    $.ajax({
        type: 'get',
        url:url,
        data:{
            _token:_token,
        },
        success: function(res){
            $('#ModalEditLabel').html(res.data.info.purpose+' - '+res.data.info.teacher_name);
            var str = '';
            $.each(res.data.rooms, function(prefix, val){
                str += '<div class="form-check">';
                str += '<input class="form-check-input" type="radio" name="room_id" id="room_id_'+val.id+'" value="'+val.id+'">';
                str += '<label class="form-check-label" for="room_id_'+val.id+'">'+val.name+' ('+val.capacity+')</label>';
                str += '</div>';
            });
            $('#ModalEdit #room_edit').html(str);
            $('#ModalEdit #room_edit #room_id_'+res.data.info.room_id).prop('checked', true);
        },
        error: function(err){
            
        }
    });
});

$('.sm-edit').click(function(e){
    e.preventDefault();
    var url = $('#ModalEdit').attr('data-url');
    var room_id = $('#ModalEdit #room_edit input[name="room_id"]:checked').val();
    $.ajax({
        type: 'post',
        url: url,
        data:{
            _token:_token,
            _method:'patch',
            room_id:room_id,
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