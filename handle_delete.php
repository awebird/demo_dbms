<?php
require_once 'common_fns.php';

//获取前端提交数据:要删除记录的id
$id=$_POST['id'];

//连接数据库
db_connect();

//删除数据
$sql_delete="delete from demo_dbms where id=".$id;

mysql_query($sql_delete);

//数据库查找
show_insert_result();
?>