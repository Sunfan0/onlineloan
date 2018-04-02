<?php
	include "paras.php";
	
	$strSql = "select content,createtime FROM `webannounce`  order by createtime desc ";
	$announcementlist = DBGetDataRowsSimple($strSql);
	
	
	$smarty->assign("announcementlist",$announcementlist);
	$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);//启动缓存
	$smarty->display('announcement.tpl');
	
	include "smartyfooter.php";
?>