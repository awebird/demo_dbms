<?php
//连接数据库
	$con = mysql_connect('localhost', 'root', 'root');
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("bbdtek", $con);
	
//数据库查找
	$table_name="demo_dbms";
	
	//获取所有字段名称
	$sql_desc="show columns from ".$table_name;
	$result0=mysql_query($sql_desc);
	
	$fields=array();
	while($row=mysql_fetch_assoc($result0)){
	      $fields[]=$row['Field'];
	}
	
	foreach ($fields as $field){
		echo "$field|";
	}
	//test github
?>