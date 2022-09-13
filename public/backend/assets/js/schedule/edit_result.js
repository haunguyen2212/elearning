var _token = $('meta[name="csrf-token"]').attr('content');

$('.item').click(function(e){
    e.preventDefault();
    var id = $(this).attr('data-id');
    var date = $(this).attr('data-date')? $(this).attr('data-date') : '-1';
    var room = $(this).attr('data-room')? $(this).attr('data-room') : '-1';
    $('#EditSchedule').attr('data-id', id);
    $('#EditSchedule').attr('data-room', room);
    $('#EditSchedule').attr('data-date', date);
    $.ajax({
        type: 'get',
        url: url_get,
        data:{
            _token:_token,
            id:id,
            date:date,
            room:room,
        },
        success: function(res){
            showInfo(res.data.data);
            activeButtonRoom(res.data.info.room);
        },
        error: function(err){

        }
    })
});

$('input[name=change-room]').change(function(){
    var room = $(this).val();
    var id = $('#EditSchedule').attr('data-id');
    var date = $('#EditSchedule').attr('data-date');
    $.ajax({
        type: 'get',
        url: url_check,
        data: {
            _token:_token,
            id: id,
            date: date,
            room: room,
        },
        success: function(res){
            console.log(res);
        }
    })
})


function showInfo(obj){
    $('#purpose-show span').html(obj.purpose);
    $('#date-show span').html(formatDateShow(obj.date)+' '+formatTimeInput(obj.start_time)+' - '+formatTimeInput(obj.end_time));
    $('#teacher-show span').html(obj.teacher_name);
    $('#amount-show span').html(obj.amount);
}

function activeButtonRoom(id){
    $('input[name=change-room]').removeAttr('checked');
    $('#change-room'+id).attr('checked', 'checked');
}