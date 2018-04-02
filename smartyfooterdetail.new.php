<?php
	include "paras.php";
	include "smartyheader.new.php";
	$footerid = Get("footerid");
	//$_SESSION["pageurl"]="smartyfooterdetail.new.php?footerid=".$footerid;
	$strSql = " select * FROM `footervaried` where id=$footerid ";
	$footerinfo = DBGetDataRow($strSql);
	if($footerinfo == null){
		echo -1;
		break;
	}
	$starttime=time();
	$smarty->assign("footerinfo",$footerinfo);
	$smarty->assign("starttime",$starttime);
	//$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);//启动缓存
	$smarty->display('smartyfooterdetail.new.tpl',$footerid);
	
	include "smartyfooter.new.php"; 
	
	//$visitid = -1;//访问者id
	//$visitid = VisitHistoryV4($openid,$visitid,"index.php",$inviter,$ua,$publisher);//访问数据
	//点了某个按钮，进行的操作都要记下
	//如果当前用户已经登录访问，则存储用户名，（暂时空着）
	
?>