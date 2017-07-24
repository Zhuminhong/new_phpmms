<?php
/**
*作者：ZMH 
*内容：验证码文件
*/
session_start();
//创建验证码文件
$image=imagecreatetruecolor(120, 50);
//产生随机背景色
$bgColor = imagecolorallocate($image, rand(200,255), rand(200,255), rand(200,255));
imagefill($image, 0, 0, $bgColor);

//声明包含所有需要输出字符的字符串
$str="0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
//循环得出所有的字符串
$temp=null;
for($j=0;$j<4;$j++){
	$temp.=$str[rand(0,strlen($str)-1)];
}
//将得出的在字符串存入内存中
$_SESSION["captcha"]=$temp;

for($i=0;$i<4;$i++){
	//设置字体颜色
	$textColor=imagecolorallocate($image, rand(0,150), rand(0,150), rand(0,150));
	$size=rand(10,25);
	$angle=rand(-10,10);
	$x=floor(120/4)*$i+8;
	$y=rand(30,40);
	$fontfile="GEORGIAB.TTF";
	imagettftext($image, $size, $angle, $x, $y, $textColor, $fontfile, $temp[$i]);
}

imagepng($image);
?>
