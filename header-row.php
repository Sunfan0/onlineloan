<?php
	include "paras.php";
	
	if(CheckRights3() < 0)
		Page("admin.login.php");
	
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
		<link rel="stylesheet" type="text/css" href="style/footernew.css">
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
					<a class="navbar-brand" href="javascript:void(0);" style="font-size:150%;font-weight:bold;color:#e5e7e5;">在线贷款站方后台</a>
				</div>
			</div>
			<div class="container" id="bs-example-navbar-collapse-1" style="margin:0px auto;text-align:center">
				<ul class="nav nav-tabs nav-justified  navbar-nav">
					<li class="navBtn" id="admin.manager"><a href="javascript:void(0);">账号管理</a></li>
					<li class="dropdown" >
						<a class="dropdown-toggle " data-toggle="dropdown">审核管理
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu ">
							<li class="navBtn" id="admin.checksupplier"><a href="javascript:void(0);">供方注册审核</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.checksupplyinfo"><a href="javascript:void(0);">供方信息审核</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.checkdemander"><a href="javascript:void(0);">需方注册审核</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.checkdemandinfo"><a href="javascript:void(0);">需方信息审核</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.checksupplynews"><a href="javascript:void(0);">资讯审核</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.checkmodify"><a href="javascript:void(0);">实名认证</a></li>
						
						</ul>
					</li>
					<li class="dropdown" >
						<a class="dropdown-toggle " data-toggle="dropdown">审核履历
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu ">
							<li class="navBtn" id="admin.checksupplierhistory"><a href="javascript:void(0);">供方注册审核履历</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.checksupplyinfohistory"><a href="javascript:void(0);">供方信息审核履历</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.checkdemanderhistory"><a href="javascript:void(0);">需方注册审核履历</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.checkdemandinfohistory"><a href="javascript:void(0);">需方信息审核履历</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.checksupplynewshistory"><a href="javascript:void(0);">资讯审核履历</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.checkmodifyhistory"><a href="javascript:void(0);">实名认证履历</a></li>
						</ul>
					</li>
					<li class="dropdown" >
						<a class="dropdown-toggle" data-toggle="dropdown">资讯管理
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li class="navBtn" id="admin.newslist"><a href="javascript:void(0);">资讯管理</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.newsreplylist"><a href="javascript:void(0);">资讯回复管理</a></li>
						</ul>
					</li>
					<li class="dropdown" >
						<a class="dropdown-toggle" data-toggle="dropdown">贷款计算器管理
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li class="navBtn" id="admin.housecalculator"><a href="javascript:void(0);">房贷计算器</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.oldhousecalculator"><a href="javascript:void(0);">二手房贷计算器</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.carcalculator"><a href="javascript:void(0);">车贷计算器</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.publicfundscalculator"><a href="javascript:void(0);">公积金计算器</a></li>
						</ul>
					</li>
					<li class="dropdown" >
						<a class="dropdown-toggle" data-toggle="dropdown">设置管理
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li class="navBtn" id="admin.ScoreRuleSet"><a href="javascript:void(0);">积分规则
							</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.newstype"><a href="javascript:void(0);">资讯栏目</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.rechargescale"><a href="javascript:void(0);">充值比例</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.keyword"><a href="javascript:void(0);">敏感关键字</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.cooperation"><a href="javascript:void(0);">合作机构</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.webannounce"><a href="javascript:void(0);">公告信息</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.slideimg"><a href="javascript:void(0);">幻灯片设置</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.subarea"><a href="javascript:void(0);">区域子站</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.banner"><a href="javascript:void(0);">banner信息</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.labellist"><a href="javascript:void(0);">信息属性设置</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.footerfixed"><a href="javascript:void(0);">页脚固定信息设置</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.footerset"><a href="javascript:void(0);">页脚其他信息设置</a></li>
							
						</ul>
					</li>
					<li class="dropdown" >
						<a class="dropdown-toggle" data-toggle="dropdown">互动详情
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li class="navBtn" id="admin.viewsupplierway"><a href="javascript:void(0);">查看供方联系方式
							</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.viewdemandinfo"><a href="javascript:void(0);">查看需方信息</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.viewsupplyinfo"><a href="javascript:void(0);">查看供方产品</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.attentionsupplier"><a href="javascript:void(0);">关注供方</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.attentionsupplyinfo"><a href="javascript:void(0);">关注供方产品</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.replysupplyinfo"><a href="javascript:void(0);">供方产品回复</a></li>
							
						</ul>
					</li>
					<li class="dropdown" >
						<a class="dropdown-toggle" data-toggle="dropdown">机构积分
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li class="navBtn" id="admin.scoreobtain"><a href="javascript:void(0);">积分一览</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.scorechange"><a href="javascript:void(0);">积分履历调整</a></li>
						</ul>
					</li>
					
					<li class="dropdown" >
						<a class="dropdown-toggle" data-toggle="dropdown">站内通知管理
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li class="navBtn" id="admin.historywebsitenotice"><a href="javascript:void(0);">已发送的通知</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.sendwebsitenotice"><a href="javascript:void(0);">发送通知</a></li>
						</ul>
					</li>
					<li class="dropdown" >
						<a class="dropdown-toggle" data-toggle="dropdown">用户信息管理
							<span class="caret"></span>
						</a>
						<ul class="dropdown-menu">
							<li class="navBtn" id="admin.usersupplier"><a href="javascript:void(0);">供方用户</a></li>
							<li class="divider"></li>
							<li class="navBtn" id="admin.userdemander"><a href="javascript:void(0);">需方用户</a></li>
						</ul>
					</li>
					<li class="navBtn" id="admin.changepassword"><a href="javascript:void(0);">修改密码</a></li>
				</ul>
			</div>
		</nav>
