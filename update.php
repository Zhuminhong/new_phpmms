<?php
/**
*作者：ZMH 
*内容：用过PDO修改mysql数据
*/
error_reporting(E_ALL^E_NOTICE);
//把common.php文件包含进来
include 'common.php';

//如果没有id，就跳转回首页
if($_GET["id"]){
	$sql="select * from member where id=".$_GET["id"];
	//echo $sql;
	$result=$pdo->query($sql);
	//从结果集中获取所有的数据
	$data = $result->fetchAll(PDO::FETCH_OBJ);
    //var_dump($data[0]);
	//判断数据是否存在
	if($data[0]==null){
		echo "数据不存在";
	}
	//如果点击了提交按钮
	if($_POST["send"]){
		/* 如果没有修改密码，$pwd的值就是原来的密码
		 * 如果修改了，$pwd的值就是加密后的值
		 *   */
		if($_POST['pwd2']==$_POST['pwd']){
			$pwd=$_POST['pwd'];
		}else{
			$pwd=md5($_POST['pwd']);
		}
		//var_dump($_POST);
		//创建修改的sql语句
		$sql="update member 
				 set userName='".$_POST['userName']."',
					 pwd='".$pwd."',
					 email='".$_POST['email']."'
			  where  id=".$_GET['id'];
		//echo $sql;
		$result=$pdo->exec($sql);
		/* header("location:update.php?id=".$_GET["id"]); */
		if($result){
			header("location:getAll.php");
		}else if($result==0){
			echo "<script>alert('没有修改')</script>";
		}else{
			echo "<script>alert('修改失败')</script>";
		}
	
	}
}else{
	header("location:getAll.php");
}

?>

<style>
    body{background: #193d5d;}
    h3{color:white;padding-bottom:10px;border-bottom:1px solid white;}
	form{
		margin-top:100px;
		border:none;
		padding:20px;
 		color:white;
 		background:#213243;
 		font-size:15px;
	}
	input[name="send"]{
		margin-top:15px;
		height:40px;
		font-size:15px;
	}
	#info0,#info1,#info2{
        color:#FFE053;
		padding-top:5px;
		margin-top:5px;
		font-weight:bold;
		display:none;
	}

</style>
<h3 class='text-center'>USER ADMINISTRATION</h3>
<div class="container">
	<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-1 hidden-xs"></div>
		<div class="col-lg-6 col-md-6 col-sm-10 col-xs-12">
			<form action="" method="post" id="addUser">
				<!--保存原来的密码 -->
				<input name="pwd2" type="hidden" value=<?php echo $data[0]->pwd ?>>
				<div class='form-group'>
					<label for=''>姓名  NAME</label><br>
					<input name="userName" type="text" class="form-control" placeholder="请输入姓名" id="input0" value=<?php echo $data[0]->userName;?>>
					<div id="info0">用户名必须是。。。</div>
				</div>
				<div class='form-group'>
					<label for=''>密码  PASSWORD</label><br>
					<input name="pwd" type="password" class="form-control" placeholder="请输入密码" id="input1" value=<?php echo $data[0]->pwd;?>>
					<div id="info1">密码必须是。。。</div>
				</div>
				<div class='form-group'>
					<label for=''>邮箱  EMAIL</label><br>
					<input name="email" type="email" class="form-control" placeholder="请输入邮箱" id="input2" value=<?php echo $data[0]->email;?>>
					<div id="info2">邮箱只支持。。。。</div>
				</div>
				<input name="send" type="submit" value="CHANGE" class="btn btn-primary form-control">
			</form>	
		</div>
		<div class="col-lg-3 col-md-3 col-sm-1 hidden-xs"></div>
	</div>
</div>
<script>
	//给各个输入框绑定事件
	$("input[placeholder]").each(function(index){
		$(this).blur(function(){
			blurConf(index);
		})
		$(this).focus(function(){
			clickTips(index);
		})
	})
	//点击提交，触发所有验证
	$("input[name='send']").click(function(){
		for(var i=0;i<3;i++){
			blurConf(i);
		}
		if( flagArr[0]==true &&  flagArr[1]==true &&  flagArr[2]==true){
			
		}else{
			return false
		}
	})
	
</script>



