<?php

function db_connect(){
	//连接数据库
	$con = mysql_connect('localhost', 'root', 'root');
	if (!$con){
		die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("bbdtek", $con);
}

function show_insert_result(){
	//数据库查找
	$table_name="demo_dbms";
	
	//获取所有字段名称
	$sql_desc="show columns from ".$table_name;
	$result0=mysql_query($sql_desc);
	
	$fields=array();
	while($row=mysql_fetch_assoc($result0)){
	      $fields[]=$row['Field'];
	}
	
	//查询所有
	$sql_select="select * from ".$table_name;
	$result=mysql_query($sql_select);
		
	echo "<table border='1'>";
	echo "<tr>";
	//遍历每个字段输出
	foreach ($fields as $field){
		echo "	<th>$field</th>";
	}
	echo "	<th>查看</th>";
	echo "	<th>修改</th>";
	echo "	<th>删除</th>";
	echo "</tr>";
		
	while($row = mysql_fetch_array($result)){
		echo "<tr>";
		//遍历每个字段输出
		foreach ($fields as $field){
			echo "<td>".$row[$field]."</td>";
		}
		 /*
		 echo "<td>".$row['id']."</td>";
		 echo "<td>".$row['name']."</td>";
		 echo "<td>".$row['url']."</td>";
		 echo "<td>".$row['insert_time']."</td>";
		 */
		//注意下面三个按钮的field_id属性的值为对应行的主键id，可以用来对数据表进行增删查找操作
		 echo '<td><input type="button" value="查看" class="btn_lookup" field_id="'.$row['id'].'"/></td>';
		 echo '<td><input type="button" value="修改" class="btn_modify"  field_id="'.$row['id'].'"/></td>';
		 echo '<td><input type="button" value="删除" class="btn_delete" field_id="'.$row['id'].'"/></td>';
		 echo "</tr>";
	}
	echo "</table>";
	
	//下面一行如果加上会出现warning报错
	//mysql_close($con);
}
?>