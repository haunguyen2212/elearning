let EXERCISE = {};

$(document).ready(function(){
    EXERCISE.init();
});

EXERCISE.init = function(){
   EXERCISE.upload();
}

EXERCISE.upload = function(){
    $('.frm-submit-exercise').change(function(e){
        e.preventDefault();
        $(this).submit();
    })
}