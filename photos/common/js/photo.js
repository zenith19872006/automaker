var centerpoint=0;
var pagenow = 1;

$(window).ready(function() {

    $('#photos').attr('src','images/1.jpg');
    $('.arrow').show();
    $('.rightarrow').hide();

    //调整
    var winwidth = $(window).width();
    var winheight = $(window).height();

    $('#bg').css('width',winwidth+'px');
    $('#bg').css('height',winheight+'px');

    $('#bg2').css('width',winwidth+'px');
    $('#bg2').css('height',winheight+'px');

    var toppx= winheight*0.43;
    var leftpx= winwidth*0.2;
    var widthpx=winwidth*0.68;
    var heightpx=winheight*0.3;

    $('#photos').css('top',toppx+'px');
    $('#photos').css('left',leftpx+'px');
    $('#photos').css('width',widthpx+'px');
    $('#photos').css('height',heightpx+'px');

});


function next() {

    pagenow++;

    $('.arrow').hide();
    $('.arrow').show();
    $('.arrow').css('opacity',1);

    if(pagenow<=photonum+1){
        $('#photos').attr('src','images/'+pagenow+'.jpg');
    }else if(pagenow<=imgnum){
        $('#bg2').attr('src','images/'+pagenow+'.jpg');
    }

    if(pagenow==photonum+1){
        $('#page1').hide();
        $('#page2').show();
        $('.arrow').show();
    }

    if(pagenow==imgnum){
        $('.arrow').hide();
        $('.arrow').show();
        $('.leftarrow').hide();
    }

}

function previous() {

    $('.arrow').hide();
    $('.arrow').show();
    $('.arrow').css('opacity',1);

    if(pagenow==photonum+1){
        $('#page1').show();
        $('#page2').hide();
    }

    if(pagenow>1){
        pagenow--;
    }

    if(pagenow<photonum+1){
        $('#photos').attr('src','images/'+pagenow+'.jpg');
    }else if(pagenow<=imgnum){
        $('#bg2').attr('src','images/'+pagenow+'.jpg');
    }

    if(pagenow==1){
        $('.arrow').hide();
        $('.arrow').show();
        $('.rightarrow').hide();
        $('.arrow').css('opacity',1);
    }

}