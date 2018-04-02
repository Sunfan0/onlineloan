<?php
	 include "paras.php";
	 $strSql = " Select * From calculateloanofhouse order by createtime limit 0,1 ";
	 $showdata = DBGetDataRow($strSql);
	 $newrate1=$showdata["rate"];
	 $newrate=($newrate1*100).'%';
	 include "smartycal.new.php";
?>
		<div class="contanier chedaidiv">
			<!--当前位置-->
			<div class="loaciton"><img src="images/location.png" alt="" />您当前的位置：
				<a class="hoverpointer" onclick="LocationHref('index')">首页</a> >
				<a class="hoverpointer" onclick="LocationHref('chedai')">车贷计算器</a> 
			</div>
			<div class="content clearfix">
				<div class="contleft">
					<div class="newscont bgborder" style="padding: 0px 20px 20px;">
						
						<div class="content-block input-block">
							<h3><span class="content-title">»</span>输入数据</h3>
							<div class="input_quankuanmaiche">
								<table>
									<tbody>
										<tr>
											<td width="120">所在地</td>
											<td><span id="citysel" class="hoverpointer"><a href="###" id="_city">北京</a>&nbsp;<img src="images/arrow-down.png" alt="" /></span></td>
										</tr>
										<tr>
											<td>车价</td>
											<td>
												<div class="input-group" style="margin: 0;">
													<input type="text" class="inpt" id="_gcjg">
													<span class="input-group-addon">元</span>
												</div>
											</td>
										</tr>
										<tr>
											<td>座位数</td>
											<td colspan="2">
												<input type="radio" name="_zw" id="zw1" value="1" checked />
												<label for="zw1">6座以下</label>
												<input type="radio" name="_zw" id="zw2" value="2" />
												<label for="zw2">6座及以上</label>
											</td>
										</tr>
										<tr class="div2">
											<td>首付</td>
											<td>
											<!--<div id="sfbl_sel" class="sel" style="z-index:900">
												<select name="select" id="sfbl_list" class="yt-text">
													<option value="2">2成</option>
													<option value="3" selected>3成</option>
													<option value="4">4成</option>
													<option value="5">5成</option>
													<option value="6">6成</option>
													<option value="7">7成</option>
													<option value="8">8成</option>
													<option value="9">9成</option>
												</select>-->
											<div id="sfbl_sel" class="input-group" style="margin: 0;z-index:900">
												<select name="select" id="sfbl_list" class="yt-text">
													<option value="2">2</option>
													<option value="3" selected>3</option>
													<option value="4">4</option>
													<option value="5">5</option>
													<option value="6">6</option>
													<option value="7">7</option>
													<option value="8">8</option>
													<option value="9">9</option>
												</select>
												<span class="input-group-addon">成</span>
											</div>
											</td>
										</tr>
										<tr class="div2">
											<td>贷款期限</td>
											<td>
												<div id="dkqx_sel" class="sel" style="z-index:800">
													<select name="select" id="dkqx_list" class="yt-text">
														<option value="6">6个月</option>
														<option value="12" selected>1年</option>
														<option value="24">2年</option>
														<option value="36">3年</option>
														<option value="48">4年</option>
														<option value="60">5年</option>
													</select>
												</div>
											</td>
										</tr>
										<tr class="div2">
											<td>年利率</td>
											<td>
												<div id="dklv_sel" class="sel" style="z-index:700">
													<select name="select" id="dklv_list" class="yt-text">
														<option value="0.7">最新基准利率7折</option>
														<option value="0.8">最新基准利率8折</option>
														<option value="0.83">最新基准利率8.3折</option>
														<option value="0.85">最新基准利率8.5折</option>
														<option value="0.88">最新基准利率8.8折</option>
														<option value="0.9">最新基准利率9折</option>
														<option value="0.95">最新基准利率9.5折</option>
														<option value="1" selected>最新基准利率</option>
														<option value="1.05">最新基准利率1.05倍</option>
														<option value="1.1">最新基准利率1.1倍</option>
														<option value="1.2">最新基准利率1.2倍</option>
														<option value="1.3">最新基准利率1.3倍</option>
													</select>
												</div>
											</td>
										</tr>
										<tr class="div2">
											<td></td>
											<td>
												<span class="lilv-hint">您也可以手动输入</span>
												<input value="<?php echo $newrate ?>" type="text" class="inpt" id="dklv" style="width: 62px;">
											</td>
										</tr>
										<tr>
											<td></td>
											<td style="padding-top:10px;">
											<button class="btn cal-btn" did="2">计 算</button>
											<button class="btn reset-btn" did="2">重 置</button>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="content-block result-block">
							<h3><span class="content-title">»</span>输出结果</h3>
							<div class="r_result">
								<div class="r_title" id="r_title_1">
									<span>基本税费&nbsp;&nbsp;</span>¥<em id="_byhf">0</em>元
									<img src="images/arrow-d.png" class="tjt">
								</div>
								<div class="r_body" id="r_body_1" style="display: none;">
									<table cellpadding="0" cellspacing="0" class="tbl gcbx_tb" style="width: 100%;">
										<tbody>
											<tr>
												<td width="180">购置税</td>
												<td width="350">&nbsp;</td>
												<td width="158" class="tdv"><input type="text" class="inpt" id="_gzs" readonly="" value="0"> 元</td>
											</tr>
											<tr>
												<td>上牌费用<span class="help" id="spfysm" style="*margin-top:0"></span>
													<div class="tsk" id="spfysm_help" style="width: 450px; display: none;">
														<img src="images/kuang-arrow-bg.png" class="jt" style="left:51px;*left:46px">
														<img src="images/close1.png" class="close">
														<div class="nr">
															通常商家提供的一条龙服务收费约500元，个人办理约373元，其中工商验证、出库150元、移动证30元、环保卡3元、拓号费40元、行驶证相片20元、托盘费130元，以当地实际情况为准。
														</div>
													</div>
												</td>
												<td>&nbsp;</td>
												<td class="tdv"><input type="text" class="inpt xg" id="_spfy"> 元</td>
											</tr>
											<tr>
												<td>车船使用税</td>
												<td>
													<ul class="pllist">
														<li><input type="radio" name="_pl" id="pl1" value="1"><label for="pl1">1.0L(含)以下</label></li>
														<li><input type="radio" name="_pl" id="pl2" value="2" checked=""><label for="pl2">1.0-1.6L(含)</label></li>
														<li><input type="radio" name="_pl" id="pl3" value="3"><label for="pl3">1.6-2.0L(含)</label></li>
														<li><input type="radio" name="_pl" id="pl4" value="4"><label for="pl4">2.0-2.5L(含)</label></li>
														<li><input type="radio" name="_pl" id="pl5" value="5"><label for="pl5">2.5-3.0L(含)</label></li>
														<li><input type="radio" name="_pl" id="pl6" value="6"><label for="pl6">3.0-4.0L(含)</label></li>
														<li><input type="radio" name="_pl" id="pl7" value="7"><label for="pl7">4.0L以上</label></li>
													</ul>
												</td>
												<td class="tdv"><input type="text" class="inpt" id="_ccs" readonly=""> 元</td>
											</tr>
											<tr>
												<td class="lhtd">交强险</td>
												<td class="lhtd">&nbsp;</td>
												<td class="tdv"><input type="text" class="inpt" id="_jqx" readonly=""> 元</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="r_result">
								<div class="r_title" id="r_title_2">
									<span>商业保险&nbsp;&nbsp;</span>¥<em id="_sybx">0</em>元
									<img src="images/arrow-d.png" class="tjt">
								</div>
								<div class="r_body" id="r_body_2" style="display: none;">
									<table cellpadding="0" cellspacing="0" class="tbl gcbx_tb"  style="width: 100%;">
										<tbody>
											<tr>
												<td colspan="3" class="ltd bxlx">
													<ul>
														<li class="sybxtype" data-type="1">基本保障</li>
														<li class="sybxtype on" data-type="2" style="border-left:1px solid #DDDDDD;border-right:1px solid #DDDDDD" class="on">经济型保障</li>
														<li class="sybxtype" data-type="3">全险</li>
													</ul>
													<div class="clr"></div>
												</td>
											</tr>
											<tr>
												<td width="180"><input type="checkbox" name="chkbx" id="c_szx" class="xg" checked=""> <label for="c_szx">第三者责任险</label><span class="help" id="szxsm"></span>
													 <div class="tsk" id="szxsm_help" style="width: 450px; display: none;">
														<img src="images/kuang-arrow-bg.png" class="jt" style="left:91px;*left:50px">
														<img src="images/close1.png" class="close">
														<div class="nr">
															第三者责任险是指被保险人或其允许的驾驶人员在使用保险车辆过程中发生意外事故，致使第三者遭受人身伤亡或财产直接损毁，依法应当由被保险人承担的经济责任，保险公司负责赔偿。同时，若经保险公司书面同意，被保险人因此发生仲裁或诉讼费用的，保险公司在责任限额以外赔偿，但最高不超过责任限额的30％。因为交强险在对第三者的财产损失和医疗费用部分赔偿较低，可考虑购买第三者责任险作为交强险的补充。 
														</div>
													</div>
												</td>
												<td width="350" style="line-height:22px">
													赔付额度：<br>
													<ul class="pflist">
														<li><input type="radio" name="_szbe" value="5" class="xg" id="szbe1"><label for="szbe1">5万</label></li>
														<li><input type="radio" name="_szbe" value="10" class="xg" id="szbe2" checked=""><label for="szbe2">10万</label></li>
														<li><input type="radio" name="_szbe" value="15" class="xg" id="szbe3"><label for="szbe3">15万</label></li>
														<li><input type="radio" name="_szbe" value="20" class="xg" id="szbe4"><label for="szbe4">20万</label></li>
														<li><input type="radio" name="_szbe" value="30" class="xg" id="szbe5"><label for="szbe5">30万</label></li>
														<li><input type="radio" name="_szbe" value="50" class="xg" id="szbe6"><label for="szbe6">50万</label></li>
														<li><input type="radio" name="_szbe" value="100" class="xg" id="szbe7"><label for="szbe7">100万</label></li>
													</ul>
												</td>
												<td width="158" class="tdv"><input type="text" class="inpt" id="_szx" readonly=""> 元</td>
											</tr>
											<tr>
												<td><input type="checkbox" name="chkbx" id="c_jdcssx" class="xg" checked=""> <label for="c_jdcssx">车辆损失险</label><span class="help" id="clssxsm"></span>
													 <div class="tsk" id="clssxsm_help" style="width: 450px; display: none;">
														<img src="images/kuang-arrow-bg.png" class="jt" style="left:79px;*left:46px">
														<img src="images/close1.png" class="close">
														<div class="nr">
															车辆损失险是车辆保险中用途最广泛的险种，它负责赔偿由于自然灾害和意外事故造成的自己车辆的损失。无论是小剐小蹭，还是损坏严重，都可以由保险公司来支付修理费用。<br>
															被保险人或其允许的合格驾驶员在使用保险车辆过程中，因下列原因造成保险车辆的损失，保险公司负责赔偿：1．碰撞、倾覆；2．火灾、爆炸；3．外界物体倒塌、空中运行物体坠落、保险车辆行驶中平行坠落；4．雷击、暴风、龙卷风、暴雨、洪水、海啸、地陷、冰陷、崖崩、雪崩、雹灾、泥石流、滑坡；5. 载运保险车辆的渡船遭受自然灾害（只限于有驾驶员随车照料者）。<br>
															发生保险事故时，被保险人或其允许的合格驾驶员对保险车辆采取施救、保护措施所支出的合理费用，保险公司负责赔偿。但此项费用的最高赔偿金额以责任限额为限。 
														</div>
													</div>
												</td>
												<td>&nbsp;</td>
												<td class="tdv"><input type="text" class="inpt" id="_jdcssx" readonly=""> 元</td>
											</tr>
											<tr>
												<td><input type="checkbox" name="chkbx" id="c_jdcqdx" class="xg" checked=""> <label for="c_jdcqdx">全车强盗险</label><span class="help" id="jdcqdxsm"></span>
													 <div class="tsk" id="jdcqdxsm_help" style="width: 450px; display: none;">
														<img src="images/kuang-arrow-bg.png" class="jt" style="left:79px;*left:46px">
														<img src="images/close1.png" class="close">
														<div class="nr">
															指保险车辆全车被盗窃、被抢劫、被抢夺，经县级以上公安刑侦部门立案侦查证实满一定时间没有下落的，由保险公司在保险金额内予以赔偿。如果是车辆的某些零部件被盗抢，如轮胎被盗抢、车内财产被盗抢、后备箱内的物品丢失，保险公司均不负责赔偿。 但是，对于车辆被盗抢期间内，保险车辆上零部件的损坏、丢失，保险公司一般负责赔偿。<br>
															全车盗抢险为附加险，必须在投保车辆损失险之后方可投保该险种。
														</div>
													</div>
												</td>
												<td>&nbsp;</td>
												<td class="tdv"><input type="text" class="inpt" id="_jdcqdx" readonly=""> 元</td>
											</tr>
											<tr>
												<td><input type="checkbox" name="chkbx" id="c_blddpsx" class="xg"> <label for="c_blddpsx">玻璃单独破碎险</label><span class="help" id="blddpsxsm"></span>
													 <div class="tsk" id="blddpsxsm_help" style="width: 450px; display: none;">
														<img src="images/kuang-arrow-bg.png" class="jt" style="left:103px;*left:46px">
														<img src="images/close1.png" class="close">
														<div class="nr">
															负责赔偿保险车辆在使用过程中，发生本车玻璃发生单独破碎的保险公司按照保险合同进行赔偿。玻璃单独破碎险中的玻璃是指风档玻璃和车窗玻璃，如果车灯、车镜玻璃破碎及车辆维修过程中造成的破碎，保险公司不承担赔偿责任。<br>
															玻璃单独破碎险为附加险，必须在投保车辆损失险之后方可投保该险种。 
														</div>
													</div>
												</td>
												<td>
													<input type="radio" name="_jkgc" value="1" class="xg" id="jkgc1"><label for="jkgc1">进口</label>&nbsp;&nbsp;
													<input type="radio" name="_jkgc" value="2" class="xg" id="jkgc2" checked=""><label for="jkgc2">国产</label>
												</td>
												<td class="tdv"><input type="text" class="inpt" id="_blddpsx" readonly=""> 元</td>
											</tr>
											<tr>
												<td><input type="checkbox" name="chkbx" id="c_zrssx" class="xg"> <label for="c_zrssx">自燃损失险</label><span class="help" id="zrssxsm"></span>
													 <div class="tsk" id="zrssxsm_help" style="width: 450px; display: none;">
														<img src="images/kuang-arrow-bg.png" class="jt" style="left:79px;*left:46px">
														<img src="images/close1.png" class="close">
														<div class="nr">
															负责赔偿因本车电器、线路、供油系统发生故障及运载货物自身原因起火造成车辆本身的损失。当车辆发生部分损失，按照实际修复费用赔偿修理费。如果车辆自燃造成整体烧毁或已经失去修理价值，则按照出险时车辆的实际价值赔偿，但不超过责任限额。
														</div>
													</div>
												</td>
												<td>&nbsp;</td>
												<td class="tdv"><input type="text" class="inpt" id="_zrssx" readonly=""> 元</td>
											</tr>
											<tr>
												<td><input type="checkbox" name="chkbx" id="c_bjmptyx" class="xg" checked=""> <label for="c_bjmptyx">不计免赔特约险</label><span class="help" id="bjmptyxsm"></span>
													 <div class="tsk" id="bjmptyxsm_help" style="width: 450px; display: none;">
														<img src="images/kuang-arrow-bg.png" class="jt" style="left:103px;*left:46px">
														<img src="images/close1.png" class="close">
														<div class="nr">
															负责赔偿在车损险和第三者责任险中应由被保险人自己承担的免赔金额，即100%赔付。<br>
															不计免赔特约险为附加险，必须在投保车损险和第三者责任险之后方可投保该险种。
														</div>
													</div>
												</td>
												<td>&nbsp;</td>
												<td class="tdv"><input type="text" class="inpt" id="_bjmptyx" readonly=""> 元</td>
											</tr>
											<tr>
												<td><input type="checkbox" name="chkbx" id="c_wgzrx" class="xg" checked=""> <label for="c_wgzrx">无过责任险</label><span class="help" id="wgzrxsm"></span>
													 <div class="tsk" id="wgzrxsm_help" style="width: 450px; display: none;">
														<img src="images/kuang-arrow-bg.png" class="jt" style="left:79px;*left:46px">
														<img src="images/close1.png" class="close">
														<div class="nr">
															投保车辆在使用过程中，因与非机动车辆、行人发生交通事故，造成对方人员伤亡和财产的直接损毁，但这一损失不是被保险人的过失，而是由于对方的责任造成的，但保险人拒绝赔偿未果，对于保险人已经支付给对方而无法追回的费用，保险公司按《道路交通事故处理办法》负责赔偿。<br>
															无过失责任险为附加险，必须在投保第三者责任险之后方可投保该险种。 
														</div>
													</div>
												</td>
												<td>&nbsp;</td>
												<td class="tdv"><input type="text" class="inpt" id="_wgzrx" readonly=""> 元</td>
											</tr>
											<tr>
												<td><input type="checkbox" name="chkbx" id="c_csryzrx" class="xg" checked=""> <label for="c_csryzrx">车上人员责任险</label><span class="help" id="csryzrxsm"></span>
													 <div class="tsk" id="csryzrxsm_help" style="width: 450px; display: none;">
														<img src="images/kuang-arrow-bg.png" class="jt" style="left:103px;*left:46px">
														<img src="images/close1.png" class="close">
														<div class="nr">
															保险车辆发生意外事故导致车上司乘人员伤亡造成的费用损失，以及为减少损失而支付的必要合理的施救、保护费用，由保险公司承担赔偿责任。 
														</div>
													</div>
												</td>
												<td>投保人数 <input type="text" id="_tbrs" class="inpt xg" style="width:30px" value="1"> 人</td>
												<td class="tdv"><input type="text" class="inpt" id="_csryzrx" readonly=""> 元</td>
											</tr>
											<tr>
												<td class="lhtd"><input type="checkbox" name="chkbx" id="c_cshhx" class="xg" checked=""> <label for="c_cshhx">车身划痕险</label><span class="help" id="cshhxsm"></span>
													 <div class="tsk" id="cshhxsm_help" style="width: 450px; display: none;">
														<img src="images/kuang-arrow-bg.png" class="jt" style="left:79px;*left:46px">
														<img src="images/close1.png" class="close">
														<div class="nr">
															车身划痕险为附加险，必须在投保车辆损失险之后方可投保该险种。 
														</div>
													</div>
												</td>
												<td class="lhtd" style="line-height:22px">
													赔付额度：<br>
													<input type="radio" name="_hhbe" value="2000" class="xg" id="hhbe1"><label for="hhbe1">2千</label>&nbsp;&nbsp;
													<input type="radio" name="_hhbe" value="5000" class="xg" id="hhbe2" checked=""><label for="hhbe2">5千</label>&nbsp;&nbsp;
													<input type="radio" name="_hhbe" value="10000" class="xg" id="hhbe3"><label for="hhbe3">1万</label>&nbsp;&nbsp;
													<input type="radio" name="_hhbe" value="20000" class="xg" id="hhbe4"><label for="hhbe4">2万</label>
												</td>
												<td class="tdv"><input type="text" class="inpt" id="_cshhx" readonly=""> 元</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="r_result">
								<div class="r_title" id="r_title_3">
									<span>购车总费用&nbsp;&nbsp;</span>¥<em id="_gczfy1">0</em>元
									<span style="margin-left:20px;padding-right:5px">首付&nbsp;&nbsp;</span>¥<em id="_dksf">0</em>元
									<img src="images/arrow-d.png" class="tjt">
								</div>
								<div class="r_body" id="r_body_3" style="display: none;">
									<table class="r_layout">
										<tbody>
											<tr>
												<td width="50%" style="position:relative;padding:0 5px 0 10px">
													<div>每月等额还款<span class="help" id="debxhk" style="*margin-top:0"></span></div>
													<div class="tsk" id="debxhk_help" style="width: 200px; display: none;">
														<img src="images/kuang-arrow-bg.png" class="jt" style="left:81px;*left:85px">
														<div></div>
														<img src="images/close1.png" class="close">
														<div class="nr">
															每月等额还款即等额本息还款法，指借款人每月按相等的金额偿还贷款本息，其中每月贷款利息按月初剩余贷款本金计算并逐月结清。
														</div>
													</div>
													<table cellpadding="0" cellspacing="0" class="tbl" style="width:100%">
														<tbody><tr>
															<td class="r_td1">贷款总额</td>
															<td class="r_td2"><var id="_debx_dkje">0</var> 元</td>
														</tr>
														<tr>
															<td class="r_td1">还款月数</td>
															<td class="r_td2"><var id="_debx_dkqx">0</var> 月</td>
														</tr>
														<tr height="50">
															<td class="r_td1">每月还款</td>
															<td class="r_td2"><em id="_debx_myhk">0</em> 元</td>
														</tr>
														<tr>
															<td class="r_td1">总支付利息</td>
															<td class="r_td2"><em id="_debx_zflx">0</em> 元</td>
														</tr>
														<tr>
															<td class="r_td1">本息合计</td>
															<td class="r_td2"><em id="_debx_hkze">0</em> 元</td>
														</tr>
													</tbody></table>
												</td>
												<td width="50%" style="position:relative;padding:0 10px 0 5px">
													<div>逐月递减还款<span class="help" id="debjhk" style="*margin-top:0"></span></div>
													<div class="tsk" id="debjhk_help" style="width: 214px; display: none;">
														<img src="images/kuang-arrow-bg.png" class="jt" style="left:81px;*left:62px">
														<img src="images/close1.png" class="close">
														<div class="nr">
															逐月递减还款即等额本金还款法，指本金保持相同，利息逐月递减，月还款数递减；由于每月的还款本金额固定，而利息越来越少，贷款人起初还款压力较大，但是随时间的推移每月还款数也越来越少。
														</div>
													</div>
													<table cellpadding="0" cellspacing="0" class="tbl" style="width:100%">
														<tbody>
														<tr>
															<td class="r_td1">贷款总额</td>
															<td class="r_td2"><var id="_debj_dkje">0</var> 元</td>
														</tr>
														<tr>
															<td class="r_td1">还款月数</td>
															<td class="r_td2"><var id="_debj_dkqx">0</var> 月</td>
														</tr>
														<tr height="50">
															<td class="r_td1">首月还款</td>
															<td class="r_td2" style="line-height:20px"><em id="_debj_syhk">0</em> 元<br>每月递减：<b id="_debj_mydj">0</b> 元</td>
														</tr>
														<tr>
															<td class="r_td1">总支付利息</td>
															<td class="r_td2"><em id="_debj_zflx">0</em> 元</td>
														</tr>
														<tr>
															<td class="r_td1">本息合计</td>
															<td class="r_td2"><em id="_debj_hkze">0</em> 元</td>
														</tr>
														</tbody>
													</table>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div id="citylist" class="tsk" style="left: 120px; display: none;">
							<img id="citylist_close" src="images/close1.png">
							<div class="bt">城市列表</div>
							<div class="lb">
								<dl>
									<dt>热门城市</dt>
									<dd>
										<li>北京</li>
										<li>上海</li>
										<li>深圳</li>
										<li>天津</li>
										<li>重庆</li>
										<li>大连</li>
										<li>青岛</li>
										<li>宁波</li>
										<li>厦门</li>
									</dd>
								</dl>
								<dl>
									<dt>省份</dt>
									<dd>
										<li>河北</li>
										<li>山西</li>
										<li>内蒙古</li>
										<li>辽宁</li>
										<li>吉林</li>
										<li>黑龙江</li>
										<li>江苏</li>
										<li>浙江</li>
										<li>安徽</li>
										<li>福建</li>
										<li>江西</li>
										<li>山东</li>
										<li>河南</li>
										<li>湖北</li>
										<li>湖南</li>
										<li>广东</li>
										<li>广西</li>
										<li>海南</li>
										<li>四川</li>
										<li>贵州</li>
										<li>云南</li>
										<li>陕西</li>
										<li>甘肃</li>
										<li>青海</li>
										<li>宁夏</li>
										<li>新疆</li>
									</dd>
								</dl>
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
								<img src="images/01_34.jpg" alt="" onclick="LocationHref('fangdai')"/>
								<p>
									<span class='xindaidaixun-right-buttom-1-1' onclick="LocationHref('fangdai')">房贷计算器</span>
								</p>
							</div>

							<div class='xindaidaixun-right-buttom-1'>
								<img src="images/01_36.jpg" alt="" onclick="LocationHref('chedai')"/>
								<p>
									<span class='xindaidaixun-right-buttom-1-2' onclick="LocationHref('chedai')">车贷计算器</span>
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
				</div>
			</div>			
		</div>
		<?php
			 include "smartyfooter.new.php";
		?>
	</body>
	<script>
	var newrate = "<?=$newrate?>";
	
	if(!window['RCal']){
		window['RCal'] = { };
	}
	RCal.baseRate = [{"term":[0,12],"rate":4.35,"text":"1\u5e74\u4ee5\u5185(\u542b1\u5e74)"},{"term":[12,60],"rate":4.75,"text":"1\u5e74\u52305\u5e74(\u542b5\u5e74)"},{"term":[60,1000],"rate":4.9,"text":"5\u5e74\u4ee5\u4e0a"}];
	RCal.baseRateGjj = [{"term":[0,60],"rate":2.75,"text":"5\u5e74\u4ee5\u5185(\u542b5\u5e74)"},{"term":[60,1000],"rate":3.25,"text":"5\u5e74\u4ee5\u4e0a"}];
	RCal.baseRateCunkuan = [{"term":0,"rate":0.35,"text":"\u6d3b\u671f"},{"term":3,"rate":1.1,"text":"3\u4e2a\u6708\u5b9a\u671f"},{"term":6,"rate":1.3,"text":"6\u4e2a\u6708\u5b9a\u671f"},{"term":12,"rate":1.5,"text":"1\u5e74\u5b9a\u671f"},{"term":24,"rate":2.1,"text":"2\u5e74\u5b9a\u671f"},{"term":36,"rate":2.75,"text":"3\u5e74\u5b9a\u671f"}];

	
	
