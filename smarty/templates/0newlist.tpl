<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="Author" content=" ">
        <title>分类资讯</title>
        <link rel="stylesheet" href="style/common.css">
        <link rel="stylesheet" href="style/details.css">
        <link rel="stylesheet" href="style/font-awesome.min.css">
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
                            <img src="images/logo.png" height="85" width="190" alt="贷款信息网">
                        </a>
                    </div>
                    <div class="fr">
                        <ul>
                            <li>
                                <a href="#">首页</a>
                            </li>
                            <li class="pos tz">
                                <a href="#">找贷款</a>
                            </li>
                            <li class="pos tz">
                                <a href="#">找产品</a>
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
                                <a href="#">我的账户</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- nav end -->
        </div>
        <!-- header end -->

        <!-- 分类资讯 开始 -->
        <div class="message">
            <div class="piccontent">
				 {foreach $newsinfoarr as $n}
					<div class="title">
						<h3>{$n.name}</h3>
					</div>
					<div class="list">
						<ul>
							{foreach $n.childnews as $c}
							<li><a href="newslistdetail.php?newsid={$c.id}">{$c.title}</a></li>
							{/foreach}
						</ul>
					</div>
				{/foreach}
            </div>
        </div>
        <!-- 分类资讯 结束 -->
       <script type="text/javascript">
		function checkLeave(){
			AccessRecord('关闭信贷资讯页面','信贷资讯页面','信贷资讯页面');
		}
        </script>
    </body>
</html>