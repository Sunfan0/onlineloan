<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<form class="navbar-form navbar-left">
						<button id="selectAll" class="btn btn-primary text-right">全选</button>
						<button onclick="ResetPassword(1); return false;"  class="btn btn-warning text-right" style="margin-left: 40px;">重置密码</button>						
						<button onclick="SetBlackInfo(-1,1); return false;"  class="btn btn-primary text-right" style="margin-left: 5px;">解除黑名单</button>
						<button onclick="SetBlackInfo(1,1); return false;"  class="btn btn-danger text-right" style="margin-left: 5px;">加入黑名单</button>
					</form>
					<form class="navbar-form navbar-right">
						<select class="form-control" id="Userstatus">
							<option value="1" selected>正常用户</option>
							<option value="-1">黑名单</option>
						</select>
					</form>
				</div>
			</nav>
			<table id="ContentTable" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th >ID</th>
						<th>真实姓名</th>
						<th>手机号</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
			<div id="kkpager"></div>
			<div class="modal fade" id="DemanderInfo">  
			  <div class="modal-dialog">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 id="addTitle" class="modal-title">详细信息</h5>  
				  </div>  
				  <div class="modal-body text-center"> 
					  <form class="form-horizontal">
						<div class="form-group">
							<label for="DemanderName" class="col-sm-2 control-label">真实姓名</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="DemanderName" readonly>
							</div>
						</div>
						<div class="form-group">
							<label for="DemanderMobile" class="col-sm-2 control-label">手机号</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="DemanderMobile" readonly>
							</div>
						</div>
						
					</form>
				  </div>  
				  <div class="modal-footer">
					<button onclick="ResetPassword(0)" style="margin-right:360px" type="button" class="btn btn-warning">重置密码</button>
					<button id="addBlack" onclick="SetBlackInfo(1,0)" style="margin-right:5px" type="button" class="btn btn-danger">加入黑名单</button>
					<button id="removeBlack" onclick="SetBlackInfo(-1,0)" style="margin-right:5px" type="button" class="btn btn-primary hidden">解除黑名单</button>
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
		SelectData = new Array();
		
		window.onload = OnLoad;
		
		function OnLoad(){
			BindEvents();
			ShowSupplierList(1);
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
			$("#Userstatus").change(function(){
				var status = $("#Userstatus option:selected").val()
				ShowSupplierList(status);
			})
		}
		function ShowSupplierList(status){
			if(GotListTable){
				GotListTable.destroy();
			}
			if(status==1){
				url = "admin.usersupplier.ajax.php?mode=ShowSupplierList";
			}else{
				url = "admin.usersupplier.ajax.php?mode=ShowBlackList";
			}
			GotListTable = $('#ContentTable').DataTable({
				"ajax": {
					"url":url,
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "id"},
					{ "data": "name"},
					{ "data": "mobile"},
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
                        'targets': 3,
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
			url = "admin.userdemander.ajax.php?mode=ShowSupplierDetail&id="+id;
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				switch(json.isblacklist){
					case "1":
						$("#addBlack").addClass("hidden");
						$("#removeBlack").removeClass("hidden");
						break;
					default:
						$("#addBlack").removeClass("hidden");
						$("#removeBlack").addClass("hidden");
						break;
				}
				$("#DemanderName").val(json.name); 
				$("#DemanderMobile").val(json.mobile);
			});
		}
		
		
		function SetBlackInfo(type,batch){//黑名单
			SelectData = new Array();
			if(batch == 1){
				$(".checkbox_select:checked").each(function(){
					var d={};
					d.id = $(this).data("id");
					SelectData.push(d);
				})
				if(SelectData.length == 0){
					CommonJustTip("至少选择一条需方用户信息！");
					return;
				}
				
			}
			
			var strcontent;
			switch(type){
				case 1:
					strcontent = "<p style='color:black;'>请在下面输入加入黑名单的理由：</p><textarea rows='3' class='form-control' id='blackreason'></textarea>";
					break;
				case -1:
					strcontent = "<p style='color:black;'>请在下面输入解除黑名单的理由：</p><textarea rows='3' class='form-control' id='blackreason'></textarea>";
					break;
			}
			$.confirm({
				title: '',
				content: strcontent,
				confirmButton: '确定',
				cancelButton: '取消',
				confirm: function(){
					switch(batch){
						case 0:
							var reason = $("#blackreason").val();
							url = "admin.userdemander.ajax.php?mode=SetBlackList&id="+Settings.CurrentId+"&type="+type+"&reason="+reason;
							$.get(url,function(json,status){
console.log(json);
								switch (json){
									case "1":
										$('#DemanderInfo').modal('toggle');
										GotListTable.draw(false);
										CommonJustTip("操作成功！");
										break;
									default:
										CommonJustTip("服务器忙，请稍候再试。");
										break;
								}
							});
							break;
						case 1:
							var data = {};
							data.demanderid = SelectData;
							data.status = type;
							data.reason = $("#blackreason").val();
							url = "admin.userdemander.ajax.php?mode=MoreSetBlackList";
							$.get(url,{
									data : JSON.stringify(data)
								},function(json,status){
console.log(json);
									switch (json){
										case "1":
											GotListTable.draw(false);
											CommonJustTip("操作成功！");
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
		
		
		function ResetPassword(batch){//重置密码
			SelectData = new Array();
			if(batch == 1){
				$(".checkbox_select:checked").each(function(){
					var d={};
					d.id = $(this).data("id");
					SelectData.push(d);
				})
				if(SelectData.length == 0){
					CommonJustTip("至少选择一条需方用户信息！");
					return;
				}
				
			}
			var strcontent;
			switch(batch){
				case 0:
					strcontent = "您确定重置该需方用户的密码？";
					break;
				case 1:
					strcontent = "您确定重置所有选中的需方用户的密码？";
					break;
			}
			
			$.confirm({
				title: '提示',
				content: strcontent,
				confirmButton: '确定',
				cancelButton: '取消',
				confirm: function(){
					switch(batch){
						case 0:
							url = "admin.userdemander.ajax.php?mode=ResetPsw&id="+Settings.CurrentId;
							$.get(url,function(json,status){
console.log(json);
								switch (json){
									case "1":
										$('#DemanderInfo').modal('toggle');
										GotListTable.draw(false);
										CommonJustTip("操作成功！");
										break;
									default:
										CommonJustTip("服务器忙，请稍候再试。");
										break;
								}
							});
							break;
					case 1:
							var data = {};
							data.demanderid = SelectData;
							url = "admin.userdemander.ajax.php?mode=MoreResetPsw";
							$.get(url,{
									data : JSON.stringify(data)
								},function(json,status){
console.log(json);
									switch (json){
										case "1":
											GotListTable.draw(false);
											CommonJustTip("操作成功！");
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