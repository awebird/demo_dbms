<?php
require_once 'common_fns.php';

//获取前端提交数据:要删除记录的id
//$id=$_POST['id'];
//$name=$_POST['name'];
//$url=$_POST['url'];

//连接数据库
db_connect();

//删除数据
// update demo_dbms set name='lidapeng',url='www.haha.com' where id=47
$sql_update='update demo_dbms set name=\''.$name.'\',url=\''.$url.'\' where id='.$id;
echo "$sql_update";

mysql_query($sql_update);
?>