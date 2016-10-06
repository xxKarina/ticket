<?php
/**
 * Created by PhpStorm.
 * User: yxx
 * Date: 2016/8/15
 * Time: 13:55
 */
//定义一个常量，用来授权调用includes里面的文件
define('IN_TG',true);
//定义一个常量，用来指定本页的内容
define('SCRIPT','member_message');
//引入公共调用函数(公共文件)
require dirname(__FILE__).'/includes/common.inc.php';
//分页模块
_page("SELECT tg_id FROM tg_message",5);//第一个参数获取总条数，第二个人参数，指定每页多少条
$_result=_query("SELECT
                        tg_id,
                        tg_fromuser,
                        tg_content,
                        tg_date
                    FROM
                        tg_message
                ORDER BY
                        tg_date DESC
                    LIMIT
                        $_page_num,
                        $_pagesize
                  ");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>多用户留言系统--短信列表</title>
        <?php
        require ROOT_PATH.'includes/title.inc.php';
        ?>
        </head>
        <body>
        <?php
        require ROOT_PATH.'includes/header.inc.php';
        ?>
        <div id="member">
        <?php
        require ROOT_PATH.'includes/member.inc.php';
        ?>
            <div id="member_main">
                <h2>短信管理中心</h2>
                <table cellspacing="1">
                    <tr><th>发信人</th><th>短信内容</th><th>时间</th><th>操作</th></tr>
                    <?php
                        while(!!$_rows=_fetch_array_list($_result)){
                    ?>
                    <tr><td>发信人</td><td>短信内容</td><td>时间</td><td>操作</td></tr>
                    <?php
                        }
                    _free_result($_result);
                    ?>
                </table>
            </div>
            </div>
        <?php
        require ROOT_PATH.'includes/footer.inc.php';
        ?>
        </body>
</html>