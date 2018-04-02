<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<form class="navbar-form navbar-left">
						<button id="selectAll" class="btn btn-primary text-right">全选</button>
						<button onclick="OperateRequest(1,'more'); return false;" class="btn btn-primary text-right" style="margin-left: 40px;">通过</button>
						<button onclick="OperateRequest(-1,'more'); return false;"  class="btn btn-danger text-right" style="margin-left: 5px;">拒绝</button>
					</form>							
				</div>
			</nav>
			<table id="checkmodifyinfoList" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>用户名</th>
						<th>申请时间</th>
						<th>当前状态</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
			<div class="modal fade" id="DetailInfo">  
			  <div class="modal-dialog" style="width:1100px;">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 class="modal-title">该实名认证的详细信息</h5>  
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
							<div class="form-group">
								<div class="col-sm-12">
									<button id="passBtn" onclick="OperateRequest(1,'one')" type="button" class="btn btn-primary">通过</button>
									<button id="refuseBtn" onclick="OperateRequest(-1,'one')" type="button" class="btn btn-danger">拒绝</button> 
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
		Settings.SelectAll = false;
		var GotListTable;
		
		window.onload = OnLoad;
		function OnLoad(){
			BindEvents();
			ShowCheckmodifyinfoList();
		}
		function BindEvents(){
			//页面上点击此属性，将当前页的列表数据全部选中
			$('#selectAll').on('click', function () {
				if (!Settings.SelectAll) {
					Settings.SelectAll = true;
					$("#selectAll").html("取消");
					$('.checkbox_select').each(function () {
						$(this).prop("checked",true);
					});
				} else {
					Settings.SelectAll = false;
					$("#selectAll").html("全选");
					$('.checkbox_select').each(function () {
						$(this).prop("checked",false);
					});
				}
				return false;
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
		function ShowCheckmodifyinfoList(){
			GotListTable = $('#checkmodifyinfoList').DataTable({
				"ajax": {
					"url":"admin.checkmodify.ajax.php?mode=ShowmodifyList",
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
					{ "data": "id"}
				],	
				// "searching": false,
				  "aoColumnDefs": [
					{　　//为每一行数据添加一个checkbox，
						'targets': 0,
						'render': function (data, type, row){
							var strcontent = '<input class="checkbox_select" type="checkbox" data-id="'+data+'" style="vertical-align: middle;">';
							strcontent+= '<span style="margin-left: 15px;vertical-align: sub;">'+data+'</span>';
							return strcontent;
						}
					},
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
					},
					{
                        'targets': 4,
						'render': function (data, type, row){
							return '<button onclick="ShowDetailInfo('+data+')" type="button" class="btn btn-primary">查看</button>';
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
			Settings.CurrentId = id;
			$('#DetailInfo').modal({backdrop: 'static', keyboard: false});
			url = "admin.checkmodify.ajax.php?mode=ShowmodifyDetail&id="+id;
			$.get(url,function(json,status){
				json = eval("("+json+")");
				if(json == null){
					CommonJustTip('暂无数据。');
					return;
				}
				switch(json.isallowed){
					case "1":
						$("#passBtn").addClass("hidden");
						$("#refuseBtn").removeClass("hidden");
						break;
					case "-1":
						$("#passBtn").removeClass("hidden");
						$("#refuseBtn").addClass("hidden");
						break;
					case "0":
						$("#passBtn").removeClass("hidden");
						$("#refuseBtn").removeClass("hidden");
						break;
				}
				$('#imagesjob').fileinput('refresh', {initialPreview:[json.employeecard]});
				$('#imagesid').fileinput('refresh', {initialPreview:[json.copyofidcard]});
				$("#other").val(json.otherinfo);
				$("#imagesjob").attr('disabled','disabled');
				$("#imagesid").attr('disabled','disabled');
				$("#other").attr('readonly','readonly');
			});

		}
		function OperateRequest(type,number){//通过、拒绝
			SelectData = new Array();
			if(number == "more"){
				$(".checkbox_select:checked").each(function(){
					var d={};
					d.id = $(this).data("id");
					SelectData.push(d);
				})
				if(SelectData.length == 0){
					CommonJustTip("至少选择一条审核信息！");
					return;
				}
			}
				
			var strcontent;
			switch(type){
				case 1:
					strcontent = "<p style='color:black;'>请在下面输入你通过的理由：</p><textarea rows='3' class='form-control' id='userreason'></textarea>";
					break;
				case -1:
					strcontent = "<p style='color:black;'>请在下面输入你拒绝的理由：</p><textarea rows='3' class='form-control' id='userreason'></textarea>";
					break;
			}
			$.confirm({
				title: '',
				content: strcontent,
				confirmButton: '确定',
				cancelButton: '取消',
				confirm: function(){
					switch(number){
						case 'one':
							var reason = $("#userreason").val();
							url = "admin.checkmodify.ajax.php?mode=Updatemodify&id="+Settings.CurrentId+"&type="+type+"&reason="+reason;
							$.get(url,function(json,status){
console.log(json);
								switch (json){
									case "1":
										$('#DetailInfo').modal('toggle');
										GotListTable.draw(false);
										Settings.SelectAll = false;
										$("#selectAll").html("全选");
										break;
									default:
										CommonJustTip("服务器忙，请稍候再试。");
										break;
								}
							});
							break;
						case 'more':
							var data = {};
							data.modifyid = SelectData;
							data.status = type;
							data.reason = $("#userreason").val();
console.log(data);
							url = "admin.checkmodify.ajax.php?mode=UpdateMoremodify";
							$.get(url,{
								data : JSON.stringify(data)
							},function(json,status){
console.log(json);
								switch (json){
									case "1":
										GotListTable.draw(false);
										Settings.SelectAll = false;
										$("#selectAll").html("全选");
										break;
									default:
										CommonJustTip("服务器忙，请稍候再试。");
										break;
								}
							});
							break;
					}
				},
				cancel: function(){
					return;
				}
			});
		}		
   </script> 
</html>