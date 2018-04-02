<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Author" content="">
    <title>贷款信息网</title>
    <!-- 引入去掉公共样式的css -->
    <link rel="stylesheet" href="style/common.css">
	<link rel="stylesheet" href="style/wang.css">
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
<body style="background:transparent;">
    <!-- header start -->
    <div id="header">
        <div class="h-top">
            <!-- t-content start -->
            <div class="t-content">
                <div id="headerAreaSelecter">
                    <span>
						<a href="#" class="register" style="font-size:16px;color:#c3c3c3;" onclick="PopupAreaSelect();">【全国】</a>
					</span>
				</div>
				<div id="announcementList">
					<div id="announcementListTitle">
						<i class="fa fa-bullhorn"></i>
						<span>公告</span>
						<span class="fen">|</span>
					</div>
					<div id="announcementListContainer">
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
                <div id="headerRightArea">
					<a href="#" class="register" style="font-size:16px;">登陆</a>
					<a href="#" class="register" style="font-size:16px;">免费注册</a>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <!-- t-content end -->

        <div class="h-nav">
            <div class="nav">
                <div class="fl" style="">
                    <a href="#">
                        <img src="images/logo.png" alt="贷款信息网">
                    </a>
                </div>
				<div class="fr" style="font-size:24px; text-align:right">
					
                    <!--<span>客服电话</span>&nbsp;&nbsp;-->
                    <i class="fa fa-phone" style="color:rgb(0, 75, 146)"></i>
					<span>400-777-9876</span>
                </div>
            </div>
        </div>
    </div>

    <!-- search start -->
    <div class="search">
        <div class="s-content">
            <div class="slider" style="background-color: rgb(0, 75, 146);">
                <span style="color:white;background-color: rgb(0, 75, 146);">一站式贷款信息服务</span>
            </div>
			<div id="nav">
				<ul>
					<li class="pos tz">
						<a href="#">找贷款</a>
					</li>
					<li class="pos tz">
						<a href="#">找产品</a>
					</li>
					<li class="pos tz">
						<a href="#">找顾问</a>
					</li>
					<li class="pos tz">
						<a href="#">行业资讯</a>
					</li>
					<li class="pos tz">
						<a href="#">成功案例</a>
					</li>
					<li class="pos">
						<a href="#">我的账户</a>
					</li>
				</ul>
			</div>
        </div>
    </div>
    <!-- search end -->

    <!-- banner start -->
    <div id="banner" style="position:relative;">
 
			<div class="img-list" style="position:absolute;top:0px;left:0px;">
                    {foreach $slideimginfo as $s}
						<div style="position:absolute;width:100%;"><a href="{$s.linkurl}" onclick="AccessRecord('进入幻灯片页面','幻灯片页面','幻灯片{$s.id}');"><img src="{$s.imgurl}" width="100%" height="450">{$s.text}</a></div>
					{/foreach}
            </div>
			<div class="list" style="position:absolute;top:1000px;left:0px;display:none;">
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
			

			<div class="b-content">
            <div class="pre btn"><span class="fa fa-angle-left"></span></div>
            <div class="next btn"><span class="fa fa-angle-right"></span></div>
            <div id="leftnav">
                <ul>
                    <li >
                        <div class="title">
                            <h4><span class="fa fa-building"></span>房产贷款</h4>
							<ul>
								<li><a href="#">全款房抵押贷款</a></li>
								<li><a href="#">二次抵押贷款</a></li>
								<li><a href="#">二手房按揭贷款</a></li>
							</ul>
                        </div>
                    </li>
                    <li >
                        <div class="title">
                            <h4><span class="fa fa-car"></span>汽车贷款</h4>
							<ul>
								<li><a href="#">车辆信用贷款</a></li>
								<li><a href="#">车辆抵押贷款</a></li>
								<li><a href="#">二手房按揭贷款</a></li>
							</ul>
                        </div>
                    </li>
                    <li >
                        <div class="title">
                            <h4><span class="fa fa-credit-card"></span>信用贷款</h4>
							<ul style="float:left;">
								<li><a href="#">工资贷</a></li>
								<li><a href="#">保单贷</a></li>
							</ul>
							<ul style="float:left;">
								<li><a href="#">月供贷</a></li>
								<li><a href="#">公积金贷</a></li>
							</ul>
                        </div>
                    </li>
                    <li >
                        <div class="title">
                            <h4><span class="fa fa-commenting  "></span>应急贷款</h4>
							<ul>
								<li><a href="#">房产短借</a></li>
								<li><a href="#">汽车短借</a></li>
								<li><a href="#">银行垫资过桥</a></li>
							</ul>
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
            <div id="hot-loan">
                <div class="title">
                    <h3>热门贷款产品</h3>
                </div>
                <div class="h-banner" style="display: block;">
                    <ul>
						{foreach $supplyinfolist as $s}
							 <a href="supplyinfodetail.php?supplyinfoid={$s.id}" >
							 <li>
							 
								<div class="hot-loan-item hot-loan-item-title">{$s.productname}</div>
								<div class="hot-loan-item hot-loan-item-feature">{$s.Featuresintroduce}</div>
								<!--
								{if $s.producttype eq "1"}
									<p>房产抵押</p>
								{elseif $s.producttype eq "2"}
									<p>信用贷款</p>
								{else}
									<p>？？？？？</p>
								{/if}-->
								<div class="hot-loan-item hot-loan-item-loancount">
									{$s.paynum}
								</div>
								<div class="hot-loan-item hot-loan-item-paytype">
									{$s.paytypename}
								</div>
								<div class="hot-loan-item hot-loan-item-needtime">
									{$s.lendtime}
								</div>
								
								<!--<div class="hot-loan-item hot-loan-item-linkbutton">
									<a href="supplyinfodetail.php?supplyinfoid={$s.id}" >点击了解更多</a>
								</div>-->
								
							</li>
							</a>
						{foreachelse}
							<p>暂无数据</p>
						{/foreach}
                    </ul>
                </div>
            </div>
            <!-- hotloan end -->
            <!-- 最新需求信息 开始 -->
            <div id="new-infor">
                <div class="title">
                    <a href="needinfor.php"><h3>最新需求信息</h3></a>
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
								<tr onclick="DemandRecord('{$d.id}','进入需求信息页面','需求信息页面','需求信息{$d.id}');" style="cursor:pointer;:">
									<td  style="cursor:pointer;">{$d.name}
									{* $d.profession *}
									</td>
									
									<!--{if $d.profession eq "1"}
										<td >公务员</td>
									{elseif $d.profession eq "2"}
										<td >上班族</td>
									{elseif $d.profession eq "3"}
										<td >自由职业</td>
									{elseif $d.profession eq "4"}
										<td >个体</td>
									{else}
										<td >？？？？？</td>
									{/if}-->
									<td >字段内容调整中</td>

									<td >{$d.demandnum}</td>
									
									{if $d.aptitude eq "1"}
										<td >车</td>
									{elseif $d.aptitude eq "2"}
										<td >房</td>
									{elseif $d.aptitude eq "3"}
										<td >车、房</td>
									{else}
										<td >？？？？？</td>
									{/if}
									
									<!--<td><a onclick="DemandRecord('{$d.id}','进入需求信息页面','需求信息页面','需求信息{$d.id}');">查看</a></td>-->
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
            <div id="counsel">
                <div class="title">
                    <h3>专业贷款顾问</h3>
                </div>
                <div class="specialist"  style="display: none;">
					<ul>
						{counter start=0 skip=1 print=false}
						{foreach $supplierlist as $s}
							<li>
								<a href="supplierdetail.php?supplierid={$s.id}" >
								<div class="p-img">
									<!--<div class="img"><a href="#"><img src="uploads/sup{counter}.jpg"></a></div>-->
									<div class="img" style=""><a href="#"><img src="{$s.imgurl}"></a></div>
									<div class="i-infor">
										<p class="name">{$s.username}</p>
										<p>{$s.company} 资深顾问</p>
										<p>{$s.personalfeature}</p>
										<span class="fw">最新产品：</span><span>{$s.goodproduct}</span>
									</div>
								</div>
								</a>
								<div class="content">
									<input type="button" class="btn viewSupplierMobile" value="点击查看联系方式"><br>
									<span class="mobile" style="display:none;">{$s.mobile}</span>
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
            <!--<div class="hot-infor">
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
            </div>-->
			<div id="newInfo">
				<div class="clearfix">
					<div class="titleContainer clearfix">
						{foreach $arrNewsList as $n}
							<h3 class="newsTitle" data-newstypeid="{$n.id}">{$n.name}</h3>
						{/foreach}
					</div>
				</div>
				<div id="newsListContainer">
					{foreach $arrNewsList as $n}
						<div class="newsContainer clearfix" data-newstypeid="{$n.id}" style="height:300px; position:relative; display:none;">
							{foreach $n.news as $w}
								<div data-newstypeid="{$n.id}" class="newContainer" style="width:220px; height:200px; float:left;margin:20px; " >
									<div class="newsImageContainer">
										<img src="{$w.image}" width="210px" height="140px" style="padding:5px;">
									</div>
									<div class="newsTitleContainer">
										<h4>{$w.title}</h4>
									</div>
									<div class="newsDescContainer">
									</div>
								</div>
							{/foreach}
						</div>
					{/foreach}
				</div>
                <!--<div class="i-content">
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
                </div>-->
            </div>
            <!-- hot-infor end -->

            <!-- partners start -->
            <div id="partners">
				<div class="clearfix">
					<div class="title" style="float:left;">
						<h3>合作机构</h3>
					</div>
					<div class="title2">
					平台超过2000家合作机构
					</div>
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
            <div id="footer">
                <div class="hot-pohone">
                    <a href="#"><img src="images/2.png" height="107" width="180" alt=""></a>
					<p style="font-size: 25px;color: #E7141A;margin-left: 70px; font-weight: 600;">{$footerfixed.telephone}</p>
                </div>
                <div class="call-our">
					{foreach $footervariedlist as $f}
						<dl><dt><i class="{$f.icon}"></i>{$f.name}</dt>
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
            <div id="hint">
				<p style="line-height: 20px;margin-top:10px;">{$footerfixed.copyright}</p>
				<a style="line-height: 20px;text-align: center; display: block;"  href="http://wsestar.com/">技术支持：西安传睿数字技术有限公司</a>
			</div>
            <!-- footer end -->
        </div>
    </div>
    <!-- contanier end -->
</body>
	<script type="text/javascript" src="js/index.js"></script>
	<script type="text/javascript" src="js/wang.js"></script>
	<script type="text/javascript">
		function HoverNewsTypeTitle(that){
			$(".newsTitle").removeClass("ActiveTitle");
			$(that).addClass("ActiveTitle");
			typeId = $(that).data("newstypeid");
			$("#newsListContainer").children().each(function(){
				t = $(this).data("newstypeid");
				if(t != typeId){
					$(this).css("display", "none");
					return;
				}
				
				$(this).css("display", "");
			})
		}
	
		var Settings = {};
		window.onload = OnLoad;
		function OnLoad(){
			BindEvents();
			
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