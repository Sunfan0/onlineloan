<?php
	include "paras.php";
	include "smartyheader.new.php";
	//$_SESSION["pageurl"]="smartynewslist.new.php";
	$viewright=0;//未登录
	if($_SESSION["demandername"]!=""){
		$viewright=1;//需方登录
	}
	if($_SESSION["suppliername"]!=""){
		$viewright=2;//供方登录
	}
	$perpage=20;
	$currentpage = Get("currentpage");
	$currentpage=$currentpage-1;
	$p=$currentpage*$perpage;
	$arrNewsTypeNames = array("全部","贷款资讯", "抵押贷款", "小额贷款", "企业贷款", "信用卡资讯", "理财资讯", "金融百科");
	$arrNewsList = array();
	foreach($arrNewsTypeNames as $name){
		$typeInfo = DBGetDataRowByField("newstype", "name", $name);
		if($name=='全部'){
			$typeInfo=array();
			$typeInfo['id']=0;
			$typeInfo['name']='全部';
		}
		/* if($typeInfo == null)
			continue; */
		$typeid=$typeInfo['id'];
		if($typeid==0){
			$strSql = "select * from  newslist ";
			$strSql .= "where  isallowed=1 order by id desc ";
			$strSql .= " limit $p,$perpage ";
			$detail = DBGetDataRowsSimple($strSql);
			
			$strSql= "select  count(*) as total from newslist  where isallowed=1  ";
			$result = DBGetDataRow($strSql);
		}else{
			$strSql = "select * from  newslist ";
			$strSql .= "where newstypeid=$typeid and isallowed=1 order by id desc ";
			$strSql .= " limit $p,$perpage ";
			$detail = DBGetDataRowsSimple($strSql);
			
			$strSql= "select  count(*) as total from newslist  where isallowed=1 and newstypeid=$typeid  ";
			$result = DBGetDataRow($strSql);
			
		}
		$typeInfo["news"]=$detail;
		$typeInfo['total']=$result['total'];
		$typeInfo["pagecount"]=ceil($typeInfo["total"]/$perpage);
		$typeInfo["perpage"]=$perpage;
		
		array_push($arrNewsList, $typeInfo);
	}
	//需求
	$strSql = "select * FROM `demandinfo` where isallowed=1 order by isstick desc, createtime desc ";//需求信息列表
	$demandinfolist = DBGetDataRowsSimple($strSql);
	
	//最新资讯
	$strSql = " select * FROM `newslist` order by createtime limit 0,9 ";
	$newslist = DBGetDataRowsSimple($strSql);
	
	
	$smarty->assign("arrNewsList",$arrNewsList);
	$smarty->assign("demandinfolist",$demandinfolist);
	$smarty->assign("newslist",$newslist);
	$smarty->assign("viewright",$viewright);
	$smarty->clearCache('smartynewslist.new.tpl');
	//$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);//启动缓存
	$smarty->display('smartynewslist.new.tpl');
	
	include "smartyfooter.new.php"; 
?>