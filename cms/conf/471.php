<?php

$params=array(
    'plateform'=>'android',
    'component_name'=>'原生图标列表3',
    'data_type'=>1,//入库类型,1 json,2 序列化
    'excel_head'=>array(
        "图片url", "链接地址", "显示文字", "副标题", "归属模块",
        "楼层唯一标识", "楼层主标题", "楼层副标题", "楼层标题链接", "楼层下方间隔",
        "实例名称", "显示顺序", "组件状态", "object_id", "component_id", "start_date", "end_date"),
    'data_names'=>array("img_url","link_url","show_word","show_word","sub_title"),
    'setting_names'=>array("model_name","floor_identification","floor_title","floor_subtitle","floor_subtitlelink","has_padding"),
    'setting_default'=>array("top", "楼层唯一标识", "我的订单", "查看所有订单", "myorder://","1"),
    'common_start'=>10,
    'setting_start'=>4,
    'data_end'=>4,
    'setting_link'=>array(8),
    'data_link'=>array(1),
);