let COURSE = {};

$(document).ready(function(){
    COURSE.init();
});

COURSE.init = function(){
    COURSE.pin();
    COURSE.unpin();
    COURSE.show();
    COURSE.hide();
}

COURSE.pin = function(){
    $('.pin-topic').click(function(e){
        e.preventDefault();
        var url = $(this).attr('data-url');
        $.ajax({
            type: 'post',
            url: url,
            data:{
                _token: _token,
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

COURSE.unpin = function(){
    $('.unpin-topic').click(function(e){
        e.preventDefault();
        var url = $(this).attr('data-url');
        $.ajax({
            type: 'post',
            url: url,
            data:{
                _token: _token,
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

COURSE.hide = function(){
    $('.hide-topic').click(function(e){
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

COURSE.show = function(){
    $('.show-topic').click(function(e){
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