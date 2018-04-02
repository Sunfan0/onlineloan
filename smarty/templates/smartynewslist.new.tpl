
		<!--主体部分-->
		<div class="contanier">
			<!--当前位置-->
			<div class="loaciton"><img src="images/location.png" alt="" />您当前的位置：
				<a class="hoverpointer" onclick="LocationHref('index')">首页</a> >
				<a href="#">信贷资讯</a>
			</div>
			<div class="content clearfix" style="margin-bottom: 20px;">
				<div class="contleft">
					<!--<div class="sideout"></div>-->
					<div class="newstabcont">
						<div class="newstablist clear">
							<ul>
								{counter start=0 skip=1 print=false}
								{foreach $arrNewsList as $a}
									<li id="newlistmenu{$a.id}"><a href="smartynewslist.new.php?newlistid={$a.id}">{$a.name}</a></li>
									{*
									{if {counter} eq 1}
										<li class="on"><a href="javascript:void(0);">{$a.name}</a></li>
									{else}
										<li><a href="javascript:void(0);">{$a.name}</a></li>
									{/if}
									*}
								{/foreach}
							</ul>
						</div>
						
						{counter start=0 skip=1 print=false}
						{foreach $arrNewsList as $a}
							<div id="newlistcon{$a.id}" class="newstab con">
								<div class="newshottop">
									<ul>
									
									{counter start=0 skip=1 print=false}
									{foreach $a.news as $n}
										{$no = {counter}}
										{if $no eq 1}
											<li class="hoverpointer" onclick="LocationHref('smartynews',{$n.id},true,{$viewright})">
												<div class="left"><img src="{$n.image}" width="207px" height="138px"/></div>
												<div class="newspictitle">
													<h2><a href="#">{$n.title}</a></h2>
													<div class="newsintro" style="font-size: 12px;line-height: 24px;">{$n.content}</div>
													<div><span>{$n.createtime|truncate:10:"":true}</span>
													<!--<span>2个小时前发布</span><em><img src="images/zan.jpg" alt="" /><img src="images/xin.jpg" alt="" /></em>-->
													</div>
												</div>
											</li>
										{elseif $no eq 2}
											<li class="hoverpointer" onclick="LocationHref('smartynews',{$n.id},true,{$viewright})">
												<div class="left"><img src="{$n.image}" width="207px" height="138px"/></div>
												<div class="newspictitle">
													<h2><a href="#">{$n.title}</a></h2>
													<div class="newsintro" style="font-size: 12px;line-height: 24px;">{$n.content}</div>
													<div><span>{$n.createtime|truncate:10:"":true}</span>
													<!--<span>2个小时前发布</span><em><img src="images/zan.jpg" alt="" /><img src="images/xin.jpg" alt="" /></em>-->
													</div>
												</div>
											</li>
									</ul>
								</div>
								<div class="newslist">
									<ul>
										{else}
											<li class="hoverpointer" onclick="LocationHref('smartynews',{$n.id},true,{$viewright})"><a href="#">{$n.title}</a><span>{$n.createtime|truncate:10:"":true}</span></li>
										{/if}
									{/foreach}
									</ul>
								</div>
								<div id="kkpager{$a.id}" class="kkpager"></div>
							</div>
						{/foreach}
					</div>
				</div>
				<!--右侧的部分-->
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
					<!--需求信息-->
					<div class='daikuanguwen-3-right'>
						<div class='div4-4'>
							<div class='div3-6'>
							</div>
							<span class='span3-5'>需求信息</span>
						</div>
						<div class="box">
							<ul class="table_top">
								<li class="w_name w_name1">姓名</li>
								<!--<li class="w_shcool">身份</li>-->
								<li class="w_xueli w_name1">申请额度</li>
								<li class="w_jzgs w_name1">抵押物</li>
							</ul>
							<!-- 代码开始 -->
							<div class="list_lh">
								<ul>
									{counter start=0 skip=1 print=false}
									{foreach $demandinfolist as $d}
										<li class="hoverpointer" onclick="LocationHref('smartyneed',{$d.id},true,{$viewright})">
											<span class="w_name">{$d.name}</span>
											<!--<span class="w_shcool">调整中</span>-->
											<span class="w_xueli">{$d.demandnum}</span>
											<span class="w_jzgs">
												{if $d.aptitude eq "1"}
													车
												{elseif $d.aptitude eq "2"}
													房
												{elseif $d.aptitude eq "3"}
													车、房
												{else}
													？？？？？
												{/if}
											</span>
										</li>
									{/foreach}
								</ul>
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
					<div class="rightpic">
						<img src="images/new_17.png" alt="" width="325px" height="197px" />
					</div>
				</div>
			</div>
		</div>
		<!--主体部分 end-->
		<!--文字滚动-->
		<script type="text/javascript">
			$(function() {
				$("div.list_lh").myScroll({
					speed: 40, //数值越大，速度越慢
					rowHeight: 37 //li的高度
				});
			});
			
			console.log({json_encode($arrNewsList)});
			console.log({json_encode($demandinfolist)});
			console.log({json_encode($newslist)});
			
			/*
			var currentpage = location.href.split("currentpage=")[1]; 
			if(currentpage==undefined || currentpage==""){
				currentpage=1;
			}
			var newlistid = location.href.split("newlistid=")[1]; 
			if(newlistid==undefined || newlistid==""){
				newlistid=0;
			}else{
				newlistid=newlistid.substr(0,1);
			}
			*/
			
			
			function GetQueryString(name){
				 var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
				 var r = window.location.search.substr(1).match(reg);
				 if(r!=null)return  unescape(r[2]); return null;
			}
			var currentpage = GetQueryString("currentpage");
			var newlistid = GetQueryString("newlistid");
			if(currentpage==null){
				currentpage=1;
			}
			if(newlistid==null){
				newlistid=0;
			}
// console.log("currentpage",currentpage);
// console.log("newlistid",newlistid);
			$("#newlistmenu"+newlistid).addClass("on");
			$("#newlistcon"+newlistid).show();
			
			
			
			window.onload = OnLoad;

			function OnLoad(){
				BindEvents();
				ShowTitlecon();
				
				for(var i=0;i<{$arrNewsList|@count};i++){
					Showkkpager({json_encode($arrNewsList)}[i].id);
				}
			}
			function BindEvents(){
				$(".newsintro").each(function(){
					var strtest = $(this).text();
					if(strtest.length>107){
						strtest=strtest.slice(0,107);
						var stra = "<a href='#' style='font-size: 12px;color: #f00;padding-left:10px;'>详情……</a>";
						$(this).text(strtest);
						$(this).append(stra);
					}
				});
				/*
				$(".con").eq(0).show();
				$(".newstablist li").click(function() {
					$(this).addClass('on').siblings().removeClass('on');
					var num = $(".newstablist li").index(this);
					$(".con").hide();
					$(".con").eq(num).show();
				})
				*/
			}
			function Showkkpager(id){
				for(var i=0;i<{$arrNewsList|@count};i++){
					if({json_encode($arrNewsList)}[i].id == id){
						kkpager.generPageHtml({
							pagerid : "kkpager"+id,
							pno : currentpage,
							total : {json_encode($arrNewsList)}[i].pagecount,
							totalRecords : {json_encode($arrNewsList)}[i].perpage,
							mode : 'click',//默认值是link，可选link或者click
							click : function(n){
								window.location.href="smartynewslist.new.php?newlistid="+newlistid+"&currentpage="+n;
								return false;
							}
						} , true);
					}
				}
			}
		</script>
	</body>
</html>