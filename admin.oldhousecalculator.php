<?php	include "header.php";	?>

		<div id="Maincontainer" class="container" style="margin-top:50px;width:600px;">
			
			<form class="form-horizontal">
				<div class="form-group">
					<label class="col-sm-6 control-label">计算方式</label>
					<div class="col-sm-6">
						<input type="radio" name="type" id="TYPE1" class="btn-default">
						<label class="control-label" for='TYPE1' checked>等额本金</label>
						
						<input type="radio" name="type" id="TYPR2" class=" btn-default ">
						<label class="control-label" for='TYPR2'>等额本息</label>
				</div>
				</div>
				<div class="form-group">
					<label class="col-sm-6 control-label">设置参数1</label>
					<div class="col-sm-6">
						<input type="hidden" id="flagid" class="form-control">
						<input type="text" id="setpara1" class="form-control">
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-6 control-label">设置参数2</label>
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