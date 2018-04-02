<?php
  include "supply.header.php";
	$checkuser = DBGetDataRowByField("supplierinfo" , array("username"),array($_SESSION["suppliername"]));
	$suppliertype=$checkuser["type"];
?>
		<div id="Maincontainer" class="container" style="margin-top:30px;margin-bottom:30px;">
			<div class="panel panel-default " style='width:100%;margin: 0;'>
				<div class="panel-heading">
					<h3 class="panel-title">
						实名认证信息
					</h3>
				</div>
				<div class="panel-body " >
					<form class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-2 control-label">当前账号</label>
							<div class="col-sm-9" ><?php echo $_SESSION["suppliername"]?></div>
						</div>
						
						<div class="form-group">
							<label for="imagesjob" class="col-sm-2 control-label">工作证</label>
							<div class="col-sm-9" style="text-align: left;">
								<input id="imagesjob" name="images[]" type="file" multiple data-min-file-count="1">
							</div>					
						</div>
						<div class="form-group">
							<label for="imagesid" class="col-sm-2 control-label">身份证复印件</label>
							<div class="col-sm-9" style="text-align: left;">
								<input id="imagesid" name="images[]" type="file" multiple data-min-file-count="1">
							</div>					
						</div>
	<?php  if($suppliertype==2)  {?>	
						<div class="form-group">
							<label for="imagesbussiness" class="col-sm-2 control-label">公司营业执照</label>
							<div class="col-sm-9" style="text-align: left;">
								<input id="imagesbussiness" name="images[]" type="file" multiple data-min-file-count="1">
							</div>					
						</div>
	<?php } ?>
	
						<!--机构
						<div class="form-group">
							<label for="images" class="col-sm-2 control-label">身份证复印件</label>
							<div class="col-sm-9" style="text-align: left;">
								<input id="images2" name="images[]" type="file" multiple data-min-file-count="1">
							</div>					
						</div>
						<div class="form-group">
							<label for="images" class="col-sm-2 control-label">工作证</label>
							<div class="col-sm-9" style="text-align: left;">
								<input id="images3" name="images[]" type="file" multiple data-min-file-count="1">
							</div>					
						</div>
						-->
						<!--<div class="form-group">
							<label for="username" class="col-sm-2 control-label">姓名</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="username" placeholder="姓名">
							</div>
						</div>
						
						<div class="form-group">
							<label for="usernumber" class="col-sm-2 control-label" >身份证号</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="usernumber" placeholder="请输入身份证号">
							</div>
						</div>-->
						<div class="form-group">
							<label for="other" class="col-sm-2 control-label" >其他信息</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="other" placeholder="请输入其他信息">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-5"></div>
							<div class="col-sm-7">
								<button id="ApplyBtn"  class="btn btn-primary">提交</button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div id="divMessage" class="hidden" style="position: absolute;top: 0px;left: 0px;width: 100%;height: 100%;background: rgba(229, 231, 229, 0.2);">
				<div style="z-index:9999;position: absolute;top:20%;left: 30%;">
					<div id="messageContainer" class="" style="background:white;border-radius:15px;height:200px;width: 450px;box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);">
						<table width="100%" height="100%" align="center" valign="middle">
							<tr>
								<td id="messageText" align="center" valign="middle" style="color:black;"></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</body>
	<?php	include "footer.php";	?>
	<script type="text/javascript">
		var Settings = {};
		
		var suppliertype = "<?php echo $suppliertype; ?>";
		//var hasReg=-1;
		Settings.jobimg="";
		Settings.idimg="";
		Settings.bussinessimg="";
		
		
		window.onload = OnLoad;
		
		function OnLoad(){
			BindEvents();
			url = "supply.identify.ajax.php?mode=applystate";
			$.get(url,function(json,status){
				switch(json){
					case "1":
						//MessageFix("您的实名认证已经通过。");
						//显示上传图片
						showimg();
						//$("#imagesjob").attr('disabled','disabled');
						//$("#imagesid").attr('disabled','disabled');
						//$("#imagesbussiness").attr('disabled','disabled');
						//$("#other").attr('readonly','readonly');
						//$("#ApplyBtn").attr('disabled','disabled');
						break;
					case "-1":
						//显示上传图片
						Message("您的实名认证已被驳回，您可以修改信息后重新提交。");
						showimg();
						
						break;
					case "-9":
						//MessageFix("您已经提交过认证信息，请等待审核结果。");
						showimg();
						/* $("#imagesjob").attr('disabled','disabled');
						$("#imagesid").attr('disabled','disabled');
						$("#imagesbussiness").attr('disabled','disabled');
						$("#other").attr('readonly','readonly');
						$("#ApplyBtn").attr('disabled','disabled'); */
						break;
				}
			});
			
		}
		function showimg(){
			url = "supply.identify.ajax.php?mode=ShowDetail";
			$.get(url,function(json,status){
				json = eval("("+json+")");
				if(json == null){
					CommonJustTip('暂无数据。');
					return;
				}
				Settings.jobimg = json.employeecard;
				Settings.idimg = json.copyofidcard;
				Settings.bussinessimg = json.businesslicence;
				$('#imagesjob').fileinput('refresh', {initialPreview:[json.employeecard]});
				$('#imagesid').fileinput('refresh', {initialPreview:[json.copyofidcard]});
				$('#imagesbussiness').fileinput('refresh', {initialPreview:[json.businesslicence]});
				$("#other").val(json.otherinfo);
			});

		}
		function MessageFix(t){
			$("#messageText").html(t);
			$("#divMessage").removeClass("hidden");
			$("#divMessage").unbind("click");
		}

		function Message(t){
			$("#messageText").html(t);
			$("#divMessage").removeClass("hidden");
		}
		
		function BindEvents(){
			$("#imagesjob").fileinput('destroy');
			r = $("#imagesjob").fileinput({
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
				$('#imagesjob').fileinput('upload');
				
			}).on('fileuploaded', function(event, data, previewId, index) {//上传成功回调
				//alert(data.response.uploaded[0].file);
				Settings.jobimg=data.response.uploaded[0].file;
			});
			$("#imagesid").fileinput('destroy');
			r = $("#imagesid").fileinput({
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
				$('#imagesid').fileinput('upload');
				
			}).on('fileuploaded', function(event, data, previewId, index) {//上传成功回调
				//alert(data.response.uploaded[0].file);
				Settings.idimg=data.response.uploaded[0].file;
			});
				
			$("#imagesbussiness").fileinput('destroy');
			r = $("#imagesbussiness").fileinput({
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
				$('#imagesbussiness').fileinput('upload');
				
			}).on('fileuploaded', function(event, data, previewId, index) {//上传成功回调
				//alert(data.response.uploaded[0].file);
				Settings.bussinessimg=data.response.uploaded[0].file;
			});
			$("#ApplyBtn").click(function(){
				SubmitApply();
			})
		}
		
		
			
		function SubmitApply(){
			
			var other = $("#other").val();
			
			
			if(suppliertype==2){
				if(Settings.jobimg==""){
					Message("上传完成后才能操作！");
					return;
				}
				if(Settings.idimg==""){
					Message("上传完成后才能操作！");
					return;
				}
				if(Settings.bussinessimg==""){
					Message("上传完成后才能操作！");
					return;
				}
			}else{
				if(Settings.jobimg==""){
				Message("上传完成后才能操作！");
				return;
			}
			if(Settings.idimg==""){
				Message("上传完成后才能操作！");
				return;
			}
			}
			
			if(other == ""){
				Message('其他信息不能为空！');
				return ;
			}
			url = "supply.identify.ajax.php?mode=applyidentify";
			$.post(url,{
				jobimg : Settings.jobimg ,
				idimg : Settings.idimg ,
				bussinessimg : Settings.bussinessimg ,
				otherinfo : other 
				
			},function(json,status){
				console.log(json);
				switch (json){
					case "1":
						Message("您已成功提交申请，请等待审核。");
						break;
					default:
						Message("服务器忙，请稍候再试。");
						break;
				}
			});
		}

   </script>
</html>