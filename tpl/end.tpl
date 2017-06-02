</body>
</html>

<script type="text/javascript" src="../common/js/jquery.min.js"></script>

<?php if($type=='books'){ ?>
<script type="text/javascript" src="../common/js/turn.min.js?20170428"></script>
<script type="text/javascript" src="../common/js/book.js?20170428"></script>
<?php }?>

<?php if($type=='photos'){ ?>
    <script type="text/javascript" src="../common/js/photo.js?20170330a"></script>
<?php }?>

<script>

<?php if($type=='photos'){ ?>
    var photonum=<?php echo $info['photonum']?>;
    var imgnum=<?php echo $info['imgnum']?>;
<?php }?>


<?php if($type=='books'){ ?>
    var touchDirection=<?php echo $info['direction']?>;//0：左右划动 1：上下划动

    //视窗大小
    var winwidth = $(window).width();
    var winheight = $(window).height();
<?php }?>

<?php if($type=='books' && $info['direction']){?>

    var newtop=(winheight-winwidth)/2;
    var newleft=-(winheight-winwidth)/2;

    $('#book').css('width',winheight+'px');
    $('#book').css('height',winwidth+'px');
    $('#book').css('top',newtop+'px');
    $('#book').css('left',newleft+'px');


<?php }?>

</script>
