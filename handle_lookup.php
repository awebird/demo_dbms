<?php
require_once 'common_fns.php';

//获取前端提交数据:要删除记录的id
$id=$_POST['id'];

//连接数据库
db_connect();

//查找单条数据
$sql_lookup="select * from demo_dbms where id=".$id;

//数据库查找
$result=mysql_query($sql_lookup);

while($row=mysql_fetch_array($result)){
	//<img src="/i/eg_tulip.jpg"  alt="上海鲜花港 - 郁金香" />
	//echo $row['url'];
	//$pic_url="http://www.baidu.com/img/baidu_sylogo1.gif";
	$pic_url=$row['url'];
	echo '<br />';
	echo '<div>您所选择的这条记录的url所指向的图片显示如下</div>';
	echo '<img src="'.$pic_url.'"  alt="'.$pic_url.'" />';
}
?>