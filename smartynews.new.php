<?php
	include "paras.php";
	include "smartyheader.new.php";
	$newsid = Get("newsid");
	$viewright=0;//未登录
	if($_SESSION["demandername"]!=""){
		$viewright=1;//需方登录
	}
	if($_SESSION["suppliername"]!=""){
		$viewright=2;//供方登录
	}
	//$_SESSION["pageurl"]="smartynews.new.php?newsid=".$newsid;
	$strSql = " select * FROM `newslist` where id=$newsid ";
	$newsinfo = DBGetDataRow($strSql);
	if($newsinfo == null){
		echo -1;
		break;
	}
	/* $typeid=$newsinfo["newstypeid"];
	$strSql = " select name FROM `newstype` where id=$typeid ";
	$newstype = DBGetDataRow($strSql); */
	$strSql = " select id,title FROM `newslist` where id>$newsid order by id asc limit 0,1 ";
	$newsafterinfo = DBGetDataRow($strSql);
	$strSql = " select id,title FROM `newslist` where id<$newsid  order by id desc limit 0,1 ";
	$newsbeforeinfo = DBGetDataRow($strSql);
	
/* echo json_encode($newsafterinfo);
echo json_encode($newsbeforeinfo);
echo json_encode($newsinfo);
die();  */
	//$smarty->assign("newstype",$newstype);
	$smarty->assign("newsinfo",$newsinfo);
	$smarty->assign("newsafterinfo",$newsafterinfo);
	$smarty->assign("newsbeforeinfo",$newsbeforeinfo);
	$smarty->assign("viewright",$viewright);
	$smarty->clearCache('smartynews.new.tpl',$newsid);
	//$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);//启动缓存
	$smarty->display('smartynews.new.tpl',$newsid);
	
	include "smartyfooter.new.php"; 
?>