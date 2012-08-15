<?php

//获取前端提交数据
$fields=$_POST['fields'];
$fields_length=count($_POST['fields']);

$sql_fields="";

for($i=0;$i<$fields_length;$i++){
	$sql_fields.=$fields[$i];
	if($i != $fields_length-1){
		$sql_fields=$sql_fields.",";
	}
}

//连接数据库
$con = mysql_connect('localhost', 'root', 'root');
if (!$con){
	die('Could not connect: ' . mysql_error());
}
mysql_select_db("bbdtek", $con);

//查找数据
//$sql_insert="insert into demo_dbms (name,url,insert_time) values ('".$name."','".$url.",now()')";
$sql_select="select ".$sql_fields." from demo_dbms";
mysql_query($sql_select);
$result = mysql_query($sql_select);
	
echo "<table border='1'>
<tr>";
for($i=0;$i<$fields_length;$i++)
{
	echo "<th>".$fields[$i]."</th>";
}
echo "</tr>";
	
while($row = mysql_fetch_array($result)){
	echo "<tr>";
	for($i=0;$i<$fields_length;$i++)
	{
		echo "<td>".$row["$fields[$i]"]."</td>";
	}
	echo "</tr>";
}
echo "</table>";

mysql_close($con);
?>