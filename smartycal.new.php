<?php
	$strSql = "select * FROM `footerfixed` order by createtime desc ";//页脚固定显示
	$footerfixed = DBGetDataRow($strSql);
	$telephone=$footerfixed["telephone"];
	$showname=$_SESSION["showname"];
	$viewright=0;
	$ismodify=0;
	if($showname!=""){//登录
		
		$supplierinfo = DBGetDataRowByField("supplierinfo" , array("username"),array($showname));
		if($supplierinfo==null){//需方
			$demanderinfo = DBGetDataRowByField("demanderinfo" , array("username"),array($showname));
			if($demanderinfo!=null){
				$viewright=1;
				$ismodify=1;//需方
			}
		}else{//供方
			$viewright=2;
			$ismodify=2;//供方
		}
	}
	$_SESSION["pageurl"]=$_SERVER['REQUEST_URI'];//获取链接赋值
	
	$strurl=$_SESSION["subareaurl"];
	//(/index.php?subareaid=6)
	$subareaid=strstr($strurl,"=");
	$subareaid=substr($subareaid,1);
	if($subareaid==""){
		$subareaname='全国';
	}else{
		$subarealist = DBGetDataRowByField("subarea" , array("id"),array($subareaid));
		$subareaname=$subarealist["name"]; 
	}
	
