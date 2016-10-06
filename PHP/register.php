<?php
/**
 * Created by PhpStorm.
 * User: yxx
 * Date: 2016/8/4
 * Time: 9:10
 */
session_start();
//定义一个常量，用来授权调用includes里面的文件
define('IN_TG',true);
//定义一个常量，用来指定本页的内容
define('SCRIPT','register');
//引入公共调用函数(公共文件)
require dirname(__FILE__).'/includes/common.inc.php';
//登录状态
_login_state();
//判断是否提交了
$_uniqid='';
if(isset($_GET['action']) && $_GET['action']=='register'){
    //为了防止恶意注册，跨站攻击
    _check_code($_POST['code'],$_SESSION['code']);
    //引入验证文件
    include ROOT_PATH.'includes/check.func.php';
    //创建一个空数组，用来存放提交过来的合法数据
    $_clean=array();
    //可以通过唯一标识符来防止恶意注册，伪装表单跨站攻击等
    //这个存放在数据库的唯一标识符还有第二个用处，就是登录cookie验证
    $_clean['uniqid']=_check_uniqid($_POST['uniqid'],$_SESSION['uniqid']);
    //active也是一个唯一标识符，刚注册的用户借其进行激活处理，方可登录
    $_clean['active']= _sha1_uniqid();
    $_clean['username']=_check_username($_POST['username'],2,20);
    $_clean['password']=_check_password($_POST['password'],$_POST['notpassword'],6);
    $_clean['question']=_check_question($_POST['question'],2,20);
    $_clean['answer']=_check_answer($_POST['question'],$_POST['answer'],2,20);

    $_clean['sex']=_check_sex($_POST['sex']);
    $_clean['face']=_check_sex($_POST['face']);
    $_clean['email']=_check_email($_POST['email'],6,40);
    $_clean['qq']=_check_qq($_POST['qq']);
    $_clean['url']=_check_url($_POST['url'],40);
    //在新增之前，要判断用户名是否重复
    _is_repeat(
        "SELECT tg_username FROM tg_user WHERE tg_username='{$_clean['username']}'LIMIT 1",
        '此用户已被注册！'
    );
    //新增用户
    //在双引号里面，直接放变量是可以的，比如$_username,但如果是数组，就必须加上{}，比如{$_clean['username']}
    _query(
        "INSERT INTO tg_user(
                              tg_uniqid,
                              tg_active,
                              tg_username,
                              tg_password,
                              tg_question,
                              tg_answer,
                              tg_sex,
                              tg_face,
                              tg_email,
                              tg_qq,
                              tg_url,
                              tg_reg_time,
                              tg_last_time,
                              tg_last_ip
                              )
                              VALUES(
                              '{$_clean['uniqid']}',
                              '{$_clean['active']}',
                              '{$_clean['username']}',
                              '{$_clean['password']}',
                              '{$_clean['question']}',
                              '{$_clean['answer']}',
                              '{$_clean['sex']}',
                              '{$_clean['face']}',
                              '{$_clean['email']}',
                              '{$_clean['qq']}',
                              '{$_clean['url']}',
                              NOW(),
                              NOW(),
                              '{$_SERVER["REMOTE_ADDR"]}'
                              )"
    );
if(_affected_rows()==1) {
    _close();
    _location('恭喜你，注册成功！', 'active.php?active='.$_clean['active']);
}else{
    _close();
    _location('很遗憾，注册失败！','register.php');
}
    }else {
    $_SESSION['uniqid'] = $_uniqid = _sha1_uniqid();
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>多用户留言系统--注册</title>
    <?PHP
    require ROOT_PATH.'includes/title.inc.php';
    ?>
    <script type="text/javascript" src="js/code.js"></script>
    <script type="text/javascript" src="js/register.js"></script>
</head>
<body>
<?php
require ROOT_PATH.'includes/header.inc.php';

?>

<div id="register">
    <h2>会员注册</h2>
    <form action="register.php?action=register" method="post" name="register">
        <input type="hidden" name="uniqid" value="<?php echo $_uniqid?>">
        <dl>
            <dt>请认真填写以下内容</dt>
            <dd>　用户名：<input type="text" name="username" class="text"> (*必填，至少两位)</dd>
            <dd>密　　码：<input type="password" name="password" class="text"> (*必填，至少六位)</dd>
            <dd>确认密码：<input type="password" name="notpassword" class="text"> (*必填，同上)</dd>
            <dd>密码提示：<input type="text" name="question" class="text"> (*必填，至少两位)</dd>
            <dd>密码回答：<input type="text" name="answer" class="text"> (*必填，至少两位)</dd>
            <dd>性　　别：<input type="radio" name="sex" value="男" checked="checked">男<input type="radio" name="sex" value="女">女</dd>
            <dd class="face"><input type="hidden" name="face" value="face/01.png"><img src="face/01.png" alt="图像选择" id="faceimg"/></dd>
            <dd>电子邮件：<input type="text" name="email" class="text"> (*必填，激活账户)</dd>
            <dd>　ＱＱ　：<input type="text" name="qq" class="text"></dd>
            <dd>主页地址：<input type="text" name="url" class="text" value="http://"></dd>
            <dd>　验证码：<input type="text" name="code" class="text yzm"><img src="code.php" alt="" id="code"/></dd>
            <dd><input type="submit" class="submit" value="注册"></dd>
        </dl>
    </form>
</div>

<?php
require ROOT_PATH.'includes/footer.inc.php';
?>
</body>
</html>
