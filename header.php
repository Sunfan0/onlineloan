<?php
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
			#Maincontainer .submitprompt>span{
				color:#ff2e31;
				vertical-align: sub;
				padding-left: 5px;
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
		<div id="wrapper">
			<!--<nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">-->
			<nav class="navbar" id="sidebar-wrapper" role="navigation">
				<ul class="nav sidebar-nav">
					<li class="sidebar-brand"><a>站方后台</a></li>
					<li class="navBtn navtitle" id="admin.manager"><a>账号管理</a></li>
					<li class="navBtn navtitle dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">审核管理<span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li class="dropdown-header"></li>
						<li class="navBtn navsubtitle" id="admin.checksupplier"><a><span class="glyphicon glyphicon-menu-right"></span>供方注册审核</a></li>
						<li class="navBtn navsubtitle" id="admin.checksupplyinfo"><a><span class="glyphicon glyphicon-menu-right"></span>供方信息审核</a></li>
						<li class="navBtn navsubtitle" id="admin.checkdemander"><a><span class="glyphicon glyphicon-menu-right"></span>需方注册审核</a></li>
						<li class="navBtn navsubtitle" id="admin.checkdemandinfo"><a><span class="glyphicon glyphicon-menu-right"></span>需方信息审核</a></li>
						<li class="navBtn navsubtitle" id="admin.checksupplynews"><a><span class="glyphicon glyphicon-menu-right"></span>资讯审核</a></li>
						<li class="navBtn navsubtitle" id="admin.checkmodify"><a><span class="glyphicon glyphicon-menu-right"></span>实名认证</a></li>
					  </ul>
					</li>
					<li class="navBtn navtitle dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">审核履历<span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li class="dropdown-header"></li>
						<li class="navBtn navsubtitle" id="admin.checksupplierhistory"><a><span class="glyphicon glyphicon-menu-right"></span>供方注册审核履历</a></li>
						<li class="navBtn navsubtitle" id="admin.checksupplyinfohistory"><a><span class="glyphicon glyphicon-menu-right"></span>供方信息审核履历</a></li>
						<li class="navBtn navsubtitle" id="admin.checkdemanderhistory"><a><span class="glyphicon glyphicon-menu-right"></span>需方注册审核履历</a></li>
						<li class="navBtn navsubtitle" id="admin.checkdemandinfohistory"><a><span class="glyphicon glyphicon-menu-right"></span>需方信息审核履历</a></li>
						<li class="navBtn navsubtitle" id="admin.checksupplynewshistory"><a><span class="glyphicon glyphicon-menu-right"></span>资讯审核履历</a></li>
						<li class="navBtn navsubtitle" id="admin.checkmodifyhistory"><a><span class="glyphicon glyphicon-menu-right"></span>实名认证履历</a></li>
					  </ul>
					</li>
					<li class="navBtn navtitle dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">资讯管理<span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li class="dropdown-header"></li>
						<li class="navBtn navsubtitle" id="admin.newslist"><a><span class="glyphicon glyphicon-menu-right"></span>资讯管理</a></li>
						<li class="navBtn navsubtitle" id="admin.newsreplylist"><a><span class="glyphicon glyphicon-menu-right"></span>资讯回复管理</a></li>
						<li class="navBtn navsubtitle" id="admin.newsrecycle"><a><span class="glyphicon glyphicon-menu-right"></span>资讯回收站</a></li>
					  </ul>
					</li>
					<li class="navBtn navtitle dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">贷款计算器管理<span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li class="dropdown-header"></li>
						<li class="navBtn navsubtitle" id="admin.housecalculator"><a><span class="glyphicon glyphicon-menu-right"></span>房贷计算器</a></li>
						<li class="navBtn navsubtitle" id="admin.oldhousecalculator"><a><span class="glyphicon glyphicon-menu-right"></span>二手房贷计算器</a></li>
						<li class="navBtn navsubtitle" id="admin.carcalculator"><a><span class="glyphicon glyphicon-menu-right"></span>车贷计算器</a></li>
						<li class="navBtn navsubtitle" id="admin.publicfundscalculator"><a><span class="glyphicon glyphicon-menu-right"></span>公积金计算器</a></li>
					  </ul>
					</li>
					<li class="navBtn navtitle dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">设置管理<span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li class="dropdown-header"></li>
						<li class="navBtn navsubtitle" id="admin.ScoreRuleSet"><a><span class="glyphicon glyphicon-menu-right"></span>积分规则</a></li>
						<li class="navBtn navsubtitle" id="admin.newstype"><a><span class="glyphicon glyphicon-menu-right"></span>资讯栏目</a></li>
						<li class="navBtn navsubtitle" id="admin.suppliermaxnum"><a><span class="glyphicon glyphicon-menu-right"></span>发布文章数设置</a></li>
						<li class="navBtn navsubtitle" id="admin.rechargescale"><a><span class="glyphicon glyphicon-menu-right"></span>充值比例</a></li>
						<li class="navBtn navsubtitle" id="admin.keyword"><a><span class="glyphicon glyphicon-menu-right"></span>敏感关键字</a></li>
						<li class="navBtn navsubtitle" id="admin.cooperation"><a><span class="glyphicon glyphicon-menu-right"></span>合作机构</a></li>
						<li class="navBtn navsubtitle" id="admin.webannounce"><a><span class="glyphicon glyphicon-menu-right"></span>公告信息</a></li>
						<li class="navBtn navsubtitle" id="admin.slideimg"><a><span class="glyphicon glyphicon-menu-right"></span>幻灯片设置</a></li>
						<li class="navBtn navsubtitle" id="admin.subarea"><a><span class="glyphicon glyphicon-menu-right"></span>区域子站</a></li>
						<li class="navBtn navsubtitle" id="admin.banner"><a><span class="glyphicon glyphicon-menu-right"></span>banner信息</a></li>
						<li class="navBtn navsubtitle" id="admin.labellist"><a><span class="glyphicon glyphicon-menu-right"></span>信息属性设置</a></li>
						<li class="navBtn navsubtitle" id="admin.footerfixed"><a><span class="glyphicon glyphicon-menu-right"></span>页脚固定信息设置</a></li>
						<li class="navBtn navsubtitle" id="admin.footerset"><a><span class="glyphicon glyphicon-menu-right"></span>页脚其他信息设置</a></li>
						<li class="navBtn navsubtitle" id="admin.checkset"><a><span class="glyphicon glyphicon-menu-right"></span>审核设置</a></li>
					  </ul>
					</li>
					<li class="navBtn navtitle dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">互动详情<span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li class="dropdown-header"></li>
						<li class="navBtn navsubtitle" id="admin.viewsupplierway"><a><span class="glyphicon glyphicon-menu-right"></span>查看供方联系方式</a></li>
						<li class="navBtn navsubtitle" id="admin.viewdemandinfo"><a><span class="glyphicon glyphicon-menu-right"></span>查看需方信息</a></li>
						<li class="navBtn navsubtitle" id="admin.viewsupplyinfo"><a><span class="glyphicon glyphicon-menu-right"></span>查看供方产品</a></li>
						<li class="navBtn navsubtitle" id="admin.attentionsupplier"><a><span class="glyphicon glyphicon-menu-right"></span>关注供方</a></li>
						<li class="navBtn navsubtitle" id="admin.attentionsupplyinfo"><a><span class="glyphicon glyphicon-menu-right"></span>关注供方产品</a></li>
						<li class="navBtn navsubtitle" id="admin.replysupplyinfo"><a><span class="glyphicon glyphicon-menu-right"></span>供方产品回复</a></li>
					  </ul>
					</li>
					<li class="navBtn navtitle dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">机构积分<span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li class="dropdown-header"></li>
						<li class="navBtn navsubtitle" id="admin.scoreobtain"><a><span class="glyphicon glyphicon-menu-right"></span>积分一览</a></li>
						<li class="navBtn navsubtitle" id="admin.scorechange"><a><span class="glyphicon glyphicon-menu-right"></span>积分履历调整</a></li>
					  </ul>
					</li>
					<li class="navBtn navtitle dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">站内通知管理<span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li class="dropdown-header"></li>
						<li class="navBtn navsubtitle" id="admin.historywebsitenotice"><a><span class="glyphicon glyphicon-menu-right"></span>已发送的通知</a></li>
						<li class="navBtn navsubtitle" id="admin.sendwebsitenotice"><a><span class="glyphicon glyphicon-menu-right"></span>发送通知</a></li>
					  </ul>
					</li>
					<li class="navBtn navtitle dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">用户信息管理<span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li class="dropdown-header"></li>
						<li class="navBtn navsubtitle" id="admin.usersupplier"><a><span class="glyphicon glyphicon-menu-right"></span>供方用户</a></li>
						<li class="navBtn navsubtitle" id="admin.userdemander"><a><span class="glyphicon glyphicon-menu-right"></span>需方用户</a></li>
					  </ul>
					</li>
					<!--<li class="navBtn navtitle" id="admin.changepassword"><a>修改密码</a></li>-->
				</ul>
			</nav>
		</div>
		
		
		