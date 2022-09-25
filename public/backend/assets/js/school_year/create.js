
jQuery.noConflict();
    (function( $ ) {
        $(function() {
            $('.txt-create').click(function(e){
                e.preventDefault();
                $('#ModalCreate .text-danger').html('');
            });

            $('.btn-create-submit').click(function(e){
                e.preventDefault();
                var url = $('#frm-create').attr('data-url');
                var formData = new FormData($('#frm-create')[0]); 
                formData.append('_token', _token);
                $.ajax({
                    type: 'post',
                    url: url,
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function(){
                        $('#ModalCreate .text-danger').html('');
                    },
                    success: function(res){
                        if(res.status == 1){
                            window.location.reload();
                        }
                    },
                    error: function(err){
                        var errors = err.responseJSON.errors;
                        $.each(errors, function(prefix, val){
                            $('#ModalCreate .err-'+prefix).html(val);
                        });
                    }

                })
            });
        });
    })(jQuery);
