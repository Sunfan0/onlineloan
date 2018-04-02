<?php include "demand.header.php";?>

		<div id="Maincontainer" class="container" style="margin-top:20px;margin-bottom:150px;width:700px;">
			<div class="panel panel-default" style='width:700px'>
				<div class="panel-heading">
					<h3 class="panel-title">
						修改密码
					</h3>
				</div>
				<div class="panel-body">
					<form class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-2 control-label">当前账号</label>
							<div class="col-sm-10"><?=$_SESSION["demandername"]?></div>
						</div>
						<div class="form-group">
							<label for="currentPassword" class="col-sm-2 control-label" style='color:red'>原密码</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" id="currentPassword" placeholder="请输入原密码">
							</div>
						</div>
						<br>
						<div class="form-group">
							<label for="changePassword1" class="col-sm-2 control-label" style='color:green'>新密码</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" id="changePassword1" placeholder="请输入新密码">
							</div>
						</div>
						<div class="form-group">
							<label for="changePassword2" class="col-sm-2 control-label" style='color:green'>确认密码</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" id="changePassword2" placeholder="请再次输入新密码">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-5"></div>
							<div class="col-sm-7">
								<button onclick="SaveInfo()" type="button" class="btn btn-primary">确定</button>  
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
	<?php	include "footer.php";	?>
	<script type="text/javascript">
		var Settings = {};
	
		window.onload = OnLoad;
		
		function OnLoad(){
			BindEvents();
		}
		function BindEvents(){
			$('#ChangePrompt').modal({backdrop: 'static', keyboard: false});
		}

		function SaveInfo(){
			var currentPassword = $("#currentPassword").val();
			var changePassword1 = $("#changePassword1").val();
			var changePassword2 = $("#changePassword2").val();
			if(currentPassword == ""){$("#currentPassword").focus();CommonWarning('原始密码不能为空。');return;}
			if(changePassword1 == ""){$("#changePassword1").focus();CommonWarning('新密码不能为空。');return;}
			if(changePassword1 != changePassword2){$("#changePassword2").focus();CommonWarning('两次输入的新密码不一致。');return;}
			
			$.post("demand.header.php?mode=ChangePassword&oldPassword="+md5($("#currentPassword").val())+"&newPassword="+md5($("#changePassword1").val())
				,function(json){
console.log(json);
				switch(json){
					case "1":
						CommonJustTip('密码修改成功。');
						break;
					case "-9":
						CommonWarning('原密码错误。');
						break;
					case "-8":
						CommonWarning('登陆信息丢失，请重新登陆。');
						window.location.href = "login.php";
						break;
					default:
						CommonWarning('更新失败。');
						break;
				}
			})
		}
   </script> 
</html>