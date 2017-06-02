<?='<?php'?>

/*
* for <?=$plateform?><?=PHP_EOL?>
* <?=$component_name?> 模板文件，功能包括：
* 			1.生成 array
* 			2.将生成的 array 序列化后，保存至 cms_result_preview.content
* 变量命名规范：
* 			所有包括的php内变量都以_开头，如$_ci
*/
// 用到的参数名称 {{{
$object_info_each;
// }}}
// 生成html
$_is_check_ok = true;
$_html = $object_info_each["content"];
// 入库 {{{
$_result_info["content"] = $_html;
$_result_info["sort"]	 = $object_info_each["sort"];
$_result_info["status"]  = $object_info_each["status"];
$_result_info["page_id"] = $object_info_each["page_id"];
$_result_info["start_date"] = $object_info_each["start_date"];
$_result_info["end_date"] = $object_info_each["end_date"];
$_result_info["last_change_time"] = date("Y-m-d H:i:s");
if ( !resultManager:: updateResult($_result_info, $object_info_each["id"], "cms_result_preview", 0, 0)){
    $_is_check_ok = false;
}
// }}}
<?='?>'?>