<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<script type="text/javascript" src="jquery.js"></script>
	<title>MODIFY NAME & URL</title>
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#btn_modify").live('click',function(){	
				$.post("handle_modify.php",
						{name:$("#name").val(),
						url:$("#url").val(),
						id:$("#hidden_id").attr("id2post")},
						function(data){
							location.href="index.php";
						});
			});
		});
	</script>
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
	
	<?php
	require_once 'common_fns.php';
	
	//获取前端提交数据:要修改记录的id
	$id=$_GET['id'];
	//隐藏参数，用index.php提交的id动态生成隐藏输入，在ajax传递给hand_modify.php
	echo '<input type="hidden" id="hidden_id" id2post='.$id.' />';
	//echo "id=".$id;
	
	//////////////////////////////////////
	//////////////////////////////////////
	//连接数据库
		db_connect();
		
		//查找单条数据
		$sql_lookup="select name,url from demo_dbms where id=".$id;
		
		//数据库查找
		$result=mysql_query($sql_lookup);
		
		while($row=mysql_fetch_array($result)){
			//<img src="/i/eg_tulip.jpg"  alt="上海鲜花港 - 郁金香" />
			//echo $row['url'];
			//$pic_url="http://www.baidu.com/img/baidu_sylogo1.gif";
			$show_name=$row['name'];
			$show_url=$row['url'];
		}
	///////////////////////////////////////
	///////////////////////////////////////
	
	
	echo '<br />'.'<br />'."本页用来修改<br />id： ".$id.'的<br />name： '.$show_name.'<br />url： '.$show_url.'<br />的信息'.'<br />';
	?>
	<h4>填入要修改的新数据</h4>
	<form id="form_modify" action="#">
		<label for="name">修改用户名为： </label><input type="text" name="name" id="name"/><br />
		<label for="url">修改新地址为： </label><input type="text" name="url" id="url"/><br />
		<input type="button" id="btn_modify" value="修改" />
	</form>
</div>
</body>
</html>