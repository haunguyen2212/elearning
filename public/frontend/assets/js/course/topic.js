let TOPIC = {};

$(document).ready(function(){
    TOPIC.init();
});

TOPIC.init = function(){
    TOPIC.store();
    TOPIC.uploadDocument();
    TOPIC.delete();
    TOPIC.edit();
    TOPIC.update();
}

TOPIC.store = function(){
    $('.btn-store-topic').click(function(e){
        e.preventDefault();
        var url = $('#ModalCreateTopic').attr('data-url');
        let content = CKEDITOR.instances['content_topic_create'].getData();
        var formData = new FormData($('form#frm-create-topic')[0]);
        formData.append('_token', _token);
        formData.delete('content');
        formData.append('content', content);
        $.ajax({
            type: 'post',
            url: url,
            data: formData,
            dataType: 'JSON',
            processData: false,
            cache: false,
            contentType: false,
            beforeSend: function(){
                $('.txt_error').html('');
            },
            success: function(res){
                window.location.reload();
            },
            error: function(err){
                var errors = err.responseJSON.errors;
                $.each(errors, function(prefix, val){
                    $('#ModalCreateTopic .txt_'+prefix).html(val);
                });
            }
        })
    })
}

TOPIC.uploadDocument = function(){
    $('.frm-create-document').change(function(e){
        e.preventDefault();
        $(this).submit();
    })
}

TOPIC.delete = function(){
    $('.delete-topic').click(function(e){
        e.preventDefault();
        var url = $(this).attr('data-url');
        $('#ModalDeleteTopic').attr('data-url', url);
    });

    $('.btn-confirm-delete-topic').click(function(e){
        e.preventDefault();
        var url = $('#ModalDeleteTopic').attr('data-url');
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

TOPIC.edit = function(){
    $('.edit-topic').click(function(e){
        e.preventDefault();
        $('.txt_error').html('');
        var url = $(this).attr('data-url-edit');
        $('#ModalEditTopic').attr('data-url', $(this).attr('data-url-update'));
        $.ajax({
            type: 'get',
            url: url,
            data:{
                _token:_token,
            },
            success: function(res){
                if(res.status == 1){
                    $('#ModalEditTopic #title_topic_edit').val(res.data.title);
                    CKEDITOR.instances['content_topic_edit'].setData(res.data.content);
                }
                else{
                    window.location.reload();
                }
            }
        })
    })
}

TOPIC.update = function(){
    $('.btn-update-topic').click(function(e){
        e.preventDefault();
        var url = $('#ModalEditTopic').attr('data-url');
        let content = CKEDITOR.instances['content_topic_edit'].getData();
        var formData = new FormData($('form#frm-edit-topic')[0]);
        formData.append('_token', _token);
        formData.append('_method', 'patch');
        formData.delete('content');
        formData.append('content', content);
        $.ajax({
            type: 'post',
            url: url,
            data: formData,
            dataType: 'JSON',
            processData: false,
            cache: false,
            contentType: false,
            beforeSend: function(){
                $('.txt_error').html('');
            },
            success: function(res){
                window.location.reload();
            },
            error: function(err){
                var errors = err.responseJSON.errors;
                $.each(errors, function(prefix, val){
                    $('#ModalEditTopic .txt_'+prefix).html(val);
                });
            }
        })
    })
}