<?php	include "supply.header.php";	?>
<!--<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<title>供方后台管理</title>
		<link href="style/bootstrap.css" rel="stylesheet"/>
		<link href="js/craftpip/css/jquery-confirm.css" rel="stylesheet"/>
		<link rel="stylesheet" type="text/css" href="js/kkpager-master/src/kkpager_blue.css" />
		<link rel="stylesheet" type="text/css" href="style/bootstrap-select.css" />
		<link rel="stylesheet" type="text/css" href="style/bootstrap-fileinput.css">
		<link rel="stylesheet" href="js/DataTables-1.10.11/media/css/jquery.dataTables.min.css" type="text/css">
	</head>
	<body>-->
		<div id="Maincontainer" class="container" style="margin-top:20px;margin-bottom:150px;width:500px;">
			<div class="panel panel-default" style='width:500px'>
				<div class="panel-heading" style='margin-bottom:30px;'>
					<h3 class="panel-title">
						供方登录
						<a style="margin-left: 300px;color: #337ab7;" href="demand.login.php">切换到需方登录</a>
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
					  <div class="form-group " >
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
					  <div class="form-group " >
						<label for="newUsername" class="col-sm-3 control-label" style="line-height:14px;">用户名 :</label>
						<div class="col-sm-9">
						  <input type="text" class="form-control" id="newUsername" placeholder="请输入用户名">
						  <span class="submitprompt">*</span>
						</div>
					  </div>
					 <div id="registdiv">
						  <div class="form-group " >
							<label for="newname" class="col-sm-3 control-label" style="line-height:14px;">姓名 :</label>
							<div class="col-sm-9">
							  <input type="text" class="form-control" id="newname" placeholder="请输入您的姓名">
							   <span class="submitprompt">*</span>
							</div>
						  </div>
						   <div class="form-group" >
								<label for="images" class="col-sm-3 control-label"  style="line-height:14px;">头像 :</label>
								<div class="col-sm-9">
									<input id="images" name="images[]" type="file" multiple data-min-file-count="1">
									 <span class="submitprompt">*</span>
								</div>
							</div>
						 <div class="form-group " >
							<label for="newarea" class="col-sm-3 control-label" style="line-height:14px;">地区 :</label>							
							<div class="col-sm-9">
								<select id="newarea" class="selectpicker form-control" multiple data-live-search="false"></select>
								<span class="submitprompt">*</span>
							</div>
						  </div>
						  <div class="form-group " >
							<label for="newcompany" class="col-sm-3 control-label" style="line-height:14px;">所属公司 :</label>
							<div class="col-sm-9">
							  <input type="text" class="form-control" id="newcompany" placeholder="请输入您所属的公司">
							   <span class="submitprompt">*</span>
							</div>
						  </div>
						  <div class="form-group " >
							<label for="newsex" class="col-sm-3 control-label" style="line-height:14px;">性别 :</label>
							<div class="col-sm-9">
								<select class="form-control" id="newsex">
								<option value="1">男</option>
								<option value="2">女</option>
								</select>
							</div>
						  </div>
						  <div class="form-group " >
							<label for="newage" class="col-sm-3 control-label" style="line-height:14px;">年龄 :</label>
							<div class="col-sm-9">
							  <input type="number" class="form-control" id="newage" placeholder="请输入您的年龄">
							</div>
						  </div>
						   <div class="form-group " >
							<label for="newqqnum" class="col-sm-3 control-label" style="line-height:14px;">QQ :</label>
							<div class="col-sm-9">
							  <input type="text" class="form-control" id="newqqnum" placeholder="请输入您的QQ">
							</div>
						  </div>
						  <div class="form-group " >
							<label for="newwxnum" class="col-sm-3 control-label" style="line-height:14px;">微信 :</label>
							<div class="col-sm-9">
							  <input type="text" class="form-control" id="newwxnum" placeholder="请输入您的微信">
							</div>
						  </div>
						  <div class="form-group " >
							<label for="newemail" class="col-sm-3 control-label" style="line-height:14px;">邮箱 :</label>
							<div class="col-sm-9">
							  <input type="text" class="form-control" id="newemail" placeholder="请输入您的邮箱">
							</div>
						  </div>
						  <div class="form-group " >
							<label for="newgoodproduct" class="col-sm-3 control-label" style="line-height:14px;">擅长产品 :</label>
							<div class="col-sm-9">
							  <input type="text" class="form-control" id="newgoodproduct" placeholder="请输入您擅长的产品">
							</div>
						  </div>
						  <div class="form-group " >
							<label for="newpersonal" class="col-sm-3 control-label" style="line-height:14px;">个人特色 :</label>
							<div class="col-sm-9">
							  <input type="text" class="form-control" id="newpersonal" placeholder="请输入您的个人特色">
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
					  
					  <div class="form-group " >
						<label for="newPassword1" class="col-sm-3 control-label" style="line-height:14px;">登录密码 :</label>
						<div class="col-sm-9">
						  <input type="password" class="form-control" id="newPassword1" placeholder="请输入您要设置的密码">
						  <span class="submitprompt">*</span>
						</div>
					  </div>
					  <div class="form-group " >
						<label for="newPassword2" class="col-sm-3 control-label" style="line-height:14px;">重复密码 :</label>
						<div class="col-sm-9">
						  <input type="password" class="form-control" id="newPassword2" placeholder="请再次输入密码">
						  <span class="submitprompt">*</span>
						</div>
					  </div>
					  <div class="form-group  text-right">
						 <span id="PromptText">已注册？</span>
						 <a id="GoLoginPage" class="hoverpointer" style="margin-right:15px;text-decoration:underline;">马上登陆</a>
					  </div>
					  <div class="form-group ">
						<div class="col-sm-12">
						  <button id="RegisterBtn" type="button" class="btn btn-primary btn-block">注册</button>
						  <button id="RevisePwdBtn"  type="button" class="btn btn-primary btn-block hidden">确定</button>
						</div>
					  </div>
					</form>
				</div>
			</div>
		</div>
	</body>
	<?php	include "footer.php";?>
	<script type="text/javascript">
		var Settings = {};
		Settings.imgurl = "";
		pageurl="<?php echo $_SESSION["pageurl"] ?>";
		SubareaData =  new Array();
	
		window.onload = OnLoad;
		
		function OnLoad(){
			BindEvents();
			ShowAreaInfo();
		}
		function BindEvents(){
			$("#images").fileinput('destroy');
				r = $("#images").fileinput({
				language: 'zh',
				uploadAsync: true,
				uploadUrl: 'bootstrap-fileinput-upload.php',
				allowedFileExtensions : ['jpg', 'png','gif',"pdf"],
				uploadExtraData: function() {
					return {
						
					};
				},
				//initialPreview: data.files,
				initialPreviewAsData: true,
				overwriteInitial: false,
				showUpload: false,
				showDrag: false,
				//initialPreviewConfig: data.preview,
				maxFileSize:400
			}).on('fileselect', function(event, numFiles, label) {
				$('#images').fileinput('upload');
				
			}).on('fileuploaded', function(event, data, previewId, index) {//上传成功回调
				//alert(data.response.uploaded[0].file);
				// arrimg.push(data.response.uploaded[0].file);
				Settings.imgurl = data.response.uploaded[0].file;
			});
			
			$("#LoginForm").removeClass("hidden");
			
			$("#GoRegisterPage").click(function(){
				$("#LoginForm").addClass("hidden");
				$("#RegisterForm").removeClass("hidden");
				$("#PromptText").text("已注册？");
				$("#RevisePwdBtn").addClass("hidden");
				$("#RegisterBtn").removeClass("hidden");
				$("#registdiv").removeClass("hidden");
				$("#newMobile,#newUsername,#newPassword1,#newPassword2").val("");
				$("#newname,#newcompany,#newage,#newemail,#newqqnum,#newwxnum,#newgoodproduct,#newpersonal").val("");
				$('#newarea').selectpicker('val','');
				$("#newsex").val("1");
				$("#newtype").val("1");
			});
			$("#GoRevisePwdPage").click(function(){
				$("#LoginForm").addClass("hidden");
				$("#RegisterForm").removeClass("hidden");
				$("#PromptText").text("想起密码？");
				$("#RegisterBtn").addClass("hidden");
				$("#RevisePwdBtn").removeClass("hidden");
				$("#registdiv").addClass("hidden");
				$("#newMobile,#newUsername,#newPassword1,#newPassword2").val("");
			});
			$("#GoLoginPage").click(function(){
				$("#RegisterForm").addClass("hidden");
				$("#LoginForm").removeClass("hidden");
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
		}
		function ShowAreaInfo(){
			url = "supply.login.ajax.php?mode=subarealist";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				for(var i=0;i<json.length;i++){
					strarea = "<option value="+json[i].id+">"+json[i].name+"</option>";
					$("#newarea").append(strarea);
					$("#newarea").selectpicker('refresh'); 
					var d={};
					d.id = json[i].id;
					d.status = 0;
					SubareaData.push(d);
				}
			});
		}
		function GoLogin(){
			loginName = $("#staffMobile").val();
			loginPassword = md5($("#staffPassword").val());
			
			if($("#staffMobile").val() == ""){$("#staffMobile").focus();CommonWarning('账号不能为空！');return;}
			if($("#staffPassword").val() == ""){$("#staffPassword").focus();CommonWarning('密码不能为空！');return;}
			url = "supply.login.ajax.php?mode=Login&loginName=" + loginName + "&loginPassword=" + loginPassword;
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
			if(!/^(13[0-9]|14[0-9]|15[0-9]|18[0-9])\d{8}$/i.test(mobile)){$("#newMobile").focus();CommonWarning("请填写正确的手机号码！");return;} 
			if(confirmcode==""){$("#confirmcode").focus();CommonWarning('验证码不能为空！');return;}
			if(username==""){$("#newUsername").focus();CommonWarning('用户名不能为空！');return;}
			
			var data={};
			data.mobile = mobile;
			data.username = username;
			data.password = newPassword1;
			data.confirmcode = confirmcode;
			if(type == "regist"){
				data.name = $("#newname").val();
				data.image = Settings.imgurl;
				
				if(data.name==""){$("#newname").focus();CommonWarning('姓名不能为空！');return;}
				if(data.image==""){$("#images").focus();CommonWarning('头像不能为空！');return;}
				
				var area = $("#newarea").val();
				if(area==null){$("#newarea").focus();CommonWarning('地区不能为空！');return;}
				
				for(i=0;i<area.length;i++){
					for(a=0;a<SubareaData.length;a++){
						if(area[i] == SubareaData[a].id){
							SubareaData[a].status = 1;
						}
					}
				}
				data.subarea = SubareaData;	
				
				data.company = $("#newcompany").val();
				data.sex = $("#newsex").val();
				data.age = $("#newage").val();
				data.email = $("#newemail").val();
				data.qqnum = $("#newqqnum").val();
				data.wxnum = $("#newwxnum").val();
				data.goodproduct = $("#newgoodproduct").val();
				data.personalfeature = $("#newpersonal").val();
				data.type = $("#newtype").val();
// console.log(data);
				if(data.company==""){$("#newcompany").focus();CommonWarning('所属公司不能为空！');return;}
				// if(data.sex==""){$("#newsex").focus();CommonWarning('性别不能为空！');return;}
				// if(data.age==""){$("#newage").focus();CommonWarning('年龄不能为空！');return;}
				// if(data.qqnum==""){$("#newqqnum").focus();CommonWarning('QQ不能为空！');return;}
				// if(data.wxnum==""){$("#newwxnum").focus();CommonWarning('微信不能为空！');return;}
				// if(data.email==""){$("#newemail").focus();CommonWarning('邮箱不能为空！');return;}
				// if(data.goodproduct==""){$("#newgoodproduct").focus();CommonWarning('擅长产品不能为空！');return;}
				// if(data.personalfeature==""){$("#newpersonal").focus();CommonWarning('个人特色不能为空！');return;}
				if(data.type==""){$("#newtype").focus();CommonWarning('身份不能为空！');return;}
				// if(!/^([a-zA-Z0-9]|[._])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/.test(data.email)){$("#newemail").focus();CommonWarning('请填写正确的邮箱！');return;}
			}
			if($("#newPassword1").val()==""){$("#newPassword1").focus();CommonWarning('密码不能为空！');return;}
			if(newPassword1 != newPassword2){$("#newPassword2").focus();CommonWarning('请确保两次输入的密码一致！');return;}
			switch(type){
				case "regist":
					url = "supply.login.ajax.php?mode=Regist";
					$.post(url,{
						data : JSON.stringify(data)
					},function(json,status){
console.log(json);
						switch(json){
							case "1":
								CommonJustTip('注册成功！请登录');
								$("#RegisterForm").addClass("hidden");
								$("#LoginForm").removeClass("hidden");
								$("#newMobile").val("");
								$("#newPassword1").val("");
								$("#newPassword2").val("");
								break;
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
							case "99":
								CommonJustTip('验证码有误！');
								break;
							default:
								CommonJustTip('注册失败。');
								break;
						}
					});
					break;
				case "resetpwd":
					url = "supply.login.ajax.php?mode=Resetpwd&mobile=" + mobile + "&username=" + username + "&newpassword=" + newPassword1;
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
							case "99":
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
			if(!/^(13[0-9]|14[0-9]|15[0-9]|18[0-9])\d{8}$/i.test(newMobile)){
				CommonWarning("请填写正确的手机号码！");
				return; 
			}
			url = "demand.login.ajax.php?mode=SendConfirmCode&mobile=" + newMobile;
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