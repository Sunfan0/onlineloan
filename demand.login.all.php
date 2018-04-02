<?php	
	// include "demand.header.php";	
	include "paras.php";
	
	$currenturl = $_SERVER['PHP_SELF'];
	$isloginpage =count(explode('login',$currenturl));
	
	
	if(!isset($_SESSION["pageurl"])||$_SESSION["pageurl"]==""||$_SESSION["pageurl"]='supply.infolist.php'){
		$_SESSION["pageurl"] ='demand.infolist.php';
	}
	if($isloginpage<=1 && CheckRights1() < 0)
		Page("demand.login.php");
	if ($isloginpage>1){
		$_SESSION["demandername"]="";
	}
	$mode = Get("mode");
	switch($mode){
		case "ChangePassword":
			$oldPassword = Get("oldPassword");
			$newPassword = Get("newPassword");
			$userName = $_SESSION["demandername"];
			
			$userInfo = DBGetDataRowByField("demanderinfo","username",$userName);
			if($userInfo == null)
				die("-8");
			if($userInfo["password"] != $oldPassword)
				die("-9");
			
			if(DBUpdateField("demanderinfo" , $userInfo["id"] , "password" , $newPassword))
				die("1");
			else
				die("-1");
			break;
	}
	
	$strSql = "select * FROM `footerfixed` order by createtime desc ";//页脚固定显示
	$footerfixed = DBGetDataRow($strSql);
	$telephone=$footerfixed["telephone"];
	$copyright=$footerfixed["copyright"];
	
	$isregister = Get("isregister");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<title>在线贷款需方后台</title>
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
			#Maincontainer #RegisterForm .col-sm-9>*,
			#Maincontainer #RequiredInfo .col-sm-9>*,
			#Maincontainer #RequiredInfo .col-sm-10>*,
			#Maincontainer #RequiredInfo .col-sm-4>*{
				width: 90%;
				display: inline;
			}
			#Maincontainer #RequiredInfo .bootstrap-select>.dropdown-menu{
				position: inherit;
				min-width: 90% !important;
				width: 90% !important;
				/*position: absolute;
				left: initial !important;
				top: initial !important;*/
			}
			#Maincontainer #RequiredInfo .file-preview,
			#Maincontainer #RequiredInfo .file-caption-main,
			#Maincontainer #RequiredInfo .dropdown-toggle{
				width: 90% !important;
			}
			#kvFileinputModal,#RegisterForm,#RequiredInfo,{
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
				<div class='header-top-left'>
					<img src="images/01_13.jpg" alt="" onclick="LocationHref('index')" />
					<i class='i1' onclick="LocationHref('index')">
						<img src="images/tel.png" alt="" class='img-1'/>
						&nbsp;<span class='span2-1'><?=$telephone?></span>
					</i>
				</div>
				<div class='header-top-right'>
					<ul class="ul1">
						<li id="demand.login" class="hoverpointer navBtn">重新登陆</li>
						<li id="demand.changeinfo" class="hoverpointer navBtn">修改个人信息</li>
						<li id="demand.changepassword" class="hoverpointer navBtn">修改密码</li>
					</ul>
				</div>
			</div>
		</div>
		<div id="Maincontainer" class="container" style="margin-top:20px;margin-bottom:250px;">
			<div class="panel panel-default" style='width:500px'>
				<div class="panel-heading" style='margin-bottom:30px;'>
					<h3 class="panel-title">
						<span id="Logintitle">需方登录</span>
						<a style="margin-left: 280px;color: #337ab7;" href="supply.login.php">切换到供方登录</a>
					</h3>
				</div>
				<div class="panel-body hidden" id="LoginForm">
					<form class="form-horizontal">
					  <div class="form-group ">
						<label for="staffMobile" class="col-sm-2 control-label" style="line-height:14px;">用户名 :</label>
						<div class="col-sm-10">
						  <input type="text" class="form-control" id="staffMobile" placeholder="请输入用户名">
						</div>
					  </div>
					  <div class="form-group ">
						<label for="staffPassword" class="col-sm-2 control-label" style="line-height:14px;">密码 :</label>
						<div class="col-sm-10">
						  <input type="password" class="form-control" id="staffPassword" placeholder="请输入密码">
						</div>
					  </div>
					  <div class="form-group  text-right" style="text-decoration:underline;" >
						 <a id="GoRegisterPage" class="hoverpointer" style="margin-right: 310px;">注册新账号</a>
						 <a id="GoRevisePwdPage" class="hoverpointer" style="margin-right: 15px;">忘记密码</a>
					  </div>
					 <div class="form-group">
						<div class="col-sm-12" style="text-align: center;">
						  <button id="LoginBtn" type="button" class="btn btn-primary btn-block">登录</button>
						</div>
					  </div>
					 </form>
				</div>
				
				<div class="panel-body hidden" id="RegisterForm">
					<form class="form-horizontal">
					  <div class="form-group ">
						<label for="newMobile" class="col-sm-3 control-label" style="line-height:14px;">手机号 :</label>
						<div class="col-sm-9">
						  <input type="number" class="form-control" id="newMobile" placeholder="请输入您的手机号">
						  <span class="submitprompt">*</span>
						</div>
					  </div>
					  <div class="form-group ">
						<label for="confirmcode" class="col-sm-3 control-label" style="line-height:14px;">验证码 :</label>
						<div class="col-sm-5">
						  <input class="form-control" id="confirmcode" placeholder="请输入手机验证码">
						</div>
						<div class="col-sm-3" style="padding-left:0;">
						   <button id="GetCodeBtn" onclick="GetCode();return false;" class="btn btn-primary btn-sm">获取验证码
						    <span id="getcodetime" style="color: white;"></span>
						   </button>
						   <span class="submitprompt">*</span>
						</div>
					  </div>
					  <div class="form-group ">
						<label for="newUsername" class="col-sm-3 control-label" style="line-height:14px;">用户名 :</label>
						<div class="col-sm-9">
						  <input type="text" class="form-control" id="newUsername" placeholder="请输入用户名">
						   <span class="submitprompt">*</span>
						</div>
					  </div>
				  
						<div id="registdiv">
						 <div class="form-group ">
							<label for="newname" class="col-sm-3 control-label" style="line-height:14px;">姓名 :</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="newname" placeholder="请输入您的姓名">
							   <span class="submitprompt">*</span>
							</div>
						  </div>
						  <div class="form-group " >
							<label for="newtype" class="col-sm-3 control-label" style="line-height:14px;">身份 :</label>
							<div class="col-sm-9">
								<select class="form-control" id="newtype">
									<option value="1">中介</option>
									<option value="2">机构</option>
								</select>
								<span class="submitprompt">*</span>
							</div>
						  </div>
					  </div>
					  <div class="form-group">
						<label for="newPassword1" class="col-sm-3 control-label" style="line-height:14px;">登录密码 :</label>
						<div class="col-sm-9">
						  <input type="password" class="form-control" id="newPassword1" placeholder="请输入密码">
						  <span class="submitprompt">*</span>
						</div>
					  </div>
					  <div class="form-group ">
						<label for="newPassword2" class="col-sm-3 control-label" style="line-height:14px;">重复密码 :</label>
						<div class="col-sm-9">
						  <input type="password" class="form-control" id="newPassword2" placeholder="请再次输入密码">
						   <span class="submitprompt">*</span>
						</div>
					  </div>
					  <div class="form-group  text-right">
						 <span id="PromptText">已注册？</span>
						 <a class="GoLoginPage hoverpointer" style="margin-right:15px;text-decoration:underline;">马上登陆</a>
					  </div>
					  <div class="form-group ">
						<div class="col-sm-12">
						  <button id="RegisterBtn" class="btn btn-primary btn-block">注册</button>
						  <button id="RevisePwdBtn" class="btn btn-primary btn-block hidden">确定</button>
						</div>
					  </div>
					 </form>
				</div>
				
				<div class="panel-body hidden" id="PerfectForm">
					<form class="form-horizontal">
					  <div class="form-group ">
						<label for="newsex" class="col-sm-3 control-label" style="line-height:14px;">性别 :</label>
						<div class="col-sm-9">
							<select class="form-control" id="newsex">
							<option value="1">男</option>
							<option value="2">女</option>
							</select>
						</div>
					  </div>
					  <div class="form-group ">
						<label for="newage" class="col-sm-3 control-label" style="line-height:14px;">年龄 :</label>
						<div class="col-sm-9">
						  <input type="text" class="form-control" id="newage" placeholder="请输入您的年龄">
						</div>
					  </div>
					   <div class="form-group ">
						<label for="newqqnum" class="col-sm-3 control-label" style="line-height:14px;">QQ :</label>
						<div class="col-sm-9">
						  <input type="text" class="form-control" id="newqqnum" placeholder="请输入您的QQ">
						</div>
					  </div>
					  <div class="form-group ">
						<label for="newemail" class="col-sm-3 control-label" style="line-height:14px;">邮箱 :</label>
						<div class="col-sm-9">
						  <input type="text" class="form-control" id="newemail" placeholder="请输入您的邮箱">
						</div>
					  </div>
					  <div class="form-group  text-right">
						 <span id="PromptText">已注册？</span>
						 <a class="GoLoginPage hoverpointer" style="margin-right:15px;text-decoration:underline;">马上登陆</a>
					  </div>
					  <div class="form-group ">
						<div class="col-sm-12">
						  <button id="PerfectinfoBtn" type="button" class="btn btn-primary btn-block">确定</button>
						</div>
					  </div>
					 </form>
				</div>
				
			</div>
		</div>
	</body>
	<?php	include "footer.php";?>
	<script type="text/javascript">
		var isregister = "<?php echo $isregister; ?>";
		
		var Settings = {};
		Settings.Currenttype = 0;//1注册2忘记密码
		Settings.Currentid = "";
		pageurl="<?php echo $_SESSION["pageurl"] ?>";
		
		window.onload = OnLoad;
		
		function OnLoad(){
			BindEvents();
		}
		function BindEvents(){
			if(isregister=="1"){
				Settings.Currenttype = 1;
				$("#LoginForm").addClass("hidden");
				$("#RegisterForm").removeClass("hidden");
				$("#PromptText").text("已注册？");
				$("#RevisePwdBtn").addClass("hidden");
				$("#RegisterBtn").removeClass("hidden");
				$("#registdiv").removeClass("hidden");
				$("#newMobile,#newUsername,#newPassword1,#newPassword2").val("");
				$("#newname,#newage,#newemail,#newqqnum").val("");
				$("#newsex").val("1");
				$("#newtype").val("1");
				$("#confirmcode").val("");
				$("#Logintitle").text("需方注册");
			}else{
				$("#LoginForm").removeClass("hidden");
			}
			
			
			$("#GoRegisterPage").click(function(){
				Settings.Currenttype = 1;
				$("#LoginForm").addClass("hidden");
				$("#RegisterForm").removeClass("hidden");
				$("#PromptText").text("已注册？");
				$("#RevisePwdBtn").addClass("hidden");
				$("#RegisterBtn").removeClass("hidden");
				$("#registdiv").removeClass("hidden");
				$("#newMobile,#newUsername,#newPassword1,#newPassword2").val("");
				$("#newname,#newage,#newemail,#newqqnum").val("");
				$("#newsex").val("1");
				$("#newtype").val("1");
				$("#confirmcode").val("");
				$("#Logintitle").text("需方注册");
			});
			$("#GoRevisePwdPage").click(function(){
				Settings.Currenttype = 2;
				$("#LoginForm").addClass("hidden");
				$("#RegisterForm").removeClass("hidden");
				$("#PromptText").text("想起密码？");
				$("#RegisterBtn").addClass("hidden");
				$("#RevisePwdBtn").removeClass("hidden");
				$("#registdiv").addClass("hidden");
				$("#newMobile,#newUsername,#newPassword1,#newPassword2").val("");
				$("#Logintitle").text("找回密码");
			});
			$(".GoLoginPage").click(function(){
				Settings.Currenttype = 0;
				$("#PerfectForm").addClass("hidden");
				$("#RegisterForm").addClass("hidden");
				$("#LoginForm").removeClass("hidden");
				$("#Logintitle").text("需方登录");
			});
			$("#LoginBtn").click(function(){
				GoLogin();
			});
			$("#RegisterBtn").click(function(){
				GoRegister("regist");
				return false;
			});
			$("#RevisePwdBtn").click(function(){
				GoRegister("resetpwd");
				return false;
			});
			$("#PerfectinfoBtn").click(function(){
				GoPerfectinfo();
				return false;
			});
		}
		function GoPerfectinfo(){
			var data={};
			data.id = Settings.Currentid;
			data.sex = $("#newsex").val();
			data.age = $("#newage").val();
			data.qqnum = $("#newqqnum").val();
			data.email = $("#newemail").val();
			
			// if(data.sex==""){$("#newsex").focus();CommonWarning('性别不能为空！');return;}
			// if(data.age==""){$("#newage").focus();CommonWarning('年龄不能为空！');return;}
			// if(data.qqnum==""){$("#newqqnum").focus();CommonWarning('QQ不能为空！');return;}
			// if(data.email==""){$("#newemail").focus();CommonWarning('邮箱不能为空！');return;}
			// if(!/^([a-zA-Z0-9]|[._])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/.test(data.email)){$("#newemail").focus();CommonWarning('请填写正确的邮箱！');return;}

			url = "demand.login.ajax.php?mode=FinishOtherinfo";
			$.post(url,{
				data : JSON.stringify(data)
			},function(json,status){
				switch(json){
					case "1":
						$("#PerfectForm").addClass("hidden");
						$("#RegisterForm").addClass("hidden");
						$("#LoginForm").removeClass("hidden");
						$("#Logintitle").text("需方登录");
						break;
					default:
						CommonJustTip('系统错误，请重试!');
						break;
				}
			});
		}
		
		function GoLogin(){
			loginName = $("#staffMobile").val();
			loginPassword = md5($("#staffPassword").val());
			
			if($("#staffMobile").val() == ""){$("#staffMobile").focus();CommonWarning('账号不能为空！');return;}
			if($("#staffPassword").val() == ""){$("#staffPassword").focus();CommonWarning('密码不能为空！');return;}
			url = "demand.login.ajax.php?mode=Login&loginName=" + loginName + "&loginPassword=" + loginPassword;
			$.get(url,function(json,status){
console.log(json);
				switch(json){
					case "1":
						window.location.href = pageurl;
						break;
					case "-1":
						CommonJustTip('您输入的密码不正确！');
						break;
					case "-9":
						CommonJustTip("该账号不存在！");
						break;
					default:
						CommonJustTip("登陆失败。");
						break;
				}
			});
		}
		function GoRegister(type){
			mobile = $("#newMobile").val();
			username = $("#newUsername").val();
			newPassword1 = md5($("#newPassword1").val());
			newPassword2 = md5($("#newPassword2").val());
			confirmcode = $("#confirmcode").val();
			
			if(mobile==""){$("#newMobile").focus();CommonWarning('手机号不能为空！');return;}
			if(!/^1[34578]\d{9}$/.test(mobile)){$("#newMobile").focus();CommonWarning("请填写正确的手机号码！");return;} 
			if(confirmcode==""){$("#confirmcode").focus();CommonWarning('验证码不能为空！');return;}
			if(username==""){$("#newUsername").focus();CommonWarning('用户名不能为空！');return;}
			if($("#newPassword1").val()==""){$("#newPassword1").focus();CommonWarning('密码不能为空！');return;}
			if(newPassword1 != newPassword2){$("#newPassword2").focus();CommonWarning('请确保两次输入的密码一致！');return;}
			
			var data={};
			data.mobile = mobile;
			data.username = username;
			data.password = newPassword1;
			data.confirmcode = confirmcode;
			if(type == "regist"){
				data.type = $("#newtype").val();
				data.name = $("#newname").val();
				
// console.log(data);
				if(data.name==""){$("#newname").focus();CommonWarning('姓名不能为空！');return;}
				if(data.type==""){$("#newtype").focus();CommonWarning('身份不能为空！');return;}
			}
			switch(type){
				case "regist":
					url = "demand.login.ajax.php?mode=Regist";
					$.post(url,{
						data : JSON.stringify(data)
					},function(json,status){
// console.log(json);
						switch(json){
							/*case "1":
								CommonJustTip('注册成功！请登录');
								$("#RegisterForm").addClass("hidden");
								$("#LoginForm").removeClass("hidden");
								$("#newMobile").val("");
								$("#newPassword1").val("");
								$("#newPassword2").val("");
								break;*/
							case "-999":
								$("#newMobile").focus();
								CommonJustTip('该手机号已被注册！');
								break;
							case "-9":
								$("#newUsername").focus();
								CommonJustTip('该用户名已被注册！');
								break;
							case "-7":
								CommonJustTip('验证码已经过期！');
								break;
							case "-99":
								CommonJustTip('验证码有误！');
								break;
							default:
								//CommonJustTip('注册失败。');
								
								Settings.Currentid = json;
								$.confirm({
									title: "",
									content: "您已注册成功！",
									confirmButton: '前去完善信息',
									cancelButton: '马上登录',
									confirm: function(){
										$("#RegisterForm").addClass("hidden");
										$("#PerfectForm").removeClass("hidden");
										$("#Logintitle").text("完善信息");
									},
									cancel: function(){
										$("#RegisterForm").addClass("hidden");
										$("#LoginForm").removeClass("hidden");
										$("#Logintitle").text("需方登录");
									}
								});
								break;
						}
					});
					break;
				case "resetpwd":
					url = "demand.login.ajax.php?mode=Resetpwd&mobile=" + mobile + "&username=" + username + "&newpassword=" + newPassword1+"&confirmcode="+confirmcode;
					$.post(url,function(json,status){
console.log(json);
						switch(json){
							case "1":
								CommonJustTip('重置密码成功！请登录');
								$("#RegisterForm").addClass("hidden");
								$("#LoginForm").removeClass("hidden");
								$("#newMobile").val("");
								$("#newPassword1").val("");
								$("#newPassword2").val("");
								$("#newCode").val("");
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
					break;
			}
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
			url = "demand.login.ajax.php?mode=SendConfirmCode&mobile=" + newMobile + "&type=" + Settings.Currenttype;
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
   </script> 
</html>