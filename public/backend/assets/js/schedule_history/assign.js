var _token = $('meta[name="csrf-token"]').attr('content');

$('.txt-assign').click(function(e){
    e.preventDefault();
    var url = $(this).attr('data-url-edit');
    $('#ModalAssign').attr('data-url', $(this).attr('data-url-update'));
    $.ajax({
        type: 'get',
        url:url,
        data:{
            _token,_token,
        },
        success: function(res){
            if(res.status == 1){
                $('#ModalAssignLabel').html(res.data.info.purpose+' - '+res.data.info.teacher_name);
                var str = '';
                $.each(res.data.rooms, function(prefix, val){
                    str += '<div class="form-check">';
                    str += '<input class="form-check-input" type="checkbox" name="room_id[]" id="room_id_'+val.id+'" value="'+val.id+'">';
                    str += '<label class="form-check-label" for="room_id_'+val.id+'">'+val.name+' ('+val.capacity+')</label>';
                    str += '</div>';
                });
                $('#ModalAssign #room_edit').html(str);
            }
        },
        error: function(err){

        }
    })
});

$('.sm-assign').click(function(e){
    e.preventDefault();
    var url = $('#ModalAssign').attr('data-url');
    var room_id = [];
    $('input[name="room_id[]"]:checked').each(function () {
        room_id.push($(this).val());
    });
    $.ajax({
        type: 'post',
        url:url,
        data:{
            _token:_token,
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
})