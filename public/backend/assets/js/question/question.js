let QUESTION = {};

$(document).ready(function(){
    QUESTION.init();
})

QUESTION.init = function(){
    QUESTION.search();
}

QUESTION.search = function(){
    $('.btn-search').click(function(e){
        e.preventDefault();
        searchSubmit();
    })

    $('.btn-clear').click(function(e){
        e.preventDefault();
        clearSearch();
    })
}

function searchSubmit() {
    let params = getDataFilter();
    const url_search = window.location.origin + window.location.pathname;
    if (Object.keys(params).length > 0) {
        window.location.href = url_search + '?' + decodeURI($.param(params));
    } else {
        window.location.href = url_search;
    }
}

function clearSearch(){
    window.location.href = window.location.origin + window.location.pathname;
}

function getDataFilter() {
    let params = {};

    if ($('#keyword').val() != '') {
        Object.assign(params, {'keyword': $("#keyword").val()});
    }

    if ($('#subject :selected').val() != "") {
        Object.assign(params, {'subject': $('#subject :selected').val()});
    }

    if ($('#teacher-name :selected').val() != "") {
        Object.assign(params, {'teacher': $('#teacher-name :selected').val()});
    }

    var level = [];
    $('.level').each(function () {
        if ($(this).is(':checked')) {
            level = level.concat($(this).val());
        }
    })
    if (level.length > 0) {
        Object.assign(params, {'level': level.toString()});
    }

    var shared = [];
    $('.shared').each(function () {
        if ($(this).is(':checked')) {
            shared = shared.concat($(this).val());
        }
    })
    if (shared.length > 0) {
        Object.assign(params, {'shared': shared.toString()});
    }

    return params;
}