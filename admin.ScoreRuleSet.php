<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:20px;width:700px;">
			<div class="panel panel-default" style='width:700px'>
				<div class="panel-heading">
					<h3 class="panel-title">
						积分规则详情
					</h3>
				</div>
				<div class="panel-body" >
					<form class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-4 control-label" style='color:green'>发布一个产品获得积分</label>
							<div class="col-sm-8">
								<input type="hidden" id="flagid" class="form-control">
								<input type="text" id="publishgoodsscore" class="form-control">
							</div>
						</div>   
						<div class="form-group">
							<label class="col-sm-4 control-label" style='color:green'>每日发布产品获得积分上限</label>
							<div class="col-sm-8">
								<input type="text" id="goodsmaxscore" class="form-control">
							</div>
						</div>
						<br>
						<div class="form-group">
							<label class="col-sm-4 control-label" style='color:blue'>发布一条资讯获得积分</label>
							<div class="col-sm-8">
								<input type="text" id="publishinfoscore" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" style='color:blue'>每日发布资讯获得积分上限</label>
							<div class="col-sm-8">
								<input type="text" id="infomaxscore" class="form-control">
							</div>
						</div>
						<br>
						<div class="form-group">
							<label class="col-sm-4 control-label" style='color:red'>查看一个联系方式扣除积分</label>
							<div class="col-sm-8">
								<input type="text" id="lookcontactneed" class="form-control"> 
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" style='color:red'>资讯被置顶获得积分</label>
							<div class="col-sm-8">
								<input type="text" id="infostick" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" style='color:red'>***资讯被推荐获得积分</label>
							<div class="col-sm-8">
								<input type="text" id="inforecommended" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-4 control-label" style='color:red'>供方注册成功获得积分</label>
							<div class="col-sm-8">
								<input type="text" id="registscore" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-5"></div>
							<div class="col-sm-7">
								<button id="btnUpdate" type="button" class="btn btn-primary">更新</button>  
							</div>
						</div>
					</form>
				</div>
			</div>
		
		</div>
	</body>
	<?php	include "footer.php";	?>
	<SCRIPT type="text/javascript">
		window.onload = function(){
			BindEvents();
			ShowScoreSet();
		}
	
		function BindEvents(){
			$("#btnUpdate").click(function(){
				UpdateScoreType();
			});
		}
		function ShowScoreSet(){
		url = "admin.ScoreRuleSet.ajax.php?mode=ShowStandardScore";
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
				var data=eval("("+json+")");
console.log(data);
				$("#flagid").val(data.id);
				$("#publishgoodsscore").val(data.publishgoodsscore);
				$("#goodsmaxscore").val(data.goodsmaxscore);
				$("#publishinfoscore").val(data.publishinfoscore);
				$("#infomaxscore").val(data.infomaxscore);
				$("#lookcontactneed").val(data.lookcontactneed);
				$("#infostick").val(data.infostick);
				$("#inforecommended").val(data.inforecommended);
				$("#registscore").val(data.registscore);
			});
		}
		function UpdateScoreType(){
			flagid=$("#flagid").val();
			publishgoodsscore=$("#publishgoodsscore").val();
			goodsmaxscore=$("#goodsmaxscore").val();
			publishinfoscore=$("#publishinfoscore").val();
			infomaxscore=$("#infomaxscore").val();
			lookcontactneed=$("#lookcontactneed").val();
			infostick=$("#infostick").val();
			inforecommended=$("#inforecommended").val();
			registscore=$("#registscore").val();
			
			url = "admin.ScoreRuleSet.ajax.php?mode=UpdateStandardScore";
			$.get(url,{
				id : flagid,
				publishgoodsscore : publishgoodsscore,
				goodsmaxscore : goodsmaxscore,
				publishinfoscore : publishinfoscore,
				infomaxscore : infomaxscore,
				lookcontactneed : lookcontactneed,
				infostick : infostick,
				inforecommended : inforecommended,
				registscore : registscore
			},function(json,status){
				switch(json){
					case "1":
						CommonJustTip("更新成功！");
						ShowScoreSet();
						break;
					case "-1":
						CommonJustTip("系统繁忙！请稍后重试");
						break;
				}
			});

		}
	</script>
</html>