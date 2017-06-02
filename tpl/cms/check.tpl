<?='<?php'?>

/*
*for <?=$plateform?>
*   “<?=$component_name?>”检查配置，检查包括:
*   1.表头项 是否正确
*   2.场次名称 是否配置
*变量命名规范：
*   所有包括的php内变量都以_开头，如$_ci
*/

// 用到的参数名称 {{{
$eachSheet_array;
// }}}
// 检查表头是否正确
/*
* 表头引用说明
<?php foreach ($excel_head as $k=>$v){ ?>
*$eachSheet_array[0][<?=$k?>] => <?=$v?><?=PHP_EOL?>
<?php } ?>
*
* 数据内容引用说明
<?php foreach ($excel_head as $k=>$v){ ?>
*$eachSheet_array[1][<?=$k?>] => <?=$v?><?=PHP_EOL?>
<?php } ?>
*/

$_is_check_ok = true;


//处理共公参数顺序
$name 			= $eachSheet_array[1][<?=$common_start?>];
$sort 			= $eachSheet_array[1][<?=$common_start+1?>];
$status 		= $eachSheet_array[1][<?=$common_start+2?>];
$object_id 		= $eachSheet_array[1][<?=$common_start+3?>];
$component_id 	= $eachSheet_array[1][<?=$common_start+4?>];
$start_date 	= isset($eachSheet_array[1][<?=$common_start+5?>]) ? handleExcelDateFiled($eachSheet_array[1][<?=$common_start+5?>]) : "";
$end_date 		= isset($eachSheet_array[1][<?=$common_start+6?>]) ? handleExcelDateFiled($eachSheet_array[1][<?=$common_start+6?>]) : "";

$check_excel_head = array(
<?php foreach ($excel_head as $k=>$v){ ?>
    "<?=$v?>",
<?php } ?>
);

for($_ci = 0,$_cc = count($eachSheet_array[0]);$_ci < $_cc; $_ci++){
    if (!isset($eachSheet_array[0][$_ci]) || !in_array($eachSheet_array[0][$_ci], $check_excel_head)){
        $_is_check_ok = false;
        $msg = "数据项错误：不存在名为 “".$eachSheet_array[0][$_ci]."” 的数据项";
        break;
    }
}

if ( empty($name) || empty($sort) || empty($status)	|| empty($object_id) || empty($component_id) ){
    $_is_check_ok = false;
    $msg = "数据项错误：实例名称/显示顺序/组件状态/object_id/component_id 不能为空";
}

if ($_is_check_ok){
// 判断当前页面是否已经存在该排序号
    $_sortWhereArray = array();
    $_sortWhereArray["page_id"] = $page_id;
    $_sortWhereArray["sort"] = $sort;
    $_data_preview_cc = objectManager::getObjectCount($_sortWhereArray, $object_id, "cms_object_preview");
    if ($_data_preview_cc["cc"] > 0) {
        $_is_check_ok = false;
        $msg = "当前页已经存在显示顺序为 ".$sort." 的组件，请重新指定显示顺序";
    }
}

// 检查 数据项是否填写
if ($_is_check_ok){
    $_db_data = array();

    //setting配置校验,只校验第一行
    // 配置
<?php for($i=$setting_start;$i<$common_start;$i++){?>
    $eachSheet_array[1][<?=$i?>] = isset($eachSheet_array[1][<?=$i?>]) ? trim($eachSheet_array[1][<?=$i?>]) : ""; //<?=$excel_head[$i]?><?=PHP_EOL?>
<?php } ?>


    //校验非空
    for($_cj=<?=$setting_start?>;$_cj<<?=$common_start?>;$_cj++){
        if (empty($eachSheet_array[1][$_cj])){
            $_is_check_ok = false;
            $msg = "数据内容错误：第 ".($i+1)." 张excel表 第 1 行 ".$check_excel_head[$_cj]." 为空";
        }
    }

<?php if(!empty($setting_link)){?>
    //字典校验
    <?php foreach ($setting_link as $v){?>
$eachSheet_array[1][<?=$v?>] = trimall($eachSheet_array[1][<?=$v?>]);
    if (!isInDictionary($eachSheet_array[1][<?=$v?>])){
        $_is_check_ok = false;
        $msg = "数据内容错误：第 ".($i+1)." 张excel表 第 1 行 ".$check_excel_head[<?=$v?>]." 字典不合法";
    }
    <?php }
}?>

    //从第一行开始判断数据是否正确，去除表头的占位
    for($_ci = 1,$_db_index = 0,$_cc = count($eachSheet_array);$_ci < $_cc; $_ci++,$_db_index++){
<?php for($i=0;$i<$data_end;$i++){?>
        $eachSheet_array[$_ci][<?=$i?>] = isset($eachSheet_array[$_ci][<?=$i?>]) ? trim($eachSheet_array[$_ci][<?=$i?>]) : "";
<?php } ?>

    //校验非空
    for($_cj=0;$_cj<<?=$data_end?>;$_cj++){
        if (empty($eachSheet_array[$_ci][$_cj])){
            $_is_check_ok = false;
            $msg = "数据内容错误：第 ".($i+1)." 张excel表 第 ".$_ci." 行 ".$check_excel_head[$_cj]." 为空";
            break;
        }
    }

<?php if(!empty($data_link)){?>
    //字典校验
    <?php foreach ($data_link as $v){?>
        $eachSheet_array[1][<?=$v?>] = trimall($eachSheet_array[1][<?=$v?>]);
        if (!isInDictionary($eachSheet_array[1][<?=$v?>])){
        $_is_check_ok = false;
        $msg = "数据内容错误：第 ".($i+1)." 张excel表 第 1 行 ".$check_excel_head[<?=$v?>]." 字典不合法";
        break;
        }
    <?php }
}?>

    //key = value
<?php foreach ($data_names as $k=>$v){?>
    $_db_data[$_db_index]["<?=$v?>"] 	= $eachSheet_array[$_ci][<?=$k?>];
<?php } ?>

   }
}

//逐条入库
if($_is_check_ok){
    //初始化
    $_db_data_all = array();
    //0是组件的内容配置
    $_db_data_all[] = $_db_data;
    //1是组件的属性配置
    $_db_data_all[] = array(
<?php foreach ($setting_names as $k=>$v){?>
    "<?=$v?>"               => $eachSheet_array[1][<?=$setting_start+$k?>],	//<?=$excel_head[$setting_start+$k]?><?=PHP_EOL?>
<?php } ?>
    );
<?php if($data_type ==2){?>
    $_db_data_all = serialize($_db_data_all);
<?php }else{ ?>
    $_db_data_all = array_iconv("gbk", "UTF-8",$_db_data_all);
    $_db_data_all = json_encode($_db_data_all);
<?php } ?>
    $_object_info["name"] 				= $name;
    $_object_info["content"] 			= $_db_data_all;
    $_object_info["sort"] 				= $sort;
    $_object_info["component_id"] 		= $component_id;
    if (isset($start_date)){
        $_object_info["start_date"]		= $start_date;
    }
    if (isset($end_date)){
        $_object_info["end_date"]		= $end_date;
    }
    $_object_info["status"] 			= $status;
    $_object_info["last_change_time"]	= date("Y-m-d H:i:s");
    if (!objectManager::updateObject($_object_info, $object_id, "cms_object_preview")) {
        $_is_check_ok = false;
        $msg = "数据入库错误";
    }
}

