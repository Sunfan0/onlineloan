<?php	include "supply.header.php";?>

		<div id="Maincontainer" class="container" style="margin-top:20px;margin-bottom:20px;width:700px;">
			<div class="panel panel-default" style='width:700px'>
				<div class="panel-heading">
					<h3 class="panel-title">
						我的积分
					</h3>
				</div>
				<div class="panel-body" >
					<form class="form-horizontal">
						<div class="form-group">
							<label class="col-sm-6 " style='text-align:right'>可用总积分：</label>
							<div class="col-sm-6">
								<span id='myscore' style='text-align:left'></span>
								
							</div>
						</div>
						<div class="form-group">
							<div class="col-sm-4"></div>
							<div class="col-sm-8">
								<button onclick="pay()" type="button" class="btn btn-primary">去充值</button>
								<button onclick="scorehistory()" type="button" class="btn btn-primary">查看积分履历</button>  
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
		function pay(){
			window.location.href = "supply.pay.php";
		};
		function scorehistory(){
		
			window.location.href = "supply.myscorehistory.php";
		}
		function OnLoad(){
			BindEvents();
			ShowNewsList();
		}
		function BindEvents(){
					
		}
		function ShowNewsList(){
			url = "supply.myscore.ajax.php?mode=getscore";
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
console.log(json);
				$("#myscore").text(json);
			});
		}
		function ShowNewsInfo(state,id){
			window.location.href = "supply.news.php?newsState="+state+"&newsId="+id;
		}
   </script> 
</html>