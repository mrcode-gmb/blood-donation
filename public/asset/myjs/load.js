let loader = document.querySelector(".shows"),
percent = document.querySelector("#percent");

let loaderStart = 0, loaderEnd = 98, loaderTime = 60;

let start = setInterval(() => {
    loaderStart++;

    percent.textContent = loaderStart+'%';
    loader.style.width = `${loaderStart}%`;
    loader.style.background = `rgb(97, 184, 97)`;


    if(loaderStart == loaderEnd){
        clearInterval(start);
    }
},loaderTime);


let loader1 = document.querySelector("#shows1"),
percent1 = document.querySelector("#percent1");

let loaderStart1 = 0, loaderEnd1 = 36, loaderTime1 = 60;

let start1 = setInterval(() => {
    loaderStart1++;

    percent1.textContent = loaderStart1+'%';
    loader1.style.width = `${loaderStart1}%`;
    loader1.style.background = `rgb(97, 184, 97)`;


    if(loaderStart1 == loaderEnd1){
        clearInterval(start1);
    }
},loaderTime1);




let loader2 = document.querySelector("#shows2"),
percent2 = document.querySelector("#percent2");

let loaderStart2 = 0, loaderEnd2 = 75, loaderTime2 = 60;

let start2 = setInterval(() => {
    loaderStart2++;

    percent2.textContent = loaderStart2+'%';
    loader2.style.width = `${loaderStart2}%`;
    loader2.style.background = `rgb(97, 184, 97)`;


    if(loaderStart2 == loaderEnd2){
        clearInterval(start2);
    }
},loaderTime2);


let loader3 = document.querySelector("#shows3"),
percent3 = document.querySelector("#percent3");

let loaderStart3 = 0, loaderEnd3 = 55, loaderTime3 = 60;

let start3 = setInterval(() => {
    loaderStart3++;

    percent3.textContent = loaderStart3+'%';
    loader3.style.width = `${loaderStart3}%`;
    loader3.style.background = `rgb(97, 184, 97)`;


    if(loaderStart3 == loaderEnd3){
        clearInterval(start3);
    }
},loaderTime3);
