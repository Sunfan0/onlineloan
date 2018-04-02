<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<form class="navbar-form navbar-left">
						<button id="selectAll" class="btn btn-primary text-right">全选</button>
						<button onclick="DeletInfo(1); return false;"  class="btn btn-danger text-right" style="margin-left: 40px;">删除</button>
					</form>
					<form class="navbar-form navbar-right" role="search">
						<button class="btn btn-primary text-right" onclick="AddInfo(); return false;">+ 新增子站</button>
					</form>							
				</div>
			</nav>
			<table id="ContentTable" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>序号</th>
						<th>子站名称</th>
						<th>首字母</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
			<div class="modal fade" id="SubareaInfo">  
			  <div class="modal-dialog" style="width:700px;">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 id="AddTitle" class="modal-title">修改信息</h5>  
				  </div>  
				  <div class="modal-body text-center">  
					<form class="form-horizontal">
						<div class="form-group">
							<label for="SubAreaName" class="col-sm-2 control-label">子站名称</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="SubAreaName">
							</div>
						</div>
						<div class="form-group">
							<label for="SubAreaLetter" class="col-sm-2 control-label">首字母</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="SubAreaLetter">
							</div>
						</div>
						<div class="form-group" style="text-align: right;margin-right: 5px;">
							<div class="checkbox">
								<label>
									<input type="checkbox" id="SubAreaShow"> 首页显示
								</label>
							</div>
						</div>
					</form>
				  </div>  
				  <div class="modal-footer">
					<button id="DeletSubAreaInfo" onclick="DeletInfo(0)" style="margin-right:450px;" type="button" class="btn btn-danger">删除</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>  
					<a  onclick="SaveInfo()" class="btn btn-success">保存</a>  
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
			ShowSubareaList();
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
		}

		function ShowSubareaList(){
			GotListTable = $('#ContentTable').DataTable({
				"ajax": {
					"url":"admin.subarea.ajax.php?mode=SubareaList",
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "id"},
					{ "data": "sort"},
					{ "data": "name"},
					{ "data": "firstletter"},
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
                        'targets': 4,
						'render': function (data, type, row){
							return '<button onclick="ModifyInfo('+data+')" type="button" class="btn btn-primary">编辑</button>&nbsp;&nbsp;<button onclick="SortInfo('+data+',-1)" type="button" class="btn btn-primary">上移</button>&nbsp;&nbsp;<button onclick="SortInfo('+data+',1)" type="button" class="btn btn-primary">下移</button>';
						}
                    },
					{
                        'targets':1,
						'visible' : false  //隐藏列
                    }
					
				],
				"oLanguage": {
					"sLengthMenu": "显示 _MENU_ 条记录",
					"sSearch": "搜索:",
					"sInfo": "显示第 _START_ - _END_ 条记录，共 _TOTAL_ 条",
					"sInfoEmpty": "没有符合条件的记录",
					"sZeroRecords": "没有符合条件的记录"
				},
				"aaSorting": [[1, "asc"]]//设置排序
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
		function SortInfo(id,type){
			url = "admin.subarea.ajax.php?mode=UpdateSort";
			$.post(url, {
				subareaid : id ,
				type : type 
			} ,function(json,status){
console.log(json);
				switch (json){
					case "1":
						if(GotListTable != null)
							GotListTable.destroy();
						ShowSubareaList();
						break;
					default:
						CommonWarning("服务器忙，请稍候再试。");
				}
			});
		}
		
		function UpdateSort(){
			/* data = new Array();
			for(var i=0;i<$("#menuList").children().length;i++){
				d = {};
				d.id = $($("#menuList").children()[i]).data("id");
				d.sort = i;
				data.push(d);
			}
			$.post("admin.subarea.ajax.php?mode=UpdateSort",{data:JSON.stringify(data)},function(json){
				switch(json){
					case "1":
						ShowSubareaList();
						break;
					default:
						alert("更新失败。");
						break;
				}
			});  */
		}
		function ModifyInfo(id){
			Settings.Flagid = id;
			$('#AddTitle').text("修改子站信息");
			$('#SubareaInfo').modal({backdrop: 'static', keyboard: false});
			$("#DeletSubAreaInfo").css('display','');
			$("#SubAreaShow").prop("checked",false);
			url = "admin.subarea.ajax.php?mode=ShowSubarea&subareaid="+id;
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				$("#SubAreaName").val(json.name);
				$("#SubAreaLetter").val(json.firstletter);
				if(json.isshow == '1'){
					$("#SubAreaShow").prop("checked",true);
				}
			})
		}
		function AddInfo(){
			Settings.Flagid = "";
			$('#AddTitle').text("填写子站信息");
			$("#SubAreaName,#SubAreaLetter").val("");
			$('#SubareaInfo').modal({backdrop: 'static', keyboard: false});
			$("#DeletSubAreaInfo").css('display','none');
			$("#SubAreaShow").prop("checked",false);
		}
		function DeletInfo(batch){
			SelectData = new Array();
			if(batch == 1){
				$(".checkbox_select:checked").each(function(){
					var d={};
					d.id = $(this).data("id");
					SelectData.push(d);
				})
				if(SelectData.length == 0){
					CommonJustTip("至少选择一条子站信息！");
					return;
				}
			}
				
			var strcontent;
			switch(batch){
				case 0:
					strcontent = "您确定删除该条子站信息？";
					break;
				case 1:
					strcontent = "您确定删除所有选中的子站信息？";
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
							url = "admin.subarea.ajax.php?mode=DeleteSubarea&id="+Settings.Flagid;
							$.get(url,function(json,status){
console.log(json);
								switch (json){
									case "1":
										$('#SubareaInfo').modal('toggle');
										GotListTable.draw(false);
										Settings.SelectAll = false;
										$("#selectAll").html("全选");
										break;
									default:
										CommonWarning("服务器忙，请稍候再试。");
										break;
								}
							});
							break;
						case 1:
							var data = {};
							data.subareaid = SelectData;
console.log(data);
							url = "admin.subarea.ajax.php?mode=DeleteMore";
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
		function SaveInfo(){
			var flagid = Settings.Flagid;
			var name = $("#SubAreaName").val();
			var firstletter = $("#SubAreaLetter").val();
			var isshow = '0';
			if(name == ""){$("#SubAreaName").focus();CommonWarning('子站名称不能为空！');return;}
			if(firstletter == ""){$("#SubAreaLetter").focus();CommonWarning('子站首字母不能为空！');return;}
			if($("#SubAreaShow").is(':checked')){
				isshow = '1';
			}
			url = "admin.subarea.ajax.php?mode=UpdateSubarea";
			$.post(url, {
				flagid : flagid ,
				name : name ,
				firstletter : firstletter,
				isshow : isshow			
			} ,function(json,status){
console.log(json);
				switch (json){
					case "1":
						$('#SubareaInfo').modal('toggle');
						GotListTable.draw(false);
						Settings.SelectAll = false;
						$("#selectAll").html("全选");
						break;
					default:
						CommonWarning("服务器忙，请稍候再试。");
				}
			});
		}
		
   </script> 
</html>