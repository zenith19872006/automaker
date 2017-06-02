<?php
$idname=($direction)?'utd':'ltr';
?>

<section class="f_mask" id='mask'>
    <div id="<?php echo $idname?>">
        <p><img src="../common/images/<?php echo $idname?>.png" style="height: 80%"></p>
        <p style="color:#fff">请<?php echo ($direction)?'上下':'左右' ?>划动翻页</p>
    </div>
</section>