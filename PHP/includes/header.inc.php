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
?>

<div id="header">
    <h1><a href="index.php">广东海洋大学多用户留言系统</a></h1>
    <ul>
        <li><a href="index.php">首页</a></li>
        <?php
            if(isset($_COOKIE['username'])){
                echo  '<li><a href="member.php">'.$_COOKIE['username'].'·个人中心</a></li>';
                echo "\n";
            }else{
                echo '<li><a href="register.php">注册</a></li>';
                echo "\n";
                echo "\t\t";
                echo '<li><a href="login.php">登录</a></li>';
                echo "\n";
            }
        ?>
        <li><a href="blog.php">博友</a></li>
        <li>风格</li>
        <li>管理</li>
        <?php
            echo '<li><a href="logout.php">退出</a></li>';
        ?>
    </ul>
</div>
