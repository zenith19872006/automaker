<?php
/*
*for android*   “原生图标列表3”检查配置，检查包括:
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
*$eachSheet_array[0][0] => 图片url
*$eachSheet_array[0][1] => 链接地址
*$eachSheet_array[0][2] => 显示文字
*$eachSheet_array[0][3] => 副标题
*$eachSheet_array[0][4] => 归属模块
*$eachSheet_array[0][5] => 楼层唯一标识
*$eachSheet_array[0][6] => 楼层主标题
*$eachSheet_array[0][7] => 楼层副标题
*$eachSheet_array[0][8] => 楼层标题链接
*$eachSheet_array[0][9] => 楼层下方间隔
*$eachSheet_array[0][10] => 实例名称
*$eachSheet_array[0][11] => 显示顺序
*$eachSheet_array[0][12] => 组件状态
*$eachSheet_array[0][13] => object_id
*$eachSheet_array[0][14] => component_id
*$eachSheet_array[0][15] => start_date
*$eachSheet_array[0][16] => end_date
*
* 数据内容引用说明
*$eachSheet_array[1][0] => 图片url
*$eachSheet_array[1][1] => 链接地址
*$eachSheet_array[1][2] => 显示文字
*$eachSheet_array[1][3] => 副标题
*$eachSheet_array[1][4] => 归属模块
*$eachSheet_array[1][5] => 楼层唯一标识
*$eachSheet_array[1][6] => 楼层主标题
*$eachSheet_array[1][7] => 楼层副标题
*$eachSheet_array[1][8] => 楼层标题链接
*$eachSheet_array[1][9] => 楼层下方间隔
*$eachSheet_array[1][10] => 实例名称
*$eachSheet_array[1][11] => 显示顺序
*$eachSheet_array[1][12] => 组件状态
*$eachSheet_array[1][13] => object_id
*$eachSheet_array[1][14] => component_id
*$eachSheet_array[1][15] => start_date
*$eachSheet_array[1][16] => end_date
*/

$_is_check_ok = true;


//处理共公参数顺序
$name 			= $eachSheet_array[1][10];
$sort 			= $eachSheet_array[1][11];
$status 		= $eachSheet_array[1][12];
$object_id 		= $eachSheet_array[1][13];
$component_id 	= $eachSheet_array[1][14];
$start_date 	= isset($eachSheet_array[1][15]) ? handleExcelDateFiled($eachSheet_array[1][15]) : "";
$end_date 		= isset($eachSheet_array[1][16]) ? handleExcelDateFiled($eachSheet_array[1][16]) : "";

$check_excel_head = array(
    "图片url",
    "链接地址",
    "显示文字",
    "副标题",
    "归属模块",
    "楼层唯一标识",
    "楼层主标题",
    "楼层副标题",
    "楼层标题链接",
    "楼层下方间隔",
    "实例名称",
    "显示顺序",
    "组件状态",
    "object_id",
    "component_id",
    "start_date",
    "end_date",
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
    $eachSheet_array[1][4] = isset($eachSheet_array[1][4]) ? trim($eachSheet_array[1][4]) : ""; //归属模块
    $eachSheet_array[1][5] = isset($eachSheet_array[1][5]) ? trim($eachSheet_array[1][5]) : ""; //楼层唯一标识
    $eachSheet_array[1][6] = isset($eachSheet_array[1][6]) ? trim($eachSheet_array[1][6]) : ""; //楼层主标题
    $eachSheet_array[1][7] = isset($eachSheet_array[1][7]) ? trim($eachSheet_array[1][7]) : ""; //楼层副标题
    $eachSheet_array[1][8] = isset($eachSheet_array[1][8]) ? trim($eachSheet_array[1][8]) : ""; //楼层标题链接
    $eachSheet_array[1][9] = isset($eachSheet_array[1][9]) ? trim($eachSheet_array[1][9]) : ""; //楼层下方间隔


    //校验非空
    for($_cj=4;$_cj<10;$_cj++){
        if (empty($eachSheet_array[1][$_cj])){
            $_is_check_ok = false;
            $msg = "数据内容错误：第 ".($i+1)." 张excel表 第 1 行 ".$check_excel_head[$_cj]." 为空";
        }
    }

    //字典校验
    $eachSheet_array[1][8] = trimall($eachSheet_array[1][8]);
    if (!isInDictionary($eachSheet_array[1][8])){
        $_is_check_ok = false;
        $msg = "数据内容错误：第 ".($i+1)." 张excel表 第 1 行 ".$check_excel_head[8]." 字典不合法";
    }
    
    //从第一行开始判断数据是否正确，去除表头的占位
    for($_ci = 1,$_db_index = 0,$_cc = count($eachSheet_array);$_ci < $_cc; $_ci++,$_db_index++){
        $eachSheet_array[$_ci][0] = isset($eachSheet_array[$_ci][0]) ? trim($eachSheet_array[$_ci][0]) : "";
        $eachSheet_array[$_ci][1] = isset($eachSheet_array[$_ci][1]) ? trim($eachSheet_array[$_ci][1]) : "";
        $eachSheet_array[$_ci][2] = isset($eachSheet_array[$_ci][2]) ? trim($eachSheet_array[$_ci][2]) : "";
        $eachSheet_array[$_ci][3] = isset($eachSheet_array[$_ci][3]) ? trim($eachSheet_array[$_ci][3]) : "";

    //校验非空
    for($_cj=0;$_cj<4;$_cj++){
        if (empty($eachSheet_array[$_ci][$_cj])){
            $_is_check_ok = false;
            $msg = "数据内容错误：第 ".($i+1)." 张excel表 第 ".$_ci." 行 ".$check_excel_head[$_cj]." 为空";
            break;
        }
    }

    //字典校验
            $eachSheet_array[1][1] = trimall($eachSheet_array[1][1]);
        if (!isInDictionary($eachSheet_array[1][1])){
        $_is_check_ok = false;
        $msg = "数据内容错误：第 ".($i+1)." 张excel表 第 1 行 ".$check_excel_head[1]." 字典不合法";
        break;
        }
    
    //key = value
    $_db_data[$_db_index]["img_url"] 	= $eachSheet_array[$_ci][0];
    $_db_data[$_db_index]["link_url"] 	= $eachSheet_array[$_ci][1];
    $_db_data[$_db_index]["show_word"] 	= $eachSheet_array[$_ci][2];
    $_db_data[$_db_index]["show_word"] 	= $eachSheet_array[$_ci][3];
    $_db_data[$_db_index]["sub_title"] 	= $eachSheet_array[$_ci][4];

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
    "model_name"               => $eachSheet_array[1][4],	//归属模块
    "floor_identification"               => $eachSheet_array[1][5],	//楼层唯一标识
    "floor_title"               => $eachSheet_array[1][6],	//楼层主标题
    "floor_subtitle"               => $eachSheet_array[1][7],	//楼层副标题
    "floor_subtitlelink"               => $eachSheet_array[1][8],	//楼层标题链接
    "has_padding"               => $eachSheet_array[1][9],	//楼层下方间隔
    );
    $_db_data_all = array_iconv("gbk", "UTF-8",$_db_data_all);
    $_db_data_all = json_encode($_db_data_all);
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

