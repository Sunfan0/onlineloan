<?php	include "supply.header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<form class="navbar-form navbar-left">
						<button id="selectAll" class="btn btn-primary text-right">全选</button>
						<button onclick="NewsRecover(1); return false;"  class="btn btn-primary text-right" style="margin-left: 40px;">恢复</button>
					</form>
				</div>
			</nav>
			<table id="ContentTable" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>资讯标题</th>
						<th>创建时间</th>
						<th>删除时间</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
			<div class="modal fade" id="NewsInfo">  
			  <div class="modal-dialog" style="width:1100px;">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 class="modal-title">该资讯的详细信息</h5>  
				  </div>  
				  <div class="modal-body text-center"> 
						<form class="form-horizontal">
							<div class="form-group">
								<label for="newstitle" class="col-sm-2 control-label">资讯标题</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="newstitle" disabled>
								</div>
								<label for="newimgurl" class="col-sm-2 control-label">资讯头图</label>
								<div class="col-sm-4 text-left" style="position: absolute;left: 730px;">
									<img class="img-thumbnail" style="max-width: 130px;max-height: 130px;" id="newimgurl">
								</div>
							</div>
							<div class="form-group">
								<label for="newcreatetime" class="col-sm-2 control-label">创建时间</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="newcreatetime" disabled>
								</div>
							</div>
							<div class="form-group">
								<label for="newrecycletime" class="col-sm-2 control-label">删除时间</label>
								<div class="col-sm-4">
									<input type="text" class="form-control" id="newrecycletime" disabled>
								</div>
							</div>
							<!--<div class="form-group">
								<label  for='newstitle' class="col-sm-2 control-label">资讯标题</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="newstitle" disabled>
								</div>
							</div>-->
							<div class="form-group">
								<label for="newscontent" class="col-sm-2 control-label">资讯内容</label>
								<div class="col-sm-9">
									<div id="newscontent" type="text/plain" style="width:790px;height:450px;" disabled></div>
									<!--<textarea id="newscontent" type="text" class="form-control" row="5"  disabled></textarea>-->
								</div>
							</div>
						</form>	
				  </div> 
				  <div class="modal-footer">
					<button onclick="NewsRecover(0);" type="button" class="btn btn-primary">恢复</button>
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
			ShowNewsList();
			var ue = UE.getEditor('newscontent');
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
		function ShowNewsList(){
			GotListTable = $('#ContentTable').DataTable({
				"ajax": {
					"url":"supply.newsrecycle.ajax.php?mode=ShownewsList",
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "id"},
					{ "data": "title"},
					{ "data": "createtime"},				
					{ "data": "recycletime"},				
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
							return '<button onclick="ShowNewsInfo('+data+')" type="button" class="btn btn-primary">编辑</button>';
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
		}
		function ShowNewsInfo(id){
			Settings.Flagid = id;
			url = "supply.newsrecycle.ajax.php?mode=Shownewsdetail&id="+id;
			$.get(url,function(json,status){
				json = eval("("+json+")");
// console.log(json); 
				$("#newstitle").val(json.title);
				$("#newcreatetime").val(json.createtime);
				$("#newrecycletime").val(json.recycletime);
				$("#newimgurl").attr("src",json.image);
				UE.getEditor('newscontent').setContent(json.content);
				$('#NewsInfo').modal('toggle');
			});
		}
		
		function NewsRecover(batch){
			SelectData = new Array();
			if(batch == 1){
				$(".checkbox_select:checked").each(function(){
					var d={};
					d.id = $(this).data("id");
					SelectData.push(d);
				})
				if(SelectData.length == 0){
					CommonJustTip("至少选择一条资讯信息！");
					return;
				}
			}
				
			var strcontent;
			switch(batch){
				case 0:
					strcontent = "您确定恢复该资讯？";
					break;
				case 1:
					strcontent = "您确定恢复所有选中的资讯？";
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
							url = "supply.newsrecycle.ajax.php?mode=NewsRecover&id="+Settings.Flagid;
							$.get(url,function(json,status){
console.log(json);
								switch (json){
									case "1":
										$('#NewsInfo').modal('toggle');
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
							data.newsid = SelectData;
console.log(data);
							url = "supply.newsrecycle.ajax.php?mode=MoreNewsRecover";
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