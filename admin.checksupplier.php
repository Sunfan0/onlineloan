<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<form class="navbar-form navbar-left">
						<button id="selectAll" class="btn btn-primary text-right">全选</button>
						<button onclick="OperateRequest(1,'more'); return false;" class="btn btn-primary text-right" style="margin-left: 40px;">通过</button>
						<button onclick="OperateRequest(-1,'more'); return false;"  class="btn btn-danger text-right" style="margin-left: 5px;">拒绝</button>
					</form>							
				</div>
			</nav>
			<table id="checksupplyList" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>账号</th>
						<th>类型</th>
						<th>注册时间</th>
						<th>当前状态</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
			<div class="modal fade" id="DetailInfo">  
			  <div class="modal-dialog" style="width:1100px;">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 class="modal-title">该账户的详细信息</h5>  
				  </div>  
				  <div class="modal-body text-center"> 
						<form class="form-horizontal">							
							<div class="form-group">
								<label for="newMobile" class="col-sm-2 control-label">手机号</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="newMobile" disabled>
								</div>
								<label for="newimgurl" class="col-sm-2 control-label">头像</label>
								<div class="col-sm-4 text-left" style="position: absolute;left: 730px;">
									<img class="img-thumbnail" style="max-width: 130px;max-height: 130px;" id="newimgurl">
								</div>
							</div>
							<div class="form-group">
								<label for="newUsername" class="col-sm-2 control-label">用户名</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="newUsername" disabled>
								</div>
							</div>
							<div class="form-group">
								<label for="newname" class="col-sm-2 control-label">姓名</label>
								<div class="col-sm-4">
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
							<div class="form-group">
								<div class="col-sm-12">
									<button id="passBtn" onclick="OperateRequest(1,'one')" type="button" class="btn btn-primary">通过</button>
									<button id="refuseBtn" onclick="OperateRequest(-1,'one')" type="button" class="btn btn-danger">拒绝</button> 
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
		Settings.SelectAll = false;
		var GotListTable;
		
		window.onload = OnLoad;
		
		function OnLoad(){
			BindEvents();
			ShowChecksupplyList();
		}
		function BindEvents(){
			/* $('#ContentTable tbody').on( 'click', 'td', function () {
				if ($(this).hasClass('selected') ) {
					$(this).removeClass('selected');
				}
				else {
					GotListTable.$('tr.selected').removeClass('selected');
					$(this).parent().addClass('selected');
					ShowNewsInfo('modify',GotListTable.row('.selected').data().id,1);
				}
			}); 
			/* $('#checksupplyList tbody').on( 'click', 'td', function () {
console.log($(this).parent().find(".checkbox_select"));
				if($(this).parent().find(".checkbox_select").is(':checked')){
					$(this).parent().find(".checkbox_select").prop("checked",false);
				}else
					$(this).parent().find(".checkbox_select").prop("checked",true);
			});  */
			
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
		}
		function ShowChecksupplyList(){
			GotListTable = $('#checksupplyList').DataTable({
				"ajax": {
					"url":"admin.checksupplier.ajax.php?mode=ShowSupplierList",
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "id"},
					{ "data": "username"},
					{ "data": "type"},
					{ "data": "registtime"},
					{ "data": "isallowed"},
					{ "data": "id"}
				],
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
						"targets":2,
						"render":function(data,type,full){
							switch(data){
								case "1":
									return "中介";
									break;
								case "2":
									return "机构";
									break;
								default:
									return "";
									break;
								
							}
						}
					},
					{
						"targets":4,
						"render":function(data,type,full){
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
								default:
									return "";
									break;
							}
						}
					},
					{
                        'targets': 5,
						'render': function (data, type, row){
							return '<button onclick="ShowDetailInfo('+data+')" type="button" class="btn btn-primary">查看</button>';
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
/*
		function ShowChecksupplyList(page){
			Settings.Currentpage = page;
			$("#checksupplyList tbody").html("");
			$("#kkpager").html("");			
			url = "admin.checksupplier.ajax.php?mode=ShowSupplierList&currentpage="+page;
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
					var type = "";
					switch(data[i].type){
						case "1":
							type = "中介";
							break;
						case "2":
							type = "机构";
							break;
					}
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
					strTbody+= '<td>'+type+'</td><td>'+data[i].registtime+'</td><td>'+isallowed+'</td></tr>';
					$("#checksupplyList tbody").append(strTbody);
				}
				kkpager.generPageHtml({
					pno : page,
					total : json.pagecount,
					totalRecords : json.total,
					mode : 'click',//默认值是link，可选link或者click
					click : function(n){
						ShowChecksupplyList(n);
						return false;
					}
				} , true);
			});
		}
*/		
			
		function ShowDetailInfo(id){//显示详细信息
			Settings.CurrentId = id;
			$('#DetailInfo').modal({backdrop: 'static', keyboard: false});
			url = "admin.checksupplier.ajax.php?mode=ShowSupplierDetail&id="+id;
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				switch(json.isallowed){
					case "1":
						$("#passBtn").addClass("hidden");
						$("#refuseBtn").removeClass("hidden");
						break;
					case "-1":
						$("#passBtn").removeClass("hidden");
						$("#refuseBtn").addClass("hidden");
						break;
					case "0":
						$("#passBtn").removeClass("hidden");
						$("#refuseBtn").removeClass("hidden");
						break;
				}
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
				$("#newimgurl").attr("src",json.imgurl);
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
		
		function OperateRequest(type,number){//通过、拒绝
			SelectData = new Array();
			if(number == "more"){
				$(".checkbox_select:checked").each(function(){
					var d={};
					d.id = $(this).data("id");
					SelectData.push(d);
				})
				if(SelectData.length == 0){
					CommonJustTip("至少选择一条审核信息！");
					return;
				}
			}
				
			var strcontent;
			switch(type){
				case 1:
					strcontent = "<p style='color:black;'>请在下面输入你通过的理由：</p><textarea rows='3' class='form-control' id='userreason'></textarea>";
					break;
				case -1:
					strcontent = "<p style='color:black;'>请在下面输入你拒绝的理由：</p><textarea rows='3' class='form-control' id='userreason'></textarea>";
					break;
			}
			$.confirm({
				title: '',
				content: strcontent,
				confirmButton: '确定',
				cancelButton: '取消',
				confirm: function(){
					switch(number){
						case 'one':
							var reason = $("#userreason").val();
							url = "admin.checksupplier.ajax.php?mode=UpdateSupplier&id="+Settings.CurrentId+"&type="+type+"&reason="+reason;
							$.get(url,function(json,status){
console.log(json);
								switch (json){
									case "1":
										$('#DetailInfo').modal('toggle');
										GotListTable.draw(false);
										Settings.SelectAll = false;
										$("#selectAll").html("全选");
										break;
									default:
										CommonJustTip("服务器忙，请稍候再试。");
										break;
								}
							});
							break;
						case 'more':
							var data = {};
							data.supplierid = SelectData;
							data.status = type;
							data.reason = $("#userreason").val();
console.log(data);
							url = "admin.checksupplier.ajax.php?mode=UpdateMoreSupplier";
							$.get(url,{
								data : JSON.stringify(data)
							},function(json,status){
console.log(json);
								switch (json){
									case "1":
										GotListTable.draw(false);
										Settings.SelectAll = false;
										$("#selectAll").html("全选");
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