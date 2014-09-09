var timer1, timer2;

function alertUser()
{
    $('#timeoutPopup').fadeIn();
    var time = 120;
    $('#time').html(time);
    var myTime= setInterval(function(){
       $('#time').html(time);
       time -= 1;
    }, 1000);
    $(document).keypress(function(){
    clearInterval(myTime);
    }).mousemove(function(){
    clearInterval(myTime);
    });

     
}

function logout()
{
    window.location.href='/logout.php';
}



function resetTimer()
{
    $('#timeoutPopup').fadeOut();
    clearTimeout(timer1);
    clearTimeout(timer2);

    // waiting time in minutes
    var wait=10;

    // alert user two minute before
    timer1=setTimeout(function(){alertUser()}, (60000*wait)-2*1000*60);

    // logout user
    timer2=setTimeout(function(){logout()}, 60000*wait);
}

$(document).keypress(function(){
    resetTimer();
}).mousemove(function(){
    resetTimer();
});
function logSize(){
var height=$('#time').height();
$('#time').width(height);
$('#time').css({ 'font-size': height/3,
    "line-height": height/1.8  + "px" });
};
$(window).resize(function() {
    logSize();
});
logSize();


