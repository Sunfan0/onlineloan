<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">
			<table id="supplyinfolist" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>简介</th>
						<th>内容</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
			<div class="modal fade" id="userinfolist">
			  <div class="modal-dialog" style="width:1100px;">
				<div class="modal-content message_align">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h5 class="modal-title">详情列表</h5>
				  </div>
				  <div class="modal-body">
					<table id="userinfoTable" class="table table-hover table-bordered"  style="width:100%;">
						<thead>
							<tr>
								<th>用户名</th>
								<th>手机号码</th>
								<th>关注时间</th>
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
			$('#supplyinfolist tbody').on( 'click', 'td', function () {
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
			GotListTable = $('#supplyinfolist').DataTable({
				"ajax": {
					"url":"admin.attentionsupplyinfo.ajax.php?mode=ShowSupplierList",
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "id"},
					{ "data": "Featuresintroduce"},
					{ "data": "content"}
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
					"url":"admin.attentionsupplyinfo.ajax.php?mode=ShowDemanderList&supplyinfoid="+id,
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "username"},
					{ "data": "mobile"},
					{ "data": "focustime"}
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
				$('#userinfolist').modal({backdrop: 'static', keyboard: false});
			} );
		};
   </script>
</html>