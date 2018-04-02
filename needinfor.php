<?php
	include "paras.php";
	
	$strSql = "select * FROM `demandinfo`  order by Applytime desc ";
	$needinforlist = DBGetDataRowsSimple($strSql);
	
	
	$smarty->assign("needinforlist",$needinforlist);
	$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);//启动缓存
	$smarty->display('needinfor.tpl');
	
	include "smartyfooter.php";
?>