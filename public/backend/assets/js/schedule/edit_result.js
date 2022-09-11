var _token = $('meta[name="csrf-token"]').attr('content');

$('.item').click(function(e){
    e.preventDefault();
    var id = $(this).attr('data-id');
    $.ajax({
        type: 'get',
        url: url,
        data:{
            _token:_token,
            id:id,
        },
        success: function(res){
            showInfo(res.data);
        },
        error: function(err){

        }
    })
});

function showInfo(obj){
    $('#purpose-show span').html(obj.purpose);
    $('#date-show span').html(formatDateShow(obj.date)+' '+formatTimeInput(obj.start_time)+' - '+formatTimeInput(obj.end_time));
    $('#teacher-show span').html(obj.teacher_name);
    $('#amount-show span').html(obj.amount);
}