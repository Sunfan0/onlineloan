
		<!--主体部分-->
		<div class="contanier">
			<!--当前位置-->
			<div class="loaciton"><img src="images/location.png" alt="" />您当前的位置：
				<a class="hoverpointer" onclick="LocationHref('index')">首页</a> >
				<a class="hoverpointer" onclick="LocationHref('smartyproindex','2')">贷款顾问</a> >
				<a href="#">详情</a>
			</div>
			<div class="content clearfix" style='margin-bottom: 20px;'>
				<div class="contleft">
					<!--需求详细页面-->
					<div class="needcont bgborder clearfix">
						<!--找顾问-->
						<div class="likeneed xqconsult clearfix">
							<div class="likeneedlist">
								<ul>
									<li>
										<div class="liketext" style="width:100%;">
											<div class="liketextpic">
												<img src="{$supplierdetail.imgurl}" alt="" class="infoheadstyle"/>
												<p>{$supplierdetail.name}</p>
												<i><img src="images/req_07.png" alt="" /></i>
												<div class="needflow" style=" text-align: center;line-height: 35px;position: absolute; width: 100%;" onclick="FollowSupply({$viewright},{$supplierdetail.id},this)">
													<img id="followSupply_img" src="images/req_00.jpg" alt=""/><span>关注该顾问</span>
												</div>
											</div>
											<div class="liketextcont" style="width:530px;">
												<p>
													{if {$supplierdetail.type} eq 1}
														中介
													{else}
														机构
													{/if}
													<br> 
													所在地区：
													{$subarea=""}
													{counter start=0 skip=1 print=false}
													{$length={$supplierdetail.subarea|@count}}
													{foreach $supplierdetail.subarea as $s}
														{if $length eq {counter}}
															{$subarea=$subarea|cat:$s.name}
														{else}
															{$subarea=$subarea|cat:$s.name|cat:'、'}
														{/if}
													{foreachelse}
													{/foreach}
													{$subarea|truncate:21:"...":true}<br> 
													所在公司：{$supplierdetail.company}<br> 
													最新产品：{$supplierdetail.goodproduct|truncate:21:"...":true}<br>
													个人资料：
														{if {$supplierdetail.sex} eq 1}
															男
														{else}
															女
														{/if} / {$supplierdetail.age}岁<br>
													个人特点：{$supplierdetail.personalfeature|truncate:21:"...":true}
												</p>
											</div>
											<div class="needflow" onclick="CollectSupplier({$viewright},{$supplierdetail.id},this)">
												<p style="float:right;"><img id="CollectSupplier_img" src="images/scgw_00.jpg" alt=""/><span style="vertical-align: middle;"> 收藏该顾问</span></p>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
						<div class="needleft needperson">
							<div class="needtitle">
								<h3><span>基本信息</span></h3>
								<!--<p>信用贷款，三小时下款，额度2-50万，利息0.78%-2.33%申请条件：1 在现单位上班满半年，打卡工资2000以上即可申请。2 个人名下有按</p>-->
								<p>{$supplierdetail.goodproduct}</p>
							</div>
							<div class="liketel">
								<img src="images/phone.jpg" alt="" />
								<p>
									<i>电话咨询，最快捷，最方便！</i>
									<span class="suppliermobile">{$supplierdetail.mobile|truncate:3:"":true}********</span>
								</p>
								<a class="seesuppliermobile hoverpointer">点击查看</a>
							</div>
						</div>
					</div>
					<!--贷款产品-->
					<div class='table1-1'>
						<div class='div4-4'>
							<div class='div3-6'>
							</div>
							<span class='span3-5'>贷款产品</span>
						</div>
						<table cellspacing="0px" cellpadding="0px">
							<tr>
								<th>要求</th>
								<th>产品名称</th>
								<th>还款方式</th>
								<th>年限</th>
								<th>额度</th>
								<!--<th>贷款联系方式</th>-->
								<th>更新时间</th>
							</tr>
							
							{counter start=0 skip=1 print=false}
							{foreach $supplyinfolist.data as $s}
								<tr class='table-tr hoverpointer' onclick="LocationHref('smartyproductsdetails',{$s.id},true,{$viewright})">
									<td>{$s.property}</td>
									<td>{$s.productname}</td>
									<td>{$s.paytype}</td>
									<td>{$s.worktime}</td>
									<td>{$s.paynum}万</td>
									<!--<td>
										<font class="seeinfomobile">点击查看</font>
										<span style="display:none;">{$s.mobile}</span>
									</td>-->
									<td>{$s.createtime}</td>
								</tr>
							{foreachelse}
							{/foreach}
							
							<!--<tr class="table-tr">
								<td>渣打银行-现贷派 </td>
								<td>在现单位<br>工作满3个月</td>
								<td>税前收入<br>5000以上</td>
								<td>参考贷款产品</td>
								<td>15012356510</td>
								<td>2017/5/7</td>
							</tr>-->
						</table>
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
									<span class='xindaidaixun-right-buttom-1-2' onclick="LocationHref('chedai')">车代计算器</span>
								</p>
							</div>

							<div class='xindaidaixun-right-buttom-1'>
								<img src="images/01_40.jpg" alt="" onclick="LocationHref('ershoufang')"/>
								<p>
									<span class='xindaidaixun-right-buttom-1-3'onclick="LocationHref('ershoufang')">二手房贷计算器</span>
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
		<script>
			console.log({json_encode($supplyinfolist)});
			console.log({json_encode($supplierdetail)});
			console.log({json_encode($viewright)});
			window.onload = OnLoad;
			function OnLoad(){
				BindEvents();
				IsFollowSupply({$supplierdetail.id},{$viewright});
				IsCollectSupplier({$supplierdetail.id},{$viewright});
				ShowTitlecon("贷款顾问{$supplierdetail.name}");
			}
			function BindEvents(){				
				$(".seesuppliermobile").click(function(){
					Common_MobileView({$viewright},1,"ajax.php?mode=SupplierdetailView&supplierid={$supplierdetail.id}",function(){
						$(".suppliermobile").text({$supplierdetail.mobile});
					},false,"",true)
				});
				
				$(".button-1-2").click(function(){
					$(ele).attr("src","images/req_11.jpg");
				});
			}
		</script>
	</body>
</html>