<?php if($direction){?>
    <div class="arrow uparrow" onclick="previous()"><img src="../common/images/arrow.png"/></div>
    <div class="arrow downarrow" onclick="next()"><img  src="../common/images/arrow.png"/></div>
<?php }else{ ?>
    <div class="arrow rightarrow" onclick="previous()"><img src="../common/images/arrow.png"/></div>
    <div class="arrow leftarrow" onclick="next()" <?php if(isset($photo)) echo 'style="top:52%"'?>><img  src="../common/images/arrow.png"/></div>
<?php } ?>
