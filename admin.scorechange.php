<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">			
			<table id="scoreobtainList" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>姓名</th>
						<th>总计获得积分</th>
						<th>总计扣除积分</th>
						<th>总计当前积分</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
			<div class="modal fade" id="scoreobtainInfo">  
			  <div class="modal-dialog" style="width:900px;">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
				  </div>  
				  <div class="modal-body text-center">  
					<table class="table  table-bordered">
						<thead>
							<tr>
								<th colspan='3' style='text-align:center'>用户积分调整</th>
							</tr>
						</thead>
						<tr>
							<td>用户</td>
							<td colspan="2">
								<img id="userimg1" style="width:50px;height:50px;" src="">
								<span id="username1"></span>
							</td>
						</tr>
						<tr>
							<td>当前可用积分</td>
							<td>
								<span id="currentscore1"></span>
							</td>
							<td style="width: 50px;">
								<button type="button" class="btn btn-primary " id="changescore">调整</button>
							</td>
						</tr>
						<!--<tr>
							<td>调整后积分</td>
							<td>
								<span id="afterscore1"></span>
							</td>
						</tr>-->
						<tr>
							<td style="width:120px;">积分履历</td>
							<td colspan="2">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th style="text-align: center;">变更理由</th>
											<th style="text-align: center;">变更前</th>
											<th style="text-align: center;">变更</th>
											<th style="text-align: center;">变更后</th>
											<th style="text-align: center;">操作员</th>
											<th style="text-align: center;">操作时间</th>
										</tr>
									</thead>
									<tbody id='scoreobtainTable'></tbody>
								</table>	
							</td>
						</tr>
					</table>	
				  </div>   
				</div>
			  </div>
			</div>
			
			<div class="modal fade" id="scorechangeinfo" >  
			  <div class="modal-dialog" style="width:900px;">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
				  </div>  
				  <div class="modal-body text-center">  
					<table class="table table-bordered">
						<thead>
							<tr>
								<th colspan='2' style='text-align:center'>用户积分调整</th>
							</tr>
						</thead>
						<tr>
							<td>用户</td>
							<td>
								<img id="userimg2" style="width:50px;height:50px;" src="">
								<span id="username2"></span>
							</td>
						</tr>
						<tr>
							<td>当前可用积分</td>
							<td>
								<span id="currentscore2"></span>
							</td>
						</tr>
						<tr>
							<td>调整</td>
							<td>
								<table class="table  table-bordered">
									<tr>
										<td>
											<label><input type="radio" name="changeCheckbox" class="changeCheckbox" value="1" checked>增加</label>
											<label><input type="radio" name="changeCheckbox"  class="changeCheckbox" value="-1">扣除</label>
										</td>
									</tr>
									<tr>
										<td>
											<input type="number" id="changenum" class="form-control" placeholder="调整积分数值" >
										</td>
									</tr>
									<tr>
										<td>
											<textarea id="changereason"  class="form-control" rows="5" placeholder="调整理由" ></textarea>
										</td>
									</tr>
								</table>	
							</td>
						</tr>
						
						<tr>
							<td colspan='2'>
								<button type="button" class="btn btn-primary " id="updatescore">更新</button>
							</td>
						</tr>
						
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
		var GotListTable;
		window.onload = OnLoad;

		function OnLoad(){
			BindEvents();
			ShowscoreobtainList();
		}
		function BindEvents(){
			$('#scoreobtainList tbody').on( 'click', 'td', function () {
				if ($(this).hasClass('selected') ) {
					$(this).removeClass('selected');
				}
				else {
					GotListTable.$('tr.selected').removeClass('selected');
					$(this).parent().addClass('selected');
					if(GotListTable.row('.selected').data()){
						ShowscoreInfo(GotListTable.row('.selected').data().id);
					}
				}
			}); 
			$("#changescore").click(function(){
				$("#changenum").val('');
				$("#changereason").val('');
				$('#scorechangeinfo').modal('toggle');
			})
			$("#updatescore").click(function(){
				UpdateSupplierScore();
			})
		}

		function ShowscoreobtainList(){
			$("#scoreobtainList tbody").html("");
			GotListTable = $('#scoreobtainList').DataTable({
				"ajax": {
					"url":"admin.scorechange.ajax.php?mode=SupplierScore",
					"type":"POST"
				},
				// "processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "id"},
					{ "data": "username"},
					{ "data": "afterscore"},
					{ "data": "getscore"},
					{ "data": "changescore"}
				],
				"oLanguage": {
					"sLengthMenu": "显示 _MENU_ 条记录",
					"sSearch": "搜索:",
					"sInfo": "显示第 _START_ - _END_ 条记录，共 _TOTAL_ 条",
					"sInfoEmpty": "没有符合条件的记录",
					"sZeroRecords": "没有符合条件的记录"
				},				
				"searching": false,				
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
			} );
		}
		function ShowscoreInfo(id){
			Settings.CurrentId = id;
			$("#scoreobtainTable").html("");
			$("#kkpager").html("");
			$("#userimg1").attr('src',"");
			$("#username1,#currentscore1").html("");
			// $("#afterscore1").html("");
			$('#scoreobtainInfo').modal({backdrop: 'static', keyboard: false});
			url = "admin.scorechange.ajax.php?mode=ShowSupplierInfo&supplierid="+id;
			$.post(url,function(json,status){
				json = eval("("+json+")");
				if(json == null){
					return;
				}
console.log(json);
				$("#userimg1,#userimg2").attr('src',json.imgurl);
				$("#username1,#username2").html(json.username);
				$("#currentscore1,#currentscore2").html(json.score);
			});	
			url = "admin.scorechange.ajax.php?mode=SupplierScoreDetail&supplierid="+id;
			$.post(url,function(json,status){
				json = eval("("+json+")");
				if(json == null){
					return;
				}
console.log(json);
				for(var i=0;i<json.length;i++){
					var strTbody = '<tr><td>'+json[i].reason+'</td>';
					strTbody+= '<td>'+json[i].beforescore+'</td><td>'+json[i].changescore+'</td><td>'+json[i].afterscore+'</td>';
					strTbody+= '<td>'+json[i].operator+'</td><td>'+json[i].operattime+'</td></tr>';
					$("#scoreobtainTable").append(strTbody);
				}
			});	
		}
		function UpdateSupplierScore(){
			var type = $(".changeCheckbox:checked").val();
			var scorenum =$("#changenum").val();
			var scorereason=$("#changereason").val();
			if(scorenum == ""){$("#changenum").focus();CommonWarning('积分数值不能为空！');return;}
			if(scorereason == ""){$("#changereason").focus();CommonWarning('调整理由不能为空！');return;}
			url = "admin.scorechange.ajax.php?mode=UpdateSupplierScore";
			$.post(url,{
				supplierid : Settings.CurrentId,
				type : type,
				scorenum : scorenum,
				scorereason : scorereason
			},function(json,status){
console.log(json);
				if(json == 1){
					$('#scorechangeinfo').modal('toggle');
					GotListTable.draw(false);
					ShowscoreInfo(Settings.CurrentId);
					CommonJustTip('更新成功！');
				}else
					CommonJustTip('服务器忙，请稍候再试。');
			});	
		}
   </script> 
</html>