<?php	include "header.php";	?>
		<div id="Maincontainer" class="container" style="margin-top:20px;margin-bottom:150px;width:700px;">
			<div class="panel panel-default" style='width:700px'>
				<div class="panel-heading">
					<h3 class="panel-title">
						审核设置详情
					</h3>
				</div>
				<div class="panel-body" >
					<form class="form-horizontal">
						<div class="form-group">
							<div class="col-sm-3"></div>
							<div class="col-sm-9">
								<div class="checkbox" style="text-align:left;">
									<label class="checkbox">
										<input type="checkbox" id="CheckPower1" value="供方注册不需要审核">供方注册不需要审核
									</label>
									<label class="checkbox">
										<input type="checkbox" id="CheckPower2" value="产品发布不需要审核">产品发布不需要审核
									</label>
									<label class="checkbox">
										<input type="checkbox" id="CheckPower3" value="需方注册不需要审核">需方注册不需要审核
									</label>
									<label class="checkbox">
										<input type="checkbox" id="CheckPower4" value="需求信息发布不需要审核">需求信息发布不需要审核
									</label>
									<label class="checkbox">
										<input type="checkbox" id="CheckPower5" value="供方资讯发布不需要审核">供方资讯发布不需要审核
									</label>
									<label class="checkbox">
										<input type="checkbox" id="CheckPower6" value="供方实名认证不需要审核">供方实名认证不需要审核
									</label>
								</div>
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-5"></div>
							<div class="col-sm-7">
								<button id="btnUpdate" type="button" class="btn btn-primary">提交</button>  
							</div>
						</div>
					</form>
				</div>
			</div>
		
		</div>
	</body>
	<?php	include "footer.php";	?>
	<script type="text/javascript">
		var Settings = {};
	
		window.onload = OnLoad;
		
		function OnLoad(){
			ShowResultList();
			$("#btnUpdate").click(function(){
				SaveInfo();
			})
		}
		function ShowResultList(){
			url = "admin.checkset.ajax.php?mode=ShowAlldata";
			$.get(url,function(json,status){
				if(json=="123"){
					CommonNopower();
					$("#Maincontainer").addClass("hidden");
					return;
				}
				if(json=="null"||json==null||json==""){
					CommonJustTip('暂无数据。');
					return;
				}
				json = eval("("+json+")");
				Settings.ModifyInfoId=json.id;
				result = eval("("+json.result+")");
				if(result.supplier == "1"){$("#CheckPower1").prop("checked", true);}
				if(result.supplyinfo == "1"){$("#CheckPower2").prop("checked", true);}
				if(result.demander == "1"){$("#CheckPower3").prop("checked", true);}
				if(result.demandinfo == "1"){$("#CheckPower4").prop("checked", true);}
				if(result.news == "1"){$("#CheckPower5").prop("checked", true);}
				if(result.modify == "1"){$("#CheckPower6").prop("checked", true);}
			});
		}

		function SaveInfo(){
		
			var supplier = 0;//供方注册
			var supplyinfo = 0;//产品发布
			var demander = 0;//需方注册
			var demandinfo = 0;//需求信息发布
			var news = 0;//供方资讯发布
			var modify = 0;//供方实名认证
			for(i=1;i<=6;i++){
				var powerChecked = $("#CheckPower"+i).is(":checked");
				if(powerChecked){
					switch(i){
						case 1:
							supplier = 1;
							break;
						case 2:
							supplyinfo = 1;
							break;
						case 3:
							demander = 1;
							break;
						case 4:
							demandinfo = 1;
							break;
						case 5:
							news = 1;
							break;
						case 6:
							modify = 1;
							break;
					}
				}
			}
			url = "admin.checkset.ajax.php?mode=UpdateCheck";
			$.post(url, {
				id : Settings.ModifyInfoId ,
				supplier : supplier,
				supplyinfo : supplyinfo,
				demander : demander,
				demandinfo : demandinfo,
				news : news,
				modify : modify,
			} ,function(json,status){
				switch (json){
					case "1":
						CommonJustTip("更新成功！");
						ShowResultList();
						break;
					default:
						CommonWarning("服务器忙，请稍候再试。");
				}
			});
		}
   </script> 
</html>