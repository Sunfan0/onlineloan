<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">			
			<table id="CheckResultList" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>信息标题</th>
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
					<h5 class="modal-title">需方信息详情</h5>  
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
					"url":"admin.checkdemandinfohistory.ajax.php?mode=ShowdemandinfoList",
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
			url = "admin.checkdemandinfohistory.ajax.php?mode=ShowdemandinfoList&currentpage="+page;
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
					strTbody+= '<td>'+data[i].createtime+'</td><td>'+isallowed+'</td>';
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
			url = "admin.checkdemandinfohistory.ajax.php?mode=ShowdemanderinfoDetail&id="+id;
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json); 
				if(json == null){
					CommonJustTip('暂无数据。');
					return;
				}
				$('#DetailInfo').modal('toggle');
				var type = "";
				switch(json.type){
					case "1":
						type = "中介";
						break;
					case "2":
						type = "机构";
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
   </script> 
</html>