<?php

//----------- 模版相关 ------------
/**
 * 加载模版
 * @param string $name 模版名称
 * @param array $vars 模版变量
 */
function load_template($name, $vars = array()) {
    _load_template(get_tpl_path($name), $vars);
}

/**
 * 获取模版内容
 * @param $name
 * @param array $vars
 * @return string
 */
function get_html_content($name, $vars = array()) {
    ob_start();
    load_template($name, $vars);
    $content = ob_get_contents();
    ob_end_clean();
    return $content;
}


/**
 * 加载模版私有函数
 * @param $path
 * @param array $vars
 */
function _load_template($path, $vars = array()) {
    //各个模版的变量共享
    static $data = array();
    if ($vars) {
        $data = array_merge($data, $vars);
    }
    extract($data);
    include $path;
}

/**
 * get tpl
 * @param $template_file
 * @return string
 */
function get_tpl_path($template_file) {
    $template_file = dirname(dirname(__FILE__)). "/tpl/" . $template_file . ".tpl";
    return $template_file;
}

function make_html($content, $file) {

    $myfile = fopen($file, "w") or die("Unable to open file!");

    $res=fwrite($myfile, $content);

    fclose($myfile);

    return $res;

}