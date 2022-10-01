$(document).ready(function(){
    $('#search-course').click(function(e){
        e.preventDefault();
        var key = $('input#search').val();
        var url = window.location.origin + '?search=' + key;
        window.location.href = url;
    })
});