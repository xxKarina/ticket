<?php
/**
 * TestGuest Version 1.0
 * ======================================================
 * Copy 2016-2017 yc60
 * Web:http://www.yc60.com
 * ======================================================
 * Author:Lee
 * Date:2016/8/3
 */
//防止恶意调用
if(!defined('IN_TG')){
    exit('Forbidden access');
}
//设置编码
header('Content-Type: text/html; charset=utf-8');
    //转换硬路径常量
    define('ROOT_PATH',substr(dirname(__FILE__),0,-8));
//创建一个自动转义状态的常量
define('GPC',get_magic_quotes_gpc());

    //拒绝PHP低版本
    if(PHP_VERSION <'4.1.0'){
        exit('PHP version is too low');
    }
//引入函数库
require ROOT_PATH.'includes/global.func.php';
require ROOT_PATH.'includes/mysql.func.php';
    //执行耗时
define('STRAT_TIME',_runtime());
//$GLOBALS['start_time']=_runtime(); //超级全局变量

//数据库连接
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PWD','');
define('DB_NAME','testguest');
//初始化数据库
_connect(); //连接数据库
_select_db();   //选择数据库
_set_names();   //选择字符集

?>