<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">			
			<table id="CheckResultList" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>资讯标题</th>
						<th>发布时间</th>
						<th>审核结果</th>
						<th>审核人员</th>
						<th>审核时间</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
			<div class="modal fade" id="DetailInfo">  
			  <div class="modal-dialog" style="width:1100px;">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 class="modal-title">资讯信息详情</h5>  
				  </div>  
				  <div class="modal-body text-center">
						<form class="form-horizontal">
							<div class="form-group">
								<label  for='newstitle' class="col-sm-2 control-label">资讯标题</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="newstitle" readonly>
								</div>
							</div>
							<div class="form-group">
								<label for="newscontent" class="col-sm-2 control-label">资讯内容</label>
								<div class="col-sm-9">
									<textarea id="newscontent"  class="form-control" rows="10"></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="other" class="col-sm-2 control-label">其他</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="other" readonly>
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

		function OnLoad(){
			BindEvents();
			ShowCheckList();
		}
		
		function BindEvents(){
			$('#CheckResultList tbody').on( 'click', 'td', function () {
				if ($(this).hasClass('selected') ) {
					$(this).removeClass('selected');
				}
				else {
					GotListTable.$('tr.selected').removeClass('selected');
					$(this).parent().addClass('selected');
					if(GotListTable.row('.selected').data()){
						ShowDetailInfo(GotListTable.row('.selected').data().id);
					}
				}
			}); 
		}
		function ShowCheckList(){
			GotListTable = $('#CheckResultList').DataTable({
				"ajax": {
					"url":"admin.checksupplynewshistory.ajax.php?mode=ShownewsList",
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "id"},
					{ "data": "title"},
					{ "data": "createtime"},
					{ "data": "isallowed"},
					{ "data": "operator"},
					{ "data": "operattime"}
				],	
				// "searching": false,
				"aoColumnDefs":[
					{
						"targets":3,
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
		function ShowCheckList(page){
			Settings.Currentpage = page;
			$("#CheckResultList tbody").html("");
			$("#kkpager").html("");			
			url = "admin.checksupplynewshistory.ajax.php?mode=ShownewsList&currentpage="+page;
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
					var strTbody = '<tr onclick="ShowDetailInfo('+data[i].id+')"><td>'+(i+1)+'</td><td>'+data[i].title+'</td>';
					strTbody+= '<td>'+data[i].content+'</td><td>'+data[i].createtime+'</td><td>'+isallowed+'</td>';
					strTbody+= '<td>'+data[i].operator+'</td><td>'+data[i].operattime+'</td></tr>';
					$("#CheckResultList tbody").append(strTbody);
				}
				kkpager.generPageHtml({
					pno : page,
					total : json.pagecount,
					totalRecords : json.total,
					mode : 'click',//默认值是link，可选link或者click
					click : function(n){
						ShowCheckList(n);
						return false;
					}
				} , true);
			});
		}
*/		
		function ShowDetailInfo(id){
			url = "admin.checksupplynewshistory.ajax.php?mode=ShownewsDetail&id="+id;
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json); 
				if(json == null){
					CommonJustTip('暂无数据。');
					return;
				}
				$('#DetailInfo').modal('toggle');
				$("#firsttype").val(json.title); 
				$("#secondtype").val(json.content); 
				$("#newstitle").val(json.title); 
				$("#newscontent").val(json.content); 
				$("#other").val("审核理由："+json.reason); 
			});
		}		
		
   </script> 
</html>