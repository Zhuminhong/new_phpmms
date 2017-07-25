<?php
/**
*作者：ZMH 
*内容：验证是否登录
*时间：20170724
*/
//验证管理员是否登录，未登录，跳转到登陆界面
if(!$_SESSION['admin']){
	header("location:login.php");
}else{
	if(is_string($_SESSION['admin'])){
		echo $_SESSION['admin']."登录&ensp;";
	}else if(is_object($_SESSION['admin'])){
		echo $_SESSION['admin']->userName."登录&ensp;";
	}
	echo "<a href='getAll.php?action=logout' class='logout'>注销</a>";
}
if($_GET['action']=='logout'){
	//销毁session值
	unset($_SESSION['admin']);
	//销毁cookie值
	setcookie("userName","");
	header("location:login.php?action=logout");
}
?>