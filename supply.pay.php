<?php include "supply.header.php";?>

		<div id="Maincontainer" class="container" style="margin-top:20px;margin-bottom:20px;width:700px;">
			<div class="panel panel-default" style='width:700px'>
				<div class="panel-heading">
					<h3 class="panel-title">
						充值信息
					</h3>
				</div>
				<div class="panel-body" >
					<form class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-2 control-label">当前账号</label>
							<div class="col-sm-10" >admin</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">充值方式</label>
							<div class="col-sm-10">
								<div class="radio">
									<label style="margin-right:20px;"><input type="radio" name="optionsmoney" id="GoWritemoney" value="0"  checked="checked">填写充值金额</label>
									<label><input type="radio" name="optionsmoney" id="Goselectmoney" value="1">选择充值比例</label>
								</div>
							</div>
						</div>
						<div class="form-group" id='divpaymoney'>
							<label for="paymoney" class="col-sm-2 control-label">充值金额</label>
							<div class="col-sm-10">
								<input type="number" class="form-control" id="paymoney" placeholder="金额">
							</div>
						</div>
						
						<div class="form-group" id='divpayscore'>
							<label for="payscore" class="col-sm-2 control-label" >购买积分</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="payscore"  readonly>
							</div>
						</div>
						
						<div class="form-group" id='divgivescore'>
							<label for="givescore" class="col-sm-2 control-label" >获赠积分</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="givescore"  readonly>
							</div>
						</div>
						<div class="form-group hidden" id='divrechargescale'>
							<label for="rechargescale" class="col-sm-2 control-label">充值比例</label>
							<div class="col-sm-10">
								<div class="checkbox" style="text-align:left;">
									<select id="rechargescale" name="rechargescale" class="form-control"></select>
								</div>
							</div>
						</div>
						<div class="form-group">
							<label class="col-sm-2 control-label">支付方式</label>
							<div class="col-sm-10" style="padding-left: 35px;">
								<div class="radio" >
									<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked>支付宝充值（积分即时到账）
								</div>
								<div class="radio" style="text-align:left;">
									<input type="radio" name="optionsRadios" id="optionsRadios2" value="option1" checked>微信充值（积分即时到账）
								</div>
								<div class="radio" style="text-align:left;">
									<input type="radio" name="optionsRadios" id="optionsRadios3" value="option1" checked>银行转账（转账在机构后台提交申请，站方确认接收无误后手动增加积分）
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<div class="col-sm-5"></div>
							<div class="col-sm-7">
								<button onclick="SaveInfo()" type="button" class="btn btn-primary">确定</button>  
							</div>
						</div>
						<!--<div class="form-group form-group-lg text-right" style="text-decoration:underline;" >
							<a id="GoWritemoney" style="margin-right: 450px;">填写充值金额</a>
							<a id="Goselectmoney" style="margin-right: 20px;">选择充值比例</a>
						</div>-->
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
			BindEvents();
			ShowScorelist();
		}
		function BindEvents(){
			$("#GoWritemoney").click(function(){
				$("#divpaymoney").removeClass("hidden");
				$("#divpayscore").removeClass("hidden");
				$("#divgivescore").removeClass("hidden");
				$("#divrechargescale").addClass("hidden");
				
			})
			$("#Goselectmoney").click(function(){
				$("#divpaymoney").addClass("hidden");
				$("#divpayscore").addClass("hidden");
				$("#divgivescore").addClass("hidden");
				$("#divrechargescale").removeClass("hidden");
			})
			$("#paymoney").change(function(){
				CalScore();
			})
		}
		function ShowScorelist(){
			url = "supply.pay.ajax.php?mode=ScoreList";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);

// json = new Array();
// json[0]={};
// json[0].id=1;		
// json[0].cashnum=100;		
// json[0].score=100;		
// json[0].giftscore=10;
// json[1]={};
// json[1].id=2;		
// json[1].cashnum=200;		
// json[1].score=200;		
// json[1].giftscore=30;

				for(var i=0;i<json.length;i++){
					var strscore = "<option value='"+json[i].id+"'>充值"+json[i].cashnum+"元购买"+json[i].score+"积分，另赠送"+json[i].giftscore+"积分</option>";
					$("#rechargescale").append(strscore);
				}
			});
		}
		
		function CalScore(){
			//小于100，就只有等额的积分，无赠送积分
			//100-500,等额积分，赠送10%积分
			//大于500,等额积分，赠送20%积分
			var money = $("#paymoney").val();
			if(money<100){
				var score = money;
				var giftscore = 0;
			}else if(money>=100 && money<500){
				var score = money;
				var giftscore = money*0.1;
			}else{
				var score = money;
				var giftscore = money*0.2;
			}
			$("#payscore").val(parseInt(score));
			$("#givescore").val(parseInt(giftscore));
		}
   </script> 
</html>