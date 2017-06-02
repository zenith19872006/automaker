<style type="text/css">
#video2{
position: absolute;
transform:rotate(6deg);
-ms-transform:rotate(6deg); 	/* IE 9 */
-moz-transform:rotate(6deg); 	/* Firefox */
-webkit-transform:rotate(6deg); /* Safari 和 Chrome */
-o-transform:rotate(6deg); 	/* Opera */
}
#video3{
position: absolute;
transform:rotate(4.1deg);
-ms-transform:rotate(4.1deg); 	/* IE 9 */
-moz-transform:rotate(4.1deg); 	/* Firefox */
-webkit-transform:rotate(4.1deg); /* Safari 和 Chrome */
-o-transform:rotate(4.1deg); 	/* Opera */
}
</style>

<script>

    $("#video2").attr('src','videos/2.gif');
    var toppx= winheight*0.11;
    var leftpx= winwidth*0.09;
    var widthpx=winwidth*0.85;
    var heightpx=winheight*0.27;

    $('#video2').css('top',toppx+'px');
    $('#video2').css('left',leftpx+'px');
    $('#video2').css('width',widthpx+'px');
    $('#video2').css('height',heightpx+'px');


    $("#video3").attr('src','videos/3.gif');
    var toppx= winheight*0.046;
    var leftpx= winwidth*0.12;
    var widthpx=winwidth*0.79;
    var heightpx=winheight*0.25;


    $('#video3').css('top',toppx+'px');
    $('#video3').css('left',leftpx+'px');
    $('#video3').css('width',widthpx+'px');
    $('#video3').css('height',heightpx+'px');


</script>
