<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title id="common_title">中国贷款信息网</title>
		<link rel="stylesheet" type="text/css" href="style/head.css"/>
		<link rel="stylesheet" type="text/css" href="style/footer.css"/>
		<link href="js/craftpip/css/jquery-confirm.css" rel="stylesheet"/>
		<link rel="stylesheet" href="style/css.css" />
		<link rel="stylesheet" href="style/kkpager-style.css" />
		<link rel="stylesheet" type="text/css" href="js/kkpager-master/src/kkpager_blue.css" />
		<style>
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
			.logintype{
				font-size: 16px;
				display: block;
				margin: 10px 0;
			}
			.logintype:hover {
				color:#63b5d0;
			}
			
			/* common */
			.hoverpointer{
				transition:all .3s linear 0s;
			}
			.hoverpointer a{
				transition:all .3s linear 0s;
			}
			.contright .xindaidaixun-right .xindaidaixun-right-buttom-1:hover span{
				 font-size: 16px;
			}
			.daikuanguwen-3-right .hoverpointer:hover span{
				color:#63b5d0;
				font-size:16px;
			}
			.contright .hotnewslist .hoverpointer:hover a{
				color:#63b5d0;
				font-size:16px;
			}
			.contright .rjgwwrap .rjgwpic .infoheadright:hover {
				border: 1px solid #63b5d0;
				box-shadow: 1px 1px 2px #66bdd7;
			}
			.contright .rjgwwrap .rjgwpic p:hover {
				color:#f96800;
			}
			.contright .rjgwwrap .rjgwtex div:hover {
				color:#63b5d0;
			}
			.contright .rjgwwrap .rjgwtex p:hover{
				color:#f96800;
			}
			.contright .rjgwwrap .rjgwtel a:hover{
				color:#63b5d0;
			}
			.needcont .needflow:hover{
				color:#f96800;
				cursor: pointer;
			}
			.table1-1 .hoverpointer:hover{
				background-color:#caedf8;
			}
			
			/*页面smartyproindex.new.php*/
			.navtabwrap .prolist .daikuanchanpin-top .hoverpointer:hover{
				color: #09a9de;
			}
			.navtabwrap .prolist .content .contleft .liketextpic:hover{
				border: 1px solid #09a9de;
				box-shadow: 1px 1px 2px #66bdd7;
			}
			.navtabwrap .prolist .content .contleft .liketel:hover a{
				font-size: 16px;
			}
			
			/*页面smartynewslist.new.php*/
			.contleft .newshottop .hoverpointer:hover img{
				border: 1px solid #63b5d0;
				box-shadow: 1px 1px 2px #66bdd7;
			}
			.contleft .newshottop .hoverpointer:hover h2>a{
				color:#63b5d0 !important;
				font-size:16px;
			}
			.contleft .newslist .hoverpointer:hover a{
				color:#63b5d0 !important;
			}
			
			/*页面smartyconsultantdetails.new.php*/
			.contleft .needleft .liketel a:hover{
				color:#63b5d0;
			}
			/*页面smartyneed.new.php*/
			.contleft .needright .looktel a:hover{
				font-size: 18px;
			}
			.header_login:hover{
				text-decoration: underline;
			}
			
		</style>
		 <!-- 引入JQuery的官方类库 -->
		<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="js/craftpip/js/jquery-confirm.js"></script>
		<script type="text/javascript" src="js/scroll.js"></script>
		<!-- <script type="text/javascript" src="js/gVerify.js"></script> -->
		<script src="js/kkpager-master/src/kkpager.min.js" charset="utf-8"></script>
		<!-- <script type="text/javascript" src="js/selectivizr-min.js"></script> -->
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
		
			window.onload = OnLoad;
			function OnLoad(){
				$("#apply_submitbtn").click(function(){
					SubmitApply();
				});
				$("#apply_mcodebtn").click(function(){
					GetMcode();
				});
			}
			function ShowTitlecon(con){
				var title = "中国贷款信息网";
				var a = location.href;  
				var b = a.split("/");  
				var c = b.slice(b.length-1, b.length).toString(String).split("."); 
				switch(c[0]){
					case "smartyproindex":
						var index = c[2].slice(c[2].length-1, c[2].length);
						switch(index){
							case "0":
								title = "贷款需求 | 中国贷款信息网";
								break;
							case "1":
								title = "贷款产品 | 中国贷款信息网";
								break;
							case "2":
								title = "贷款顾问 | 中国贷款信息网";
								break;
						}
						break;
					case "smartynewslist":
						title = "贷款资讯 | 中国贷款信息网";
						break;
					/*
					case "smartyproductsdetails":
						title = "贷款产品详情 | 中国贷款信息网";
						break;
					case "smartyconsultantdetails":
						title = "贷款顾问详情 | 中国贷款信息网";
						break;
					case "smartyneed":
						title = "贷款需求详情 | 中国贷款信息网";
						break;
					case "smartynews":
						title = "贷款资讯详情 | 中国贷款信息网";
						break;
					case "smartyfooterdetail":
						title = "关于我们详情 | 中国贷款信息网";
						break;*/
					default:
						title = ""+con+" | 中国贷款信息网";
				}
				//$("#common_title").text(title);
				document.title=title;
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
			url = "ajax.php?mode=DropPageurl";
			$.get(url,function(json,status){
				switch(type){
					case 0:
						GoLogin(0);
						break;
					case 1:
						window.location.href = "demand.infolist.php";
						break;
					case 2:
						window.location.href='supply.infolist.php';
						break;
				}
			})
		}
		function LocationHref(page,id,islimit,viewright){
				if(page == "index"){
					window.location.href= page+'.php';
					return;
				}
				if(id == undefined){
					window.location.href= page+'.new.php';
					return;
				}
				var idname = "";
				var url = "";
				var userid = 1;//1需方，2供方
				var isajax = false;
				switch(page){
					case "smartyproindex":
						idname="supplyinfoid";
						break;
					case "smartyproductsdetails":
						idname="supplyinfoid";
						url="ajax.php?mode=SupplyinfodetailView&supplyinfoid="+id;
						isajax = true;
						break;
					case "smartyconsultantdetails":
						idname="supplierid";
						url = "ajax.php?mode=SupplierdetailView&supplierid="+id;
						isajax = true;
						break;
					case "smartynews":
						idname="newsid";
						url = "ajax.php?mode=updatenewsclick&newsid="+id;
						isajax = true;
						break;
					case "smartyneed":
						idname="demandinfoid";
						url="ajax.php?mode=DemandinfodetailView&demandinfoid="+id;
						isajax = true;
						userid=2;
						break;
					case "smartyfooterdetail":
						idname="footerid";
						break;
				}
				if(islimit){
					Common_MobileView(viewright,userid,url,function(){
						window.location.href= page+'.new.php?'+idname+'='+id;
					},false,"",isajax)
				}else{
					window.location.href= page+'.new.php?'+idname+'='+id;
				}
			}
		function Common_MobileView(viewright,userid,url,callback,isconfirm,action,isajax){
			if(action=="" || action==undefined){
				action = "查看"; 
			}
			switch(userid){
				case 1:
					var strprompt = "只有需方可以"+action+"，请先登录!";
					break;
				case 2:
					var strprompt = "只有供方可以"+action+"，请先登录!";
					break;
				case "123":
					var strprompt = "请先登录!";
					break;
			}
			if(url==""){
				var strprompt = "请先登录!";
			}
			
			if(viewright==userid || isajax || (userid=="123"&&(viewright==1||viewright==2))){
				if(url==""){
					callback();
				}else{
					if(isconfirm){
						$.confirm({
							// icon: 'glyphicon glyphicon-heart',
							title: "提示",
							content: "该操作需要扣除"+{$lookneedscore}+"积分！",
							confirmButton: '确定',
							cancelButton: '取消',
							confirm: function(){
								$.get(url,function(json,status){
									switch(json){
										case "1":
											callback();
											break;
										case "-99":
											CommonJustTip("已经达到最大可见数量！","提示");
											break;
										case "-9":
											CommonJustTip("您的积分不足！","提示");
											break;
										default:
											CommonJustTip("服务器忙，请稍候再试。","提示");
									}
								});	
							}
						});
					}else{	
						$.get(url,function(json,status){
							switch(json){
								case "1":
									callback();
									break;
								case "-99":
									CommonJustTip("已经达到最大可见数量！","提示");
									break;
								default:
									CommonJustTip("服务器忙，请稍候再试。","提示");
							}
						});	
					}
				}
			}else{
				CommonJustTip(strprompt,"提示");
			}
		}
		
		function IsFollowSupply(id,viewright){
			if(viewright==0){
				return;
			}
			url= "ajax.php?mode=IsAttentionsupplier&supplierid="+id;
			$.get(url,function(json,status){
				if(json==-1 || json==2){
					$("#followSupply_img").attr("src","images/req_00.jpg");
					$("#followSupply_img").next().text("关注该顾问");
				}
				if(json==1){
					$("#followSupply_img").attr("src","images/req_11.jpg");
					$("#followSupply_img").next().text("取消关注");
				}
			});	
		}
		function IsFollowProducts(id,viewright){
			if(viewright==0){
				return;
			}
			url= "ajax.php?mode=IsAttentionsupplyinfo&supplyinfoid="+id;
			$.get(url,function(json,status){
				if(json==-1 || json==2){
					$("#followProducts_img").attr("src","images/req_00.jpg");
					$("#followProducts_img").next().text("关注该产品");
				}
				if(json==1){
					$("#followProducts_img").attr("src","images/req_11.jpg");
					$("#followProducts_img").next().text("取消关注");
				}
			});	
		}
		function FollowSupply(viewright,id,ele){
			if(viewright==0){
				CommonJustTip("请先登录!","提示");
				return;
			}
			url= "ajax.php?mode=IsAttentionsupplier&supplierid="+id;
			$.get(url,function(json,status){
				//json -1,没关注过；1，已关注；2，已取消关注
				//state 0,取消关注；1，关注
				var state = 0;
				if(json==-1 || json==2){
					state = 1;
				}
				Common_MobileView(viewright,1,"ajax.php?mode=Attentionsupplier&supplierid="+id+"&state="+state,function(){			
					if(state==0){
						$(ele).find("img").attr("src","images/req_00.jpg");
						$(ele).find("span").text("关注该顾问");
					}else{
						$(ele).find("img").attr("src","images/req_11.jpg");
						$(ele).find("span").text("取消关注");
					}
				},false,"关注")
			});	
		}
		function FollowProducts(viewright,id,ele){
			if(viewright==0){
				CommonJustTip("请先登录!","提示");
				return;
			}
			url= "ajax.php?mode=IsAttentionsupplyinfo&supplyinfoid="+id;
			$.get(url,function(json,status){
				//json -1,没关注过；1，已关注；2，已取消关注
				//state 0,取消关注；1，关注
				var state = 0;
				if(json==-1 || json==2){
					state = 1;
				}
				Common_MobileView(viewright,1,"ajax.php?mode=Attentionsupplyinfo&supplyinfoid="+id+"&state="+state,function(){			
					if(state==0){
						$(ele).find("img").attr("src","images/req_00.jpg");
						$(ele).find("span").text("关注该产品");
					}else{
						$(ele).find("img").attr("src","images/req_11.jpg");
						$(ele).find("span").text("取消关注");
					}
				},false,"关注")
			});	
		}
		function IsCollectSupplier(id,viewright){
			if(viewright==0){
				return;
			}
			url= "ajax.php?mode=IsCollectSupplier&supplierid="+id;
			$.get(url,function(json,status){
				if(json==1){
					$("#CollectSupplier_img").attr("src","images/scgw_11.jpg");
					$("#CollectSupplier_img").next().text("已收藏该顾问");
				}
			});
		}
		function CollectSupplier(viewright,id,ele){
			if(viewright==0){
				CommonJustTip("请先登录!","提示");
				return;
			}
			url= "ajax.php?mode=IsCollectSupplier&supplierid="+id;
			$.get(url,function(json,status){
				if(json==1){
					return;
				}else{
					Common_MobileView(viewright,"123","ajax.php?mode=CollectSupplier&supplierid="+id,function(){
						$(ele).find("img").attr("src","images/scgw_11.jpg");
						$(ele).find("span").text("已收藏该顾问");
					},false,"收藏")
				}
			});
		}
		</script>
	</head>

	<body>
		<!--这是头部的上面部分-->
		<div class="header">
			<div class="header-top">
				<div class='header-top-1'>
					<span id="current_city" class='span1-1 span1-5'>当前城市：{$subareaname}</span>
					<span class='span1-1 span1-5'></span>
					{if {$viewright} eq 0}
						<span class='span1-2 span1-5 hoverpointer header_login' onclick="GoLogin(0);">Hi,请登录</span>
							<span class='span1-5 hoverpointer header_login' style="color: #ff2e31;margin-left: 10px;" onclick="GoLogin(1);">注册</span>
					{else}
						<span class='span1-2 span1-5 hoverpointer'>Hi,{$showname}</span>
						<span class='span1-5 hoverpointer header_login' style="margin-left: 10px;" onclick="DropLogin();">退出登录</span>
					{/if}
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
						&nbsp;<span class='span2-1'>{$footerfixed.telephone}</span>
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
							{if {$viewright} eq 0}
								<a onclick="GoAdminpage(0);">我的账户</a>
							{else}
								<a onclick="GoAdminpage({$ismodify});">我的账户</a>
							{/if}
							
						</li>
					</ul>
				</div>
			</div>
		</div>