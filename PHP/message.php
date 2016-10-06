<?php
/**
 * Created by PhpStorm.
 * User: yxx
 * Date: 2016/8/15
 * Time: 10:21
 */
//定义一个常量，用来授权调用includes里面的文件
define('IN_TG',true);
//定义一个常量，用来指定本页的内容
define('SCRIPT','message');
//引入公共调用函数(公共文件)
require dirname(__FILE__).'/includes/common.inc.php';
//判断是否登录了
if(!isset($_COOKIE['username'])){
    _alert_close('请先登录！');
}
//写短信
if(isset($_GET['action'])&&$_GET['action']=='write'){
    _check_code($_POST['code'],$_SESSION['code']);
if (!!$_rows=_fetch_array("SELECT
                                    tg_uniqid
                              FROM
                                    tg_user
                             WHERE
                                    tg_username='{$_COOKIE['username']}'
                                    LIMIT
                                    1
                           ")) {
    _uniqid($_rows['tg_uniqid'],$_COOKIE['uniqid']);
    include ROOT_PATH.'includes/check.func.php';
    $_clean=array();
    $_clean['touser']=$_POST['touser'];
    $_clean['fromuser']=$_COOKIE['username'];
    $_clean['content']=_check_content($_POST['content']);
    $_clean=_mysql_string($_clean);
    //写入表
    _query("INSERT INTO tg_message(
                                        tg_touser,
                                        tg_fromuser,
                                        tg_content,
                                        tg_date
                                    )
                               VALUES(
                                        '{$_clean['touser']}',
                                        '{$_clean['fromuser']}',
                                        '{$_clean['content']}',
                                        NOW()
                                    )
    ");
    //新增成功
    if(_affected_rows()==1) {
        _close();
        _session_destroy();
        _alert_close('短信发送成功');
    }else{
        _close();
        _session_destroy();
        _alert_back('短信发送失败');
    }
}else{
    _alert_close('非法登录！');
}
}
//获取数据
if(isset($_GET['id'])){
    if(!!$_rows=_fetch_array("SELECT tg_username FROM tg_user WHERE tg_id='{$_GET['id']}' LIMIT 1")){
        $_html=array();
        $_html['touser']=$_rows['tg_username'];
        $_html=_html($_html);
    }else{
        _alert_close('不存在此用户！');
    }
}else{
    _alert_close('非法操作！');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>多用户留言系统--写短信</title>
    <?PHP
    require ROOT_PATH.'includes/title.inc.php';
    ?>
    <script type="text/javascript" src="js/code.js"></script>
    <script type="text/javascript" src="js/message.js"></script>
</head>
<body>
    <div id="message">
        <h3>写短信</h3>
        <form method="post" action="?action=write">
            <input type="hidden" name="touser" value="<?php echo $_html['touser']?>">
            <dl>
                <dd><input type="text" class="text" value="<?php echo 'TO:'.$_html['touser']?>"></dd>
                <dd><textarea name="content" id="" cols="30" rows="10"></textarea></dd>
                <dd>　验证码：<input type="text" name="code" class="text yzm"><img src="code.php" alt="" id="code"/><input type="submit" class="submit" value="发送短信"></dd>
            </dl>
        </form>
    </div>
</body>
</html>
