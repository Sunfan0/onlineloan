
		<!--主体部分-->
		<div class="contanier">
			<!--当前位置-->
			<div class="loaciton"><img src="images/location.png" alt="" />您当前的位置：
				<a class="hoverpointer" onclick="LocationHref('index')">首页</a> >
				<a href="#">关于我们详情</a>
			</div>
			<div class="content clearfix" style='margin-bottom: 20px;'>
				<div class="contleft">
					<div class="newscont bgborder">
						<div class="newstitle">
							<h2>{$footerinfo.title}</h2>
							<span>发布时间：{$footerinfo.createtime} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;来源：贷款信息网</span>														
						</div>
					<p>{$footerinfo.content}</p>	
					</div>
				</div>
				<div class="contright">

					<!--常用工具-->
					<div class='xindaidaixun-right'>
						<div class='xindaidaixun-right-top'>
							<div class='xindaidaixun-right-top-2'>
								<div class='div3-8'>
								</div>
								<span class='span3-5'>常用工具</span>
							</div>
						</div>
						<div class='xindaidaixun-right-buttom'>
							<div class='xindaidaixun-right-buttom-1'>
								<img src="images/01_34.jpg" alt="" onclick="LocationHref('fangdai')"/>
								<p>
									<span class='xindaidaixun-right-buttom-1-1' onclick="LocationHref('fangdai')">房贷计算器</span>
								</p>
							</div>

							<div class='xindaidaixun-right-buttom-1'>
								<img src="images/01_36.jpg" alt="" onclick="LocationHref('chedai')"/>
								<p>
									<span class='xindaidaixun-right-buttom-1-2'onclick="LocationHref('chedai')">车代计算器</span>
								</p>
							</div>

							<div class='xindaidaixun-right-buttom-1'>
								<img src="images/01_40.jpg" alt="" onclick="LocationHref('ershoufang')"/>
								<p>
									<span class='xindaidaixun-right-buttom-1-3' onclick="LocationHref('ershoufang')">二手房贷计算器</span>
								</p>
							</div>

							<div class='xindaidaixun-right-buttom-1'>
								<img src="images/01_42.jpg" alt="" onclick="LocationHref('gongjijin')"/>
								<p>
									<span class='xindaidaixun-right-buttom-1-4' onclick="LocationHref('gongjijin')">公积金贷款计算器</span>
								</p>
							</div>
						</div>
					</div>
					<!--快速贷款信息-->
					<div class='img2-form bgborder'>
						<p>快速贷款通道</p>
						<div class='img2-form-1'>
							<form>
								<input id="apply_money" type="text" placeholder="贷款金额（万元）" class='form-1-1' />
								<input id="apply_surname" type="text" placeholder="您的姓氏" class='form-1-2' />
								<select id="apply_sex" name="" id="" value='请选择' class='form-1-3'>
									<option value="1"><img src='images/men.jpg'>男</option>
									<option value="2">女</option>
								</select>
								<input id="apply_mobile" type="tel" placeholder="联系手机" class='form-1-4' />
								<input id="apply_code" type="text" placeholder="图片验证码" class='form-1-5' />
								<div id="apply_img" class='yanzhengma'></div>
								<input id="apply_mcode" type="text" placeholder="验证码" class='form-1-6' />
								<input id="apply_mcodebtn" type="button" value='获取验证码' class='button-1-1' />
								<input id="apply_submitbtn" type="button" value='提交贷款' class='button-1-2' />
							</form>
						</div>
					</div>			
				</div>
			</div>			
		</div>		
		<!--主体部分 end-->
		<script>
			console.log({json_encode($footerinfo)});
			console.log({json_encode($starttime)});
	
			window.onload = OnLoad;
			function OnLoad(){
				BindEvents();
				ShowTitlecon("{$footerinfo.title}");
			}
			function BindEvents(){
			}
		</script>
	</body>
</html>