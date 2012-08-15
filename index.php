<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			//载入时显示内容
			$.post("handle_insert_load.php",
					{name:$("#name").val(),
					url:$("#url").val()},
					function(data){
						$("#table_insert_show_in").html(data);
					});
			
			//数据库插入演示
			$("#btn_insert").click(function(){	
				$.post("handle_insert.php",
						{name:$("#name").val(),
						url:$("#url").val()},
						function(data){
							$("#table_insert_show_in").html(data);
						});
			});

			//数据库删除演示 <---这个删除按钮的ajax提交不了，很奇怪！！！
			//解决方案：动态生成的内容要用live绑定事件
			$(".btn_delete").live('click',function(){	
				$.post("handle_delete.php",
						{id:$(this).attr("field_id")},
						function(data){
							$("#table_insert_show_in").html(data);
						});
			});

			//单条数据查看
			$(".btn_lookup").live('click',function(){	
				$.post("handle_lookup.php",
						{id:$(this).attr("field_id")},
						function(data_lookup){
							$("#one_record").html(data_lookup);
						});
			});

			//提交修改请求进入修改页面
			$(".btn_modify").live('click',function(){ 	
					location.href="page_modify.php?id="+$(this).attr("field_id");
			});
			
			////////////////////////////////////////////////////////
			//--------------数据查找演示
			////////////////////////////////////////////////////////
			//--全选
			$("#btn_select_all").click(function(){
				$("input[name='fields[]']").each(function() {
			         $(this).attr("checked", true);
			     });
			});
			//--全不选
			$("#btn_select_none").click(function(){
				$("input[name='fields[]']").each(function() {
			         $(this).attr("checked", false);
			     });
			});
			//--反选
			$("#btn_select_reverse").click(function(){
				$("input[name='fields[]']").each(function() {
					if($(this).attr("checked")){
			        	$(this).attr("checked", false);
					}
					else{
						$(this).attr("checked", true);
					}
			     });
			});
			//提交查询请求
			$("#btn_select").click(function(){
				var fields=new Array();
				$("input:checked").each(function(){
					fields.push($(this).val());
				});
				//alert(fields);
				$("#items_selected").html("你选择显示表的如下字段："+fields);
				
				$.post("handle_select.php",
						{fields:fields},
						function(data){
							$("#table_select_show_in").html(data);
						});
			});
		});
	</script>
	<title>DBMS DEMO</title>
</head>
<body>
<div id="container">
	<div>
		<h4>以下图片地址可以拷贝用来测试</h4>
		http://www.baidu.com/img/baidu_sylogo1.gif<br />
		http://img3.cache.netease.com/www/logo/logo_png.png<br />
		http://mat1.gtimg.com/www/iskin960/qqcomlogo.png<br />
		http://www.manle.com/static/new/images/logo.png<br />
	</div>
	<div id="demo_insert">
		<!-- 数据插入表单 -->
		<h4>数据插入表单</h4>
		<form id="form_insert" action="#">
			<label for="name">用户</label><input type="text" name="name" id="name"/><br />
			<label for="url">地址</label><input type="text" name="url" id="url"/><br />
			<input type="button" id="btn_insert" value="插入" />
		</form>
	</div>
		
	<!-- 数据插入显示表单 -->
	<div id="table_insert_show_in"></div>
	
	<!-- 单条记录查看表单 -->
	<div id="one_record"></div>
		
	<div id="demo_select">
		<!-- 数据查询表单 -->
		<br /><br />
		<h4>数据查询表单</h4>
		<form id="form_select" action="#">
			<!-- 全选  全取消  反选 -->
			<input type="button" id="btn_select_all" value="全选" />
			<input type="button" id="btn_select_none" value="全取消" />
			<input type="button" id="btn_select_reverse" value="反选" />
			
			<!-- 复选框 查询输出的字段名称选择 -->
			<br />
			<?php 
			require_once 'common_fns.php';

			//连接数据库
			db_connect();
			
			//数据库查找
			$table_name="demo_dbms";
			
			//获取所有字段名称
			$sql_desc="show columns from ".$table_name;
			$result0=mysql_query($sql_desc);
			
			$fields=array();
			while($row=mysql_fetch_assoc($result0)){
			      $fields[]=$row['Field'];
			}
			
			//遍历每个字段输出
			foreach ($fields as $field){
				echo '<input type="checkbox" name="fields[]" value="'.$field.'" checked="checked" />'.$field;
			}
			?>
			<!--  以下改为采用php查询数据表动态获取
			<input type="checkbox" name="fields[]" value="id" checked="checked" />ID
			<input type="checkbox" name="fields[]" value="name" checked="checked" />NAME
			<input type="checkbox" name="fields[]" value="url" checked="checked" />URL
			<input type="checkbox" name="fields[]" value="insert_time" checked="checked" />INSERT_TIME
			-->
			
			<!-- 提交查询按钮 -->
			<br />
			<input type="button" id="btn_select" value="查询" />
		</form>
	</div>
	
	<!-- 数据查询显示表单 -->
	<div id="items_selected"></div>
	<br />
	<div id="table_select_show_in"></div>
</div>
</body>
</html>