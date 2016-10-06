<?php
/**
 * Created by PhpStorm.
 * User: yxx
 * Date: 2016/8/13
 * Time: 16:03
 */
//定义一个常量，用来授权调用includes里面的文件
define('IN_TG',true);
//定义一个常量，用来指定本页的内容
define('SCRIPT','blog');
//引入公共调用函数(公共文件)
require dirname(__FILE__).'/includes/common.inc.php';
//分页模块
_page("SELECT tg_id FROM tg_user",5);//第一个参数获取总条数，第二个人参数，指定每页多少条
//首先要得到所有的数据总和
//从数据库里提取数据获取结果集
//我们必须是每次重新读取结果集，而不是重新去执行SQL语句
//LIMIT 0,10 表示从0+1条开始，选择十条数据
$_result=_query("SELECT
                        tg_id,
                        tg_username,
                        tg_sex,
                        tg_face
                    FROM
                        tg_user
                ORDER BY
                        tg_reg_time
                    DESC
                    LIMIT
                        $_page_num,
                        $_pagesize
                  ");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>多用户留言系统--博友</title>
    <?PHP
    require ROOT_PATH.'includes/title.inc.php';
    ?>
    <script type="text/javascript" src="js/blog.js"></script>
</head>
<body>
<?php
require ROOT_PATH.'includes/header.inc.php';
?>
    <div id="blog">
        <h2>博友列表</h2>
        <?php
            while(!!$_rows=_fetch_array_list($_result)){
                $_html=array();
                $_html['id']=$_rows['tg_id'];
                $_html['username']=$_rows['tg_username'];
                $_html['face']=$_rows['tg_face'];
                $_html['sex']=$_rows['tg_sex'];
                $_html=_html($_html);
        ?>
        <dl>
            <dd class="user"><?php echo $_html['username']?>(<?php echo $_html['sex']?>)</dd>
            <dt><img src="<?php echo $_html['face']?>" alt="sbh"></dt>
            <dd class="message"><a href="###" name="message" title="<?php echo $_html['id']?>">发消息</a></dd>
            <dd class="friend">加为好友</dd>
            <dd class="guest">写留言</dd>
            <dd class="flower">给他送花</dd>
        </dl>
        <?php }
        _free_result($_result);
        //_paging函数调用分页，1|2,1表示数字分页，2表示文本分页
            _paging(1);
        ?>
    </div>
<?php
require ROOT_PATH.'includes/footer.inc.php';

?>
</body>
</html>
