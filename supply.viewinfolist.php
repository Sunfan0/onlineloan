<?php	include "supply.header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">
			<table id="ViewInfoList" class="table table-hover table-bordered">
				<thead align="center">
					<tr>
						<th>ID</th>
						<th>产品名称</th>
						<th>产品介绍</th>
						<th>发布时间</th>
						<th>查看人数</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
	
			<div class="modal fade" id="ViewInfo">  
			  <div class="modal-dialog" style="width:1100px;">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 class="modal-title">查看信息列表</h5>  
				  </div>  
				  <div class="modal-body">  
					<table id='ViewInfoTable' class="table table-hover table-bordered" style="width:100%;">
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

		<?php $timestamp = time();?>
		
		function OnLoad(){
			BindEvents();
			ShowNewsInfoList();
		}
		
		function BindEvents(){
			$('#ViewInfoList tbody').on( 'click', 'td', function () {
				if ($(this).hasClass('selected') ) {
					$(this).removeClass('selected');
				}
				else {
					GotListTable.$('tr.selected').removeClass('selected');
					$(this).parent().addClass('selected');
					if(GotListTable.row('.selected').data()){
						ShowNewsInfo(GotListTable.row('.selected').data().id);
					}
				}
			});
		}
		function ShowNewsInfoList(){
			GotListTable = $('#ViewInfoList').DataTable({
				"ajax": {
					"url":"supply.viewinfolist.ajax.php?mode=ShowSupplyList",
					"type":"POST"
				},
				//"processing": true,加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "id"},	   
					{ "data": "productname"},
					{ "data": "Featuresintroduce"},
					{ "data": "operattime"},
					{ "data": "cnt"}
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
		};
		function ShowNewsInfo(id){
			if(GotInfoTable){
				GotInfoTable.destroy();
			}
			GotInfoTable = $('#ViewInfoTable').DataTable({
				"ajax": {
					"url":"supply.viewinfolist.ajax.php?mode=ShowdamandList&id="+id,
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
				$('#ViewInfo').modal({backdrop: 'static', keyboard: false});
			} );
		};
   </script> 
</html>