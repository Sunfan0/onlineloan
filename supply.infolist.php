<?php	include "supply.header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<form class="navbar-form navbar-left">
						<button id="selectAll" class="btn btn-primary text-right">全选</button>
						<button onclick="BatchOperat(); return false;"  class="btn btn-danger text-right" style="margin-left: 40px;">删除</button>
					</form>
					<form class="navbar-form navbar-right" role="search">
						<button class="btn btn-primary text-right" onclick="ShowGoodsInfo(''); return false;">+ 新增产品</button>
					</form>							
				</div>
			</nav>
			<table id="ContentTable" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>产品名称</th>
						<th>产品介绍</th>
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
			ShowGoodsList();
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
		
		function ShowGoodsList(){
			GotListTable = $('#ContentTable').DataTable({
				"ajax": {
					"url":"supply.infolist.ajax.php?mode=ShowsupplyinfoList",
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容				
					{ "data": "id"},
					{ "data": "productname"},
					{ "data": "Featuresintroduce"},
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
							var strbutton = '<button onclick="ShowGoodsInfo('+data+')" type="button" class="btn btn-primary">编辑</button>'
							strbutton+= '<button onclick="RefreshInfo('+data+');"type="button" class="btn btn-warning" style="margin-left:15px;">刷新</button>';
							return strbutton;
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
				CommonJustTip("至少选择一条产品信息！");
				return;
			}
			var data = {};
			data.supplyinfoid = SelectData;
			$.confirm({
				title: '',
				content: '确定删除所有选中的产品信息？',
				confirmButton: '确定',
				cancelButton: '取消',
				confirm: function(){
					url = "supply.infolist.ajax.php?mode=DeleteMore";
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
		function ShowGoodsInfo(id){
			url = "supply.infolist.ajax.php?mode=CheckRights";
			$.get(url,function(json,status){
console.log(json);
				switch (json){
					case "1":
						window.location.href = "supply.info.php?infoId="+id;
						break;
					case "-9":
						$.confirm({
							title: "",
							content: "抱歉。您的信息不完善，不能发布产品！",
							confirmButton: '去完善信息',
							cancelButton: '取消',
							confirm: function(){
								window.location.href = "supply.changeinfo.php";
							},
							cancel: function(){
								
							}
						});
						break;
					default:
						CommonJustTip('系统错误，请重试!');
						break;
				}
			});
		}
		function RefreshInfo(id){
			url = "supply.infolist.ajax.php?mode=CheckRefreshNum&id="+id;
			$.post(url,function(json,status){
				json = eval("("+json+")");
console.log(json);	
				var leavenum = json.leavenum;
				var needscore = json.needscore;
				if(leavenum>0){
					var strcontent = "您今日的免费刷新次数剩余"+leavenum+"次，您确定刷新该产品信息？";
					var strurl = "supply.infolist.ajax.php?mode=Refreshfree&id="+id;
				}else{
					var strcontent = "您今日的免费刷新次数已经用完，您确定花费"+needscore+"积分刷新该产品信息？";
					var strurl = "supply.infolist.ajax.php?mode=RefreshNeedScore&id="+id;
				}
				$.confirm({
					title: '提示',
					content: strcontent,
					confirmButton: '确定',
					cancelButton: '取消',
					confirm: function(){
						$.post(strurl,function(json,status){
console.log(json);
							switch (json){
								case "1":
									// window.location.reload();
									CommonJustTip('刷新成功。');
									break;
								case "-9":
									CommonJustTip('抱歉，您的积分不足！');
									break;
								default:
									CommonWarning('服务器忙，请稍候再试。');
							}
						});
					},
					cancel: function(){
						return;
					}
				});
			});	
		}
   </script> 
</html>