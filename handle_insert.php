<?php
require_once 'common_fns.php';

//获取系统时间
date_default_timezone_set('Asia/Shanghai');
$insert_time = date('Y-m-d H:i:s');

//获取前端提交数据
$name=$_POST['name'];
$url=$_POST['url'];

//连接数据库
db_connect();

//插入数据
//$sql_insert="insert into demo_dbms (name,url,insert_time) values ('".$name."','".$url.",now()')";
$sql_insert="insert into demo_dbms (name,url,insert_time) values ('".$name."','".$url."','".$insert_time."')";
mysql_query($sql_insert);

//显示页面载入和插入数据的输出
show_insert_result();
?>