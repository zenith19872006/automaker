var centerpoint=0;
var pagenow = 1;

$(window).ready(function() {

    $('#photos').attr('src','images/1.jpg');

    //调整
    var winwidth = $(window).width();
    var winheight = $(window).height();

    $('#bg1').css('width',winwidth+'px');
    $('#bg1').css('height',winheight+'px');
    $('#bg2').css('width',winwidth+'px');
    $('#bg2').css('height',winheight+'px');

    var toppx= winheight*0.12;
    var leftpx= winwidth*0.09;
    var widthpx=winwidth*0.76;
    var heightpx=winheight*0.55;

    $('#photos').css('top',toppx+'px');
    $('#photos').css('left',leftpx+'px');
    $('#photos').css('width',widthpx+'px');
    $('#photos').css('height',heightpx+'px');

    var btntoppx= winheight*0.7;
    var btnleftpx= winwidth*0.06;
    var btnwidthpx=winwidth*0.5;
    var btnheightpx=btnwidthpx;

    $('#phonebtn').css('top',btntoppx+'px');
    $('#phonebtn').css('left',btnleftpx+'px');
    $('#phonebtn').css('width',btnwidthpx+'px');
    $('#phonebtn').css('height',btnheightpx+'px');

    centerpoint=btntoppx+btnheightpx/2;

});

var cantouch=1;

function handleTouchEvent(event) {
    switch (event.type) {
        case "touchstart":
            if(cantouch){
                var touchY=event.touches[0].clientY;

                if(touchY >centerpoint){
                    nextpage();
                }else{
                    prepage();
                }
            }
            break;
    }
}

var phonebtn = document.getElementById("phonebtn");
phonebtn.addEventListener("touchstart", handleTouchEvent, false);


function closeclick() {
    $('body').css('background-image','url(images/bg2.jpg)');
    $('#page2').hide();
}

function nextpage() {

    pagenow++;

    if(pagenow<photonum){
        $('#photos').attr('src','images/'+pagenow+'.jpg');
    }

    if(pagenow==photonum){
        $('#page1').hide();
        $('#page2').show();
    }

}

function prepage() {

    if(pagenow==photonum){
        $('#page1').show();
        $('#page2').hide();
    }

    if(pagenow>1){
        pagenow--;
    }

    $('#photos').attr('src','images/'+pagenow+'.jpg');

}