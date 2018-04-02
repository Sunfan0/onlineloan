<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Author" content="">
    <title>贷款网站</title>
    <!-- 引入去掉公共样式的css -->
    <link rel="stylesheet" href="style/common.css">
    <link rel="stylesheet" href="style/font-awesome.min.css">
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/button.css">	
	<link href="js/craftpip/css/jquery-confirm.css" rel="stylesheet"/>
    <!-- 引入JQuery的官方类库 -->
    <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/craftpip/js/jquery-confirm.js"></script>
	<style>
		.hint a:hover{
			color:#59B5E8;
		} 
		.call-our dl dd a:hover {
			color:#59B5E8 !important;
		}
		.jconfirm-box-container{
			margin-left: 25%;
			width: 50%;
		}
	</style>
</head>
<body>
    <!-- header start -->
    <div id="header">
        <div class="h-top">
            <!-- t-content start -->
            <div class="t-content">
                <div class="c-fl">
                    <i class="fa fa-phone"></i>
                    <span>客服电话</span>
                    <span>400-777-9876</span>
                </div>
                <div class="c-fr">
                    <span class="welcome">如果您有账号，请</span>
                    <a href="#" class="login">点击这里登录</a>
                    <span class="welcome">。如果您没有账号，也可以</span>
                    <a href="#" class="register">免费注册</a>
                    <a href="#"><span class="weixin"></span>微信</a>
                    <a href="#"><span class="sina"></span>微博</a>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <!-- t-content end -->

        <!-- nav start -->
        <div class="h-nav">
            <!-- <div class="nav" style="border:none;"> -->
            <div class="nav">
                <div class="fl">
                    <a href="#">
                        <img src="images/logo.png" alt="贷款信息网">
                    </a>
                </div>
                <div class="fr">
                    <ul>
                        <li>
                            <a href="#">首页</a>
                        </li>
                        <li class="pos tz">
                            <a href="#">找贷款<i class="fa fa-chevron-down"></i></a>
                            <div class="hide">
                                <a href="">找贷款</a>
                                <a href="">找贷款</a>
                            </div>
                        </li>
                        <li class="pos tz">
                            <a href="#">找产品<i class="fa fa-chevron-down"></i></a>
                            <div class="hide">
                                <a href="">找产品</a>
                                <a href="">找产品</a>
                            </div>
                        </li>
                        <li>
                            <a href="#">找顾问</a>
                        </li>
                        <li>
                            <a href="#">行业资讯</a>
                        </li>
                        <li>
                            <a href="#">成功案例</a>
                        </li>
                        <li class="pos">
                            <a href="#">我的账户<i class="fa fa-chevron-down"></i></a>
                            <div class="account  hide">
                                <a href="#">个人信息</a>
                                <a href="#">站内消息</a>
                                <a href="#">我发布的信息</a>
                                <a href="#">关注我的</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- nav end -->
    </div>
    <!-- header end -->
    <!-- city start -->
     <div class="all-city">
        <div class="city">
            <div class="c-content">
                <div class="c-p">
                    <p>
                        <span>按字母搜索：</span>
						{foreach $letterlist as $s}
							<i class='letters' data-para='{$s.firstletter}' style='text-transform:uppercase;'>{$s.firstletter}</i>
						{foreachelse}
							<p>暂无数据</p>
						{/foreach}
                    </p>
                </div>
                <div class="city-list">
                    <div class="li">
                        <ul>
							<li  onclick='showupdate(0)'>全国</li>
							{foreach $subarealist as $s}
								<li id=city'{$s.id}' onclick='showupdate({$s.id})'>{$s.name}</li>
							{foreachelse}
								<p>暂无数据</p>
							{/foreach}
                        </ul>
                    </div>
                    <div class="letter-city">
                        <ul>
                           
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- city end -->

    <!-- search start -->
    <div class="search">
        <div class="s-content">
            <div class="slider">
                <h6>一站式贷款信息服务</h6>
            </div>
            <div class="s-input">
                <div class="fl">
                    <i class="fa fa-bullhorn"></i>
                    <span>公告</span>
                    <span class="fen">|</span>
                </div>
                <div class="fr">
                    <ul>
						{foreach $webannounceinfo as $w}
							<li><a href="announcement.php" >{$w.content}</a></li>
						{/foreach}
                    </ul>
                </div>
                <div class="more">
                    <a href="announcement.php" >更多<span class="fa fa-angle-double-right"></span></a>
                </div>
            </div>
            <div class="free">
                <a href="#" class="a_demo_four">免费发布信息</a>
            </div>
        </div>
    </div>
    <!-- search end -->

    <!-- banner start -->
    <div id="banner">
        <div class="b-content">
			<div class="img-list">
                <ul>
                    {foreach $slideimginfo as $s}
						<li><a href="{$s.linkurl}" onclick="AccessRecord('进入幻灯片页面','幻灯片页面','幻灯片{$s.id}');"><img src="{$s.imgurl}" width="1226" height="450">{$s.text}</a></li>
					{/foreach}
                </ul>
            </div>
			<div class="list">
                <ul>
                    {counter start=0 skip=1 print=false}
					{foreach $slideimginfo as $s}
						{$num={counter}%5}
						{if $num eq "1"}
							<li class="click"><img src="{$s.imgurl}" >{$s.text}</li>
						{else}
							<li><img src="{$s.imgurl}" >{$s.text}</li>
						{/if}
					{/foreach}
                </ul>
            </div>
			
            <div class="pre btn"><span class="fa fa-angle-left"></span></div>
            <div class="next btn"><span class="fa fa-angle-right"></span></div>
            <div class="slider">
                <ul>
                    <li class="first">
                        <div class="title">
                            <h4><span class="fa fa-desktop"></span>房贷</h4>
                            <div class="li">
                                <ul>
                                    <li>
                                        <a href="#">消费贷</a><br/>
                                        <a class="detail">主要是用于留学贷款,房屋装修,购买耐用品乃至买车等</a>
                                    </li>
                                    <li>
                                        <a href="#">经营贷</a><br/>
                                        <a class="detail">贷款资金用于其企业或个体户的经营需要</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="two">
                        <div class="title">
                            <h4><span class="fa fa-desktop"></span>信贷</h4>
                            <div class="li">
                                <ul>
                                    <li><a href="#">车贷</a></li>
                                    <li><a class="detail">指贷款人向申请购买汽车的借款人发放的贷款</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                    <li class="last">
                        <div class="title">
                            <h4><span class="fa fa-desktop"></span>短拆</h4>
                            <div class="li">
                                <ul>
                                    <li><a class="detail">待添加</a></li>
                                </ul>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- banner end -->

    <!-- container start -->
    <div id="container">
        <div class="content" >
            <!-- hotloan start -->
            <div class="hot-loan">
                <div class="title">
                    <h3>热门贷款产品</h3>
                    <div class="selecter">
                        <span class="fa fa-chevron-left"></span>
                        <span class="fa fa-chevron-right" class="bl"></span>
                    </div>
                </div>
                <div class="h-banner" style="display: none;">
                    <ul>
						{foreach $supplyinfolist as $s}
							 <li>
								<p>{$s.productname}</p>
								
								{if $s.producttype eq "1"}
									<p>房产抵押</p>
								{elseif $s.producttype eq "2"}
									<p>信用贷款</p>
								{else}
									<p>？？？？？</p>
								{/if}
								
								{if $s.paynum eq "1"}
									<p class="loancount">1-10万</p>
								{elseif $s.paynum eq "2"}
									<p class="loancount">10-20万</p>
								{elseif $s.paynum eq "3"}
									<p class="loancount">20-30万</p>
								{elseif $s.paynum eq "4"}
									<p class="loancount">30-40万</p>
								{else}
									<p class="loancount">？？？？？</p>
								{/if}
								
								{if $s.needprofession eq "1"}
									<p>公务员</p>
								{elseif $s.needprofession eq "2"}
									<p>上班族</p>
								{elseif $s.needprofession eq "3"}
									<p>自由职业</p>
								{elseif $s.needprofession eq "4"}
									<p>个体</p>
								{else}
									<p>？？？？？</p>
								{/if}
								
								{if $s.needtime eq "1"}
									<p>1-3个工作日</p>
								{else}
									<p>？？？？？</p>
								{/if}
								
								<p><a href="supplyinfodetail.php?supplyinfoid={$s.id}" >查看</a></p>
							</li>
						{foreachelse}
							<p>暂无数据</p>
						{/foreach}
                    </ul>
                </div>
            </div>
            <!-- hotloan end -->
            <!-- 最新需求信息 开始 -->
            <div class="new-infor">
                <div class="title">
                    <h3>最新需求信息</h3>
                    <div class="more">
                        <a href="needinfor.php">更多<span class="fa fa-arrow-circle-o-right"></span></a>
                    </div>
                </div>
                <div class="news">
                    <ul>
						{counter start=0 skip=1 print=false}
						{foreach $demandinfolist as $d}
							{$no={counter}}
							{$listno=$no%4}
							{if $listno eq 1}
								<li><table><thead><tr><th>姓名</th><th>身份</th><th>申请额度</th><th>抵押物</th><th></th></tr></thead><tbody>
							{/if}
								<tr>
									<td style="color:{$d.titlecolor};">{$d.name}</td>
									
									{if $d.profession eq "1"}
										<td style="color:{$d.titlecolor};">公务员</td>
									{elseif $d.profession eq "2"}
										<td style="color:{$d.titlecolor};">上班族</td>
									{elseif $d.profession eq "3"}
										<td style="color:{$d.titlecolor};">自由职业</td>
									{elseif $d.profession eq "4"}
										<td style="color:{$d.titlecolor};">个体</td>
									{else}
										<td style="color:{$d.titlecolor};">？？？？？</td>
									{/if}

									<td style="color:{$d.titlecolor};">{$d.demandnum}</td>
									
									{if $d.aptitude eq "1"}
										<td style="color:{$d.titlecolor};">车</td>
									{elseif $d.aptitude eq "2"}
										<td style="color:{$d.titlecolor};">房</td>
									{elseif $d.aptitude eq "3"}
										<td style="color:{$d.titlecolor};">车、房</td>
									{else}
										<td style="color:{$d.titlecolor};">？？？？？</td>
									{/if}
									
									<td><a onclick="DemandRecord('{$d.id}','进入需求信息页面','需求信息页面','需求信息{$d.id}');">查看</a></td>
								</tr>
							{if $listno eq 0 || $no eq $demandinfolist|@count}
								</tbody></table></li>
							{/if}
						{/foreach}
                    </ul>
                </div>
            </div>
            <!-- 最新需求信息 结束 -->

            <!-- 贷款咨询 开始 -->
            <div class="counsel">
                <div class="title">
                    <h3>贷款咨询</h3>
                    <div class="selecter">
                        <span class="fa fa-chevron-left"></span>
                        <span class="fa fa-chevron-right" class="bl"></span>
                    </div>
                </div>
                <div class="specialist"  style="display: none;">
                    <ul>
						{counter start=0 skip=1 print=false}
						{foreach $supplierlist as $s}
							<li>
								<div class="p-img">
									<!--<div class="img"><a href="#"><img src="uploads/sup{counter}.jpg"></a></div>-->
									<div class="img"><a href="#"><img src="{$s.imgurl}"></a></div>
									<div class="i-infor">
										<p class="name">{$s.username}</p>
										{if $s.sex eq "1"}
											<p><span>性别：</span>男</p>
										{else}
											<p><span>性别：</span>女</p>
										{/if}
										<p><span>所属公司：</span>{$s.company}</p>
										<p class="character"><span class="left">个人特色:</span><span class="right">{$s.personalfeature}</span></p>
									</div>
								</div>
								<div class="content">
									<p class="first"><span class="fw">最新产品：</span><span>{$s.goodproduct}</span></p>
									<p><span class="fw">联系电话：</span><span class="mobile">{$s.mobile}</span></p>
									<p class="check"><a href="supplierdetail.php?supplierid={$s.id}" >查看</a></p>
								</div>
							</li>
						{foreachelse}
							<p>暂无数据</p>
						{/foreach}
                    </ul>
                </div>
            </div>
            <!-- 贷款咨询 结束 -->
            <!-- hot-infor start -->
            <div class="hot-infor">
                <div class="title">
                    <h3>最热信贷资讯</h3>
                    <div class="more"><a href="newslist.php" >更多<span class="fa fa-angle-double-right"></span></a></div>
                </div>
                <div class="i-content">
					{foreach $newsinfoarr as $n}
						<div class="c-new">
							<div id="newsname{$n.id}" class='newstype' style="background-image:url(images/newsinfobg.png);background-size: contain;width:128px;height:35px;margin: 13px 0 10px 10px;color: #2A82D1;font-size: 20px;text-align: center;line-height: 35px;font-weight: 600;">
							{$n.name}</div>
							<div class="news">
								<ul>
									{foreach $n.childnews as $c}
										<li><a href="newslistdetail.php?newsid={$c.id}" >{$c.title}</a></li>
									{foreachelse}
										<p>暂无数据</p>
									{/foreach}
								</ul>
							</div>
						</div>
					{foreachelse}
						<p>暂无数据</p>
					{/foreach}
                </div>
            </div>
            <!-- hot-infor end -->

            <!-- partners start -->
            <div class="partners">
                <div class="title">
                    <span class="cal">合作机构</span>
                    <span class="jl">|</span>
                    <span>平台超过2000家合作机构</span>
                </div>
                <div class="bank">
                    <ul>
						{counter start=0 skip=1 print=false}
						{foreach $cooperatagencylist as $c}
							{$cooperano={counter}%6}
							{if $cooperano eq 0}
								<li style="padding-right:0;margin-right:0;"><a href="{$c.linkurl}" onclick="AccessRecord('进入合作机构页面','合作机构页面','合作机构{$c.id}');"><img src="{$c.imgurl}" alt="{$c.name}"></a></li>
							{else}
								<li><a href="{$c.linkurl}" onclick="AccessRecord('进入合作机构页面','合作机构页面','合作机构{$c.id}');"><img src="{$c.imgurl}" alt="{$c.name}"></a></li>
							{/if}
						{foreachelse}
							<p>暂无数据</p>
						{/foreach}
                    </ul>
                </div>
            </div>
            <!-- partners end -->
            <!-- footer start -->
            <div class="footer">
                <div class="hot-pohone">
                    <a href="#"><img src="images/1.png" height="107" width="180" alt=""></a>
					<p style="font-size: 25px;color: #E7141A;margin-left: 70px; font-weight: 600;">{$footerfixed.telephone}</p>
                </div>
                <div class="call-our">
					{foreach $footervariedlist as $f}
						<dl><dt><i class="fa fa-user"></i>{$f.name}</dt>
							{foreach $f.childfooter as $c}
								 <dd><a href="footerdetail.php?footerid={$c.id}" >{$c.title}</a></dd>
							{foreachelse}
								<p>暂无数据</p>
							{/foreach}
						</dl>
					{foreachelse}
						<p>暂无数据</p>
					{/foreach}
                </div>
            </div>
            <div class="hint">
				<p style="line-height: 20px;margin-top:10px;">{$footerfixed.copyright}</p>
				<a style="line-height: 20px;text-align: center; display: block;"  href="http://wsestar.com/">西安传睿数字技术有限公司技术支持</a>
			</div>
            <!-- footer end -->
        </div>
    </div>
    <!-- contanier end -->
