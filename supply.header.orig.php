<?php
	include "paras.php";
	
	$currenturl = $_SERVER['PHP_SELF'];
	$isloginpage =count( explode('login',$currenturl));

	if(!isset($_SESSION["pageurl"])||$_SESSION["pageurl"]==""||$_SESSION["pageurl"]=='demand.infolist.php'){
		$_SESSION["pageurl"] ="supply.infolist.php";
	}
	
	if($isloginpage<=1 && CheckRights2() < 0)
		Page("supply.login.php");
	if ($isloginpage>1){
		$_SESSION["suppliername"]="";
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
		<link href="style/header.css" rel="stylesheet"/>
		<link href="style/footer.css" rel="stylesheet"/>
		<link href="js/craftpip/css/jquery-confirm.css" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="js/kkpager-master/src/kkpager_blue.css" />
		<link rel="stylesheet" type="text/css" href="style/bootstrap-select.css" />
		<link rel="stylesheet" type="text/css" href="style/bootstrap-fileinput.css">
		<link rel="stylesheet" href="js/DataTables-1.10.11/media/css/jquery.dataTables.min.css" type="text/css">
		<link rel="stylesheet" href="js/jquery-minicolors-master/jquery.minicolors.css">
		<style>
			#Maincontainer #RegisterForm .col-sm-9>*,
			#Maincontainer #RegisterForm .col-sm-10>*,
			#Maincontainer #RegisterForm .col-sm-4>*{
				width: 90% !important;
				display: inline;
			}
			#Maincontainer #RegisterForm .file-preview,
			#Maincontainer #RegisterForm .file-caption-main,
			#Maincontainer #RegisterForm .dropdown-toggle,
			#Maincontainer #RegisterForm #edui1{
				width: 90% !important;
			}
			#Maincontainer #RegisterForm .bootstrap-select>.dropdown-menu{
				position: inherit;
				min-width: 90% !important;
				width: 90% !important;
				/*position: absolute;
				left: initial !important;
				top: initial !important;*/
			}
			#kvFileinputModal{
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
				<div class='header-top-1'>
					<span class='span1-1 span1-5'></span>
					<span class='span1-2 span1-5 hoverpointer navBtn' id="supply.login">重新登陆</span>
					<span class='span1-3 span1-5 hoverpointer navBtn' id="supply.changeinfo">&nbsp;&nbsp;修改个人信息</span>
					&nbsp;<span class='span1-6'></span>&nbsp;
					<span class='span1-4 span1-5 hoverpointer navBtn' id="supply.changepassword">&nbsp;修改密码</span>
				</div>
			</div>
		</div>
		<div class="headerbg">
			<div class="header-bottom">
				<div class='header-bottom-left'>
					<img src="images/01_13.jpg" alt="" onclick="LocationHref('index')"/>
					<i class='i1' onclick="LocationHref('index')">
						<img src="images/tel.png" alt="" class='img-1'/>
						&nbsp;<span class='span2-1'><?=$telephone?></span>
					</i>
				</div>			
				<div class='header-bottom-right'>
					<ul class="ul1">
						<li class="dropdown" >
							<a class="dropdown-toggle" data-toggle="dropdown">产品管理
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li class="navBtn" id="supply.infolist"><a href="javascript:void(0);">产品信息</a></li>
								<li class="divider"></li>
								<li class="navBtn" id="supply.inforeplylist"><a href="javascript:void(0);">产品回复管理</a></li>
								
							</ul>
						</li>
						<li class="dropdown" >
							<a class="dropdown-toggle " data-toggle="dropdown">积分管理
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu ">
								<li class="navBtn" id="supply.myscore"><a href="javascript:void(0);">我的积分</a></li>
								<li class="divider"></li>
								<li class="navBtn" id="supply.myscorehistory"><a href="javascript:void(0);">积分履历</a></li>
							</ul>
						</li>
						<li class="dropdown" >
							<a class="dropdown-toggle" data-toggle="dropdown">查看列表管理
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li class="navBtn" id="supply.viewsupplierlist"><a href="javascript:void(0);">查看联系方式</a></li>
								<li class="divider"></li>
								<li class="navBtn" id="supply.viewinfolist"><a href="javascript:void(0);">查看产品信息</a></li>
								<li class="divider"></li>
								<li class="navBtn" id="supply.noticelist"><a href="javascript:void(0);">站方通知</a></li>
							</ul>
						</li>

						<li class="navBtn" id="supply.identify"><a href="javascript:void(0);">实名认证</a></li>
						<li class="dropdown" >
							<a class="dropdown-toggle" data-toggle="dropdown">资讯管理
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li class="navBtn" id="supply.newslist"><a href="javascript:void(0);">资讯管理</a></li>
								<li class="divider"></li>
								<li class="navBtn" id="supply.newsreplylist"><a href="javascript:void(0);">资讯回复管理</a></li>
							</ul>
						</li>
						<!--<li class="dropdown" >
							<a class="dropdown-toggle" data-toggle="dropdown">用户信息管理
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li class="navBtn" id="supply.changepassword"><a href="javascript:void(0);">修改密码</a></li>
								<li class="divider"></li>
								<li class="navBtn" id="supply.changeinfo"><a href="javascript:void(0);">修改个人信息</a></li>
							</ul>
						</li>-->
					</ul>
				</div>
			</div>
		</div>
