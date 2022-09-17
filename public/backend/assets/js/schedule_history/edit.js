var _token = $('meta[name="csrf-token"]').attr('content');

$('.txt-edit').click(function(e){
    console.log($(this).attr('data-url-edit'));
});