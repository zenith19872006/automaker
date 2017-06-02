<?php

$root=dirname(dirname(__FILE__));

require_once $root.'/inc/function.php';

//想要制作的组件编号
$components = array(471,472);

foreach ($components as $component_no){

    echo '开始制作组件'.$component_no.PHP_EOL;

    //检查配置文件
    $conf_path = $root.'/cms/conf/'.$component_no.'.php';

    if(!file_exists($conf_path)){
        echo '没有配置文件!'.PHP_EOL;
        break;
    }else{
        require_once $conf_path;
    }

    $make_parts=array('check','fields','html','settings');

    foreach ($make_parts as $v){

        $html_content = get_html_content('cms/'.$v,$params);

        $file_path=$root.'/cms/'.$v.'/'.$component_no.'.php';

        $res=make_html($html_content,$file_path);

        if($res){
            echo $v.'制作成功'.PHP_EOL;
        }else{
            echo $v.'制作失败'.PHP_EOL;
        }
    }

    echo PHP_EOL;
}
