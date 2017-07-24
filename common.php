<?php
/**
*作者：ZMH 
*内容：
*/
//错误处理
error_reporting(E_ALL^E_NOTICE^E_STRICT);
//通过注释代替更新的内容
//设置默认时区
date_default_timezone_set("PRC");
//开启session
session_start();
//执行制定的代码，如果出错，就是catch中抛出错误；
try{
	$pdo = new PDO("mysql:host=localhost;dbname=web13","root","");
}catch(PDOException $e){
	echo $e->getMessage();
}
//设置操作数据库的字符集
$pdo->query("set names utf8");

//引入bootstrap样式
echo "<link href='bootstrap-3.3.7-dist/css/bootstrap.min.css' rel='stylesheet'>";
echo "<script src='jquery-3.2.1.min.js'></script>";
echo "<script src='bootstrap-3.3.7-dist/js/bootstrap.min.js'></script>";
echo "<script src='formValidate.js'></script>";
?>
<meta charset="utf-8">