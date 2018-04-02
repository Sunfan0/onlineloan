<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">
			<table id="ContentTable" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>发送用户名</th>
						<th>接收用户名</th>
						<th>接收者身份</th>
						<th>接收者分组</th>
						<th>通知内容</th>
						<th>发送时间</th>
						<th>当前状态</th>
						<th>阅读时间</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</body>
	<?php	include "footer.php";	?>
	<script type="text/javascript">
		var Settings = {};
		var GotListTable;
		
		window.onload = OnLoad;
		
		function OnLoad(){
			BindEvents();
			ShowMsgList();
		}
		function BindEvents(){
			
		}
		function ShowMsgList(){
			GotListTable = $('#ContentTable').DataTable({
				"ajax": {
					"url":"admin.historywebsitenotice.ajax.php?mode=ShowSendNoticeList",
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "id"},
					{ "data": "operator"},
					{ "data": "username"},
					{ "data": "modify"},
					{ "data": "usertype"},
					{ "data": "content"},
					{ "data": "sendtime"},
					{ "data": "isread"},
					{ "data": "readtime"},
				],	
				// "searching": false,
				"aoColumnDefs":[
					{
						"targets":7,
						"render":function(data,type,row){
							console.log(row);
							switch(data){
								case "1":
									return "已读";
									break;
								case "0":
									return "未读";
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
		function ShowMsgList(page){
			$("#ContentTable tbody").html("");
			$("#kkpager").html("");			
			url = "admin.historywebsitenotice.ajax.php?mode=ShowSendNoticeList&currentpage="+page;
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
					var isread = "";
					switch(data[i].isread){
						case "1":
							isread = "已读";
							break;
						case "0":
							isread = "未读";
							break;
					}
					var strTbody = '<tr><td>'+(i+1)+'</td><td>'+data[i].operator+'</td>';
					strTbody+= '<td>'+data[i].username+'</td><td>'+data[i].content+'</td><td>'+data[i].sendtime+'</td>';
					strTbody+= '<td>'+isread+'</td><td>'+data[i].readtime+'</td></tr>';
					$("#ContentTable tbody").append(strTbody);
				}
				kkpager.generPageHtml({
					pno : page,
					total : json.pagecount,
					totalRecords : json.total,
					mode : 'click',//默认值是link，可选link或者click
					click : function(n){
						ShowMsgList(n);
						return false;
					}
				} , true);
			});
		}
*/
   </script> 
</html>