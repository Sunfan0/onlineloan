<?php
	include "paras.php";
	$supplierid = Get("supplierid");
	$strSql = "select * FROM `supplierinfo` where id=$supplierid";
	$supplierdetail = DBGetDataRow($strSql);
	
	
	$smarty->assign("supplierdetail",$supplierdetail);
	$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);//启动缓存
	$smarty->display('supplierdetail.tpl',$supplierid);
	include "smartyfooter.php";
?>