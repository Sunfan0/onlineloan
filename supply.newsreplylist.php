<?php	include "supply.header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">
			<table id="NewsInfoList" class="table table-hover table-bordered">
				<thead align="center">
					<tr>
						<th>ID</th>
						<th>资讯标题</th>
						<th>发布人员</th>
						<th>发布者身份</th>
						<th>发布时间</th>
						<th>回复信息条数</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
	
			<div class="modal fade" id="NewsInfo">  
			  <div class="modal-dialog" style="width:1100px;">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 class="modal-title">资讯回复履历</h5>  
				  </div>  
				  <div class="modal-body">
					<nav class="navbar navbar-default" role="navigation">
						<div class="container-fluid">
							<form class="navbar-form navbar-left">
								<button id="selectAll" class="btn btn-primary text-right">全选</button>
								<button onclick="Updatereply(1,1,1); return false;"  class="btn btn-primary text-right" style="margin-left: 40px;">取消屏蔽</button>
								<button onclick="Updatereply(-1,1,1); return false;"  class="btn btn-danger text-right" style="margin-left: 5px;">屏蔽</button>
							</form>						
						</div>
					</nav>
					<table id='NewsInfoTable' class="table table-hover table-bordered" style="width:100%;">
						<thead>
							<tr>
								<th>ID</th>
								<th>用户名</th>
								<th>回复内容</th>
								<th>回复时间</th>
								<th>屏蔽状态</th>
								<th>操作</th>
							</tr>
						</thead>
						<tbody></tbody>
					</table>
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
		var GotInfoTable;

		window.onload = OnLoad;

		<?php $timestamp = time();?>
		
		function OnLoad(){
			BindEvents();
			ShowNewsInfoList();
		}
		function BindEvents(){
			$('#NewsInfoList tbody').on( 'click', 'td', function () {
				if ($(this).hasClass('selected') ) {
					$(this).removeClass('selected');
				}
				else {
					GotListTable.$('tr.selected').removeClass('selected');
					$(this).parent().addClass('selected');
					if(GotListTable.row('.selected').data()){
						ShowNewsInfo(GotListTable.row('.selected').data().id);
					}
				}
			}); 
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
		function ShowNewsInfoList(){
			GotListTable = $('#NewsInfoList').DataTable({
				"ajax": {
					"url":"supply.newsreplylist.ajax.php?mode=NewsList",
					"type":"POST"
				},
				// "processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "id"},
					{ "data": "title"},
					{ "data": "publishname"},
					{ "data": "username"},
					{ "data": "createtime"},
					{ "data": "cnt"}
				],
				"aoColumnDefs": [
					{
                        'targets': 2,
						'render': function (data, type, row){
							if(row.username == null || row.username == ""){
								return row.publishname; 
							}
							if(row.publishname == null || row.publishname == ""){
								return row.username;
							}
						}
                    },
					{
                        'targets': 3,
						'render': function (data, type, row){
							if(row.username == null || row.username == ""){
								return "站方"; 
							}
							if(row.publishname == null || row.publishname == ""){
								return "供方";
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
			Settings.Currentlistid = id;
			if(GotInfoTable){
				GotInfoTable.destroy();
				Settings.SelectAll = false;
				$("#selectAll").html("全选");
			}
			GotInfoTable = $('#NewsInfoTable').DataTable({
				"ajax": {
					"url":"supply.newsreplylist.ajax.php?mode=replylist&id="+id,
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "id"},
					{ "data": "zname"},
					{ "data": "content"},
					{ "data": "replytime"},	
					{ "data": "isstop"},
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
                        'targets': 1,
						'render': function (data, type, row){
							if(row.zname!=""){
								return row.zname;
							}
							if(row.dname!=""){
								return row.dname;
							}
							if(row.sname!=""){
								return row.sname;
							}
						}
                    },
					{
                        'targets': 4,
						'render': function (data, type, row){
							switch(data){
								case "1":
									isstop = "未屏蔽";
									break;
								case "-1":
									isstop = "已屏蔽";
									break;
								case "0":
									isstop = "未处理";
									break;
							}
							return isstop;
						}
                    },
					{
                        'targets': 5,
						'render': function (data, type, row){
							switch(row.isstop){
								case "1":
									strbtn = '<button onclick="Updatereply(-1,'+data+',0)" class="btn btn-danger btn-sm">屏蔽</button>&nbsp;&nbsp;';
									break;
								case "-1":
									strbtn = '<button onclick="Updatereply(1,'+data+',0)" class="btn btn-primary btn-sm">取消屏蔽</button>';
									break;
								case "0":
									strbtn = '<button onclick="Updatereply(-1,'+data+',0)" class="btn btn-danger btn-sm">屏蔽</button>&nbsp;&nbsp;';
									// strbtn+= '<button onclick="Updatereply(1,'+data+',0)" class="btn btn-primary btn-sm">取消屏蔽</button>';
									break;
							}
							return strbtn;
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
				$('#NewsInfo').modal({backdrop: 'static', keyboard: false});
			} );
		}
		function Updatereply(type,id,batch){
			SelectData = new Array();
			if(batch == 1){
				$(".checkbox_select:checked").each(function(){
					var d={};
					d.id = $(this).data("id");
					SelectData.push(d);
				})
				if(SelectData.length == 0){
					CommonJustTip("至少选择一条供方资讯回复履历！");
					return;
				}
			}
			var strcontent;
			switch(type){
				case -1:
					strcontent = "<p style='color:black;'>请在下面输入你屏蔽的理由：</p><textarea rows='3' class='form-control' id='userreason'></textarea>";
					break;
				case 1:
					strcontent = "<p style='color:black;'>请在下面输入你取消屏蔽的理由：</p><textarea rows='3' class='form-control' id='userreason'></textarea>";
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
							var reason = $("#userreason").val();
							url = "supply.newsreplylist.ajax.php?mode=Updatereply&type="+type+"&id="+id+"&reason="+reason;
							$.get(url,function(json,status){
console.log(json);
								switch (json){
									case "1":
										ShowNewsInfo(Settings.Currentlistid);
										GotInfoTable.draw(false);
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
							data.replyid = SelectData;
							data.status = type;
							data.reason = $("#userreason").val();
console.log(data);
							url = "supply.newsreplylist.ajax.php?mode=UpdateMorereply";
							$.get(url,{
								data : JSON.stringify(data)
							},function(json,status){
console.log(json);
								switch (json){
									case "1":
										GotInfoTable.draw(false);
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
/*		
		function ShowNewsInfoList(){		
			$("#NewsInfoList tbody").html("");
			url = "supply.newsreplylist.ajax.php?mode=NewsList";
			$.get(url,function(json,status){
				if(json=="123"){
					CommonNopower();
					$("#Maincontainer").addClass("hidden");
					return;
				}
				if(json=="null"){
					CommonJustTip('暂无数据。');
					return;
				}
				json = eval("("+json+")");
console.log(json);
				for(var i=0;i<json.length;i++){
					var pId = "";
					var pname = "";
					if(json[i].username == null || json[i].username == ""){
						pname = json[i].publishname; 
						pId = "站方"; 
					}
					if(json[i].publishname == null || json[i].publishname == ""){
						pname = json[i].username;
						pId = "供方";
					}
					var strTbody = '<tr id="newsreplylist'+json[i].id+'" onclick="ShowNewsInfo('+json[i].id+')"><td>'+(i+1)+'</td><td>'+json[i].title+'</td>';
					strTbody+= '<td>'+pname+'</td><td>'+pId+'</td>';
					strTbody+= '<td>'+json[i].createtime+'</td><td>'+json[i].cnt+'</td></tr>';
					$("#NewsInfoList tbody").append(strTbody);
				}
			});
		}
		function ShowNewsInfo(id){
			$("#NewsInfoTable tbody").html("");
			url = "supply.newsreplylist.ajax.php?mode=replylist&id="+id;
			$.get(url,function(json,status){
				if(json=="null"){
					CommonJustTip('暂无数据。');
					return;
				}
				json = eval("("+json+")");
				$('#NewsInfo').modal({backdrop: 'static', keyboard: false});
console.log(json);
				for(var i=0;i<json.length;i++){	
					var isstop = "";
					var strbtn = "";
					if(json[i].zname!=""){
						repliername=json[i].zname;
					}
					if(json[i].dname!=""){
						repliername=json[i].dname;
					}
					if(json[i].sname!=""){
						repliername=json[i].sname;
					}
					switch(json[i].isstop){
						case "1":
							isstop = "未屏蔽";
							strbtn = '<button onclick="Updatereply(-1,'+json[i].id+')" class="btn btn-primary btn-sm">屏蔽</button>&nbsp;&nbsp;';
							break;
						case "-1":
							isstop = "已屏蔽";
							strbtn = '<button onclick="Updatereply(1,'+json[i].id+')" class="btn btn-primary btn-sm">取消屏蔽</button>';
							break;
						case "0":
							isstop = "未处理";
							strbtn = '<button onclick="Updatereply(-1,'+json[i].id+')" class="btn btn-primary btn-sm">屏蔽</button>&nbsp;&nbsp;';
							strbtn+= '<button onclick="Updatereply(1,'+json[i].id+')" class="btn btn-primary btn-sm">取消屏蔽</button>';
							break;
					}
					var strTbody = '<tr id="newsreplylist'+json[i].id+'"><td>'+repliername+'</td>';
					strTbody+= '<td>'+json[i].content+'</td><td>'+json[i].replytime+'</td>';
					strTbody+= '<td>'+isstop+'</td><td>'+strbtn+'</td></tr>';
					$("#NewsInfoTable tbody").append(strTbody);
				}
			});
		}
*/
   </script> 
</html>