cxfl = [],
cxfl["北京"] = [],
cxfl["北京"][0] = [516, 746, 850, 924, 1043, 1252, 1630, 459, 1.088, 437, 1.037, 432, 1.029, 445, 1.054, .349, .221, 102, .451, .162, .264],
cxfl["北京"][1] = [478, 674, 761, 821, 919, 1094, 1425, 550, 1.088, 524, 1.037, 518, 1.029, 534, 1.054, .332, .213, 119, .374, .17, .272],
cxfl["北京"][2] = [478, 674, 761, 821, 919, 1094, 1425, 550, 1.088, 524, 1.037, 518, 1.029, 534, 1.054, .332, .213, 119, .374, .196, .323],
cxfl["北京"][3] = [300, 420, 480, 900, 1920, 3480, 5280],
cxfl["天津"] = [],
cxfl["天津"][0] = [568, 820, 935, 1016, 1147, 1376, 1792, 527, 1.25, 502, 1.19, 497, 1.182, 512, 1.216, .349, .221, 102, .357, .162, .272],
cxfl["天津"][1] = [657, 925, 1046, 1128, 1263, 1504, 1958, 632, 1.25, 602, 1.19, 596, 1.182, 614, 1.216, .34, .221, 119, .374, .162, .264],
cxfl["天津"][2] = [657, 925, 1046, 1128, 1263, 1504, 1958, 632, 1.25, 602, 1.19, 596, 1.182, 614, 1.216, .34, .221, 119, .374, .196, .315],
cxfl["天津"][3] = [270, 390, 450, 900, 1800, 3e3, 4500],
cxfl["河北"] = [],
cxfl["河北"][0] = [561, 811, 925, 1005, 1135, 1362, 1774, 505, 1.199, 480, 1.139, 476, 1.131, 490, 1.165, .34, .221, 102, .357, .162, .264],
cxfl["河北"][1] = [594, 836, 946, 1020, 1141, 1359, 1769, 605, 1.199, 576, 1.139, 570, 1.131, 588, 1.165, .323, .213, 119, .332, .162, .255],
cxfl["河北"][2] = [594, 836, 946, 1020, 1141, 1359, 1769, 605, 1.199, 576, 1.139, 570, 1.131, 588, 1.165, .323, .213, 119, .332, .187, .306],
cxfl["河北"][3] = [120, 300, 480, 840, 1800, 3e3, 4500],
cxfl["山西"] = [],
cxfl["山西"][0] = [604, 873, 994, 1080, 1219, 1463, 1906, 527, 1.25, 502, 1.19, 497, 1.182, 512, 1.216, .357, .23, 102, .391, .162, .255],
cxfl["山西"][1] = [561, 789, 891, 962, 1077, 1281, 1669, 632, 1.25, 602, 1.19, 596, 1.182, 614, 1.216, .34, .221, 119, .468, .162, .255],
cxfl["山西"][2] = [561, 789, 891, 962, 1077, 1281, 1669, 632, 1.25, 602, 1.19, 596, 1.182, 614, 1.216, .34, .221, 119, .468, .187, .306],
cxfl["山西"][3] = [180, 300, 360, 720, 1800, 3e3, 4500],
cxfl["内蒙古"] = [],
cxfl["内蒙古"][0] = [604, 873, 994, 1080, 1219, 1463, 1906, 536, 1.275, 510, 1.216, 505, 1.199, 521, 1.241, .357, .23, 102, .4, .162, .264],
cxfl["内蒙古"][1] = [561, 789, 891, 962, 1077, 1281, 1669, 643, 1.275, 612, 1.216, 607, 1.199, 625, 1.241, .34, .221, 119, .306, .162, .255],
cxfl["内蒙古"][2] = [561, 789, 891, 962, 1077, 1281, 1669, 643, 1.275, 612, 1.216, 607, 1.199, 625, 1.241, .34, .221, 119, .306, .187, .306],
cxfl["内蒙古"][3] = [300, 360, 420, 900, 1800, 3e3, 4500],
cxfl["辽宁"] = [],
cxfl["辽宁"][0] = [625, 902, 1029, 1117, 1262, 1514, 1972, 536, 1.275, 510, 1.216, 505, 1.199, 521, 1.241, .357, .23, 102, .417, .162, .264],
cxfl["辽宁"][1] = [640, 901, 1018, 1098, 1230, 1465, 1906, 643, 1.275, 612, 1.216, 607, 1.199, 625, 1.241, .34, .221, 119, .374, .162, .255],
cxfl["辽宁"][2] = [640, 901, 1018, 1098, 1230, 1465, 1906, 643, 1.275, 612, 1.216, 607, 1.199, 625, 1.241, .34, .221, 119, .374, .187, .306],
cxfl["辽宁"][3] = [300, 420, 480, 900, 1800, 3e3, 4500],
cxfl["大连"] = [],
cxfl["大连"][0] = [596, 862, 982, 1067, 1205, 1445, 1882, 536, 1.275, 510, 1.216, 505, 1.199, 521, 1.241, .349, .221, 102, .34, .162, .255],
cxfl["大连"][1] = [657, 925, 1046, 1128, 1263, 1504, 1958, 643, 1.275, 612, 1.216, 607, 1.199, 625, 1.241, .332, .213, 119, .374, .162, .255],
cxfl["大连"][2] = [657, 925, 1046, 1128, 1263, 1504, 1958, 643, 1.275, 612, 1.216, 607, 1.199, 625, 1.241, .332, .213, 119, .374, .187, .306],
cxfl["大连"][3] = [300, 420, 480, 900, 1800, 3e3, 4500],
cxfl["吉林"] = [],
cxfl["吉林"][0] = [686, 992, 1130, 1229, 1386, 1663, 2166, 536, 1.275, 510, 1.216, 505, 1.199, 521, 1.241, .34, .221, 102, .476, .162, .264],
cxfl["吉林"][1] = [717, 1009, 1141, 1230, 1377, 1639, 2136, 643, 1.275, 612, 1.216, 607, 1.199, 625, 1.241, .332, .213, 119, .374, .162, .255],
cxfl["吉林"][2] = [717, 1009, 1141, 1230, 1377, 1639, 2136, 643, 1.275, 612, 1.216, 607, 1.199, 625, 1.241, .332, .213, 119, .374, .187, .306],
cxfl["吉林"][3] = [240, 420, 480, 900, 1800, 3e3, 4500],
cxfl["黑龙江"] = [],
cxfl["黑龙江"][0] = [686, 992, 1130, 1229, 1386, 1663, 2166, 536, 1.275, 510, 1.216, 505, 1.199, 521, 1.241, .357, .23, 102, .476, .162, .264],
cxfl["黑龙江"][1] = [828, 1166, 1317, 1420, 1591, 1894, 2465, 643, 1.275, 612, 1.216, 607, 1.199, 625, 1.241, .34, .221, 119, .459, .17, .264],
cxfl["黑龙江"][2] = [828, 1166, 1317, 1420, 1591, 1894, 2465, 643, 1.275, 612, 1.216, 607, 1.199, 625, 1.241, .34, .221, 119, .459, .196, .315],
cxfl["黑龙江"][3] = [240, 420, 480, 900, 1800, 3e3, 4500],
cxfl["上海"] = [],
cxfl["上海"][0] = [533, 768, 877, 952, 1075, 1289, 1680, 505, 1.199, 480, 1.139, 476, 1.131, 490, 1.165, .357, .23, 102, .349, .162, .264],
cxfl["上海"][1] = [522, 734, 829, 894, 1002, 1192, 1552, 605, 1.199, 576, 1.139, 570, 1.131, 588, 1.165, .34, .221, 119, .315, .162, .264],
cxfl["上海"][2] = [522, 734, 829, 894, 1002, 1192, 1552, 605, 1.199, 576, 1.139, 570, 1.131, 588, 1.165, .34, .221, 119, .315, .196, .315],
cxfl["上海"][3] = [180, 360, 450, 720, 1500, 3e3, 4500],
cxfl["江苏"] = [],
cxfl["江苏"][0] = [567, 817, 933, 1013, 1144, 1372, 1787, 513, 1.216, 489, 1.165, 484, 1.148, 499, 1.182, .34, .221, 102, .357, .162, .264],
cxfl["江苏"][1] = [524, 739, 835, 901, 1009, 1201, 1564, 616, 1.216, 586, 1.165, 581, 1.148, 598, 1.182, .332, .213, 119, .298, .162, .264],
cxfl["江苏"][2] = [524, 739, 835, 901, 1009, 1201, 1564, 616, 1.216, 586, 1.165, 581, 1.148, 598, 1.182, .332, .213, 119, .298, .196, .315],
cxfl["江苏"][3] = [120, 300, 360, 660, 1200, 2400, 3600],
cxfl["浙江"] = [],
cxfl["浙江"][0] = [573, 827, 942, 1024, 1156, 1387, 1806, 482, 1.148, 459, 1.088, 454, 1.08, 467, 1.114, .349, .221, 102, .349, .179, .306],
cxfl["浙江"][1] = [717, 1009, 1141, 1230, 1377, 1639, 2136, 578, 1.148, 550, 1.088, 544, 1.08, 561, 1.114, .34, .221, 119, .383, .179, .306],
cxfl["浙江"][2] = [717, 1009, 1141, 1230, 1377, 1639, 2136, 578, 1.148, 550, 1.088, 544, 1.08, 561, 1.114, .34, .221, 119, .383, .213, .374],
cxfl["浙江"][3] = [180, 300, 360, 660, 1500, 3e3, 4500],
cxfl["宁波"] = [],
cxfl["宁波"][0] = [686, 992, 1130, 1229, 1386, 1663, 2166, 482, 1.148, 459, 1.088, 454, 1.08, 467, 1.114, .357, .23, 102, .357, .162, .264],
cxfl["宁波"][1] = [664, 935, 1057, 1139, 1276, 1519, 1978, 578, 1.148, 550, 1.088, 544, 1.08, 561, 1.114, .34, .221, 119, .315, .162, .264],
cxfl["宁波"][2] = [664, 935, 1057, 1139, 1276, 1519, 1978, 578, 1.148, 550, 1.088, 544, 1.08, 561, 1.114, .34, .221, 119, .315, .187, .315],
cxfl["宁波"][3] = [180, 300, 360, 660, 1500, 3e3, 4500],
cxfl["安徽"] = [],
cxfl["安徽"][0] = [687, 992, 1131, 1230, 1388, 1665, 2169, 536, 1.275, 510, 1.216, 505, 1.199, 521, 1.241, .349, .221, 102, .357, .162, .264],
cxfl["安徽"][1] = [672, 947, 1071, 1153, 1292, 1538, 2003, 643, 1.275, 612, 1.216, 607, 1.199, 625, 1.241, .323, .213, 119, .298, .162, .264],
cxfl["安徽"][2] = [672, 947, 1071, 1153, 1292, 1538, 2003, 643, 1.275, 612, 1.216, 607, 1.199, 625, 1.241, .323, .213, 119, .298, .196, .315],
cxfl["安徽"][3] = [180, 300, 360, 660, 1200, 2700, 3900],
cxfl["福建"] = [],
cxfl["福建"][0] = [561, 811, 925, 1005, 1135, 1362, 1774, 482, 1.148, 459, 1.088, 454, 1.08, 467, 1.114, .349, .221, 102, .425, .162, .264],
cxfl["福建"][1] = [524, 739, 835, 901, 1009, 1201, 1564, 578, 1.148, 550, 1.088, 544, 1.08, 561, 1.114, .34, .221, 119, .383, .162, .264],
cxfl["福建"][2] = [524, 739, 835, 901, 1009, 1201, 1564, 578, 1.148, 550, 1.088, 544, 1.08, 561, 1.114, .34, .221, 119, .383, .196, .315],
cxfl["福建"][3] = [180, 300, 360, 720, 1500, 2640, 3900],
cxfl["厦门"] = [],
cxfl["厦门"][0] = [567, 818, 933, 1013, 1145, 1373, 1788, 482, 1.148, 459, 1.088, 454, 1.08, 467, 1.114, .357, .23, 102, .425, .162, .272],
cxfl["厦门"][1] = [524, 739, 835, 901, 1009, 1201, 1564, 578, 1.148, 550, 1.088, 544, 1.08, 561, 1.114, .34, .221, 119, .459, .162, .272],
cxfl["厦门"][2] = [524, 739, 835, 901, 1009, 1201, 1564, 578, 1.148, 550, 1.088, 544, 1.08, 561, 1.114, .34, .221, 119, .459, .196, .323],
cxfl["厦门"][3] = [180, 300, 360, 720, 1500, 2640, 3900],
cxfl["江西"] = [],
cxfl["江西"][0] = [686, 992, 1130, 1229, 1386, 1663, 2166, 550, 1.309, 524, 1.241, 518, 1.233, 534, 1.267, .349, .221, 102, .357, .162, .264],
cxfl["江西"][1] = [739, 1041, 1177, 1269, 1422, 1692, 2204, 660, 1.309, 629, 1.241, 622, 1.233, 641, 1.267, .323, .213, 119, .374, .162, .264],
cxfl["江西"][2] = [739, 1041, 1177, 1269, 1422, 1692, 2204, 660, 1.309, 629, 1.241, 622, 1.233, 641, 1.267, .323, .213, 119, .374, .196, .315],
cxfl["江西"][3] = [180, 300, 360, 660, 1200, 2400, 3600],
cxfl["山东"] = [],
cxfl["山东"][0] = [604, 873, 994, 1080, 1219, 1463, 1906, 536, 1.275, 510, 1.216, 505, 1.199, 521, 1.241, .357, .23, 102, .417, .162, .264],
cxfl["山东"][1] = [561, 789, 891, 962, 1077, 1281, 1669, 643, 1.275, 612, 1.216, 607, 1.199, 625, 1.241, .34, .221, 119, .374, .162, .255],
cxfl["山东"][2] = [561, 789, 891, 962, 1077, 1281, 1669, 643, 1.275, 612, 1.216, 607, 1.199, 625, 1.241, .34, .221, 119, .374, .187, .306],
cxfl["山东"][3] = [240, 360, 420, 900, 1800, 3e3, 4500],
cxfl["青岛"] = [],
cxfl["青岛"][0] = [596, 862, 982, 1067, 1205, 1445, 1882, 536, 1.275, 510, 1.216, 505, 1.199, 521, 1.241, .349, .221, 102, .417, .162, .255],
cxfl["青岛"][1] = [561, 789, 891, 962, 1077, 1281, 1669, 643, 1.275, 612, 1.216, 607, 1.199, 625, 1.241, .34, .221, 119, .374, .162, .255],
cxfl["青岛"][2] = [561, 789, 891, 962, 1077, 1281, 1669, 643, 1.275, 612, 1.216, 607, 1.199, 625, 1.241, .34, .221, 119, .374, .187, .306],
cxfl["青岛"][3] = [240, 360, 420, 900, 1800, 3e3, 4500],
cxfl["河南"] = [],
cxfl["河南"][0] = [598, 863, 985, 1070, 1208, 1450, 1887, 536, 1.275, 510, 1.216, 505, 1.199, 521, 1.241, .349, .221, 102, .357, .162, .264],
cxfl["河南"][1] = [555, 781, 882, 952, 1066, 1268, 1652, 643, 1.275, 612, 1.216, 607, 1.199, 625, 1.241, .332, .213, 119, .374, .162, .255],
cxfl["河南"][2] = [555, 781, 882, 952, 1066, 1268, 1652, 643, 1.275, 612, 1.216, 607, 1.199, 625, 1.241, .332, .213, 119, .374, .187, .306],
cxfl["河南"][3] = [180, 300, 420, 720, 1500, 3e3, 4500],
cxfl["湖北"] = [],
cxfl["湖北"][0] = [625, 902, 1029, 1117, 1262, 1514, 1972, 527, 1.25, 502, 1.19, 497, 1.182, 512, 1.216, .357, .23, 102, .417, .162, .264],
cxfl["湖北"][1] = [717, 1009, 1141, 1230, 1377, 1639, 2136, 632, 1.25, 602, 1.19, 596, 1.182, 614, 1.216, .332, .213, 119, .374, .162, .255],
cxfl["湖北"][2] = [717, 1009, 1141, 1230, 1377, 1639, 2136, 632, 1.25, 602, 1.19, 596, 1.182, 614, 1.216, .332, .213, 119, .374, .187, .306],
cxfl["湖北"][3] = [240, 360, 420, 720, 1800, 3e3, 4500],
cxfl["湖南"] = [],
cxfl["湖南"][0] = [686, 992, 1130, 1229, 1386, 1663, 2166, 527, 1.25, 502, 1.19, 497, 1.182, 512, 1.216, .357, .23, 102, .349, .162, .272],
cxfl["湖南"][1] = [717, 1009, 1141, 1230, 1377, 1639, 2136, 632, 1.25, 602, 1.19, 596, 1.182, 614, 1.216, .34, .221, 119, .383, .162, .272],
cxfl["湖南"][2] = [717, 1009, 1141, 1230, 1377, 1639, 2136, 632, 1.25, 602, 1.19, 596, 1.182, 614, 1.216, .34, .221, 119, .383, .196, .323],
cxfl["湖南"][3] = [120, 300, 360, 720, 1920, 3120, 4800],
cxfl["广东"] = [],
cxfl["广东"][0] = [543, 782, 892, 970, 1095, 1315, 1711, 459, 1.088, 437, 1.037, 432, 1.029, 445, 1.054, .357, .23, 102, .417, .17, .281],
cxfl["广东"][1] = [502, 707, 800, 862, 965, 1150, 1496, 550, 1.088, 524, 1.037, 518, 1.029, 534, 1.054, .34, .221, 119, .374, .17, .281],
cxfl["广东"][2] = [502, 707, 800, 862, 965, 1150, 1496, 550, 1.088, 524, 1.037, 518, 1.029, 534, 1.054, .34, .221, 119, .374, .204, .34],
cxfl["广东"][3] = [180, 360, 420, 720, 1800, 3e3, 4500],
cxfl["深圳"] = [],
cxfl["深圳"][0] = [651, 939, 1071, 1165, 1315, 1576, 2052, 527, 1.25, 502, 1.19, 497, 1.182, 512, 1.216, .179, .085, 102, .442, .17, .281],
cxfl["深圳"][1] = [602, 849, 959, 1035, 1158, 1379, 1796, 632, 1.25, 602, 1.19, 596, 1.182, 614, 1.216, .179, .085, 119, .408, .17, .281],
cxfl["深圳"][2] = [602, 849, 959, 1035, 1158, 1379, 1796, 632, 1.25, 602, 1.19, 596, 1.182, 614, 1.216, .179, .085, 119, .408, .204, .332],
cxfl["深圳"][3] = [180, 360, 420, 720, 1800, 3e3, 4500],
cxfl["广西"] = [],
cxfl["广西"][0] = [561, 811, 925, 1005, 1135, 1362, 1774, 472, 1.122, 449, 1.071, 445, 1.054, 459, 1.088, .349, .221, 102, .357, .162, .272],
cxfl["广西"][1] = [616, 868, 981, 1057, 1185, 1410, 1836, 567, 1.122, 539, 1.071, 534, 1.054, 550, 1.088, .332, .213, 119, .374, .162, .264],
cxfl["广西"][2] = [616, 868, 981, 1057, 1185, 1410, 1836, 567, 1.122, 539, 1.071, 534, 1.054, 550, 1.088, .332, .213, 119, .374, .196, .315],
cxfl["广西"][3] = [60, 360, 420, 780, 1800, 3e3, 4500],
cxfl["海南"] = [],
cxfl["海南"][0] = [567, 818, 933, 1013, 1145, 1373, 1788, 459, 1.088, 437, 1.037, 432, 1.029, 445, 1.054, .349, .221, 102, .425, .162, .272],
cxfl["海南"][1] = [524, 739, 835, 901, 1009, 1201, 1564, 550, 1.088, 524, 1.037, 518, 1.029, 534, 1.054, .34, .221, 119, .383, .162, .272],
cxfl["海南"][2] = [524, 739, 835, 901, 1009, 1201, 1564, 550, 1.088, 524, 1.037, 518, 1.029, 534, 1.054, .34, .221, 119, .383, .196, .323],
cxfl["海南"][3] = [60, 300, 360, 720, 1500, 2700, 4200],
cxfl["重庆"] = [],
cxfl["重庆"][0] = [604, 873, 994, 1080, 1219, 1463, 1906, 482, 1.148, 459, 1.088, 454, 1.08, 467, 1.114, .349, .221, 102, .476, .162, .272],
cxfl["重庆"][1] = [616, 868, 981, 1057, 1185, 1410, 1836, 578, 1.148, 550, 1.088, 544, 1.08, 561, 1.114, .34, .221, 119, .366, .162, .264],
cxfl["重庆"][2] = [616, 868, 981, 1057, 1185, 1410, 1836, 578, 1.148, 550, 1.088, 544, 1.08, 561, 1.114, .34, .221, 119, .366, .196, .315],
cxfl["重庆"][3] = [120, 300, 360, 660, 1200, 2400, 3600],
cxfl["四川"] = [],
cxfl["四川"][0] = [604, 873, 994, 1080, 1219, 1463, 1906, 482, 1.148, 459, 1.088, 454, 1.08, 467, 1.114, .349, .221, 102, .417, .162, .255],
cxfl["四川"][1] = [561, 789, 891, 962, 1077, 1281, 1669, 578, 1.148, 550, 1.088, 544, 1.08, 561, 1.114, .332, .213, 119, .366, .162, .255],
cxfl["四川"][2] = [561, 789, 891, 962, 1077, 1281, 1669, 578, 1.148, 550, 1.088, 544, 1.08, 561, 1.114, .332, .213, 119, .366, .187, .306],
cxfl["四川"][3] = [60, 300, 360, 660, 1200, 2400, 3600],
cxfl["贵州"] = [],
cxfl["贵州"][0] = [604, 873, 994, 1080, 1219, 1463, 1906, 527, 1.25, 502, 1.19, 497, 1.182, 512, 1.216, .349, .221, 102, .357, .162, .255],
cxfl["贵州"][1] = [561, 789, 891, 962, 1077, 1281, 1669, 632, 1.25, 602, 1.19, 596, 1.182, 614, 1.216, .332, .213, 119, .374, .153, .255],
cxfl["贵州"][2] = [561, 789, 891, 962, 1077, 1281, 1669, 632, 1.25, 602, 1.19, 596, 1.182, 614, 1.216, .332, .213, 119, .374, .187, .306],
cxfl["贵州"][3] = [180, 300, 360, 660, 1200, 2400, 3600],
cxfl["云南"] = [],
cxfl["云南"][0] = [594, 856, 976, 1061, 1197, 1437, 1871, 527, 1.25, 502, 1.19, 497, 1.182, 512, 1.216, .349, .221, 102, .357, .153, .255],
cxfl["云南"][1] = [611, 861, 973, 1049, 1175, 1399, 1821, 632, 1.25, 602, 1.19, 596, 1.182, 614, 1.216, .323, .213, 119, .408, .153, .255],
cxfl["云南"][2] = [611, 861, 973, 1049, 1175, 1399, 1821, 632, 1.25, 602, 1.19, 596, 1.182, 614, 1.216, .323, .213, 119, .408, .187, .298],
cxfl["云南"][3] = [60, 300, 390, 780, 1800, 3e3, 4500],
cxfl["陕西"] = [],
cxfl["陕西"][0] = [625, 902, 1029, 1117, 1262, 1514, 1972, 550, 1.309, 524, 1.241, 518, 1.233, 534, 1.267, .349, .221, 102, .357, .162, .255],
cxfl["陕西"][1] = [717, 1009, 1141, 1230, 1377, 1639, 2136, 660, 1.309, 629, 1.241, 622, 1.233, 641, 1.267, .332, .213, 119, .374, .162, .255],
cxfl["陕西"][2] = [717, 1009, 1141, 1230, 1377, 1639, 2136, 660, 1.309, 629, 1.241, 622, 1.233, 641, 1.267, .332, .213, 119, .374, .187, .306],
cxfl["陕西"][3] = [160, 360, 480, 720, 1800, 3e3, 4500],
cxfl["甘肃"] = [],
cxfl["甘肃"][0] = [625, 902, 1029, 1117, 1262, 1514, 1972, 550, 1.309, 524, 1.241, 518, 1.233, 534, 1.267, .349, .221, 102, .357, .162, .264],
cxfl["甘肃"][1] = [640, 901, 1018, 1098, 1230, 1465, 1906, 660, 1.309, 629, 1.241, 622, 1.233, 641, 1.267, .332, .213, 119, .374, .162, .264],
cxfl["甘肃"][2] = [640, 901, 1018, 1098, 1230, 1465, 1906, 660, 1.309, 629, 1.241, 622, 1.233, 641, 1.267, .332, .213, 119, .374, .196, .315],
cxfl["甘肃"][3] = [240, 420, 480, 720, 1800, 3e3, 4500],
cxfl["青海"] = [],
cxfl["青海"][0] = [625, 902, 1029, 1117, 1262, 1514, 1972, 505, 1.199, 480, 1.139, 476, 1.131, 490, 1.165, .349, .221, 102, .672, .153, .255],
cxfl["青海"][1] = [640, 901, 1018, 1098, 1230, 1465, 1906, 605, 1.199, 576, 1.139, 570, 1.131, 588, 1.165, .332, .213, 119, .51, .153, .247],
cxfl["青海"][2] = [640, 901, 1018, 1098, 1230, 1465, 1906, 605, 1.199, 576, 1.139, 570, 1.131, 588, 1.165, .332, .213, 119, .51, .179, .298],
cxfl["青海"][3] = [60, 300, 360, 660, 1500, 2700, 4200],
cxfl["宁夏"] = [],
cxfl["宁夏"][0] = [625, 902, 1029, 1117, 1262, 1514, 1972, 527, 1.25, 502, 1.19, 497, 1.182, 512, 1.216, .34, .221, 102, .417, .162, .255],
cxfl["宁夏"][1] = [640, 901, 1018, 1098, 1230, 1465, 1906, 632, 1.25, 602, 1.19, 596, 1.182, 614, 1.216, .323, .213, 119, .298, .162, .255],
cxfl["宁夏"][2] = [640, 901, 1018, 1098, 1230, 1465, 1906, 632, 1.25, 602, 1.19, 596, 1.182, 614, 1.216, .323, .213, 119, .298, .187, .306],
cxfl["宁夏"][3] = [120, 300, 360, 660, 1800, 3e3, 4500],
cxfl["新疆"] = [],
cxfl["新疆"][0] = [596, 862, 982, 1067, 1205, 1445, 1882, 459, 1.088, 437, 1.037, 432, 1.029, 445, 1.054, .357, .23, 102, .391, .17, .289],
cxfl["新疆"][1] = [616, 868, 981, 1057, 1185, 1410, 1836, 550, 1.088, 524, 1.037, 518, 1.029, 534, 1.054, .34, .221, 119, .468, .17, .289],
cxfl["新疆"][2] = [616, 868, 981, 1057, 1185, 1410, 1836, 550, 1.088, 524, 1.037, 518, 1.029, 534, 1.054, .34, .221, 119, .468, .204, .34],
cxfl["新疆"][3] = [180, 360, 420, 720, 1800, 3e3, 4500];;

		window.onload = OnLoad;
		
		function OnLoad(){
			isLoan = $(".result_daikuanmaiche").length > 0;
			
			var c = getRequestParam("city"),
			a = getRequestParam("loan_limit"),
			i = getRequestParam("car_price"),
			l = getRequestParam("loan_term"),
			r = getRequestParam("zuowei"),
			s = getRequestParam("rate");
			c && $("#_city").text(decodeURIComponent(c)),
			i && $("#_gcjg").val(i),
			// a && obj_sfbl_sel.setValue(a),
			a && $("#sfbl_list").val(),
			s && $("#dklv").val(s + "%"),
			// l && obj_dkqx_sel.setValue(l),
			l && $("#dkqx_list").val(),
			r && $("[name=_zw]").filter("[value=" + r + "]").attr("checked", !0),
			i && gocal();
			
		   $(".xg").each(function() {
				$(this).change(function() {
					$("#c_szx").attr("checked") || ($("#c_bjmptyx").attr("checked", !1), $("#c_wgzrx").attr("checked", !1)),
					$("#c_jdcssx").attr("checked") || ($("#c_jdcqdx").attr("checked", !1), $("#c_bjmptyx").attr("checked", !1), $("#c_cshhx").attr("checked", !1)),
					gocal()
				})
			});
			$("input[name=_pl]").change(function() {
				gocal()
			});
			$("#dklv_list").change(function() {
				cal_lv();
			});	
			$("#citysel").click(function(){
				$("#citylist").css("display","block");
			});
			$("#citylist_close").click(function(){
				$("#citylist").css("display","none");
			});
			$("#citylist li").click(function(){
				$("#citylist").css("display","none");
				$("#_city").text($(this).text());
			});
			$(".cal-btn").click(function(){
				 gocal() && reset_height(0)
			});
			$(".reset-btn").click(function(){
				clear_result();
			})
			$(".r_title").each(function(){
				$(this).click(function(){
					var id = $(this).attr("id").substr(8,1);
					if($("#r_body_"+id).css("display")=="none"){
						$("#r_body_"+id).css("display","block");
						$("#r_title_"+id+" .tjt").attr("src","images/arrow-u.png");
					}else{
						$("#r_body_"+id).css("display","none");
						$("#r_title_"+id+" .tjt").attr("src","images/arrow-d.png");
					}
				})
			})
			$(".sybxtype").each(function(){
				$(this).click(function(){
					var type = $(this).data("type");
					$(".sybxtype").removeClass("on");
					$(this).addClass("on");
					sel_bx($(this).data("type")),
					gocal();
				})
			})
		}
		// function cal_result(){
			// getdata();
			// var byhf = jbsf();
			// $("#_byhf").html(byhf);
			
			// $("#_byhf").html(1);
			// $("#_sybx").html(1);
			// $("#_gczfy1").html(1);
			// $("#_dksf").html(1);
		// }
		// function clear_result(){
			// $("#_city").text('北京');
			// $("#_gcjg").val('');
			// $("#sfbl_list").val('3'); 
			// $("#dkqx_list").val('12'); 
			// $("#dklv_list").val('1'); 
			// $("#dklv").val(''); 
			// $("#_byhf").html(0);
			// $("#_sybx").html(0);
			// $("#_gczfy1").html(0);
			// $("#_dksf").html(0);
		// }
		
