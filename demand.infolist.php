<?php	include "demand.header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<form class="navbar-form navbar-left">
						<button id="selectAll" class="btn btn-primary text-right">全选</button>
						<button onclick="BatchOperat(); return false;"  class="btn btn-danger text-right" style="margin-left: 40px;">删除</button>
					</form>
					<form class="navbar-form navbar-right" role="search">
						<button class="btn btn-primary text-right" onclick="ShowDemandInfo(''); return false;">+ 新增需求信息</button>
					</form>							
				</div>
			</nav>
			<table id="ContentTable" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>姓名</th>
						<th>需求金额</th>
						<th>发布状态</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</body>
	<?php	include "footer.php";	?>
	<script type="text/javascript">
		var Settings = {};
		Settings.SelectAll = false;
		var GotListTable;

		window.onload = OnLoad;

		<?php $timestamp = time();?>
		
		function OnLoad(){
			BindEvents();
			ShowDemandinfoList();
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
		function ShowDemandinfoList(){
			GotListTable = $('#ContentTable').DataTable({
				"ajax": {
					"url":"demand.infolist.ajax.php?mode=ShowdemandinfoList",
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容				
					{ "data": "id"},
					{ "data": "name"},
					{ "data": "demandnum"},
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
                        'targets': 3,
						'render': function (data, type, row){
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
                    },
					{
                        'targets': 4,
						'render': function (data, type, row){
							return '<button onclick="ShowDemandInfo('+data+')" type="button" class="btn btn-primary">编辑</button>';
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
		function BatchOperat(){
			SelectData = new Array();
			$(".checkbox_select:checked").each(function(){
				var d={};
				d.id = $(this).data("id");
				SelectData.push(d);
			})
			if(SelectData.length == 0){
				CommonJustTip("至少选择一条产品需求信息！");
				return;
			}
			var data = {};
			data.demandinfoid = SelectData;
			$.confirm({
				title: '',
				content: '确定删除所有选中的需求信息？',
				confirmButton: '确定',
				cancelButton: '取消',
				confirm: function(){
					url = "demand.infolist.ajax.php?mode=DeleteMore";
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
				},
				cancel: function(){
					return;
				}
			});
		}
		function ShowDemandInfo(id){
			window.location.href = "demand.info.php?demandId="+id;
		}
   </script> 
</html>