var _token = $('meta[name="csrf-token"]').attr('content');

jQuery.noConflict();
    (function( $ ) {
        $(function() {
            $('#change-school-year').change(function(e){
                e.preventDefault();
                var school_year = $('input[name="school_year"]:checked').val();
                $('.form-check').removeClass('radio-active');
                $('#school_year_'+school_year).parent().addClass('radio-active');
                if(school_year == $('input[name="school_year"].default').val()){
                    return false;
                }
                $('#ModalChange').modal('show');
            }); 

            $('.btn-confirm-change').click(function(e){
                e.preventDefault();
                var url = $('#ModalChange').attr('data-url');
                var id = $('input[name="school_year"]:checked').val();
                $.ajax({
                    type: 'post',
                    url: url,
                    data:{
                        _token:_token,
                        id:id,
                    },
                    success: function(res){
                        if(res.status == 1){
                            window.location.reload();
                        }
                    },
                    error: function(err){
                        var errors = err.responseJSON.errors;
                        $.each(errors, function(prefix, val){
                            $('.text_err_'+prefix).html(val);
                        });
                        $('#ModalChange').modal('hide');
                    }
                })
            });
        });
    })(jQuery);