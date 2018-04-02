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
		<link rel="stylesheet" href="js/DataTables-1.10.11/media/css/jquery.dataTables.min.css" type="text/css">
		<link rel="stylesheet" type="text/css" href="style/header.css">
		<link rel="stylesheet" type="text/css" href="style/kkpager-style.css" />
		<link rel="stylesheet" type="text/css" href="style/footernew.css" />
	</head>
	<body>
		<div id="wrapper">
			<nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
				<ul class="nav sidebar-nav">
					<li class="sidebar-brand"><a>在线贷款站方后台</a></li>
					<li class="navBtn navtitle" id="admin.manager"><a>账号管理</a></li>
					<li class="navBtn navtitle dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">审核管理<span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li class="dropdown-header"></li>
						<li class="navBtn navsubtitle" id="admin.checksupplier"><a>供方注册审核</a></li>
						<li class="navBtn navsubtitle" id="admin.checksupplyinfo"><a>供方信息审核</a></li>
						<li class="navBtn navsubtitle" id="admin.checkdemander"><a>需方注册审核</a></li>
						<li class="navBtn navsubtitle" id="admin.checkdemandinfo"><a>需方信息审核</a></li>
						<li class="navBtn navsubtitle" id="admin.checksupplynews"><a>资讯审核</a></li>
						<li class="navBtn navsubtitle" id="admin.checkmodify"><a>实名认证</a></li>
					  </ul>
					</li>
					<li class="navBtn navtitle dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">审核履历<span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li class="dropdown-header"></li>
						<li class="navBtn navsubtitle" id="admin.checksupplierhistory"><a>供方注册审核履历</a></li>
						<li class="navBtn navsubtitle" id="admin.checksupplyinfohistory"><a>供方信息审核履历</a></li>
						<li class="navBtn navsubtitle" id="admin.checkdemanderhistory"><a>需方注册审核履历</a></li>
						<li class="navBtn navsubtitle" id="admin.checkdemandinfohistory"><a>需方信息审核履历</a></li>
						<li class="navBtn navsubtitle" id="admin.checksupplynewshistory"><a>资讯审核履历</a></li>
						<li class="navBtn navsubtitle" id="admin.checkmodifyhistory"><a>实名认证履历</a></li>
					  </ul>
					</li>
					<li class="navBtn navtitle dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">资讯管理<span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li class="dropdown-header"></li>
						<li class="navBtn navsubtitle" id="admin.newslist"><a>资讯管理</a></li>
						<li class="navBtn navsubtitle" id="admin.newsreplylist"><a>资讯回复管理</a></li>
						<li class="navBtn navsubtitle" id="admin.newsrecycle"><a>资讯回收站</a></li>
					  </ul>
					</li>
					<li class="navBtn navtitle dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">贷款计算器管理<span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li class="dropdown-header"></li>
						<li class="navBtn navsubtitle" id="admin.housecalculator"><a>房贷计算器</a></li>
						<li class="navBtn navsubtitle" id="admin.oldhousecalculator"><a>二手房贷计算器</a></li>
						<li class="navBtn navsubtitle" id="admin.carcalculator"><a>车贷计算器</a></li>
						<li class="navBtn navsubtitle" id="admin.publicfundscalculator"><a>公积金计算器</a></li>
					  </ul>
					</li>
					<li class="navBtn navtitle dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">设置管理<span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li class="dropdown-header"></li>
						<li class="navBtn navsubtitle" id="admin.ScoreRuleSet"><a>积分规则</a></li>
						<li class="navBtn navsubtitle" id="admin.newstype"><a>资讯栏目</a></li>
						<li class="navBtn navsubtitle" id="admin.suppliermaxnum"><a>发布文章数设置</a></li>
						<li class="navBtn navsubtitle" id="admin.rechargescale"><a>充值比例</a></li>
						<li class="navBtn navsubtitle" id="admin.keyword"><a>敏感关键字</a></li>
						<li class="navBtn navsubtitle" id="admin.cooperation"><a>合作机构</a></li>
						<li class="navBtn navsubtitle" id="admin.webannounce"><a>公告信息</a></li>
						<li class="navBtn navsubtitle" id="admin.slideimg"><a>幻灯片设置</a></li>
						<li class="navBtn navsubtitle" id="admin.subarea"><a>区域子站</a></li>
						<li class="navBtn navsubtitle" id="admin.banner"><a>banner信息</a></li>
						<li class="navBtn navsubtitle" id="admin.labellist"><a>信息属性设置</a></li>
						<li class="navBtn navsubtitle" id="admin.footerfixed"><a>页脚固定信息设置</a></li>
						<li class="navBtn navsubtitle" id="admin.footerset"><a>页脚其他信息设置</a></li>
						<li class="navBtn navsubtitle" id="admin.checkset"><a>审核设置</a></li>
					  </ul>
					</li>
					<li class="navBtn navtitle dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">互动详情<span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li class="dropdown-header"></li>
						<li class="navBtn navsubtitle" id="admin.viewsupplierway"><a>查看供方联系方式</a></li>
						<li class="navBtn navsubtitle" id="admin.viewdemandinfo"><a>查看需方信息</a></li>
						<li class="navBtn navsubtitle" id="admin.viewsupplyinfo"><a>查看供方产品</a></li>
						<li class="navBtn navsubtitle" id="admin.attentionsupplier"><a>关注供方</a></li>
						<li class="navBtn navsubtitle" id="admin.attentionsupplyinfo"><a>关注供方产品</a></li>
						<li class="navBtn navsubtitle" id="admin.replysupplyinfo"><a>供方产品回复</a></li>
					  </ul>
					</li>
					<li class="navBtn navtitle dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">机构积分<span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li class="dropdown-header"></li>
						<li class="navBtn navsubtitle" id="admin.scoreobtain"><a>积分一览</a></li>
						<li class="navBtn navsubtitle" id="admin.scorechange"><a>积分履历调整</a></li>
					  </ul>
					</li>
					<li class="navBtn navtitle dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">站内通知管理<span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li class="dropdown-header"></li>
						<li class="navBtn navsubtitle" id="admin.historywebsitenotice"><a>已发送的通知</a></li>
						<li class="navBtn navsubtitle" id="admin.sendwebsitenotice"><a>发送通知</a></li>
					  </ul>
					</li>
					<li class="navBtn navtitle dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">用户信息管理<span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li class="dropdown-header"></li>
						<li class="navBtn navsubtitle" id="admin.usersupplier"><a>供方用户</a></li>
						<li class="navBtn navsubtitle" id="admin.userdemander"><a>需方用户</a></li>
					  </ul>
					</li>
					<li class="navBtn navtitle" id="admin.changepassword"><a>修改密码</a></li>
				</ul>
			</nav>
		</div>
		
		
		