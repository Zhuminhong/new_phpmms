<?php
/**
*作者：ZMH 
*
*/
error_reporting(E_ALL^E_NOTICE);
//把common.php文件包含进来
include 'common.php';
//验证管理员是否登录
include 'checkLogin.php';

//var_dump($_POST);
//判断是否点击了提交按钮
if($_POST["send"]){
	$searchSql="select * 
				from   member 
   				where  userName='".$_POST['userName']."'";
	$searchResult=$pdo->query($searchSql);
	$oneUser=$searchResult->fetchAll(PDO::FETCH_OBJ);
	/* echo "<pre>";
	var_dump($oneUser[0]);
	echo "</pre>"; */
	//如果用户名已存在
	if($oneUser[0]){
		echo '<script>
				alert("用户名已存在");
				history.go(-1);
			</script>';
		return false;
	}
	
	//终止代码执行
	//exit();
	//添加数据
	$sql="insert into member(
		userName,
		pwd,
		email,
		regTime
	)values(
		'". $_POST['userName'] ."',
		'". md5($_POST['pwd']) ."',
		'". $_POST['email'] ."',
		'".date('Y-m-d H:i:s')."'
	)";
	//echo $sql;
	//执行insert语句
	$result=$pdo->exec($sql);
	if($result){
		//echo "ok";
		echo '<script>
			$("#addSuccess").modal("show");
			</script>';
	}else{
		echo "failed";
	}
}

?>

<style>
    body{background: #193d5d; color:white}
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
	a{color:white};
	a:hover{color:white};

</style>
<h3 class='text-center'>USER ADMINISTRATION</h3>
<div class="container">
	<div class="row">
		<div class="col-lg-3 col-md-3 col-sm-1 hidden-xs"></div>
		<div class="col-lg-6 col-md-6 col-sm-10 col-xs-12">
			<form action="" method="post" id="addUser">
				<div class='form-group'>
					<label for=''>姓名  NAME</label><br>
					<input name="userName" type="text" class="form-control" placeholder="请输入姓名" id="input0">
					<div id="info0">用户名必须是。。。</div>
				</div>
				<div class='form-group'>
					<label for=''>密码  PASSWORD</label><br>
					<input name="pwd" type="password" class="form-control" placeholder="请输入密码" id="input1">
					<div id="info1">密码必须是。。。</div>
				</div>
				<div class='form-group'>
					<label for=''>邮箱  EMAIL</label><br>
					<input name="email" type="email" class="form-control" placeholder="请输入邮箱" id="input2">
					<div id="info2">邮箱只支持。。。。</div>
				</div>
				<input name="send" type="submit" value="SUBMIT" class="btn btn-primary form-control addBtn">
			</form>	
		</div>
		<div class="col-lg-3 col-md-3 col-sm-1 hidden-xs"></div>
	</div>
</div>
<!--数据添加成功提示-->
<div class="modal fade" id="addSuccess" data-backdrop="true" data-keyboard="true" tabindex="1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-body" style="color:#717171;">用户添加成功！</div>
            <div class="modal-footer">
                <button class="btn btn-primary" data-dismiss="modal">确认</button>
            </div>
        </div>
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
			//$("#addSuccess").modal({show:true});
		}else{
			return false
		}
	})
	//点击确认，跳转页面
	$("#addSuccess button").click(function(){
		location.href='getAll.php';
	})
	//根据类选择器选择元素——kong
/* 	var addBtn = document.querySelector(".addBtn");
	var email = document.querySelector("#input2");
	console.log(addBtn);
	addBtn.addEventListener("click",function(evt){
		//阻止默认动作
		evt.preventDefault();
	}); */
</script>





