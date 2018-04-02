<?php	
	include "header.php";	
	$strSql = " Select * From scorerule order by createtime limit 0,1 ";
	$showdata = DBGetDataRow($strSql);
	$productmaxnum=$showdata["productmaxnum"];
	$newsmaxnum=$showdata["newsmaxnum"];
	$infoid=$showdata["id"];

?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">   
			<table id="ContentTable" class="table table-hover table-bordered">
				 <form class="form-horizontal">
					<div class="form-group" style="height: 45px;border-bottom: 1px solid #ccc;">
						<label for="productmaxnum" class="col-sm-2 control-label">当天允许发布产品数目上限</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" id="productmaxnum" >
						</div>
						<label for="newsmaxnum" class="col-sm-2 control-label">当天允许发布资讯数目上限</label>
						<div class="col-sm-3">
							<input type="text" class="form-control" id="newsmaxnum" >
						</div>
						<div class="col-sm-2">
							<button type="button" id='btnset' class="btn btn-primary" >确定</button>  
						</div>
					</div>
				</form>
				<thead>
					<tr>
						<th >ID</th>
						<th>用户名</th>
						<th>手机号</th>
						<th>用户类型</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
			<div class="modal fade" id="DemanderInfo">  
			  <div class="modal-dialog" style="width:900px;">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 id="addTitle" class="modal-title">设置信息</h5>  
				  </div>  
				  <div class="modal-body text-center"> 
					  <form class="form-horizontal">
						<div class="form-group">
							<label for="productnum" class="col-sm-3 control-label">当天允许发布产品数目上限</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="productnum" >
							</div>
						</div>
						<div class="form-group">
							<label for="newsnum" class="col-sm-3 control-label">当天允许发布资讯数目上限</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="newsnum" >
							</div>
						</div>
					</form>
				  </div>  
				  <div class="modal-footer" style="text-align:center;">
					<button onclick="setnum()"  type="button" class="btn btn-primary">设置</button>
				  </div>  
				</div>
			  </div>
			</div>
		</div>
	</body>
	<?php	include "footer.php";	?>
	<script type="text/javascript">
		var Settings = {};
		Settings.productmaxnum="<?php echo $productmaxnum ?>";
		Settings.newsmaxnum="<?php echo $newsmaxnum ?>";
		Settings.infoid="<?php echo $infoid ?>";
		
		var GotListTable;
		SelectData = new Array();
	
		window.onload = OnLoad;
		
		function OnLoad(){
			$("#productmaxnum").val(Settings.productmaxnum);
			$("#newsmaxnum").val(Settings.newsmaxnum);
			BindEvents();
			ShowSupplierList();
		}
		function BindEvents(){
			$("#btnset").click(function(){
				url = "admin.suppliermaxnum.ajax.php?mode=SetMaxnum&id="+Settings.infoid;
				url +="&productmaxnum="+$("#productmaxnum").val();
				url +="&newsmaxnum="+$("#newsmaxnum").val();
				$.get(url,function(json,status){
					json = eval("("+json+")");
	console.log(json);
					switch (json){
						case 1:
							CommonJustTip("修改成功！");
							break;
						case -1:
							CommonJustTip("服务器忙，请稍候再试。");
							break;
					}
				});
			
			})
		}
		function ShowSupplierList(){
			GotListTable = $('#ContentTable').DataTable({
				"ajax": {
					"url":"admin.suppliermaxnum.ajax.php?mode=ShowSupplierList",
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "id"},
					{ "data": "username"},
					{ "data": "mobile"},
					{ "data": "type"},
					{ "data": "id"}
				],	
				// "searching": false,
				  "aoColumnDefs": [
					{　　//为每一行数据添加一个checkbox，
						'targets': 0,
						'render': function (data, type, row){
							
							strcontent= '<span style="margin-left: 15px;vertical-align: sub;">'+data+'</span>';
							return strcontent;
						}
					},
					/* {
						"targets":3,
						"render":function(data,type,full){
							switch(data){
								case "1":
									return "中介";
									break;
								case "2":
									return "机构";
									break;
							}
						}
					}, */
					{
                        'targets': 4,
						'render': function (data, type, row){
							return '<button onclick="ShowDetailInfo('+data+')" type="button" class="btn btn-primary">编辑</button>';
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
			$('#DemanderInfo').modal({backdrop: 'static', keyboard: false});
			url = "admin.suppliermaxnum.ajax.php?mode=ShowSupplierDetail&id="+id;
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				$("#productnum").val(json.productmaxnum); 
				$("#newsnum").val(json.newsmaxnum); 
			});
		}
		function setnum(){
			pruductmax=$("#productnum").val();
			newsmax=$("#newsnum").val();
			url = "admin.suppliermaxnum.ajax.php?mode=UpdateMaxnum&id="+Settings.CurrentId;
			url += "&productmaxnum="+pruductmax;
			url += "&newsmaxnum="+newsmax;
			$.get(url,function(json,status){
console.log(json);
				switch (json){
					case "1":
						$('#DemanderInfo').modal('toggle');
						CommonJustTip("操作成功！");
						break;
					default:
						CommonJustTip("服务器忙，请稍候再试。");
						break;
				}
			});
		}
   </script> 
</html>