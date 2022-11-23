let NOTIFICATION = {};

$(document).ready(function(){
    NOTIFICATION.init();
})

NOTIFICATION.init = function(){
    NOTIFICATION.watch();
}

NOTIFICATION.watch = function(){
    $('.notifi-icon').click(function(e){
        e.preventDefault();
        $('.badge-number').addClass('hidden');
        $.ajax({
            type: 'post',
            url: url_notifi,
            data:{
                _token:_token,
            },
            success: function(res){

            },
            error: function(err){

            }
        })
    });
}