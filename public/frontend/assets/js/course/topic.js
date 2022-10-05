let TOPIC = {};

$(document).ready(function(){
    TOPIC.init();
});

TOPIC.init = function(){
    TOPIC.store();
}

TOPIC.store = function(){
    $('.btn-store-topic').click(function(e){
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