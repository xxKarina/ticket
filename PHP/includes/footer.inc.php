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
_close();
?>
<div id="footer">
    <p>本程序执行耗时为：<?php echo round((_runtime()-STRAT_TIME),4); ?></p>
    <p>版权所有 翻版必究</p>
    <p>本程序由<span>广东海洋大学</span>提供3473262769@qq.com</p>
</div>
