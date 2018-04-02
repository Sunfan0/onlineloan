<?php	
	include "paras.php";
	
	$currenturl = $_SERVER['PHP_SELF'];
	$isloginpage =count(explode('login',$currenturl));
	
	if(!isset($_SESSION["pageurl"])||$_SESSION["pageurl"]=='supply.infolist.php'||$_SESSION["pageurl"]=='demand.infolist.php'){
		$_SESSION["pageurl"] ='';
	}
	
	if(($isloginpage<=1 && CheckRights2() < 0)||($isloginpage<=1 && CheckRights1() < 0))
		Page("login.php");
		
	if ($isloginpage>1){
		$_SESSION["demandername"]="";
		$_SESSION["suppliername"]="";
		$_SESSION["showname"]="";
	}
	
	$strSql = "select * FROM `footerfixed` order by createtime desc ";//页脚固定显示
	$footerfixed = DBGetDataRow($strSql);
	$telephone=$footerfixed["telephone"];
	$copyright=$footerfixed["copyright"];
	
	$operate = Get("operate");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<title>在线贷款登录</title>
		<link href="style/bootstrap.css" rel="stylesheet"/>
		<link href="js/craftpip/css/jquery-confirm.css" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="js/kkpager-master/src/kkpager_blue.css" />
		<link rel="stylesheet" type="text/css" href="style/bootstrap-select.css" />
		<link rel="stylesheet" type="text/css" href="style/bootstrap-fileinput.css">
		<link rel="stylesheet" href="js/DataTables-1.10.11/media/css/jquery.dataTables.min.css" type="text/css">
		<link rel="stylesheet" type="text/css" href="style/kkpager-style.css" />
		<link rel="stylesheet" type="text/css" href="style/header-col.css"/>
		<link rel="stylesheet" type="text/css" href="style/footer-col.css"/>
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
						<li onclick="LocationHref('index')" class="hoverpointer">返回首页</li>
					</ul>
				</div>
			</div>
		</div>
		<div id="Maincontainer" class="container" style="margin-top:30px;margin-bottom:250px;">
			<div class="panel panel-default" style='width:500px;'>
				<div class="panel-heading" style='margin-bottom:30px;'>
					<h3 class="panel-title">
						<span id="Logintitle">登录</span>
					</h3>
				</div>
				<div class="panel-body hidden" id="LoginForm">
					<form class="form-horizontal">
					  <div class="form-group ">
						<label for="staffMobile" class="col-sm-2 control-label" style="line-height:14px;">账号 :</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" id="staffMobile" placeholder="请输入手机号">
						</div>
					  </div>
					  <div class="form-group ">
						<label for="staffPassword" class="col-sm-2 control-label" style="line-height:14px;">密码 :</label>
						<div class="col-sm-10">
						  <input type="password" class="form-control" id="staffPassword" placeholder="请输入密码">
						</div>
					  </div>
					  <div class="form-group  text-right">
						 <a class="GoRegisterPage hoverpointer" style="text-decoration:underline;float:left;margin-left: 15px;">注册新账号</a>						 
						 <span>忘记密码？</span>
						  <a class="GoRevisePwdPage hoverpointer" style="margin-right: 15px;text-decoration:underline;">找回密码</a>
					  </div>
					 <div class="form-group">
						<div class="col-sm-12" style="text-align: center;">
						  <button id="LoginBtn" type="button" class="btn btn-primary btn-block">登录</button>
						</div>
					  </div>
					 </form>
				</div>
				
				<div class="panel-body hidden" id="RegisterForm">
					<a href="demand.login.php">
						<span class="glyphicon glyphicon-menu-right" style="margin-right: 5px;font-size: 12px;"></span>需方注册
					</a></br>
					<a href="supply.login.php" style="display: block;margin: 10px 0 30px;">
						<span class="glyphicon glyphicon-menu-right" style="margin-right: 5px;font-size: 12px;"></span>供方注册
					</a>
					<div class="form-group  text-right">
						<span>已有账号？</span>
						<a class="GoLoginPage hoverpointer" style="margin-right:15px;text-decoration:underline;">马上登陆</a>
					</div>
				</div>
				
				<div class="panel-body hidden" id="RevisePwdForm">
					<form class="form-horizontal">
					  <div class="form-group ">
						<label for="newMobile" class="col-sm-3 control-label" style="line-height:14px;">手机号 :</label>
						<div class="col-sm-9">
						  <input type="number" class="form-control" id="newMobile" placeholder="请输入您的手机号">
						</div>
					  </div>
					  <div class="form-group ">
						<label for="confirmcode" class="col-sm-3 control-label" style="line-height:14px;">验证码 :</label>
						<div class="col-sm-6">
						  <input class="form-control" id="confirmcode" placeholder="请输入手机验证码">
						</div>
						<div class="col-sm-3" style="padding-left:0;">
						   <button id="GetCodeBtn" onclick="GetCode();return false;" class="btn btn-primary btn-sm">获取验证码
						    <span id="getcodetime" style="color: white;"></span>
						   </button>						
						   </div>
					  </div>
					  <!--<div class="form-group">
						<label for="newUsername" class="col-sm-3 control-label" style="line-height:14px;">用户名 :</label>
						<div class="col-sm-9">
						  <input type="text" class="form-control" id="newUsername" placeholder="请输入用户名">
						</div>
					  </div>-->
					  <div class="form-group">
						<label for="newPassword1" class="col-sm-3 control-label" style="line-height:14px;">登录密码 :</label>
						<div class="col-sm-9">
						  <input type="password" class="form-control" id="newPassword1" placeholder="请输入密码">
						</div>
					  </div>
					  <div class="form-group ">
						<label for="newPassword2" class="col-sm-3 control-label" style="line-height:14px;">重复密码 :</label>
						<div class="col-sm-9">
						  <input type="password" class="form-control" id="newPassword2" placeholder="请再次输入密码">
						</div>
					  </div>
					  <div class="form-group  text-right">
						<a class="GoRegisterPage hoverpointer" style="text-decoration:underline;float:left;margin-left: 15px;">注册新账号</a>
						 <span>想起密码？</span>
						 <a class="GoLoginPage hoverpointer" style="margin-right:15px;text-decoration:underline;">马上登陆</a>
					  </div>
					  <div class="form-group ">
						<div class="col-sm-12">
						  <button id="RevisePwdBtn" class="btn btn-primary btn-block">确定</button>
						</div>
					  </div>
					 </form>
				</div>
			</div>
		</div>
	</body>
	<?php	include "footer.php";?>
	<script type="text/javascript">
		var operate = "<?php echo $operate; ?>";//0登录1身份选择2忘记密码
		
		var Settings = {};
		Settings.title0 = "在线贷款登录";
		Settings.title1 = "在线贷款注册";
		Settings.title2 = "找回密码";
		Settings.logintitle0 = "登录";
		Settings.logintitle1 = "注册身份选择";
		Settings.logintitle2 = "找回密码";
		pageurl="<?php echo $_SESSION["pageurl"] ?>";
		
		window.onload = OnLoad;
		
		function OnLoad(){
			BindEvents();
		}
		function BindEvents(){
			switch(operate){
				case "1":
					//$("#Bodytitle").text(Settings.bodytitle1);
					document.title=Settings.title1;
					$("#Logintitle").text(Settings.logintitle1);
					$("#RegisterForm").removeClass("hidden");
					break;
				case "2":
					//$("#Bodytitle").text(Settings.bodytitle2);
					document.title=Settings.title2;
					$("#Logintitle").text(Settings.logintitle2);
					$("#RevisePwdForm").removeClass("hidden");
					break;
				default:
					//$("#Bodytitle").text(Settings.bodytitle0);
					document.title=Settings.title0;
					$("#Logintitle").text(Settings.logintitle0);
					$("#LoginForm").removeClass("hidden");
			}
			
			$(".GoLoginPage").click(function(){
				window.location.href = "login.php?operate=0";
			});
			$(".GoRegisterPage").click(function(){
				window.location.href = "login.php?operate=1";
			});
			$(".GoRevisePwdPage").click(function(){
				window.location.href = "login.php?operate=2";
			});
			$("#LoginBtn").click(function(){
				GoLogin();
			});
			$("#RevisePwdBtn").click(function(){
				GoRevisePwd();
				return false;
			});
		}
		
		function GoLogin(){
			loginName = $("#staffMobile").val();
			loginPassword = md5($("#staffPassword").val());
			
			if($("#staffMobile").val() == ""){$("#staffMobile").focus();CommonWarning('账号不能为空！');return;}
			if($("#staffPassword").val() == ""){$("#staffPassword").focus();CommonWarning('密码不能为空！');return;}
			url = "login.ajax.php?mode=IndexLogin&loginName=" + loginName + "&loginPassword=" + loginPassword;
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				var type = json.type;
				var subareaid = json.subareaid;
				switch(type){
					case 1:
						if(pageurl==""){
							window.location.href = "demand.infolist.php";
						}else{
							if(pageurl.indexOf("?subareaid") > 0){
								str_before = pageurl.split('?subareaid')[0]; 
								window.location.href = str_before+'?subareaid='+subareaid;
							}else if(pageurl.indexOf("&subareaid") > 0){
								str_before = pageurl.split('&subareaid')[0]; 
								window.location.href = str_before+'&subareaid='+subareaid;
							}else if(pageurl.indexOf("?") > 0){
								window.location.href = pageurl+'&subareaid='+subareaid;
							}else{
								window.location.href = pageurl+'?subareaid='+subareaid;
							}
						}
						break;
					case 2:
						if(pageurl==""){
							window.location.href = "supply.infolist.php";
						}else{
							if(pageurl.indexOf("?subareaid") > 0){
								str_before = pageurl.split('?subareaid')[0]; 
								window.location.href = str_before+'?subareaid='+subareaid;
							}else if(pageurl.indexOf("&subareaid") > 0){
								str_before = pageurl.split('&subareaid')[0]; 
								window.location.href = str_before+'&subareaid='+subareaid;
							}else if(pageurl.indexOf("?") > 0){
								window.location.href = pageurl+'&subareaid='+subareaid;
							}else{
								window.location.href = pageurl+'?subareaid='+subareaid;
							}
						}
						break;
					case "-1":
						CommonJustTip('您输入的密码不正确！');
						break;
					case "-9":
						CommonJustTip("该账号不存在！");
						break;
					case "-99":
						CommonJustTip("您被拉入黑名单，请联系管理员！");
						break;
					case "-999":
						CommonJustTip("您的账号未审核通过，请联系管理员！");
						break;
					default:
						CommonJustTip("登陆失败。");
						break;
				}
			});
		}
		function GoRevisePwd(){
			mobile = $("#newMobile").val();
			// username = $("#newUsername").val();
			newPassword1 = md5($("#newPassword1").val());
			newPassword2 = md5($("#newPassword2").val());
			confirmcode = $("#confirmcode").val();
			
			if(mobile==""){$("#newMobile").focus();CommonWarning('手机号不能为空！');return;}
			if(!/^1[34578]\d{9}$/.test(mobile)){$("#newMobile").focus();CommonWarning("请填写正确的手机号码！");return;} 
			if(confirmcode==""){$("#confirmcode").focus();CommonWarning('验证码不能为空！');return;}
			// if(username==""){$("#newUsername").focus();CommonWarning('用户名不能为空！');return;}
			if($("#newPassword1").val()==""){$("#newPassword1").focus();CommonWarning('密码不能为空！');return;}
			if(newPassword1 != newPassword2){$("#newPassword2").focus();CommonWarning('请确保两次输入的密码一致！');return;}
			
			var data={};
			data.mobile = mobile;
			// data.username = username;
			data.password = newPassword1;
			data.confirmcode = confirmcode;
			
// console.log(data);

			url = "login.ajax.php?mode=Resetpwd&mobile=" + mobile + "&username=" + username + "&newpassword=" + newPassword1+"&confirmcode="+confirmcode;
			$.post(url,function(json,status){
console.log(json);
				switch(json){
					case "1":
						$.confirm({
							title: "",
							content: "重置密码成功！前去登录",
							confirmButton: '登录',
							cancelButton: '取消',
							autoClose: 'confirm|10000',
							confirm: function(){
								window.location.href = "login.php?operate=0";
							},
							cancel: function(){
							}
						});
						//CommonJustTip('重置密码成功！请登录');
						break;
					case "-9":
						CommonJustTip('请核对账号和所留手机号！');
						break;
					case "-7":
						CommonJustTip('验证码已经过期！');
						break;
					case "-99":
						CommonJustTip('验证码有误！');
						break;
					default:
						CommonJustTip('注册失败。');
						break;
				}
			}); 
		}
		function GetCode(){
			var newMobile = $("#newMobile").val();
			if(newMobile == ""){
				CommonWarning('手机号不能为空！');
				return;
			}
			if(!/^1[34578]\d{9}$/.test(newMobile)){
				CommonWarning("请填写正确的手机号码！");
				return; 
			}
			url = "login.ajax.php?mode=SendConfirmCode&mobile=" + newMobile + "&type=" + Settings.Currenttype;
			$.get(url,function(json,status){
console.log(json);
				switch(json){
					case "1":
						CommonJustTip('验证码已经发送至您的手机，请注意查收！');
						$("#getcodetime").text("(60s)");
						Codetimer();
						break;
					case "-99":
						CommonJustTip("该账号已被注册！");
						break;
					case "-6":
						CommonJustTip('在60s之内不能频繁操作！');
						break;					
					default:
						CommonJustTip('系统错误，请重试!');
						break;
				}
			});
		}
		function Codetimer(){
			clearInterval(Settings.timer);
			Settings.currenttime = 60;
			Settings.timer = setInterval(function(){
				Settings.currenttime--;
				$("#getcodetime").text("("+Settings.currenttime+"s)");
				if(Settings.currenttime==0){
					clearInterval(Settings.timer);
					$("#getcodetime").text("");
				}
			},1000)
		}
   </script> 
</html>