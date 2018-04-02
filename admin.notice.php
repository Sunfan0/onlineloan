<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:30px;">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<form class="navbar-form navbar-right" role="search">
						<button class="btn btn-primary text-right" onclick="AddInfo(); return false;">+ 新增广告</button>
					</form>							
				</div>
			</nav>
			<table id="ContentTable" class="table table-hover table-bordered"></table>
			<div class="modal fade" id="CooperationInfo">  
			  <div class="modal-dialog" style="width:800px;">  
				<div class="modal-content message_align">  
				  <div class="modal-header">  
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>  
					<h5 id="AddTitle" class="modal-title">修改信息</h5>  
				  </div>  
				  <div class="modal-body text-center">  
					<form class="form-horizontal">
						<div class="form-group">
							<label for="AdvertMaster" class="col-sm-2 control-label">广告主</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="AdvertMaster" >
							</div>
						</div>
						<div class="form-group">
							<label for="AdvertName" class="col-sm-2 control-label">广告名称</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="AdvertName" >
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">广告图片</label>
							<div class="col-sm-10" style="text-align: left;">
								<input id="images" name="images[]" type="file" multiple data-min-file-count="1">
							</div>
						</div>
						<div class="form-group">
							<label for="AdvertUrl" class="col-sm-2 control-label">链接</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="AdvertUrl" placeholder="链接">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">当前状态</label>
							<div class="col-sm-7">
								<input type="text" class="form-control" id="AdvertStatus" readonly>
							</div>						
							<div class="checkbox col-sm-3">
								<label>
									<input type="checkbox" id="AdvertRelease"></input><span id="AdvertReleaseText"></span>
								</label>
							</div>
						</div>
					</form>
				  </div>  
				  <div class="modal-footer">
					<button id="DeletCooperationInfo" onclick="DeletInfo()" style="margin-right:570px;" type="button" class="btn btn-danger">删除</button>
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
		window.onload = OnLoad;
		var arrimg=new Array();
		function OnLoad(){
			BindEvents();
			ShowCooperationList();
		}
		function BindEvents(){
				$("#images").fileinput('destroy');
				r = $("#images").fileinput({
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
					$('#images').fileinput('upload');
					
				}).on('fileuploaded', function(event, data, previewId, index) {//上传成功回调
					//alert(data.response.uploaded[0].file);
					arrimg.push(data.response.uploaded[0].file);
				});
		}
		

		function ShowCooperationList(){
			$("#ContentTable").html("");
			
			strTable = "<thead><tr><th>ID</th><th>广告主</th><th>广告名称</th><th>创建时间</th><th>发布状态</th><th>操作</th></tr></thead><tbody id='contentTbody'></tbody>"	
			$("#ContentTable").append(strTable);
			$("#contentTbody").html("");
			for(i=0;i<5;i++){
					strTbody = '<tr onclick="ModifyInfo('+(i+1)+')"><td>'+(i+1)+'</td><td id="d'+(i+1)+'">广告主'+(i+1)+'</td>';
					strTbody += '<td id="'+(i+1)+'">广告名称'+(i+1)+'</td><td id="'+(i+1)+'">****/**/**</td><td id="'+(i+1)+'">已发布'+(i+1)+'</td>';
					strTbody += '<td><button class="btn btn-primary btn-sm" >编辑</button></td></tr>';
					
					$("#contentTbody").append(strTbody);
			}	
			
		}
	
		
		
		function ModifyInfo(id){
			t1=$("#"+id).html();
			t2=$("#"+id).html();
			$('#CooperationInfo').modal({backdrop: 'static', keyboard: false});
			$('#AddTitle').text("修改广告信息");
			$("#DeletCooperationInfo").css('display','');
			$("#AdvertName").val(t1);
			$("#AdvertMaster").val(t2);
			//$("#AdvertUrl").val("");
			$("#AdvertStatus").val(status);
			$("#AdvertRelease").prop("checked", false);
			var statusCode = 0;
			switch(statusCode){
				case "0":
					var status = "未发布";
					$("#AdvertStatus").val(status);
					$("#AdvertReleaseText").html("发布广告");
					break;
				case "1":
					var status = "已发布";
					$("#AdvertStatus").val(status);
					$("#AdvertReleaseText").html("撤销发布");
					break;
				case "-1":
					var status = "已撤销发布";
					$("#AdvertStatus").val(status);
					$("#AdvertReleaseText").html("重新发布");
					break;
			}
		}
		function AddInfo(){
			Settings.EditState = "add";
			Settings.Currentstatus = "0";
			$('#CooperationInfo').modal({backdrop: 'static', keyboard: false});
			$('#AddTitle').text("填写广告信息");
			$("#DeletCooperationInfo").css('display','none');
			$("#AdvertName,#AdvertMaster").val("");
			//$("#AdvertUrl").val("");
			$("#AdvertStatus").val(status);
			$("#AdvertRelease").prop("checked", false);
			var statusCode = 0;
			switch(statusCode){
				case "0":
					var status = "未发布";
					$("#AdvertStatus").val(status);
					$("#AdvertReleaseText").html("发布广告");
					break;
				case "1":
					var status = "已发布";
					$("#AdvertStatus").val(status);
					$("#AdvertReleaseText").html("撤销发布");
					break;
				case "-1":
					var status = "已撤销发布";
					$("#AdvertStatus").val(status);
					$("#AdvertReleaseText").html("重新发布");
					break;
			}
		}
		function SaveInfo(){
			/* var flagid = "";
			if(Settings.EditState == "modify"){
				flagid = Settings.ModifyInfoId;
			}
			var publishid = Settings.Currentstatus;	//提交当前新状态--不做改变
			if($("#CommodityRelease").is(":checked")){
				switch(Settings.Currentstatus){
					case "0":
						publishid = "1";	//未发布-->发布
						break;
					case "1":
						publishid = "-1";	//已发布-->撤销发布
						break;
					case "-1":
						publishid = "1";	//已撤销发布-->发布
						break;
				}
			}
			var picurl = $("#CommodityImg").attr("src");
			var name = $("#AdvertName").val();
			var explaintext = $("#CommodityExplain").val();
			var shortdesc = $("#AdvertMaster").val();
			var description1 = UE.getEditor('CommodityDescription1').getContent();
			var description2 = UE.getEditor('CommodityDescription2').getContent();
			var description3 = UE.getEditor('CommodityDescription3').getContent();
			var price1 = $("#CommodityPrice1").val();
			var price2 = $("#CommodityPrice2").val();
			var price3 = $("#CommodityPrice3").val();
			var score1 = $("#CommodityScore1").val();
			var score2 = $("#CommodityScore2").val();
			var score3 = $("#CommodityScore3").val();
			var type = $("#CommodityType").val();
			var count = $("#CommodityTypeNumber").val();
			var code = $("#CommodityTypeInput").val(); */
			/* switch(type){
				case "10":
					code = "";
					break;
				case "80":
					code = $("#CommodityTypeInput").val();
					break;
				case "90":
					count = $("#CommodityTypeNumber").val();
					code = $("#CommodityTypeTextarea").val();
					var newcount = 0;
					var newcode = "";
					var oldcode= new Array();
					oldcode = $("#CommodityTypeTextarea").val().split(/[\r\n]/g);
					for (i=0;i<oldcode.length;i++ ){
						if(oldcode[i] == ""){
							continue;
						}
						if(i == oldcode.length){
							newcode += oldcode[i];
						}else{
							newcode += oldcode[i]+"\r\n";
						}
						newcount++;
					}
					console.log(newcode);
					if(newcount != count){
						CommonWarning('请确保您限制数量与输入兑换码的数量一致！');
						return;
					} 
					break;
			}*/
			
			
			if($("#AdvertName").val() == ""){
				CommonWarning('合作机构名称不能为空！');
				return;
			}
			
			if($("#AdvertMaster").val() == ""){
				CommonWarning('简单描述不能为空！');
				return;
			}
			if($("#AdvertUrl").val() == ""){
				CommonWarning('链接不能为空！');
				return;
			}
			/* url = "commodity.ajax.php?mode=UpdateEditGoods";
			$.post(url, {
				flagid : flagid,
				publishid : publishid,		//判断是发布还是提交信息//只提交信息0，发布1，撤销-1
				name : name,
				picurl : picurl,
				explaintext : explaintext,
				shortdesc : shortdesc,
				description1 : description1,
				description2 : description2,
				description3 : description3,
				price1 : price1,
				price2 : price2,
				price3 : price3,
				score1 : score1,
				score2 : score2,
				score3 : score3,
				count : count,
				type : type,	//商品类型(10实物商品80不限量虚拟商品90限量虚拟商品)
				code : code				
			} ,function(json,status){
				// console.log(json);
				switch (json){
					case "1":
						ShowCooperationList();
						$('#CooperationInfo').modal('toggle');
						break;
					case "-99":
						CommonWarning('请确保您限制数量与输入兑换码的数量一致！');
						break;
					default:
						CommonWarning('服务器忙，请稍候再试。');
				}
			}); */
		}
		function DeletInfo(){
			$.confirm({
				title: '提示',
				content: '您确定删除该合作机构信息？',
				confirmButton: '确定',
				cancelButton: '取消',
				confirm: function(){
					/* url = "manager.ajax.php?mode=DeleteBgmanager&id="+Settings.ModifyInfoId;
					$.get(url,function(json,status){
						console.log(json);
						switch (json){
							case "1":
								ShowKeywordList();
								$('#KeywordInfo').modal('toggle');
								break;
							default:
								CommonWarning("服务器忙，请稍候再试。");
								break;
						}
					}); */
				},
				cancel: function(){
					return;
				}
			});
		}	
		
   </script> 
</html>