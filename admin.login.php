<?php	
	// include "header.php";	
	include "paras.php";
	
	$currenturl = $_SERVER['PHP_SELF'];
	$isloginpage =count( explode('login',$currenturl));

	if($isloginpage<=1 && CheckRights3() < 0)
		Page("admin.login.php");
		
	if ($isloginpage>1){//重新登录，初始化
		$_SESSION["uname"]="";
	}
	$mode = Get("mode");
	switch($mode){
		case "ChangePassword":
			$oldPassword = Get("oldPassword");
			$newPassword = Get("newPassword");
			$loginName = $_SESSION["uname"];
			
			$userInfo = DBGetDataRowByField("bgmanager","loginname",$loginName);
			if($userInfo == null)
				die("-8");
			if($userInfo["password"] != $oldPassword)
				die("-9");
			
			if(DBUpdateField("bgmanager" , $userInfo["id"] , "password" , $newPassword))
				die("1");
			else
				die("-1");
			break;
	}
	
	$strSql = "select * FROM `footerfixed` order by createtime desc ";//页脚固定显示
	$footerfixed = DBGetDataRow($strSql);
	$telephone=$footerfixed["telephone"];
	$copyright=$footerfixed["copyright"];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<title>在线贷款站方后台</title>
		<link href="style/bootstrap.css" rel="stylesheet"/>
		<link href="js/craftpip/css/jquery-confirm.css" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="js/kkpager-master/src/kkpager_blue.css" />
		<link rel="stylesheet" type="text/css" href="style/bootstrap-select.css" />
		<link rel="stylesheet" type="text/css" href="style/bootstrap-fileinput.css">
		<link rel="stylesheet" href="js/DataTables-1.10.11/media/css/jquery.dataTables.min.css" type="text/css">
		<link rel="stylesheet" type="text/css" href="style/kkpager-style.css" />
		<link rel="stylesheet" type="text/css" href="style/header-col.css"/>
		<link rel="stylesheet" type="text/css" href="style/footer-col.css"/>
		<style>
			#Maincontainer #RegisterForm,#CooperationInfo,#SlidesInfo,#BannerInfo,#FooterSetInfo .col-sm-9>*,
			#Maincontainer #RegisterForm,#CooperationInfo,#SlidesInfo,#BannerInfo,#FooterSetInfo .col-sm-10>*,
			#Maincontainer #RegisterForm,#CooperationInfo,#SlidesInfo,#BannerInfo,#FooterSetInfo .col-sm-4>*{
				width: 90% !important;
				display: inline;
			}
			#Maincontainer #RegisterForm,#CooperationInfo,#SlidesInfo,#BannerInfo,#FooterSetInfo .file-preview,
			#Maincontainer #RegisterForm,#CooperationInfo,#SlidesInfo,#BannerInfo,#FooterSetInfo .file-caption-main,
			#Maincontainer #RegisterForm,#CooperationInfo,#SlidesInfo,#BannerInfo,#FooterSetInfo .dropdown-toggle,
			#Maincontainer #RegisterForm,#CooperationInfo,#SlidesInfo,#BannerInfo,#FooterSetInfo #edui1{
				width: 90% !important;
			}
			#Maincontainer #RegisterForm .bootstrap-select>.dropdown-menu,
			#Maincontainer #CooperationInfo .bootstrap-select>.dropdown-menu,
			#Maincontainer #SlidesInfo .bootstrap-select>.dropdown-menu,
			#Maincontainer #BannerInfo .bootstrap-select>.dropdown-menu,
			#Maincontainer #FooterSetInfo .bootstrap-select>.dropdown-menu{
				position: inherit;
				min-width: 90% !important;
				width: 90% !important;
				/*position: absolute;
				left: initial !important;
				top: initial !important;*/
			}
			#kvFileinputModal,#RegisterForm,#CooperationInfo,#SlidesInfo,#BannerInfo,#FooterSetInfo{
				display: none !important;
			}
			#Maincontainer .submitprompt{
				color:#ff2e31;
				line-height: 34px;
			}
		</style>
	</head>
	<body>	
		<div class="header">
			<div class="header-top">
				<div class='header-top-left'>
					<img src="images/01_13.jpg" alt="" onclick="LocationHref('index')" />
					<i class='i1' onclick="LocationHref('index')">
						<img src="images/tel.png" alt="" class='img-1'/>
						&nbsp;<span class='span2-1'><?=$telephone?></span>
					</i>
				</div>
				<div class='header-top-right'>
					<ul class="ul1">
						<li id="admin.login" class="hoverpointer navBtn">重新登陆</li>
						<li id="admin.changepassword" class="hoverpointer navBtn">修改密码</li>
					</ul>
				</div>
			</div>
		</div>
		<div id="Maincontainer" class="container" style="margin-top:20px;margin-bottom:250px;">
			<div class="panel panel-default" style='width:500px'>
				<div class="panel-heading" style='margin-bottom:30px;'>
					<h3 class="panel-title">
						登录
					</h3>
				</div>
				<div class="panel-body" id="LoginForm">					
					<form class="form-horizontal">
					   <div class="form-group">
						<label for="staffMobile" class="col-sm-2 control-label" style="line-height:14px;">账号 :</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" id="staffMobile" placeholder="请输入账号">
						</div>
					  </div>
					  <div class="form-group">
						<label for="staffPassword" class="col-sm-2 control-label" style="line-height:14px;">密码 :</label>
						<div class="col-sm-10">
						  <input type="password" class="form-control" id="staffPassword" placeholder="请输入密码">
						</div>
					  </div>
					  <div class="form-group">
						<div class="col-sm-12" style="text-align: center;">
						  <button id="LoginBtn" type="button" class="btn btn-primary">登录</button>
						</div>
					  </div>
					</form>
				</div>
			</div>
		</div>
	</body>
	<?php	include "footer.php";?>
	<script type="text/javascript">
		var Settings = {};
	
		window.onload = OnLoad;
		
		function OnLoad(){
			BindEvents();
		}
		function BindEvents(){
			$("#LoginBtn").click(function(){
				loginName = $("#staffMobile").val();
				loginPassword = $("#staffPassword").val();
				
				if(loginName == ""){$("#staffMobile").focus();CommonWarning('账号不能为空！');return;}
				if(loginPassword == ""){$("#staffPassword").focus();CommonWarning('密码不能为空！');return;}
				url = "admin.login.ajax.php?mode=Login&loginName=" + loginName + "&loginPassword=" + md5(loginPassword);
				$.get(url,function(json,status){
					switch(json){
						case "1":
							window.location.href = "admin.manager.php";
							break;
						default:
							CommonWarning("登陆失败。");
							break;
					}
				});
			});
		}
		function CommonWarning(content,title){
			if(title == undefined){
				title = "";
			}
			$.confirm({
				icon: 'fa fa-warning',
				closeIcon: true,
				title: title,
				content: content,
				confirmButton: '确定',
				cancelButton: '取消'
			});
		}
   </script> 
</html>