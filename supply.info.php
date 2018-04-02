<?php	
	include "supply.header.php";
	$infoId = Get("infoId");
?>

		<div id="Maincontainer" class="container" style="margin-top:50px;">
			<!--<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<form class="navbar-form navbar-right" role="search">
						<a class="btn btn-primary text-right" href="supply.infolist.php"><< 返回</a>
					</form>							
				</div>
			</nav>-->
			<form id="RegisterForm" class="form-horizontal" style="margin-left:-80px;">
				<div class="form-group">
					<label for="GoodsName" class="col-sm-2 control-label submitprompt">产品名称<span>*</span></label>
					<div class="col-sm-10">
						<!--<textarea id="GoodsName" class="form-control" rows="3"></textarea>-->
						<input id="GoodsName" type="text" class="form-control" placeholder="贷款产品名称">
					</div>
				</div>
				<div class="form-group">
					<label for="GoodsType" class="col-sm-2 control-label submitprompt">产品类型<span>*</span></label>
					<div class="col-sm-10">
						<select class="form-control" id="GoodsType">
							<!--<option value="1">房产抵押</option>
							<option value="2">信用贷款</option>-->
						</select>
					</div>
					<!--<div class="col-sm-2" style="text-align: right;">
						<a onclick="AddGoodsType(); return false;" id="GoodsTypeadd" class="btn btn-primary">添加类型</a>
					</div>-->
				</div>
				<!--<div class="form-group">
					<label for="GoodsPercent" class="col-sm-2 control-label">贷款成数</label>
					<div class="col-sm-10">
						<select class="form-control" id="GoodsPercent">
							<option value="1">房产7层</option>
							<option value="2">按揭50倍</option>
						</select>
					</div>
				</div>-->
				<div class="form-group">
					<label for="InterestRate" class="col-sm-2 control-label submitprompt">利率<span>*</span></label>
					<div class="col-sm-10">
						<!--<button id="GoNewsInfo" class="btn btn-default  btn-block">︾&nbsp;&nbsp;&nbsp;展开</button>-->
						<div id="InterestRate" type="text/plain" style="width:100%;height:80px;"></div>
					</div>
					<!--<div class="col-sm-10">
						<select class="form-control" id="InterestRate">
							<option value="1">5年内利率为5.4%</option>
							<option value="2">10年内利率6.8%</option>
						</select>
					</div>-->
				</div>
				<div class="form-group">
					<label for="PaymentMethod" class="col-sm-2 control-label submitprompt">还款方式<span>*</span></label>
					<div class="col-sm-10">
						<select class="form-control" id="PaymentMethod">
							<!--<option value="1">等额本金</option>
							<option value="2">等额本息</option>-->
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label submitprompt">贷款期限<span>*</span></label>
					<!--<div class="col-sm-10">
						<input id="LoanTerm" type="text" class="form-control" placeholder="如：1-3个月">
					</div>-->
					<div class="col-sm-3">						
						<input id="LoanTerm1" type="number" class="form-control LoanTerm" >
					</div>
					<label class="col-sm-2 control-label" style='text-align:center'>----------------------</label>
					<div class="col-sm-3">						
						<div class="input-group">
							<input id="LoanTerm2" type="number" class="form-control LoanTerm" >
							<span class="input-group-addon">个月</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label submitprompt">可贷金额<span>*</span></label>
					<!--<div class="col-sm-10">
						<input id="LoanSum" type="text" class="form-control" placeholder="如：1-3W">
					</div>-->
					<div class="col-sm-3">						
						<input id="LoanSum1" type="number" class="form-control LoanSum" >
					</div>
					<label class="col-sm-2 control-label" style='text-align:center'>----------------------</label>
					<div class="col-sm-3">						
						<div class="input-group">
							<input id="LoanSum2" type="number" class="form-control LoanSum" >
							<span class="input-group-addon">万</span>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="WorkingLife" class="col-sm-2 control-label submitprompt">需要工作年限<span>*</span></label>
					<div class="col-sm-10">
						<select class="form-control" id="WorkingLife">
							<!--<option value="1">1-2年</option>
							<option value="2">2-3年</option>
							<option value="3">3-5年</option>
							<option value="4">5年以上</option>-->
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="IncomeRequest" class="col-sm-2 control-label submitprompt">收入要求<span>*</span></label>
					<div class="col-sm-10">
						
						<select class="form-control" id="IncomeRequest">
							<!--<option value="1">3000-5000</option>
							<option value="2">5000-10000</option>
							<option value="3">10000以上</option>-->
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="SocialRequest" class="col-sm-2 control-label submitprompt">社保要求<span>*</span></label>
					<div class="col-sm-10">
						
						<select class="form-control" id="SocialRequest">
							<!--<option value="1">3000-5000</option>
							<option value="2">5000-10000</option>
							<option value="3">10000以上</option>-->
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="AgeRequest" class="col-sm-2 control-label submitprompt">年龄要求<span>*</span></label>
					<div class="col-sm-10">
						<input id="AgeRequest" type="text" class="form-control" placeholder="如：18-30岁">
						<!--<select class="form-control" id="AgeRequest">
							<option value="1">40岁以下</option>
							<option value="2">40岁-60岁</option>
							<option value="3">60岁以上</option>
						</select>-->
					</div>
				</div>
				<!--<div class="form-group">
					<label for="GoodsArea" class="col-sm-2 control-label">地区</label>
					<div class="col-sm-10">
						<select class="form-control" id="GoodsArea">
							<option value="1">西安</option>
							<option value="2">北京</option>
							<option value="3">上海</option>
							<option value="4">天津</option>
						</select>
					</div>
				</div>-->
				<div class="form-group">
					<label for="ProfessionId" class="col-sm-2 control-label submitprompt">职业身份<span>*</span></label>
					<div class="col-sm-10 checkbox">
						<div id="ProfessionId"></div>
						<!--<select id="ProfessionId" class="selectpicker  form-control" multiple data-live-search="false"></select>-->
					</div>
				</div>
				<div class="form-group">
					<label for="IdRequest" class="col-sm-2 control-label submitprompt">身份要求<span>*</span></label>
					<div class="col-sm-10 checkbox" >
						<div id="IdRequest"></div>
						<!--<select id="IdRequest" class="selectpicker  form-control" multiple data-live-search="false"></select>-->
					</div>
				</div>
				<div class="form-group">
					<label for="CompanyRequest" class="col-sm-2 control-label submitprompt">公司要求<span>*</span></label>
					<div class="col-sm-10">
						<select class="form-control" id="CompanyRequest">
							<!--<option value="1">无公司</option>
							<option value="2">有公司</option>
							<option value="3">股东</option>-->
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="CompanyFlowRequest" class="col-sm-2 control-label submitprompt">公司流水<span>*</span></label>
					<div class="col-sm-10">
						<input id="CompanyFlowRequest" type="text" class="form-control" placeholder="如：100000-200000每月">
						<!--<select class="form-control" id="FlowRequest">
							<option value="1">无</option>
						</select>-->
					</div>
				</div>
				<div class="form-group">
					<label for="PersonalFlowRequest" class="col-sm-2 control-label submitprompt">个人流水<span>*</span></label>
					<div class="col-sm-10">
						<input id="PersonalFlowRequest" type="text" class="form-control" placeholder="如：10000-50000每月">
						<!--<select class="form-control" id="FlowRequest">
							<option value="1">无</option>
						</select>-->
					</div>
				</div>
				<div class="form-group">
					<label for="IndustryRequest" class="col-sm-2 control-label submitprompt">行业要求<span>*</span></label>
					<div class="col-sm-10">
						<textarea id="IndustryRequest" class="form-control" rows="3" placeholder="行业要求说明"></textarea>
						<!--<select class="form-control" id="IndustryRequest">
							<option value="1">无</option>
							<option value="1">金融类不行</option>
						</select>-->
					</div>
				</div>
				<div class="form-group">
					<label for="AssetsRequest" class="col-sm-2 control-label submitprompt">资产要求<span>*</span></label>
					<div class="col-sm-10">
						<select class="form-control" id="AssetsRequest">
							<!--<option value="1">红本房</option>
							<option value="2">按揭房</option>
							<option value="3">商铺</option>
							<option value="4">军产房</option>
							<option value="5">全款车</option>
							<option value="6">按揭车</option>-->
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="CreditRequest" class="col-sm-2 control-label submitprompt">征信要求<span>*</span></label>
					<div class="col-sm-10 checkbox">
						<div id="CreditRequest"></div>
						<!--<select id="CreditRequest" class="selectpicker  form-control" multiple data-live-search="false"></select>-->
					</div>
				</div>
				<div class="form-group">
					<label for="LoanTime" class="col-sm-2 control-label submitprompt">放款时间<span>*</span></label>
					<div class="col-sm-10">
						<input id="LoanTime" type="text" class="form-control" placeholder="如：1-3个工作日">
						<!--<select class="form-control" id="LoanTime">
							<option value="1">1-3个工作日</option>
						</select>-->
					</div>
				</div>
				<div class="form-group">
					<label for="FeaturesIntro" class="col-sm-2 control-label">特色介绍</label>
					<div class="col-sm-10">
						<textarea id="FeaturesIntro" class="form-control" rows="3" placeholder="特色内容介绍"></textarea>
					</div>
				</div>
				<!--<div class="form-group">
					<label for="GoodsImgBtn" class="col-sm-2 control-label">产品头图</label>
					<div class="col-sm-4" style="text-align: left;">
						<input id="GoodsImgBtn" name="GoodsImgBtn[]" type="file" multiple data-min-file-count="1">
					</div>					
				</div>
				<div class="form-group">
					<label for="GoodsTitle" class="col-sm-2 control-label">产品标题</label>
					<div class="col-sm-4">
						<input id="GoodsTitle" type="text" class="form-control" >
					</div>
					<label for="GoodsTitleColor" class="col-sm-3 control-label">标题颜色</label>
					<div class="col-sm-3">
						<input type="text" id="GoodsTitleColor" class="form-control colorDemo" data-position="bottom right" value="#000000">
					</div>
				</div>
				<div class="form-group">
					<label for="GoodsInfo" class="col-sm-2 control-label">产品信息</label>
					<div class="col-sm-10">
						<div id="GoodsInfo" type="text/plain" style="width:945px;height:400px;"></div>
					</div>
				</div>-->
				<!--<div class="form-group">
					<label class="col-sm-2 control-label">当前状态</label>
					<div class="col-sm-5">
						<input type="text" class="form-control" id="GoodsPutStatus" readonly>
					</div>						
					<div class="checkbox col-sm-3">
						<label>
							<input type="checkbox" id="GoodsReleaseInput"></input><span id="GoodsReleaseText"></span>
						</label>
					</div>
					<div class="col-sm-2" style="text-align: right;">
						<a id="UpdateTime" class="btn btn-primary">更新时间</a>
					</div>
				</div>-->
				<div class="form-group">
					<label class="col-sm-2 control-label">是否允许回复</label>
					<div class="col-sm-10">
						<div class="radio">
							<label class="checkbox-inline">
								<input type="radio" name="optionsRadios" class="GoodsReply"  value="0" checked>否
							</label>
							<label class="checkbox-inline">
								<input type="radio" name="optionsRadios" class="GoodsReply"  value="1">是
							</label>
						</div>
					</div>
				</div>
				<!--<div class="form-group" style="text-align: right;">
					<div class="checkbox">
						<label>
							<input type="checkbox" id="GoodsSetTop"> 将该产品置顶
						</label>
					</div>
				</div>-->
				<div class="form-group text-right">
					<a id="DeleteInfo" onclick="DeleteInfo();" class="btn btn-danger" style="margin-right:70%;">删除</a>
					<!--<a onclick="RefreshInfo();" class="btn btn-warning" style="margin-right:15px;">刷新</a>-->
					<a href="supply.infolist.php" class="btn btn-default" style="margin-right:15px;">取消</a>
					<a onclick="SaveInfo();" class="btn btn-success" style="margin-right:18px;">保存</a>
				</div>
			</form>
		</div>
	</body>
	<?php	include "footer.php";	?>
	<script type="text/javascript">
		var Settings = {};

		window.onload = OnLoad;

		<?php $timestamp = time();?>
		
		var infoId = "<?php echo $infoId; ?>";
		
