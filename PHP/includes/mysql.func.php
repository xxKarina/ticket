<?php
/**
 * Created by PhpStorm.
 * User: yxx
 * Date: 2016/8/6
 * Time: 11:19
 */
//防止恶意调用
if(!defined('IN_TG')){
    exit('Forbidden access');
}

function _connect(){
    //global表示全局变量，意图是使此变量在函数外部也能访问
    global $_conn;
    if (!$_conn=@mysql_connect(DB_HOST,DB_USER,DB_PWD)){
        exit('数据库连接失败');
    }
}
function _select_db(){
    if (!mysql_select_db(DB_NAME)){
        exit('指定的数据库不存在！');
    }
}
function _set_names(){
    if(!mysql_query('SET NAMES UTF8')){
        exit('字符集错误！');
    }
}
function _query($_sql){
    if(!$_result=mysql_query($_sql)){
        exit('SQL执行失败'.mysql_error());
    }
    return $_result;
}

/**
 * _fetch_array只能获取指定数据集的一条数据组
 * @param $_sql
 * @return array
 */
function _fetch_array($_sql){
    return mysql_fetch_array(_query($_sql),MYSQL_ASSOC);
}

/**
 * _fetch_array_list可以返回指定数据集的所有数据
 * @param $_result
 * @return array
 */
function _fetch_array_list($_result){
    return mysql_fetch_array($_result,MYSQL_ASSOC);
}

function _num_rows($_result){
    return mysql_num_rows($_result);
}

/**
 * @return int
 * _affected_rows表示影响到的记录数
 */
function _affected_rows(){
    return mysql_affected_rows();
}

/**
 * _free_result销毁结果集
 * @param $_result
 */
function _free_result($_result){
    mysql_free_result($_result);
}

function _is_repeat($_sql,$_info){
    if(_fetch_array($_sql)){
        _alert_back($_info);
    }
}
function _close(){
    if(!mysql_close()){
        exit('关闭异常');
    }
}
?>