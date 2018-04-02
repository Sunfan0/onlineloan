<?php	include "demand.header.php";	?>
		<div id="Maincontainer" class="container" style="margin-top:30px;">
			<table id="ContentTable" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>供方姓名</th>
						<th>手机号</th>
						<th>查看时间</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
			<div class="modal fade" id="SupplyInfo">
			  <div class="modal-dialog" style="width:800px;">
				<div class="modal-content message_align">
				  <div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h5 class="modal-title">供方详情</h5>
				  </div>
				  <div class="modal-body text-center">
					<form class="form-horizontal">
						<div class="form-group">
								<label for="newMobile" class="col-sm-2 control-label">手机号</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="newMobile" disabled>
								</div>
							</div>
							<div class="form-group">
								<label for="newUsername" class="col-sm-2 control-label">用户名</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="newUsername" disabled>
								</div>
							</div>
							<div class="form-group">
								<label for="newname" class="col-sm-2 control-label">姓名</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="newname" disabled>
								</div>
							</div>
							<div class="form-group">
								<label for="newcompany" class="col-sm-2 control-label">所属公司</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="newcompany" disabled>
								</div>
							</div>
							<div class="form-group">
								<label for="newsex" class="col-sm-2 control-label">性别</label>
								<div class="col-sm-9">
									<select class="form-control" id="newsex" disabled>
										<option value="1">男</option>
										<option value="2">女</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="newage" class="col-sm-2 control-label">年龄</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="newage" disabled>
								</div>
							</div>
							<div class="form-group">
								<label for="newqqnum" class="col-sm-2 control-label">QQ</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="newqqnum" disabled>
								</div>
							</div>
							<div class="form-group">
								<label for="newwxnum" class="col-sm-2 control-label">微信</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="newwxnum" disabled>
								</div>
							</div>
							<div class="form-group">
								<label for="newemail" class="col-sm-2 control-label">邮箱</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="newemail" disabled>
								</div>
							</div>
							<div class="form-group">
								<label for="newgoodproduct" class="col-sm-2 control-label">擅长产品</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="newgoodproduct" disabled>
								</div>
							</div>
							<div class="form-group">
								<label for="newpersonal" class="col-sm-2 control-label">个人特色</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="newpersonal" disabled>
								</div>
							</div>
							<div class="form-group">
								<label for="newtype" class="col-sm-2 control-label">身份</label>
								<div class="col-sm-9">
									<select class="form-control" id="newtype" disabled>
										<option value="1">中介</option>
										<option value="2">机构</option>
									</select>
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

		<?php $timestamp = time();?>

		function OnLoad(){
			BindEvents();
			ShowSupplyList();
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
						ShowSupplyInfo(GotListTable.row('.selected').data().supplierid);
					}
				}
			});

		}
		function ShowSupplyList(){
			GotListTable = $('#ContentTable').DataTable({
				"ajax": {
					"url":"demand.viewsupplierway.ajax.php?mode=ShowSupplierList",
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "supplierid"},
					{ "data": "name"},
					{ "data": "mobile"},
					{ "data": "visittime"}
				],
				"oLanguage": {
					"sLengthMenu": "显示 _MENU_ 条记录",
					"sSearch": "搜索:",
					"sInfo": "显示第 _START_ - _END_ 条记录，共 _TOTAL_ 条",
					"sInfoEmpty": "没有符合条件的记录",
					"sZeroRecords": "没有符合条件的记录",
					 "oPaginate": {
						"sFirst": "首页",
						"sPrevious": "上一页",
						"sNext": "下一页",
						"sLast": "末页"
					},
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
		function ShowSupplyInfo(id){
			url = "demand.viewsupplierway.ajax.php?mode=ShowSupplierinfoDetail&supplierid="+id;
			$.get(url,function(json,status){
				if(json=="null"){
					CommonJustTip('暂无数据。');
					return;
				}
				json = eval("("+json+")");
				$("#SupplyInfo").modal({backdrop:'static',keyoard:false});
console.log(json);
				var type = "";
				switch(json.type){
					case "1":
						type = "中介";
						break;
					case "2":
						type = "机构";
						break;
				}
				$("#newMobile").val(json.mobile);
				$("#newUsername").val(json.username);
				$("#newname").val(json.name);
				$("#newcompany").val(json.company);
				$("#newsex").val(json.sex);
				$("#newage").val(json.age);
				$("#newemail").val(json.email);
				$("#newqqnum").val(json.qqnum);
				$("#newwxnum").val(json.wxnum);
				$("#newgoodproduct").val(json.goodproduct);
				$("#newpersonal").val(json.personalfeature);
				$("#newtype").val(json.type);
			});
		}
   </script>
</html>