let COURSE = {};

$(document).ready(function(){
    COURSE.init();
});

COURSE.init = function(){
    COURSE.pin();
    COURSE.unpin();
    COURSE.show();
    COURSE.hide();
    COURSE.deleteStudent();
    COURSE.editNotice();
    COURSE.updateNotice();
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

COURSE.deleteStudent = function(){
    $('.delete-student').click(function(e){
        e.preventDefault();
        var url = $(this).attr('data-url');
        $('#ModalDeleteStudent').attr('data-url', url);
        $.ajax({
            type: 'get',
            url: url,
            data:{
                _token:_token,
            },
            success: function(res){
                if(res.status == 1){
                    $('#ModalDeleteStudent span.name-student').html(res.data.name);
                } 
            },
            error: function(err){

            }
        })
    });

    $('.btn-confirm-delete-student').click(function(e){
        e.preventDefault();
        var url = $('#ModalDeleteStudent').attr('data-url');
        $.ajax({
            type: 'delete',
            url: url,
            data:{
                _token:_token,
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
}

COURSE.editNotice = function(){
    $('.edit-course-notice').click(function(e){
        e.preventDefault();
        var url = $(this).attr('data-url');
        $('#ModalEditCourseNotice').attr('data-url', url);
    })
}

COURSE.updateNotice = function(){
    $('.btn-update-course-notice').click(function(e){
        e.preventDefault();
        var url = $('#ModalEditCourseNotice').attr('data-url');
        var notice =  CKEDITOR.instances['content_course_notice_edit'].getData();
        $.ajax({
            type: 'post',
            url: url,
            data:{
                _token:_token,
                _method: 'patch',
                notice: notice,
            },
            success: function(res){
                if(res.status == 1){
                    window.location.reload();
                }
            },
            error: function(err){
                var errors = err.responseJSON.errors;
                $.each(errors, function(prefix, val){
                    $('#ModalEditCourseNotice .txt_'+prefix).html(val);
                });
            }
        })
    })
}