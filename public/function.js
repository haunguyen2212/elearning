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

function formatDateTimeInput(dateTime){
    var newDate = new Date(dateTime);
    var day = newDate.getDate();
    var month = newDate.getMonth() + 1;
    var year = newDate.getFullYear();
    var hour = newDate.getHours();
    var minute = newDate.getMinutes();
    var second = newDate.getSeconds();
    if(day < 10){
        day = '0'+ day;
    }
    if(month < 10){
        month = '0'+ month;
    }
    if(hour < 10){
        hour = '0'+ hour;
    }
    if(minute < 10){
        minute = '0'+ minute;
    }
    if(second < 10){
        second = '0'+ second;
    }
    return `${day}-${month}-${year} ${hour}:${minute}:${second}`;
}

function formatDateTimeMinusSecond(dateTime){
    var newDate = new Date(dateTime);
    var day = newDate.getDate();
    var month = newDate.getMonth() + 1;
    var year = newDate.getFullYear();
    var hour = newDate.getHours();
    var minute = newDate.getMinutes();
    if(day < 10){
        day = '0'+ day;
    }
    if(month < 10){
        month = '0'+ month;
    }
    if(hour < 10){
        hour = '0'+ hour;
    }
    if(minute < 10){
        minute = '0'+ minute;
    }
    return `${day}-${month}-${year} ${hour}:${minute}`;
}

function uploadFile(selector, number){
    document.querySelector(selector+'-'+number).click();
}

function uploadExercise(selector){
    document.querySelector(selector).click();
}

function showFileUpload(input, result){
    const ipnFileElement = document.querySelector('#'+input)
    const resultElement = document.querySelector('#'+result)

    ipnFileElement.addEventListener('change', function(e) {
    const files = e.target.files
    const file = files[0]

    const fileReader = new FileReader()
    fileReader.readAsDataURL(file)

    fileReader.onload = function() {
        const url = fileReader.result
        console.log(fileReader);
        resultElement.insertAdjacentHTML(
        'beforeend',
        `<a href="${url}">file</a><br>`
        )
    }
    })
}