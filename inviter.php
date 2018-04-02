<?php
	include "paras.php";
	/* $friendopenid = Get("wang");
	$publisher = Get("publish");
	$ua = $_SERVER['HTTP_USER_AGENT'];
	$userInfo=null;
	$inviter=Get("inviter");
	if($inviter==''){
		$inviter=0;
	} */
	/*
	1,判断当前用户是否关注链家公众号
		1）如果没有关注，显示二维码页面
		2）如果已经关注，则直接进行帮助好友抢路费，显示帮好友抢到的金额，以及好友的助力列表页
	2,长按链家二维码关注之后的提示语
		1）进入来源与此活动无关，则（欢迎关注提示）
		2）判断当前用户从此活动进入的邀请链接，相应提示，然后为好友抢路费
	*/
	
	
	$openid=InitOpenid(true);
	var_dump($openid); 
	/* $openid='oFb3-tpkdc7VosVFcX7BCZ4sjX8U';
	var_dump($openid); */
	die();
	$access_token = GetUrlContent("http://www.wsestar.com/getaccesstoken.php?app=".APPNAME);//获取accesstoken
	$access_token = str_replace("\"","",$access_token);//以空格连接
	var_dump($access_token);
	$issubscribe = GetUrlContent("https://api.weixin.qq.com/cgi-bin/user/info?access_token=".$access_token."&openid=".$openid."&lang=zh_CN");
	var_dump($issubscribe);
	die();
	
	
	if($friendopenid == ""){
		$arrInfo = InitCustInfoV3(true);
		$friendopenid = $arrInfo["openid"];
		$friendnickname=$arrInfo["nickname"];
		$friendheadimgurl=$arrInfo["headimgurl"];
	} else {
		$userInfo = DBGetDataRowByField("custinfo" , "openid" , $friendopenid);
		$friendnickname = $userInfo["nickname"];
		$friendheadimgurl = $userInfo["imgurl"];
	}
	//$_SESSION["stropenid"]=$friendopenid;
	if($userInfo==null){//没有进行查找
		$userInfo = DBGetDataRowByField("custinfo" , "openid" , $friendopenid);
	}
	
	if($userInfo==null){//没有找到数据
		$friendId = DBInsertTableField("custinfo",array("openid","nickname","imgurl","inviter"), array($friendopenid,$friendnickname,$friendheadimgurl,$inviter));
		$isgiftused=0;
		$giftlevel=0;
	}else{
		$friendId=$userInfo["id"];
		$isgiftused=$userInfo["isgiftused"];
		$giftlevel=$userInfo["giftlevel"];
	}

	//$visitid = InitVisitidV3();
	$visitid = -1;
	$visitid = VisitHistoryV4($friendopenid,$visitid,"inviter.php",$inviter,$ua,$publisher);//在visithistory表中插入访问数据

	
	
	// $imgPath = "img/";
?>
