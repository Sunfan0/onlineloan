<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="Author" content="">
    <title>贷款网站</title>
    <!-- 引入去掉公共样式的css -->
    <link rel="stylesheet" href="style/common.css">
    <link rel="stylesheet" href="style/details.css">
    <link rel="stylesheet" href="style/font-awesome.min.css">
    <link rel="stylesheet" href="style/index.css">
    <link rel="stylesheet" href="style/button.css">
	<link href="js/craftpip/css/jquery-confirm.css" rel="stylesheet"/>
	<link rel="stylesheet" type="text/css" href="js/kkpager-master/src/kkpager_blue.css" />
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
    <!-- 引入JQuery的官方类库 -->
    <script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/craftpip/js/jquery-confirm.js"></script>
	<script type="text/javascript" src="js/scroll.js"></script>
	<script src="js/kkpager-master/src/kkpager.min.js" charset="utf-8"></script>
	<script type="text/javascript">
	function AccessRecord(action,page,memo){
		url = "ajax.php?";
		url+= "mode=Action";
		url+= "&action="+action;
		url+= "&page="+page;
		url+= "&memo="+memo;
		$.post(url);
	}
</script> 
</head>
<body onbeforeunload="checkLeave();">
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