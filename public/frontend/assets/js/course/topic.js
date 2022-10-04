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
        for(var pair of formData.entries()) {
            console.log(pair[0]+ ', '+ pair[1]); 
         }
    })
}