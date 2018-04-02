<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<form class="navbar-form navbar-left">
						<button id="selectAll" class="btn btn-primary text-right">全选</button>
						<button onclick="OperateRequest(1,'more'); return false;" class="btn btn-primary text-right" style="margin-left: 40px;">通过</button>
						<button onclick="OperateRequest(-1,'more'); return false;"  class="btn btn-danger text-right" style="margin-left: 5px;">拒绝</button>
					</form>							
				</div>
			</nav>
			<table id="checkdemandinfoList" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>信息标题</th>
						<th>信息内容</th>
						<th>发布时间</th>
						<th>当前状态</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
			<div class="modal fade" id="DetailInfo">  
			  <div class="modal-dialog" style="width:1100px;">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 class="modal-title">该信息的详细内容</h5>  
				  </div>  
				  <div class="modal-body text-center"> 
						<form class="form-horizontal">
							<div class="form-group">
								<label for="DemandTitle" class="col-sm-2 control-label">标题</label>
								<div class="col-sm-4">
									<input id="DemandTitle" type="text" class="form-control" readonly >
								</div>
								<label for="DemandTitleColor" class="col-sm-3 control-label">标题颜色</label>
								<div class="col-sm-3">
									<input type="text" id="DemandTitleColor" class="form-control colorDemo" data-position="bottom right" value="#000000" readonly>
								</div>
							</div>
							<div class="form-group">
								<label for="DemandName" class="col-sm-2 control-label">姓名</label>
								<div class="col-sm-10">
									<input id="DemandName" type="text" class="form-control" readonly>
								</div>
							</div>
							<div class="form-group">
								<label for="DemandSum" class="col-sm-2 control-label">需求金额</label>
								<div class="col-sm-10">
									<input id="DemandSum" type="text" class="form-control" readonly>
								</div>
							</div>
							<div class="form-group">
								<label for="ProfessionId" class="col-sm-2 control-label">职业</label>
								<div class="col-sm-10">
									<select class="form-control" id="ProfessionId" disabled>
										<option value="1">公务员</option>
										<option value="2">上班族</option>
										<option value="3">自由职业</option>
										<option value="4">个体</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="HouseProperty" class="col-sm-2 control-label">房产</label>
								<div class="col-sm-10">
									<select class="form-control" id="HouseProperty" disabled>
										<option value="1">红本房</option>
										<option value="2">按揭房</option>
										<option value="3">商铺</option>
										<option value="4">军产房</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="CarProperty" class="col-sm-2 control-label">车</label>
								<div class="col-sm-10">
									<select class="form-control" id="CarProperty" disabled>
										<option value="1">全款车</option>
										<option value="2">按揭车</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="CreditDegree" class="col-sm-2 control-label">征信</label>
								<div class="col-sm-10">
									<select class="form-control" id="CreditDegree" disabled>
										<option value="1">良好</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="SocialSecurity" class="col-sm-2 control-label">社保</label>
								<div class="col-sm-10">
									<select class="form-control" id="SocialSecurity" disabled>
										<option value="0">无</option>
										<option value="1">有</option>
									</select>
								</div>
							</div>
							<div class="form-group hidden">
								<label for="CreditNumber" class="col-sm-2 control-label">信用卡</label>
								<div class="col-sm-10">
									<select class="form-control" id="CreditNumber" disabled>
										<option value="0">无</option>
										<option value="1">有一张</option>
										<option value="2">有二张</option>
										<option value="3">有三张及以上</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="AgeStatus" class="col-sm-2 control-label">年龄</label>
								<div class="col-sm-10">
									<select class="form-control" id="AgeStatus" disabled>
										<option value="0">20-30岁</option>
										<option value="1">31-40岁</option>
										<option value="2">41-50岁</option>
										<option value="3">51-60岁</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="MarriageStatus" class="col-sm-2 control-label">婚姻</label>
								<div class="col-sm-10">
									<select class="form-control" id="MarriageStatus" disabled>
										<option value="0">未婚</option>
										<option value="1">已婚</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="ChildrenStatus" class="col-sm-2 control-label">子女</label>
								<div class="col-sm-10">
									<select class="form-control" id="ChildrenStatus" disabled>
										<option value="0">无</option>
										<option value="1">有</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="CompanyStatus" class="col-sm-2 control-label">公司</label>
								<div class="col-sm-10">
									<select class="form-control" id="CompanyStatus" disabled>
										<option value="0">无</option>
										<option value="1">有</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="CompanyFlow" class="col-sm-2 control-label">公司流水</label>
								<div class="col-sm-10">
									<select class="form-control" id="CompanyFlow" disabled>
										<option value="1">10万-50万</option>
										<option value="2">50万-100万</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="PersonalFlow" class="col-sm-2 control-label">个人流水</label>
								<div class="col-sm-10">
									<select class="form-control" id="PersonalFlow" disabled>
										<option value="1">1万-5万</option>
										<option value="2">5万-10万</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="DemandOther" class="col-sm-2 control-label">有无其他贷款</label>
								<div class="col-sm-10">
									<select class="form-control" id="DemandOther" disabled>
										<option value="1">无</option>
										<option value="2">有</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="DemandTime" class="col-sm-2 control-label">需求时间</label>
								<div class="col-sm-10">
									<select class="form-control" id="DemandTime" disabled>
										<option value="1">加急</option>
										<option value="2">1周</option>
										<option value="3">2周</option>
										<option value="4">3周</option>
										<option value="5">1个月</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="DemandExplain" class="col-sm-2 control-label">其他说明</label>
								<div class="col-sm-10">
									<textarea id="DemandExplain" class="form-control" rows="3" readonly></textarea>
								</div>
							</div>
							<div class="form-group">
								<label for="ApplyTime" class="col-sm-2 control-label">申请时间</label>
								<div class="col-sm-10">
									<input id="ApplyTime" type="date" class="form-control" readonly>
								</div>
							</div>
							<div class="form-group">
								<label for="Aptitude" class="col-sm-2 control-label">资质</label>
								<div class="col-sm-10">
									<select class="form-control" id="Aptitude" disabled>
										<option value="1">有车</option>
										<option value="2">有房</option>
										<option value="3">有车、有房</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="DemandMaxnumber" class="col-sm-2 control-label">最多可见</label>
								<div class="col-sm-10">
									<input type="number" class="form-control" id="DemandMaxnumber" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">可见权限</label>
								<div class="col-sm-10">
									<select class="form-control" id="DemandPower" disabled>
										<option value="1">全部可见</option>
										<option value="2">仅供方可见</option>
										<option value="3">仅需方可见</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12">
									<button id="passBtn" onclick="OperateRequest(1,'one')" type="button" class="btn btn-primary">通过</button>
									<button id="refuseBtn" onclick="OperateRequest(-1,'one')" type="button" class="btn btn-danger">拒绝</button> 
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
		Settings.SelectAll = false;
		var GotListTable;
		
		window.onload = OnLoad;
		
		function OnLoad(){
			BindEvents();
			ShowCheckdemandinfoList();
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
		
		function ShowCheckdemandinfoList(){
			GotListTable = $('#checkdemandinfoList').DataTable({
				"ajax": {
					"url":"admin.checkdemandinfo.ajax.php?mode=ShowdemandinfoList",
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "id"},  
					{ "data": "title"},   
					{ "data": "content"},
					{ "data": "createtime"},
					{ "data": "isallowed"},
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
						"targets":4,
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
					},
					{
                        'targets': 5,
						'render': function (data, type, row){
							return '<button onclick="ShowDetailInfo('+data+')" type="button" class="btn btn-primary">查看</button>';
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
		
		function ShowDetailInfo(id){//显示详细信息
			Settings.CurrentId = id;
			$('#DetailInfo').modal({backdrop: 'static', keyboard: false});
			url = "admin.checkdemandinfo.ajax.php?mode=ShowdemandinfoDetail&id="+id;
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				switch(json.isallowed){
					case "1":
						$("#passBtn").addClass("hidden");
						$("#refuseBtn").removeClass("hidden");
						break;
					case "-1":
						$("#passBtn").removeClass("hidden");
						$("#refuseBtn").addClass("hidden");
						break;
					case "0":
						$("#passBtn").removeClass("hidden");
						$("#refuseBtn").removeClass("hidden");
						break;
				}
				$("#DemandTitle").val(json.title);
				$("#DemandTitleColor").val(json.titlecolor);
				$("#DemandName").val(json.name);
				$("#DemandSum").val(json.demandnum);
				$("#ProfessionId").val(json.profession);
				$("#HouseProperty").val(json.houseproperty);
				$("#CarProperty").val(json.carinfo);
				$("#CreditDegree").val(json.creditinvestigate);
				$("#SocialSecurity").val(json.socialsecurity);
				$("#AgeStatus").val(json.age);
				$("#MarriageStatus").val(json.marriage);
				$("#ChildrenStatus").val(json.children);
				$("#CompanyStatus").val(json.company);
				$("#CompanyFlow").val(json.companyrun);
				$("#PersonalFlow").val(json.personalrun);
				$("#DemandOther").val(json.otherloans);
				$("#DemandTime").val(json.demandtime);
				$("#DemandExplain").val(json.otherdesc);
				$("#ApplyTime").val(json.Applytime.substr(0,10));
				$("#Aptitude").val(json.aptitude);
				$("#DemandMaxnumber").val(json.maxvisible);
				$("#DemandPower").val(json.showright);
			});
		}
		
		function OperateRequest(type,number){//通过、拒绝
			SelectData = new Array();
			if(number == "more"){
				$(".checkbox_select:checked").each(function(){
					var d={};
					d.id = $(this).data("id");
					SelectData.push(d);
				})
				if(SelectData.length == 0){
					CommonJustTip("至少选择一条审核信息！");
					return;
				}
			}
				
			var strcontent;
			switch(type){
				case 1:
					strcontent = "<p style='color:black;'>请在下面输入你通过的理由：</p><textarea rows='3' class='form-control' id='userreason'></textarea>";
					break;
				case -1:
					strcontent = "<p style='color:black;'>请在下面输入你拒绝的理由：</p><textarea rows='3' class='form-control' id='userreason'></textarea>";
					break;
			}
			$.confirm({
				title: '',
				content: strcontent,
				confirmButton: '确定',
				cancelButton: '取消',
				confirm: function(){
					switch(number){
						case 'one':
							var reason = $("#userreason").val();
							url = "admin.checkdemandinfo.ajax.php?mode=Updatedemandinfo&id="+Settings.CurrentId+"&type="+type+"&reason="+reason;
							$.get(url,function(json,status){
console.log(json);
								switch (json){
									case "1":
										$('#DetailInfo').modal('toggle');
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
						case 'more':
							var data = {};
							data.demandinfoid = SelectData;
							data.status = type;
							data.reason = $("#userreason").val();
console.log(data);
							url = "admin.checkdemandinfo.ajax.php?mode=UpdateMoreDemandinfo";
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
		
		
		
/*		
		function OperateRequest(type){//通过、拒绝
			var strcontent;
			switch(type){
				case 1:
					strcontent = "<p>请在下面输入你通过的理由：</p><textarea rows='3' class='form-control' id='userreason'></textarea>";
					break;
				case -1:
					strcontent = "<p>请在下面输入你拒绝的理由：</p><textarea rows='3' class='form-control' id='userreason'></textarea>";
					break;
			}
			$.confirm({
				title: '',
				content: strcontent,
				confirmButton: '确定',
				cancelButton: '取消',
				confirm: function(){
					var reason = $("#userreason").val();
					url = "admin.checkdemandinfo.ajax.php?mode=Updatedemandinfo&id="+Settings.CurrentId+"&type="+type+"&reason="+reason;
					$.get(url,function(json,status){
console.log(json);
						switch (json){
							case "1":
								$('#DetailInfo').modal('toggle');
								ShowCheckdemandinfoList(Settings.Currentpage);
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
		}*/
   </script> 
</html>