</body>
	<script type="text/javascript" src="js/index.js"></script>
	<script type="text/javascript">
		var Settings = {};
		window.onload = OnLoad;
		function OnLoad(){
			BindEvents();
			
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
				window.location.href='smartypage-sun.php';
			}else{
				window.location.href='smartypage-sun.php?subareaid='+id;
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
			console.log('信贷资讯',{json_encode($newsinfoarr)});
			console.log('公告',{json_encode($webannounceinfo)});
			console.log('幻灯片',{json_encode($slideimginfo)});
			{*console.log('区域子站',{json_encode($subareainfo)});*}
			//console.log({$footervariedlist|@count});
			
			$("#container .content .counsel .specialist ul").width(407*{$supplierlist|@count});			
			$("#container .content .hot-loan .h-banner ul").width(241*{$supplyinfolist|@count});		
			$("#banner .b-content .list ul").width(205*{$slideimginfo|@count});		
			$("#container .content .counsel .specialist").css("display","");
			$("#container .content .hot-loan .h-banner").css("display","");
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
			url = "ajax.php?";
			url+= "mode=Action";
			url+= "&action="+action;
			url+= "&page="+page;
			url+= "&memo="+memo;
			$.post(url);
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
				cancelButton: false,
				confirmButton: false,
				backgroundDismiss: true,
				closeIcon: false
			});
		}
   </script> 
</html>