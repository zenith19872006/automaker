$(window).ready(function() {

        var pagenum=$('#book').children('div').length;

        for(var i=1;i<=pagenum;i++){
            $('#page'+i).css('background-image','url(images/'+i+'.jpg?7)');
        }

        $('#book').turn({
            display: 'single',
            acceleration: true,
            duration:2000,
            gradients: true,
            elevation:50,
            when: {
                turning:function (e, page) {

                    // if(page == 1){
                    //     $("#left").hide();
                    //     $("#right").show();
                    //     $("#up").hide();
                    //     $("#down").css('top','0px');
                    //     $("#down").show();
                    //     $("#close").hide();
                    // }else if(page == pagenum){
                    //     $("#left").show();
                    //     $("#right").hide();
                    //     $("#up").show();
                    //     $("#down").hide();
                    //     $("#close").show();
                    // }else{
                    //     $("#left").show();
                    //     $("#right").show();
                    //     $("#up").show();
                    //     $("#down").css('top','30px');
                    //     $("#down").show();
                    //     $("#close").hide();
                    // }

                }
            }
        });

});

var winwidth = $(window).width();



function next() {
    $('#book').turn('next');
}

function previous() {
    $('#book').turn('previous');
}

function closeclick() {
    $('body').css('background-image','url(images/bg.jpg)');
    $('#book').hide();
    $('#buttons').hide();
}