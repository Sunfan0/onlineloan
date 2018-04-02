<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">			
			<table id="CheckResultList" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>用户名</th>
						<th>申请时间</th>
						<th>审核结果</th>
						<th>审核人员</th>
						<th>审核时间</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
			<div class="modal fade" id="DetailInfo">  
			  <div class="modal-dialog" style="width:1100px;">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 class="modal-title">实名认证详情</h5>  
				  </div>  
				  <div class="modal-body text-center"> 
						<form class="form-horizontal">
							<div class="form-group">
								<label for="images" class="col-sm-2 control-label">工作证</label>
								<div class="col-sm-10" style="text-align: left;">
									<input id="imagesjob" name="images[]" type="file" multiple data-min-file-count="1">
								</div>					
							</div>
							<div class="form-group">
								<label for="images" class="col-sm-2 control-label">身份证复印件</label>
								<div class="col-sm-10" style="text-align: left;">
									<input id="imagesid" name="images[]" type="file" multiple data-min-file-count="1">
								</div>					
							</div>
							<div class="form-group">
								<label for="other" class="col-sm-2 control-label">其他</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="other" readonly>
								</div>
							</div>
						</form>
				  </div>   
				</div>
			  </div>
			</div>
		</div>
	</body>
	<?php	include "footer.php";	?>
	<script type="text/javascript">
		var Settings = {};
		var GotListTable;
		
		window.onload = OnLoad;

		function OnLoad(){
			BindEvents();
			ShowCheckList();
		}
		function BindEvents(){
			$('#CheckResultList tbody').on( 'click', 'td', function () {
				if ($(this).hasClass('selected') ) {
					$(this).removeClass('selected');
				}
				else {
					GotListTable.$('tr.selected').removeClass('selected');
					$(this).parent().addClass('selected');
					if(GotListTable.row('.selected').data()){
						ShowDetailInfo(GotListTable.row('.selected').data().id);
					}
				}
			}); 
			
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
		}
		function ShowCheckList(){
			GotListTable = $('#CheckResultList').DataTable({
				"ajax": {
					"url":"admin.checkmodifyhistory.ajax.php?mode=ShowmodifyList",
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "id"},
					{ "data": "name"},
					{ "data": "createtime"},
					{ "data": "isallowed"},
					{ "data": "operator"},
					{ "data": "operattime"}
				],	
				// "searching": false,
				"aoColumnDefs":[
					{
						"targets":3,
						"render":function(data,type,full){
							switch(data){
								case "1":
									return "已通过";
									break;
								case "-1":
									return "已拒绝";
									break;
								case "0":
									return "未审核";
									break;							
							}
						}
					}
				],
				"oLanguage": {
					"sLengthMenu": "显示 _MENU_ 条记录",
					"sSearch": "搜索:",
					"sInfo": "显示第 _START_ - _END_ 条记录，共 _TOTAL_ 条",
					"sInfoEmpty": "没有符合条件的记录",
					"sZeroRecords": "没有符合条件的记录"
				},
				"aaSorting": [[0, "asc"]]//设置排序
			} ).on('xhr.dt', function ( e, settings, json, xhr ) {
console.log(json);
				if(json.recordsTotal == 0){
					 json.aaData = new Array();
				}
				if(json=="123"){
					CommonNopower();
					$("#Maincontainer").addClass("hidden");
					return;
				}
				if(json==null){
					CommonJustTip('暂无数据。');
					return;
				}
			} );
		}
		function ShowDetailInfo(id){
			url = "admin.checkmodifyhistory.ajax.php?mode=ShowmodifyDetail&id="+id;
			$.get(url,function(json,status){
				json = eval("("+json+")");
				if(json == null){
					CommonJustTip('暂无数据。');
					return;
				}
				$('#DetailInfo').modal('toggle');
				$('#imagesjob').fileinput('refresh', {initialPreview:[json.employeecard]});
				$('#imagesid').fileinput('refresh', {initialPreview:[json.copyofidcard]});
				$("#other").val(json.otherinfo);
				$("#imagesjob").attr('disabled','disabled');
				$("#imagesid").attr('disabled','disabled');
				$("#other").attr('readonly','readonly');
			});

		}
   </script> 
</html>