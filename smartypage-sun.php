<?php
	include "paras.php";
	
	$subareaid = Get("subareaid");
	$strSql = "select distinct firstletter FROM `subarea` order by firstletter asc ";
	$letterlist = DBGetDataRowsSimple($strSql);
	
	$strSql = "select * FROM `subarea` order by createtime desc ";
	$subarealist = DBGetDataRowsSimple($strSql);
	
//关于资讯回复，产品回复还没添加
	if($subareaid==""){
		$strSql = "select * FROM `supplyinfo` where isallowed=1 order by isstick desc,createtime desc ";//贷款产品列表
		$supplyinfolist = DBGetDataRowsSimple($strSql);
		
		$strSql = "select * FROM `supplierinfo` where isallowed=1  order by createtime desc ";//供方列表
		$supplierlist = DBGetDataRowsSimple($strSql);
		
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
		$strSql .= " order by s1.isstick desc,s1.createtime desc  ";
		$supplyinfolist = DBGetDataRowsSimple($strSql);
	
		$strSql = "select s1.* FROM `supplierinfo` s1 ";//供方列表
		$strSql .= " left join suppliersubarea s2 on s1.id=s2.supplierid";
		$strSql .= " left join subarea s3 on s2.subareaid=s3.id ";
		$strSql .= " where s3.id=$subareaid and s2.status=0 ";
		$strSql .= " and s1.isallowed=1  order by s1.createtime desc   ";
		$supplierlist = DBGetDataRowsSimple($strSql);
		
		
		$strSql = " select n1.title,n1.id as cid,n.name,n.id FROM `newslist` n1  ";
		$strSql .= " left join newstype n on n1.newstypeid=n.id ";
		$strSql .= " left join newssubarea n2 on n1.id=n2.newsid ";
		$strSql .= " left join subarea s on n2.subareaid=s.id  ";
		$strSql .= " where s.id=$subareaid ";
		$strSql .= " and n1.isallowed=1 and n2.status=0 ";
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
	
	$strSql = "select * FROM `demandinfo` where isallowed=1 order by isstick desc, createtime desc ";//需求信息列表
	$demandinfolist = DBGetDataRowsSimple($strSql);
	
	$strSql = "select * FROM `cooperatagency` order by createtime desc ";//合作机构
	$cooperatagencylist = DBGetDataRowsSimple($strSql);
	
	$strSql = "select * FROM `footerfixed` order by createtime desc ";//页脚固定显示
	$footerfixed = DBGetDataRow($strSql);

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
	
	/* echo json_encode($subarealist);
	echo json_encode($supplyinfolist);
	echo json_encode($demandinfolist);
	echo json_encode($supplierlist);
	echo json_encode($cooperatagencylist);
	echo json_encode($footerfixed);
	echo json_encode($footervariedlist);
	echo json_encode($webannounceinfo);
	echo json_encode($newsinfoarr);
	echo json_encode($footervariedlist); */
	
	
	$smarty->assign("letterlist",$letterlist);
	$smarty->assign("subarealist",$subarealist);
	$smarty->assign("supplyinfolist",$supplyinfolist);
	$smarty->assign("demandinfolist",$demandinfolist);
	$smarty->assign("supplierlist",$supplierlist);
	$smarty->assign("cooperatagencylist",$cooperatagencylist);
	$smarty->assign("footerfixed",$footerfixed);
	$smarty->assign("footervariedlist",$footervariedlist);
	$smarty->assign("newsinfoarr",$newsinfoarr);
	$smarty->assign("webannounceinfo",$webannounceinfo);
	$smarty->assign("slideimginfo",$slideimginfo);
	
	
	$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);//启动缓存
	if($subareaid!=""){
		$smarty->display('smartypage-sun.tpl',$subareaid);//根据不同的选择子站显示不同内容
	}else{
		$smarty->display('smartypage-sun.tpl');
	} 
?>