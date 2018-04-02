<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Author" content="">
    <title>中国贷款信息网</title>
	<link rel="stylesheet" type="text/css" href="style/stylenew.v2.css" />
	<link href="js/craftpip/css/jquery-confirm.css" rel="stylesheet"/>
	<style>
		.logintype{
			font-size: 16px;
			display: block;
			margin: 10px 0;
		}
		.logintype:hover {
			color:#63b5d0;
		}
		
		.hoverpointer{
			transition:all .3s linear 0s;
		}
		.daikuanguwen-3-left .hoverpointer:hover .daikuanguwen-lx{
			transition:all .3s linear 0s;
		}
		.hovercolor:hover {
			background-color:#63b5d0;
			color:white;
			border: 1px solid #24a4cd;
		}
		.div-table2 .hoverpointer:hover,
		.daikuanguwen-3-left .hoverpointer:hover{
			background-color:rgba(103, 188, 216, 0.3);		
		}
		.daikuanguwen-3-left .hoverpointer:hover .daikuanguwen-lx{
			border: 0px;
			background: rgba(255, 103, 0, 0.7);
			color: white;			
		}
		.daikuanguwen-3-right .hoverpointer:hover span{
			color:#63b5d0;
			font-size:16px;
		}
		.xindaidaixun-left .hoverpointer:hover,
		.xindaidaixun-left .newsintro:hover *,
		.xindaidaixun-left .hoverpointer:hover b,
		.footer .hoverpointer:hover{
			color:#63b5d0 !important;
		}
		.xindaidaixun-right .hoverpointer:hover span{
			 font-size: 16px;
		}
		.hezuojigou img:hover{
			border: 1px solid #63b5d0;
			box-shadow: 1px 1px 2px #66bdd7;
		}
		.header_login:hover{
			text-decoration: underline;
		}
	</style>
    <!-- 引入JQuery的官方类库 -->
    <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/craftpip/js/jquery-confirm.js"></script>
	<script type="text/javascript" src="js/scroll.js"></script>
	<!--<script type="text/javascript" src="js/tab.js"></script>-->
	<script type="text/javascript" src="js/gVerify.js"></script>
	<script type="text/javascript">
		$(function() {
			$("div.list_lh").myScroll({
				speed: 40, //数值越大，速度越慢
				rowHeight: 37 //li的高度
			});
		});
		
		function GoLogin(operate){
			/*var logintext1 = "需方登录";
			var logintext2 = "供方登录";
			var logintitle = "请选择登录身份：";
			if(isregister==1){
				logintext1 = "需方注册";
				logintext2 = "供方注册";
				logintitle = "请选择注册身份：";
			}
			var strtype = '<a class="logintype" href="demand.login.php?isregister='+isregister+'">'+logintext1+' »</a>';
			strtype+= '<a class="logintype" href="supply.login.php?isregister='+isregister+'">'+logintext2+' »</a>';
			CommonJustTip(strtype,logintitle);*/
			window.location.href = "login.php?operate="+operate;
		}
		function DropLogin(){
			url = "ajax.php?mode=DropLogin";
			$.get(url,function(json,status){
				window.location.reload();
			})
		}
		function GoAdminpage(type){
			url = "ajax.php?mode=DropPageurl";
			$.get(url,function(json,status){
				switch(type){
					case 0:
						GoLogin(0);
						break;
					case 1:
						window.location.href = "demand.infolist.php";
						break;
					case 2:
						window.location.href='supply.infolist.php';
						break;
				}
			})
		}
	</script>
