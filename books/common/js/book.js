var hasshowtips=0;

var noanimation = getQueryString('noanimation');

var pagenum=$('#book').children('div').length;

var nowpage=1;





$(window).ready(function() {

        for(var i=1;i<=pagenum;i++){
            $('#page'+i).css('background-image','url(images/'+i+'.jpg?7)');
        }

    // for(var i=1;i<=pagenum;i++){
    //     $('#page'+i).hide();
    // }
    //
    //

    //$('#page3').show();

        $('#book').turn({
            display: 'single',
            acceleration: true,
            duration:2000,
            gradients: true,
            elevation:50,
            when: {
                turning:function (e, page) {
                    $(".rightarrow").hide();
                    $(".leftarrow").hide();
                    $(".uparrow").hide();
                    $(".downarrow").hide();
                },
                turned:function (e, page) {
                    if(page == 1){
                        if(hasshowtips){
                            $(".rightarrow").hide();
                            $(".leftarrow").show();
                            $(".uparrow").hide();
                            $(".downarrow").show();
                        }
                    }else if(page == pagenum){
                        $(".rightarrow").show();
                        $(".leftarrow").hide();
                        $(".uparrow").show();
                        $(".downarrow").hide();
                    }else{
                        $(".rightarrow").show();
                        $(".leftarrow").show();
                        $(".uparrow").show();
                        $(".downarrow").show();
                    }
                }
            }
        });

    //$('#book .turn-page').children(".turn-page-wrapper").hide();

        //setTimeout("closetips()",2000);
        $(".leftarrow").show();
        $(".downarrow").show();
        hasshowtips=1;

});

function closetips(){
    $('#mask').hide();
    $(".leftarrow").show();
    $(".downarrow").show();
    hasshowtips=1;
}

//滑动处理
var book = document.getElementById("book");

var startX, startY, moveEndX, moveEndY, X, Y;

book.addEventListener('touchstart', function(e) {
    e.preventDefault();
    startX = e.touches[0].pageX;
    startY = e.touches[0].pageY;
});

book.addEventListener('touchend', function(e) {
    e.preventDefault();
    moveEndX = e.changedTouches[0].pageX;
    moveEndY = e.changedTouches[0].pageY;

    X = moveEndX - startX;
    Y = moveEndY - startY;

    if(touchDirection==0 && noanimation==0){
        if ( X > 0 ) {previous();}
        else {next();}
    }else if(touchDirection==1 && noanimation==0){
        if (Y >0) {previous();}
        else{next();}
    }

});


function next() {

    if(noanimation){

        if(nowpage<pagenum){
            nowpage++;
        }

        afterturn();

    }else{
        $('#book').turn('next');
    }

}

function previous() {
    if(noanimation){

        if(nowpage>1){
            nowpage--;
        }

        afterturn();

    }else {
        $('#book').turn('previous');
    }
}
function afterturn() { console.log(nowpage+' '+pagenum);

    for(var i=1;i<=pagenum;i++){
        if(i==nowpage){
            $('#page'+i).show();
        }else{
            $('#page'+i).hide();
        }
    }

    if(nowpage == 1){
        $(".rightarrow").hide();
        $(".leftarrow").show();
        $(".uparrow").hide();
        $(".downarrow").show();
    }else if(nowpage == pagenum){
        $(".rightarrow").show();
        $(".leftarrow").hide();
        $(".uparrow").show();
        $(".downarrow").hide();
    }else{
        $(".rightarrow").show();
        $(".leftarrow").show();
        $(".uparrow").show();
        $(".downarrow").show();
    }

}
function closeclick() {
    $('body').css('background-image','url(images/bg.jpg)');
    $('#book').hide();
    $('#buttons').hide();
}

function getQueryString(name) {
    var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)", "i");
    var r = window.location.search.substr(1).match(reg);
    if (r != null) return r[2]; return 0;
}