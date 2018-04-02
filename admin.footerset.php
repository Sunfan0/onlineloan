<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<form class="navbar-form navbar-left">
						<button id="selectAll" class="btn btn-primary text-right">全选</button>
						<button onclick="DeletInfo(1); return false;"  class="btn btn-danger text-right" style="margin-left: 40px;">删除</button>
					</form>
					<form class="navbar-form navbar-right col-sm-3" role="search">
						<button class="btn btn-primary text-right" onclick="AddInfo(); return false;">+ 新增文字内容</button>
					</form>
				</div>
			</nav>
			<table id="ContentTable" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>文字标题</th>
						<th>创建时间</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
			<div class="modal fade" id="FooterSetInfo" style="z-index: 500;">  
			  <div class="modal-dialog">  
				<div class="modal-content message_align" style="width: 800px;">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 id="addTitle" class="modal-title">修改文字信息</h5>  
				  </div>  
				  <div class="modal-body"> 
					  <form class="form-horizontal">
						<div class="form-group">
							<label for="FooterSetTitle" class="col-sm-2 control-label">文字标题</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="FooterSetTitle" placeholder="标题">
							</div>
						</div>
						<div class="form-group">
							<label for="FooterContent" class="col-sm-2 control-label">相关内容</label>
							<div class="col-sm-10">
								<div id="FooterContent" type="text/plain" style="width:635px;height:400px;"></div>
							</div>
						</div>
						<div class="form-group">
							<label for="FooterType" class="col-sm-2 control-label">类型</label>
							<div class="col-sm-10">
								<select class="form-control" id="FooterType">
								</select>
							</div>
						</div>
					</form>
				  </div>  
				  <div class="modal-footer">
					<button id="DeletFooterSetInfo" onclick="DeletInfo(0)" style="margin-right:380px;" type="button" class="btn btn-danger">删除</button>
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
		var ue = UE.getEditor('FooterContent');
	
		window.onload = OnLoad;
		
		function OnLoad(){
			BindEvents();
			ShowFooterSetList();
			FootertypeList();
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
		function FootertypeList(){
			url = "admin.footerset.ajax.php?mode=FootertypeList";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				for(var i=0;i<json.length;i++){
					strTbody = '<option value="'+json[i].id+'">'+json[i].name+'</option>';
					$("#FooterType").append(strTbody);
				}
			});
		}
		function ShowFooterSetList(){
			GotListTable = $('#ContentTable').DataTable({
				"ajax": {
					"url":"admin.footerset.ajax.php?mode=FooterList",
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "id"},
					{ "data": "title"},
					{ "data": "createtime"},
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
							return '<button onclick="ModifyInfo('+data+',(this))" type="button" class="btn btn-primary">编辑</button>';
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
		function ModifyInfo(id){
			Settings.Flagid = id;
			$('#addTitle').text("修改信息");
			UE.getEditor('FooterContent').setContent("");
			$("#FooterSetTitle,#FooterType").val("");
			$('#FooterSetInfo').modal({backdrop: 'static', keyboard: false});
			$(".modal-backdrop").css("z-index","300");
			$("#DeletFooterSetInfo").css('display',''); 
			url = "admin.footerset.ajax.php?mode=ShowFooter&id="+id;
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				$("#FooterSetTitle").val(json[0].title);
				$("#FooterType").val(json[0].typeid);
				UE.getEditor('FooterContent').setContent(json[0].content);
			});
		}
		function AddInfo(){
			Settings.Flagid = "";
			$('#addTitle').text("填写信息");
			UE.getEditor('FooterContent').setContent("");
			$("#FooterSetTitle,#FooterType").val("");
			$('#FooterSetInfo').modal({backdrop: 'static', keyboard: false});
			$(".modal-backdrop").css("z-index","300");
			$("#DeletFooterSetInfo").css('display','none'); 
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
					CommonJustTip("至少选择一条页脚信息！");
					return;
				}
			}
				
			var strcontent;
			switch(batch){
				case 0:
					strcontent = "您确定删除该页脚信息？";
					break;
				case 1:
					strcontent = "您确定删除所有选中的页脚信息？";
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
							url = "admin.footerset.ajax.php?mode=DeleteFooter&id="+Settings.Flagid;
							$.get(url,function(json,status){
console.log(json);
								switch (json){
									case "1":
										$('#FooterSetInfo').modal('toggle');
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
							data.footerid = SelectData;
console.log(data);
							url = "admin.footerset.ajax.php?mode=DeleteMore";
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
			var data = {};
			data.flagid = Settings.Flagid;
			data.title = $("#FooterSetTitle").val();
			data.content = UE.getEditor('FooterContent').getContent();
			data.typeid = $("#FooterType").val();
			if(data.title == ""){$("#FooterSetTitle").focus();CommonWarning('文字标题不能为空！');return;}
			if(data.content == ""){$("#FooterContent").focus();CommonWarning('相关内容不能为空！');return;}
			if(data.typeid == null){$("#FooterType").focus();CommonWarning('类型不能为空！');return;}
			url = "admin.footerset.ajax.php?mode=UpdateFooter";
			$.post(url, {
				data : JSON.stringify(data)
			} ,function(json,status){
console.log(json);
				switch (json){
					case "1":
						$('#FooterSetInfo').modal('toggle');
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