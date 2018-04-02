<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:20px;width:700px;">
			<div class="panel panel-default" style='width:700px'>
				<div class="panel-heading">
					<h3 class="panel-title">
						详情设置
					</h3>
				</div>
				<div class="panel-body" >
					<form class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-5 control-label" style='color:green'>供方每天免费刷新个人信息次数上限</label>
							<div class="col-sm-7">
								<input type="hidden" id="flagid" class="form-control">
								<input type="text" id="refreshinfomaxnum" class="form-control">
							</div>
						</div>   
						<div class="form-group">
							<label class="col-sm-5 control-label" style='color:green'>供方刷新个人信息超出上限每次扣除积分</label>
							<div class="col-sm-7">
								<input type="text" id="refreshinfotakescore" class="form-control">
							</div>
						</div>
						<br>
						<div class="form-group">
							<label class="col-sm-5 control-label" style='color:red'>供方每天免费刷新产品次数上限</label>
							<div class="col-sm-7">
								<input type="text" id="refreshproductmaxnum" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-5 control-label" style='color:red'>供方刷新产品超出上限每次扣除积分</label>
							<div class="col-sm-7">
								<input type="text" id="refreshproducttakescore" class="form-control">
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-5 control-label" style='color:red'>资讯是否允许回复</label>
							<div class="col-sm-7">
								<div class="radio">
									<label class="checkbox-inline">
										<input type="radio" name="optionsRadios" class="NewsReply"  value="0" checked>否
									</label>
									<label class="checkbox-inline">
										<input type="radio" name="optionsRadios" class="NewsReply" value="1">是
									</label>
								</div>
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
		url = "admin.OtherSet.ajax.php?mode=ShowStandard";
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
				if(data.newsallowreply == "1"){$(".NewsReply:eq(1)").attr("checked",'checked'); }
				$("#refreshinfomaxnum").val(data.refreshinfomaxnum);
				$("#refreshinfotakescore").val(data.refreshinfotakescore);
				$("#refreshproductmaxnum").val(data.refreshproductmaxnum);
				$("#refreshproducttakescore").val(data.refreshproducttakescore);
			});
		}
		function UpdateScoreType(){
			flagid=$("#flagid").val();
			refreshinfomaxnum=$("#refreshinfomaxnum").val();
			refreshinfotakescore=$("#refreshinfotakescore").val();
			refreshproductmaxnum=$("#refreshproductmaxnum").val();
			refreshproducttakescore=$("#refreshproducttakescore").val();
			newsallowreply = $(".NewsReply:checked").val();
			url = "admin.OtherSet.ajax.php?mode=UpdateStandard";
			$.get(url,{
				id : flagid,
				refreshinfomaxnum : refreshinfomaxnum,
				refreshinfotakescore : refreshinfotakescore,
				refreshproductmaxnum : refreshproductmaxnum,
				refreshproducttakescore : refreshproducttakescore,
				newsallowreply:newsallowreply
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