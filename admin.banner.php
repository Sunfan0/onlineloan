<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<form class="navbar-form navbar-left">
						<button id="selectAll" class="btn btn-primary text-right">全选</button>
						<button onclick="DeletInfo(1); return false;"  class="btn btn-danger text-right" style="margin-left: 40px;">删除</button>
					</form>
					<form class="navbar-form navbar-right" role="search">
						<button class="btn btn-primary text-right" onclick="AddInfo(); return false;">+ 新增banner</button>
					</form>							
				</div>
			</nav>
			<table id="ContentTable" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>banner文字</th>
						<th>banner简介</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
			<div class="modal fade" id="BannerInfo">
			  <div class="modal-dialog" style="width:800px;">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 id="AddTitle" class="modal-title">修改信息</h5>  
				  </div>  
				  <div class="modal-body">  
					<form class="form-horizontal">
						<div class="form-group">
							<label for="bannerText" class="col-sm-2 control-label">banner文字</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="bannerText" placeholder="banner文字">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">banner图片</label>
							<div class="col-sm-10" style="text-align: left;">
								<input id="images" name="images[]" type="file" multiple data-min-file-count="1">
							</div>
						</div>
						<div class="form-group">
							<label for="bannerDescribe" class="col-sm-2 control-label">banner简介</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="bannerDescribe" placeholder="banner简介">
							</div>
						</div>
						<div class="form-group">
							<label for="bannerUrl" class="col-sm-2 control-label">banner链接</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="bannerUrl" placeholder="banner链接">
							</div>
						</div>
					</form>
				  </div>  
				  <div class="modal-footer">
					<button id="DeletBannerInfo" onclick="DeletInfo(0)" style="margin-right:570px;" type="button" class="btn btn-danger">删除</button>
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
		Settings.imgurl = "";
		var GotListTable;
		
		
		window.onload = OnLoad;
		// var arrimg=new Array();
		function OnLoad(){
			BindEvents();
			ShowBannerList();
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
			$('#images').fileinput({
				language: 'zh',
				uploadAsync: true,
				uploadUrl: 'bootstrap-fileinput-upload.php',
				allowedFileExtensions : ['jpg', 'png','gif',"pdf"],
				uploadExtraData: function() {
					return {
					};
				},
				//initialPreview: data.files,
				initialPreviewAsData: true,
				overwriteInitial: false,
				showUpload: false,
				showDrag: false,
				//initialPreviewConfig: data.preview,
				maxFileCount:1, 
				maxFileSize:400,
				// msgFilesTooMany: "选择上传的文件数量({n}) 超过允许的最大数值{m}！",
			}).on('fileselect', function(event, numFiles, label) {
				$('#images').fileinput('upload');
			}).on('fileuploaded', function(event, data, previewId, index) {//上传成功回调
				//alert(data.response.uploaded[0].file);
				// arrimg.push(data.response.uploaded[0].file);
				Settings.imgurl = data.response.uploaded[0].file;
			});
		}
		function ShowBannerList(){
			GotListTable = $('#ContentTable').DataTable({
				"ajax": {
					"url":"admin.banner.ajax.php?mode=BannerList",
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "id"},
					{ "data": "text"},
					{ "data": "shortdesc"},
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
							return '<button onclick="ModifyInfo('+data+')" type="button" class="btn btn-primary">编辑</button>';
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
			$('#AddTitle').text("修改banner信息");
			$("#bannerText,#bannerDescribe,#bannerUrl").val("");
			$('#BannerInfo').modal({backdrop: 'static', keyboard: false});
			$("#DeletBannerInfo").css('display','');
			$('#images').fileinput('refresh', {initialPreview:""});
			url = "admin.banner.ajax.php?mode=ShowBanner&id="+id;
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				$("#bannerText").val(json.text);
				$("#bannerDescribe").val(json.shortdesc);
				$("#bannerUrl").val(json.linkurl);
				$('#images').fileinput('refresh', {initialPreview: [json.imgurl]});
				Settings.imgurl = json.imgurl;
			});
		}
		function AddInfo(){
			Settings.Flagid = "";
			$('#AddTitle').text("填写banner信息");
			$("#bannerText,#bannerDescribe,#bannerUrl").val("");
			$('#BannerInfo').modal({backdrop: 'static', keyboard: false});
			$("#DeletBannerInfo").css('display','none');
			$('#images').fileinput('refresh', {initialPreview:""});
		}
		function SaveInfo(){
			var flagid = Settings.Flagid;
			var text = $("#bannerText").val();
			var imgurl = Settings.imgurl;
			var shortdesc = $("#bannerDescribe").val();
			var linkurl = $("#bannerUrl").val();
			if(text == ""){$("#bannerText").focus();CommonWarning('banner文字不能为空！');return;}
			if(imgurl == ""){$("#images").focus();CommonWarning('banner图片不能为空！');return;}
			if(shortdesc == ""){$("#bannerDescribe").focus();CommonWarning('banner简介不能为空！');return;}
			if(linkurl == ""){$("#bannerUrl").focus();CommonWarning('banner链接不能为空！');return;}
			url = "admin.banner.ajax.php?mode=UpdateBanner";
			$.post(url, {
				flagid : flagid,
				text : text,
				imgurl : imgurl,
				shortdesc : shortdesc,
				linkurl : linkurl		
			} ,function(json,status){
console.log(json);
				switch (json){
					case "1":
						$('#BannerInfo').modal('toggle');
						GotListTable.draw(false);
						Settings.SelectAll = false;
						$("#selectAll").html("全选");
						break;
					default:
						CommonWarning("服务器忙，请稍候再试。");
				}
			});
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
					CommonJustTip("至少选择一条banner！");
					return;
				}
			}
				
			var strcontent;
			switch(batch){
				case 0:
					strcontent = "您确定删除该banner？";
					break;
				case 1:
					strcontent = "您确定删除所有选中的banner？";
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
							url = "admin.banner.ajax.php?mode=DeleteBanner&id="+Settings.Flagid;
							$.get(url,function(json,status){
console.log(json);
								switch (json){
									case "1":
										$('#BannerInfo').modal('toggle');
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
							data.bannerid = SelectData;
console.log(data);
							url = "admin.banner.ajax.php?mode=DeleteMore";
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