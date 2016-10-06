<?php
/**
 * Created by PhpStorm.
 * User: yxx
 * Date: 2016/8/4
 * Time: 8:46
 */

/**
 * _runtime()是用来获取执行耗时
 * @access public 表示函数对外公开
 * @return float 表示返回出来的是一个浮点型数字
 */
function _runtime(){
    $_mtime=explode(' ',microtime());
    return $_mtime[1]+$_mtime[0];
}

/**
 * @param $_info
 * _alert_back()表示JS弹窗
 * @access public 表示函数对外公开
 * @return void 弹窗
 */
function _alert_back($_info){
    echo "<script type='text/javascript'>alert('$_info');history.back();</script>";
    exit();
}

function _alert_close($_info){
    echo "<script type='text/javascript'>alert('$_info');window.close();</script>";
    exit();
}

function _location($_info,$_url)
{
    if (!empty($_info)) {
        echo "<script type='text/javascript'>alert('$_info');location.href='$_url';</script>";
        exit();
    }else{
        header('Location:'.$_url);
    }
}

function _login_state(){
    if(isset($_COOKIE['username'])){
        _alert_back('登录状态无法进行本操作！');
    }
}

/**
 * _uniqid判断唯一标识符是否异常
 * @param $_mysql_uniqid
 * @param $_cookie_uniqid
 */
function _uniqid($_mysql_uniqid,$_cookie_uniqid){
    if($_mysql_uniqid!=$_cookie_uniqid){
        _alert_back('唯一标识符异常！');
    }
}

/**
 * _html()函数表示对字符串进行HTML过滤显示，如果是数组，
 * 按数组的方式过滤，如果是字符串，就按字符串的方式过滤
 * @param $_string
 * @return array|string
 */
function _html($_string){
    if(is_array($_string)) {
        foreach ($_string as $_key => $_value) {
            $_string[$_key] = htmlspecialchars($_value);
        }
    }else{
            $_string=htmlspecialchars($_string);
        }
    return $_string;
}

function _mysql_string($_string){
//get_magic_quotes_gpc()如果是开启状态，就不需要转义
    if(!GPC){
        if(is_array($_string)) {
            foreach ($_string as $_key => $_value) {
                $_string[$_key] = _mysql_string($_value);
            }
        }else{
            $_string=@mysql_escape_string($_string);
        }
    }
    return $_string;
}

/**
 * @param $_sql
 * @param $_size
 */
function _page($_sql,$_size){
    //将里面的所有变量取出来，外部可以访问
    global $_page,$_pagesize,$_page_num,$_pageabsolute,$_num;
    if(isset($_GET['page'])){
        $_page=$_GET['page'];
        if(empty($_page)||$_page<0||!is_numeric($_page)){
            $_page=1;
        }else{
            $_page=intval($_page);
        }
    }else{
        $_page=1;
    }
    $_pagesize=$_size;
    $_num= _num_rows(_query($_sql));
    if($_num==0){
        $_pageabsolute=1;
    }else{
        $_pageabsolute=ceil($_num/$_pagesize);
    }
    if($_page>$_pageabsolute){
        $_page=$_pageabsolute;
    }
    $_page_num=($_page-1)*$_pagesize;
}

/**
 * _paging分页函数
 * @param $_type
 * 返回分页
 */
function _paging($_type){
    global $_page,$_pageabsolute,$_num;
    if($_type==1){
        echo '<div id="page_num">';
            echo '<ul>';
                 for($i=0;$i<$_pageabsolute;$i++) {
                    if($_page==($i+1)){
                        echo '<li><a href="'.SCRIPT.'.php?page='.($i+1).'" class="selected">'.($i+1).'</a></li>';
                    }else{
                        echo '<li><a href="'.SCRIPT.'.php?page='.($i+1).'">'.($i+1).'</a></li>';
                    }
                 }
            echo '</ul>';
        echo '</div>';
    }elseif($_type==2){
        echo '<div id="page_text">';
            echo '<ul>';
                echo '<li>'.$_page.'/'.$_pageabsolute.'页|</li>';
                echo '<li>共有<strong>'.$_num.'</strong>个会员|</li>';
                if($_page==1){
                    echo '<li>首页|</li>';
                    echo '<li>上一页|</li>';
                }else{
                    echo '<li><a href="'.SCRIPT.'.php">首页|</a></li>';
                    echo '<li><a href="'.SCRIPT.'.php?page='.($_page-1).'">上一页|</a></li>';
                }

                if($_page==$_pageabsolute){
                    echo '<li>下一页|</li>';
                    echo '<li>尾页|</li>';
                }else{
                    echo '<li><a href="'.SCRIPT.'.php?page='.($_page+1).'">下一页</a>|</li>';
                    echo '<li><a href="'.SCRIPT.'.php?page='.$_pageabsolute.'">尾页</a>|</li>';
                }
            echo '</ul>';
        echo '</div>';
    }
}

function _session_destroy(){
    session_destroy();
}

function _unsetcookies(){
    setcookie('username','',time()-1);
    setcookie('uniqid','',time()-1);
    _session_destroy();
    _location(null,'index.php');
}

function _sha1_uniqid(){
    return _mysql_string(sha1(uniqid(rand(), true)));
}

function _check_code($_first_code,$_end_code){
    if($_first_code!=$_end_code){
        _alert_back('验证码不正确！');
    }
}

/**
 * @param int $_width 表示验证码的长度
 * @param int $_height 表示验证码的高度
 * @param int $_rnd_code 表示验证码的位数
 * @param bool|false $_flag 表示验证码是否需要边框
 * _code()验证码函数
 * @access public
 * @return void
 */
function _code($_width=75,$_height=25,$_rnd_code=4,$_flag=false){

//创建随机码
    $_nmsg = '';
    for($i=0;$i<$_rnd_code;$i++){
        $_nmsg .=dechex(mt_rand(0,15));
    }

//保存在session里
    $_SESSION['code']=$_nmsg;

//创建一张图像
    $_img=imagecreatetruecolor($_width,$_height);
//白色背景
    $_white=imagecolorallocate($_img,255,255,255);
//填充
    imagefill($_img,0,0,$_white);

    $_black=imagecolorallocate($_img,0,0,0);
    if($_flag){
        //黑色边框
        imagerectangle($_img,0,0,$_width-1,$_height-1,$_black);
    }

//随机画出6个线条
    for($i=0;$i<6;$i++){
        $_rnd_color=imagecolorallocate($_img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,255));
        imageline($_img,mt_rand(0,$_width),mt_rand(0,$_height),mt_rand(0,$_width),mt_rand(0,$_height),$_rnd_color);
    }

//随机画出雪花
    for($i=0;$i<100;$i++){
        $_rnd_color=imagecolorallocate($_img,mt_rand(200,255),mt_rand(200,255),mt_rand(200,255));
        imagestring($_img,1,mt_rand(1,$_width),mt_rand(1,$_height),'*',$_rnd_color);
    }

//输出验证码
    for($i=0;$i<strlen($_SESSION['code']);$i++){
        $_rnd_color=imagecolorallocate($_img,mt_rand(0,100),mt_rand(0,150),mt_rand(0,200));
        imagestring($_img,5,$i*$_width/$_rnd_code+mt_rand(1,10),mt_rand(1,$_height/2),$_SESSION['code'][$i],$_rnd_color);
    }

//输出图像
header('Content-Type:image/png');
    imagepng($_img);

//销毁
    imagedestroy($_img);
}
?>
