<?php
	include "paras.php";
	$subareaid = Get("subareaid");
	$_SESSION["subareaurl"]=$_SERVER['REQUEST_URI'];
	$showname=$_SESSION["showname"];
	$ismodify=0;
	$viewright=0;
	$viewdemandinforight=0;
	$viewsupplyinforight=0;
	if($showname!=""){//登录
		$viewright=1;
		$supplierinfo = DBGetDataRowByField("supplierinfo" , array("username"),array($showname));
		if($supplierinfo==null){//需方
			$demanderinfo = DBGetDataRowByField("demanderinfo" , array("username"),array($showname));
			if($demanderinfo!=null){
				$ismodify=1;//需方
			}
		}else{//供方
			$ismodify=2;//供方
		}
	}
	if($_SESSION["demandername"]!=""){
		$viewsupplyinforight=1;
	}
	if($_SESSION["suppliername"]!=""){
		$viewdemandinforight=1;
	}
	$_SESSION["pageurl"]=$_SERVER['REQUEST_URI'];
	
	$strSql = "select distinct firstletter FROM `subarea` order by firstletter asc ";
	$letterlist = DBGetDataRowsSimple($strSql);
	
	$strSql = "select * FROM `subarea` where isshow=1 order by sort asc ";
	$subarealist = DBGetDataRowsSimple($strSql); 
	
	/* $strSql = "select * FROM `subarea` order by createtime desc ";
	$subarealist = DBGetDataRowsSimple($strSql); */ 
	
	$arrNewsTypeNames = array("贷款资讯", "抵押贷款", "小额贷款", "企业贷款", "信用卡资讯", "理财资讯", "金融百科");
	$arrNewsTypeIds = array();