function trim(t) {
    return t.replace(/(\s*$)/g, "")
}
function remove_err() {
    $(".err").each(function() {
        $(this).remove()
    }),
    $(".inpt").each(function() {
        $(this).css("border", "1px solid #D6D6D6")
    })
}
function sel_bx(t) {
    $("input[name=chkbx]").each(3 == t ?
    function() {
        $(this).attr("checked", !0)
    }: function() {
        $(this).attr("checked", !1)
    }),
    1 == t ? ($("#c_szx").attr("checked", !0), $("#c_jdcssx").attr("checked", !0), $("#c_wgzrx").attr("checked", !0), $("#c_csryzrx").attr("checked", !0), $("#c_cshhx").attr("checked", !0)) : 2 == t && ($("#c_szx").attr("checked", !0), $("#c_jdcssx").attr("checked", !0), $("#c_jdcqdx").attr("checked", !0), $("#c_bjmptyx").attr("checked", !0), $("#c_wgzrx").attr("checked", !0), $("#c_csryzrx").attr("checked", !0), $("#c_cshhx").attr("checked", !0))
}		
function clear_result() {
    $("#_byhf").html(0),
    $("#_sybx").html(0),
    $("#_dksf").html(0),
    $("#_gczfy1").html(0),
    $("#_gczfy2").html(0),
    $("#result .r_body .ltd input").each(function() {
        $(this).val(0)
    }),
    $($("input[name=_pl]")[1]).attr("checked", !0),
    $($("input[name=_szbe]")[1]).attr("checked", !0),
    $($("input[name=_jkgc]")[1]).attr("checked", !0),
    $($("input[name=_hhbe]")[1]).attr("checked", !0),
    $("#_tbrs").val(1),
    $($("#result .bxlx li")[0]).removeClass("on"),
    $($("#result .bxlx li")[1]).addClass("on"),
    $($("#result .bxlx li")[2]).removeClass("on"),
    sel_bx(2),
    $("#result .r_body").hide(),
    1 == $(".menu ul li.here").attr("lid") ? ($("#r_loan").hide(), $("#r_qk").show()) : ($("#_debx_dkje").html(0), $("#_debx_dkqx").html(0), $("#_debx_myhk").html(0), $("#_debx_zflx").html(0), $("#_debx_hkze").html(0), $("#_debj_dkje").html(0), $("#_debj_dkqx").html(0), $("#_debj_syhk").html(0), $("#_debj_mydj").html(0), $("#_debj_zflx").html(0), $("#_debj_hkze").html(0))
}
function reset_height(t) {
    var e = 0,
    c = $(".menu ul li.here").attr("lid"),
    a = $.browser.msie && "6.0" == $.browser.version && !$.support.style;
    1 == c ? (e = a ? 452 : 450, $("#r_title_" + t).next().is(":hidden") || (1 == t ? e = 512 : 2 == t ? e = a ? 627 : 632 : 3 == t && (e = a ? 840 : 854))) : 2 == c && (e = a ? 563 : 560, $("#r_title_" + t).next().is(":hidden") || (2 == t ? e = a ? 738 : 743 : 3 == t ? e = a ? 951 : 965 : 4 == t && (e = 782)))
}
function cal_lv() {
	 var d = parseFloat($("#dklv_list").val())*parseFloat(newrate);
    $("#dklv").val(d.toFixed(2) + "%");
}
function gocal() {
    if (city = $("#_city").html(), gcjg = parseFloat($("#_gcjg").val()), spfy = $("#_spfy").val(), zw = $('input:radio[name="_zw"]:checked').val(), !gcjg || isNaN(gcjg)) return alert("请输入正确的购车价格"),
    $("#_gcjg").css("border", "1px solid #FF6633").focus(),
    !1;
    $("#_gcjg").css("border", "1px solid #D6D6D6");
    var dkzlx = 0,
    dksf = 0;
// console.log(isLoan);
isLoan = true;
    if (isLoan) {
        if (a_dkzlx = loancal(), !a_dkzlx) return ! 1;
        dkzlx = a_dkzlx[0],
        dksf = a_dkzlx[1]
    }
console.log(a_dkzlx);
    byhf = jbsf(),
console.log(byhf);
    $("#_gzs").val(fmoney(byhf.gzs, 0)),
    $("#_spfy").val(byhf.spfy),
    $("#_ccs").val(byhf.ccs),
    $("#_jqx").val(byhf.jqx),
    $("#_byhf").html(fmoney(byhf.ze, 0)),
    szbe = $('input:radio[name="_szbe"]:checked').val(),
    jkgc = $('input:radio[name="_jkgc"]:checked').val(),
    tbrs = parseInt($("#_tbrs").val()),
    hhbe = $('input:radio[name="_hhbe"]:checked').val();
    var sybx = 0;
    $("input[name=chkbx]").each(function() {
        var id = $(this).attr("id"),
        foo = id.substr(2, 7);
        $(this).attr("checked") ? (eval(foo + " = " + $(this).attr("id") + "();"), eval('$("#_' + foo + '").val(fmoney(' + foo + ', 0)).removeAttr("disabled").css("background", "#FFFFFF");'), eval("sybx = sybx + parseFloat(" + foo + ");")) : eval('$("#_' + foo + '").val("").attr("disabled", "disabled").css("background", "#EEEEEE");')
    }),
    $("#_sybx").html(fmoney(sybx, 0));
    var f = isLoan ? 2 : 1;
console.log(sybx);
	f = 1;
    $("#_gczfy" + f).html(fmoney(gcjg + parseFloat(byhf.ze) + parseFloat(sybx) + parseFloat(dkzlx), 0)),
    isLoan && $("#_dksf").html(fmoney(dksf + parseFloat(byhf.ze) + parseFloat(sybx), 0))
}		
function loancal() {
    //var t = gcjg * (1 - .1 * parseInt($("input[name=sfbl]").val())),
	var t = gcjg * (1 - .1 * parseInt($("#sfbl_list").val())),
    e = parseFloat($("#dklv").val()),
    c = $("input[name=dkqx]").val();
	
	c = $("#dkqx_list").val();
	
    if (!e || isNaN(e) || e > 100) return alert("请输入正确的贷款利率"),
    $("#dklv").css("border", "1px solid #FF6633").focus(),
    !1;
    $("#dklv").css("border", "1px solid #D6D6D6");
    var a = 1,
    i = 0,
    l = debx(t, e, c, a, i);
    $("#_debx_dkje").html(fmoney(t, 2)),
    $("#_debx_dkqx").html(c),
    $("#_debx_myhk").html(fmoney(l.yhk, 2)),
    $("#_debx_zflx").html(fmoney(l.zlx, 2)),
    $("#_debx_hkze").html(fmoney(l.hkze, 2));
    var r = debj(t, e, c, a, i);
    return $("#_debj_dkje").html(fmoney(t, 2)),
    $("#_debj_dkqx").html(c),
    $("#_debj_syhk").html(fmoney(r.syhk, 2)),
    $("#_debj_mydj").html(fmoney(r.mydj, 2)),
    $("#_debj_zflx").html(fmoney(r.zlx, 2)),
    $("#_debj_hkze").html(fmoney(r.hkze, 2)),
    $("#r_loan").show(),
    $("#r_qk").hide(),
    [l.zlx, gcjg - t]
}
function fmoney(e, c) {
    c = c >= 0 && 20 >= c ? c: 2,
    e = parseFloat((e + "").replace(/[^\d\.-]/g, "")).toFixed(c) + "";
    var a = "";
    for (0 == c ? (a = e.split("").reverse(), r = "") : (a = e.split(".")[0].split("").reverse(), r = e.split(".")[1]), t = "", i = 0; i < a.length; i++) t += a[i] + ((i + 1) % 3 == 0 && i + 1 != a.length ? ",": "");
    return "" == r ? t.split("").reverse().join("") : t.split("").reverse().join("") + "." + r
}
function jbsf() {
    var t = 0;
    t = gcjg / 1.17 * .1;
    var e = 0;
    e = 1 == zw ? 950 : 1100,
    (0 == spfy.length || 0 == spfy) && (spfy = 500),
    ccs = c_ccs();
    var c = new Object;
    return c.ze = parseFloat(t) + parseFloat(spfy) + parseFloat(ccs) + parseFloat(e),
    c.gzs = t,
    c.spfy = spfy,
    c.ccs = ccs,
    c.jqx = e,
    c
}
function c_ccs() {
    var t = 0,
    e = $('input:radio[name="_pl"]:checked').val();
    return t = cxfl[city][3][e - 1]
}
function c_szx() {
    var t = 0,
    e = 1 == zw ? 0 : 1,
    c = [];
    return c[5] = 0,
    c[10] = 1,
    c[15] = 2,
    c[20] = 3,
    c[30] = 4,
    c[50] = 5,
    c[100] = 6,
    t = cxfl[city][e][c[szbe]]
}
function c_jdcssx() {
    var t = 0,
    e = 1 == zw ? 0 : 1;
    return t = cxfl[city][e][7] + gcjg * cxfl[city][e][8] / 100
}
function c_jdcqdx() {
    var t = 0,
    e = 1 == zw ? 0 : 1;
    return t = cxfl[city][e][17] + gcjg * cxfl[city][e][18] / 100
}
function c_blddpsx() {
    var t = 0,
    e = 1 == jkgc ? 20 : 19;
    return t = gcjg * cxfl[city][zw - 1][e] / 100
}
function c_zrssx() {
    var t = 0;
    return t = .128 * gcjg / 100
}
function c_bjmptyx() {
    return.2 * (jdcssx + szx)
}
function c_wgzrx() {
    return.2 * szx
}
function c_csryzrx() {
    return tbrs && 0 != tbrs ? parseFloat(50 * tbrs) : 50
}
function c_cshhx() {
    var t = [];
    t[2e3] = [340, 498, 723],
    t[5e3] = [485, 765, 935],
    t[1e4] = [646, 995, 1275],
    t[2e4] = [969, 1513, 1913];
    var e = 0;
    return gcjg >= 3e5 && 5e5 > gcjg ? e = 1 : gcjg >= 5e5 && (e = 2),
    t[hhbe][e]
}
function getRequestParam(t) {
    var e = location.href,
    c = e.substring(e.indexOf("?") + 1, e.length).split("&"),
    a = {};
    for (i = 0; j = c[i]; i++) a[j.substring(0, j.indexOf("=")).toLowerCase()] = j.substring(j.indexOf("=") + 1, j.length);
    var l = a[t.toLowerCase()];
    return "undefined" == typeof l ? "": l
}
function debx(e, r, t, a, s) {
    t = parseInt(t),
    e = parseFloat(e),
    r = parseFloat(r),
    a = parseInt(a),
    s = parseInt(s),
    ylv = 2 == a ? .01 * r: r / 12 * .01;
    var y = Math.pow(1 + ylv, t),
    n = e * ylv * (y / (y - 1)),
    l = n * t,
    v = l - e,
    o = new Object;
    if (o.zlx = v, o.hkze = l, o.yhk = n, 1 == s) {
        var h = e,
        p = [];
        for (i = 1; t >= i; i++) {
            var f = h * ylv,
            d = n - f;
            h -= d;
            var c = new Object;
            c.bh = i,
            c.ylx = f,
            c.ybj = d,
            c.ye = h,
            p[i - 1] = c
        }
        o.xx = p
    }
    return o
}
function debj(e, r, t, a, s) {
    t = parseInt(t),
    e = parseFloat(e),
    r = parseFloat(r),
    a = parseInt(a),
    s = parseInt(s),
    ylv = 2 == a ? .01 * r: r / 12 * .01;
    var y = 0,
    n = e / t,
    l = new Object;
    l.ybj = n;
    var v = e,
    o = [];
    for (i = 1; t >= i; i++) {
        yhk = e / t + (e - e * (i - 1) / t) * ylv,
        1 == i && (l.syhk = yhk),
        2 == i && (l.mydj = l.syhk - yhk),
        y += yhk,
        ylx = yhk - n,
        v -= n;
        var h = new Object;
        h.bh = i,
        h.ylx = ylx,
        h.yhk = yhk,
        h.ye = v,
        o[i - 1] = h
    }
    return 1 == s && (l.xx = o),
    l.zlx = y - e,
    l.hkze = y,
    l
}
function esfsf(e, r, t, a) {
    e = parseInt(e),
    r = parseInt(r),
    t = parseFloat(t),
    a = parseFloat(a);
    var s = 0;
    s = 2 == e ? 3 : t > 90 ? 1.5 : 1;
    var y = a * s / 100,
    i = 0;
    0 == r && (i = 5.55);
    var n = a * i / 100,
    l = .07 * n,
    v = .03 * n,
    o = .01 * a,
    h = 0,
    p = new Object;
    return p.qs = y,
    p.yys = n,
    p.cjs = l,
    p.jyfjf = v,
    p.grsds = o,
    p.yhs = h,
    p.total = y + n + l + v + o + h,
    p
}

	</script>
</html>