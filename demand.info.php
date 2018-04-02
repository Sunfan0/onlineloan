<?php	
	include "demand.header.php";
	$demandId = Get("demandId");
?>

		<div id="Maincontainer" class="container" style="margin-top:50px;">
			<!--<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<form class="navbar-form navbar-right" role="search">
						<a class="btn btn-primary text-right" href="demand.infolist.php"><< 返回</a>
					</form>							
				</div>
			</nav>-->
			<form id="RequiredInfo" class="form-horizontal" style="margin-left:-80px;">
				<!--<div class="form-group">
					<label for="DemandTitle" class="col-sm-2 control-label">标题</label>
					<div class="col-sm-4">
						<input id="DemandTitle" type="text" class="form-control" >
						<span class="submitprompt">*</span>
					</div>
					<label for="DemandTitleColor" class="col-sm-2 control-label">标题颜色</label>
					<div class="col-sm-3">
						<input type="text" id="DemandTitleColor" class="form-control colorDemo" data-position="bottom right" value="#000000">
					</div>
				</div>-->
				<div class="form-group">
					<label for="DemandName" class="col-sm-2 control-label submitprompt">姓名<span>*</span></label>
					<div class="col-sm-3">
						<input id="DemandName" type="text" class="form-control">
					</div>
					<label for="DemandSum" class="col-sm-2 control-label submitprompt">需求金额<span>*</span></label>
					<div class="col-sm-3">						
						<div class="input-group">
							<input id="DemandSum" type="number" class="form-control" >
							<span class="input-group-addon">万</span>
						</div>
					</div>
				</div>
				<!--<div class="form-group">
					<label for="DemandType" class="col-sm-2 control-label">贷款类型</label>
					<div class="col-sm-10">
						<select class="form-control" id="DemandType">
							
						</select>
						<span class="submitprompt">*</span>
					</div>
				</div>-->
				<div class="form-group">
					<label for="ProfessionId" class="col-sm-2 control-label">职业</label>
					<div class="col-sm-10">
						<select  id="ProfessionId" class="selectpicker  form-control"  data-live-search="false">
							<!--<option value="1">公务员</option>
							<option value="2">上班族</option>
							<option value="3">自由职业</option>
							<option value="4">个体</option>-->
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="DemandArea" class="col-sm-2 control-label submitprompt">地区<span>*</span></label>
					<div class="col-sm-10">
						<select class="form-control" id="DemandArea"></select>
					</div>
				</div>
				<div class="form-group">
					<label for="HouseProperty" class="col-sm-2 control-label">房产</label>
					<div class="col-sm-10">
						<select class="form-control" id="HouseProperty">
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
						<select class="form-control" id="CarProperty">
							<option value="1">无</option>
							<option value="2">全款车</option>
							<option value="3">按揭车</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="CreditDegree" class="col-sm-2 control-label">征信</label>
					<div class="col-sm-10">
						<select  id="CreditDegree" class="selectpicker  form-control"  data-live-search="false">
							<!--<option value="1">良好</option>-->
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="SocialSecurity" class="col-sm-2 control-label">社保</label>
					<div class="col-sm-10">
						<select class="form-control" id="SocialSecurity">
							<!--<option value="0">无</option>
							<option value="1">有</option>-->
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="Issecure" class="col-sm-2 control-label">是否有保险</label>
					<div class="col-sm-10">
						<select class="form-control" id="Issecure">
							<option value="0">否</option>
							<option value="1">是</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="CreditNumber" class="col-sm-2 control-label">信用卡</label>
					<div class="col-sm-10">
						<select class="form-control" id="CreditNumber">
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
						<select class="form-control" id="AgeStatus">
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
						<select class="form-control" id="MarriageStatus">
							<option value="1" checked>未婚</option>
							<option value="2">已婚</option>
							<option value="3">离异</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="ChildrenStatus" class="col-sm-2 control-label">子女</label>
					<div class="col-sm-10">
						<select class="form-control" id="ChildrenStatus">
							<option value="1" checked>无</option>
							<option value="2">有</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="CompanyStatus" class="col-sm-2 control-label">公司</label>
					<div class="col-sm-10">
						<select class="form-control" id="CompanyStatus">
							<option value="1" checked>无</option>
							<option value="2">法人</option>
							<option value="3">股东</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="CompanyFlow1" class="col-sm-2 control-label">公司流水</label>
					<div class="col-sm-3">						
						<div class="input-group">
							<input id="CompanyFlow1" type="number" class="form-control" >
							<span class="input-group-addon">万</span>
						</div>
					</div>
					<label for="CompanyFlow1" class="col-sm-2 control-label" style='text-align:center'>----------------------</label>
					<div class="col-sm-3">						
						<div class="input-group">
							<input id="CompanyFlow2" type="number" class="form-control" >
							<span class="input-group-addon">万每月</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="PersonalFlow1" class="col-sm-2 control-label">个人流水</label>
					<div class="col-sm-3">						
						<div class="input-group">
							<input id="PersonalFlow1" type="number" class="form-control" >
							<span class="input-group-addon">万</span>
						</div>
					</div>
					<label for="PersonalFlow2" class="col-sm-2 control-label" style='text-align:center'>----------------------</label>
					<div class="col-sm-3">						
						<div class="input-group">
							<input id="PersonalFlow2" type="number" class="form-control" >
							<span class="input-group-addon">万每月</span>
						</div>
					</div>
				</div>
				
				
				<!--<div class="form-group">
					<label for="PersonalFlow" class="col-sm-2 control-label">个人流水</label>
					<div class="col-sm-10">
						<input id="PersonalFlow" type="text" class="form-control" placeholder="如：10000-50000每月">
						
					</div>
				</div>-->
				<div class="form-group">
					<label for="DemandOther" class="col-sm-2 control-label">有无其他贷款</label>
					<div class="col-sm-10">
						<select class="form-control" id="DemandOther">
							<option value="1" checked>无</option>
							<option value="2">有</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="DemandTime" class="col-sm-2 control-label submitprompt">需求时间<span>*</span></label>
					<div class="col-sm-10">
						<select class="form-control" id="DemandTime">
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
						<textarea id="DemandExplain" class="form-control" rows="3" placeholder="其他说明介绍"></textarea>
					</div>
				</div>
				<!--<div class="form-group">
					<label for="ApplyTime" class="col-sm-2 control-label">申请时间</label>
					<div class="col-sm-10">
						<input id="ApplyTime" type="date" class="form-control"/>
					</div>
				</div>-->
				<div class="form-group">
					<label for="Aptitude" class="col-sm-2 control-label">资质</label>
					<div class="col-sm-10">
						<select class="form-control" id="Aptitude">
							<option value="1" checked>有车</option>
							<option value="2">有房</option>
							<option value="3">有车、有房</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="images" class="col-sm-2 control-label">资质上传(附件)</label>
					<div class="col-sm-4" style="text-align: left;">
						<input id="images" name="images[]" type="file" multiple data-min-file-count="1">
					</div>					
				</div>
				<div class="form-group">
					<label for="DemandMaxnumber" class="col-sm-2 control-label">可见人数</label>
					<div class="col-sm-10">
						<input type="number" class="form-control" id="DemandMaxnumber">
					</div>
				</div>
				<!--<div class="form-group">
					<label class="col-sm-2 control-label">可见权限</label>
					<div class="col-sm-10">
						<select class="form-control" id="DemandPower">
							<option value="1" checked>全部可见</option>
							<option value="2">仅供方可见</option>
							<option value="3">仅需方可见</option>
						</select>
						<span class="submitprompt">*</span>
					</div>
				</div>-->
				<!--<div class="form-group">
					<label class="col-sm-2 control-label">当前状态</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="DemandPutStatus" readonly>
					</div>						
					<div class="checkbox col-sm-3">
						<label>
							<input type="checkbox" id="DemandReleaseInput"></input><span id="DemandReleaseText"></span>
						</label>
					</div>
					<div class="col-sm-2" style="text-align: right;">
						<a id="UpdateTime" class="btn btn-primary">更新时间</a>
					</div>
				</div>-->
				<div class="form-group">
					<label for="DemandStatus" class="col-sm-2 control-label">状态</label>
					<div class="col-sm-10">
						<select class="form-control" id="DemandStatus">
							<option value="1" checked>需求中</option>
							<option value="2">不需要了</option>
						</select>
					</div>
					<!--<div class="col-sm-2" style="text-align: right;">
						<a id="UpdateTime" class="btn btn-primary">更新时间</a>
					</div>-->
				</div>
				<!--<div class="form-group" style="text-align: right;margin-right: 5px;">
					<div class="checkbox">
						<label>
							<input type="checkbox" id="DemandSetTop"> 将该需求置顶
						</label>
					</div>
				</div>-->
				<div class="form-group text-right">
					<a id="DeleteInfo" onclick="DeleteInfo();" class="btn btn-danger" style="margin-right:70%;">删除</a>
					<a onclick="RefreshInfo();" class="btn btn-warning" style="margin-right:15px;">刷新</a>
					<a href="demand.infolist.php" class="btn btn-default" style="margin-right:15px;">取消</a>
					<a onclick="SaveInfo();" class="btn btn-success" style="margin-right:18px;">保存</a>
				</div>
			</form>
		</div>
	</body>
	<?php	include "footer.php";	?>
	<script type="text/javascript">
		var Settings = {};
		Settings.imgurl = '';

		window.onload = OnLoad;

		<?php $timestamp = time();?>
		
		var demandId = "<?php echo $demandId; ?>";
		
		// var demandId = "1";

		function OnLoad(){
			BindEvents();
			$('#ProfessionId').selectpicker('val','');
			ShowProfession();
			$('#CreditDegree').selectpicker('val','');
			ShowNeedcredit();
			ShowAreaInfo();
			ShowSocialSecurity();
			// ShowProductType();
		}
		/*
		function ShowProductType(){//产品类型
			url = "demand.infolist.ajax.php?mode=producttypelist";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				for(var i=0;i<json.length;i++){
					strproducttype = "<option value="+json[i].id+">"+json[i].producttype+"</option>";
					$("#DemandType").append(strproducttype);
					//$('#DemandType').selectpicker('refresh');
				}
			});
		}
		*/
		/*SubareaData =  new Array();
		function ShowAreaInfo(){
			url = "demand.infolist.ajax.php?mode=subarealist";
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
		}*/
		function ShowAreaInfo(){
			url = "demand.infolist.ajax.php?mode=subarealist";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				for(var i=0;i<json.length;i++){
					strarea = "<option value="+json[i].id+">"+json[i].name+"</option>";
					$("#DemandArea").append(strarea);
				}
				Demandersubarea();
			});
		}
		function Demandersubarea(){
			url = "demand.infolist.ajax.php?mode=demandersubarea";
			$.get(url,function(json,status){
console.log("demandersubarea",json);
				if(json!="")
					$("#DemandArea").val(json);
			});
		}
		function ShowSocialSecurity(){//社保要求
			url = "demand.infolist.ajax.php?mode=socialsecuritylist";
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
			url = "demand.infolist.ajax.php?mode=creditlist";
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
			url = "demand.infolist.ajax.php?mode=professionlist";
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
			setTimeout(function(){
				if(demandId != ""){
					ModifyInfo();
					$("#DeleteInfo").removeClass("hidden");
				}else{
					AddInfo();
					$("#DeleteInfo").addClass("hidden");
				}
			},500)
		}
		
		function ShowColorDemo(){
			$('.colorDemo').each( function() {
				$(this).minicolors({
					control: $(this).attr('data-control') || 'hue',
					defaultValue: $(this).attr('data-defaultValue') || '',
					inline: $(this).attr('data-inline') === 'true',
					letterCase: $(this).attr('data-letterCase') || 'lowercase',
					opacity: $(this).attr('data-opacity'),
					position: $(this).attr('data-position') || 'bottom left',
					change: function(hex, opacity) {
						if( !hex ) return;
						if( opacity ) hex += ', ' + opacity;
						try {
							// console.log(hex);
						} catch(e) {}
					},
					theme: 'bootstrap'
				}); 
			});
		}
	
		function ModifyInfo(){
			$("#DeleteInfo").removeClass("hidden");
			$('#images').fileinput('refresh', {initialPreview:[]});
			//$("#DemandSetTop").prop("checked",false);
			$("#DemandMaxnumber").val(10);
			
			url = "demand.infolist.ajax.php?mode=ShowdemandinfoDetail&id="+demandId;
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
				
				/*var subarea = json.subarea;
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
				}*/
				$('#DemandArea').val(json.subarea);
				$("#SocialSecurity").val(json.socialsecurity);
				$("#Issecure").val(json.issecure);
				$("#CreditNumber").val(json.creditcardinfo);
				$("#AgeStatus").val(json.age);
				$("#MarriageStatus").val(json.marriage);
				$("#ChildrenStatus").val(json.children);
				$("#CompanyStatus").val(json.needcompanyid);
				
				companyarray=json.companyliushui.split("-"); 
				$("#CompanyFlow1").val(companyarray[0]);
				$("#CompanyFlow2").val(companyarray[1]);
				personalarray=json.personalliushui.split("-");
				$("#PersonalFlow1").val(personalarray[0]);
				$("#PersonalFlow2").val(personalarray[1]);
				
				
				$("#DemandOther").val(json.otherloans);
				$("#DemandTime").val(json.demandtime);
				$("#DemandExplain").val(json.otherdesc);
				$("#Aptitude").val(json.aptitude);
				$("#DemandMaxnumber").val(json.maxvisible);
				// $("#DemandPower").val(json.showright);
				$("#DemandStatus").val(json.demandstate);
				$('#images').fileinput('refresh', {initialPreview:[json.aptitudeimg]});
				Settings.imgurl = json.aptitudeimg;
				/*if(json.isstick == '1'){
					$("#DemandSetTop").prop("checked",true);
				}*/
				ShowColorDemo();
			});
		}
		function AddInfo(){
			$("#DeleteInfo").removeClass("hidden");
			$("#DemandName,#DemandSum,#DemandExplain,#CompanyFlow,#PersonalFlow").val("");
			$("#DemandMaxnumber").val(10);
			//$("#ProfessionId,#HouseProperty,#CarProperty,#CreditDegree,#AgeStatus").val("1");
			//$("#MarriageStatus,#ChildrenStatus,#CompanyStatus,#DemandOther,#DemandTime").val("1");
			//$("#Aptitude,#DemandPower,#DemandStatus").val("1");
			$('#images').fileinput('refresh', {initialPreview:[]});
			//$("#DemandSetTop").prop("checked",false);
			
			ShowColorDemo();
		}
		function SaveInfo(){			
			var data={};
			data.flagid = demandId;
			// data.title = $("#DemandTitle").val();
			// data.titlecolor = $("#DemandTitleColor").val();
			data.name = $("#DemandName").val();
			data.demandnum = $("#DemandSum").val();
			// data.demandtype =$("#DemandType").val();
			// if(data.title == ""){$("#DemandTitle").focus();CommonWarning('标题不能为空！');return;}
			if(data.name == ""){$("#DemandName").focus();CommonWarning('姓名不能为空！');return;}
			if(data.demandnum == ""){$("#DemandSum").focus();CommonWarning('需求金额不能为空！');return;}
			
			//data.profession = $("#ProfessionId").val();//多选
			var Professioninfo = $("#ProfessionId").val();
			// if(Professioninfo == null){$("#ProfessionId").focus();CommonWarning('职业不能为空！');return;}
			if(Professioninfo != null){
				for(i=0;i<Professioninfo.length;i++){
					for(a=0;a<ProfessionData.length;a++){
						if(Professioninfo[i] == ProfessionData[a].id){
							ProfessionData[a].status = 1;
						}
					}
				}
			}
			data.Professioninfo = ProfessionData;	
			
			data.houseproperty = $("#HouseProperty").val();
			data.carinfo = $("#CarProperty").val();
			
			//data.creditinvestigate = $("#CreditDegree").val();//多选
			var creditinfo = $("#CreditDegree").val();
			// if(creditinfo == null){$("#CreditDegree").focus();CommonWarning('征信不能为空！');return;}
			if(creditinfo != null){
				for(i=0;i<creditinfo.length;i++){
					for(a=0;a<NeedCreditData.length;a++){
						if(creditinfo[i] == NeedCreditData[a].id){
							NeedCreditData[a].status = 1;
						}
					}
				}
			}
			data.creditinfo = NeedCreditData;
			/*
			var subareainfo = $("#DemandArea").val();
			if(subareainfo == null){$("#DemandArea").focus();CommonWarning('地区不能为空！');return;}
			for(i=0;i<subareainfo.length;i++){
				for(a=0;a<SubareaData.length;a++){
					if(subareainfo[i] == SubareaData[a].id){
						SubareaData[a].status = 1;
					}
				}
			}
			data.subarea = SubareaData;*/
			data.subarea =  $("#DemandArea").val();
			data.issecure = $("#Issecure").val();
			data.creditcardinfo = $("#CreditNumber").val();
			data.socialsecurity = $("#SocialSecurity").val();
			data.age = $("#AgeStatus").val();
			data.marriage = $("#MarriageStatus").val();
			data.children = $("#ChildrenStatus").val();
			data.company = $("#CompanyStatus").val();
			data.companyrun = $("#CompanyFlow1").val()+'-'+$("#CompanyFlow2").val();
			data.personalrun = $("#PersonalFlow1").val()+'-'+$("#PersonalFlow2").val();
			data.otherloans = $("#DemandOther").val();
			data.demandtime = $("#DemandTime").val();
			data.otherdesc = $("#DemandExplain").val();
			data.aptitude = $("#Aptitude").val();
			
			// if(data.companyrun == ""){$("#CompanyFlow").focus();CommonWarning('公司流水不能为空！');return;}
			// if(data.personalrun == ""){$("#PersonalFlow").focus();CommonWarning('个人流水不能为空！');return;}
			
			data.maxvisible = 10;
			if($("#DemandMaxnumber").val()!=""){
				data.maxvisible = $("#DemandMaxnumber").val();
			}
			// data.showright = $("#DemandPower").val();
			data.demandstate = $("#DemandStatus").val();
			data.aptitudeimg = Settings.imgurl;
			data.isstick = '0';
			/*if($("#DemandSetTop").is(':checked')){
				data.isstick = '1';
			}*/
console.log(data);

			url = "demand.infolist.ajax.php?mode=Updatedemandinfo";
			$.post(url, {
				data : JSON.stringify(data)
			} ,function(json,status){
console.log(json);
				switch (json){
					case "1":
						window.location.href = "demand.infolist.php";
						break;
					default:
						CommonWarning('服务器忙，请稍候再试。');
				}
			});
		}
		function DeleteInfo(){
			$.confirm({
				title: '提示',
				content: '您确定删除该需求信息？',
				confirmButton: '确定',
				cancelButton: '取消',
				confirm: function(){
					url = "demand.infolist.ajax.php?mode=Deletedemandinfo&id="+demandId;
					$.post(url,function(json,status){
console.log(json);
						switch (json){
							case "1":
								window.location.href = "demand.infolist.php";
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
		function RefreshInfo(){
			$.confirm({
				title: '提示',
				content: '您确定刷新该需求信息？',
				confirmButton: '确定',
				cancelButton: '取消',
				confirm: function(){					
					url = "demand.infolist.ajax.php?mode=Refreshdemandinfo&id="+demandId;
					$.post(url,function(json,status){
console.log(json);
						switch (json){
							case "1":
								// window.location.reload();
								CommonJustTip('刷新成功。');
								break;
							case "-9":
								CommonWarning('刷新失败。您今天的刷新次数已用完！');
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
   </script> 
</html>