
		<!--主体部分-->
		<div class="contanier">
			<!--当前位置-->
			<div class="loaciton"><img src="images/location.png" alt="" />您当前的位置：
				<a class="hoverpointer" onclick="LocationHref('index')">首页</a> >
				<a class="hoverpointer" onclick="LocationHref('smartyproindex','1')">贷款产品</a> >
				<a href="">详情</a>
			</div>
			<div class="content clearfix">
				<div class="contleft">
					<!--需求详细页面-->
					<div class="needcont bgborder clearfix">
						<div class="needleft" style="width:350px;">
							<h2>{$supplyinfodetail.productname}</h2>
							<span style="color: #ff6700;">可贷金额: {$supplyinfodetail.paynum}万</span>
							<!--<p>{$supplyinfodetail.rate}</p>-->

						</div>
						<div class="needflow" style="width:120px;float:left;">
							<p onclick="FollowProducts({$viewright},{$supplyinfodetail.id},this)"><img id="followProducts_img" src="images/req_00.jpg" alt=""/><span>关注该产品</span></p>
						</div>
						<div class="needdetails">
							参考利率表
							{$supplyinfodetail.rate}
							<!--<table border="0" cellspacing="0" cellpadding="0">
								<tr>
									<th>贷款期限</th>
									<th>贷款额度</th>
									<th>月利率</th>
								</tr>
								<tr>
									<td rowspan="5">6个月/1年/
										<Br> 2年/3年/
										<Br> 4年/5年 </td>
									<td>10万以下</td>
									<td>1.35%</td>
								</tr>
								<tr>
									
									<td>10万(含)-20万</td>
									<td>1.3%</td>
								</tr>
								<tr>
									
									<td>20万(含)-30万</td>
									<td>1.25%</td>
								</tr>
								<tr>
									
									<td>30万(含)-40万</td>
									<td>1.2%</td>
								</tr>
								<tr>
									
									<td>40万(含)-50万</td>
									<td>1%</td>
								</tr>
							</table>-->

							<!--<img src="images/req_06.jpg" alt="" />
							<p>房产贷款</p>
							<div class="looktel"><a href="">查看联系方式</a></div>
							<a href="#">【举报此用户】</a>							-->
						</div>
						<div class="clearfix"></div>
						<div class="proneed clearfix">
							<div class="needtitle">
								<h3><span>申请条件</span></h3>
								<ul>
									<li>年龄要求 : {$supplyinfodetail.needage}</li>
									<li>身份要求 : 
										{counter start=0 skip=1 print=false}
										{foreach $supplyinfodetail.identity as $s}
											{$s.identity}
											{if {$s|@count} neq {counter}}
											、
											{/if}
										{foreachelse}
											无
										{/foreach}
									</li>
									<li>收入要求 : {$supplyinfodetail.income}</li>
									<li>工作年限 : {$supplyinfodetail.worktime}</li>
									<li>行业要求 : {$supplyinfodetail.needindustry}</li>
								</ul>
								<!--<div class="proright">
									<img src="images/email.jpg" alt="" />保存此内容到我的邮箱
								</div>-->
							</div>
							<div class="needtitle">
								<h3><span>产品特点</span></h3>
								<ul>
									<li>{$supplyinfodetail.Featuresintroduce}</li>
								</ul>
								<div class="proright">
									<img src="images/t2.jpg" alt="" />{$footerfixed.telephone}
								</div>
							</div>
						</div>
					</div>
					{if {$supplyinfodetail.allowreply} eq 1}
						<div class="needcont bgborder" style="padding:20px;border-top:0px;">
							<textarea id="input_comment" style="height:23px;width:99%;margin-bottom: 5px;padding: 5px 2px 5px 6px;word-wrap: break-word; line-height: 18px;border:1px #cccccc solid;box-shadow: 0px 0px 3px 0px rgba(0,0,0,0.15) inset;overflow: hidden;border-radius: 4px;-moz-border-radius: 4px;-webkit-border-radius: 4px;position: relative;z-index:500;behavior: url(style/PIE.htc);"></textarea>
							<p style="text-align:right;padding:0;">
								<button id="submit_comment" style="height:30px;width:60px;color: #fff;background-color: #67bcd8;cursor: pointer; border: 0;border-radius: 4px;-moz-border-radius: 4px;-webkit-border-radius: 4px;position: relative;z-index:500;behavior: url(style/PIE.htc);">留言</button>
							</p>
							
							<div id="All_comment" style="border-top: 1px #cccccc solid;margin: 10px 0;">
							</div>
						</div>
					{else}
					{/if}
				</div>
				<div class="contright">
					<!--推荐顾问-->
					<div class="rjgwwrap bgborder">
						<div class='div4-4'>
							<div class='div3-6'>
							</div>
							<span class='span3-5'>相关顾问</span>
						</div>
						<div class="rjgwtext clearfix">
							<div class="rjgwpic hoverpointer">
								<img src="{$supplierdetail.imgurl}" alt="" class="infoheadright" onclick="LocationHref('smartyconsultantdetails',{$supplierdetail.id},true,{$viewright})"/>
								<p onclick="FollowSupply({$viewright},{$supplierdetail.id},this)"><img id="followSupply_img" src="images/req_00.jpg" alt=""/><span>关注该顾问</span></p>
							</div>
							<div class="rjgwtex hoverpointer">
								<p onclick="CollectSupplier({$viewright},{$supplierdetail.id},this)"><img id="CollectSupplier_img" src="images/scgw_00.jpg" alt=""/><span style="vertical-align: middle;"> 收藏该顾问</span></p>
								<div onclick="LocationHref('smartyconsultantdetails',{$supplierdetail.id},true,{$viewright})">
									姓名：{$supplierdetail.name}<br> 
									实名认证：{if {$supplierdetail.isallowed} eq 1}已认证{else}未认证{/if}<br>
									<!--推荐指数：
										{if {$supplierdetail.recommendindex} > 5}
											<img src="images/start5.jpg" alt="" />
										{elseif {$supplierdetail.recommendindex} eq ""}
											<img src="images/start0.jpg" alt="" />
										{else}
											<img src="images/start{$supplierdetail.recommendindex}.jpg" alt="" />
										{/if}<br>-->
									业务地区：
										{counter start=0 skip=1 print=false}
										{$length={$supplierdetail.subarea|@count}}
										{foreach $supplierdetail.subarea as $s}
											{if $length eq {counter}}
												{$s.name}
											{else}
												{$s.name}、
											{/if}
										{foreachelse}
											无
										{/foreach}
										<br>
									所属公司：{$supplierdetail.company}<br> 
									个人特色：{$supplierdetail.personalfeature}
								</div>
							</div>
						</div>
						<div class="rjgwtel">
							<span><img src="images/req_01.jpg" alt="" /></span>
							<p class="suppliermobile">{$supplierdetail.mobile|truncate:3:"":true}********</p>
							<a class="seesuppliermobile hoverpointer">点击查看</a>
						</div>
					</div>
					<div class="rightpic">
						<img src="images/new_17.png" alt="" width="325px" height="197px" />
					</div>
				</div>
				<div class="clearfix"></div>
				<div class='table1-1 tablewidth'>
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
						
						<!--<tr class='table-tr'>
							<td>深圳</td>
							<td>有房,有车,企业主</td>
							<td>中国银行-现代派</td>
							<td>等额本息</td>
							<td>5-10年</td>
							<td>50-500W</td>
							<td>约7成</td>
							<td>
								<font>点击查看</font><br>
								<span>13333333333</span>
							</td>
							<td>2017-5-7</td>
						</tr>-->
					</table>
					<!--<div id="kkpager"></div>-->
				</div>
				<!--<div class="page clearfix">
					<ul>
						<li>总共7条记录</li>
						<li class="prev">
							<a href="#">上一页</a>
						</li>
						<li class="active">
							<a href="#">1</a>
						</li>
						<li>
							<a href="#">2</a>
						</li>
						<li class="next">
							<a href="#">下一页</a>
						</li>
					</ul>
				</div>-->
			</div>
	<script type="text/javascript">
		console.log({json_encode($supplierdetail)});
		console.log({json_encode($supplyinfolist)});
		console.log({json_encode($supplyinfodetail)});
		console.log({json_encode($viewright)});
		window.onload = OnLoad;
		function OnLoad(){
			BindEvents();
			//function Showinfotable(1);
			Showcomment();
			IsFollowSupply({$supplierdetail.id},{$viewright});
			IsFollowProducts({$supplyinfodetail.id},{$viewright});
			IsCollectSupplier({$supplierdetail.id},{$viewright});
			ShowTitlecon("{$supplyinfodetail.productname}");
		}
		function BindEvents(){
			$(".seesuppliermobile").click(function(){
				Common_MobileView({$viewright},1,"ajax.php?mode=SupplierdetailView&supplierid={$supplierdetail.id}",function(){
					$(".suppliermobile").text({$supplierdetail.mobile});
				},false,"",true)
			});
			// $(".seeinfomobile").click(function(){
				// $(this).css("display","none");
				// $(this).next().css("display","");
			// });
			$("#submit_comment").click(function(){
				Submitcomment();
			});
		}
		function Showinfotable(page){
			$("#kkpager").html("");
			url = "ajax.php?mode=mode&type=type&currentpage="+page;
			$.get(url,function(json,status){
				if(json=="null"){
					CommonJustTip('暂无数据。');
					return;
				}
				json = eval("("+json+")");
				console.log(json);
				for(var i=0;i<json.length;i++){
					
					strTbody = '<tr id="'+Settings.ListName+''+(i+1)+'"><td>'+(i+1)+'</td><td><img style="width:50px;height:50px;" src="'+json[i].imgurl+'"></td><td>'+json[i].nickname+'</td></td><td>'+json[i].name+'</td><td>'+json[i].mobile+'</td><td>'+json[i].area+'</td><td>'+json[i].school+'</td>';
					strTbody = '<tr id="'+Settings.ListName+''+(i+1)+'"><td>'+(i+1)+'</td><td><img style="width:50px;height:50px;" src="'+json[i].imgurl+'"></td><td>'+json[i].nickname+'</td></td><td>'+json[i].name+'</td><td>'+json[i].mobile+'</td><td>'+json[i].school+'</td>';
					strTbody += strTbodyBtn;
					$("#contentTbody").append(strTbody);
				}
				kkpager.generPageHtml({
					pno : page,
					total : json[0].pagecount,
					totalRecords : json[0].total,
					mode : 'click',//默认值是link，可选link或者click
					click : function(n){
						ShowSaleList(Settings.ListType,n);
						return false;
					}
				} , true);
			});
		}
		function Showcomment(){
			$("#All_comment").html("");
			url= "ajax.php?mode=supplyinforeplylist&supplyinfoid={$supplyinfodetail.id}";
			$.get(url,function(json,status){
				if(json==""||json=="null"){
					return;
				}
				json = eval("(" +json+ ")")
console.log(json);
				for(var i=0;i<json.length;i++){
					var strcomment = "<div class='con_comment' style='margin:10px;'><span style='color:#67bcd8;'>"+json[i].username+"</span>&nbsp;：<span>";
					strcomment+= ""+json[i].content+"</span><span style='display:block;color:#808080;font-size:12px;'>"+json[i].createtime+"</span></div>";
					$("#All_comment").append(strcomment);
				}
			});	
		}
		function Submitcomment(){
			var replytext = $("#input_comment").val();
			if(replytext==""){
				CommonJustTip("留言内容不能为空！","提示");
				return;
			}
			Common_MobileView({$viewright},1,"ajax.php?mode=supplyinforeply&supplyinfoid={$supplyinfodetail.id}&replytext="+replytext,function(){
				$("#input_comment").val("");
				Showcomment();
			},false,"留言")
		}
   </script>
   </body>
</html>