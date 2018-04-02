<?php
	include "paras.php";
	
	$currenturl = $_SERVER['PHP_SELF'];
	$isloginpage =count( explode('login',$currenturl));

	if(!isset($_SESSION["pageurl"])||$_SESSION["pageurl"]=='supply.infolist.php'||$_SESSION["pageurl"]=='demand.infolist.php'){
		$_SESSION["pageurl"] ='';
	}
	
	if($isloginpage<=1 && CheckRights2() < 0)
		Page("login.php");
	if ($isloginpage>1){
		$_SESSION["suppliername"]="";
		$_SESSION["showname"]="";
	}
	$mode = Get("mode");
	switch($mode){
		case "ChangePassword":
			$oldPassword = Get("oldPassword");
			$newPassword = Get("newPassword");
			$userName = $_SESSION["suppliername"];
			
			$userInfo = DBGetDataRowByField("supplierinfo","username",$userName);
			if($userInfo == null)
				die("-8");
			if($userInfo["password"] != $oldPassword)
				die("-9");
			
			if(DBUpdateField("supplierinfo" , $userInfo["id"] , "password" , $newPassword))
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
		<title>在线贷款供方后台</title>
		
		<link href="style/bootstrap.css" rel="stylesheet"/>
		<link href="js/craftpip/css/jquery-confirm.css" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="js/kkpager-master/src/kkpager_blue.css" />
		<link rel="stylesheet" type="text/css" href="style/bootstrap-select.css" />
		<link rel="stylesheet" type="text/css" href="style/bootstrap-fileinput.css">
		<link rel="stylesheet" href="js/DataTables-1.10.11/media/css/jquery.dataTables.min.css" type="text/css">
		<link rel="stylesheet" href="js/jquery-minicolors-master/jquery.minicolors.css">
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
						<li id="login" class="hoverpointer navBtn">重新登陆</li>
						<li id="supply.changeinfo" class="hoverpointer navBtn">修改个人信息</li>
						<li id="supply.changepassword" class="hoverpointer navBtn">修改密码</li>
					</ul>
				</div>
			</div>
		</div>
		<div id="wrapper">
			<!--<nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">-->
			<nav class="navbar" id="sidebar-wrapper" role="navigation">
				<ul class="nav sidebar-nav">
					<li class="sidebar-brand"><a>供方后台</a></li>
					<li class="navBtn navtitle dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">产品管理<span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li class="dropdown-header"></li>
						<li class="navBtn navsubtitle" id="supply.infolist"><a><span class="glyphicon glyphicon-menu-right"></span>产品信息</a></li>
						<li class="navBtn navsubtitle" id="supply.inforeplylist"><a><span class="glyphicon glyphicon-menu-right"></span>产品回复管理</a></li>
					  </ul>
					</li>
					<li class="navBtn navtitle dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">积分管理<span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li class="dropdown-header"></li>
						<li class="navBtn navsubtitle" id="supply.myscore"><a><span class="glyphicon glyphicon-menu-right"></span>我的积分</a></li>
						<li class="navBtn navsubtitle" id="supply.myscorehistory"><a><span class="glyphicon glyphicon-menu-right"></span>积分履历</a></li>
					  </ul>
					</li>
					<li class="navBtn navtitle dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">查看列表管理<span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li class="dropdown-header"></li>
						<li class="navBtn navsubtitle" id="supply.viewsupplierlist"><a><span class="glyphicon glyphicon-menu-right"></span>查看联系方式</a></li>
						<li class="navBtn navsubtitle" id="supply.viewinfolist"><a><span class="glyphicon glyphicon-menu-right"></span>查看产品信息</a></li>
					  </ul>
					</li>
					<li class="navBtn navtitle" id="supply.identify"><a>实名认证</a></li>
					<li class="navBtn navtitle dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">资讯管理<span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li class="dropdown-header"></li>
						<li class="navBtn navsubtitle" id="supply.newslist"><a><span class="glyphicon glyphicon-menu-right"></span>资讯管理</a></li>
						<li class="navBtn navsubtitle" id="supply.newsreplylist"><a><span class="glyphicon glyphicon-menu-right"></span>资讯回复管理</a></li>
						<!--<li class="navBtn navsubtitle" id="supply.newsrecycle"><a><span class="glyphicon glyphicon-menu-right"></span>资讯回收站</a></li>-->
					  </ul>
					</li>
					<li class="navBtn navtitle" id="supply.noticelist"><a>站方通知</a></li>
					<!--<li class="navBtn navtitle dropdown">
					  <a href="#" class="dropdown-toggle" data-toggle="dropdown">用户信息管理<span class="caret"></span></a>
					  <ul class="dropdown-menu" role="menu">
						<li class="dropdown-header"></li>
						<li class="navBtn navsubtitle" id="supply.changepassword"><a><span class="glyphicon glyphicon-menu-right"></span>修改密码</a></li>
						<li class="navBtn navsubtitle" id="supply.changeinfo"><a><span class="glyphicon glyphicon-menu-right"></span>修改个人信息</a></li>
					  </ul>
					</li>-->
				</ul>
			</nav>
		</div>

