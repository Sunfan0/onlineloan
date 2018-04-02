<?php include "supply.header.php";?>

		<div  id="Maincontainer" class="container" style="margin-top:20px;margin-bottom:20px;width:700px;">
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
								<input type="text" class="form-control" id="username" placeholder="姓名" disabled>
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
						<div class="form-group" >
							<label for="userarea" class="col-sm-2 control-label submitprompt">地区<span>*</span></label>
							<div class="col-sm-9">
								<!--<select id="userarea"  class="selectpicker show-tick form-control" multiple data-live-search="false"></select>-->
								<select class="form-control" id="userarea"></select>
							</div>
						</div>
						<div class="form-group">
							<label for="usercompany" class="col-sm-2 control-label submitprompt">所属公司<span>*</span></label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="usercompany" placeholder="所属公司">
							</div>
						</div>
						<div class="form-group">
							<label for="images" class="col-sm-2 control-label submitprompt">头像<span>*</span></label>
							<div class="col-sm-9">
								<input id="images" name="images[]" type="file" multiple data-min-file-count="1">
							</div>
						</div>
						<!--<div class="form-group">
							<label for="usersum" class="col-sm-2 control-label">推荐指数</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="usersum" disabled  value="12">
							</div>
						</div>-->
						<div class="form-group">
							<label for="userexpert" class="col-sm-2 control-label">擅长产品</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="userexpert" placeholder="擅长产品">
							</div>
						</div>
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
								<input type="number" class="form-control" id="userage" placeholder="请输入您的年龄">
							</div>
						</div>
						<div class="form-group">
							<label for="userqq" class="col-sm-2 control-label">QQ号</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="userqq" placeholder="QQ号">
							</div>
						</div>
						<div class="form-group">
							<label for="userwx" class="col-sm-2 control-label">微信号</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="userwx" placeholder="微信号">
							</div>
						</div>
						<div class="form-group">
							<label for="useremail" class="col-sm-2 control-label">邮箱</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="useremail" placeholder="邮箱">
							</div>
						</div>						
						<div class="form-group">
							<label for="userspecial" class="col-sm-2 control-label">个人特色</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="userspecial" placeholder="个人特色">
							</div>
						</div>
						<!--<div class="form-group">
							<label for="usertype" class="col-sm-2 control-label">身份</label>
							<div class="col-sm-9">
								<select class="form-control" id="usertype">
									<option value="1">中介</option>
									<option value="2">机构</option>
								</select>
							</div>
						</div>-->
						<div class="form-group">
							<label for="userintegral" class="col-sm-2 control-label">积分</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="userintegral" placeholder="积分" disabled value="">
							</div>
						</div>
						<div class="form-group">
							<label for="userrealname" class="col-sm-2 control-label">实名认证</label>
							<div class="col-sm-9">
								<!--<input type="text" class="form-control" id="userrealname" readonly="readonly" value="否">-->
								<select class="form-control" id="userrealname" disabled>
									<option value="1">已认证</option>
									<option value="0">未认证</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-5"></div>
							<div class="col-sm-7">
								<button onclick="SaveInfo()" type="button" class="btn btn-primary">确定</button> 
								<a onclick="RefreshInfo();" class="btn btn-warning" style="margin-right:15px;">刷新</a>
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
		Settings.imgurl = "";
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
		}
		function ShowAreaInfo(){
			url = "supply.changeinfo.ajax.php?mode=subarealist";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				for(var i=0;i<json.length;i++){
					strarea = "<option value="+json[i].id+">"+json[i].name+"</option>";
					$("#userarea").append(strarea);
					// $('#userarea').selectpicker('refresh');
					var d={};
					d.id = json[i].id;
					d.status = 0;
					SubareaData.push(d);
				}
				Showinfo();
			});
		}
		function Showinfo(){
			url = "supply.changeinfo.ajax.php?mode=showinfo";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json); 
				$("#useraccount").val(json.username);
				$("#username").val(json.name);
				$("#usercompany").val(json.company);
				$("#usersex").val(json.sex);
				$("#userage").val(json.age);
				$("#userexpert").val(json.goodproduct);
				$("#usermobile").val(json.mobile);
				$("#userqq").val(json.qqnum);
				$("#userwx").val(json.wxnum);
				$("#useremail").val(json.email);
				$("#userspecial").val(json.personalfeature);
				// $("#usertype").val(json.type);
				$("#userintegral").val(json.score);
				$("#userrealname").val(json.isallowed);
				$('#images').fileinput('refresh', {initialPreview: [json.imgurl]});
				Settings.imgurl = json.imgurl;
				
				/*
				var subarea = json.subarea;
				if(subarea == null){
					$('#userarea').selectpicker('val','');
				}else{
					var Selectedata = new Array();
					for(i=0;i<subarea.length;i++){
						if($.inArray(subarea[i].id, Selectedata) == -1){
							Selectedata.push(subarea[i].id);
						}
					}
console.log(Selectedata);
					$('#userarea').selectpicker('val',Selectedata);
					$('#userarea').selectpicker('refresh');
				}
				*/
				
				if(json.subarea == null)
					return;
				$("#userarea").val(json.subarea[0].id);
				
			})
		}
		function SaveInfo(){
			var data={};
			data.mobile = $("#usermobile").val();
			data.image = Settings.imgurl;
			data.company = $("#usercompany").val();
			data.sex = $("#usersex").val();
			data.age = $("#userage").val();
			data.qqnum = $("#userqq").val();
			data.wxnum = $("#userwx").val();
			data.email = $("#useremail").val();
			data.goodproduct = $("#userexpert").val();
			data.personalfeature = $("#userspecial").val();
			// data.type = $("#usertype option:selected").val();
			/*
			var area = $("#userarea").val();
			if(area != null){
				for(i=0;i<area.length;i++){
					for(a=0;a<SubareaData.length;a++){
						if(area[i] == SubareaData[a].id){
							SubareaData[a].status = 1;
						}
					}
				}
			}
			data.subarea = SubareaData;	*/
			
			var area = $("#userarea").val();
			if(area == null){
				$("#userarea").focus();CommonWarning('地区不能为空！');return;
			}else{
				for(d=0;d<SubareaData.length;d++){
					if(area == SubareaData[d].id){
						SubareaData[d].status = 1;
					}
				}
			}
			data.subarea = SubareaData;
				
console.log(data);
			
			if(data.mobile == ""){$("#usermobile").focus();CommonWarning('手机号不能为空！');return;}
			if(data.image == ""){$("#images").focus();CommonWarning('头像不能为空！');return;}
			if(data.company == ""){$("#usercompany").focus();CommonWarning('所属公司不能为空！');return;}
			// if(data.sex == ""){$("#usersex").focus();CommonWarning('性别不能为空！');return;}
			// if(data.age == ""){$("#userage").focus();CommonWarning('年龄不能为空！');return;}
			// if(data.qqnum == ""){$("#userqq").focus();CommonWarning('QQ号不能为空！');return;}
			// if(data.wxnum == ""){$("#userwx").focus();CommonWarning('微信号不能为空！');return;}
			// if(data.email == ""){$("#useremail").focus();CommonWarning('邮箱不能为空！');return;}
			// if(data.goodproduct == ""){$("#userexpert").focus();CommonWarning('擅长产品不能为空！');return;}
			// if(data.personalfeature == ""){$("#userspecial").focus();CommonWarning('个人特色不能为空！');return;}			
			// if(!/^([a-zA-Z0-9]|[._])+@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-])+/.test(data.email)){$("#useremail").focus();CommonWarning("请填写正确的邮箱！");return; } 
			
			url = "supply.changeinfo.ajax.php?mode=updateinfo";
			$.post(url,{
				data : JSON.stringify(data)
			},function(json,status){
console.log(json);
				if(json == '1'){
					CommonJustTip('修改成功！');
					Showinfo();
				}else
					CommonJustTip('修改失败！');
			})
		}
		function RefreshInfo(){
			$.confirm({
				title: '提示',
				content: '您确定刷新个人信息？',
				confirmButton: '确定',
				cancelButton: '取消',
				confirm: function(){
					url = "supply.changeinfo.ajax.php?mode=Refreshinfo";
					$.post(url,function(json,status){
console.log(json);
						switch (json){
							case "1":
								CommonJustTip('个人信息刷新成功。');
								//window.location.href = "supply.infolist.php";
								break;
							default:
								CommonWarning('服务器忙，请稍候再试。');
						}
					});
				},
				cancel: function(){
					return;
				}
			});
		}
   </script> 
</html>