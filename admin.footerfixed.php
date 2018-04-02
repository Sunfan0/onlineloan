<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:20px;margin-bottom:50px;width:700px;">
			<div class="panel panel-default" style='width:700px'>
				<div class="panel-heading">
					<h3 class="panel-title">
						页脚设置详情
					</h3>
				</div>
				<div class="panel-body" >
					<form class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-2 control-label">版权文字</label>
							<div class="col-sm-10">
								<input type="hidden" id="flagid" class="form-control">
								<textarea id="CopyRightText" class="form-control"></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">联系电话</label>
							<div class="col-sm-10">
								<input type="text" id="ContactWay" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">投递邮箱</label>
							<div class="col-sm-10">
								<input type="text" id="ContactEmail" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">微信号</label>
							<div class="col-sm-10">
								<input type="text" id="ContactWX" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">QQ</label>
							<div class="col-sm-10">
								<input type="text" id="ContactQQ" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">二维码</label>
							<div class="col-sm-10">
								<input id="images" name="images[]" type="file" multiple data-min-file-count="1">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-5"></div>
							<div class="col-sm-7">
								<button id="btnUpdate" type="button" class="btn btn-primary">更新</button>  
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
	<?php	include "footer.php";	?>
	<SCRIPT type="text/javascript">
		var Settings = {};
		Settings.image = "";
		window.onload = function(){
			BindEvents();
			ShowContent();
		}
	
		function BindEvents(){
			$("#images").fileinput('destroy');
				r = $("#images").fileinput({
				language: 'zh',
				uploadAsync: true,
				uploadUrl: 'bootstrap-fileinput-upload.php',
				// allowedFileExtensions : ['jpg', 'png','gif',"pdf"],
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
				Settings.image = data.response.uploaded[0].file;
			});
			$("#btnUpdate").click(function(){
				UpdateFixedText();
			});
		}
		function ShowContent(){
			url = "admin.footerfixed.ajax.php?mode=ShowFooterFixed";
			$.get(url,function(json,status){
				if(json=="123"){
					CommonNopower();
					$("#Maincontainer").addClass("hidden");
					return;
				}
				if(json=="null"){
					CommonJustTip('暂无数据。');
					return;
				}
				json=eval("("+json+")");
console.log(json);
				$("#flagid").val(json.id);
				$("#CopyRightText").val(json.copyright);
				$("#ContactWay").val(json.telephone);
				//$("#ContactEmail").val(json.email);
				//$("#ContactWX").val(json.wxnum);
				//$("#ContactQQ").val(json.qqnum);
				//Settings.image = json.codeimg;
				//$('#images').fileinput('refresh', {initialPreview:[json.codeimg]});
			});
		}
		function UpdateFixedText(){
			flagid=$("#flagid").val();
			copyright=$("#CopyRightText").val();
			mobile=$("#ContactWay").val();
			// email=$("#ContactEmail").val();
			// wxnum=$("#ContactWX").val();
			// qqnum=$("#ContactQQ").val();
			//codeimg=Settings.image;
			url = "admin.footerfixed.ajax.php?mode=UpdateStandardScore";
			$.get(url,{
				id:flagid,
				mobile:mobile,
				copyright:copyright
				// email:email,
				// wxnum:wxnum,
				// qqnum:qqnum,
				//codeimg:codeimg
			},function(json,status){
				switch(json){
					case "1":
						CommonJustTip("更新成功！");
						ShowContent();
						break;
					case "-1":
						CommonJustTip("系统繁忙！请稍后重试");
						break;
				}
			});
		}
	</script>
</html>