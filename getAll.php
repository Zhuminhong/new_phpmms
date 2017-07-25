<?php
/**
 *作者：ZMH
 *内容：PDO php操作MySQL数据库
 *时间：20170724
 */

//把common.php文件包含进来
include 'common.php';
//验证管理员是否登录
include 'checkLogin.php';
echo "<pre>";
//var_dump($_POST);
//var_dump($_COOKIE);
echo "</pre>";

//总记录数
$total=$pdo->query("select * from member")->rowCount();
//echo $total;
//每页显示数据的条数
$pageSize=3;
$pageTotal=ceil($total/$pageSize);
//判断page是否有值
if($_GET['page']){
	$page=$_GET['page'];
	//当当前页大于总页数的时候，就让当前页书一直等于总页数
	if($page>=$pageTotal){
		$page=$pageTotal;
	}
}else{
	$page=1;
}

//查询的sql语句
$sql = "select * from member order by id desc limit ".($page-1)*$pageSize.",".$pageSize;
$result = $pdo->query($sql);
$data=$result->fetchAll(PDO::FETCH_OBJ);
echo "<h3 class='text-center'>USER ADMINISTRATION</h3>";
echo "<table class='table table-striped table-hover table-bordered'";
echo "<tr><th>用户名</th><th>邮箱</th><th>注册时间</th><th>操作</th></tr>";
//通过循环 遍历出数组中所有对象的属性
foreach($data as $key=>$value){
	//var_dump($value->userName);
	echo "<tr>";
	echo "<td>".$value->userName."</td>";
	echo "<td>".$value->email."</td>";
	echo "<td>".$value->regTime."</td>";
	echo "<td>";
	echo "<a href='update.php?id=".$value->id."'>修改</a>&ensp;&ensp;&ensp;";
	echo "<a href='delete.php?id=".$value->id."'>删除</a></td>";
	echo "</td>";
	echo "</tr>";
}
echo "<tr><td colspan=4><a href='add.php'>添加数据</a></td></tr>";
echo "</table>";
echo "<div class='page'>";
echo "<ul>";
echo "<li><a href='?page=".($page-1)."'>上一页</a></li>";
echo "<li><a href='?page=".($page+1)."'>下一页</a></li>";
echo "<li><input type='text' value='".$page."' class='changePage'></li>";
echo "<li><span class='present'>".$page."&ensp;</span>/&ensp;".$pageTotal."</li>";
echo "</ul>";
echo "</div>";

/* echo "<pre>";
var_dump($result->fetchAll(PDO::FETCH_OBJ));
echo "</pre>"; */

?>
<style>
	*{margin:0;padding:0}
	body{background: #193d5d;color:white}
	table{background:white;margin-top:20px;color:black;}
	li a,a.logout{color:white}
	li a:hover,a.logout:hover{color:white}
	h3{color:white;padding-bottom:10px;border-bottom:1px solid white;}
	.page{border-top:1px solid white;border-bottom:1px solid white;}
	.page ul{text-align:center;}
	.page li{display:inline-block;margin:8px 0 -1px 5px;}
	.page .present{font-weight:bold}
	.page .changePage{width:30px;text-align:center;color:black}
</style>
<script>
	var changePage = document.querySelector(".changePage");
	//松开键盘按键，页面就跳到值所对应的页面
	changePage.addEventListener("keyup",function(){
		location.href="getAll.php?page="+this.value;
		console.log(location.href);
	})
</script>