?>
<!DOCTYPE html>
<html lang="en">
		<head>
		<meta charset="UTF-8">
		<!--<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
		<meta http-equiv="X-UA-Compatible" content="IE=9" />-->
		<title id="common_title">贷款信息网</title>
		<link rel="stylesheet" type="text/css" href="style/head.css"/>
		<link href="js/craftpip/css/jquery-confirm.css" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="style/footer.css"/>
		<link rel="stylesheet" href="style/css.css" />
		<link rel="stylesheet" href="style/bootstrap.v2.css" />
		<!--<link rel="stylesheet" type="text/css" href="bsie/bootstrap/css/bootstrap-ie6.css">-->
		<link rel="stylesheet" type="text/css" href="bsie/bootstrap/css/ie.css">  
		<style>
			.chedaidiv h3 {
				font-size: 16px;
				font-weight: 400;
				margin: 20px 0 20px 30px;
			}
			.chedaidiv .content-block {
				border-bottom: dotted 1px #e0e6ef;
				padding-bottom: 20px;
				margin: 0 40px;
			}
			.chedaidiv .content-block .content-title{
				font-size: 20px !important;
				color: #ff6801 !important;
				margin-right: 5px;
			}
			.chedaidiv .content-block table a{
				font-size: 14px !important;
				color: #666 !important;
			}
			.chedaidiv .content-block .yt-text{
				width: 178px;
				height: 28px;
				border: solid 1px #d5d5d5;
				line-height: 28px;
				color: #666;
			}
			.chedaidiv .input-block td {
				height: 40px;
			}
			.chedaidiv .input-block .inpt {
				border: solid 1px #d5d5d5;
				height: 28px;
				line-height: 28px;
				padding: 0 10px;
				width: 156px;
			}
			.chedaidiv .input-block .calc_link {
				font-size: 14px;
				line-height: 30px;
				margin-left: 15px;
			}
			.chedaidiv .input-block .btn {
				border: 0;
				display: block;
				float: left;
				height: 30px;
				font-size: 14px;
				font-weight: 700;
				width: 85px;
			}
			.chedaidiv .input-block .cal-btn {
				color: #fff;
				background-color: #67bcd8;
			}
			.chedaidiv .input-block .reset-btn {
				color: #000;
				margin-left: 10px;
			}
			.chedaidiv .result-block .r_title {
				line-height: 36px;
				margin-top: 20px;
				background: #f1f1f1;
				border: solid 1px #d5d5d5;
				height: 36px;
				padding: 0 20px;
			}
			.chedaidiv .result-block em {
				color: red;
			}
			.chedaidiv #citylist {
				width: 426px;
				position: absolute;
				z-index: 9999;
				background: #FFF;
				border: 1px solid#999;
				top: 113px;
				padding: 0;
			}
			.chedaidiv #citylist .bt {
				background: #EDEDED;
				height: 25px;
				border-bottom: 1px solid#D1D1D1;
				padding: 5px 0 0 20px;
			}
			.chedaidiv #citylist .lb {
				padding-left: 20px;
				float: left;
			}
			.chedaidiv #citylist #citylist_close {
				padding: 10px;
				position: absolute;
				left: 392px;
			}
			.chedaidiv #citylist dl {
				float: left;
				padding: 10px 0;
			}
			.chedaidiv #citylist dt {
				font-size: 12px;
				font-weight: 700;
			}
			.chedaidiv #citylist li {
				float: left;
				width: 45px;
				color: #05b;
				font-size: 12px;
				cursor: pointer;
			}
			.chedaidiv .result-block td {
				line-height: 30px;
			}
			.chedaidiv .result-block .tbl {
				border: solid #d5d5d5;
				border-width: 1px 0 0 1px;
			}
			.chedaidiv .result-block .tbl td {
				padding: 0 20px;
				border: solid #d5d5d5;
				border-width: 0 1px 1px 0;
				height: 25px;
			}
			.chedaidiv .result-block .r_result .inpt {
				border: 0;
				text-align: right;
				width: 80px;
				height: 28px;
				line-height: 28px;
			}
			.chedaidiv .result-block .r_result .r_layout {
				border: solid 1px #d5d5d5;
				border-top: 0;
				width:100%;
			}
			.chedaidiv .result-block .r_result .r_layout table {
				margin: 20px 0;
			}
			.chedaidiv .result-block .r_result .bxlx ul {
				border: solid 1px #d5d5d5;
				-moz-border-radius: 5px;
				-webkit-border-radius: 5px;
				border-radius: 5px;
				margin: 20px auto;
				overflow: hidden;
				width: 378px;
			}
			.chedaidiv .result-block .r_result .bxlx ul .on {
				background: #f1f1f1;
			}
			.chedaidiv .result-block .r_result .bxlx ul li {
				cursor: pointer;
				float: left;
				text-align: center;
				width: 125px;
			}
			.chedaidiv .result-block .tbl .r_td1 {
				width: 90px;
				background: #F8F8F8;
				padding-left: 10px;
			}
			.chedaidiv .result-block .tbl .r_td2 {
				background: #FFF;
				padding-right: 5px;
				text-align: right;
				color: #ccc;
			}
			.chedaidiv .content-block .tsk .close {
				float: right;
				cursor: pointer;
			}
			.chedaidiv .result-block .r_result .r_title .tjt{
				float: right;
				top: 15px;
				position: relative;
			}
			
			
			.calotherdiv .content-block {
				border-bottom: 0px;
			}
			.calotherdiv .content-block .btntd{
				height: 60px;
			}
			.calotherdiv .content-block .reset-btn{
				line-height: inherit !important;
			}
			.calotherdiv .content-block h3{
				border-bottom: 2px #66bdd7 solid;
				margin: 20px 0;
			}
			.calotherdiv .content-block h3 span{
				display: inline-block;
				color: #fff;
				background: #66bdd7;
				width: 75px;
				height: 33px;
				text-align: center;
				line-height: 33px;
			}
			.calotherdiv .result-block .td1{
				color: #333;
			}
			.calotherdiv .result-block .td2{
				color: #666;
			}
			.calotherdiv .result-block .r_title{
				padding:10px;
			}
			.calotherdiv .result-block .tbl td{
				height: 30px;
			}
			.calotherdiv .result-block .panel{
				display: inline-block;
				width: 312px;
			}
			.calotherdiv .result-block .panel{
				display: inline-block;
				width: 312px;
			}
			
			.jconfirm-scrollpane .container{
				width:300px;
				margin:auto;
			}
			.jconfirm-scrollpane .container button {
				background-color: white;
			}
			.jconfirm-scrollpane .content-pane .content{
				margin-top: 0px !important;
			}
			.jconfirm-scrollpane .container .title {
				color: #666 !important;
			}
			.jconfirm-scrollpane .container .col-md-offset-4 {
				margin: 0px !important;
			}
			.jconfirm-scrollpane .container .col-md-4 {
				width: 100% !important;
			}
			
			.logintype{
				font-size: 16px;
				display: block;
				margin: 10px 0;
				color: #5e5e5e !important;
				text-decoration: none;
			}
			.logintype:hover {
				color:#63b5d0 !important;
				text-decoration: none;
			}
			.contright .xindaidaixun-right .xindaidaixun-right-buttom-1:hover span{
				 font-size: 16px;
			}
			.header_login:hover{
				text-decoration: underline;
			}
		</style>
		<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="js/craftpip/js/jquery-confirm.js"></script>
		<script type="text/javascript" src="js/scroll.js"></script>
		<script type="text/javascript" src="js/gVerify.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
		<!--<script type="text/javascript" src="bsie/js/bootstrap-ie.js"></script>
		<script src="http://apps.bdimg.com/libs/html5shiv/3.7/html5shiv.min.js"></script>
		<script src="http://apps.bdimg.com/libs/respond.js/1.4.2/respond.min.js"></script>-->
		<script>
			$(function() {
				if (!!window.ActiveXObject || "ActiveXObject" in window){
					return;
				}
				document.addEventListener('DOMContentLoaded', function (event) {
					document.body.style.zoom = 'reset';
					document.addEventListener('keydown', function (event) {
						if ((event.ctrlKey === true || event.metaKey === true)
						&& (event.which === 61 || event.which === 107
							|| event.which === 173 || event.which === 109
							|| event.which === 187  || event.which === 189))
							{
							   event.preventDefault();
							}
					}, false);
					document.addEventListener('mousewheel DOMMouseScroll', function (event) {
						if (event.ctrlKey === true || event.metaKey) {
							event.preventDefault();
						}
					}, false);
				}, false);
			});
			
			$(function(){
				var title = "贷款信息网";
				var a = location.href;  
				var b = a.split("/");  
				var c = b.slice(b.length-1, b.length).toString(String).split("."); 
				switch(c[0]){
					case "fangdai":
						title = "贷款信息网 | 房贷计算器";
						break;
					case "chedai":
						title = "贷款信息网 | 车贷计算器";
						break;
					case "ershoufang":
						title = "贷款信息网 | 二手房贷计算器";
						break;
					case "gongjijin":
						title = "贷款信息网 | 公积金贷款计算器";
						break;
				}
				//$("#common_title").text(title);
				document.title=title;
			});
			
			window.onload = OnLoad;
			function OnLoad(){
				$("#apply_submitbtn").click(function(){
					SubmitApply();
				});
				$("#apply_mcodebtn").click(function(){
					GetMcode();
				});
				ShowCurrentcity();
			}
			function showupdate(id){
				if(id==0){
					window.location.href='index.php';
				}else{
					window.location.href='index.php?subareaid='+id;
				}
			}
			function GetMcode(){
				CommonJustTip('待调整，手机验证码暂时无需填写');
			}
		
			function LocationHref(page,id){
				if(page == "index"){
					window.location.href= page+'.php';
					return;
				}
				if(id == undefined){
					window.location.href= page+'.new.php';
					return;
				}
				var idname = "";
				switch(page){
					case "smartyproindex":
						idname="supplyinfoid";
						break;
					case "smartyproductsdetails":
						idname="supplyinfoid";
						break;
					case "smartyconsultantdetails":
						idname="supplierid";
						break;
					case "smartynews":
						idname="newsid";
						break;
					case "smartyneed":
						idname="demandinfoid";
						break;
					case "smartyfooterdetail":
						idname="footerid";
						break;
				}
				window.location.href= page+'.new.php?'+idname+'='+id;
			}
			
		function CommonJustTip(content,title){
			if(title == undefined){
				title = "";
			}
			$.confirm({				
				title: title,
				content: content,
				// confirmButton: '确定',
				confirmButton: false,
				cancelButton: false,
				backgroundDismiss: true,
				// autoClose: 'confirm|1000'
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
		
		function CommonConfirm(content,title){
			if(title == undefined){
				title = "";
			}
			$.confirm({
				// icon: 'glyphicon glyphicon-heart',
				title: title,
				content: content,
				confirmButton: '确定',
				cancelButton: '取消'
			});
		}	
		function CommonNopower(){
			$.confirm({
				title: '',
				content: '您没有该页面的访问权限！',
				confirmButton: '确定',
				cancelButton: false,
				backgroundDismiss: true,
				autoClose: 'confirm|1000'
			});
		}
		function SkipHref(page){
			window.location.href= page+'.new.php';
		}
		function GoLogin(operate){
			window.location.href = "login.php?operate="+operate;
		}
		function DropLogin(){
			url = "ajax.php?mode=DropLogin";
			$.get(url,function(json,status){
				window.location.reload();
			})
		}
		function GoAdminpage(type){
			switch(type){
				case 0:
					url = "ajax.php?mode=DropPageurl";
					$.get(url,function(json,status){
						GoLogin(0);
					})
					
					break;
				case 1:
					url = "ajax.php?mode=DropPageurl";
					$.get(url,function(json,status){
						window.location.href = "demand.infolist.php";
					})
					break;
				case 2:
					url = "ajax.php?mode=DropPageurl";
					$.get(url,function(json,status){
						window.location.href='supply.infolist.php';
					})
					break;
			}
		}
		function ShowCurrentcity(){
			/*var i,length={$subarealist|@count};
			if(getUrlParam('subareaid') == 0){
				$("#current_city").text("当前城市：全国");
			}else{
				for(i=0;i<length;i++){
					if(getUrlParam('subareaid') == {json_encode($subarealist)}[i].id){
						$("#current_city").text("当前城市："+{json_encode($subarealist)}[i].name);
					}
				}
			}*/
		}
		</script>
	</head>
	<body>
		<div class="header">
			<div class="header-top">
				<div class='header-top-1'>
					<span id="current_city" class='span1-1 span1-5'>当前城市：<?php echo $subareaname ?></span>
					<span class='span1-1 span1-5'></span>
					<?php if($viewright==0){?>
						<span class='span1-2 span1-5 hoverpointer header_login' onclick="GoLogin(0);">Hi,请登录</span>
							<span class='span1-5 hoverpointer header_login' style="color: #ff2e31;margin-left: 10px;" onclick="GoLogin(1);">注册</span>
					<?php }else{?>
						<span class='span1-2 span1-5 hoverpointer'>Hi,<?=$showname?></span>
						<span class='span1-5 hoverpointer header_login' style="margin-left: 10px;" onclick="DropLogin();">退出登录</span>
					<?php }?>
					<!--<span class='span1-3 span1-5 hoverpointer'><img src="images/01_05.jpg" alt="" />&nbsp;&nbsp;微信</span>&nbsp;<span class='span1-6'></span>&nbsp;
					<span class='span1-4 span1-5 hoverpointer'><img src="images/01_07.jpg" alt="" />&nbsp;&nbsp;微博</span>-->
				</div>
			</div>
		</div>
		<div class="headerbg">
			<div class="header-bottom">
				<div class='header-bottom-left' onclick="LocationHref('index')">
					<img src="images/01_13.jpg" alt="" />
					<i class='i1'>
						<img src="images/tel.png" alt="" class='img-1'/>
						&nbsp;<span class='span2-1'><?=$telephone?></span>
					</i>
				</div>
				<div class='header-bottom-right'>
					<ul class='ul1'>
						<li>
							<a onclick="LocationHref('index')">首页</a>
						</li>
						<li>
							<a onclick="LocationHref('smartyproindex','0')">找客户</a>
						</li>
						<li>
							<a onclick="LocationHref('smartyproindex','1')">找产品</a>
						</li>
						<li>
							<a onclick="LocationHref('smartyproindex','2')">找顾问</a>
						</li>
						<li>
							<a onclick="LocationHref('smartynewslist','')">贷款资讯</a>
						</li>
						<li>
							<?php if($viewright==0){?>
								<a onclick="GoAdminpage(0);">我的账户</a>
							<?php }else{?>
								<a onclick="GoAdminpage(<?=$ismodify?>);">我的账户</a>
							<?php }?>
						</li>
					</ul>
				</div>
			</div>
		</div>
		