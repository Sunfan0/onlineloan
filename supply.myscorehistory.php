<?php	include "supply.header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">			
			<table id="scoreobtainTable" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>变更理由</th>
						<th>变更前</th>
						<th>变更</th>
						<th>变更后</th>
						<th>操作员</th>
						<th>操作时间</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</body>
	<?php	include "footer.php";	?>
	<script type="text/javascript">
		var Settings = {};
		var GotListTable;
		
		window.onload = OnLoad;

		function OnLoad(){
			BindEvents();
			ShowscoreobtainList();
		}
		
		function BindEvents(){
		}
		function ShowscoreobtainList(){
			GotListTable = $('#scoreobtainTable').DataTable({
				"ajax": {
					"url":"supply.myscorehistory.ajax.php?mode=ShowList",
					"type":"POST"
				},
				//"processing": true,加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "reason"},	 
					{ "data": "beforescore"},
					{ "data": "changescore"},
					{ "data": "afterscore"},
					{ "data": "operator"},
					{ "data": "operattime"}
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
				if(json==null){
				}
					CommonJustTip('暂无数据。');
					return;
				}
			} );
		};
   </script> 
</html>