//关于资讯回复，产品回复还没添加
	if($subareaid==""){
		$strSql = "select * FROM `supplyinfo` where isallowed=1 order by isstick desc,createtime desc limit 5 ";//贷款产品列表
		$supplyinfolist = DBGetDataRowsSimple($strSql);
		
		$strSql = "select * FROM `supplierinfo` where isallowed=1  order by createtime desc ";//供方列表
		$supplierlist = DBGetDataRowsSimple($strSql);
		
		$strSql = "select * FROM `demandinfo` where isallowed=1 order by isstick desc, createtime desc ";//需求信息列表
		$demandinfolist = DBGetDataRowsSimple($strSql);
		
		
		$arrNewsList = array();
		foreach($arrNewsTypeNames as $name){
			$typeInfo = DBGetDataRowByField("newstype", "name", $name);
			if($typeInfo == null)
				continue;
			
			$descdata = DBGetDataRowByField("newslist", array("newstypeid", "isallowed"), array($typeInfo["id"], 1), " order by createtime desc ", " limit 0, 1 " );
			$typeInfo["list"] = $descdata;
			
			$arrNews = array();
			$data = DBGetDataRowsByField("newslist", array("newstypeid", "isallowed"), array($typeInfo["id"], 1), " order by id desc ", " limit 0, 10 " );
			$typeInfo["news"] = $data;
			array_push($arrNewsList, $typeInfo);
		}
		
		$strSql = "select n1.title,n1.id as cid,n.name,n.id FROM `newslist` n1  ";
		$strSql .= "left join newstype n on n1.newstypeid=n.id ";
		$strSql .= " where n1.isallowed=1 ";
		$strSql .= " order by n1.isstick desc,n.sort asc, n1.createtime desc";
		
		$result = DBGetDataRowsSimple($strSql);
		if($result == null){
			$newsinfoarr = null;
		}else{
			$list = array();
			for($i=0;$i<count($result);$i++){
				if(!isset($list[$result[$i]["id"]])){
					$list[$result[$i]["id"]] = array();
					$list[$result[$i]["id"]]["id"] = $result[$i]["id"];
					$list[$result[$i]["id"]]["name"] = $result[$i]["name"];
					$list[$result[$i]["id"]]["childnews"] = array();
				}
				if($result[$i]["cid"] == null)
					continue;
				$row = array();
				$row["id"] = $result[$i]["cid"];
				$row["title"] = $result[$i]["title"];
				array_push($list[$result[$i]["id"]]["childnews"],$row);
			}
			$newsinfoarr = array();//输出这个
			
			foreach($list as $o){
				$newsinfoarr[] = $o;
			}
		}
	
		$strSql = "select * FROM `slideimginfo` s1";
		$strSql .= " order by s1.createtime desc ";
		$slideimginfo = DBGetDataRowsSimple($strSql);
	
	}else{
		$strSql = "select s1.* FROM `supplyinfo` s1  ";
		$strSql .= " left join supplierinfo s2 on s1.supplierid=s2.id ";
		$strSql .= " left join suppliersubarea s3 on s2.id=s3.supplierid ";
		$strSql .= " left join subarea s4 on s3.subareaid=s4.id ";
		$strSql .= " where s4.id=$subareaid and s1.isallowed=1 and s3.status=0 ";
		$strSql .= " order by s1.isstick desc,s1.createtime desc limit 5 ";
		$supplyinfolist = DBGetDataRowsSimple($strSql);
	
		$strSql = "select s1.* FROM `supplierinfo` s1 ";//供方列表
		$strSql .= " left join suppliersubarea s2 on s1.id=s2.supplierid";
		$strSql .= " left join subarea s3 on s2.subareaid=s3.id ";
		$strSql .= " where s3.id=$subareaid and s2.status=0 ";
		$strSql .= " and s1.isallowed=1  order by s1.createtime desc   ";
		$supplierlist = DBGetDataRowsSimple($strSql);
		
		
		$strSql = "select d.* FROM `demandinfo` d ";//需求信息列表
		$strSql .= " left join demandinfosubarea s2 on d.id=s2.demandinfoid";
		$strSql .= " left join subarea s3 on s2.subareaid=s3.id ";
		$strSql .= " where s3.id=$subareaid and s2.status=0 ";
		$strSql .= " and  d.isallowed=1 order by d.isstick desc, d.createtime desc   ";
		$demandinfolist = DBGetDataRowsSimple($strSql);
		
		
		$arrNewsList = array();
		foreach($arrNewsTypeNames as $name){
			$typeInfo = DBGetDataRowByField("newstype", "name", $name);
			if($typeInfo == null)
				continue;
			
			$descdata = DBGetDataRowByField("newslist", array("newstypeid", "isallowed"), array($typeInfo["id"], 1), " order by createtime desc ", " limit 0, 1 " );
			$typeInfo["list"] = $descdata;
			
			$arrNews = array();
			$typeid=$typeInfo["id"];
			$strSql = " select n1.* FROM `newslist` n1  ";
			$strSql .= " left join newssubarea n2 on n1.id=n2.newsid ";
			$strSql .= " left join subarea s on n2.subareaid=s.id  ";
			$strSql .= " where s.id=$subareaid ";
			$strSql .= " and n1.isallowed=1 and n2.status=0 and n1.newstypeid=$typeid ";
			$strSql .= "order by n1.id desc limit 0, 10 ";
			$data = DBGetDataRowsSimple($strSql);
			$typeInfo["news"] = $data;
			array_push($arrNewsList, $typeInfo);
		}
		
		
		$strSql = " select n1.title,n1.id as cid,n.name,n.id FROM `newslist` n1  ";
		$strSql .= " left join newstype n on n1.newstypeid=n.id ";
		$strSql .= " left join newssubarea n2 on n1.id=n2.newsid ";
		$strSql .= " left join subarea s on n2.subareaid=s.id  ";
		$strSql .= " where s.id=$subareaid ";
		$strSql .= " and n1.isallowed=1 and n2.status=0  ";
		$strSql .= " order by n1.isstick desc,n.sort asc,n1.createtime desc ";
		$result = DBGetDataRowsSimple($strSql);
		if($result == null){
			$newsinfoarr = null;
		}else{
			$list = array();
			for($i=0;$i<count($result);$i++){
				if(!isset($list[$result[$i]["id"]])){
					$list[$result[$i]["id"]] = array();
					$list[$result[$i]["id"]]["id"] = $result[$i]["id"];
					$list[$result[$i]["id"]]["name"] = $result[$i]["name"];
					$list[$result[$i]["id"]]["childnews"] = array();
				}
				if($result[$i]["cid"] == null)
					continue;
				$row = array();
				$row["id"] = $result[$i]["cid"];
				$row["title"] = $result[$i]["title"];
				array_push($list[$result[$i]["id"]]["childnews"],$row);
			}
			$newsinfoarr = array();//输出这个
			
			foreach($list as $o){
				$newsinfoarr[] = $o;
			}
		}
		$strSql = "select s1.id as imgid,s1.imgurl,s1.linkurl FROM `slideimginfo` s1 ";
		$strSql .= "left join slideimgsubarea s on s1.id=s.slideimgid ";
		$strSql .= "left join subarea s2 on s.subareaid=s2.id ";
		$strSql .= " where s2.id=$subareaid ";
		$strSql .= " order by s1.createtime desc ";
		$slideimginfo = DBGetDataRowsSimple($strSql);
	}
	
	

	/* $arrNewsList = array();
	foreach($arrNewsTypeNames as $name){
		$typeInfo = DBGetDataRowByField("newstype", "name", $name);
		if($typeInfo == null)
			continue;
		
		$descdata = DBGetDataRowByField("newslist", array("newstypeid", "isallowed"), array($typeInfo["id"], 1), " order by createtime desc ", " limit 0, 1 " );
		$typeInfo["list"] = $descdata;
		
		$arrNews = array();
		$data = DBGetDataRowsByField("newslist", array("newstypeid", "isallowed"), array($typeInfo["id"], 1), " order by id desc ", " limit 0, 10 " );
		$typeInfo["news"] = $data;
		array_push($arrNewsList, $typeInfo);
	} */
	
	$strSql = "select * FROM `cooperatagency` order by createtime desc ";//合作机构
	$cooperatagencylist = DBGetDataRowsSimple($strSql);
	
	$strSql = "select * FROM `footerfixed` order by createtime desc ";//页脚固定显示
	$footerfixed = DBGetDataRow($strSql);
	
	$strSql = "select * from `supplypaytype` ";
	$supplypaytype = DBGetDataRows($strSql);
	
	for($i=0; $i<count($supplyinfolist); $i++){
		$t = $supplyinfolist[$i]["paytypeid"];
		$supplyinfolist[$i]["paytypename"] = "";
		for($j=0; $j<count($supplypaytype); $j++){
			if($supplyinfolist[$i]["paytypeid"] == $supplypaytype[$j]["id"]){
				$supplyinfolist[$i]["paytypename"] = $supplypaytype[$j]["paytype"];
				break;
			}
		}
	}
	
	//demandselectprofession
	//professiontype

	//
	//页脚信息内容
	$strSql = "select f.id,f.name,f1.id as cid,f1.title,f1.content FROM `footervaried` f1  ";
	$strSql .= "left join footertype f on f1.footertypeid=f.id ";
	$result = DBGetDataRowsSimple($strSql);
	if($result == null){
		$footervariedlist =null;
	}else{
		$footerlist = array();
		for($i=0;$i<count($result);$i++){
			if(!isset($footerlist[$result[$i]["id"]])){
				$footerlist[$result[$i]["id"]] = array();
				$footerlist[$result[$i]["id"]]["id"] = $result[$i]["id"];
				$footerlist[$result[$i]["id"]]["name"] = $result[$i]["name"];
				$footerlist[$result[$i]["id"]]["childfooter"] = array();
			}
			if($result[$i]["cid"] == null)
				continue;
			$row = array();
			$row["id"] = $result[$i]["cid"];
			$row["title"] = $result[$i]["title"];
			$row["content"] = $result[$i]["content"];
			array_push($footerlist[$result[$i]["id"]]["childfooter"],$row);
		}
		$footervariedlist = array();
		
		foreach($footerlist as $o){
			$footervariedlist[] = $o;
		}
	}
	
	
	//公告
	$strSql = "select * FROM `webannounce` order by isstick desc, createtime desc ";
	$webannounceinfo = DBGetDataRowsSimple($strSql);
	
	/* echo '1'.json_encode($subarealist);
	echo '2'.json_encode($supplyinfolist);
	echo '3'.json_encode($demandinfolist);
	echo '4'.json_encode($supplierlist);
	echo '5'.json_encode($cooperatagencylist);
	echo '6'.json_encode($footerfixed);
	echo '7'.json_encode($footervariedlist);
	echo '8'.json_encode($arrNewsList);
	die(); */
	
	for($i=0; $i<count($footervariedlist); $i++){
		switch($footervariedlist[$i]["name"]){
			case "关于我们":
				$footervariedlist[$i]["icon"] = "fa fa-user";
				break;
			case "网站功能":
				$footervariedlist[$i]["icon"] = "fa fa-sitemap";
				break;
			case "关于用户":
				$footervariedlist[$i]["icon"] = "fa fa-address-book";
				break;
			case "网站声明":
				$footervariedlist[$i]["icon"] = "fa fa-file";
				break;
			default:
				$footervariedlist[$i]["icon"] = "fa fa-user";
				break;
		}
	}
	
	
	//$smarty->assign("letterlist",$letterlist);
	$smarty->assign("showname",$showname);
	$smarty->assign("subarealist",$subarealist);
	$smarty->assign("supplyinfolist",$supplyinfolist);
	$smarty->assign("demandinfolist",$demandinfolist);
	$smarty->assign("supplierlist",$supplierlist);
	$smarty->assign("cooperatagencylist",$cooperatagencylist);
	$smarty->assign("footerfixed",$footerfixed);
	$smarty->assign("footervariedlist",$footervariedlist);
	//$smarty->assign("newsinfoarr",$newsinfoarr);
	//$smarty->assign("webannounceinfo",$webannounceinfo);
	//$smarty->assign("slideimginfo",$slideimginfo);
	$smarty->assign("arrNewsList",$arrNewsList);
	$smarty->assign("ismodify",$ismodify);//判断当前身份是供方还是需方
	$smarty->assign("viewsupplyinforight",$viewsupplyinforight);//判断是否是需方登录
	$smarty->assign("viewdemandinforight",$viewdemandinforight);//判断是否是供方登录
	$smarty->assign("viewright",$viewright);//判断是否登录
	
	
	$smarty->clearCache('smartypage.new.tpl');
	//$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);//启动缓存
	if($subareaid!=""){
		$smarty->clearCache('smartypage.new.tpl',$subareaid);
		$smarty->display('smartypage.new.tpl',$subareaid);//根据不同的选择子站显示不同内容
	}else{
		$smarty->clearCache('smartypage.new.tpl');
		$smarty->display('smartypage.new.tpl');
	} 
?>