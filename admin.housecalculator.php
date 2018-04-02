<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:50px;width:600px;">
			
			<form class="form-horizontal">
				<div class="form-group">
					<label class="col-sm-6 control-label">计算方式</label>
					<div class="col-sm-6">
						<div class="checkbox-inline">
							<label for='TYPE1'>
							   <input type="radio" name="type" id="TYPE1"> 等额本金
							</label>
						 </div>
						 <div class="checkbox-inline">
							<label for='TYPE2'>
							   <input type="radio" name="type" id="TYPE2" > 等额本息
							</label>
						 </div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-6 control-label">利率</label>
					<div class="col-sm-6">
						<input type="hidden" id="flagid" class="form-control">
						<input type="text" id="setpara1" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-6 control-label">期限</label>
					<div class="col-sm-6">
						<input type="text" id="setpara2" class="form-control">
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
		window.onload = function(){
			BindEvents();
		}
	
		function BindEvents(){
			
		}
		
	</script>
</html>