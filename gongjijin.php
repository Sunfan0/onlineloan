<?php
 include "paras.php";
?>
<!DOCTYPE html>
<html lang="en">
		<head>
		<meta charset="UTF-8">
		<title>贷款信息网</title>
		<link rel="stylesheet" type="text/css" href="style/head.css"/>
		<link rel="stylesheet" type="text/css" href="style/footer.css"/>
		<link rel="stylesheet" href="style/css.css" />
		<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="js/scroll.js"></script>
		<script type="text/javascript" src="js/gVerify.js"></script>
		<script>
			window.onload = OnLoad;
			function SkipHref(page){
				window.location.href= page+'.new.php';
			}
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
		</script>
	</head>
	<body>
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
		</div>
		<div class="contanier">
			<!--当前位置-->
			
			<div class="loaciton"><img src="images/location.png" alt="" />您当前的位置：
				<a class="hoverpointer" onclick="LocationHref('smartypage')">首页</a> >
				<a class="hoverpointer" onclick="SkipHref('gongjijin')">公积金贷款计算器</a> 
			</div>
			<div class="content clearfix">
				<div class="contleft">
					<div class="newscont bgborder" style="padding: 0px 20px 20px;">
						
					
					</div>
				</div>
				<div class="contright">
					<!--常用工具-->
					<div class='xindaidaixun-right'>
						<div class='xindaidaixun-right-top'>
							<div class='xindaidaixun-right-top-2'>
								<div class='div3-8'>
								</div>
								<span class='span3-5'>常用工具</span>
							</div>
						</div>
						<div class='xindaidaixun-right-buttom'>
							<div class='xindaidaixun-right-buttom-1'>
								<img src="images/01_34.jpg" alt="" onclick="SkipHref('fangdai')"/>
								<p>
									<span class='xindaidaixun-right-buttom-1-1' onclick="SkipHref('fangdai')">房贷计算器</span>
								</p>
							</div>

							<div class='xindaidaixun-right-buttom-1'>
								<img src="images/01_36.jpg" alt="" onclick="SkipHref('chedai')"/>
								<p>
									<span class='xindaidaixun-right-buttom-1-2' onclick="SkipHref('chedai')">车贷计算器</span>
								</p>
							</div>

							<div class='xindaidaixun-right-buttom-1'>
								<img src="images/01_40.jpg" alt="" onclick="SkipHref('ershoufnag')"/>
								<p>
									<span class='xindaidaixun-right-buttom-1-3' onclick="SkipHref('ershoufnag')">二手房贷计算器</span>
								</p>
							</div>

							<div class='xindaidaixun-right-buttom-1'>
								<img src="images/01_42.jpg" alt="" onclick="SkipHref('gongjijin')"/>
								<p>
									<span class='xindaidaixun-right-buttom-1-4' onclick="SkipHref('gongjijin')">公积金贷款计算器</span>
								</p>
							</div>
						</div>
					</div>			
				</div>
			</div>			
		</div>
		<?php
			 include "smartyfooter.new.php";
		?>
	</body>
	<script>
	
	</script>
</html>