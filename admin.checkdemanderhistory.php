<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">			
			<table id="CheckResultList" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>需方用户名</th>
						<th>注册时间</th>
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
					<h5 class="modal-title">需方注册信息</h5>  
				  </div>  
				  <div class="modal-body text-center">  
						<form class="form-horizontal">
							<div class="form-group">
								<label  for='accountname' class="col-sm-2 control-label">账号</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="accountname" readonly>
								</div>
							</div>
							<div class="form-group">
								<label for="username" class="col-sm-2 control-label">姓名</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="username" readonly>
								</div>
							</div>
							<div class="form-group">
								<label for="newsex" class="col-sm-2 control-label" >性别 :</label>
								<div class="col-sm-9">
									<select class="form-control" id="newsex" disabled>
										<option value="1">男</option>
										<option value="2">女</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="newage" class="col-sm-2 control-label" >年龄 :</label>
								<div class="col-sm-9">
								  <input type="text" class="form-control" id="newage" readonly>
								</div>
							</div>
							<div class="form-group">
								<label for="newqqnum" class="col-sm-2 control-label" >QQ :</label>
								<div class="col-sm-9">
								  <input type="text" class="form-control" id="newqqnum" readonly>
								</div>
							</div>
							<div class="form-group">
								<label for="newemail" class="col-sm-2 control-label" >邮箱 :</label>
								<div class="col-sm-9">
								  <input type="text" class="form-control" id="newemail" readonly>
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
					ShowDetailInfo(GotListTable.row('.selected').data().id);
				}
			}); 
		}
		function ShowCheckList(){
			GotListTable = $('#CheckResultList').DataTable({
				"ajax": {
					"url":"admin.checkdemanderhistory.ajax.php?mode=ShowdemanderList",
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "id"},
					{ "data": "username"},
					{ "data": "registtime"},
					{ "data": "isallowed"},
					{ "data": "operator"},
					{ "data": "operattime"}
				],	
				// "searching": false,
				"columnDefs":[
					{
						"targets":3,
						"render":function(data,type,full){
							// return "<img style='width:50px;height:50px;' src='"+data+"'>";
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
/*
		function ShowCheckList(page){
			Settings.Currentpage = page;
			$("#CheckResultList tbody").html("");
			$("#kkpager").html("");			
			url = "admin.checkdemanderhistory.ajax.php?mode=ShowdemanderList&currentpage="+page;
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
					var isallowed = "";
					switch(data[i].isallowed){
						case "1":
							isallowed = "已通过";
							break;
						case "-1":
							isallowed = "已拒绝";
							break;
						case "0":
							isallowed = "未审核";
							break;
					}
					var strTbody = '<tr onclick="ShowDetailInfo('+data[i].id+')"><td>'+(i+1)+'</td><td>'+data[i].username+'</td>';
					strTbody+= '<td>'+data[i].registtime+'</td><td>'+isallowed+'</td>';
					strTbody+= '<td>'+data[i].operator+'</td><td>'+data[i].operattime+'</td></tr>';
					$("#CheckResultList tbody").append(strTbody);
				}
				kkpager.generPageHtml({
					pno : page,
					total : json.pagecount,
					totalRecords : json.total,
					mode : 'click',//默认值是link，可选link或者click
					click : function(n){
						ShowCheckList(n);
						return false;
					}
				} , true);
			});
		}
*/
		function ShowDetailInfo(id){
			url = "admin.checkdemanderhistory.ajax.php?mode=ShowdemanderDetail&id="+id;
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json); 
				if(json == null){
					CommonJustTip('暂无数据。');
					return;
				}
				$('#DetailInfo').modal('toggle');
				var isallowed = "";
				switch(json.isallowed){
						case "1":
							isallowed = "已通过";
							break;
						case "-1":
							isallowed = "已拒绝";
							break;
						case "0":
							isallowed = "未审核";
							break;
					}
				$("#accountname").val(json.mobile); 
				$("#username").val(json.username); 
				$("#newsex").val(json.sex); 
				$("#newage").val(json.age);
				$("#newqqnum").val(json.qqnum); 
				$("#newemail").val(json.email);
				$("#other").val("补充内容");
			});
		}		
		

		
   </script> 
</html>