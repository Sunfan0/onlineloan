<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">
			<table id="ContentTable" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>用户名</th>
						<th>手机号</th>
						<th>用户类型</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
			<div class="modal fade" id="demandinfo" >
			  <div class="modal-dialog" style="width:900px;">
				<div class="modal-content message_align">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h5 id="addTitle" class="modal-title">详细信息</h5>
				  </div>
				  <div class="modal-body">
					 <table id="showdetialinfor" class="table table-hover table-bordered" style="width:100%;">
						<thead>
							<tr>
								<th>用户名</th>
								<th>手机号码</th>
								<th>查看时间</th>
								<th>停留时间</th>
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

		function OnLoad(){
			BindEvents();
			ShowSupplierList();
		}
		function BindEvents(){
			$('#ContentTable tbody').on( 'click', 'td', function () {
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
		function ShowSupplierList(){
			GotListTable = $('#ContentTable').DataTable({
				"ajax": {
					"url":"admin.viewsupplierway.ajax.php?mode=ShowSupplierList",
					"type":"POST"
				},
				//"processing": true,加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "id"},
					{ "data": "username"},
					{ "data": "mobile"},
					{ "data": "type"}
				],
				"aoColumnDefs":[
					{
						"targets":3,
						"render":function(data,type,full){
							switch(data){
								case "1":
									return "中介";
									break;
								case "0":
									return "机构";
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
		};
		function ShowDetailInfo(id){
			if(GotInfoTable){
				GotInfoTable.destroy();
			}
			GotInfoTable = $('#showdetialinfor').DataTable({
				"ajax": {
					"url":"admin.viewsupplierway.ajax.php?mode=ShowDemanderList&supplierid="+id,
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "username"},
					{ "data": "mobile"},
					{ "data": "visittime"},
					{ "data": "staytime"}
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
// console.log(json);
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
				$('#demandinfo').modal({backdrop: 'static', keyboard: false});
			} );
		};
   </script>
</html>