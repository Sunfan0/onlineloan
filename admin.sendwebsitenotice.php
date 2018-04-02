<?php	include "header.php";	?>
		<div id="Maincontainer" class="container" style="margin-top:20px;width:800px;">
			<div class="panel panel-default" style='width:800px'>
				<div class="panel-heading">
					<h3 class="panel-title">
						发送通知
					</h3>
				</div>
				<div class="panel-body" >
					<form class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-2 control-label">用户选择</label>
							<div class="col-sm-10">
								<!--<button id="selectbtn-all" type="button" class="btn btn-primary">全部用户</button> 
								<button id="selectbtn-supply" type="button" class="btn btn-primary" style="margin-left:15px;">供方用户</button> 
								<button id="selectbtn-demand" type="button" class="btn btn-primary" style="margin-left:15px;">需方用户</button>-->
								<button id="selectbtn-group" type="button" class="btn btn-primary">选择用户</button>
							</div>
						</div>
						<div id="SupplierChoice"  class="form-group hidden" style="overflow-wrap: break-word;">
							<label class="col-sm-2 control-label"></label>
							<div id="SupplierChoicename" class="col-sm-10"></div>
						</div>
						<div id="DemanderChoice"  class="form-group hidden" style="overflow-wrap: break-word;">
							<label class="col-sm-2 control-label"></label>
							<div id="DemanderChoicename" class="col-sm-10"></div>
						</div>
						<div class="form-group">
							<label  for="noticetitle" class="col-sm-2 control-label">通知标题</label>
							<div class="col-sm-10">
								<input type="text" id="noticetitle" class="form-control"> 
							</div>
						</div>
						<div class="form-group">
							<label for="noticecontent" class="col-sm-2 control-label">通知内容</label>
							<div class="col-sm-10">
								<textarea id="noticecontent"  class="form-control" rows="10"></textarea>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-5"></div>
							<div class="col-sm-7">
								<button id="btnsend" type="button" class="btn btn-primary">确定发送</button> 
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="modal fade" id="DetailInfoGroup">  
			  <div class="modal-dialog" style="width:800px;margin-top: 100px;">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 class="modal-title">用户选择</h5>  
				  </div>  
				  <div class="modal-body text-center">  
						<table id="GroupList" class="table table-hover table-bordered">
							<thead>
								<tr>
									<th colspan="2"  style="text-align:center;">
										<input type="radio" name="selecttypebtn" id="selectbtn-supply" value="1" checked style="margin-right:5px;vertical-align:text-bottom;"><span style="vertical-align:middle;">供方用户</span>
										<input type="radio" name="selecttypebtn" id="selectbtn-demand" value="2" style="margin:0 5px 0 20px;vertical-align:text-bottom;"><span style="vertical-align:middle;">需方用户</span>
									</th>
								</tr>
							</thead>
							<tbody id="supplytbody">
									<tr>
										<td align="right" width="10%">身份</td>
										<td align="left">
											<input type="radio" class="supplygroup" name="supplygroup" value="0" checked style="margin:0 5px 0 0px;vertical-align:text-bottom;"><span style="vertical-align:middle;">全部</span>
											<input type="radio" class="supplygroup" name="supplygroup" value="1" style="margin:0 5px 0 20px;vertical-align:text-bottom;"><span style="vertical-align:middle;">中介</span>
											<input type="radio" class="supplygroup" name="supplygroup" value="2" style="margin:0 5px 0 20px;vertical-align:text-bottom;"><span style="vertical-align:middle;">机构</span>
										</td>
									</tr>
									<tr>
										<td align="right" width="10%">用户</td>
										<td align="left">
											<table id="supplyusertable" class="table table-hover table-bordered">
												<thead>
													<tr>
														<th>ID</th>
														<th>用户名</th>
														<th width="40%">操作
															<u onclick="CheckAll('supplyusercheck',1);"  style="margin-left:50%;font-weight: normal;">全选</u>
															<span>/</span>
															<u onclick="CheckAll('supplyusercheck',-1);" style="font-weight: normal;">全不选</u>
														</th>
													</tr>
												</thead>
												<tbody></tbody>
											</table>
											<div id="kkpager1" class="kkpager"></div>
										</td>
									</tr>
							</tbody>
							<tbody id="demandertbody" style="display:none;">
								<tr>
									<td align="right"  width="10%">身份</td>
									<td align="left">
										<input type="radio" class="demandergroup" name="demandergroup" value="0" checked style="margin:0 5px 0 0px;vertical-align:text-bottom;"><span style="vertical-align:middle;">全部</span>
										<input type="radio" class="demandergroup" name="demandergroup" value="1" style="margin:0 5px 0 20px;vertical-align:text-bottom;"><span style="vertical-align:middle;">中介</span>
										<input type="radio" class="demandergroup" name="demandergroup" value="2" style="margin:0 5px 0 20px;vertical-align:text-bottom;"><span style="vertical-align:middle;">机构</span>
									</td>
								</tr>
								<tr>
									<td align="right"  width="10%">用户</td>
									<td align="left">
										<table id="demanderusertable" class="table table-hover table-bordered">
											<thead>
												<tr>
													<th>ID</th>
													<th>用户名</th>
													<th width="40%">操作
														<u onclick="CheckAll('demanderusercheck',1);"  style="margin-left:50%;font-weight: normal;">全选</u>
														<span>/</span>
														<u onclick="CheckAll('demanderusercheck',-1);" style="font-weight: normal;">全不选</u>
													</th>
												</tr>
											</thead>
											<tbody></tbody>
										</table>
										<div id="kkpager2" class="kkpager"></div>
									</td>
								</tr>
							</tbody>
						</table>
						<div style="text-align: right;">
							<button id="confirmgroupbtn" type="button" class="btn btn-primary">确定</button> 
						</div>
				  </div>   
				</div>
			  </div>
			</div>
		</div>
	</body>
	<?php	include "footer.php";	?>
	<script type="text/javascript">
		var Settings = {};
		Settings.Currentlist = "SupplierList";
		var DemanderListData = new Array();
		var SupplierListData = new Array();
		
		window.onload = OnLoad;
		
		function OnLoad(){
			BindEvents();
			TestPower();
		}
		function BindEvents(){
			$("#selectbtn-group").click(function(){
				$('#DetailInfoGroup').modal('toggle');
			})
			$("#selectbtn-supply").click(function(){			
				$("#demandertbody").css("display","none");
				$("#supplytbody").css("display","");
				Settings.Currentlist = "SupplierList";
			})				
			$("#selectbtn-demand").click(function(){		
				$("#demandertbody").css("display","");
				$("#supplytbody").css("display","none");
				Settings.Currentlist = "DemanderList";
			})
			$(".supplygroup").click(function(){
				Settings.Currentlist = "SupplierList";
				ShowAllUserList(1);
			})
			$(".demandergroup").click(function(){
				Settings.Currentlist = "DemanderList";
				ShowAllUserList(1);
			})
			
			$("#confirmgroupbtn").click(function(){
				SupplierListData = [];
				strsupply = "";
				$(".supplyusercheck:checked").each(function(){
					SupplierListData.push($(this).val());
					strsupply+=$(this).parent().prev().html()+",";
				})
				if(strsupply == "" || strsupply == undefined){
					$('#SupplierChoice').addClass('hidden');
				}else{
					$('#SupplierChoice').removeClass('hidden');
				}
				$('#SupplierChoicename').html("供方用户："+strsupply);
				
				DemanderListData = [];
				strdemander = "";
				$(".demanderusercheck:checked").each(function(){
					DemanderListData.push($(this).val());
					strdemander+=$(this).parent().prev().html()+",";
				})
				if(strdemander == "" || strdemander == undefined){
					$('#DemanderChoice').addClass('hidden');
				}else{
					$('#DemanderChoice').removeClass('hidden');
				}
				$('#DemanderChoicename').html("需方用户："+strdemander);
				
				$('#DetailInfoGroup').modal('toggle');
			})
				
			$("#btnsend").click(function(){
				SubmitSend();
			})
		}
		function Checkone(id){
			if($("#"+id).is(':checked')){
				$("#"+id).prop("checked",false);
			}else{
				$("#"+id).prop("checked",true);
			}	
		}
		function CheckAll(div,p){
			if(p == 1){
				$('.'+div).each(function () {
					this.checked = true;
				});
			}else{
				$('.'+div).each(function () {
					this.checked = false;
				});
			}
		}
		function TestPower(){ //全部用户
			url = "admin.sendwebsitenotice.ajax.php?mode=SupplierList&suppliertype=0&currentpage=1";
			$.get(url,function(json,status){
				if(json=="123"){
					CommonNopower();
					$("#Maincontainer").addClass("hidden");
					return;
				}else{
					Settings.Currentlist = "DemanderList";
					ShowAllUserList(1);
					Settings.Currentlist = "SupplierList";
					ShowAllUserList(1);
				}
			});
		}
		function ShowAllUserList(page){ //全部用户
			switch(Settings.Currentlist){
				case 'SupplierList':
					var tablename = "supplyusertable";
					var classname = "supplyusercheck";
					var typename = "suppliertype";
					var pagerid = "kkpager1";
					var typeid = $(".supplygroup:checked").val();
					break;
				case 'DemanderList':
					var tablename = "demanderusertable";
					var classname = "demanderusercheck";
					var typename = "demandertype";
					var pagerid = "kkpager2";
					var typeid = $(".demandergroup:checked").val();
					break;
			}
console.log(Settings.Currentlist,typeid,page); 
			$("#"+tablename+" tbody").html("");
			url = "admin.sendwebsitenotice.ajax.php?mode="+Settings.Currentlist+"&"+typename+"="+typeid+"&currentpage="+page;
			$.get(url,function(json,status){
				if(json=="123"){
					CommonNopower();
					$("#Maincontainer").addClass("hidden");
					return;
				}
				json = eval("("+json+")");
				data = json.data;
console.log(data); 
				if(data == null){
					$("#"+tablename+" tbody").append('暂无用户');
					return;
				}
				for(i=0;i<data.length;i++){
					strtbody = '<tr onclick="Checkone(\''+classname+data[i].id+'\');"><td>'+data[i].id+'</td><td>'+data[i].username+'</td><td>';
					strtbody+= '<input class="'+classname+'" id="'+classname+data[i].id+'" type="checkbox" value="'+data[i].id+'" style="margin: 0 20px 0 5px;vertical-align:middle;" ></td></tr>';
					$("#"+tablename+" tbody").append(strtbody);
					$("."+classname).click(function(e){
						e.stopPropagation();   
					}); 
				}
				kkpager.generPageHtml({
					pagerid : pagerid,
					pno : page,
					total : json.pagecount,
					totalRecords : json.total,
					mode : 'click',//默认值是link，可选link或者click
					click : function(n){
						ShowAllUserList(n);
						return false;
					}
				} , true);
			});
		}
		function SubmitSend(){
			var data = {};
			data.title = $("#noticetitle").val();
			data.content = $("#noticecontent").val();
			data.demander = new Array();
			data.supplier = new Array();

			for(i=0;i<DemanderListData.length;i++){
				var d = {};
				d.demanderid = DemanderListData[i];
				data.demander.push(d);
			}
			for(s=0;s<SupplierListData.length;s++){
				var d = {};
				d.supplierid = SupplierListData[s];
				data.supplier.push(d);
			}
			
console.log(data); 
			if(data.demander==""&&data.supplier==""){CommonWarning('请选择用户！');return;}
			if(data.title == ""){$("#noticetitle").focus();CommonWarning('通知标题不能为空！');return;}
			if(data.content == ""){$("#noticecontent").focus();CommonWarning('通知内容不能为空！');return;}
			
			url = "admin.sendwebsitenotice.ajax.php?mode=SubmitSend";
			$.get(url,{
				data : JSON.stringify(data)
			},function(json,status){
console.log(json); 
				if(json == 1){
					// $("#UserList tbody").html("");
					// $("#noticetitle").val("");
					// $("#noticecontent").val("");
					// CommonJustTip('发送成功！');
					
					window.location.reload();
				}else
					CommonJustTip('服务器忙，请稍候再试。');
			});
		}
   </script> 
</html>