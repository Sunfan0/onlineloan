<?php	include "supply.header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<form class="navbar-form navbar-left">
						<button id="selectAll" class="btn btn-primary text-right">全选</button>
						<button onclick="OperateSign(); return false;" class="btn btn-primary text-right" style="margin-left: 40px;">标记为已读</button>
					</form>							
				</div>
			</nav>
			<table id="NoticeInfoList" class="table table-hover table-bordered">
				<thead align="center">
					<tr>
						<th>ID</th>
						<th>通知标题</th>
						<th>发送者</th>
						<th>发送时间</th>
						<th>对否已读</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
			<div class="modal fade" id="NoticeInfo">
			  <div class="modal-dialog" style="width:800px;">
				<div class="modal-content message_align">
				  <div class="modal-header">
					<button id="closemodal" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
					<h5 class="modal-title">通知详情</h5>
				  </div>
				  <div class="modal-body text-center">
					<form class="form-horizontal">
						<div class="form-group">
							<label  for="noticetitle" class="col-sm-2 control-label">通知标题</label>
							<div class="col-sm-9">
								<input type="text" id="noticetitle" class="form-control" disabled value='通知标题'>
							</div>
						</div>
						<div class="form-group">
							<label for="noticecontent" class="col-sm-2 control-label">通知内容</label>
							<div class="col-sm-9">
								<textarea id="noticecontent"  class="form-control" rows="10" disabled >通知的详细内容</textarea>
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
			ShowNoticeInfoList();
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
			$("#closemodal").click(function(){
				GotListTable.draw(false);
				Settings.SelectAll = false;
				$("#selectAll").html("全选");
			});
		}
		function ShowNoticeInfoList(){
			GotListTable = $('#NoticeInfoList').DataTable({
				"ajax": {
					"url":"supply.noticelist.ajax.php?mode=ShowList",
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "id"},
					{ "data": "title"},
					{ "data": "operator"},
					{ "data": "sendtime"},
					{ "data": "isread"},
					{ "data": "id"},
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
						"targets":4,
						"render":function(data,type,full){
							switch(data){
								case "1":
									return "已读";
									break;
								case "0":
									return "未读";
									break;
							}
						}
					},
					{
                        'targets': 5,
						'render': function (data, type, row){
							return '<button onclick="ShowNoticeInfo('+data+')" type="button" class="btn btn-primary">查看</button>';
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
		function ShowNoticeInfo(id){
			url = "supply.noticelist.ajax.php?mode=ShowOneNews&id="+id;
			$.get(url,function(json,status){
				if(json=="null"){
					CommonJustTip('暂无数据。');
					return;
				}
				json = eval("("+json+")");
				$('#NoticeInfo').modal({backdrop: 'static', keyboard: false});
console.log(json);
				$("#noticetitle").val(json.title);
				$("#noticecontent").val(json.content);
			});
		}
		function OperateSign(){//标记为已读
			SelectData = new Array();
			$(".checkbox_select:checked").each(function(){
				var d={};
				d.id = $(this).data("id");
				SelectData.push(d);
			})
			if(SelectData.length == 0){
				CommonJustTip("至少选择一条站方通知！");
				return;
			}
			
			$.confirm({
				title: '',
				content: '确定将所有选择的站方通知标记为已读？',
				confirmButton: '确定',
				cancelButton: '取消',
				confirm: function(){
						var data = {};
						data.noticeid = SelectData;
console.log(data);
						url = "supply.noticelist.ajax.php?mode=IsreadMore";
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
   </script>
</html>