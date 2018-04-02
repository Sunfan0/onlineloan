<?php
/* Smarty version 3.1.30, created on 2017-06-13 14:55:24
  from "E:\xampp\htdocs\test\test.works\onlineloan\smarty\templates\smartyheader.new.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_593f8c5ca73e03_52960158',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '221ded1d61aaba951939f2656ce3962fb1bd97dc' => 
    array (
      0 => 'E:\\xampp\\htdocs\\test\\test.works\\onlineloan\\smarty\\templates\\smartyheader.new.tpl',
      1 => 1495435553,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_593f8c5ca73e03_52960158 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>贷款信息网</title>
		<link rel="stylesheet" type="text/css" href="style/head.css"/>
		<link rel="stylesheet" type="text/css" href="style/footer.css"/>
		<link rel="stylesheet" href="style/css.css" />
		 <!-- 引入JQuery的官方类库 -->
		<?php echo '<script'; ?>
 type="text/javascript" src="js/jquery-1.11.1.min.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 type="text/javascript" src="js/scroll.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
 type="text/javascript" src="js/gVerify.js"><?php echo '</script'; ?>
>
		<?php echo '<script'; ?>
>
			//var verifyCode = new GVerify("apply_img");
			
			window.onload = OnLoad;
			function OnLoad(){
				$("#apply_submitbtn").click(function(){
					SubmitApply();
				});
				$("#apply_mcodebtn").click(function(){
					GetMcode();
				});
			}
			function showupdate(id){
				if(id==0){
					window.location.href='smartypage.new.php';
				}else{
					window.location.href='smartypage.new.php?subareaid='+id;
				}
			}
				
			/*function SubmitApply(){
				var money = $("#apply_money").val();
				var surname = $("#apply_surname").val();
				var sex = $('#apply_sex option:selected').val();
				var mobile = $("#apply_mobile").val();
				var mcode = $("#apply_mcode").val();
				
				if(!verifyCode.validate($("#apply_code").val())){
					$("#apply_code").val("");
					$("#apply_code").focus();
					CommonWarning('图片验证码错误');
				}
			}*/
			
			function GetMcode(){
				CommonJustTip('待调整，手机验证码暂时无需填写');
			}
		
			function LocationHref(page,id){
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
		<?php echo '</script'; ?>
>
	</head>

	<body>
		<!--这是头部的上面部分-->
		<div class="header">
			<div class="header-top">
				<div class='header-top-1'>
					<span class='span1-1 span1-5'></span>
					<span class='span1-2 span1-5 hoverpointer'>Hi,请登录   注册</span>
					<span class='span1-3 span1-5 hoverpointer'><img src="images/01_05.jpg" alt="" />&nbsp;&nbsp;微信</span>&nbsp;<span class='span1-6'></span>&nbsp;
					<span class='span1-4 span1-5 hoverpointer'><img src="images/01_07.jpg" alt="" />&nbsp;&nbsp;微博</span>
				</div>
			</div>
		</div>
		<div class="headerbg">
			<div class="header-bottom">
				<div class='header-bottom-left' onclick="LocationHref('smartypage')">
					<img src="images/01_13.jpg" alt="" />
					<i class='i1'>
						<img src="images/tel.png" alt="" class='img-1'/>
						&nbsp;<span class='span2-1'>15903379827</span>
					</i>
				</div>
				<div class='header-bottom-right'>
					<ul class='ul1'>
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
							<a onclick="LocationHref('smartynewslist','')">信贷咨讯</a>
						</li>
						<li>
							<a>我的账户</a>
						</li>
					</ul>
				</div>
			</div>
		</div><?php }
}
