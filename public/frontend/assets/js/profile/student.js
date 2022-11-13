let STUDENT = {};

$(document).ready(function(){
    STUDENT.init();
})

STUDENT.init = function(){
    STUDENT.editProfile();
    STUDENT.updateProfile();
    STUDENT.changePassword();
}

STUDENT.editProfile = function(){
    $('.btn-edit-profile').click(function(e){
        e.preventDefault();
        $('.text-danger').html('');
        var url = $(this).attr('data-url');
        $('#ModalEditProfile').attr('data-url', url);
        $.ajax({
            type: 'get',
            url:url,
            data:{
                _token:_token,
            },
            success: function(res){
                if(res.status == 1){
                    $('#ModalEditProfile #name_edit').val(res.data.name);
                    $('#gender'+res.data.gender).prop("checked", true);
                    $('#ModalEditProfile #date_of_birth_edit').val(formatDateInput(res.data.date_of_birth));
                    $('#ModalEditProfile #place_of_birth_edit').val(res.data.place_of_birth);
                    $('#ModalEditProfile #phone_edit').val(res.data.phone);
                    $('#ModalEditProfile #email_edit').val(res.data.email);
                    $('#ModalEditProfile #address_edit').val(res.data.address);
                }
            },
            error: function(err){

            }
        })
    })
}

STUDENT.updateProfile = function(){
    $('.btn-update-profile').click(function(e){
        e.preventDefault();
        var url = $('#ModalEditProfile').attr('data-url');
        var formData = new FormData($('#frm-edit-profile')[0]);
        formData.append('_token', _token);
        formData.append('_method', 'patch');
        $.ajax({
            type: 'post',
            url:url,
            data:formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function(){
                $('.text-danger').html('');
            },
            success: function(res){
                if(res.status == 1){
                    window.location.reload();
                }
            },
            error: function(err){
                var errors = err.responseJSON.errors;
                $.each(errors, function(prefix, val){
                    $('#ModalEditProfile .txt_'+prefix).html(val);
                });
            }
        })
    })
}

STUDENT.changePassword = function(){
    $('.btn-update-password').click(function(e){
        e.preventDefault();
        var url = $('#ModalChangePassword').attr('data-url');
        var formData = new FormData($('#frm-change-password')[0]);
        formData.append('_token', _token);
        formData.append('_method', 'patch');
        $.ajax({
            type: 'post',
            url:url,
            data:formData,
            contentType: false,
            processData: false,
            cache: false,
            beforeSend: function(){
                $('.text-danger').html('');
            },
            success: function(res){
                console.log(res);
                if(res.status == 1){
                    window.location.reload();
                }
            },
            error: function(err){
                var errors = err.responseJSON.errors;
                $.each(errors, function(prefix, val){
                    $('#ModalChangePassword .txt_'+prefix).html(val);
                });
            }
        })
    })
}