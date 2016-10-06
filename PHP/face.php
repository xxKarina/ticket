<?php
/**
 * Created by PhpStorm.
 * User: yxx
 * Date: 2016/8/4
 * Time: 10:53
 */
//定义一个常量，用来授权调用includes里面的文件
define('IN_TG',true);
//定义一个常量，用来指定本页的内容
define('SCRIPT','face');
//引入公共调用函数(公共文件)
    require dirname(__FILE__).'/includes/common.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>多用户留言系统--头像选择</title>
    <?php
    require ROOT_PATH.'includes/title.inc.php';
    ?>
    <script type="text/javascript" src="js/opener.js"></script>
</head>
<body>
 <div id="face">
     <h3>选择图像</h3>
     <dl>
         <?php foreach(range(1,9)as $num){?>
             <dd><img src="face/0<?php echo $num?>.png" alt="face/0<?php echo $num?>.png" title="头像<?php echo $num?>" /></dd>
         <?php }?>
     </dl>
     <dl>
         <?php foreach(range(10,21)as $num){?>
             <dd><img src="face/<?php echo $num?>.png" alt="face/<?php echo $num?>.png" title="头像<?php echo $num?>" /></dd>
         <?php }?>
     </dl>
 </div>
</body>
</html>
