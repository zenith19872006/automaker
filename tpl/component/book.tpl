<div id="book">
    <?php for($i=1;$i<=$imgnum;$i++){
        echo '<div id="page'.$i.'">';
        if(in_array($i,$videos)) echo '<img id="video'.$i.'"/>';
        echo '</div>';
    }?>
</div>

