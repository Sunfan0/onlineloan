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
			<table id="checksupplyinfoList" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>ID</th>
						<th>信息简介</th>
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
							<div class="form-group" style="margin-left: 750px;">
								<div class="checkbox">
									<label>
										<input type="checkbox" id="GoodsSetTop" disabled> 该产品置顶
									</label>
								</div>
							</div>
							<div class="form-group">
								<label for="GoodsName" class="col-sm-2 control-label">产品名称</label>
								<div class="col-sm-9">
									<input id="GoodsName" type="text" class="form-control" disabled>
								</div>
							</div>
							<div class="form-group">
								<label for="GoodsType" class="col-sm-2 control-label">产品类型</label>
								<div class="col-sm-9">
									<select class="form-control" id="GoodsType" disabled>
										<option value="1">房产抵押</option>
										<option value="2">信用贷款</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="GoodsPercent" class="col-sm-2 control-label">贷款成数</label>
								<div class="col-sm-9">
									<select class="form-control" id="GoodsPercent" disabled>
										<option value="1">房产7层</option>
										<option value="2">按揭50倍</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="InterestRate" class="col-sm-2 control-label">利率</label>
								<div class="col-sm-9">
									<select class="form-control" id="InterestRate" disabled>
										<option value="1">5年内利率为5.4%</option>
										<option value="2">10年内利率6.8%</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="PaymentMethod" class="col-sm-2 control-label">还款方式</label>
								<div class="col-sm-9">
									<select class="form-control" id="PaymentMethod" disabled>
										<option value="1">等额本金</option>
										<option value="2">等额本息</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="LoanTerm" class="col-sm-2 control-label">贷款期限</label>
								<div class="col-sm-9">
									<select class="form-control" id="LoanTerm" disabled>
										<option value="1">1-5年</option>
										<option value="2">5-10年</option>
										<option value="3">10-15年</option>
										<option value="4">15年以上</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="LoanSum" class="col-sm-2 control-label">可贷金额</label>
								<div class="col-sm-9">
									<select class="form-control" id="LoanSum" disabled>
										<option value="1">1-10万</option>
										<option value="2">10-20万</option>
										<option value="3">20-30万</option>
										<option value="4">30-40万</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="WorkingLife" class="col-sm-2 control-label">需要工作年限</label>
								<div class="col-sm-9">
									<select class="form-control" id="WorkingLife" disabled>
										<option value="1">1-2年</option>
										<option value="2">2-3年</option>
										<option value="3">3-5年</option>
										<option value="4">5年以上</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="IncomeRequest" class="col-sm-2 control-label">收入要求</label>
								<div class="col-sm-9">
									<select class="form-control" id="IncomeRequest" disabled>
										<option value="1">3000-5000</option>
										<option value="2">5000-10000</option>
										<option value="3">10000以上</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="AgeRequest" class="col-sm-2 control-label">年龄要求</label>
								<div class="col-sm-9">
									<select class="form-control" id="AgeRequest" disabled>
										<option value="1">40岁以下</option>
										<option value="2">40岁-60岁</option>
										<option value="3">60岁以上</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="ProfessionId" class="col-sm-2 control-label">职业身份</label>
								<div class="col-sm-9 checkbox" >
									<select class="form-control" id="ProfessionId" disabled>
										<option value="1">公务员</option>
										<option value="2">上班族</option>
										<option value="3">自由职业</option>
										<option value="4">个体</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="IdRequest" class="col-sm-2 control-label">身份要求</label>
								<div class="col-sm-9 checkbox" >
									<select class="form-control" id="IdRequest" disabled>
										<option value="1">无</option>
										<option value="2">中国国籍不含港澳台</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="CompanyRequest" class="col-sm-2 control-label">公司要求</label>
								<div class="col-sm-9">
									<select class="form-control" id="CompanyRequest" disabled>
										<option value="1">无公司</option>
										<option value="2">有公司</option>
										<option value="3">股东</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="FlowRequest" class="col-sm-2 control-label">流水要求</label>
								<div class="col-sm-9">
									<select class="form-control" id="FlowRequest" disabled>
										<option value="1">无</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="IndustryRequest" class="col-sm-2 control-label">行业要求</label>
								<div class="col-sm-9">
									<select class="form-control" id="IndustryRequest" disabled>
										<option value="1">无</option>
										<option value="1">金融类不行</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="AssetsRequest" class="col-sm-2 control-label">资产要求</label>
								<div class="col-sm-9">
									<select class="form-control" id="AssetsRequest" disabled>
										<option value="1">红本房</option>
										<option value="2">按揭房</option>
										<option value="3">商铺</option>
										<option value="4">军产房</option>
										<option value="5">全款车</option>
										<option value="6">按揭车</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="CreditRequest" class="col-sm-2 control-label">征信要求</label>
								<div class="col-sm-9">
									<select class="form-control" id="CreditRequest" disabled>
										<option value="1">征信良好</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="LoanTime" class="col-sm-2 control-label">放款时间</label>
								<div class="col-sm-9">
									<select class="form-control" id="LoanTime" disabled>
										<option value="1">1-3个工作日</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label for="FeaturesIntro" class="col-sm-2 control-label">特色介绍</label>
								<div class="col-sm-9">
									<textarea id="FeaturesIntro" class="form-control" rows="3" disabled></textarea>
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
			ShowCheckdemandList();
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
		
		function ShowCheckdemandList(){
			GotListTable = $('#checksupplyinfoList').DataTable({
				"ajax": {
					"url":"admin.checksupplyinfo.ajax.php?mode=ShowSupplierList",
					// "url":"admin.checksupplier.ajax.php?mode=ShowSupplierList",
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容
					{ "data": "id"},  
					{ "data": "Featuresintroduce"},
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
					},
					{
                        'targets': 4,
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
					 return;
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
		
		function ShowDetailInfo(id){
			Settings.CurrentId = id;
			$('#DetailInfo').modal({backdrop: 'static', keyboard: false});
			url = "admin.checksupplyinfo.ajax.php?mode=ShowSupplierDetail&id="+id;
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
				$("#GoodsName").val(json.productname);
				$("#GoodsType").val(json.producttype);
				$("#GoodsPercent").val(json.loannum);
				$("#InterestRate").val(json.rate);
				$("#PaymentMethod").val(json.paytype);
				$("#LoanTerm").val(json.paytime);
				$("#LoanSum").val(json.paynum);
				$("#WorkingLife").val(json.needyear);
				$("#IncomeRequest").val(json.needincome);
				$("#AgeRequest").val(json.needage);
				$("#ProfessionId").val(json.needprofession);
				$("#IdRequest").val(json.nationality);
				$("#CompanyRequest").val(json.needcompany);
				$("#FlowRequest").val(json.needliushui);
				$("#IndustryRequest").val(json.worktype);
				$("#AssetsRequest").val(json.needproperty);
				$("#CreditRequest").val(json.needcredit);
				$("#LoanTime").val(json.needtime);
				$("#FeaturesIntro").val(json.Featuresintroduce);
				if(json.isstick == '1'){
					$("#GoodsSetTop").prop("checked",true);
				}
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
							url = "admin.checksupplyinfo.ajax.php?mode=UpdateSupplyinfo&id="+Settings.CurrentId+"&type="+type+"&reason="+reason;
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
							data.supplyinfoid = SelectData;
							data.status = type;
							data.reason = $("#userreason").val();
console.log(data);
							url = "admin.checksupplyinfo.ajax.php?mode=UpdateMoreSupplyinfo";
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