// var infoId = "1";
	
		function OnLoad(){
			var ue = UE.getEditor('InterestRate');
			BindEvents();
			ShowProductType();
			ShowPayType();
			ShowWorkTime();
			ShowIncome();
			// $('#ProfessionId').selectpicker('val','');
			ShowProfession();
			// $('#IdRequest').selectpicker('val','');
			ShowNeedIdentity();
			ShowCompany();
			ShowProperty();
			// $('#CreditRequest').selectpicker('val','');
			ShowNeedcredit();
			ShowSocialSecurity();
		}
		ProfessionData =  new Array();
		function ShowProfession(){//职业身份
			url = "supply.infolist.ajax.php?mode=professionlist";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				for(var i=0;i<json.length;i++){
					// strprofession = "<option value="+json[i].id+">"+json[i].professiontype+"</option>";
					strprofession = "<label style='margin-right: 20px;'><input id='professioninfoid"+json[i].id+"' type='checkbox' value='"+json[i].id+"'>"+json[i].professiontype+"</label>";
					$("#ProfessionId").append(strprofession);
					// $('#ProfessionId').selectpicker('refresh');
					var d={};
					d.id = json[i].id;
					d.status = 0;
					ProfessionData.push(d);
				}
			});
		}
		NeedIdentityData =  new Array();
		function ShowNeedIdentity(){//身份要求
			url = "supply.infolist.ajax.php?mode=identitylist";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				for(var i=0;i<json.length;i++){
					// strprofession = "<option value="+json[i].id+">"+json[i].identity+"</option>";
					strprofession = "<label style='margin-right: 20px;'><input id='identityinfoid"+json[i].id+"' type='checkbox' value='"+json[i].id+"'>"+json[i].identity+"</label>";
					$("#IdRequest").append(strprofession);
					// $('#IdRequest').selectpicker('refresh');
					var d={};
					d.id = json[i].id;
					d.status = 0;
					NeedIdentityData.push(d);
				}
			});
		}
		NeedCreditData =  new Array();
		function ShowNeedcredit(){//征信要求
			url = "supply.infolist.ajax.php?mode=creditlist";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				for(var i=0;i<json.length;i++){
					// strprofession = "<option value="+json[i].id+">"+json[i].credit+"</option>";
					strprofession = "<label style='margin-right: 20px;'><input id='creditinfoid"+json[i].id+"' type='checkbox' value='"+json[i].id+"'>"+json[i].credit+"</label>";
					$("#CreditRequest").append(strprofession);
					// $('#CreditRequest').selectpicker('refresh');
					var d={};
					d.id = json[i].id;
					d.status = 0;
					NeedCreditData.push(d);
				}
			});
		}
		
		function ShowProperty(){//资产要求
			url = "supply.infolist.ajax.php?mode=propertylist";
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
			url = "supply.infolist.ajax.php?mode=producttypelist";
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
			url = "supply.infolist.ajax.php?mode=socialsecuritylist";
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
			url = "supply.infolist.ajax.php?mode=paytypelist";
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
			url = "supply.infolist.ajax.php?mode=worktimelist";
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
			url = "supply.infolist.ajax.php?mode=incomelist";
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
			url = "supply.infolist.ajax.php?mode=companylist";
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
		
		function BindEvents(){
			/* $("#GoodsImgBtn").fileinput('destroy');
				r = $("#GoodsImgBtn").fileinput({
				language: 'zh',
				uploadAsync: true,
				uploadUrl: 'bootstrap-fileinput-upload.php',
				allowedFileExtensions : ['jpg', 'png','gif',"pdf"],
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
				$('#GoodsImgBtn').fileinput('upload');
				
			}).on('fileuploaded', function(event, data, previewId, index) {//上传成功回调
				//alert(data.response.uploaded[0].file);
				arrimg.push(data.response.uploaded[0].file);
			}); */
			
			setTimeout(function(){
				if(infoId != ""){
					ModifyInfo();
					$("#DeleteInfo").removeClass("hidden");
				}else{
					AddInfo();
					$("#DeleteInfo").addClass("hidden");
				}
			},500)
		}
		
		/* function ShowColorDemo(){
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
		} */
	
		function ModifyInfo(){
			$("#DeleteInfo").removeClass("hidden");
			/* $("#GoodsName,#FeaturesIntro").val("");
			UE.getEditor('InterestRate').setContent("");
			$("#GoodsType,#GoodsPercent,#InterestRate,#PaymentMethod").val("1");
			$("#WorkingLife,#IncomeRequest,#ProfessionId,#IdRequest").val("1");
			$("#CompanyRequest,#FlowRequest,#IndustryRequest,#AssetsRequest,#CreditRequest,#LoanTime").val("1");
		*/
			// $("#GoodsSetTop").prop("checked",false); 
			$(".GoodsReply:eq(0)").attr("checked",'checked');
			
			url = "supply.infolist.ajax.php?mode=ShowsupplyinfoDetail&id="+infoId;
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				$("#GoodsName").val(json.productname);
				$("#GoodsType").val(json.producttype);
				//$("#GoodsPercent").val(json.loannum);
				UE.getEditor('InterestRate').setContent(json.rate);
				//$("#InterestRate").val(json.rate);
				$("#PaymentMethod").val(json.paytype);
				
				// $("#LoanTerm").val(json.paytime);
				// $("#LoanSum").val(json.paynum);
				
				paytimearray=json.paytime.split("-"); 
				$("#LoanTerm1").val(paytimearray[0]);
				$("#LoanTerm2").val(paytimearray[1]);
				paynumarray=json.paynum.split("-");
				$("#LoanSum1").val(paynumarray[0]);
				$("#LoanSum2").val(paynumarray[1]);
				
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
				// if(json.isstick == '1'){
					// $("#GoodsSetTop").prop("checked",true);
				// }
				

				var profession = json.profession;
				if(profession == null){
					// $('#ProfessionId').selectpicker('val','');
					$("[id^='professioninfoid']").prop("checked",false);
				}else{
					// var Selectprofession = new Array();
					for(i=0;i<profession.length;i++){
						// if($.inArray(profession[i].id, Selectprofession) == -1){
							// Selectprofession.push(profession[i].id);
						// }
						$("#professioninfoid"+profession[i].id).prop("checked",true);
					}
// console.log(Selectprofession);
					// $('#ProfessionId').selectpicker('val',Selectprofession);
					// $('#ProfessionId').selectpicker('refresh');
				}
				
				
				
				
				var identity = json.identity;
				if(identity == null){
					// $('#IdRequest').selectpicker('val','');
					$("[id^='identityinfoid']").prop("checked",false);
				}else{
					// var Selectidentity = new Array();
					for(i=0;i<identity.length;i++){
						// if($.inArray(identity[i].id, Selectidentity) == -1){
							// Selectidentity.push(identity[i].id);
						// }
						$("#identityinfoid"+profession[i].id).prop("checked",true);
					}
// console.log(Selectidentity);
					// $('#IdRequest').selectpicker('val',Selectidentity);
					// $('#IdRequest').selectpicker('refresh');
				}
				
				var credit = json.credit;
				if(credit == null){
					// $('#CreditRequest').selectpicker('val','');
					$("[id^='creditinfoid']").prop("checked",false);
				}else{
					// var Selectcredit = new Array();
					for(i=0;i<credit.length;i++){
						// if($.inArray(credit[i].id, Selectcredit) == -1){
							// Selectcredit.push(credit[i].id);
						// }
						$("#creditinfoid"+profession[i].id).prop("checked",true);
					}
// console.log(Selectcredit);
					// $('#CreditRequest').selectpicker('val',Selectcredit);
					// $('#CreditRequest').selectpicker('refresh');
				}
			});
		}
		function AddInfo(){
			$("#DeleteInfo").addClass("hidden");
			$("#GoodsName,#FeaturesIntro,.LoanTerm,.LoanSum,#AgeRequest,#CompanyFlowRequest,#PersonalFlowRequest,#IndustryRequest,#LoanTime").val("");
			UE.getEditor('InterestRate').setContent("");
			//$(".GoodsReply:eq(0)").attr("checked",'checked');
			// $("#GoodsSetTop").prop("checked",false);
		}
		/* function AddGoodsType(){
			var strcontent = '<p>请输入您要添加的产品类型:</p>';
			strcontent+= '<input id="GoodsAddText" type="text" class="form-control" >';
			$.confirm({
				title: '',
				content: strcontent,
				confirmButton: '确定',
				cancelButton: '取消',
				confirm: function(){
					var addtext = $("#GoodsAddText").val();
				},
				cancel: function(){
					return;
				}
			});
		} */
		function SaveInfo(){
			var data={};
			data.flagid = infoId;
			data.productname = $("#GoodsName").val();
			data.producttype = $("#GoodsType").val();
			//data.loannum = $("#GoodsPercent").val();
			data.rate = UE.getEditor('InterestRate').getContent();
			//data.rate = $("#InterestRate").val();
			data.paytype = $("#PaymentMethod").val();
			
			data.paytime = $("#LoanTerm1").val()+'-'+$("#LoanTerm2").val();
			data.paynum = $("#LoanSum1").val()+'-'+$("#LoanSum2").val();
			
			// data.paytime = $("#LoanTerm").val();
			// data.paynum = $("#LoanSum").val();
			
			data.needyear = $("#WorkingLife").val();
			data.needincome = $("#IncomeRequest").val();
			data.needage = $("#AgeRequest").val();
			data.socialrequest=$("#SocialRequest").val();
			
			if(data.productname == ""){$("#GoodsName").focus();CommonWarning('产品名称不能为空！');return;}
			if(data.producttype == ""){$("#GoodsType").focus();CommonWarning('产品类型不能为空！');return;}
			if(data.rate == ""){$("#InterestRate").focus();CommonWarning('利率不能为空！');return;}
			if(data.paytype == ""){$("#PaymentMethod").focus();CommonWarning('还款方式不能为空！');return;}
			if($("#LoanTerm1").val() == ""){$("#LoanTerm1").focus();CommonWarning('贷款期限不能为空！');return;}
			if($("#LoanTerm2").val() == ""){$("#LoanTerm2").focus();CommonWarning('贷款期限不能为空！');return;}
			if($("#LoanSum1").val() == ""){$("#LoanSum1").focus();CommonWarning('可贷金额不能为空！');return;}
			if($("#LoanSum2").val() == ""){$("#LoanSum2").focus();CommonWarning('可贷金额不能为空！');return;}
			if(data.needyear == ""){$("#WorkingLife").focus();CommonWarning('需要工作年限不能为空！');return;}
			if(data.needincome == ""){$("#IncomeRequest").focus();CommonWarning('收入要求不能为空！');return;}
			if(data.socialrequest == ""){$("#SocialRequest").focus();CommonWarning('社保要求不能为空！');return;}
			if(data.needage == ""){$("#AgeRequest").focus();CommonWarning('年龄要求不能为空！');return;}
			
			
			
			//data.needprofession = $("#ProfessionId").val();//多选
			// var Professioninfo = $("#ProfessionId").val();
			var Professioninfo = new Array();
			$("[id^='professioninfoid']").each(function(i){
			   if($(this).is(':checked')){
				   Professioninfo.push($(this).val());
			   }
			});
			if(Professioninfo == null){$("#ProfessionId").focus();CommonWarning('职业身份不能为空！');return;}
			for(i=0;i<Professioninfo.length;i++){
				for(a=0;a<ProfessionData.length;a++){
					if(Professioninfo[i] == ProfessionData[a].id){
						ProfessionData[a].status = 1;
					}
				}
			}
			data.Professioninfo = ProfessionData;	
			
			
			//data.nationality = $("#IdRequest").val();//多选
			// var identityinfo = $("#IdRequest").val();
			var identityinfo = new Array();
			$("[id^='identityinfoid']").each(function(i){
			   if($(this).is(':checked')){
				   identityinfo.push($(this).val());
			   }
			});
			if(identityinfo == null){$("#IdRequest").focus();CommonWarning('身份要求不能为空！');return;}
			for(i=0;i<identityinfo.length;i++){
				for(a=0;a<NeedIdentityData.length;a++){
					if(identityinfo[i] == NeedIdentityData[a].id){
						NeedIdentityData[a].status = 1;
					}
				}
			}
			data.identityinfo = NeedIdentityData;	
			
			data.needcompany = $("#CompanyRequest").val();
			data.companyliushui = $("#CompanyFlowRequest").val();
			data.personalliushui = $("#PersonalFlowRequest").val();
			data.worktype = $("#IndustryRequest").val();
			data.needproperty = $("#AssetsRequest").val();
			//data.needcredit = $("#CreditRequest").val();//多选
			
			if(data.needcompany == ""){$("#CompanyRequest").focus();CommonWarning('公司要求不能为空！');return;}
			if(data.companyliushui == ""){$("#CompanyFlowRequest").focus();CommonWarning('公司流水不能为空！');return;}
			if(data.personalliushui == ""){$("#PersonalFlowRequest").focus();CommonWarning('个人流水不能为空！');return;}
			if(data.worktype == ""){$("#IndustryRequest").focus();CommonWarning('行业要求不能为空！');return;}
			if(data.needproperty == ""){$("#AssetsRequest").focus();CommonWarning('资产要求不能为空！');return;}
			
			
			// var creditinfo = $("#CreditRequest").val();
			var creditinfo = new Array();
			$("[id^='creditinfoid']").each(function(i){
			   if($(this).is(':checked')){
				   creditinfo.push($(this).val());
			   }
			});
			if(creditinfo == null){$("#CreditRequest").focus();CommonWarning('征信要求不能为空！');return;}
			for(i=0;i<creditinfo.length;i++){
				for(a=0;a<NeedCreditData.length;a++){
					if(creditinfo[i] == NeedCreditData[a].id){
						NeedCreditData[a].status = 1;
					}
				}
			}
			data.needcredit = NeedCreditData;
			
			data.needtime = $("#LoanTime").val();
			data.Featuresintroduce = $("#FeaturesIntro").val();
			data.allowreply= $(".GoodsReply:checked").val();	
			data.isstick = '0';
			// if($("#GoodsSetTop").is(':checked')){
				// data.isstick = '1';
			// }
			if(data.needtime == ""){$("#LoanTime").focus();CommonWarning('放款时间不能为空！');return;}
			if(data.Featuresintroduce == ""){$("#FeaturesIntro").focus();CommonWarning('特色介绍不能为空！');return;}
			
console.log(JSON.stringify(data));
			
			
			url = "supply.infolist.ajax.php?mode=Updatesupplyinfo";
			$.post(url, {
				data : JSON.stringify(data)
			} ,function(json,status){
console.log(json);
				switch (json){
					case "1":
						window.location.href = "supply.infolist.php";
						break;
					case "-99":
						CommonWarning('当天发布产品数已达到上限');
						break;
					default:
						CommonWarning('服务器忙，请稍候再试。');
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
					url = "supply.infolist.ajax.php?mode=Deletesupplyinfo&id="+infoId;
					$.post(url,function(json,status){
console.log(json);
						switch (json){
							case "1":
								window.location.href = "supply.infolist.php";
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
		/*
		function RefreshInfo(){
			$.confirm({
				title: '提示',
				content: '您确定刷新该产品信息？',
				confirmButton: '确定',
				cancelButton: '取消',
				confirm: function(){
					url = "supply.infolist.ajax.php?mode=Refreshsupplyinfo&id="+infoId;
					$.post(url,function(json,status){
console.log(json);
						switch (json){
							case "1":
								// window.location.reload();
								CommonJustTip('刷新成功。');
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
		*/
   </script> 
</html>