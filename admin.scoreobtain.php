<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">			
			<table id="scoreobtainList" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>姓名</th>
						<th>总计获得积分</th>
						<th>总计扣除积分</th>
						<th>总计当前积分</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
			<div class="modal fade" id="scoreobtainInfo">  
			  <div class="modal-dialog" style="width:1100px;">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 class="modal-title">供方积分履历</h5>  
				  </div>  
				  <div class="modal-body text-center">  
					<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<th style="text-align: center;">变更理由</th>
								<th style="text-align: center;">变更前</th>
								<th style="text-align: center;">变更</th>
								<th style="text-align: center;">变更后</th>
								<th style="text-align: center;">操作时间</th>
							</tr>
						</thead>
						<tbody id='scoreobtainTable'></tbody>
					</table>
					<div id="kkpager"></div>
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
			ShowscoreobtainList();
		}
		function BindEvents(){
			$('#scoreobtainList tbody').on( 'click', 'td', function () {
				if ($(this).hasClass('selected') ) {
					$(this).removeClass('selected');
				}
				else {
					GotListTable.$('tr.selected').removeClass('selected');
					$(this).parent().addClass('selected');
					if(GotListTable.row('.selected').data()){
						ShowscoreobtainInfo(GotListTable.row('.selected').data().id,1);
					}
				}
			}); 
		}

		function ShowscoreobtainList(){
			GotListTable = $('#scoreobtainList').DataTable({
				"ajax": {
					"url":"admin.scoreobtain.ajax.php?mode=SupplierScore",
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "id"},
					{ "data": "username"},
					{ "data": "afterscore"},
					{ "data": "getscore"},
					{ "data": "changescore"}
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
				// if(json.recordsTotal == 0){
					 // json.aaData = new Array();
				// }
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
		function ShowscoreobtainInfo(id,page){
			Settings.Currentpage = page;
			$("#scoreobtainTable").html("");
			$("#kkpager").html("");	
			$('#scoreobtainInfo').modal({backdrop: 'static', keyboard: false});
			
					
			url = "admin.scoreobtain.ajax.php?mode=SupplierScoreDetail&supplierid="+id+"&currentpage="+page;
			$.post(url,function(json,status){
				json = eval("("+json+")");
				data = json.data;
console.log(data);
				if(data == "123"){
					CommonNopower();
					$("#Maincontainer").addClass("hidden");
					return;
				}
				if(data == null){
					CommonJustTip('暂无数据。');
					return;
				}
				for(var i=0;i<data.length;i++){
					var strTbody = '<tr onclick="ShowDetailInfo('+data[i].id+')"><td>'+data[i].reason+'</td>';
					strTbody+= '<td>'+data[i].beforescore+'</td><td>'+data[i].changescore+'</td>';
					strTbody+= '<td>'+data[i].afterscore+'</td><td>'+data[i].operattime+'</td></tr>';
					$("#scoreobtainTable").append(strTbody);
				}
				kkpager.generPageHtml({
					pno : page,
					total : json.pagecount,
					totalRecords : json.total,
					mode : 'click',//默认值是link，可选link或者click
					click : function(n){
						ShowscoreobtainInfo(id,n)
						return false;
					}
				} , true);
			});
		}
   </script> 
</html>