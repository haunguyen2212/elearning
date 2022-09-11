function formatDateInput(date){
    var newDate = new Date(date);
    var day = newDate.getDate();
    var month = newDate.getMonth() + 1;
    var year = newDate.getFullYear();
    if(day < 10){
        day = '0'+ day;
    }
    if(month < 10){
        month = '0'+ month;
    }
    return `${day}-${month}-${year}`;
}

function formatTimeInput(time){
    return time.slice(0,5);
}

function formatDateShow(date){
    var newDate = new Date(date);
    var day = newDate.getDate();
    var month = newDate.getMonth() + 1;
    var year = newDate.getFullYear();
    if(day < 10){
        day = '0'+ day;
    }
    if(month < 10){
        month = '0'+ month;
    }
    return `${day}/${month}/${year}`;
}