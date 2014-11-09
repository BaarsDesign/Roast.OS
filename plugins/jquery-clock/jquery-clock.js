$(document).ready(function(){
    var t = setTimeout(function(){startTime()},500);
});

function startTime() {
    var clockElement = $(".clock");

    var today=new Date();
    var h=today.getHours();
    var m=today.getMinutes();
    var s=today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);

    //clockElement.html(h+":"+m+":"+s); //met seconden
    clockElement.html(h+":"+m); //zonder seconden
    var t = setTimeout(function(){startTime()},2000);
}

function checkTime(i) {
    if (i<10) {i = "0" + i};  // add zero in front of numbers < 10
    return i;
}