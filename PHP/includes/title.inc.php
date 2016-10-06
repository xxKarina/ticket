<?php
/**
 * Created by PhpStorm.
 * User: yxx
 * Date: 2016/8/4
 * Time: 10:40
 */
//防止恶意调用
if(!defined('IN_TG')){
    exit('Forbidden access');
}
//防止非HTML页面调用
if(!defined('SCRIPT')){
    exit('Script Error!');
}
?>

<link rel="shortcut icon" href="favicon.ico"/>
<link rel="stylesheet" href="styles/1/basic.css">
<link rel="stylesheet" href="styles/1/<?php echo SCRIPT ?>.css">
