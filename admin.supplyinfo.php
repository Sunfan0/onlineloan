<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<form class="navbar-form navbar-left">
						<button id="selectAll" class="btn btn-primary text-right">全选</button>
						<button onclick="BatchOperat(); return false;"  class="btn btn-danger text-right" style="margin-left: 40px;">删除</button>
					</form>				
				</div>
			</nav>
			<table id="ContentTable" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>产品名称</th>
						<th>产品介绍</th>
						<th>发布状态</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
			<div class="modal fade" id="DetailsInfo">  
			  <div class="modal-dialog" style="width: 1200px;">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 id="addTitle" class="modal-title">详细信息</h5>  
				  </div>  
				  <div class="modal-body text-center"> 
					  <form class="form-horizontal" style="margin-left:-80px;">
						<div class="form-group">
							<label for="GoodsName" class="col-sm-2 control-label">产品名称</label>
							<div class="col-sm-10">
								<input id="GoodsName" type="text" class="form-control" placeholder="贷款产品名称" disabled>
								
							</div>
						</div>
						<div class="form-group">
							<label for="GoodsType" class="col-sm-2 control-label">产品类型</label>
							<div class="col-sm-10">
								<select class="form-control" id="GoodsType" disabled>
								</select>
								
							</div>
						</div>
						<div class="form-group">
							<label for="InterestRate" class="col-sm-2 control-label">利率</label>
							<div class="col-sm-10">
								<!--<button id="GoNewsInfo" class="btn btn-default  btn-block">︾&nbsp;&nbsp;&nbsp;展开</button>-->
								<div id="InterestRate" type="text/plain" style="width:100%;height:80px;" disabled></div>
								
							</div>
						</div>
						<div class="form-group">
							<label for="PaymentMethod" class="col-sm-2 control-label">还款方式</label>
							<div class="col-sm-10">
								<select class="form-control" id="PaymentMethod" disabled>
								</select>
								
							</div>
						</div>
						<div class="form-group">
							<label for="LoanTerm" class="col-sm-2 control-label">贷款期限</label>
							<div class="col-sm-10">
								<input id="LoanTerm" type="text" class="form-control" placeholder="如：1-3个月" disabled>
								
							</div>
						</div>
						
						<div class="form-group">
							<label for="LoanSum" class="col-sm-2 control-label">可贷金额</label>
							<div class="col-sm-10">
								<input id="LoanSum" type="text" class="form-control" placeholder="如：1-3W" disabled>
								
							</div>
						</div>
						<div class="form-group">
							<label for="WorkingLife" class="col-sm-2 control-label">需要工作年限</label>
							<div class="col-sm-10">
								<select class="form-control" id="WorkingLife" disabled>
								</select>
								
							</div>
						</div>
						<div class="form-group">
							<label for="IncomeRequest" class="col-sm-2 control-label">收入要求</label>
							<div class="col-sm-10">
								<select class="form-control" id="IncomeRequest" disabled>
								</select>
								
							</div>
						</div>
						<div class="form-group">
							<label for="SocialRequest" class="col-sm-2 control-label">社保要求</label>
							<div class="col-sm-10">
								<select class="form-control" id="SocialRequest" disabled>
								</select>
								
							</div>
						</div>
						<div class="form-group">
							<label for="AgeRequest" class="col-sm-2 control-label">年龄要求</label>
							<div class="col-sm-10">
								<input id="AgeRequest" type="text" class="form-control" placeholder="如：18-30岁" disabled>
								
							</div>
						</div>
						<div class="form-group">
							<label for="ProfessionId" class="col-sm-2 control-label">职业身份</label>
							<div class="col-sm-10 checkbox" >
								<select  id="ProfessionId" class="selectpicker  form-control" multiple data-live-search="false" disabled>
								</select>
								
							</div>
						</div>
						<div class="form-group">
							<label for="IdRequest" class="col-sm-2 control-label">身份要求</label>
							<div class="col-sm-10 checkbox" >
								<select id="IdRequest" class="selectpicker  form-control" multiple data-live-search="false" disabled>
								</select>
								
							</div>
						</div>
						<div class="form-group">
							<label for="CompanyRequest" class="col-sm-2 control-label">公司要求</label>
							<div class="col-sm-10">
								<select class="form-control" id="CompanyRequest" disabled>
								</select>
								
							</div>
						</div>
						<div class="form-group">
							<label for="CompanyFlowRequest" class="col-sm-2 control-label">公司流水</label>
							<div class="col-sm-10">
								<input id="CompanyFlowRequest" type="text" class="form-control" placeholder="如：100000-200000每月" disabled>
								
							</div>
						</div>
						<div class="form-group">
							<label for="PersonalFlowRequest" class="col-sm-2 control-label">个人流水</label>
							<div class="col-sm-10">
								<input id="PersonalFlowRequest" type="text" class="form-control" placeholder="如：10000-50000每月" disabled>
								
							</div>
						</div>
						<div class="form-group">
							<label for="IndustryRequest" class="col-sm-2 control-label">行业要求</label>
							<div class="col-sm-10">
								<textarea id="IndustryRequest" class="form-control" rows="3" placeholder="行业要求说明" disabled></textarea>
								
							</div>
						</div>
						<div class="form-group">
							<label for="AssetsRequest" class="col-sm-2 control-label">资产要求</label>
							<div class="col-sm-10">
								<select class="form-control" id="AssetsRequest" disabled>
								</select>
								
							</div>
						</div>
						<div class="form-group">
							<label for="CreditRequest" class="col-sm-2 control-label">征信要求</label>
							<div class="col-sm-10">
								<select id="CreditRequest" class="selectpicker  form-control" multiple data-live-search="false" disabled>
								</select>
								
							</div>
						</div>
						<div class="form-group">
							<label for="LoanTime" class="col-sm-2 control-label">放款时间</label>
							<div class="col-sm-10">
								<input id="LoanTime" type="text" class="form-control" placeholder="如：1-3个工作日" disabled>
								
							</div>
						</div>
						<div class="form-group">
							<label for="FeaturesIntro" class="col-sm-2 control-label">特色介绍</label>
							<div class="col-sm-10">
								<textarea id="FeaturesIntro" class="form-control" rows="3" placeholder="特色内容介绍" disabled></textarea>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">是否允许回复</label>
							<div class="col-sm-5">
								<div class="radio" disabled>
									<label class="checkbox-inline">
										<input type="radio" name="optionsRadios" class="GoodsReply"  value="0" checked>否
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="optionsRadios" class="GoodsReply"  value="1">是
									</label>
								</div>
							</div>
							<div class="col-sm-5">
								<div class="checkbox">
									<label>
										<input type="checkbox" id="GoodsSetTop" disabled> 将该产品置顶
									</label>
								</div>
							</div>
						</div>
					</form>
					<div class="form-group text-center">
						<button onclick="DeleteInfo()" type="button" class="btn btn-danger">删除</button>
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
		Settings.SelectAll = false;
		var GotListTable;

		window.onload = OnLoad;

		<?php $timestamp = time();?>
		
		function OnLoad(){
			BindEvents();
			ShowGoodsList();
			
			ShowProductType();
			ShowPayType();
			ShowWorkTime();
			ShowIncome();
			$('#ProfessionId').selectpicker('val','');
			ShowProfession();
			$('#IdRequest').selectpicker('val','');
			ShowNeedIdentity();
			ShowCompany();
			ShowProperty();
			$('#CreditRequest').selectpicker('val','');
			ShowNeedcredit();
			ShowSocialSecurity();
		}
		function BindEvents(){
			var ue = UE.getEditor('InterestRate');
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
		
		function ShowGoodsList(){
			GotListTable = $('#ContentTable').DataTable({
				"ajax": {
					"url":"admin.supplyinfo.ajax.php?mode=ShowsupplyinfoList",
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容				
					{ "data": "id"},
					{ "data": "productname"},
					{ "data": "Featuresintroduce"},
					{ "data": "isallowed"},
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
                        'targets': 4,
						'render': function (data, type, row){
							return '<button onclick="ShowGoodsInfo('+data+')" type="button" class="btn btn-primary">查看</button>';
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
		function BatchOperat(){
			SelectData = new Array();
			$(".checkbox_select:checked").each(function(){
				var d={};
				d.id = $(this).data("id");
				SelectData.push(d);
			})
			if(SelectData.length == 0){
				CommonJustTip("至少选择一条产品信息！");
				return;
			}
			var data = {};
			data.supplyinfoid = SelectData;
			$.confirm({
				title: '',
				content: '确定删除所有选中的产品信息？',
				confirmButton: '确定',
				cancelButton: '取消',
				confirm: function(){
					url = "admin.supplyinfo.ajax.php?mode=DeleteMore";
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
				},
				cancel: function(){
					return;
				}
			});
		}
		function ShowGoodsInfo(id){
			Settings.CurrentId = id;
			$('#DetailsInfo').modal('toggle');
			url = "admin.supplyinfo.ajax.php?mode=ShowsupplyinfoDetail&id="+id;
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				$("#GoodsName").val(json.productname);
				$("#GoodsType").val(json.producttype);
				//$("#GoodsPercent").val(json.loannum);
				UE.getEditor('InterestRate').setContent(json.rate);
				//$("#InterestRate").val(json.rate);
				$("#PaymentMethod").val(json.paytype);
				$("#LoanTerm").val(json.paytime);
				$("#LoanSum").val(json.paynum);
				$("#WorkingLife").val(json.worktime);
				$("#IncomeRequest").val(json.income);
				$("#AgeRequest").val(json.needage);
				$("#SocialRequest").val(json.socialsecurity);
				
				//$("#ProfessionId").val(json.needprofession);//多选
				//$("#IdRequest").val(json.nationality);//多选
				$("#CompanyRequest").val(json.company);
				$("#CompanyFlowRequest").val(json.companyliushui);
				$("#PersonalFlowRequest").val(json.personalliushui);
				$("#IndustryRequest").val(json.needindustry);
				$("#AssetsRequest").val(json.property);
				//$("#CreditRequest").val(json.needcredit);//多选
				$("#LoanTime").val(json.lendtime);
				$("#FeaturesIntro").val(json.Featuresintroduce);
				if(json.allowreply == "1"){
					$(".GoodsReply:eq(1)").attr("checked",'checked'); 
				}
				if(json.isstick == '1'){
					$("#GoodsSetTop").prop("checked",true);
				}
				var profession = json.profession;
				if(profession == null){
					$('#ProfessionId').selectpicker('val','');
				}else{
					var Selectprofession = new Array();
					for(i=0;i<profession.length;i++){
						if($.inArray(profession[i].id, Selectprofession) == -1){
							Selectprofession.push(profession[i].id);
						}
					}
console.log(Selectprofession);
					$('#ProfessionId').selectpicker('val',Selectprofession);
					$('#ProfessionId').selectpicker('refresh');
				}
				var identity = json.identity;
				if(identity == null){
					$('#IdRequest').selectpicker('val','');
				}else{
					var Selectidentity = new Array();
					for(i=0;i<identity.length;i++){
						if($.inArray(identity[i].id, Selectidentity) == -1){
							Selectidentity.push(identity[i].id);
						}
					}
console.log(Selectidentity);
					$('#IdRequest').selectpicker('val',Selectidentity);
					$('#IdRequest').selectpicker('refresh');
				}
				var credit = json.credit;
				if(credit == null){
					$('#CreditRequest').selectpicker('val','');
				}else{
					var Selectcredit = new Array();
					for(i=0;i<credit.length;i++){
						if($.inArray(credit[i].id, Selectcredit) == -1){
							Selectcredit.push(credit[i].id);
						}
					}
console.log(Selectcredit);
					$('#CreditRequest').selectpicker('val',Selectcredit);
					$('#CreditRequest').selectpicker('refresh');
				}
			});
		}
		function DeleteInfo(){
			$.confirm({
				title: '提示',
				content: '您确定删除该产品信息？',
				confirmButton: '确定',
				cancelButton: '取消',
				confirm: function(){
					url = "admin.supplyinfo.ajax.php?mode=Deletesupplyinfo&id="+Settings.CurrentId;
					$.post(url,function(json,status){
console.log(json);
						switch (json){
							case "1":
								window.location.reload();
								break;
							default:
								CommonWarning('服务器忙，请稍候再试。');
						}
					});
				},
				cancel: function(){
					return;
				}
			});
		}
		
		
		ProfessionData =  new Array();
		function ShowProfession(){//职业身份
			url = "admin.supplyinfo.ajax.php?mode=professionlist";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				for(var i=0;i<json.length;i++){
					strprofession = "<option value="+json[i].id+">"+json[i].professiontype+"</option>";
					$("#ProfessionId").append(strprofession);
					$('#ProfessionId').selectpicker('refresh');
					var d={};
					d.id = json[i].id;
					d.status = 0;
					ProfessionData.push(d);
				}
			});
		}
		NeedIdentityData =  new Array();
		function ShowNeedIdentity(){//身份要求
			url = "admin.supplyinfo.ajax.php?mode=identitylist";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				for(var i=0;i<json.length;i++){
					strprofession = "<option value="+json[i].id+">"+json[i].identity+"</option>";
					$("#IdRequest").append(strprofession);
					$('#IdRequest').selectpicker('refresh');
					var d={};
					d.id = json[i].id;
					d.status = 0;
					NeedIdentityData.push(d);
				}
			});
		}
		NeedCreditData =  new Array();
		function ShowNeedcredit(){//征信要求
			url = "admin.supplyinfo.ajax.php?mode=creditlist";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				for(var i=0;i<json.length;i++){
					strprofession = "<option value="+json[i].id+">"+json[i].credit+"</option>";
					$("#CreditRequest").append(strprofession);
					$('#CreditRequest').selectpicker('refresh');
					var d={};
					d.id = json[i].id;
					d.status = 0;
					NeedCreditData.push(d);
				}
			});
		}
		
		function ShowProperty(){//资产要求
			url = "admin.supplyinfo.ajax.php?mode=propertylist";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				for(var i=0;i<json.length;i++){
					strproperty = "<option value="+json[i].id+">"+json[i].property+"</option>";
					$("#AssetsRequest").append(strproperty);
					$('#AssetsRequest').selectpicker('refresh');
				}
			});
		}
		function ShowProductType(){//产品类型
			url = "admin.supplyinfo.ajax.php?mode=producttypelist";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				for(var i=0;i<json.length;i++){
					strproducttype = "<option value="+json[i].id+">"+json[i].producttype+"</option>";
					$("#GoodsType").append(strproducttype);
					$('#GoodsType').selectpicker('refresh');
				}
			});
		}
		
		function ShowSocialSecurity(){//社保要求
			url = "admin.supplyinfo.ajax.php?mode=socialsecuritylist";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				for(var i=0;i<json.length;i++){
					strproducttype = "<option value="+json[i].id+">"+json[i].socialsecurity+"</option>";
					$("#SocialRequest").append(strproducttype);
					$('#SocialRequest').selectpicker('refresh');
				}
			});
		}
		function ShowPayType(){//还款方式
			url = "admin.supplyinfo.ajax.php?mode=paytypelist";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				for(var i=0;i<json.length;i++){
					strpaytype = "<option value="+json[i].id+">"+json[i].paytype+"</option>";
					$("#PaymentMethod").append(strpaytype);
					$('#PaymentMethod').selectpicker('refresh');
				}
			});
		}
		function ShowWorkTime(){//需要工作年限
			url = "admin.supplyinfo.ajax.php?mode=worktimelist";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				for(var i=0;i<json.length;i++){
					strworktime = "<option value="+json[i].id+">"+json[i].worktime+"</option>";
					$("#WorkingLife").append(strworktime);
					$('#WorkingLife').selectpicker('refresh');
				}
			});
		}
		function ShowIncome(){//收入要求
			url = "admin.supplyinfo.ajax.php?mode=incomelist";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				for(var i=0;i<json.length;i++){
					strincome = "<option value="+json[i].id+">"+json[i].income+"</option>";
					$("#IncomeRequest").append(strincome);
					$('#IncomeRequest').selectpicker('refresh');
				}
			});
		}
		function ShowCompany(){//公司要求
			url = "admin.supplyinfo.ajax.php?mode=companylist";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				for(var i=0;i<json.length;i++){
					strcompany = "<option value="+json[i].id+">"+json[i].company+"</option>";
					$("#CompanyRequest").append(strcompany);
					$('#CompanyRequest').selectpicker('refresh');
				}
			});
		}
   </script> 
</html>