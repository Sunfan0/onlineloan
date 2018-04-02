
		<!--主体部分-->
		<div class="contanier">
			<!--当前位置-->
			<div class="loaciton proloaciton"><img src="images/location.png" alt="" />您当前的位置：
				<a class="hoverpointer" onclick="LocationHref('index')">首页</a> >
				<a href="#" id="loacitontitle"></a>
			</div>
			<div class="navtabwrap">
				<div class="protab clearfix">
					<ul>
						<li class="hoverpointer" onclick="LocationHref('smartyproindex','0')">找客户</li>
						<li class="hoverpointer" onclick="LocationHref('smartyproindex','1')">找产品</li>
						<li class="hoverpointer" onclick="LocationHref('smartyproindex','2')">找顾问</li>
					</ul>
				</div>
				<div class="prolist">
					<div class="con">
						<div class='daikuanchanpin-top clearfix'>
							<dl>
								<dt class='daikuanchanpin-dt'>贷款需求</dt>
								<dd class='daikuanchanpin-dd'>
									<span class='daikuanjine'>贷款金额</span>
									<!--<select name="" class='daikuanchanpin-monery'>
										<option value="">10</option>
										<option value="">20</option>
										<option value="">30</option>
										<option value="">50</option>
									</select>
									-->
									<input data-nameid="1" data-text="贷款金额:" type="text" class='daikuanchanpin-monery loanmoney screeninput0_1' style="height: 30px;">
									<span class='daikuanchanpin-danwei' style="left: 655px;">万元</span>
								</dd>
							</dl>
							<dl>
								<dt class='daikuanchanpin-xinxi'>贷款类型</dt>
								<dd class='daikuanchanpin-fenlei'>
									<span data-id="0" data-nameid="2" data-text="贷款类型:不限" class="hoverpointer screentext0">不限</span>
									
									{counter start=0 skip=1 print=false}
									{foreach $producttype as $p}
										<span data-id="{$p.id}" data-nameid="2" data-text="贷款类型:{$p.producttype}" class="hoverpointer screentext0">{$p.producttype}</span>
									{/foreach}
								</dd>
							</dl>
							<dl>
								<dt class='daikuanchanpin-xinxi'>职业身份</dt>
								<dd class='daikuanchanpin-fenlei'>
									<span data-id="0" data-nameid="3" data-text="职业身份:不限" class="hoverpointer screentext0">不限</span>
									{counter start=0 skip=1 print=false}
									{foreach $profession as $p}
										<span data-id="{$p.id}" data-nameid="3" data-text="职业身份:{$p.professiontype}" class="hoverpointer screentext0">{$p.professiontype}</span>
									{/foreach}
								</dd>
							</dl>

							<dl>
								<dt class='daikuanchanpin-xinxi'>房产类型</dt>
								<dd class='daikuanchanpin-fenlei'>
									<span data-id="0" data-nameid="4" data-text="房产类型:不限" class="hoverpointer screentext0">不限</span>
									<span data-id="1" data-nameid="4" data-text="房产类型:无" class="hoverpointer screentext0">无</span>
									<span data-id="2" data-nameid="4" data-text="房产类型:红本房" class="hoverpointer screentext0">红本房</span>
									<span data-id="3" data-nameid="4" data-text="房产类型:按揭房" class="hoverpointer screentext0">按揭房</span>
									<span data-id="4" data-nameid="4" data-text="房产类型:商铺" class="hoverpointer screentext0">商铺</span>
									<span data-id="5" data-nameid="4" data-text="房产类型:军产房" class="hoverpointer screentext0">军产房</span>
									<span data-id="6" data-nameid="4" data-text="房产类型:农民房" class="hoverpointer screentext0">农民房</span>									
								</dd>
							</dl>

							<dl>
								<dt class='daikuanchanpin-xinxi'>是否有车</dt>
								<dd class='daikuanchanpin-fenlei'>
									<span data-id="0" data-nameid="5" data-text="是否有车:不限" class="hoverpointer screentext0">不限</span>
									<span data-id="1" data-nameid="5" data-text="是否有车:无" class="hoverpointer screentext0">无</span>
									<span data-id="2" data-nameid="5" data-text="是否有车:全款车" class="hoverpointer screentext0">全款车</span>
									<span data-id="3" data-nameid="5" data-text="是否有车:按揭车" class="hoverpointer screentext0">按揭车</span>
								</dd>
							</dl>

							<dl>
								<dt class='daikuanchanpin-xinxi'>信用情况</dt>
								<dd class='daikuanchanpin-fenlei'>
									<span data-id="0" data-nameid="6" data-text="信用情况:不限" class="hoverpointer screentext0">不限</span>
									{counter start=0 skip=1 print=false}
									{foreach $credit as $c}
										<span data-id="{$c.id}" data-nameid="6" data-text="信用情况:{$c.credit}" class="hoverpointer screentext0">{$c.credit}</span>
									{/foreach}
								</dd>
							</dl>

							<dl>
								<dt class='daikuanchanpin-dt'>所在省份</dt>
								<dd class='daikuanchanpin-shengfen'>
									<span data-id="0" data-nameid="7" data-text="所在省份:全国"  class="hoverpointer screentext0">全国</span>
									{counter start=0 skip=1 print=false}
									{foreach $subarea as $s}
										<span data-id="{$s.id}" data-nameid="7" data-text="所在省份:{$s.name}" class="hoverpointer screentext0">{$s.name}</span>
									{/foreach}
								</dd>
							</dl>

							<dl id="proindex0">
								<dt class='daikuanchanpin-dt' style=" border-bottom: none;">全部条件</dt>
							</dl>
						</div>
						<div class='table1-1 tablewidth'>
							<div class='div4-4'>
								<div class='div3-6'>
								</div>
								<span class='span3-5'>贷款需求</span>
							</div>
							<table cellspacing="0px" cellpadding="0px" id="showscreendata1">
								<tr>
									<th>姓名</th>
									<th>地区</th>
									<th>用户资质</th>
									<th>货款金额</th>
									<th>状态</th>
									<th>申请时间</th>
									<th>特别需求</th>
									<th>更新时间</th>
									
									<!--<th>联系方式</th>-->
								</tr>
								{counter start=0 skip=1 print=false}
								{foreach $needinfolist as $n}
									<tr class='table-tr hoverpointer' onclick="LocationHref('smartyneed',{$n.id},true,{$viewright})">
										<td>{$n.name}</td>
										<td>
											{$areatext=""}
											{counter start=0 skip=1 print=false}
											{$length={$n.subarea|@count}}
											{foreach $n.subarea as $a}
												{if $length eq {counter}}
													{$areatext=$areatext|cat:$a.name}
												{else}
													{$areatext=$areatext|cat:$a.name|cat:'、'}
												{/if}
											{foreachelse}
												无
											{/foreach}
											{$areatext|truncate:21:"...":true}
										</td>
										<td>{$n.aptitude}</td>
										<td>{$n.demandnum}万</td>
										<td>
											{if {$n.demandstate} eq 1}
												需求中
											{else}
												已被一人接单
											{/if}
										</td>
										<td>{$n.Applytime|truncate:10:"":true}</td>
										<td>{$n.otherdesc|truncate:20:"":true}</td>
										<td>{$n.createtime|truncate:10:"":true}</td>
										
										<!--<td>
											{if {$n.mobile} eq ""}
												<span>暂无联系方式</span>
											{else}
												<a href="###" class="seeinfomobile">点击查看</a>
												<span style="display:none;">{$n.mobile}</span>
											{/if}
										</td>-->
									</tr>
								{foreachelse}
								{/foreach}
							</table>
						</div>
					</div>

					<div class="con">
						<div class='daikuanchanpin-top clearfix'>
							<dl>
								<dt class='daikuanchanpin-dt'>贷款产品</dt>
								<dd class='daikuanchanpin-dd'>
									<span class='daikuanjine'>贷款金额</span>
									<!--<select name="" class='daikuanchanpin-monery'>
										<option value="">10</option>
										<option value="">20</option>
										<option value="">30</option>
										<option value="">50</option>
									</select>
									-->
									<input data-nameid="1" data-text="贷款金额:" type="text" class='daikuanchanpin-monery loanmoney screeninput1_1' style="height: 30px;">
									<span class='daikuanchanpin-danwei' style="left: 655px;">万元</span>
									<span class='daikuanjine'>货款期限</span>
									<!--<select name="" class='daikuanchanpin-monery'>
										<option value="">1</option>
										<option value="">3</option>
										<option value="">6</option>
										<option value="">12</option>
									</select>
									-->
									<input data-nameid="2" data-text="货款期限:" type="text" class='daikuanchanpin-monery loanmonth screeninput1_2' style="height: 30px;">
									<span class='daikuanchanpin-yuefen' style="left: 905px;">个月</span>
								</dd>									
							</dl>
							<dl>
								<dt class='daikuanchanpin-xinxi'>产品类型</dt>
								<dd class='daikuanchanpin-fenlei'>
									<span data-id="0" data-nameid="3" data-text="产品类型:不限" class="hoverpointer screentext1">不限</span>
									{counter start=0 skip=1 print=false}
									{foreach $producttype as $p}
										<span  data-id="{$p.id}" data-nameid="3" data-text="产品类型:{$p.producttype}" class="hoverpointer screentext1">{$p.producttype}</span>
									{/foreach}
								</dd>
							</dl>
							<dl>
								<dt class='daikuanchanpin-xinxi'>职业身份</dt>
								<dd class='daikuanchanpin-fenlei'>
									<span data-id="0" data-nameid="4" data-text="职业身份:不限" class="hoverpointer screentext1">不限</span>
									{counter start=0 skip=1 print=false}
									{foreach $profession as $p}
										<span data-id="{$p.id}" data-nameid="4" data-text="职业身份:{$p.professiontype}" class="hoverpointer screentext1">{$p.professiontype}</span>
									{/foreach}
								</dd>
							</dl>

							<dl>
								<dt class='daikuanchanpin-xinxi'>资产要求</dt>
								<dd class='daikuanchanpin-fenlei'>
									<span data-id="0" data-nameid="5" data-text="资产要求:不限" class="hoverpointer screentext1">不限</span>
									{counter start=0 skip=1 print=false}
									{foreach $property as $p}
										<span data-id="{$p.id}" data-nameid="5" data-text="资产要求:{$p.property}" class="hoverpointer screentext1">{$p.property}</span>
									{/foreach}
								</dd>
							</dl>

							<dl>
								<dt class='daikuanchanpin-xinxi'>信用情况</dt>
								<dd class='daikuanchanpin-fenlei'>
									<span data-id="0" data-nameid="6" data-text="信用情况:不限" class="hoverpointer screentext1">不限</span>
									{counter start=0 skip=1 print=false}
									{foreach $credit as $c}
										<span data-id="{$c.id}" data-nameid="6" data-text="信用情况:{$c.credit}" class="hoverpointer screentext1">{$c.credit}</span>
									{/foreach}
								</dd>
							</dl>
							<dl>
								<dt class='daikuanchanpin-dt'>所在省份</dt>
								<dd class='daikuanchanpin-shengfen'>
									<span data-id="0" data-nameid="7" data-text="所在省份:全国"   class="hoverpointer screentext1">全国</span>
									{counter start=0 skip=1 print=false}
									{foreach $subarea as $s}
										<span data-id="{$s.id}"  data-nameid="7" data-text="所在省份:{$s.name}"  class="hoverpointer screentext1">{$s.name}</span>
									{/foreach}
								</dd>
							</dl>

							<dl id="proindex1">
								<dt class='daikuanchanpin-dt' style=" border-bottom: none;">全部条件</dt>
							</dl>
						</div>
						<div class='table1-1 tablewidth'>
							<div class='div4-4'>
								<div class='div3-6'>
								</div>
								<span class='span3-5'>贷款产品</span>
							</div>
							<table cellspacing="0px" cellpadding="0px" id="showscreendata2">
								<tr>
									<th>地区</th>
									<th>要求</th>
									<th>产品名称</th>
									<th>还款方式</th>
									<th>年限</th>
									<th>额度</th>
									<!--<th>贷款联系方式</th>-->
									<th>更新时间</th>
								</tr>
								{counter start=0 skip=1 print=false}
								{foreach $supplyinfolist as $s}
									<tr class='table-tr hoverpointer'  onclick="LocationHref('smartyproductsdetails',{$s.id},true,{$viewright})">
										<td>
											{$areatext=""}
											{counter start=0 skip=1 print=false}
											{$length={$s.subarea|@count}}
											{foreach $s.subarea as $a}
												{if $length eq {counter}}
													{$areatext=$areatext|cat:$a.name}
												{else}
													{$areatext=$areatext|cat:$a.name|cat:'、'}
												{/if}
											{foreachelse}
												无
											{/foreach}
											{$areatext|truncate:12:"...":true}
										</td>
										<td>{$s.property}</td>
										<td>{$s.productname}</td>
										<td>{$s.paytype}</td>
										<td>{$s.worktime}</td>
										<td>{$s.paynum}万</td>
										<!--<td>
											{if {$s.mobile} eq ""}
												<span>暂无联系方式</span>
											{else}
												<a href="###" class="seeinfomobile">点击查看</a>
												<span style="display:none;">{$s.mobile}</span>
											{/if}
										</td>-->
										<td>{$s.createtime|truncate:10:"":true}</td>
									</tr>
								{foreachelse}
								{/foreach}
							</table>
						</div>
					</div>
					
					<div class="con">
						<div class='daikuanchanpin-top clearfix'>
							<dl>
								<dt class='daikuanchanpin-xinxi'>顾问类型</dt>
								<dd class='daikuanchanpin-fenlei'>
									<span data-id="0" data-nameid="1" data-text="顾问类型:不限" class="hoverpointer screentext2">不限</span>
									<span data-id="1" data-nameid="1" data-text="顾问类型:中介" class="hoverpointer screentext2">中介</span>
									<span data-id="2" data-nameid="1" data-text="顾问类型:机构" class="hoverpointer screentext2">机构</span>
								</dd>
							</dl>
							<dl>
								<dt class='daikuanchanpin-dt'>所在省份</dt>
								<dd class='daikuanchanpin-shengfen'>
									<span data-id="0" data-nameid="2" data-text="所在省份:全国"   class="hoverpointer screentext2">全国</span>
									{counter start=0 skip=1 print=false}
									{foreach $subarea as $s}
										<span data-id="{$s.id}"  data-nameid="2" data-text="所在省份:{$s.name}"  class="hoverpointer screentext2">{$s.name}</span>
									{/foreach}
								</dd>
							</dl>
							<dl id="proindex2">
								<dt class='daikuanchanpin-dt' style=" border-bottom: none;">全部条件</dt>
							</dl>
						</div>
						<div class="content clearfix">
							<div class="contleft">									
								<!--找顾问-->
								<div class="likeneed consultant bgborder clearfix">
									<div class="likeneedlist" id="showscreendata3">
										<ul>
											{counter start=0 skip=1 print=false}
											{foreach $supplierlist.data as $s}
												<li class="gray">
													<div class="liketext">
														<div class="liketextpic hoverpointer" onclick="LocationHref('smartyconsultantdetails',{$s.id},true,{$viewright})">
															<img src="{$s.imgurl}" alt="" class="infoheadstyle"/>
															<p>{$s.name}</p>
															<i><img src="images/req_07.png" alt="" /></i>
														</div>
														<div class="liketextcont">
															<p>
																{if {$s.type} eq 1}
																	中介
																{else}
																	机构
																{/if}
															<br>
															所在地区：
															{$areatext=""}
															{counter start=0 skip=1 print=false}
															{$length={$s.subarea|@count}}
															{foreach $s.subarea as $a}
																{if $length eq {counter}}
																	{$areatext=$areatext|cat:$a.name}
																{else}
																	{$areatext=$areatext|cat:$a.name|cat:'、'}
																{/if}
															{foreachelse}
																无
															{/foreach}{$areatext|truncate:21:"...":true}<br>
															所在公司：{$s.company}<br> 
															最新产品：{$s.goodproduct|truncate:21:"...":true}<br>
															个人资料：
																{if {$s.sex} eq 1}
																	男
																{else}
																	女
																{/if} / {$s.age}岁<br>
															个人特点：{$s.personalfeature|truncate:21:"...":true}
															</p>
														</div>
													</div>
													<div class="liketel">
														<a class="hoverpointer" onclick="LocationHref('smartyconsultantdetails',{$s.id},true,{$viewright})">咨询</a>									
													</div>
												</li>
											{foreachelse}	
											{/foreach}
										</ul>							
									</div>						
								</div>
								<div id="kkpager2" class="kkpager"></div>
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

								<!--最新资讯-->
								<div class="hotnewslist" style="display: inline-block;width: 325px;">
									<div class='div4-4'>
										<div class='div3-6'>
										</div>
										<span class='span3-5'>最新资讯</span>
									</div>
									<div class="hotnewscont">
										<ul>
											{counter start=0 skip=1 print=false}
											{foreach $newslist as $n}
												<li class="hoverpointer" onclick="LocationHref('smartynews',{$n.id},true,{$viewright})"><a>{$n.title|truncate:17:"...":true}</a></li>
											{foreachelse}
											{/foreach}
										</ul>
									</div>
								</div>
							</div>				
						</div>	
					</div>
				</div>
			</div>
		</div>
		<style>
		.navtabwrap .protab .hoverpointer:hover{
			background: #f0fdff;
		}
		.navtabwrap .protab .on:hover{
			background: #fff !important;
		}
		.daikuanchanpin-color{
			color:#09a9de !important;
			font-weight: 600;
		}
		.showcon-color:hover{
			box-shadow: 1px 1px 2px #66bdd7;
		}
		.chanpin-dd:hover span{
			color: #155e91 !important;
		}
		</style>
		<!--tab切换-->
		<script>
			console.log({json_encode($supplyinfoid)});
			console.log("profession",{json_encode($profession)});
			console.log("property",{json_encode($property)});
			console.log("credit",{json_encode($credit)});
			console.log("subarea",{json_encode($subarea)});
			console.log("producttype",{json_encode($producttype)});
			console.log("supplyinfolist",{json_encode($supplyinfolist)});
			console.log("needinfolist",{json_encode($needinfolist)});
			console.log("supplierlist",{json_encode($supplierlist)});
			console.log("newslist",{json_encode($newslist)});
			console.log("viewright",{json_encode($viewright)});
	
			var loacitontitle = "";
			var ScreenData = {};
			ScreenData.typeid = "";
			ScreenData.datavalue = [];
			
			
			function GetQueryString(name){
				 var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
				 var r = window.location.search.substr(1).match(reg);
				 if(r!=null)return  unescape(r[2]); return null;
			}
			var currentpage = GetQueryString("currentpage");
			var supplyinfoid = GetQueryString("supplyinfoid");
			if(currentpage==null){
				currentpage=1;
			}
			if(supplyinfoid==null){
				supplyinfoid=0;
			}
