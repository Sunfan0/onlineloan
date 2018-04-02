<?php
	include "paras.php";
	if(!isset($_SESSION["suppliername"]))
		Page("supply.login.php");
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
		<link rel="stylesheet" type="text/css" href="style/header.css">
	</head>
	<body>
		<div id="wrapper">
		<nav class="navbar navbar-inverse navbar-fixed-top" id="sidebar-wrapper" role="navigation">
            <ul class="nav sidebar-nav">
                <li class="sidebar-brand"><a>在线贷款供方后台</a></li>
                <li class="navBtn navtitle dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">产品管理<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li class="dropdown-header"></li>
                    <li class="navBtn navsubtitle" id="supply.infolist"><a>产品信息</a></li>
                    <li class="navBtn navsubtitle" id="supply.inforeplylist"><a>产品回复管理</a></li>
                  </ul>
                </li>
				<li class="navBtn navtitle dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">积分管理<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li class="dropdown-header"></li>
                    <li class="navBtn navsubtitle" id="supply.myscore"><a>我的积分</a></li>
                    <li class="navBtn navsubtitle" id="supply.myscorehistory"><a>积分履历</a></li>
                  </ul>
                </li>
				<li class="navBtn navtitle dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">查看列表管理<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li class="dropdown-header"></li>
                    <li class="navBtn navsubtitle" id="supply.viewsupplierlist"><a>查看联系方式</a></li>
                    <li class="navBtn navsubtitle" id="supply.viewinfolist"><a>查看产品信息</a></li>
                  </ul>
                </li>
				<li class="navBtn navtitle" id="supply.identify"><a>实名认证</a></li>
				<li class="navBtn navtitle dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">资讯管理<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li class="dropdown-header"></li>
                    <li class="navBtn navsubtitle" id="supply.newslist"><a>资讯管理</a></li>
                    <li class="navBtn navsubtitle" id="supply.newsreplylist"><a>资讯回复管理</a></li>
					<!--<li class="navBtn navsubtitle" id="supply.newsrecycle"><a>资讯回收站</a></li>-->
                  </ul>
                </li>
				<li class="navBtn navtitle" id="supply.noticelist"><a>站方通知</a></li>
				<li class="navBtn navtitle dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">用户信息管理<span class="caret"></span></a>
                  <ul class="dropdown-menu" role="menu">
                    <li class="dropdown-header"></li>
                    <li class="navBtn navsubtitle" id="supply.changepassword"><a>修改密码</a></li>
                    <li class="navBtn navsubtitle" id="supply.changeinfo"><a>修改个人信息</a></li>
                  </ul>
                </li>
            </ul>
        </nav>
	</div>
