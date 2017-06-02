<style type="text/css">
    #video2{
        position: absolute;
        transform:rotate(-79.5deg);
        -ms-transform:rotate(-79.5deg); 	/* IE 9 */
        -moz-transform:rotate(-79.5deg); 	/* Firefox */
        -webkit-transform:rotate(-79.5deg); /* Safari 和 Chrome */
        -o-transform:rotate(-79.5deg); 	/* Opera */
    }
</style>

<script>

    $("#video2").attr('src','videos/2.gif');

    var widthpx=winwidth*0.82;
    var heightpx=winheight*0.27;
    var toppx= widthpx*0.98*0.5-heightpx*0.5+winheight*0.0575;
    var leftpx= -0.12*widthpx+winheight*0.0475;

    $('#video2').css('top',toppx+'px');
    $('#video2').css('left',leftpx+'px');
    $('#video2').css('width',widthpx+'px');
    $('#video2').css('height',heightpx+'px');


</script>