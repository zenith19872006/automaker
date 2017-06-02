<?='<?php'?>

/*
* for <?=$plateform?><?=PHP_EOL?>
* <?=$component_name?> 的修改配置项
*/
$settings_array = array(
    array(
<?php for($i=$setting_start;$i<$common_start;$i++){?>
    '<?=$excel_head[$i]?>',
<?php } ?>
    ), 	// 表头
    array(
<?php foreach ($setting_default as $k=>$v){ ?>
    '<?=$v?>',
<?php } ?>
    )	// 内容
);
<?='?>'?>