</head>
<body>
		<!--这是最大的框-->
		<div id="daikuan">
			<!--这是头部-->
			<div id='header'>
				<!--这是头部的上面部分-->
				<div class="header-top">
					<div class='header-top-1'>
						<span id="current_city" class='span1-1 span1-5'></span>
						{if {$viewright} eq 0 }
							<span class='span1-2 span1-5 hoverpointer header_login' onclick="GoLogin(0);">Hi,请登录</span>
							<span class='span1-5 hoverpointer header_login' style="color: #ff2e31;margin-left: 10px;" onclick="GoLogin(1);">注册</span>
						{else}
							<span class='span1-2 span1-5 hoverpointer'>Hi,{$showname}</span>
							<span class='span1-5 hoverpointer header_login' style="margin-left: 10px;" onclick="DropLogin();">退出登录</span>
						{/if}
						<!--<span class='span1-3 span1-5 hoverpointer'><img src="images/01_05.jpg" alt="" /> 微信</span>&nbsp;<span class='span1-6'></span>&nbsp;
						<span class='span1-4 span1-5 hoverpointer'><img src="images/01_07.jpg" alt="" /> 微博</span>-->
					</div>
					
				</div>
			</div>
			<div class="headerbg">
				<div class="header-bottom">
					<div class='header-bottom-left'>
						<img src="images/01_13.jpg" alt="" />
						<i class='i1'>
							<img src="images/tel.png" alt="" class='img-1'/>
							&nbsp;<span class='span2-1'>{$footerfixed.telephone}</span>
						</i>
					</div>
					<div class='header-bottom-right'>
						<ul class='ul1'>
							<li>
								<a onclick="LocationHref('index')">首页</a>
							</li>
							<li>
								<a onclick="LocationHref('smartyproindex','0')">找客户</a>
							</li>
							<li>
								<a onclick="LocationHref('smartyproindex','1')">找产品</a>
							</li>
							<li>
								<a onclick="LocationHref('smartyproindex','2')">找顾问</a>
							</li>
							<li>
								<a onclick="LocationHref('smartynewslist')">贷款资讯</a>
							</li>
							<li>
								{if {$viewright} eq "0"}
									<a onclick="GoAdminpage(0);">我的账户</a>
								{else}
									<a onclick="GoAdminpage({$ismodify});">我的账户</a>
								{/if}
							</li>
						</ul>
					</div>
				</div>
			</div>
			
			<!--这是主体-->
			<div id='bodyer'>
				<div class="header-top-2">
					<ul>
						<li class="hoverpointer citylist hovercolor" onclick='showupdate(0)'>全国</li>
						{foreach $subarealist as $s}
							<li class="hoverpointer citylist hovercolor" onclick='showupdate({$s.id})'>{$s.name}</li>
						{foreachelse}
							<p>暂无数据</p>
						{/foreach}
					</ul>
				</div>
				<!--这是图片-->
				<div class='img2-3'>
					<div class='img2-form'>
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
				<!-- 这是产品介绍 -->
				<div class='div-table2'>
					<table class='table2-2' cellspacing="0" cellpadding="0">
						<tr class='div2-1'>
							<th class='span2-3'>产品名称</th>
							<th class='span2-3'>特点</th>
							<th class='span2-3 span2-2'>贷款额度</th>
							<th class='span2-3'>还款方式</th>
							<th class='span2-3 span2-2'>放款时限</th>
						</tr>
						{foreach $supplyinfolist as $s}
							<tr class="hoverpointer" onclick="LocationHref('smartyproductsdetails',{$s.id},true)">
								<td class='td1' style="padding-left: 100px;text-align: left;">{$s.productname}</td>
								<td>{$s.Featuresintroduce}</td>
								<td>{$s.paynum}</td>
								<td>{$s.paytypename}</td>
								<td>{$s.lendtime}</td>
							</tr>
						{foreachelse}
							<p>暂无数据</p>
						{/foreach}
					</table>
					<div class='div2-2'>
						<div class='div2-3'>
						</div>
						<p class='span2-4'>热门贷款产品</p>
					</div>
				</div>

				<div class='daikuanguwen-3'>
					<div class='daikuanguwen-3-left'>
						{counter start=0 skip=1 print=false}
						{foreach $supplierlist as $s}
							{if {counter} > 4}
							
							{else}
								<div class='daikuanguwen-left-1 hoverpointer' onclick="LocationHref('smartyconsultantdetails',{$s.id},true)">
									<img src="{$s.imgurl}" class='daikuanguwen-img'/>
									<span>{$s.name}</span>
									<p style="height:120px;overflow: hidden;">
										{$s.company} <br> 特点 {$s.personalfeature|truncate:12:"":true}<br> 最新产品 ：<i>{$s.goodproduct|truncate:24:"...":true}</i>
									</p>
									<div class='daikuanguwen-lx'>点击查看联系方式</div>
								</div>
							{/if}
						{foreachelse}
							<p>暂无数据</p>
						{/foreach}
						<div class='div3-3'>
							<div class='div3-4'></div>
							<span class='span3-5'>贷款顾问</span>
						</div>
					</div>

					<div class='daikuanguwen-3-right'>
						<div class="box">
							<ul class="table_top">
								<li class="w_name w_name1">姓名</li>
								<li class="w_shcool">身份</li>
								<li class="w_xueli w_name1">申请额度</li>
								<li class="w_jzgs">抵押物</li>
							</ul>
							<!-- 代码开始 -->
							<div class="list_lh">
								<ul>
									{counter start=0 skip=1 print=false}
									{foreach $demandinfolist as $d}
										<li class="hoverpointer" onclick="LocationHref('smartyneed',{$d.id},true)">
											<span class="w_name">{$d.name}</span>
											<span class="w_shcool">调整中</span>
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
						<div class='div4-4'>
							<div class='div3-6'>
							</div>
							<span class='span3-5'>需求信息</span>
						</div>
					</div>
				</div>
				<div class='xindaidaixun'>
					<!--左侧的部分-->
					<div class='xindaidaixun-left'>
						<div class='xindaidaixun-right-top-1'>
							<div class='div3-7'></div>
							<span class='span3-5'>常用工具</span>
						</div>

						<div class='xindaidaixun-1-1'>
							<img src="images/pic.jpg" alt="" />
						</div>
						<div class='xindaidaixun-1-2'>
							<ol id="tab">
								{counter start=0 skip=1 print=false}
								{foreach $arrNewsList as $n}
									{if {counter} eq 1}
										<li class="newsTitle fli" data-newstypeid="{$n.id}"><a href="###">{$n.name}</a></li>
									{else}
										<li class="newsTitle" data-newstypeid="{$n.id}"><a href="###">{$n.name}</a></li>
									{/if}
								{/foreach}
							</ol>
							<div id="tab_con" class="newsListContainer">
								{counter start=0 skip=1 print=false}
								{foreach $arrNewsList as $n}
									{if {counter} eq 1}
										<div class="fdiv" data-newstypeid="{$n.id}">
									{else}
										<div class="fdiv" data-newstypeid="{$n.id}" style="display:none;">
									{/if}
									<p class='fdiv-1 hoverpointer' onclick="LocationHref('smartynews',{$n.list.id},true)"><b>{$n.list.title}</b></p>
									<div class="newsintro hoverpointer" style="height:65px;color:#999999;font-size: 14px;overflow:hidden;display: block;" onclick="LocationHref('smartynews',{$n.list.id},true)">{$n.list.content}</div>
									{*<font>{$n.list.content|truncate:107:"":true}</font>*}
										{counter start=0 skip=1 print=false}
										{foreach $n.news as $w}
											{$no={counter}}
											{if $no < 11}
												{if $no eq 1}
													<ul class='ul-1'><li class="hoverpointer" onclick="LocationHref('smartynews',{$w.id},true)">{$w.title|truncate:18:"...":true}</li>
												{elseif $no eq 6}
													<ul class='ul-2'><li class="hoverpointer" onclick="LocationHref('smartynews',{$w.id},true)">{$w.title|truncate:18:"...":true}</li>
												{elseif $no eq 5 || $no eq 10}
													<li class='hoverpointer' onclick="LocationHref('smartynews',{$w.id},true)">{$w.title|truncate:18:"...":true}</li></ul>
												{else}
													<li class="hoverpointer" onclick="LocationHref('smartynews',{$w.id},true)">{$w.title|truncate:18:"...":true}</li>
												{/if}
											{/if}
										{/foreach}
									</div>
								{/foreach}
							</div>
						</div>
					</div>
					<!--右侧的部分-->
					<div class='xindaidaixun-right'>
						<div class='xindaidaixun-right-top'>
							<div class='xindaidaixun-right-top-2'>
								<div class='div3-8'>
								</div>
								<span class='span3-5'>贷款资讯</span>
							</div>
						</div>
						<div class='xindaidaixun-right-buttom'>
							<div class='xindaidaixun-right-buttom-1 hoverpointer'>
								<img src="images/01_34.jpg" alt="" onclick="LocationHref('fangdai')"/>
								<p>
									<span class='xindaidaixun-right-buttom-1-1' onclick="LocationHref('fangdai')">房贷计算器</span>
								</p>
							</div>

							<div class='xindaidaixun-right-buttom-1 hoverpointer'>
								<img src="images/01_36.jpg" alt="" onclick="LocationHref('chedai')"/>
								<p>
									<span class='xindaidaixun-right-buttom-1-2' onclick="LocationHref('chedai')">车贷计算器</span>
								</p>
							</div>

							<div class='xindaidaixun-right-buttom-1 hoverpointer'>
								<img src="images/01_40.jpg" alt="" onclick="LocationHref('ershoufang')"/>
								<p>
									<span class='xindaidaixun-right-buttom-1-3' onclick="LocationHref('ershoufang')">二手房贷计算器</span>
								</p>
							</div>

							<div class='xindaidaixun-right-buttom-1 hoverpointer'>
								<img src="images/01_42.jpg" alt="" onclick="LocationHref('gongjijin')"/>
								<p>
									<span class='xindaidaixun-right-buttom-1-4' onclick="LocationHref('gongjijin')">公积金贷款计算器</span>
								</p>
							</div>
						</div>
					</div>
				</div>

				<div class='hezuojigou'>
					<div class='hezuojigou-top'>
						<div class='hezuojigou-top-1'>
							<div class='hezuojigou-top-1-1'>
							</div>
							<span class='span3-5'>合作机构</span>
						</div>
					</div>
					<div class='hezuojigou-buttom'>
						{counter start=0 skip=1 print=false}
						{foreach $cooperatagencylist as $c}
							<a href="{$c.linkurl}" onclick="AccessRecord('进入合作机构页面','合作机构页面','合作机构{$c.id}');">
								<img src="{$c.imgurl}" alt="{$c.name}" style="width:256px;height:61px;">
							</a>
						{foreachelse}
							<p>暂无数据</p>
						{/foreach}
					</div>
				</div>
				<div class='footer'>
					<div class='footer-top'>
						<div class='footer-top-1'>
							<div class='footer-top-1-table'>
								 <div class="footer-dl">
									{foreach $footervariedlist as $f}
										<dl><dt><i class="{$f.icon}"></i>{$f.name}</dt>
											{foreach $f.childfooter as $c}
												 <dd><a class='hoverpointer' onclick="LocationHref('smartyfooterdetail',{$c.id})">{$c.title}</a></dd>
											{foreachelse}
												<p>暂无数据</p>
											{/foreach}
										</dl>
									{foreachelse}
										<p>暂无数据</p>
									{/foreach}
								</div>
							</div>
							<div class='footer-top-tel'>
								<div class='footer-tel-left'>
									<img src='images/01_76.jpg'>
									<p>信贷网微信公众账号</p>
								</div>
								<div class='footer-tel-right'>
									<span>有问题咨询请投递</span><br>
									<span class='footer-span'>0000000@qq.com</span>
								</div>
								<div class='footer-tel-right footer-tel-right-2'>
									<span>摇一摇微信号 </span><br>
									<span class='footer-span'>0000000000</span>
								</div>
								<div class='footer-tel-right footer-tel-right-3'>
									<span>QQ随时在线</span><br>
									<span class='footer-span'>00000000</span>
								</div>
							</div>
						</div>
					</div>
					<div class='footer-buttom'>
						<div class='footer-buttom-1'>
							<div class='footer-buttom-left'>
								<div style="background:url(images/kf.png);margin-top: 20px;width:282px;height:64px;">
									<p style="padding-left: 75px;color: #dcdddd;font-size: 26px;">
										{$footerfixed.telephone}
									</p>
								</div>
							</div>

							<div class='footer-buttom-right'>
								<p>{$footerfixed.copyright}</p>
								<a href="http://wsestar.com/">技术支持：西安传睿数字技术有限公司</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--这是尾部-->
			<div></div>
		</div>
	</body>
	<script type="text/javascript">
		function HoverNewsTypeTitle(that){
			$(".newsTitle").removeClass("fli");
			$(that).addClass("fli");
			typeId = $(that).data("newstypeid");
			$(".newsListContainer").children().each(function(){
				t = $(this).data("newstypeid");
				if(t != typeId){
					$(this).css("display", "none");
					return;
				}
				
				$(this).css("display", "");
			})
		}
	
		var Settings = {};
		var verifyCode = new GVerify("apply_img");
		
		function SubmitApply(){
			var money = $("#apply_money").val();
			var surname = $("#apply_surname").val();
			var sex = $('#apply_sex option:selected').val();
			var mobile = $("#apply_mobile").val();
			var mcode = $("#apply_mcode").val();
			
			if(!verifyCode.validate($("#apply_code").val())){
				$("#apply_code").val("");
				$("#apply_code").focus();
				CommonWarning('图片验证码错误');
			}
		}
		function GetMcode(){
			CommonJustTip('待调整，手机验证码暂时无需填写');
		}
		
		function getUrlParam(name){
			var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
			var r = window.location.search.substr(1).match(reg);
			if (r!=null) return unescape(r[2]); return '';
		}
		function ShowCurrentcity(){
			var i,length={$subarealist|@count};
			if(getUrlParam('subareaid') == 0){
				$("#current_city").text("当前城市：全国");
			}else{
				for(i=0;i<length;i++){
					if(getUrlParam('subareaid') == {json_encode($subarealist)}[i].id){
						$("#current_city").text("当前城市："+{json_encode($subarealist)}[i].name);
					}
				}
			}
		}
		
		window.onload = OnLoad;
		function OnLoad(){
			BindEvents();
			ShowCurrentcity();
			
			$("#apply_submitbtn").click(function(){
				SubmitApply();
			});
			$("#apply_mcodebtn").click(function(){
				GetMcode();
			});
			
			$(".newsintro").each(function(){
				var strtest = $(this).text();
				if(strtest.length>107){
					strtest=strtest.slice(0,107)+"...";
					$(this).text(strtest);
				}
			});
			
			$(".newsTitle").hover(function(){
				HoverNewsTypeTitle(this);
			});
			
			$(".letters").each(function(){
				$(this).click(function(){
					//alert($(this).data('para'));
					$(".letter-city").html("");
				
					url = "ajax.php?mode=SearchCity&firstletter="+$(this).data('para');
					$.post(url,function(json,status){
						data = eval("("+json+")");
console.log(data);
						if(data == null||data == 'null'||data == ""){
							CommonJustTip('暂无数据。');
							return;
						}
						strTbody ="<ul>";
						for(var i=0;i<data.length;i++){
							strTbody += "<li id=lettercity"+data[i].id +" onclick='showupdate(" + data[i].id +")' >"+data[i].name+"</li>";
						}
						strTbody +="</ul>";
						$(".li").hide();
						$(".letter-city").show();
						$(".letter-city").append(strTbody);
					})
					{*strTbody ="<ul>";
					for(var i=0;i<4;i++){
						strTbody += "<li id='lettercity"+i+"' onclick='showupdate(" + i +")'>"+$(this).data('para')+"</li>";
					}
					strTbody +="</ul>";
					$(".li").hide();
					$(".letter-city").show();
					$(".letter-city").append(strTbody);*}
				})
			});
            $(".letter-city").hover(function(){
                $(".letter-city").show();
            },function(){
                $(".letter-city").hide();
                $(".li").show();
            });
		}
		function showupdate(id){
			if(id==0){
				window.location.href='index.php';
			}else{
				window.location.href='index.php?subareaid='+id;
			}
		}
		var start;
		var end;
		var duration = 0;
		start = new Date();
		$(window).bind('beforeunload', function(e) {
			end = new Date();//用户退出时间
			duration = end.getTime() - start.getTime();
			duration = duration/1000;//取的是秒
			//ajax更新数据库
			console.log(duration);//停留的时间单位是秒
			AccessRecord('关闭首页','首页','首页');
		});
		function BindEvents(){
			AccessRecord('进入首页','首页','首页');
			$(".newstype").click(function(){
				var id =$(this).attr("id").substr(8,$(this).attr("id").length);
				window.location.href='newslist.php?newstype='+id;
			});
			
			console.log('贷款产品',{json_encode($supplyinfolist)});
			console.log('需求信息',{json_encode($demandinfolist)});
			console.log('贷款咨询',{json_encode($supplierlist)});
			console.log('合作机构',{json_encode($cooperatagencylist)});
			console.log('联系方式、footer',{json_encode($footerfixed)});
			console.log('关于我们',{json_encode($footervariedlist)});
			{*console.log('信贷资讯',{json_encode($newsinfoarr)});*}
			console.log('信贷资讯',{json_encode($arrNewsList)});
			
			console.log('地区',{json_encode($subarealist)});
			//console.log({$footervariedlist|@count});
			console.log('是否是需方登录',{json_encode($viewsupplyinforight)});
			console.log('是否是供方登录',{json_encode($viewdemandinforight)});
			console.log('是否登录',{json_encode($viewright)});
			
			$("#container .content .counsel .specialist ul").width(407*{$supplierlist|@count});			
			$("#container .content .hot-loan .h-banner ul").width(241*{$supplyinfolist|@count});		
			
			$("#container .content .counsel .specialist").css("display","");
			$("#container .content .hot-loan .h-banner").css("display","");
			
			
			$("#counsel .specialist").css("display","");
		}
		
		function DemandRecord(id,action,page,memo){
			url = "ajax.php?";
			url += "mode=CheckMaxvisibleNum";
			url += "&demandinfoid=" + id;
			$.get(url,function(json,status){
				data=eval("("+json+")");
				switch(data){
					case 1:
						AccessRecord(action,page,memo);
						window.location.href='needinfordetail.php?demandinfoid='+id;
						break;
					case -99:
						alert('已经达到最大可见数');
						//$("need"+id).attr("href","#");
						return false;
						break;
				}
			});
			
		}
		function AccessRecord(action,page,memo){
			/*url = "ajax.php?";
			url+= "mode=Action";
			url+= "&action="+action;
			url+= "&page="+page;
			url+= "&memo="+memo;
			$.post(url);*/
		}
		function checkLeave(){
			AccessRecord('关闭首页','首页','首页');
		}
		
		function CommonJustTip(content,title){
			if(title == undefined){
				title = "";
			}
			$.confirm({				
				title: title,
				content: content,
				// confirmButton: '确定',
				confirmButton: false,
				cancelButton: false,
				backgroundDismiss: true,
				// autoClose: 'confirm|1000'
			});
		}
		
		
		function CommonWarning(content,title){
			if(title == undefined){
				title = "";
			}
			$.confirm({
				icon: 'fa fa-warning',
				closeIcon: true,
				title: title,
				content: content,
				confirmButton: '确定',
				cancelButton: '取消'
			});
		}
		
		function CommonConfirm(content,title){
			if(title == undefined){
				title = "";
			}
			$.confirm({
				// icon: 'glyphicon glyphicon-heart',
				title: title,
				content: content,
				confirmButton: '确定',
				cancelButton: '取消'
			});
		}	
		function CommonNopower(){
			$.confirm({
				title: '',
				content: '您没有该页面的访问权限！',
				confirmButton: '确定',
				cancelButton: false,
				backgroundDismiss: true,
				autoClose: 'confirm|1000'
			});
		}
		function LocationHref(page,id,islimit){
			if(page == "index"){
				window.location.href= page+'.php';
				return;
			}
			if(id == undefined){
				window.location.href= page+'.new.php';
				return;
			}
			var idname = "";
			var url = "";
			var userid = {$viewsupplyinforight};
			var prompt = "需方";
			var isajax = false;
			switch(page){
				case "smartyproindex":
					idname="supplyinfoid";
					break;
				case "smartyproductsdetails":
					idname="supplyinfoid";
					url = "ajax.php?mode=SupplyinfodetailView&supplyinfoid="+id;
					isajax = true;
					break;
				case "smartyconsultantdetails":
					idname="supplierid";
					url = "ajax.php?mode=SupplierdetailView&supplierid="+id;
					isajax = true;
					break;
				case "smartynews":
					idname="newsid";
					url = "ajax.php?mode=updatenewsclick&newsid="+id;
					isajax = true;
					break;
				case "smartyneed":
					idname="demandinfoid";
					url = "ajax.php?mode=DemandinfodetailView&demandinfoid="+id;
					userid={$viewdemandinforight};
					prompt="供方";
					isajax = true;
					break;
				case "smartyfooterdetail":
					idname="footerid";
					break;
			}
			if(islimit){
				Common_DetailView(url,userid,prompt,function(){
					window.location.href= page+'.new.php?'+idname+'='+id;
				},isajax);
			}else{
				window.location.href= page+'.new.php?'+idname+'='+id;
			}
		}
		function Common_DetailView(url,userid,prompt,callback,isajax){
			//if({$viewright}==1){
				if(url==""){
					callback();
				}else{
					if(userid==1 || isajax){
						$.get(url,function(json,status){
							switch(json){
								case "1":
									callback();
									break;
								case "-99":
									CommonJustTip("已经达到最大可见数量！","提示");
									break;
								default:
									CommonJustTip("服务器忙，请稍候再试。","提示");
							}
						});
					}else{
						//CommonJustTip("只有"+prompt+"可以查看!","提示");
						callback();
					}
				}
			//}else{
			//	CommonJustTip("请先登录!","提示");
			//}
		}
   </script> 
</html>