<?php
/* Smarty version 3.1.30, created on 2017-05-11 16:33:37
  from "E:\xampp\htdocs\test\test.works\onlineloan\smarty\templates\smartypage.new.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_591421e1e49fd8_71977572',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1889e4333fd4d5b61a0d506e85fac89b52e919d1' => 
    array (
      0 => 'E:\\xampp\\htdocs\\test\\test.works\\onlineloan\\smarty\\templates\\smartypage.new.tpl',
      1 => 1494491606,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_591421e1e49fd8_71977572 (Smarty_Internal_Template $_smarty_tpl) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Author" content="">
    <title>贷款信息网</title>
	<link rel="stylesheet" type="text/css" href="style/stylenew.css" />
	<link href="js/craftpip/css/jquery-confirm.css" rel="stylesheet"/>
    <!-- 引入JQuery的官方类库 -->
    <?php echo '<script'; ?>
 type="text/javascript" src="js/jquery-1.11.1.min.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript" src="js/craftpip/js/jquery-confirm.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript" src="js/scroll.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript" src="js/tab.js"><?php echo '</script'; ?>
>
	<?php echo '<script'; ?>
 type="text/javascript">
		$(function() {
			$("div.list_lh").myScroll({
				speed: 40, //数值越大，速度越慢
				rowHeight: 37 //li的高度
			});
		});
	<?php echo '</script'; ?>
>
</head>
<body>
		<!--这是最大的框-->
		<div id="daikuan">
			<!--这是头部-->
			<div id='header'>
				<!--这是头部的上面部分-->
				<div class="header-top">
					<div class='header-top-1'>
						<span class='span1-1 span1-5'>当前城市：西安</span>
						<span class='span1-2 span1-5'>Hi,请登录   注册</span>
						<span class='span1-3 span1-5'>
							<img src="images/01_05.jpg" alt="" /> 微信
						</span>&nbsp;<span class='span1-6'></span>&nbsp;
						<span class='span1-4 span1-5'>
							<img src="images/01_07.jpg" alt="" /> 微博
						</span>
					</div>
				</div>
				<div class="header-bottom">
					<div class='header-bottom-left'>
						<img src="images/01_13.jpg" alt="" />
						<i class='i1'>
							<img src="images/tel.png" alt="" class='img-1'/>
							&nbsp;<span class='span2-1'>400-777-9876</span>
						</i>
					</div>
					<div class='header-bottom-right'>
						<ul class='ul1'>
							<li>
								<a href="#">找贷款</a>
							</li>
							<li>
								<a href="#">找产品</a>
							</li>
							<li>
								<a href="#">找顾问</a>
							</li>
							<li>
								<a href="#">贷款资讯</a>
							</li>
							<li>
								<a href="#">我的账户</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!--这是主体-->
			<div id='bodyer'>
				<!--这是图片-->
				<div class='img2-3'>
					<div class='img2-form'>
						<p>快速贷款通道</p>
						<div class='img2-form-1'>
							<form>
								<input type="text" placeholder="贷款金额（万元）" class='form-1-1' />
								<input type="text" placeholder="您的姓氏" class='form-1-2' />
								<select name="" id="" value='请选择' class='form-1-3'>
									<option value=""><img src='iamges/men.jpg'>男</option>
									<option value="">女</option>
								</select>
								<input type="tel" placeholder="联系手机" class='form-1-4' />
								<input type="text" placeholder="图片验证码" class='form-1-5' />
								<div class='yanzhengma'>abcd</div>
								<input type="text" placeholder="验证码" class='form-1-6' />
								<input type="button" value='获取验证码' class='button-1-1' />
								<input type="button" value='提交贷款' class='button-1-2' />
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
						<tr>
							<td class='td1'>季季丰</td>
							<td>不看征信</td>
							<td>5-8W</td>
							<td>等额本息</td>
							<td>3-5个工作日</td>
						</tr>
						<tr>
							<td class='td1'>双季盈</td>
							<td>不看征信,利息低</td>
							<td>9-12W</td>
							<td>等额本息</td>
							<td>1-3个工作日</td>
						</tr>
						<tr>
							<td class='td1'>季季丰</td>
							<td>不看征信</td>
							<td>5-8W</td>
							<td>等额本息</td>
							<td>3-5个工作日</td>
						</tr>
						<tr>
							<td class='td1'> 季季丰</td>
							<td>不看征信</td>
							<td>5-8W</td>
							<td>等额本息</td>
							<td>3-5个工作日</td>
						</tr>
						<tr>
							<td class='td1'>季季丰</td>
							<td>不看征信</td>
							<td>5-8W</td>
							<td>等额本息</td>
							<td>3-5个工作日</td>
						</tr>
					</table>
					<div class='div2-2'>
						<div class='div2-3'>
						</div>
						<p class='span2-4'>热门贷款产品</p>
					</div>
				</div>

				<div class='daikuanguwen-3'>
					<div class='daikuanguwen-3-left'>
						<div class='daikuanguwen-left-1'>
							<img src="images/img1.jpg" alt="" class='daikuanguwen-img' />
							<span>admin</span>
							<p>
								商务公司 资深顾问 <br> 特点 ：风趣幽默<br> 最新产品 ：<i>个人信用贷款</i>
							</p>
							<div class='daikuanguwen-lx'>点击查看联系方式</div>
						</div>

						<div class='daikuanguwen-left-1'>
							<img src="images/img2.jpg" alt="" class='daikuanguwen-img' />
							<span>admin</span>
							<p>
								商务公司 资深顾问 <br> 特点 ：风趣幽默<br> 最新产品 ：<i>个人信用贷款</i>
							</p>
							<div class='daikuanguwen-lx'>点击查看联系方式</div>
						</div>

						<div class='daikuanguwen-left-1'>
							<img src="images/img3.jpg" alt="" class='daikuanguwen-img' />
							<span>admin</span>
							<p>
								商务公司 资深顾问 <br> 特点 ：风趣幽默<br> 最新产品 ：<i>个人信用贷款</i>
							</p>
							<div class='daikuanguwen-lx'>点击查看联系方式</div>
						</div>
						<div class='daikuanguwen-left-1'>
							<img src="images/img4.jpg" alt="" class='daikuanguwen-img' />
							<span>admin</span>
							<p>
								商务公司 资深顾问 <br> 特点 ：风趣幽默<br> 最新产品 ：<i>个人信用贷款</i>
							</p>
							<div class='daikuanguwen-lx'>点击查看联系方式</div>
						</div>
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

									<li>
										<span class="w_name">吴先生</span>
										<span class="w_shcool">公务员</span>
										<span class="w_xueli">15万</span>
										<span class="w_jzgs">车</span>
									</li>
									<li>
										<span class="w_name">李先生</span>
										<span class="w_shcool">公务员</span>
										<span class="w_xueli">15万</span>
										<span class="w_jzgs">车</span>
									</li>

									<li>
										<span class="w_name">王先生</span>
										<span class="w_shcool">公务员</span>
										<span class="w_xueli">15万</span>
										<span class="w_jzgs">车</span>
									</li>
									<li>
										<span class="w_name">张先生</span>
										<span class="w_shcool">公务员</span>
										<span class="w_xueli">15万</span>
										<span class="w_jzgs">车</span>
									</li>
									<li>
										<span class="w_name">李先生</span>
										<span class="w_shcool">公务员</span>
										<span class="w_xueli">15万</span>
										<span class="w_jzgs">车</span>
									</li>
									<li>
										<span class="w_name">吴先生</span>
										<span class="w_shcool">公务员</span>
										<span class="w_xueli">15万</span>
										<span class="w_jzgs">车</span>
									</li>
									<li>
										<span class="w_name">赵先生</span>
										<span class="w_shcool">公务员</span>
										<span class="w_xueli">15万</span>
										<span class="w_jzgs">车</span>
									</li>
									<li>
										<span class="w_name">徐先生</span>
										<span class="w_shcool">公务员</span>
										<span class="w_xueli">15万</span>
										<span class="w_jzgs">车</span>
									</li>
									<li>
										<span class="w_name">马先生</span>
										<span class="w_shcool">公务员</span>
										<span class="w_xueli">15万</span>
										<span class="w_jzgs">车</span>
									</li>
									<li>
										<span class="w_name">吴先生</span>
										<span class="w_shcool">公务员</span>
										<span class="w_xueli">15万</span>
										<span class="w_jzgs">车</span>
									</li>
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
								<li class="fli"><a href="">贷款咨询</a></li>
								<li><a href="javascript:viod;">抵押贷款</a></li>
								<li><a href="javascript:viod;">小额贷款</a></li>
								<li><a href="javascript:viod;">企业贷款</a></li>
								<li><a href="javascript:viod;">信用卡咨询</a></li>
								<li><a href="javascript:viod;">理财咨询</a></li>
								<li><a href="javascript:viod;">金融百科</a></li>
							</ol>
							<div id="tab_con">
								<div class="fdiv">
									<p class='fdiv-1'><b>雄安房产相关股票下挫 券商挖掘“边角”概念</b></p>
									<font>此前，“雄安新区概念”横空出世，券商研报推荐次数最多的就是房地产以及基建类股票。据《证券日报》记者此前统计，在清明节小长假休市期间，就有12家券商加班发布15篇研报，每一篇研报都重点推荐了涉及雄安新区房地产和基础设施建设类的股票</font>
									<ul class='ul-1'>
										<li>制造业用工需求同比增长9.3%</li>
										<li>社会保障卡持卡人数近十亿</li>
										<li>严查医保欺诈骗保行为</li>
										<li>用车抵押贷款需要什么手续</li>
										<li>汽车抵押贷款存在哪些风险？如何避免？</li>
									</ul>
									<ul class='ul-2'>
										<li>制造业用工需求同比增长9.3%</li>
										<li>社会保障卡持卡人数近十亿</li>
										<li>严查医保欺诈骗保行为</li>
										<li>用车抵押贷款需要什么手续</li>
										<li>汽车抵押贷款存在哪些风险？如何避免？</li>
									</ul>
								</div>
								<div>
									<p class='fdiv-1'><b>雄安房产相关股票下挫 券商挖掘“边角”概念1</b></p>
									<font>此前，“雄安新区概念”横空出世，券商研报推荐次数最多的就是房地产以及基建类股票。据《证券日报》记者此前统计，在清明节小长假休市期间，就有12家券商加班发布15篇研报，每一篇研报都重点推荐了涉及雄安新区房地产和基础设施建设类的股票</font>
									<ul class='ul-1'>
										<li>制造业用工需求同比增长9.3%</li>
										<li>社会保障卡持卡人数近十亿</li>
										<li>严查医保欺诈骗保行为</li>
										<li>用车抵押贷款需要什么手续</li>
										<li>汽车抵押贷款存在哪些风险？如何避免？</li>
									</ul>
									<ul class='ul-2'>
										<li>制造业用工需求同比增长9.3%</li>
										<li>社会保障卡持卡人数近十亿</li>
										<li>严查医保欺诈骗保行为</li>
										<li>用车抵押贷款需要什么手续</li>
										<li>汽车抵押贷款存在哪些风险？如何避免？</li>
									</ul>
								</div>
								<div>
									<p class='fdiv-1'><b>雄安房产相关股票下挫 券商挖掘“边角”概念2</b></p>
									<font>此前，“雄安新区概念”横空出世，券商研报推荐次数最多的就是房地产以及基建类股票。据《证券日报》记者此前统计，在清明节小长假休市期间，就有12家券商加班发布15篇研报，每一篇研报都重点推荐了涉及雄安新区房地产和基础设施建设类的股票</font>
									<ul class='ul-1'>
										<li>制造业用工需求同比增长9.3%</li>
										<li>社会保障卡持卡人数近十亿</li>
										<li>严查医保欺诈骗保行为</li>
										<li>用车抵押贷款需要什么手续</li>
										<li>汽车抵押贷款存在哪些风险？如何避免？</li>
									</ul>
									<ul class='ul-2'>
										<li>制造业用工需求同比增长9.3%</li>
										<li>社会保障卡持卡人数近十亿</li>
										<li>严查医保欺诈骗保行为</li>
										<li>用车抵押贷款需要什么手续</li>
										<li>汽车抵押贷款存在哪些风险？如何避免？</li>
									</ul>
								</div>
								<div>
									<p class='fdiv-1'><b>雄安房产相关股票下挫 券商挖掘“边角”概念3</b></p>
									<font>此前，“雄安新区概念”横空出世，券商研报推荐次数最多的就是房地产以及基建类股票。据《证券日报》记者此前统计，在清明节小长假休市期间，就有12家券商加班发布15篇研报，每一篇研报都重点推荐了涉及雄安新区房地产和基础设施建设类的股票</font>
									<ul class='ul-1'>
										<li>制造业用工需求同比增长9.3%</li>
										<li>社会保障卡持卡人数近十亿</li>
										<li>严查医保欺诈骗保行为</li>
										<li>用车抵押贷款需要什么手续</li>
										<li>汽车抵押贷款存在哪些风险？如何避免？</li>
									</ul>
									<ul class='ul-2'>
										<li>制造业用工需求同比增长9.3%</li>
										<li>社会保障卡持卡人数近十亿</li>
										<li>严查医保欺诈骗保行为</li>
										<li>用车抵押贷款需要什么手续</li>
										<li>汽车抵押贷款存在哪些风险？如何避免？</li>
									</ul>
								</div>
								<div>
									<p class='fdiv-1'><b>雄安房产相关股票下挫 券商挖掘“边角”概念4</b></p>
									<font>此前，“雄安新区概念”横空出世，券商研报推荐次数最多的就是房地产以及基建类股票。据《证券日报》记者此前统计，在清明节小长假休市期间，就有12家券商加班发布15篇研报，每一篇研报都重点推荐了涉及雄安新区房地产和基础设施建设类的股票</font>
									<ul class='ul-1'>
										<li>制造业用工需求同比增长9.3%</li>
										<li>社会保障卡持卡人数近十亿</li>
										<li>严查医保欺诈骗保行为</li>
										<li>用车抵押贷款需要什么手续</li>
										<li>汽车抵押贷款存在哪些风险？如何避免？</li>
									</ul>
									<ul class='ul-2'>
										<li>制造业用工需求同比增长9.3%</li>
										<li>社会保障卡持卡人数近十亿</li>
										<li>严查医保欺诈骗保行为</li>
										<li>用车抵押贷款需要什么手续</li>
										<li>汽车抵押贷款存在哪些风险？如何避免？</li>
									</ul>
								</div>
								<div>
									<p class='fdiv-1'><b>雄安房产相关股票下挫 券商挖掘“边角”概念5</b></p>
									<font>此前，“雄安新区概念”横空出世，券商研报推荐次数最多的就是房地产以及基建类股票。据《证券日报》记者此前统计，在清明节小长假休市期间，就有12家券商加班发布15篇研报，每一篇研报都重点推荐了涉及雄安新区房地产和基础设施建设类的股票</font>
									<ul class='ul-1'>
										<li>制造业用工需求同比增长9.3%</li>
										<li>社会保障卡持卡人数近十亿</li>
										<li>严查医保欺诈骗保行为</li>
										<li>用车抵押贷款需要什么手续</li>
										<li>汽车抵押贷款存在哪些风险？如何避免？</li>
									</ul>
									<ul class='ul-2'>
										<li>制造业用工需求同比增长9.3%</li>
										<li>社会保障卡持卡人数近十亿</li>
										<li>严查医保欺诈骗保行为</li>
										<li>用车抵押贷款需要什么手续</li>
										<li>汽车抵押贷款存在哪些风险？如何避免？</li>
									</ul>
								</div>
								<div>
									<p class='fdiv-1'><b>雄安房产相关股票下挫 券商挖掘“边角”概念6</b></p>
									<font>此前，“雄安新区概念”横空出世，券商研报推荐次数最多的就是房地产以及基建类股票。据《证券日报》记者此前统计，在清明节小长假休市期间，就有12家券商加班发布15篇研报，每一篇研报都重点推荐了涉及雄安新区房地产和基础设施建设类的股票</font>
									<ul class='ul-1'>
										<li>制造业用工需求同比增长9.3%</li>
										<li>社会保障卡持卡人数近十亿</li>
										<li>严查医保欺诈骗保行为</li>
										<li>用车抵押贷款需要什么手续</li>
										<li>汽车抵押贷款存在哪些风险？如何避免？</li>
									</ul>
									<ul class='ul-2'>
										<li>制造业用工需求同比增长9.3%</li>
										<li>社会保障卡持卡人数近十亿</li>
										<li>严查医保欺诈骗保行为</li>
										<li>用车抵押贷款需要什么手续</li>
										<li>汽车抵押贷款存在哪些风险？如何避免？</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!--右侧的部分-->
					<div class='xindaidaixun-right'>
						<div class='xindaidaixun-right-top'>
							<div class='xindaidaixun-right-top-2'>
								<div class='div3-8'>
								</div>
								<span class='span3-5'>信贷咨询</span>
							</div>
						</div>
						<div class='xindaidaixun-right-buttom'>
							<div class='xindaidaixun-right-buttom-1'>
								<img src="images/01_34.jpg" alt="" />
								<p>
									<span class='xindaidaixun-right-buttom-1-1'>房贷计算器</span>
								</p>
							</div>

							<div class='xindaidaixun-right-buttom-1'>
								<img src="images/01_36.jpg" alt="" />
								<p>
									<span class='xindaidaixun-right-buttom-1-2'>车代计算器</span>
								</p>
							</div>

							<div class='xindaidaixun-right-buttom-1'>
								<img src="images/01_40.jpg" alt="" />
								<p>
									<span class='xindaidaixun-right-buttom-1-3'>二手房贷计算器</span>
								</p>
							</div>

							<div class='xindaidaixun-right-buttom-1'>
								<img src="images/01_42.jpg" alt="" />
								<p>
									<span class='xindaidaixun-right-buttom-1-4'>公积金贷款计算器</span>
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
						<img src='images/01_47.jpg'>
						<img src='images/01_49.jpg'>
						<img src='images/01_51.jpg'>
						<img src='images/01_53.jpg'>
						<img src='images/01_59.jpg'>
						<img src='images/01_60.jpg'>
						<img src='images/01_61.jpg'>
						<img src='images/01_62.jpg'>
						<img src='images/01_67.jpg'>
						<img src='images/01_68.jpg'>
						<img src='images/01_69.jpg'>
						<img src='images/01_70.jpg'>
					</div>
				</div>
				<div class='footer'>
					<div class='footer-top'>
						<div class='footer-top-1'>
							<div class='footer-top-1-table'>
								<table cellspacing='0' cellpadding='0'>
									<tr>
										<th>关于我们</th>
										<th>网站功能</th>
										<th>关于用户</th>
										<th>网站声明</th>
									</tr>
									<tr>
										<td>企业介绍</td>
										<td>发布资讯</td>
										<td>个人用户测试</td>
										<td>网站声明</td>
									</tr>
									<tr>
										<td>加入我们</td>
										<td>发布需求</td>
										<td>企业用户</td>
										<td>使用条款</td>
									</tr>
									<tr>
										<td>联系我们</td>
										<td></td>
										<td>猎头用户</td>
										<td></td>
									</tr>
									<tr>
										<td>意见建议</td>
										<td></td>
										<td>黑名单</td>
										<td></td>
									</tr>
								</table>
							</div>
							<div class='footer-top-tel'>
								<div class='footer-tel-left'>
									<img src='images/01_76.jpg'>
									<p>信贷网微信公众账号</p>
								</div>

								<div class='footer-tel-right'>
									<span>有问题咨询请投递</span><br>
									<span class='footer-span'>657892264@qq.com</span>
								</div>
								<div class='footer-tel-right footer-tel-right-2'>
									<span>摇一摇微信号 </span><br>
									<span class='footer-span'>15091756510</span>
								</div>
								<div class='footer-tel-right footer-tel-right-3'>
									<span>QQ随时在线</span><br>
									<span class='footer-span'>657892264</span>
								</div>

							</div>
						</div>
					</div>
					<div class='footer-buttom'>
						<div class='footer-buttom-1'>
							<div class='footer-buttom-left'>
								<img src='images/kf.png'>
							</div>

							<div class='footer-buttom-right'>
								<p>Copyright 2017 daikuanxinxiwang.com 贷款信息网 版权所有 技术支持：西安传睿数字技术有限公司
								</p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--这是尾部-->
			<div></div>
		</div>
	</body>
	<?php echo '<script'; ?>
 type="text/javascript">
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
			console.log('贷款产品',<?php echo json_encode($_smarty_tpl->tpl_vars['supplyinfolist']->value);?>
);
			console.log('需求信息',<?php echo json_encode($_smarty_tpl->tpl_vars['demandinfolist']->value);?>
);
			console.log('贷款咨询',<?php echo json_encode($_smarty_tpl->tpl_vars['supplierlist']->value);?>
);
			console.log('合作机构',<?php echo json_encode($_smarty_tpl->tpl_vars['cooperatagencylist']->value);?>
);
			console.log('联系方式、footer',<?php echo json_encode($_smarty_tpl->tpl_vars['footerfixed']->value);?>
);
			console.log('关于我们',<?php echo json_encode($_smarty_tpl->tpl_vars['footervariedlist']->value);?>
);
			console.log('信贷资讯',<?php echo json_encode($_smarty_tpl->tpl_vars['newsinfoarr']->value);?>
);
			console.log('公告',<?php echo json_encode($_smarty_tpl->tpl_vars['webannounceinfo']->value);?>
);
			console.log('幻灯片',<?php echo json_encode($_smarty_tpl->tpl_vars['slideimginfo']->value);?>
);
			
			//console.log(<?php echo count($_smarty_tpl->tpl_vars['footervariedlist']->value);?>
);
			
			$("#container .content .counsel .specialist ul").width(407*<?php echo count($_smarty_tpl->tpl_vars['supplierlist']->value);?>
);			
			$("#container .content .hot-loan .h-banner ul").width(241*<?php echo count($_smarty_tpl->tpl_vars['supplyinfolist']->value);?>
);		
			$("#banner .b-content .list ul").width(205*<?php echo count($_smarty_tpl->tpl_vars['slideimginfo']->value);?>
);		
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
   <?php echo '</script'; ?>
> 
</html><?php }
}
