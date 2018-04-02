<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:50px;width:600px;">
			
			<form class="form-horizontal">
				<!--<div class="form-group">
					<label class="col-sm-6 control-label">计算方式</label>
					<div class="col-sm-6">
						<input type="radio" name="type" id="TYPE1" class="btn-default">
						<label class="control-label" for='TYPE1' checked>等额本金</label>
						
						<input type="radio" name="type" id="TYPR2" class=" btn-default ">
						<label class="control-label" for='TYPR2'>等额本息</label>
				</div>
				</div>-->
				<div class="form-group">
					<label class="col-sm-6 control-label">公积金基准利率</label>
					<div class="col-sm-6">
						<div class="input-group">
							<input type="text" id="setpara1" class="form-control" aria-describedby="basic-addon2">
								<span class="input-group-addon" id="basic-addon2">%</span>
						</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class="col-sm-6"></div>
					<div class="col-sm-6">
						<button id="btnset" type="button" class="btn btn-primary">确定</button>  
					</div>
				</div>
			</form>
		</div>
	</body>
	<?php	include "footer.php";	?>
	<SCRIPT type="text/javascript">
		var setid;
		window.onload = function(){
		
			BindEvents();
			ShowContent();
		}
		function ShowContent(){
			//显示当前利率
			url = "admin.publicfundscalculator.ajax.php?mode=ShowRate";
			$.get(url,function(json,status){
				if(json=="123"){
					CommonNopower();
					$("#Maincontainer").addClass("hidden");
					return;
				}
				if(json=="null"){
					CommonJustTip('暂无数据。');
					return;
				}
				json=eval("("+json+")");
//console.log(json);
				str=Number(json.rate*100).toFixed(3);
				//str+="%";
				$("#setpara1").val(str);
				setid=json.id;
			});
		}
		function BindEvents(){
			$("#btnset").click(function(){
				rate=$("#setpara1").val();
				rate=rate.replace("%","");
				rate= rate/100;
				url = "admin.publicfundscalculator.ajax.php?mode=UpdateRate";
				$.get(url,{
					id : setid,
					rate : rate
				},function(json,status){
					switch(json){
						case "1":
							CommonJustTip("更新成功！");
							ShowContent();
							break;
						case "-1":
							CommonJustTip("系统繁忙！请稍后重试");
							break;
					}
				});
				
			})
		}
		
	</script>
</html>