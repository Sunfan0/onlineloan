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
						<th>姓名</th>
						<th>需求金额</th>
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
							<label for="DemandName" class="col-sm-2 control-label">姓名</label>
							<div class="col-sm-3">
								<input id="DemandName" type="text" class="form-control" disabled>
							</div>
							<div class="col-sm-1">
								
							</div>
							<label for="DemandSum" class="col-sm-1 control-label">需求金额</label>
							<div class="col-sm-3">
								<input id="DemandSum" class="form-control" disabled>
							</div>
							<div class="col-sm-1">
								
							</div>
						</div>
						<div class="form-group">
							<label for="ProfessionId" class="col-sm-2 control-label">职业</label>
							<div class="col-sm-10">
								<select  id="ProfessionId" class="selectpicker  form-control"  data-live-search="false" disabled>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="DemandArea" class="col-sm-2 control-label">地区</label>
							<div class="col-sm-10">
								<select id="DemandArea" class="selectpicker  form-control" multiple data-live-search="false" disabled>
								</select>
								
							</div>
						</div>
						<div class="form-group">
							<label for="HouseProperty" class="col-sm-2 control-label">房产</label>
							<div class="col-sm-10">
								<select class="form-control" id="HouseProperty" disabled>
									<option value="1">无</option>
									<option value="2">红本房</option>
									<option value="3">按揭房</option>
									<option value="4">商铺</option>
									<option value="5">军产房</option>
									<option value="5">农民房</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="CarProperty" class="col-sm-2 control-label">车</label>
							<div class="col-sm-10">
								<select class="form-control" id="CarProperty" disabled>
									<option value="1">无</option>
									<option value="2">全款车</option>
									<option value="3">按揭车</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="CreditDegree" class="col-sm-2 control-label">征信</label>
							<div class="col-sm-10">
								<select  id="CreditDegree" class="selectpicker  form-control"  data-live-search="false" disabled>
									<!--<option value="1">良好</option>-->
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="SocialSecurity" class="col-sm-2 control-label">社保</label>
							<div class="col-sm-10">
								<select class="form-control" id="SocialSecurity" disabled>
									<!--<option value="0">无</option>
									<option value="1">有</option>-->
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="CreditNumber" class="col-sm-2 control-label">信用卡</label>
							<div class="col-sm-10">
								<select class="form-control" id="CreditNumber" disabled>
									<option value="1" checked>无</option>
									<option value="2">有一张</option>
									<option value="3">有二张</option>
									<option value="4">有三张及以上</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="AgeStatus" class="col-sm-2 control-label">年龄</label>
							<div class="col-sm-10">
								<select class="form-control" id="AgeStatus" disabled>
									<option value="1" checked>24-30岁</option>
									<option value="2">30-35岁</option>
									<option value="3">35-45岁</option>
									<option value="3">45岁以上</option>
								</select>
							</div>
						</div>
						
						<div class="form-group">
							<label for="MarriageStatus" class="col-sm-2 control-label">婚姻</label>
							<div class="col-sm-10">
								<select class="form-control" id="MarriageStatus" disabled>
									<option value="1" checked>未婚</option>
									<option value="2">已婚</option>
									<option value="3">离异</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="ChildrenStatus" class="col-sm-2 control-label">子女</label>
							<div class="col-sm-10">
								<select class="form-control" id="ChildrenStatus" disabled>
									<option value="1" checked>无</option>
									<option value="2">有</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="CompanyStatus" class="col-sm-2 control-label">公司</label>
							<div class="col-sm-10">
								<select class="form-control" id="CompanyStatus" disabled>
									<option value="1" checked>无</option>
									<option value="2">法人</option>
									<option value="3">股东</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="CompanyFlow" class="col-sm-2 control-label">公司流水</label>
							<div class="col-sm-10">
								<input id="CompanyFlow" type="text" class="form-control" placeholder="如：100000-200000每月" disabled>
								<!--<select class="form-control" id="CompanyFlow">
									<option value="1">10万-50万</option>
									<option value="2">50万-100万</option>
								</select>-->
							</div>
						</div>
						<div class="form-group">
							<label for="PersonalFlow" class="col-sm-2 control-label">个人流水</label>
							<div class="col-sm-10">
								<input id="PersonalFlow" type="text" class="form-control" placeholder="如：10000-50000每月" disabled>
							</div>
						</div>
						<div class="form-group">
							<label for="DemandOther" class="col-sm-2 control-label">有无其他贷款</label>
							<div class="col-sm-10">
								<select class="form-control" id="DemandOther" disabled>
									<option value="1" checked>无</option>
									<option value="2">有</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="DemandTime" class="col-sm-2 control-label">需求时间</label>
							<div class="col-sm-10">
								<select class="form-control" id="DemandTime" disabled>
									<option value="1" checked>加急</option>
									<option value="2">1个月内</option>
									<option value="3">2个月内</option>
									<option value="4">3个月内</option>
									<option value="5">3个月以上</option>
									<option value="5">半年内</option>
								</select>
								
							</div>
						</div>
						<div class="form-group">
							<label for="DemandExplain" class="col-sm-2 control-label">其他说明</label>
							<div class="col-sm-10">
								<textarea id="DemandExplain" class="form-control" rows="3" placeholder="其他说明介绍" disabled></textarea>
							</div>
						</div>
						<div class="form-group">
							<label for="Aptitude" class="col-sm-2 control-label">资质</label>
							<div class="col-sm-10">
								<select class="form-control" id="Aptitude" disabled>
									<option value="1" checked>有车</option>
									<option value="2">有房</option>
									<option value="3">有车、有房</option>
								</select>
							</div>
						</div>
						<div class="form-group">
							<label for="images" class="col-sm-2 control-label">资质上传(附件)</label>
							<div class="col-sm-4" style="text-align: left;">
								<input id="images" name="images[]" type="file" multiple data-min-file-count="1" disabled>
							</div>					
						</div>
						<div class="form-group">
							<label for="DemandMaxnumber" class="col-sm-2 control-label">可见人数</label>
							<div class="col-sm-10">
								<input type="number" class="form-control" id="DemandMaxnumber" disabled>
							</div>
						</div>
						<div class="form-group">
							<label for="DemandStatus" class="col-sm-2 control-label">状态</label>
							<div class="col-sm-10">
								<select class="form-control" id="DemandStatus" disabled>
									<option value="1" checked>需求中</option>
									<option value="2">不需要了</option>
								</select>
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
			ShowDemandinfoList();
			
			$('#ProfessionId').selectpicker('val','');
			ShowProfession();
			$('#CreditDegree').selectpicker('val','');
			ShowNeedcredit();
			$('#DemandArea').selectpicker('val','');
			ShowAreaInfo();
			ShowSocialSecurity();
		}
		function BindEvents(){
			$("#images").fileinput('destroy');
				r = $("#images").fileinput({
				language: 'zh',
				uploadAsync: true,
				uploadUrl: 'bootstrap-fileinput-upload.php',
				// allowedFileExtensions : ['jpg', 'png','gif',"pdf"],
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
				maxFileSize:400
			}).on('fileselect', function(event, numFiles, label) {
				$('#images').fileinput('upload');
				
			}).on('fileuploaded', function(event, data, previewId, index) {//上传成功回调
				//alert(data.response.uploaded[0].file);
				// arrimg.push(data.response.uploaded[0].file);
				Settings.imgurl = data.response.uploaded[0].file;
			});
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
		function ShowDemandinfoList(){
			GotListTable = $('#ContentTable').DataTable({
				"ajax": {
					"url":"admin.demandinfo.ajax.php?mode=ShowdemandinfoList",
					"type":"POST"
				},
				//"processing": true,//加载效果
				"serverSide": true,//页面在加载时就请求后台，以及每次对 datatable 进行操作时也是请求后台
				"pageLength": 40,//每页显示的数据量
				"columns": [//datatable每一列所对应的数据显示内容				
					{ "data": "id"},
					{ "data": "name"},
					{ "data": "demandnum"},
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
							return '<button onclick="ShowDemandInfo('+data+')" type="button" class="btn btn-primary">查看</button>';
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
				CommonJustTip("至少选择一条产品需求信息！");
				return;
			}
			var data = {};
			data.demandinfoid = SelectData;
			$.confirm({
				title: '',
				content: '确定删除所有选中的需求信息？',
				confirmButton: '确定',
				cancelButton: '取消',
				confirm: function(){
					url = "admin.demandinfo.ajax.php?mode=DeleteMore";
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
		function ShowDemandInfo(id){
			Settings.CurrentId = id;
			$('#DetailsInfo').modal('toggle');
			url = "admin.demandinfo.ajax.php?mode=ShowdemandinfoDetail&id="+id;
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				// $("#DemandTitle").val(json.title);
				// $("#DemandTitleColor").val(json.titlecolor);
				$("#DemandName").val(json.name);
				$("#DemandSum").val(json.demandnum);
				//$("#ProfessionId").val(json.profession);//多选
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
				$("#HouseProperty").val(json.houseproperty);
				$("#CarProperty").val(json.carproperty);
				// $("#DemandType").val(json.demandtypeid);
				
				//$("#CreditDegree").val(json.creditinvestigate);//多选
				var credit = json.credit;
				if(credit == null){
					$('#CreditDegree').selectpicker('val','');
				}else{
					var Selectcredit = new Array();
					for(i=0;i<credit.length;i++){
						if($.inArray(credit[i].id, Selectcredit) == -1){
							Selectcredit.push(credit[i].id);
						}
					}
console.log(Selectcredit);
					$('#CreditDegree').selectpicker('val',Selectcredit);
					$('#CreditDegree').selectpicker('refresh');
				}
				var subarea = json.subarea;
				if(subarea == null){
					$('#DemandArea').selectpicker('val','');
				}else{
					var Selectsubarea = new Array();
					for(i=0;i<subarea.length;i++){
						if($.inArray(subarea[i].id, Selectsubarea) == -1){
							Selectsubarea.push(subarea[i].id);
						}
					}
console.log(Selectsubarea);
					$('#DemandArea').selectpicker('val',Selectcredit);
					$('#DemandArea').selectpicker('refresh');
				}
				$("#SocialSecurity").val(json.socialsecurity);
				$("#CreditNumber").val(json.creditcardinfo);
				$("#AgeStatus").val(json.age);
				$("#MarriageStatus").val(json.marriage);
				$("#ChildrenStatus").val(json.children);
				$("#CompanyStatus").val(json.needcompanyid);
				$("#CompanyFlow").val(json.companyliushui);
				$("#PersonalFlow").val(json.personalliushui);
				$("#DemandOther").val(json.otherloans);
				$("#DemandTime").val(json.demandtime);
				$("#DemandExplain").val(json.otherdesc);
				$("#Aptitude").val(json.aptitude);
				$("#DemandMaxnumber").val(json.maxvisible);
				// $("#DemandPower").val(json.showright);
				$("#DemandStatus").val(json.demandstate);
				$('#images').fileinput('refresh', {initialPreview:[json.aptitudeimg]});
				Settings.imgurl = json.aptitudeimg;
				// if(json.isstick == '1'){
					// $("#DemandSetTop").prop("checked",true);
				// }
			});
		}
		function DeleteInfo(){
			$.confirm({
				title: '提示',
				content: '您确定删除该需求信息？',
				confirmButton: '确定',
				cancelButton: '取消',
				confirm: function(){
					url = "admin.demandinfo.ajax.php?mode=Deletedemandinfo&id="+Settings.CurrentId;
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
		
		
		SubareaData =  new Array();
		function ShowAreaInfo(){
			url = "admin.demandinfo.ajax.php?mode=subarealist";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				for(var i=0;i<json.length;i++){
					strarea = "<option value="+json[i].id+">"+json[i].name+"</option>";
					$("#DemandArea").append(strarea);
					$('#DemandArea').selectpicker('refresh');
					var d={};
					d.id = json[i].id;
					d.status = 0;
					SubareaData.push(d);
				}
			});
		}
		function ShowSocialSecurity(){//社保要求
			url = "admin.demandinfo.ajax.php?mode=socialsecuritylist";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				for(var i=0;i<json.length;i++){
					strsocialtype = "<option value="+json[i].id+">"+json[i].socialsecurity+"</option>";
					$("#SocialSecurity").append(strsocialtype);
					//$('#SocialSecurity').selectpicker('refresh');
				}
			});
		}
		NeedCreditData =  new Array();
		function ShowNeedcredit(){//征信要求
			url = "admin.demandinfo.ajax.php?mode=creditlist";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				for(var i=0;i<json.length;i++){
					strprofession = "<option value="+json[i].id+">"+json[i].credit+"</option>";
					$("#CreditDegree").append(strprofession);
					$('#CreditDegree').selectpicker('refresh');
					var d={};
					d.id = json[i].id;
					d.status = 0;
					NeedCreditData.push(d);
				}
			});
		}
		ProfessionData =  new Array();
		function ShowProfession(){//职业身份
			url = "admin.demandinfo.ajax.php?mode=professionlist";
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
   </script> 
</html>