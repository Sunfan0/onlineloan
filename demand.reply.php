<?php	include "demand.header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">
			<table id="NewsInfoList" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>供方产品</th>
						<th>介绍</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
			<!--<div class="modal fade" id="SupplyInfo">
			  <div class="modal-dialog" style="width:800px;">
				<div class="modal-content message_align">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h5 class="modal-title">供方详情</h5>
				  </div>
				  <div class="modal-body text-center">
					<form class="form-horizontal">
							<div class="form-group">
								<label for="newname" class="col-sm-2 control-label">供方产品</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="newname" disabled>
								</div>
							</div>
							<div class="form-group">
								<label for="newcontent" class="col-sm-2 control-label">回复内容</label>
								<div class="col-sm-9">
									<textarea class="form-control" id="newcontent" rows="3" disabled></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="newtime" class="col-sm-2 control-label">回复时间</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="newtime" disabled>
								</div>
							</div>
					</form>
				  </div>
				</div>
			  </div>
			</div>-->
			<div class="modal fade" id="userinfolist">  
			  <div class="modal-dialog" style="width:1100px;">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 class="modal-title">详情列表</h5>  
				  </div>  
				  <div class="modal-body">  
					<table id="userinfoTable" class="table table-hover table-bordered" style="width:100%;">
						<thead>
							<tr>
								<th>用户名</th>
								<th>留言内容</th>
								<th>时间</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
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
		var GotInfoTable;
		
		window.onload = OnLoad;

		<?php $timestamp = time();?>

		function OnLoad(){
			BindEvents();
			ShowNewsInfoList();
		}
		function BindEvents(){
			$('#NewsInfoList tbody').on( 'click', 'td', function () {
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
		}
		function ShowNewsInfoList(){
			GotListTable = $('#NewsInfoList').DataTable({
				"ajax": {
					"url":"demand.reply.ajax.php?mode=ShowList",
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "id"},
					{ "data": "operator"},
					{ "data": "Featuresintroduce"}
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
			if(GotInfoTable){
				GotInfoTable.destroy();
			}
			GotInfoTable = $('#userinfoTable').DataTable({
				"ajax": {
					"url":"demand.reply.ajax.php?mode=ShowreplyDetail&supplyinfoid="+id,
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "demandername"},
					{ "data": "content"},
					{ "data": "replytime"}
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
				$('#userinfolist').modal({backdrop: 'static', keyboard: false});
			} );
		};
		/* function ShowReplyInfo(id){
			url = "demand.reply.ajax.php?mode=ShowreplyDetail&supplyinfoid="+id;
			$.get(url,function(json,status){
				if(json=="null"){
					CommonJustTip('暂无数据。');
					return;
				}
console.log(json);
				// json = eval("("+json+")");
				$("#SupplyInfo").modal({backdrop:'static',keyoard:false});
				$("#newname").val(json.operator);
				$("#newcontent").val(json.content);
				$("#newtime").val(json.createtime);
			});
		} */

   </script>
</html>