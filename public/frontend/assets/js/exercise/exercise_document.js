let EXERCISE_DOCUMENT = {};

$(document).ready(function(){
    EXERCISE_DOCUMENT.init();
})

EXERCISE_DOCUMENT.init = function(){
    EXERCISE_DOCUMENT.upload();
}

EXERCISE_DOCUMENT.upload = function(){
    $('.frm-submit-exercise-document').change(function(e){
        e.preventDefault();
        $(this).submit();
    })
}