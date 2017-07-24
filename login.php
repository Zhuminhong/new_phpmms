<?php
/**
*作者：ZMH 
*内容：管理员登录界面
*时间：20170724
*/
include "common.php";
/**
 * @todo ： 一周内不用登录
 *   */
//如果cookie存在的话，免登录
/* if($_COOKIE['userName']){
	$_SESSION['admin']=$_COOKIE["userName"];
	header("location:getAll.php");
} */
//点击登录
if($_POST["send"]){	
	/* echo "<pre>";
	var_dump($_POST);
	echo "</pre>"; */

	//判断验证码
	if(strtolower($_POST['code'])!=strtolower($_SESSION['captcha'])){
		echo "<script>alert('验证码错误！');location.href='login.php';</script>";
		return false;
	}else{
		//把用户名和密吗在数据库中查询
		$sql="select *
		  from  admin
  		  where userName='".$_POST['userName']."'
		  and   pwd='".md5($_POST['pwd'])."'";
		$result=$pdo->query($sql);
		$oneUser= $result->fetchAll(PDO::FETCH_OBJ);
		
		if($oneUser[0]){
			//判断是否选择了一周内不用登录
			if($_POST['oneWeek']=="1"){
				setcookie("userName",$_POST['userName'],time()+3600*24*7);
				header("location:getAll.php?oneWeek=1");
			}else{
				setcookie("userName",$_POST['userName']);
				header("location:getAll.php?oneWeek=0");
			}
			//把用户对象保存到$_SESSION中,才能成功跳转到首页
			$_SESSION['admin']=$oneUser[0];
		}else{
			//如果错误，就弹出信息，并刷新页面
			echo "<script>alert('用户名或密吗错误');location.href='login.php';</script>";
		}
	}			
}
?>

<dl class="login">
	<form action="" method="post">
		<dt>欢迎登录</dt>
		<dd><input type="text" name="userName" placeholder="用户名"></dd>
		<dd><input type="text" name="pwd" placeholder="密码"></dd>
		<dd>
			<input type="text" name="code" class="code"  placeholder="验证码">
			<img src='captcha.php' id="captcha">
		</dd>
		<dd><input type="checkbox" name="oneWeek" class="oneWeek" value="1">一周内不用登录</dd>
		<dd><input type="submit" name="send" value="登录" class="loginBtn"></dd>
	</form>
</dl>

<style type="text/css">
	*{margin:0;padding:0}
	.login{border:1px solid #ddd;height:220px;width:220px;padding:5px;position:absolute}
	.login dt{text-align:center}
	.login dd input{width:100%;margin:5px auto}
	.login dd input.code{width:50px;}
	.login dd input.oneWeek{width:50px;}
</style>

<script src="tools.js"></script>
<script type="text/javascript">
	center(document.querySelector(".login"));

	//根据选择器选择元素
	var captcha=document.querySelector("#captcha");
	captcha.addEventListener("click",function(){
		//每次点击图片时，在路径上添加查询字符串
		this.src="captcha.php?action="+Math.random();
	})
	//点击刷新，同样切换验证码
	document.querySelector("#captcha2").onclick=function(){
		captcha.src="captcha.php?action="+Math.random();
	}
</script>