<?php
	include "paras.php";
	$demandinfoid = Get("demandinfoid");
	$strSql = "select * FROM `demandinfo` where id=$demandinfoid ";
	$needinfordetail = DBGetDataRow($strSql);
	
	
	$smarty->assign("needinfordetail",$needinfordetail);
	$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);//启动缓存
	$smarty->display('needinfordetail.tpl',$demandinfoid);
	
	include "smartyfooter.php";
?>