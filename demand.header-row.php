<?php
	include "paras.php";
	
	$mode = Get("mode");
	switch($mode){
		case "ChangePassword":
			$oldPassword = Get("oldPassword");
			$newPassword = Get("newPassword");
			$userName = $_SESSION["demandername"];
			
			$userInfo = DBGetDataRowByField("demanderinfo","username",$userName);
			if($userInfo == null)
				die("-8");
			if($userInfo["password"] != $oldPassword)
				die("-9");
			
			if(DBUpdateField("demanderinfo" , $userInfo["id"] , "password" , $newPassword))
				die("1");
			else0.
				die("-1");
			break;
	}
	
	
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<title>在线贷款需方后台</title>
		
		<link href="style/bootstrap.css" rel="stylesheet"/>
		<link href="js/craftpip/css/jquery-confirm.css" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="js/kkpager-master/src/kkpager_blue.css" />
		<link rel="stylesheet" type="text/css" href="style/bootstrap-select.css" />
		<link rel="stylesheet" type="text/css" href="style/bootstrap-fileinput.css">
		<link rel="stylesheet" href="js/DataTables-1.10.11/media/css/jquery.dataTables.min.css" type="text/css">
		<link rel="stylesheet" href="js/jquery-minicolors-master/jquery.minicolors.css">
		<style>
			body{
				font-size:150% !important;
				font-family: "Microsoft YaHei" ! important;
				background-color:#e5e7e5 !important;
			}
			.container{
				font-size: 16px !important;
			}
			.nav-tabs>li>a{
				background-color:#337ab7 !important;
				border-bottom-color:transparent !important;
				color:#c8c8c8 !important;
				white-space: nowrap;
			}

			.nav-tabs>.active>a{
				color:#777 !important;
				background-color:#e5e7e5 !important;
			}
			.nav-tabs>li>a:hover{
				background-color:#286090 !important;
				border-color:#286090 !important;
				color:#c8c8c8 !important;
			}
			.table-hover > tbody > tr:hover {
				background-color: #b9bbbc !important;
			}
			.modal {
				z-index: 1000 !important;
			}
			.modal-backdrop {
				z-index: 800 !important;
			}
			.PreviewRow .row{
				padding:10px;
				font-size:14px !important;
			}
		</style>
	</head>
	<body>
		<nav class="navbar navbar-default" role="navigation" style="background-color:#337ab7;border:none;margin-bottom:0px;">
			<div class="container">
				<div class="navbar-header" style="padding:20px;">
					<a class="navbar-brand" href="javascript:void(0);" style="font-size:150%;font-weight:bold;color:#e5e7e5;">在线贷款需方后台</a>
				</div>
			</div>
			<div class="container" id="bs-example-navbar-coll
			apse-1" style="margin:0px auto;text-align:center">
				<ul class="nav nav-tabs nav-justified  navbar-nav">
					<li class="navBtn" id="demand.infolist"><a href="javascript:void(0);">需求列表</a></li>
					<li class="dropdown" >
						<a class="dropdown-toggle" data-toggle="dropdown">互动管理
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li class="navBtn" id="demand.reply"><a href="javascript:void(0);">留言信息</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="demand.attentionsupplyinfo"><a href="javascript:void(0);">关注产品信息</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="demand.attentionsupplier"><a href="javascript:void(0);">关注供方信息</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="demand.viewsupplierway"><a href="javascript:void(0);">查看联系方式</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="demand.noticelist"><a href="javascript:void(0);">站方通知</a></li>
						</ul>
					</li>
					<li class="dropdown" >
						<a class="dropdown-toggle" data-toggle="dropdown">用户信息管理
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li class="navBtn" id="demand.changepassword"><a href="javascript:void(0);">修改密码</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="demand.changeinfo"><a href="javascript:void(0);">修改个人信息</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</nav>
