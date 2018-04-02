<?php
 include "paras.php";
 $strSql = " Select * From calculateloanofoldhouse order by createtime limit 0,1 ";
 $showdata = DBGetDataRow($strSql);
 $newrate1=$showdata["rate"];
 $newrate=($newrate1*100).'%';
 include "smartycal.new.php";
?>
		<div class="contanier calotherdiv">
			<!--当前位置-->
			
			<div class="loaciton"><img src="images/location.png" alt="" />您当前的位置：
				<a class="hoverpointer" onclick="LocationHref('index')">首页</a> >
				<a class="hoverpointer" onclick="SkipHref('ershoufang')">二手房贷计算器</a> 
			</div>
			<div class="content clearfix">
				<div class="contleft">
					<div class="newscont bgborder" style="padding: 0px 20px 20px;">
						<div class="content-block input-block">
							<h3><span>输入数据</span></h3>
							<div class="input_fangdai">
								<table class='div1'>
									<tr>
										<td width="110">计算方式</td>
										<td>
											<input type="radio" name="sy_type" id="sy_type_1" value="1" checked /> <label for="sy_type_1">按贷款额度算</label>&nbsp;&nbsp;
											<input type="radio" name="sy_type" id="sy_type_2" value="2" /> <label for="sy_type_2">按面积算</label>
										</td>
									</tr>
									 <tr class="div1_1h">
										<td>贷款金额</td>
										<td>
											<div class="input-group" style="margin: 0;">
												<input type="text" class="inpt" id="dkje_1">
												<span class="input-group-addon">万元</span>
											</div>
										</td>
									</tr>
									<tr class="div1_2 hidden">
										<td>平米单价</td>
										<td>
											<div class="input-group"  style="margin: 0;">
												<input type="text" class="inpt" id="pmdj_1" />
												<span class="input-group-addon">元/平米</span>
											</div>
										</td>
									</tr>
									<tr class="div1_2 hidden">
										<td>面积</td>
										<td>
											<div class="input-group" style="margin: 0;">
												<input type="text" class="inpt" id="mj_1" />
												<span class="input-group-addon">平米</span>
											</div>
										</td>
									</tr>
									<tr class="div1_2 hidden">
										<td>购房性质</td>
										<td style="position:relative;z-index:1000">
											<input type="radio" name="sy_gfxz" id="sy_gfxz_1" value="1" checked /><label for="sy_gfxz_1">一套房</label>&nbsp;&nbsp;
											<input type="radio" name="sy_gfxz" id="sy_gfxz_2" value="2" /><label for="sy_gfxz_2">二套房</label><span class="help" style="margin-top:2px;*margin-top:13px" id="sy_etf"></span>
										</td>
									</tr>										
									<tr class="div1_2 hidden">
										<td>首付</td>
										<td>
											<div class="input-group" style="margin: 0;">
												<select id="div2shoufu"  class="inpt" value='请选择' >
													<option value="0.3">3</option>
													<option value="0.4">4</option>
													<option value="0.5">5</option>
													<option value="0.6">6</option>
													<option value="0.7">7</option>
													<option value="0.8">8</option>
													<option value="0.9">9</option>
												</select>
												<span class="input-group-addon">成</span>
											</div>
										</td>
									</tr>
									
									<tr class="div1_1">
										<td>贷款期限</td>
										<td>
											<div class="inpt-wrap input-group" style="margin: 0;">
												<select id="div1time" class="inpt">
													<option value="5">5</option>
													<option value="10">10</option>
													<option value="15">15</option>
													<option value="20">20</option>
													<option value="25">25</option>
													<option value="30">30</option>
												</select>
												<span class="input-group-addon sb_inp_suffix">年</span>
											</div>
										</td>
									</tr>
									<tr>
										<td>年利率</td>
										<td>
											<div class="input-group">
												<select id="div1rate" class="inpt" style="width:180px;">
													<option value="0.7">最新基准利率的7折</option>
													<option value="0.8">最新基准利率的8折</option>
													<option value="0.83">最新基准利率的8.3折</option>
													<option value="0.85">最新基准利率的8.5折</option>
													<option value="0.88">最新基准利率的8.8折</option>
													<option value="0.9">最新基准利率的9折</option>
													<option value="0.95">最新基准利率的9.5折</option>
													<option value="1" selected>最新基准利率</option>
													<option value="1.05">最新基准利率的1.05倍</option>
													<option value="1.1">最新基准利率的1.1倍</option>
													<option value="1.2">最新基准利率的1.2倍</option>
													<option value="1.3">最新基准利率的1.3倍</option>
												</select>
												<input type="text" class="inpt" id="dklv" style="width: 50px;">
												<span class="input-group-addon">%</span>
											</div>
											
										</td>
									</tr>
									<tr>
										<td></td>
										<td class="btntd"><button class="btn cal-btn" id="btncalculate" >计 算</button><button class="btn reset-btn" id="btnreset" >重 置</button></td>
									</tr>
								</table>
							</div>
						</div>
						<div class="content-block result-block">
							<h3><span>输出结果</span></h3>
							<div class="result_fangdai">
								<div class="panel panel-info" style="margin-right: 50px;">
									 <div class="panel-heading">每月等额还款</div>
									 <table cellpadding="0" cellspacing="0" class="tbl" style="width:310px;">
										<tr>
											<td class="td1">贷款总额</td>
											<td class="td2"><span id="_debx_dkje">0</span>元</td>
										</tr>
										<tr>
											<td class="td1">还款月数</td>
											<td class="td2"><span id="_debx_dkqx">0</span>月</td>
										</tr>
										<tr height="50">
											<td class="td1">每月还款</td>
											<td class="td2"><span id="_debx_myhk">0</span>元</td>
										</tr>
										<tr>
											<td class="td1">总支付利息</td>
											<td class="td2"><span id="_debx_zflx">0</span>元</td>
										</tr>
										<tr>
											<td class="td1">本息合计</td>
											<td class="td2"><span id="_debx_hkze">0</span>元</td>
										</tr>
									</table>      
								</div>
								<div class="panel panel-info">
									 <div class="panel-heading">逐月递减还款</div>
									 <table cellpadding="0" cellspacing="0" class="tbl" style="width:310px;">
										<tr>
											<td class="td1">贷款总额</td>
											<td class="td2"><span id="_debj_dkje">0</span>元</td>
										</tr>
										<tr>
											<td class="td1">还款月数</td>
											<td class="td2"><span id="_debj_dkqx">0</span>月</td>
										</tr>
										<tr height="50">
											<td class="td1">首月还款</td>
											<td class="td2" style="line-height:20px"><span id="_debj_syhk">0</span>元<br/>每月递减：<span id="_debj_mydj">0</span>元</td>
										</tr>
										<tr>
											<td class="td1">总支付利息</td>
											<td class="td2"><span id="_debj_zflx">0</span>元</td>
										</tr>
										<tr>
											<td class="td1">本息合计</td>
											<td class="td2"><span id="_debj_hkze">0</span>元</td>
										</tr>
									</table> 
								</div>
							</div>
						</div>
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
								<img src="images/01_34.jpg" alt="" onclick="SkipHref('fangdai')"/>
								<p>
									<span class='xindaidaixun-right-buttom-1-1' onclick="SkipHref('fangdai')">房贷计算器</span>
								</p>
							</div>

							<div class='xindaidaixun-right-buttom-1'>
								<img src="images/01_36.jpg" alt="" onclick="SkipHref('chedai')"/>
								<p>
									<span class='xindaidaixun-right-buttom-1-2' onclick="SkipHref('chedai')">车贷计算器</span>
								</p>
							</div>

							<div class='xindaidaixun-right-buttom-1'>
								<img src="images/01_40.jpg" alt="" onclick="SkipHref('ershoufang')"/>
								<p>
									<span class='xindaidaixun-right-buttom-1-3' onclick="SkipHref('ershoufang')">二手房贷计算器</span>
								</p>
							</div>

							<div class='xindaidaixun-right-buttom-1'>
								<img src="images/01_42.jpg" alt="" onclick="SkipHref('gongjijin')"/>
								<p>
									<span class='xindaidaixun-right-buttom-1-4' onclick="SkipHref('gongjijin')">公积金贷款计算器</span>
								</p>
							</div>
						</div>
					</div>			
				</div>
			</div>			
		</div>
		<?php
			 include "smartyfooter.new.php";
		?>
	</body>
	<link rel="stylesheet" href="style/calculatestyle.css" />
		<script>
			window.onload = OnLoad;
			var Setting = {};
			Setting.istype=1;
			var summoney;
			newrate="<?php echo $newrate1 ?>";
			function SkipHref(page){
				window.location.href= page+'.new.php';
			}
			function OnLoad(){
				$("#dklv").val(newrate*100);
				$("#div1rate").change(function() {
					cal_lv();
				});	
				
				$("#apply_submitbtn").click(function(){
					SubmitApply();
				});
				$("#apply_mcodebtn").click(function(){
					GetMcode();
				});
				$("#sy_type_2").click(function(){
					Setting.istype=2;
					$(".div1_2").removeClass("hidden");
					$(".div1_1h").addClass("hidden");
				})
				$("#sy_type_1").click(function(){
					Setting.istype=1;
					$(".div1_2").addClass("hidden");
					$(".div1_1h").removeClass("hidden");
				})
				$("#sy_gfxz_1").click(function(){
					$("#div2shoufu").val("0.3");
				})
				$("#sy_gfxz_2").click(function(){
					$("#div2shoufu").val("0.6");
				})
				$("#btnreset").click(function(){
					$("#dkje_1,#pmdj_1,#mj_1").val("");
					$("#_debx_dkje,#_debx_dkqx,#_debx_myhk,#_debx_zflx,#_debx_hkze").html("0");
					$("#_debj_dkje,#_debj_dkqx,#_debj_syhk,#_debj_mydj,#_debj_zflx,#_debj_hkze").html("0");
				})
				$("#btncalculate").click(function(){
					switch(Setting.istype){
						case 1://按贷款金额
							summoney=$("#dkje_1").val()*10000;
							showdata(summoney);
							break;
						case 2://按面积
							//平米单价pmdj_1
							pprice=$("#pmdj_1").val();
							//平米数mj_1
							pmeter=$("#mj_1").val();
							sumcount=pprice*pmeter;//总金额
							shoufurate=$("#div2shoufu").val();
							summoney=sumcount*(1-shoufurate);
							showdata(summoney);
							break;
					}
				})
			}
			function cal_lv() {
				var d = parseFloat($("#div1rate").val())*parseFloat(newrate)*100;
				$("#dklv").val(d.toFixed(2));
			}
			function showdata(summoney){
				needtime=$("#div1time").val();
				// yearrate=$("#div1rate").val()*newrate;
				yearrate=$("#dklv").val()/100;
				monthrate=yearrate/12;
				monthtime=needtime*12;
			//等额本息
				$("#_debx_dkje").html(summoney);
				//贷款总额_debx_dkje
				$("#_debx_dkqx").html(monthtime);
				//还款月数_debx_dkqx
				//〔贷款本金×月利率×（1＋月利率）＾还款月数〕÷〔（1＋月利率）＾还款月数－1〕
				//money1=(summoney*monthrate*(1+monthrate)^monthtime)/(1+monthrate)^monthtime-1;
				money1=(summoney * monthrate *  Math.pow((1 + monthrate) , monthtime)) / (Math.pow((1 + monthrate) , monthtime) - 1);
				$("#_debx_myhk").html(money1);
				//每月还款_debx_myhk	
				totalint=money1*monthtime-summoney;
				$("#_debx_zflx").html(totalint);
				//总支付利息_debx_zflx
				//贷款额*贷款月数*月利率*（1+月利率）^贷款月数/[（1+月利率）^贷款月数-1]
				$("#_debx_hkze").html(totalint+summoney);
				//本息合计_debx_hkze
			//等额本金
				$("#_debj_dkje").html(summoney);
				//贷款总额_debj_dkje
				$("#_debj_dkqx").html(monthtime);
				//还款月数_debj_dkqx
				money2=summoney/monthtime+summoney*monthrate;
				$("#_debj_syhk").html(money2);
				//首月还款_debj_syhk
				money3=summoney/monthtime;
				money4=summoney/monthtime+(summoney-money3)*monthrate;
				money5=money2-money4;
				$("#_debj_mydj").html(money5);
				//每月递减：_debj_mydj
				//(还款月数+1)*贷款额*月利率/2
				totalint2=(monthtime+1)*summoney*(monthrate/2);
				$("#_debj_zflx").html(totalint2);
				//总支付利息_debj_zflx
				//(还款月数+1)*贷款额*月利率/2+贷款额
				$("#_debj_hkze").html(totalint2+summoney);
				//本息合计_debj_hkze
			}
		</script>
</html>