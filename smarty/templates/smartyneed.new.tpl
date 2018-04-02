
		<!--主体部分-->
		<div class="contanier">
			<!--当前位置-->
			<div class="loaciton"><img src="images/location.png" alt="" />您当前的位置：
				<a class="hoverpointer" onclick="LocationHref('index')">首页</a> >
				<a class="hoverpointer" onclick="LocationHref('smartyproindex','0')">贷款需求</a> >
				<a href="">详情</a>
			</div>
			<div class="content clearfix" style='margin-bottom: 20px;'>
				<div class="contleft">
					<!--需求详细页面-->
					<div class="needcont bgborder clearfix">
						<div class="needleft">
							<h2>用户{$needinfordetail.name}申请贷款{$needinfordetail.demandnum}万元</h2>
							<span>（此用户已被浏览器{$needinfordetail.visitcount}次）</span>
							<div class="needtitle">
								<h3><span>基本信息</span></h3>
								<p style="width:220px;">姓名：{$needinfordetail.name}</p>
								<p style="width:260px;">所在地区：
									{$subarea=""}
									{counter start=0 skip=1 print=false}
									{$length={$needinfordetail.subarea|@count}}
									{foreach $needinfordetail.subarea as $a}
										{if $length eq {counter}}
											{$subarea=$subarea|cat:$a.name}
										{else}
											{$subarea=$subarea|cat:$a.name|cat:'、'}
										{/if}
									{foreachelse}
										无
									{/foreach}
									{$subarea|truncate:21:"...":true}
								</p>
							</div>							
							<div class="needtitle">
								<h3><span>基本信息</span></h3>
								<p style="width:220px;">货款金额：{$needinfordetail.demandnum}万</p>
								<p style="width:260px;">用户资质：{$needinfordetail.aptitude}
									{if {$needinfordetail.aptitude} neq "" && {$needinfordetail.aptitude} neq "无"}
										{if {$needinfordetail.aptitudeimg} eq ""}
											<span>(无资质图片)</span>
										{else}
											<span id="seeaptitudeimg" data-img="{$needinfordetail.aptitudeimg}">(查看资质图片)</span>
										{/if}
									{else}
										
									{/if}
								</p>
								<br>
								<p style="width:220px;">货款类型：{$needinfordetail.producttype} </p>
								<p style="width:260px;">发布需求：{$needinfordetail.Applytime|truncate:10:"":true}</p><br>
								<p style="width:220px;">审核状态：
									{if {$needinfordetail.isallowed} eq 1}
										已验证
									{else}
										未验证
									{/if}
								</p>
								<p style="width:260px;">需求状态：
									{if {$needinfordetail.demandstate} eq 1}
										需求中
									{else}
										已被一人接单
									{/if}
								</p>
							</div>
							<em>特殊需求：{$needinfordetail.otherdesc}</em>
						</div>
						<div class="needright">
							<img src="images/req_06.jpg" alt="" />
							<p>房产贷款</p>
							<div class="looktel">
							{if {$needinfordetail.mobile} eq ""}
								<a href="">暂无联系方式</a>
							{else}
								{if {$showmobile} eq 1}
									<a>{$needinfordetail.mobile}</a>
								{else}
									<a id="showneedmobile" href="">查看联系方式</a>
								{/if}
							{/if}
							</div>
							<a onclick="ReportDemander();" href="#">【举报此用户】</a>
						</div>
					</div>
					<!--类似需求-->
					<div class='table1-1'>
						<div class='div4-4'>
							<div class='div3-6'>
							</div>
							<span class='span3-5'>类似需求</span>
						</div>
						<table cellspacing="0px" cellpadding="0px">
							<tr>
								<th>姓名</th>
								<th>地区</th>
								<!--<th>用户资质</th>-->
								<th>货款金额</th>
								<th>状态</th>
								<th>申请时间</th>
								<th>特别需求</th>
								<th>更新时间</th>
								<!--<th>联系方式</th>-->
							</tr>
							{counter start=0 skip=1 print=false}
							{foreach $otherneedinfo as $o}
								<tr class='table-tr hoverpointer' onclick="LocationHref('smartyneed',{$o.id},true,{$viewright})">
									<td>{$o.name}</td>
									<td>
										{$subarea=""}
										{counter start=0 skip=1 print=false}
										{$length={$o.subarea|@count}}
										{foreach $o.subarea as $a}
											{if $length eq {counter}}
												{$subarea=$subarea|cat:$a.name}
											{else}
												{$subarea=$subarea|cat:$a.name|cat:'、'}
											{/if}
										{foreachelse}
											无
										{/foreach}
										{$subarea|truncate:21:"...":true}
									</td>
									<!--<td>{$o.aptitude}</td>-->
									<td>{$o.demandnum}万</td>
									<td>
										{if {$o.demandstate} eq 1}
											需求中
										{else}
											已被一人接单
										{/if}
									</td>
									<td>{$o.Applytime|truncate:10:"":true}</td>
									<td>{$o.otherdesc|truncate:20:"":true}</td>
									<td>{$o.createtime|truncate:10:"":true}</td>
									<!--<td>
										{if {$o.mobile} eq ""}
											<span>暂无联系方式</span>
										{else}
											<a href="###" class="seeinfomobile">点击查看</a>
											<span style="display:none;">{$o.mobile}</span>
										{/if}
									</td>-->
								</tr>
							{foreachelse}
							{/foreach}
						</table>
					</div>
				</div>
				
				<div class="contright">
					<!--推荐顾问-->
					<div class="rjgwwrap bgborder">
						<div class='div4-4'>
							<div class='div3-6'>
							</div>
							<span class='span3-5'>推荐顾问</span>
						</div>
						<div class="rjgwtext clearfix">
							<div class="rjgwpic hoverpointer">
								<img src="{$supplierdetail.imgurl}" alt="" class="infoheadright"  onclick="LocationHref('smartyconsultantdetails',{$supplierdetail.id},true,{$viewright})"/>
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
		<style>
			#seeaptitudeimg:hover{
				color:#ff6700;
				text-decoration: underline;
				cursor: pointer;
			}
		</style>
		<script>			
			console.log({json_encode($needinfordetail)});
			console.log({json_encode($supplierdetail)});
			console.log({json_encode($otherneedinfo)});
			console.log({json_encode($showmobile)});
			console.log({json_encode($viewright)});

			window.onload = OnLoad;
			function OnLoad(){
				BindEvents();
				IsFollowSupply({$supplierdetail.id},{$viewright});
				IsCollectSupplier({$supplierdetail.id},{$viewright});
				ShowTitlecon("用户{$needinfordetail.name}申请贷款{$needinfordetail.demandnum}万元");
			}
			function BindEvents(){
				$(".seesuppliermobile").click(function(){
					Common_MobileView({$viewright},1,"ajax.php?mode=SupplierdetailView&supplierid={$supplierdetail.id}",function(){
						$(".suppliermobile").text({$supplierdetail.mobile});
					},false,"",true)
				});
				
				/*$(".seeinfomobile").click(function(){
					$(this).css("display","none");
					$(this).next().css("display","");
				});*/
				
				$("#showneedmobile").click(function(){					
					Common_MobileView({$viewright},2,"ajax.php?mode=CheckMaxvisibleNum&demandinfoid={$needinfordetail.id}",function(){
						$("#showneedmobile").text({$needinfordetail.mobile});
					},true)
					return false;
				}); 
				$("#seeaptitudeimg").click(function(){
					var imgsrc = $(this).data("img");
					var strimg = "<img src='"+imgsrc+"' alt=''/>";
					CommonJustTip(strimg);
				});
			}
			function ReportDemander(){
				if({$viewright}==2){
					url= "ajax.php?mode=IsReportDemander&demandinfoid="+{$needinfordetail.id};
					$.get(url,function(json,status){
						switch(json){
							case "-1":
								url="ajax.php?mode=ReportDemander&demandinfoid={$needinfordetail.id}";
								$.get(url,function(json,status){
									switch(json){
										case "1":
											CommonJustTip("举报成功！","提示");
											break;
										default:
											CommonJustTip("服务器忙，请稍候再试。","提示");
									}
								});
								break;
							case "-9":
								CommonJustTip("您未查看过该用户的联系方式，无举报权限！","提示");
								break;
							case "1":
								CommonJustTip("您已经举报过该用户，不能重复举报！","提示");
								break;
							default:
								CommonJustTip("服务器忙，请稍候再试。","提示");
						}
					});	
				}else{
					CommonJustTip("只有供方可以举报，请先登录!","提示");
				}
			}
		</script>
	</body>
</html>