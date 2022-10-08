let TOPIC_DOCUMENT = {};

$(document).ready(function(){
    TOPIC_DOCUMENT.init();
})

TOPIC_DOCUMENT.init = function(){
    TOPIC_DOCUMENT.show();
    TOPIC_DOCUMENT.hide();
    TOPIC_DOCUMENT.delete();
}

TOPIC_DOCUMENT.show = function(){
    $('.show-topic-document').click(function(e){
        e.preventDefault();
        var url = $(this).attr('data-url');
        $.ajax({
            type: 'post',
            url: url,
            data:{
                _token:_token,
                _method: 'patch',
            },
            success: function(res){
                window.location.reload();
            },
            error: function(err){

            }
        })
    })
}

TOPIC_DOCUMENT.hide = function(){
    $('.hide-topic-document').click(function(e){
        e.preventDefault();
        var url = $(this).attr('data-url');
        $.ajax({
            type: 'post',
            url: url,
            data:{
                _token:_token,
                _method: 'patch',
            },
            success: function(res){
                window.location.reload();
            },
            error: function(err){

            }
        })
    })
}

TOPIC_DOCUMENT.delete = function(){
    $('.delete-topic-document').click(function(e){
        e.preventDefault();
        var url = $(this).attr('data-url');
        $.ajax({
            type: 'delete',
            url: url,
            data:{
                _token:_token,
            },
            success: function(res){
                window.location.reload();
            },
            error: function(err){

            }
        })
    })
}