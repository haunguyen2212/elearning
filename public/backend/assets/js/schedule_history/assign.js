var _token = $('meta[name="csrf-token"]').attr('content');

$('.txt-assign').click(function(e){
    e.preventDefault();
    var url = $(this).attr('data-url-edit');
    $('#ModalAssign').attr('data-url', $(this).attr('data-url-update'));
    $('#ModalAssign').attr('data-url-check', $(this).attr('data-url-check'));
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

$('#assign-room').change(function(e){
    e.preventDefault();
    var url = $('#ModalAssign').attr('data-url-check');
    var room_id = [];
    $('input[name="room_id[]"]:checked').each(function () {
        room_id.push($(this).val());
    });
    if(room_id.length != 0){
        $.ajax({
            type: 'get',
            url:url,
            data:{
                _token:_token,
                room_id:room_id,
            },
            success: function(res){
                if(res.status == 1){
                    console.log(res.data);
                    console.log(res.data.length);
                    var count = 0
                    $.each(res.data, function(prefix, val){       
                        count++;
                    });
                    if(count > 0){
                        var str = '<div class="alert alert-warning" role="alert"><strong>Cảnh báo: </strong>Phòng đã được sử dụng:';
                        str += '<ul class="mb-0">';
                        $.each(res.data, function(prefix, val){       
                            str += '<li>'+val.purpose+' - '+val.teacher_name+' ('+formatTimeInput(val.start_time)+' - '+formatTimeInput(val.end_time)+')</li>';
                        });
                        str += '</ul>';
                        str += '<div>Thao tác thay đổi sẽ xóa các phòng trên ra khỏi danh sách.</div>'
                        str += '</div>';
                        $('#content-assign-check').html(str);
                    }
                    else{
                        $('#content-assign-check').html('');
                    }
                }
            },
            error: function(err){
    
            }
        })
    }
})

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