<?php
/**
 * Created by PhpStorm.
 * User: yxx
 * Date: 2016/8/4
 * Time: 15:29
 */
session_start();
//定义一个常量，用来授权调用includes里面的文件
define('IN_TG',true);
//引入公共调用函数(公共文件)
require dirname(__FILE__).'/includes/common.inc.php';

//运行验证码函数
//默认验证码大小为：75*25，默认位数是4位，如果要六位，长度推荐125，如果要8位，推荐175
//第四个参数是，是否要边框，默认是false
//可以通过数据库的方法来设置验证码的各种属性
    _code();
?>