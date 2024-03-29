let TOPIC_DOCUMENT = {};

$(document).ready(function(){
    TOPIC_DOCUMENT.init();
})

TOPIC_DOCUMENT.init = function(){
    TOPIC_DOCUMENT.show();
    TOPIC_DOCUMENT.hide();
    TOPIC_DOCUMENT.delete();
    TOPIC_DOCUMENT.rename();
    TOPIC_DOCUMENT.createLink();
    TOPIC_DOCUMENT.storeLink();
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

TOPIC_DOCUMENT.rename = function(){
    $('.rename-topic-document').click(function(e){
        e.preventDefault();
        $('.txt_error').html('');
        var url = $(this).attr('data-url');
       $('#ModalRenameTopicDocument').attr('data-url', url);
       $.ajax({
        type: 'get',
        url: url,
        data:{
            _token:_token,
        },
        success: function(res){
            if(res.status == 1){
                $('#ModalRenameTopicDocument #title_topic_document_rename').val(res.data.name);
            }
        },
        error: function(err){

        }
       })
    });

    $('.btn-update-topic-document').click(function(e){
        e.preventDefault();
        var url = $('#ModalRenameTopicDocument').attr('data-url');
        var name = $('#ModalRenameTopicDocument #title_topic_document_rename').val();
        $.ajax({
            type: 'post',
            url: url,
            data:{
                _token:_token,
                _method: 'patch',
                name: name,
            },
            beforeSend: function(){
                $('.txt_error').html('');
            },
            success: function(res){
                if(res.status == 1){
                    window.location.reload();
                }
            },
            error: function(err){
                var errors = err.responseJSON.errors;
                $.each(errors, function(prefix, val){
                    $('#ModalRenameTopicDocument .txt_'+prefix).html(val);
                });
            }
        })
    })
}

TOPIC_DOCUMENT.createLink = function(){
    $('.add-link-topic-document').click(function(e){
        e.preventDefault();
        $('.txt_error').html('');
        var url = $(this).attr('data-url');
        $('#ModalCreateLinkTopicDocument').attr('data-url', url);
    })
}

TOPIC_DOCUMENT.storeLink = function(){
    $('.btn-store-link-document').click(function(e){
        e.preventDefault();
        var url = $('#ModalCreateLinkTopicDocument').attr('data-url');
        var name = $('#ModalCreateLinkTopicDocument #name-link-document').val();
        var link = $('#ModalCreateLinkTopicDocument #url-link-document').val();
        $.ajax({
            type: 'post',
            url: url,
            data:{
                _token:_token,
                name:name,
                link:link,
            },
            beforeSend: function(){
                $('.txt_error').html('');
            },
            success: function(res){
                if(res.status == 1){
                    window.location.reload();
                }
            },
            error: function(err){
                var errors = err.responseJSON.errors;
                $.each(errors, function(prefix, val){
                    $('#ModalCreateLinkTopicDocument .txt_'+prefix).html(val);
                });
            }
        })
    })
}