// console.log("currentpage",currentpage);
// console.log("supplyinfoid",supplyinfoid);			
			$(".protab li:eq("+supplyinfoid+")").addClass('on').siblings().removeClass('on');
			$(".con").hide();
			$(".con").eq(supplyinfoid).show();
			Loacitontitle(supplyinfoid);
			
			
			window.onload = OnLoad;
			function OnLoad(){
				BindEvents();
				ShowTitlecon();
				/*Showkkpager();*/
			}
			function Showkkpager(){
				kkpager.generPageHtml({
					pagerid : "kkpager2",
					pno : currentpage,
					total : {json_encode($supplierlist)}.pagecount,
					totalRecords : {json_encode($supplierlist)}.perpage,
					mode : 'click',//默认值是link，可选link或者click
					click : function(n){
						window.location.href="smartyproindex.new.php?supplyinfoid="+supplyinfoid+"&currentpage="+n;
						return false;
					}
				} , true);
			}
			function BindEvents(){
				/*$(".seeinfomobile").click(function(){
					$(this).css("display","none");
					$(this).next().css("display","");
				});
			
				$(".con").eq(0).show();
				$(".protab li").click(function() {
					$(this).addClass('on').siblings().removeClass('on');
					var num = $(".protab li").index(this);
					$(".con").hide();
					$(".con").eq(num).show();
					Loacitontitle(num);
				})*/
				
				$(".screentext0").click(function() {
					PushScreenData($(this),0,false);
				})
				$(".screentext1").click(function() {
					PushScreenData($(this),1,false);
				})
				$(".screentext2").click(function() {
					PushScreenData($(this),2,false);
				})
				$(".screeninput0_1").change(function() {
					PushScreenData($(this),0,true,'万');
				})
				/*$(".screeninput0_2").change(function() {
					PushScreenData($(this),0,true,'个月');
				})*/
				$(".screeninput1_1").change(function() {
					PushScreenData($(this),1,true,'万');
				})
				$(".screeninput1_2").change(function() {
					PushScreenData($(this),1,true,'个月');
				})
			}			
			function PushScreenData(id,showid,isinput,text){
				var dresult = false,
					fresult = false,
					havelimit = false,
					unlimit = false,
					did = "",
					typeid = showid+1,
					nameid = id.data("nameid"),
					value = id.data("id");
				if(isinput){
					value=id.val();
				}
				
				var f = {};
				f.value = value;
				
				var d = {};
				d.nameid = nameid;
				d.field = [];
				d.field.push(f);
					
				ScreenData.typeid = typeid;
				
console.log(ScreenData);
				
				var ddata = ScreenData.datavalue;
				if(ddata.length>0){
					for(i=0;i<ddata.length;i++){
						if(ddata[i].nameid == nameid){
							dresult=true;
							did=i;
							/*
							var fdata = ddata[i].field;
							if(fdata.length>0){
								for(j=0;j<fdata.length;j++){
									if(fdata[j].value == 0){
										havelimit=true;
									}
									if(fdata[j].value == value){
										fresult=true;
									}
									if(value==0){
										unlimit=true;
									}
								}
							}*/
							
						}
					}
					//已存在同一类型
					if(dresult){
						
						//每类只能有一项
						ScreenData.datavalue[did].field = [];
						ScreenData.datavalue[did].field.push(f);
						ShowScreen(id,showid,isinput,text);
						ShowDataList();
						
						/*
						//不存在同一类型的不限
						if(!havelimit){
							//已存在同一类型、但不存在同一选项
							if(!fresult){
								//不限
								if(unlimit){
									ScreenData.datavalue[did].field = [];
									ScreenData.datavalue[did].field.push(f);
									ShowScreen(id,showid,isinput,text);
									ShowDataList();
								}else{
									ScreenData.datavalue[did].field.push(f);
									ShowScreen(id,showid,isinput,text);
									ShowDataList();
								}
							}
						}*/						
					}else{				
						ScreenData.datavalue.push(d);
						ShowScreen(id,showid,isinput,text);
						ShowDataList();
					}
				}else{			
					ScreenData.datavalue.push(d);
					ShowScreen(id,showid,isinput,text);
					ShowDataList();
				}
			}
			function deleteScreen(thisid,showid,typeid,nameid,value){
				if(thisid=="0"){
					$(".screentext"+showid).each(function(){
						$(this).removeClass("daikuanchanpin-color");
					});
					$(".chanpin-dd").remove();
					ScreenData.datavalue = [];		
					ShowDataList();
				}else{
					$(".screentext"+showid).each(function(){
						if($(this).data("nameid")==nameid && $(this).data("id")==value){
							$(this).removeClass("daikuanchanpin-color");
						}
					});
					$(thisid).remove();
					if($("#proindex"+showid).find(".screentext").length<=0){
						$(".chanpin-dd-1").remove();
					}
					
					var dresult = false,
						fresult = false,
						did = "";
						fid = "";
					var ddata = ScreenData.datavalue;
					if(ddata.length>0){
						for(i=0;i<ddata.length;i++){
							if(ddata[i].nameid == nameid){
								dresult=true;
								did=i;
								var fdata = ddata[i].field;
								if(fdata.length>0){
									for(j=0;j<fdata.length;j++){
										if(fdata[j].value == value){
											fresult=true;
											fid=j;
										}
									}
								}
								
							}
						}
						if(dresult){
							if(fresult){
								ScreenData.datavalue[did].field.splice(fid,1);
								ShowDataList();
							}
						}
					}
				}
			}
			
			function ShowScreen(id,showid,isinput,text,comid){
				var typeid = showid+1,
					nameid = id.data("nameid"),
					value = id.data("id");
				
				var showtext = id.data("text");
				
				$(".screentype"+nameid).remove();
				if(isinput){
					showtext = id.data("text")+id.val()+text;
					value=id.val();
					$(".daikuanchanpin-monery").val("");
				}else{
					/*if(value == 0){
						$(".screentype"+nameid).remove();
					}*/
					$(id).addClass("daikuanchanpin-color");
					$(id).siblings().removeClass("daikuanchanpin-color");
				}
				
				var strscreen = "<dd class='hoverpointer screentext chanpin-dd showcon-color screentype"+nameid+"' onclick='deleteScreen(this,"+showid+","+typeid+","+nameid+","+value+");'>";
				strscreen+= "<span>"+showtext+" </span><a>X</a></dd>";
				if($("#proindex"+showid).find(".chanpin-dd-1").length>0){
					$(".chanpin-dd-1").before(strscreen);
				}else{
					$("#proindex"+showid).append(strscreen);
					if($("#proindex"+showid).find(".chanpin-dd-1").length<=0){
						var strclear = "<dd class='chanpin-dd chanpin-dd-1'  onclick='deleteScreen(\"0\","+showid+");'><span class='hoverpointer'>清除所有选项</span></dd>";
						$("#proindex"+showid).append(strclear);
					}
				}
			}
			
			function ShowDataList(){
// console.log(ScreenData);

				url = "ajax.php?mode=SearchList";
				$.get(url,{
					data:JSON.stringify(ScreenData)
				},function(json,status){
					
				
				
				//url = "ajax.php?mode=SearchList";
				//url += "&typeid=" + typeid;
				//url += "&nameid=" + nameid;
				//url += "&value=" + value;
				//$.get(url,function(json,status){
				
				
					json=eval("("+json+")");
					var typeid = ScreenData.typeid;
console.log(json);
					switch(typeid){
						case 1:
							$("#showscreendata"+typeid).find('tr:first').nextAll().remove();
							if(json == null){
								var strdata = "<tr><td colspan='8'>暂无数据</td></tr>";
								$("#showscreendata"+typeid).append(strdata);
								return;
							}
							for(i=0;i<json.length;i++){
								var subarea="",isallowed,demandstate,mobile,
									Applytime = json[i].Applytime.slice(0,10),
									createtime = json[i].createtime.slice(0,10),
									otherdesc = json[i].otherdesc.slice(0,20),
									subareadata = json[i].subarea;
								if(subareadata == null){
									subarea = "无";
								}else{
									for(s=0;s<subareadata.length;s++){
										if(subareadata[s].name==null){
											subarea+="";
										}else if(s==(subareadata.length-1)){
											subarea+=subareadata[s].name;
										}else if(s==6){
											subarea+=subareadata[s].name+"...";
										}else{
											subarea+=subareadata[s].name+"、";
										}
									}
								}
								if(json[i].demandstate == 1){
									demandstate="需求中";
								}else{
									demandstate="已被一人接单";
								}
								/*
								if(json[i].producttype == null){
									producttype="";
								}else{
									producttype=json[i].producttype;
								}
								if(json[i].isallowed == 1){
									isallowed="已验证";
								}else{
									isallowed="未验证";
								}
								if(json[i].mobile == null){
									mobile="<span>暂无联系方式</span>";
								}else{
									mobile="<a href='###' class='seeinfomobile'>点击查看</a>";
									mobile+="<span style='display:none;'>"+json[i].mobile+"</span>";
								}*/
								
								var strdata = "<tr class='table-tr hoverpointer' onclick='LocationHref(\"smartyneed\","+json[i].id+",true,{$viewright})'>";
								strdata+= "<td>"+json[i].name+"</td><td>"+subarea+"</td><td>"+json[i].aptitude+"</td><td>"+json[i].demandnum+"万</td>";
								strdata+= "<td>"+demandstate+"</td><td>"+Applytime+"</td><td>"+otherdesc+"</td><td>"+createtime+"</td></tr>";
								$("#showscreendata"+typeid).append(strdata);
							}
							break;
						case 2:									
							$("#showscreendata"+typeid).find('tr:first').nextAll().remove();
							if(json == null){
								var strdata = "<tr><td colspan='9'>暂无数据</td></tr>";
								$("#showscreendata"+typeid).append(strdata);
								return;
							}
							for(i=0;i<json.length;i++){
								var subarea="",mobile,
									createtime = json[i].createtime.slice(0,10),
									subareadata = json[i].subarea;
								if(subareadata == null){
									subarea = "无";
								}else{
									for(s=0;s<subareadata.length;s++){
										if(subareadata[s].name==null){
											subarea+="";
										}else if(s==(subareadata.length-1)){
											subarea+=subareadata[s].name;
										}else if(s==6){
											subarea+=subareadata[s].name+"...";
										}else{
											subarea+=subareadata[s].name+"、";
										}
									}
								}
								/*
								if(json[i].mobile == null){
									mobile="<span>暂无联系方式</span>";
								}else{
									mobile="<a href='###' class='seeinfomobile'>点击查看</a>";
									mobile+="<span style='display:none;'>"+json[i].mobile+"</span>";
								}		
								*/
								var strdata = "<tr class='table-tr hoverpointer' onclick='LocationHref(\"smartyproductsdetails\","+json[i].id+",true,{$viewright})'>";
								strdata+= "<td>"+subarea+"</td><td>"+json[i].property+"</td><td>"+json[i].productname+"</td><td>"+json[i].paytype+"</td>";
								strdata+= "<td>"+json[i].worktime+"</td><td>"+json[i].paynum+"</td><td>"+createtime+"</td></tr>";
								$("#showscreendata"+typeid).append(strdata);
							}
							break;
						case 3:
							$("#showscreendata"+typeid+" ul li").remove();
							if(json == null){
								var strdata = "<li class='gray' style='text-align: center;'>暂无数据</li>";
								$("#showscreendata"+typeid+" ul").append(strdata);
								return;
							}
							for(i=0;i<json.length;i++){
								var subarea="",type,sex,
									goodproduct = json[i].goodproduct,
									personalfeature = json[i].personalfeature,
									subareadata = json[i].subarea;
								if(subareadata == null){
									subarea = "无";
								}else{
									for(s=0;s<subareadata.length;s++){
										if(subareadata[s].name==null){
											subarea+="";
										}else if(s==(subareadata.length-1)){
											subarea+=subareadata[s].name;
										}else if(s==6){
											subarea+=subareadata[s].name+"...";
										}else{
											subarea+=subareadata[s].name+"、";
										}
									}
								}
								
								if(goodproduct.length>18){
									goodproduct=goodproduct.slice(0,18)+"...";
								}
								
								if(personalfeature.length>18){
									personalfeature=personalfeature.slice(0,18)+"...";
								}
								
								if(json[i].type == 1){
									type="中介";
								}else{
									type="机构";
								}
								
								if(json[i].sex == 1){
									sex="男";
								}else{
									sex="女";
								}
											
								var strdata = "<li class='gray'><div class='liketext'><div class='liketextpic' onclick='LocationHref(\"smartyconsultantdetails\",{$s.id},true,{$viewright})'>";
								strdata+= "<img src='"+json[i].imgurl+"' alt='' class='infoheadstyle'/><p>"+json[i].name+"</p>";
								strdata+= "<i><img src='images/req_07.png' alt='' /></i></div><div class='liketextcont'>";
								strdata+= "<p>"+type+"<br>所在地区："+subarea+"<br>所在公司："+json[i].company+"<br>最新产品："+goodproduct+"<br>";
								strdata+= "个人资料 ："+sex+" / "+json[i].age+"岁<br>个人特点："+personalfeature+"</p></div></div><div class='liketel'>";
								strdata+= "<a class='hoverpointer' onclick='LocationHref(\"smartyconsultantdetails\","+json[i].id+",true,{$viewright})'>咨询</a></div></li>";
								$("#showscreendata"+typeid+" ul").append(strdata);
							}
							break;
					}
				});
			}
			
			function Loacitontitle(n){
				var n = parseInt(n);
				switch(n){
					case 0:
						loacitontitle = "贷款需求";
						break;
					case 1:
						loacitontitle = "贷款产品";
						break;
					case 2:
						loacitontitle = "贷款顾问";
						break;
				}
				$("#loacitontitle").text(loacitontitle);
			}
		</script>
	</body>

</html>