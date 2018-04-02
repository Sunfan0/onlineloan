<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:20px;margin-bottom:50px;width:700px;">
			<div class="panel panel-default" style='width:700px'>
				<div class="panel-heading">
					<h3 class="panel-title">
						首页图片设置详情
					</h3>
				</div>
				<div class="panel-body" >
					<form class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-2 control-label">展示图片</label>
							<div class="col-sm-10">
								<input type="hidden" id="flagid" class="form-control">
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
				Updateimg();
			});
		}
		function ShowContent(){
			url = "admin.showpageimg.ajax.php?mode=Showpegeimg";
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
				Settings.image = json.codeimg;
				$('#images').fileinput('refresh', {initialPreview:[json.codeimg]});
			});
		}
		function Updateimg(){
			flagid=$("#flagid").val();
			imgurl=Settings.image;
			url = "admin.showpageimg.ajax.php?mode=Updatepageimg";
			$.get(url,{
				id:flagid,
				imgurl:imgurl
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