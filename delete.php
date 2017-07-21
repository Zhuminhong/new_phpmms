<?php
/**
*作者：ZMH 
*内容：删除数据
*/
error_reporting(E_ALL^E_NOTICE);
//把common.php文件包含进来
include 'common.php';

//如果id不为真，就跳转
if($_GET["id"]){
	$sql="delete from member where id=".$_GET["id"];
	//echo $sql;
	$result=$pdo->exec($sql);
	//删除成功直接跳转到首页
	if($result){
		header("location:getAll.php");
	}else{
		echo "<script>alert('删除失败');location.href='getAll.php'</script>";
	}
}else{
	//防止用户直接访问delete.php
	header("location:getAll.php");
}
?>