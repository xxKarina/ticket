<?php
/**
 * Created by PhpStorm.
 * User: yxx
 * Date: 2016/8/13
 * Time: 15:41
 */
session_start();
//定义一个常量，用来授权调用includes里面的文件
define('IN_TG',true);
//引入公共调用函数(公共文件)
require dirname(__FILE__).'/includes/common.inc.php';
_unsetcookies();
?>