
jQuery.noConflict();
(function( $ ) {
    $(function() {
        $('.txt-edit').click(function(e){
            e.preventDefault();
            $('#ModalEdit .text-danger').html('');
            var url = $(this).attr('data-url-edit');
            $('#frm-edit').attr('data-url', $(this).attr('data-url-update'));
            $('.txt-delete').attr('data-url', $(this).attr('data-url-delete'));
            $.ajax({
                type: 'get',
                url: url,
                data:{
                    _token:_token,
                },
                success: function(res){
                    if(res.status == 1){
                        $('#ModalEdit #name_edit').val(res.data.name);
                        $('#ModalEdit #start_time_edit').val(formatDateInput(res.data.start_time));
                        $('#ModalEdit #end_time_edit').val(formatDateInput(res.data.end_time));
                        if(res.data.status == 1){
                            $('#ModalEdit #status_edit').prop('checked', true);
                            $('#ModalEdit #status_edit').css('pointer-events', 'none');
                            $('.txt-delete').html('');
                        }
                        else{
                            $('#ModalEdit #status_edit').prop('checked', false);
                            $('#ModalEdit #status_edit').removeAttr('style');
                            $('.txt-delete').html('<i class="bi bi-x-circle"></i> Xóa học kỳ');
                        }
                    }
                },
                error: function(err){

                }
            })
        });

        $('.btn-edit-submit').click(function(e){
            e.preventDefault();
            var url = $('#frm-edit').attr('data-url');
            var formData = new FormData($('#frm-edit')[0]); 
            formData.append('_token', _token);
            formData.append('_method', 'put');
            $.ajax({
                type: 'post',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    $('#ModalEdit .text-danger').html('');
                },
                success: function(res){
                    if(res.status == 1){
                        window.location.reload();
                    }
                },
                error: function(err){
                    var errors = err.responseJSON.errors;
                    $.each(errors, function(prefix, val){
                        $('#ModalEdit .err-'+prefix).html(val);
                    });
                }

            })
        });

        $('.txt-delete').click(function(e){
            e.preventDefault();
            var url = $(this).attr('data-url');
            $('#ModalDelete').attr('data-url', url);
            $('#ModalEdit').modal('hide');
            $('#ModalDelete').modal('show');
        });

        $('.btn-confirm-delete').click(function(e){
            e.preventDefault();
            var url = $('#ModalDelete').attr('data-url');
            $.ajax({
                type: 'delete',
                url:url,
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
    });
})(jQuery);
