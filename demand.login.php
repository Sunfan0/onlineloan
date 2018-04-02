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
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<title>需方注册</title>
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
			#verifyCanvas{
				width:100px;
				height:30px;
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
						<li onclick="LocationHref('index')" class="hoverpointer">返回首页</li>
					</ul>
				</div>
			</div>
		</div>
		<div id="Maincontainer" class="container" style="margin-top:30px;margin-bottom:250px;">
			<div class="panel panel-default" style='width:600px;margin: 0 35%;'>
				<div class="panel-heading" style='margin-bottom:30px;'>
					<h3 class="panel-title">
						<span id="Logintitle">需方注册</span>
						<a style="float:right;color: #337ab7;" href="supply.login.php">切换到供方注册</a>
					</h3>
				</div>				
				<div class="panel-body" id="RegisterForm">
					<form class="form-horizontal">
					  <div class="form-group ">
						<label for="newMobile" class="col-sm-3 control-label submitprompt" style="line-height:14px;">手机号<span>*</span></label>
						<div class="col-sm-8">
						  <input type="number" class="form-control" id="newMobile" placeholder="请输入您的手机号">
						</div>
					  </div>
					  <div class="form-group ">
						<label for="imgcode_input" class="col-sm-3 control-label submitprompt" style="line-height:14px;">图片验证码<span>*</span></label>
						<div class="col-sm-5">
						  <input class="form-control" id="imgcode_input" type="text" placeholder="请输入图片验证码">
						</div>
						<div class="col-sm-3" style="height: 34px;">
							<div id="imgcode_con" style="width:100px;height:30px;display: inline-block;"></div>
						</div>
					  </div>
					  <div class="form-group">
						<label for="confirmcode" class="col-sm-3 control-label submitprompt" style="line-height:14px;">验证码<span>*</span></label>
						<div class="col-sm-5">
						  <input class="form-control" id="confirmcode" placeholder="请输入手机验证码">
						</div>
						<div class="col-sm-3">
						   <button id="GetCodeBtn" onclick="GetCode();return false;" class="btn btn-primary btn-sm">获取验证码
						    <span id="getcodetime" style="color: white;"></span>
						   </button>
						</div>
					  </div>
					  <!--<div class="form-group ">
						<label for="newUsername" class="col-sm-3 control-label submitprompt" style="line-height:14px;">用户名<span>*</span></label>
						<div class="col-sm-8">
						  <input type="text" class="form-control" id="newUsername" placeholder="请输入用户名">
						</div>
					  </div>-->
				  
						<!--<div id="registdiv">-->
					 <div class="form-group ">
						<label for="newname" class="col-sm-3 control-label submitprompt" style="line-height:14px;">姓名<span>*</span></label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="newname" placeholder="请输入您的姓名">
						</div>
					  </div>
					  <div class="form-group">
						<label for="newPassword1" class="col-sm-3 control-label submitprompt" style="line-height:14px;">登录密码<span>*</span></label>
						<div class="col-sm-8">
						  <input type="password" class="form-control" id="newPassword1" placeholder="请输入密码">
						</div>
					  </div>
					  <div class="form-group ">
						<label for="newPassword2" class="col-sm-3 control-label submitprompt" style="line-height:14px;">重复密码<span>*</span></label>
						<div class="col-sm-8">
						  <input type="password" class="form-control" id="newPassword2" placeholder="请再次输入密码">
						</div>
					  </div>
					  <div class="form-group">
						  <div class="checkbox col-sm-8 col-sm-offset-3">
							<label>
							  <input id="agreement" type="checkbox" checked>我已阅读并同意
							  <a id="agreement_title" class="color:#337ab7;"></a>
							</label>
						  </div>
					   </div>
					  <div class="form-group  text-right">
						<!--<a class="GoLoginType hoverpointer" style="text-decoration:underline;float: left;margin-left: 15px;">注册新账号</a>-->
						 <span id="PromptText">已注册？</span>
						 <a class="GoLoginPage hoverpointer" style="margin-right:15px;text-decoration:underline;">马上登陆</a>
					  </div>
					  <div class="form-group ">
						<div class="col-sm-12">
						  <button id="RegisterBtn" class="btn btn-primary btn-block">注册</button>
						  <!--<button id="RevisePwdBtn" class="btn btn-primary btn-block hidden">确定</button>-->
						</div>
					  </div>
					 </form>
				</div>
				
				<div class="panel-body hidden" id="PerfectForm">
					<form class="form-horizontal">
					  <div class="form-group ">
						<label for="newsex" class="col-sm-3 control-label" style="line-height:14px;">性别</label>
						<div class="col-sm-8">
							<select class="form-control" id="newsex">
							<option value="1">男</option>
							<option value="2">女</option>
							</select>
						</div>
					  </div>
					  <div class="form-group ">
						<label for="newage" class="col-sm-3 control-label" style="line-height:14px;">年龄</label>
						<div class="col-sm-8">
						  <input type="text" class="form-control" id="newage" placeholder="请输入您的年龄">
						</div>
					  </div>
					  <div class="form-group ">
						<label for="newarea" class="col-sm-3 control-label" style="line-height:14px;">地区</label>
						<div class="col-sm-8">
							<select class="form-control" id="newarea"></select>
						</div>
					  </div>
					   <div class="form-group ">
						<label for="newqqnum" class="col-sm-3 control-label" style="line-height:14px;">QQ</label>
						<div class="col-sm-8">
						  <input type="text" class="form-control" id="newqqnum" placeholder="请输入您的QQ">
						</div>
					  </div>
					  <div class="form-group ">
						<label for="newemail" class="col-sm-3 control-label" style="line-height:14px;">邮箱</label>
						<div class="col-sm-8">
						  <input type="text" class="form-control" id="newemail" placeholder="请输入您的邮箱">
						</div>
					  </div>
					  <div class="form-group  text-right">
						<!--<a class="GoLoginType hoverpointer" style="text-decoration:underline;float: left;margin-left: 15px;">注册新账号</a>-->
						 <span id="PromptText">已注册？</span>
						 <a class="GoLoginPage hoverpointer" style="margin-right:15px;text-decoration:underline;">马上登陆</a>
					  </div>
					  <div class="form-group ">
						<div class="col-sm-12">
						  <button id="PerfectinfoBtn" type="button" class="btn btn-primary btn-block">提交</button>
						</div>
					  </div>
					 </form>
				</div>
			</div>
			<div id="agreement_div" style="z-index:900;position: absolute;top: 0px;left: 30%;" class="hidden">
				<div style="background:white;border-radius:15px;box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);height:650px;overflow: hidden;">
					<table width="100%" height="100%" align="center" valign="middle">
						<tr>
							<td id="agreement_close" style="font-size: 27px;line-height: 14px;cursor: pointer;text-align: right;padding:10px;">×</td>
						</tr>
						<tr>
						<td align="center" valign="middle" style="padding: 0 30px;text-align: left;">
							<div id="agreement_con" style="height:600px;overflow: scroll;overflow-x: hidden;">
								
							</div>
						</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</body>
	<?php	include "footer.php";?>
	<script type="text/javascript" src="js/gVerify.js"></script>
	<script type="text/javascript">		
		var Settings = {};
		Settings.Currentid = "";
		pageurl="<?php echo $_SESSION["pageurl"] ?>";
		var verifyCode = new GVerify("imgcode_con");
		
		window.onload = OnLoad;
		
		function OnLoad(){
			BindEvents();
			ShowAreaInfo();
			
			url = "demand.login.ajax.php?mode=ShowAgreement";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				$("#agreement_title").text("《 "+json.title+" 》");
				$("#agreement_con").html(json.contenttext);
			});
		}
		function BindEvents(){
			$("#GoRevisePwdPage").click(function(){
				window.location.href = "login.php?operate=2";
			});
			$(".GoLoginPage").click(function(){
				window.location.href = "login.php?operate=0";
			});
			$(".GoLoginType").click(function(){
				window.location.href = "login.php?operate=1";
			});
			$("#RegisterBtn").click(function(){
				GoRegister("regist");
				return false;
			});
			$("#PerfectinfoBtn").click(function(){
				GoPerfectinfo();
				return false;
			});
			$("#agreement_title").click(function(){
				$("#agreement_div").removeClass("hidden");
			});
			$("#agreement_close").click(function(){
				$("#agreement_div").addClass("hidden");
			});
		}
		function ShowAreaInfo(){
			url = "demand.login.ajax.php?mode=subarealist";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				for(var i=0;i<json.length;i++){
					strarea = "<option value="+json[i].id+">"+json[i].name+"</option>";
					$("#newarea").append(strarea);
				}
			});
		}
		function GoPerfectinfo(){
			var data={};
			data.id = Settings.Currentid;
			data.sex = $("#newsex").val();
			data.age = $("#newage").val();
			data.qqnum = $("#newqqnum").val();
			data.email = $("#newemail").val();
			data.subareaid = $("#newarea").val();
			
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
						/*$("#PerfectForm").addClass("hidden");
						$("#RegisterForm").addClass("hidden");
						$("#LoginForm").removeClass("hidden");
						$("#Logintitle").text("需方登录");*/
						//window.location.href = "login.php?operate=0";
						$.confirm({
							title: "",
							content: "提交成功！",
							confirmButton: '继续逛逛',
							cancelButton: '留在后台',
							confirm: function(){
								if(pageurl==""){
									window.location.href = "demand.infolist.php";
								}else{
									window.location.href = pageurl;
								}
							},
							cancel: function(){
								window.location.href = "demand.infolist.php";
							}
						});
						break;
					default:
						CommonJustTip('系统错误，请重试!');
						break;
				}
			});
		}
		function GoRegister(type){
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
			if(type == "regist"){
				// data.type = $("#newtype").val();
				data.type = 0;
				data.name = $("#newname").val();
				
// console.log(data);
				if(data.name==""){$("#newname").focus();CommonWarning('姓名不能为空！');return;}
				// if(data.type==""){$("#newtype").focus();CommonWarning('身份不能为空！');return;}
			}
			
			if(!$("#agreement").is(':checked')){
				CommonWarning('未同意条款不予注册！');
				return;
			}
			
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
								/*$("#RegisterForm").addClass("hidden");
								$("#LoginForm").removeClass("hidden");
								$("#Logintitle").text("需方登录");*/
								window.location.href = "login.php?operate=0";
							}
						});
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
			if(!verifyCode.validate($("#imgcode_input").val())){
				CommonWarning("图片验证码输入有误！");
				return; 
			}
			url = "demand.login.ajax.php?mode=SendConfirmCode&type=1&mobile=" + newMobile;
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