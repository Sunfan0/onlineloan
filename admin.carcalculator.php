<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:50px;width:600px;">
			
			<form class="form-horizontal">
				<div class="form-group">
					<label class="col-sm-3 control-label">还款方式</label>
					<div class="col-sm-9">
						<select class="form-control" id="refundWay">
							<option value="1">等额本息</option>
							<option value="2">等额本金</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-3 control-label">还款期限</label>
					<div class="col-sm-9">
						<select class="form-control" id="refundYear">
							 <option value="1">一年</option>
		                     <option value="2">两年</option>
		                     <option value="3">三年</option>
		                     <option value="5">五年</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="loanMoney" class="col-sm-3 control-label">汽车贷款金额</label>
					<div class="col-sm-7">
						<input id="loanMoney" type="text" class="form-control" >
					</div>
					<label class="col-sm-2 control-label">万元</label>
				</div>
				<div class="form-group">
					<label for="loanRate" class="col-sm-3 control-label">汽车贷款利率</label>
					<div class="col-sm-7">
						<input id="loanRate" type="text" class="form-control" >
					</div>
					<label class="col-sm-2 control-label">%</label>
				</div>
				<!--<div class="form-group">
					<label for="showRefundInfo" class="col-sm-3 control-label">显示还款明细</label>
					<div class="col-sm-9">
						<select class="form-control" id="showRefundInfo">
							 <option value="1">是</option>
		                     <option value="0">否</option>
						</select>
					</div>
				</div>-->
				<div class="form-group">
					<div class="col-sm-3"></div>
					<div class="col-sm-9">
						<button id="reckonBtn" type="button" class="btn btn-primary">计算</button>  
					</div>
				</div>
				<div id="refundWayResult1" class="hidden">
					<div class="form-group">
						<label for="monthRefund1" class="col-sm-3 control-label">月均还款</label>
						<div class="col-sm-7">
							<input id="monthRefund1" type="text" class="form-control" readonly="readonly">
						</div>
						<label class="col-sm-2 control-label">元</label>
					</div>
					<div class="form-group">
						<label for="payInterest1" class="col-sm-3 control-label">支付利息</label>
						<div class="col-sm-7">
							<input id="payInterest1" type="text" class="form-control" readonly="readonly">
						</div>
						<label class="col-sm-2 control-label">元</label>
					</div>
					<div class="form-group">
						<label for="wholeRefund1" class="col-sm-3 control-label">还款总额</label>
						<div class="col-sm-7">
							<input id="wholeRefund1" type="text" class="form-control" readonly="readonly">
						</div>
						<label class="col-sm-2 control-label">元</label>
					</div>
				</div>
				<div id="refundWayResult2" class="hidden">
					<div class="form-group">
						<label for="payInterest2" class="col-sm-3 control-label">利息支出</label>
						<div class="col-sm-7">
							<input id="payInterest2" type="text" class="form-control" readonly="readonly">
						</div>
						<label class="col-sm-2 control-label">元</label>
					</div>
					<div class="form-group">
						<label for="wholeRefund2" class="col-sm-3 control-label">还款总额</label>
						<div class="col-sm-7">
							<input id="wholeRefund2" type="text" class="form-control" readonly="readonly">
						</div>
						<label class="col-sm-2 control-label">元</label>
					</div>
				</div>
			</form>
			
		</div>
	</body>
	<?php	include "footer.php";	?>
	<SCRIPT type="text/javascript">
		window.onload = function(){
			BindEvents();
		}
	
		function BindEvents(){
			$("#reckonBtn").click(function(){
				ToReckonCount();
			})
		}
		function ToReckonCount(){	
			$("#monthRefund1,#payInterest1,#wholeRefund1").val("");
			$("#payInterest2,#wholeRefund2").val("");
			
			var refundWay = $("#refundWay").val();	//1:等额本息;2:等额本金
			var refundYear = parseFloat($("#refundYear").val());	//还款年数
			var refundMoney = refundYear*12;	//还款月数
			var loanMoney = parseFloat($("#loanMoney").val())*10000;	//贷款金额
			var loanRate = parseFloat($("#loanRate").val())/100;	//贷款利率
			// var showRefundInfo = $("#showRefundInfo").val();	//是否显示详情
			
			
			if (refundWay == 1)//等额本息
			{
				$("#refundWayResult1").removeClass("hidden");
				$("#refundWayResult2").addClass("hidden");
				var monthRefund1 = loanRate*loanMoney/12+(loanRate*loanMoney/12)/(Math.pow((1+loanRate/12), refundMoney)-1);	//月均还款
				var payInterest1 = monthRefund1*refundMoney - loanMoney;	//支付利息
				var wholeRefund1 = monthRefund1*refundMoney;	//还款总额
				$("#monthRefund1").val(monthRefund1.toFixed(2));
				$("#payInterest1").val(payInterest1.toFixed(2));
				$("#wholeRefund1").val(wholeRefund1.toFixed(2));
			}
			else
			{
				$("#refundWayResult1").addClass("hidden");
				$("#refundWayResult2").removeClass("hidden");
				var x = 0;
				var sum = 0;
				for (i=1; i<=refundMoney; i++)
				{
					p = (loanMoney-x)*loanRate/12;				//偿还利息
					sum += (loanMoney-x)*loanRate/12;	//利息支出
					y = loanMoney/refundMoney + (loanMoney-x)*loanRate/12; 		//当期月供
					q = y -p;					//偿还本金
					x += loanMoney/refundMoney;
					z = loanMoney-x;						//剩余本金
				}
				var payInterest2 = sum;
				var wholeRefund2 = loanMoney+ sum;
				$("#payInterest2").val(payInterest2.toFixed(2));
				$("#wholeRefund2").val(wholeRefund2.toFixed(2));
			}
		}
	</script>
</html>