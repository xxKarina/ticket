<?php
/**
 * Created by PhpStorm.
 * User: yxx
 * Date: 2016/8/14
 * Time: 14:51
 */
session_start();
//定义一个常量，用来授权调用includes里面的文件
define('IN_TG',true);
//定义一个常量，用来指定本页的内容
define('SCRIPT','member_modify');
//引入公共调用函数(公共文件)
require dirname(__FILE__).'/includes/common.inc.php';
//修改资料
if(isset($_GET['action'])&&$_GET['action']=='modify'){
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
        //为了防止cookie伪造，还要比对一下唯一标识符uniqid()
        _uniqid($_rows['tg_uniqid'],$_COOKIE['uniqid']);
        include ROOT_PATH . 'includes/check.func.php';
        $_clean = array();
        $_clean['password'] = _check_modify_password($_POST['password'], 6);
        $_clean['sex'] = _check_sex($_POST['sex']);
        $_clean['face'] = _check_sex($_POST['face']);
        $_clean['email'] = _check_email($_POST['email'], 6, 40);
        $_clean['qq'] = _check_qq($_POST['qq']);
        $_clean['url'] = _check_url($_POST['url'], 40);

        //修改资料
        if (empty($_clean['password'])) {
            _query("UPDATE tg_user SET
                                   tg_sex='{$_clean['sex']}',
                                   tg_face='{$_clean['face']}',
                                   tg_email='{$_clean['email']}',
                                   tg_qq='{$_clean['qq']}',
                                   tg_url='{$_clean['url']}'
                                WHERE
                                   tg_username='{$_COOKIE['username']}'
                                   ");
        } else {
            _query("UPDATE tg_user SET
                                   tg_password='{$_clean['password']}',
                                   tg_sex='{$_clean['sex']}',
                                   tg_face='{$_clean['face']}',
                                   tg_email='{$_clean['email']}',
                                   tg_qq='{$_clean['qq']}',
                                   tg_url='{$_clean['url']}'
                                WHERE
                                   tg_username='{$_COOKIE['username']}'
                                   ");
        }
    }
    //判断是否修改成功
    if(_affected_rows()==1){
        _close();
        _session_destroy();
        _location('恭喜你，修改成功！','member.php');
    }else{
        _close();
        _session_destroy();
        _location('未修改！','member.modify.php');
    }
}
//是否正常登录
if(isset($_COOKIE['username'])){
    //获取数据
    $_rows=_fetch_array("SELECT tg_username,tg_sex,tg_face,tg_email,tg_url,tg_qq FROM tg_user WHERE tg_username='{$_COOKIE['username']}'");
    if($_rows){
        $_html=array();
        $_html['username']=$_rows['tg_username'];
        $_html['sex']=$_rows['tg_sex'];
        $_html['face']=$_rows['tg_face'];
        $_html['email']=$_rows['tg_email'];
        $_html['url']=$_rows['tg_url'];
        $_html['qq']=$_rows['tg_qq'];
        $_html=_html($_html);

        //性别选择
        if($_html['sex']=='男'){
            $_html['sex_html']='<input type="radio" name="sex" value="男" checked="checked">男<input type="radio" name="sex" value="女">女';
        }elseif($_html['sex']=='女'){
            $_html['sex_html']='<input type="radio" name="sex" value="女" checked="checked">女<input type="radio" name="sex" value="男">男';
        }
        //头像选择
        $_html['face_html']='<select name="face">';
        foreach(range(1,9)as $_num){
            $_html['face_html'].='<option value="face/0'.$_num.'.png">face/0'.$_num.'.png</option>';
        }
        foreach(range(10,21)as $_num){
            $_html['face_html'].='<option value="face/'.$_num.'.png">face/0'.$_num.'.png</option>';
        }
        $_html['face_html'].='</select>';
    }else{
        _alert_back('此用户不存在');
    }
}else{
    _alert_back('非法登录');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>多用户留言系统--个人中心</title>
    <?PHP
    require ROOT_PATH.'includes/title.inc.php';
    ?>
    <script type="text/javascript" src="js/code.js"></script>
    <script type="text/javascript" src="js/member_modify.js"></script>
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
            <h2>会员管理中心</h2>
            <form method="post" action="member_modify.php?action=modify">
            <dl>
                <dd>用 户 名：<?php echo $_html['username']?></dd>
                <dd>密　　码： <input type="password" class="text" name="password"> (留空则不修改)</dd>
                <dd>性　　别： <?php echo $_html['sex_html']?></dd>
                <dd>头　　像：<?php echo $_html['face_html']?></dd>
                <dd>电子邮件：<input type="text" class="text" name="email" value="<?php echo $_html['email']?>"></dd>
                <dd>主　　页：<input type="text" class="text" name="url" value="<?php echo $_html['url']?>"></dd>
                <dd>Q　 　Q：<input type="text" class="text" name="qq" value="<?php echo $_html['qq']?>"></dd>
                <dd>　验证码：<input type="text" name="code" class="text yzm"><img src="code.php" alt="" id="code"/></dd>
                <dd><input type="submit" class="submit" value="修改资料"></dd>
            </dl>
            </form>
        </div>
    </div>
    <?php
    require ROOT_PATH.'includes/footer.inc.php';

    ?>
    </body>
</html>
