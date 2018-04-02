<?php include "demand.header.php";?>

		<div id="Maincontainer" class="container" style="margin-top:20px;margin-bottom: 20px;width:700px;">
			<div class="panel panel-default" style='width:700px'>
				<div class="panel-heading">
					<h3 class="panel-title">
						修改账号信息
					</h3>
				</div>
				<div class="panel-body" >
					<form class="form-horizontal">
						<div class="form-group">
							<label for="useraccount" class="col-sm-2 control-label">当前账号</label>
							<div class="col-sm-9" >
								<input type="text" class="form-control" id="useraccount" disabled value="">
							</div>
						</div>
						<div class="form-group">
							<label for="usermobile" class="col-sm-2 control-label">手机号</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="usermobile" disabled>
							</div>
						</div>
						<div class="form-group">
							<label for="username" class="col-sm-2 control-label">姓名</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="username">
							</div>
						</div>
						<!--<div class="form-group">
							<label for="userarea" class="col-sm-2 control-label">地区</label>
							<div class="col-sm-9">
								<select class="form-control" id="userarea">
									<option value="1">西安</option>
									<option value="2">北京</option>
									<option value="3">上海</option>
									<option value="4">天津</option>
								</select>
							</div>
						</div>-->
						<div class="form-group">
							<label for="usersex" class="col-sm-2 control-label">性别</label>
							<div class="col-sm-9">
								<select class="form-control" id="usersex">
									<option value="1">男</option>
									<option value="2">女</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="userage" class="col-sm-2 control-label">年龄</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="userage">
							</div>
						</div>
						<div class="form-group">
							<label for="userarea" class="col-sm-2 control-label">地区</label>
							<div class="col-sm-9">
								<select class="form-control" id="userarea"></select>
							</div>
						</div>
						<div class="form-group">
							<label for="userqq" class="col-sm-2 control-label">QQ号</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="userqq" placeholder="QQ号">
							</div>
						</div>
						<div class="form-group">
							<label for="useremail" class="col-sm-2 control-label">邮箱</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="useremail" placeholder="邮箱">
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
			ShowAreaInfo();
			BindEvents();
		}
		function BindEvents(){
			
		}
		function ShowAreaInfo(){
			url = "demand.changeinfo.ajax.php?mode=subarealist";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				for(var i=0;i<json.length;i++){
					strarea = "<option value="+json[i].id+">"+json[i].name+"</option>";
					$("#userarea").append(strarea);
				}
				showinfo();
			});
		}
		function showinfo(){
			url = "demand.changeinfo.ajax.php?mode=showinfo";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json); 
				$("#useraccount").val(json.username);
				$("#username").val(json.name);
				$("#usersex").val(json.sex);
				$("#userage").val(json.age);
				$("#usermobile").val(json.mobile);
				$("#userqq").val(json.qqnum);
				$("#useremail").val(json.email);
				$("#userarea").val(json.subareaid);
			})
		}
		function SaveInfo(){
			var data={};
			data.name = $("#username").val();
			data.mobile = $("#usermobile").val();
			data.sex = $("#usersex").val();
			data.age = $("#userage").val();
			data.qqnum = $("#userqq").val();
			data.email = $("#useremail").val();
			data.subareaid = $("#userarea").val();
			
			if(data.name == ""){$("#username").focus();CommonWarning('姓名不能为空！');return;}
			//if(data.sex == ""){$("#usersex").focus();CommonWarning('性别不能为空！');return;}
			//if(data.age == ""){$("#userage").focus();CommonWarning('年龄不能为空！');return;}
			//if(data.mobile == ""){$("#usermobile").focus();CommonWarning('手机号不能为空！');return;}
			//if(!/^(13[0-9]|14[0-9]|15[0-9]|18[0-9])\d{8}$/i.test(data.mobile)){$("#usermobile").focus();CommonWarning("请填写正确的手机号码！");return;} 
			//if(data.qqnum == ""){$("#userqq").focus();CommonWarning('QQ号不能为空！');return;}
			//if(data.email == ""){$("#useremail").focus();CommonWarning('邮箱不能为空！');return;}
			//if(!/^([a-zA-Z0-9]|[._])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/.test(data.email)){$("#useremail").focus();CommonWarning('请填写正确的邮箱！');return;}
			

			url = "demand.changeinfo.ajax.php?mode=updateinfo";
			$.post(url,{
				data : JSON.stringify(data)
			},function(json,status){
console.log(json);
				if(json == '1'){
					CommonJustTip('修改成功！');
					showinfo();
				}else
					CommonJustTip('修改失败！');
			})
		}
   </script> 
</html>