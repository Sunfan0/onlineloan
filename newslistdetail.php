<?php
	include "paras.php";
	$newsid = Get("newsid");
	$strSql = " select * FROM `newslist` where id=$newsid ";
	$newsinfo = DBGetDataRow($strSql);
	if($newsinfo == null){
		echo -1;
		break;
	}

	$smarty->assign("newsinfo",$newsinfo);
	$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);//启动缓存
	$smarty->display('newlistdetail.tpl',$newsid);
	
	include "smartyfooter.php"; 
?>