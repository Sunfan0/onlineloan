<?php
	include "paras.php";
	$supplyinfoid = Get("supplyinfoid");
	$strSql = "select * FROM `supplyinfo` where id=$supplyinfoid ";
	$supplyinfodetail = DBGetDataRow($strSql);
	
	
	$smarty->assign("supplyinfodetail",$supplyinfodetail);
	$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);//启动缓存
	$smarty->display('supplyinfodetail.tpl',$supplyinfoid);
	
	include "smartyfooter.php";
?>