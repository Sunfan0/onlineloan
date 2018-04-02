<?php	include "header.php";	?>
		<div id="Maincontainer" class="container" style="margin-top:30px;">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<form class="navbar-form navbar-left">
						<button id="selectAll" class="btn btn-primary text-right">全选</button>
						<button onclick="DeletInfo('more'); return false;"  class="btn btn-danger text-right" style="margin-left: 40px;">删除</button>
					</form>
					<form class="navbar-form navbar-right col-sm-3" role="search">
						<button class="btn btn-primary text-right" onclick="AddInfo(); return false;">+ 新增账号</button>
					</form>
				</div>
			</nav>
			<table id="ContentTable" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>账号</th>
						<th>备注</th>
						<th>权限</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
			<div class="modal fade" id="BackgroundInfo">  
			  <div class="modal-dialog">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 id="addTitle" class="modal-title">修改信息</h5>  
				  </div>  
				  <div class="modal-body text-center"> 
					  <form class="form-horizontal">
						<div class="form-group">
							<label for="BackgroundAccount" class="col-sm-2 control-label">账号</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="BackgroundAccount" placeholder="用户名">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">权限</label>
							<div class="col-sm-10">
								<div class="checkbox" style="text-align:left;">
									<label class="checkbox">
										<input type="checkbox" id="BackgroundPower1" value="账号管理">账号管理
									</label>
									<label class="checkbox">
										<input type="checkbox" id="BackgroundPower2" value="审核管理">审核管理
									</label>
									<label class="checkbox">
										<input type="checkbox" id="BackgroundPower3" value="审核履历管理">审核履历管理
									</label>
									<label class="checkbox">
										<input type="checkbox" id="BackgroundPower4" value="资讯管理">资讯管理
									</label>
									<label class="checkbox">
										<input type="checkbox" id="BackgroundPower5" value="贷款计算器管理">贷款计算器管理
									</label>
									<label class="checkbox">
										<input type="checkbox" id="BackgroundPower6" value="设置管理">设置管理
									</label>
									<label class="checkbox">
										<input type="checkbox" id="BackgroundPower7" value="互动详情管理">互动详情管理
									</label>
									<label class="checkbox">
										<input type="checkbox" id="BackgroundPower8" value="机构积分管理">机构积分管理
									</label>
									<label class="checkbox">
										<input type="checkbox" id="BackgroundPower9" value="站内通知管理">站内通知管理
									</label>
									<label class="checkbox">
										<input type="checkbox" id="BackgroundPower10" value="用户信息管理">用户信息管理
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">所属子站</label>
							<div class="col-sm-10">
								<div class="checkbox" style="text-align:left;">
									<select id="NewsStation" class="selectpicker show-tick form-control" multiple data-live-search="false">
									</select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label for="Backgroundremarks" class="col-sm-2 control-label">备注</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="Backgroundremarks" placeholder="备注">
							</div>
						</div>
						<div class="form-group">
							<label for="BackgroundPassword1" class="col-sm-2 control-label">密码</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" id="BackgroundPassword1" placeholder="密码">
							</div>
						</div>
						<div class="form-group">
							<label for="BackgroundPassword2" class="col-sm-2 control-label">确认密码</label>
							<div class="col-sm-10">
								<input type="password" class="form-control" id="BackgroundPassword2" placeholder="密码">
							</div>
						</div>
					</form>
				  </div>  
				  <div class="modal-footer">
					<button id="BackgroundDeletInfo" onclick="DeletInfo('one')" style="margin-right:380px;" type="button" class="btn btn-danger">删除</button>
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
		var GotListTable;
		SelectData = new Array();
		
		window.onload = OnLoad;
		
		function OnLoad(){
			BindEvents();
			ShowBackgroundList();
		}
		function ShowSubarealist(){
			datasubareaall = new Array();
			$("#NewsStation").html("");
			url = "admin.manager.ajax.php?mode=subarealist";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				if(json == null){return;}
				for(var i=0;i<json.length;i++){
					var d={};
					d.id = json[i].id;
					d.status = 0;
					datasubareaall.push(d);
					var strTbody = '<option value="'+json[i].id+'">'+json[i].name+'</option>';
					$("#NewsStation").append(strTbody);
					$('#NewsStation').selectpicker('refresh');
				}
			});
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
		function ShowBackgroundList(){
			GotListTable = $('#ContentTable').DataTable({
				"ajax": {
					"url":"admin.manager.ajax.php?mode=ShowAllBgmanager",
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "id"},
					{ "data": "loginname"},
					{ "data": "remarks"},
					{ "data": "rights"},
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
						"targets":3,
						"render":function(data,type,full){
							rights = eval("("+data+")");
							var power = "";
							if(rights.bgmanager == "1"){
								power += $("#BackgroundPower1").val()+";"; 
							}
							if(rights.bgaudit == "1"){
								power += $("#BackgroundPower2").val()+";"; 
							}
							if(rights.bgauditrecord == "1"){
								power += $("#BackgroundPower3").val()+";"; 
							}
							if(rights.bginformation == "1"){
								power += $("#BackgroundPower4").val()+";"; 
							}
							if(rights.bgcounter == "1"){
								power += $("#BackgroundPower5").val()+";"; 
							}
							if(rights.bgset == "1"){
								power += $("#BackgroundPower6").val()+";"; 
							}
							if(rights.bginteract == "1"){
								power += $("#BackgroundPower7").val()+";"; 
							}
							if(rights.bgscore == "1"){
								power += $("#BackgroundPower8").val()+";"; 
							}
							if(rights.bgnotice == "1"){
								power += $("#BackgroundPower9").val()+";"; 
							}
							if(rights.bguserinfo == "1"){
								power += $("#BackgroundPower10").val()+";"; 
							}
							return power;
						}
					},
					{
                        'targets': 4,
						'render': function (data, type, row){
							return '<button onclick="ModifyInfo('+data+')" type="button" class="btn btn-primary">查看</button>';
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
			Settings.EditState = "modify";
			ShowSubarealist();
			Settings.ModifyInfoId = id;
			$('#addTitle').text("修改信息");
			$('#BackgroundPassword1,#BackgroundPassword2').attr("placeholder","如果需要修改密码，请填写新密码，否则请留空");
			$('[id^="BackgroundPower"]').prop("checked", false);
			$("#BackgroundAccount,#Backgroundremarks,#BackgroundPassword1,#BackgroundPassword2").val("");
			$('#BackgroundInfo').modal({backdrop: 'static', keyboard: false});
			$("#BackgroundDeletInfo").css('display',''); 
			$("#BackgroundAccount").attr("readonly","readonly");
			url = "admin.manager.ajax.php?mode=ShowOneBgmanager&id="+id;
			$.get(url,function(json,status){
				json = eval("("+json+")");
				rights = eval("("+json.rights+")");
console.log(json);
				$("#BackgroundAccount").val(json.loginname);		
				$("#Backgroundremarks").val(json.remarks);				
				if(rights.bgmanager == "1"){$("#BackgroundPower1").prop("checked", true);}
				if(rights.bgaudit == "1"){$("#BackgroundPower2").prop("checked", true);}
				if(rights.bgauditrecord == "1"){$("#BackgroundPower3").prop("checked", true);}
				if(rights.bginformation == "1"){$("#BackgroundPower4").prop("checked", true);}
				if(rights.bgcounter == "1"){$("#BackgroundPower5").prop("checked", true);}
				if(rights.bgset == "1"){$("#BackgroundPower6").prop("checked", true);}
				if(rights.bginteract == "1"){$("#BackgroundPower7").prop("checked", true);}
				if(rights.bgscore == "1"){$("#BackgroundPower8").prop("checked", true);}
				if(rights.bgnotice == "1"){$("#BackgroundPower9").prop("checked", true);}
				if(rights.bguserinfo == "1"){$("#BackgroundPower10").prop("checked", true);}
				
				var dataStation = new Array();//所属子站
				if(json.subarealist == null)
					return;
				for(i=0;i<json.subarealist.length;i++){		
					dataStation.push(json.subarealist[i].id);
				}
				$('#NewsStation').selectpicker('val', dataStation);
			});
		}
		function AddInfo(){
			Settings.EditState = "add";
			ShowSubarealist();
			$('#addTitle').text("填写信息");
			$('#BackgroundPassword1,#BackgroundPassword2').attr("placeholder","密码");
			$('[id^="BackgroundPower"]').prop("checked", false);
			$("#BackgroundAccount,#Backgroundremarks,#BackgroundPassword1,#BackgroundPassword2").val("");
			$('#BackgroundInfo').modal({backdrop: 'static', keyboard: false});
			$("#BackgroundDeletInfo").css('display','none'); 
			$("#BackgroundAccount").removeAttr("readonly");
			$('#NewsStation').selectpicker('val','');
		}
		function DeletInfo(number){
			SelectData = new Array();
			if(number == "more"){
				$(".checkbox_select:checked").each(function(){
					var d={};
					d.id = $(this).data("id");
					SelectData.push(d);
				})
				if(SelectData.length == 0){
					CommonJustTip("至少选择一条账号信息！");
					return;
				}
			}
			switch(number){
				case "one":
					strcontent = "您确定删除该账号？";
					break;
				case "more":
					strcontent = "您确定删除所选账号？";
					break;
			}
			$.confirm({
				title: '提示',
				content: strcontent,
				confirmButton: '确定',
				cancelButton: '取消',
				confirm: function(){
					switch(number){
						case 'one':
							url = "admin.manager.ajax.php?mode=DeleteBgmanager&id="+Settings.ModifyInfoId;
							$.get(url,function(json,status){
console.log(json);
								switch (json){
									case "1":
										$('#BackgroundInfo').modal('toggle');
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
						case 'more':
							var data = {};
							data.managerid = SelectData;
console.log(data);
							url = "admin.manager.ajax.php?mode=DeleteMore";
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
			
			var account = $("#BackgroundAccount").val();
			var remarks = $("#Backgroundremarks").val();
			var flagid = "";
			var power = "";
			var bgmanager = 0;//账号管理
			var bgaudit = 0;//审核管理
			var bgauditrecord = 0;//审核履历管理
			var bginformation = 0;//资讯管理
			var bgcounter = 0;//贷款计算器管理
			var bgset = 0;//设置管理
			var bginteract = 0;//互动详情管理
			var bgscore = 0;//机构积分管理
			var bgnotice = 0;//站内通知管理
			var bguserinfo = 0;//用户信息管理
			
			var password1 = $("#BackgroundPassword1").val();
			var password2 = $("#BackgroundPassword2").val();
			for(i=1;i<=11;i++){
				var powerChecked = $("#BackgroundPower"+i).is(":checked");
				if(powerChecked){
					power += $("#BackgroundPower"+i).val()+";"; 
					switch(i){
						case 1:
							bgmanager = 1;
							break;
						case 2:
							bgaudit = 1;
							break;
						case 3:
							bgauditrecord = 1;
							break;
						case 4:
							bginformation = 1;
							break;
						case 5:
							bgcounter = 1;
							break;
						case 6:
							bgset = 1;
							break;
						case 7:
							bginteract = 1;
							break;
						case 8:
							bgscore = 1;
							break;
						case 9:
							bgnotice = 1;
							break;
						case 10:
							bguserinfo = 1;
							break;
					}
				}
			}
			if(account==""){$("#BackgroundAccount").focus();CommonWarning('账号不能为空！');return;}
			if(power==""){$("#BackgroundPower1").focus();CommonWarning('权限不能为空！');return;}
			
			if(Settings.EditState == "modify"){
				flagid = Settings.ModifyInfoId;
			}else{
				if(password1 == ""){$("#BackgroundPassword1").focus();CommonWarning('请设置密码！');return;}
			}
			
			if(password1 != password2){$("#BackgroundPassword2").focus();CommonWarning('请确认两次输入的密码相同！');return;}
			var data = {};
			data.flagid = flagid;
			data.username = account;
			data.password = md5(password1);
			data.remarks = remarks;
			data.bgmanager = bgmanager;
			data.bgaudit = bgaudit;
			data.bgauditrecord = bgauditrecord;
			data.bginformation = bginformation;
			data.bgcounter = bgcounter;
			data.bgset = bgset;
			data.bginteract = bginteract;
			data.bgscore = bgscore;
			data.bgnotice = bgnotice;
			data.bguserinfo = bguserinfo;
			var station = $("#NewsStation").val();
			if(station == null){
				$("#NewsStation").focus();CommonWarning('所属子站不能为空！');return;
			}else{
				for(i=0;i<station.length;i++){
					var id = station[i];
					for(d=0;d<datasubareaall.length;d++){
						if(id == datasubareaall[d].id){
							datasubareaall[d].status = 1;
						}
					}
				}
			}
			data.subarea =  datasubareaall;
			url = "admin.manager.ajax.php?mode=UpdateBgmanager";
			$.post(url, {
				data : JSON.stringify(data)
			} ,function(json,status){
				switch (json){
					case "1":
						$('#BackgroundInfo').modal('toggle');
						GotListTable.draw(false);
						Settings.SelectAll = false;
						$("#selectAll").html("全选");
						break;
					case "-9":
						CommonWarning('该账号已被注册。');
						break;
					default:
						CommonWarning("服务器忙，请稍候再试。");
				}
			});
		}
   </script> 
</html>