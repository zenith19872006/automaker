<?php

$root=dirname(dirname(__FILE__));

require_once $root.'/inc/function.php';

echo '制作book开始'.'<br/>';

//制作编号-对应属性
//direction:0横版 1竖版
$infos=array(
    '1'=>array('direction'=>0,'imgnum'=>2,'videos'=>array()),
    '2'=>array('direction'=>1,'imgnum'=>5,'videos'=>array()),
    '3'=>array('direction'=>1,'imgnum'=>2,'videos'=>array(2)),
    '4'=>array('direction'=>0,'imgnum'=>5,'videos'=>array(2,3)),
    '6'=>array('direction'=>1,'imgnum'=>2,'videos'=>array()),
    '7'=>array('direction'=>1,'imgnum'=>2,'videos'=>array()),
    '8'=>array('direction'=>1,'imgnum'=>5,'videos'=>array()),
    '9'=>array('direction'=>1,'imgnum'=>2,'videos'=>array()),
    '10'=>array('direction'=>1,'imgnum'=>2,'videos'=>array()),
    '11'=>array('direction'=>1,'imgnum'=>2,'videos'=>array()),
    '12'=>array('direction'=>0,'imgnum'=>3,'videos'=>array()),
);

echo '<br/>';

$type='books';

foreach ($infos as $no=>$info){

    echo '开始制作'.$no.'号：'.'<br/>';

    echo '加载头部...'.'<br/>';
    $html_content = get_html_content('start',array('type'=>$type,'info'=>$info));

    echo '加载书本组件...'.'<br/>';
    echo '图片'.$info['imgnum'].'张 视频'.count($info['videos']).'张'.'<br/>';
    $html_content .= get_html_content('/component/book',$info);

    //echo '加载遮罩组件...'.'<br/>';
    //$html_content .= get_html_content('/component/mask',$info);

    echo '加载翻页箭头组件...'.'<br/>';
    $html_content .= get_html_content('/component/arrow',$info);

    echo '加载尾部...'.'<br/>';
    $html_content .= get_html_content('end',array('type'=>$type));

    echo '加载特殊部分...'.'<br/>';
    $html_content .= get_html_content('/books/'.$no);

    $file_name=$root.'/books/'.$no.'/index.html';
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


