<?php

$root=dirname(dirname(__FILE__));

require_once $root.'/inc/function.php';

echo '制作photo开始'.'<br/>';

//制作编号-对应属性
//direction:0横版 1竖版
$infos=array(
    '5'=>array('photonum'=>5,'imgnum'=>7),
);

echo '<br/>';

$type='photos';

foreach ($infos as $no=>$info){

    echo '开始制作'.$no.'号：'.'<br/>';

    echo '加载头部...'.'<br/>';
    $html_content = get_html_content('start',array('type'=>$type,'info'=>$info));

    echo '加载相册组件...'.'<br/>';
    echo '图片'.$info['imgnum'].'张 '.'<br/>';
    $html_content .= get_html_content('/component/photo',$info);

    echo '加载翻页箭头组件...'.'<br/>';
    $html_content .= get_html_content('/component/arrow',array('photo'=>1,'direction'=>0));

    echo '加载尾部...'.'<br/>';
    $html_content .= get_html_content('end',array('type'=>$type)); //echo $html_content;exit;

    $file_name=$root.'/photos/'.$no.'/index.html';
    echo '生成文件: '.$file_name.' ';
    $res=make_html($html_content,$file_name);
    if($res){
        echo '成功';
    }else{
        echo '失败';
    }

    echo '<br/>';
    echo '<br/>';
}


