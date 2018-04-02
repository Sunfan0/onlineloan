<?php
	include "paras.php";
//需求详情
	include "smartyheader.new.php";
	
	$viewright=0;
	if(isset($_SESSION["suppliername"])){
		$viewright=1;
	}

	$demandinfoid = Get("demandinfoid");
	
	//$_SESSION["pageurl"]="smartyneed.new.php?demandinfoid=".$demandinfoid;
	
	$strSql = "select d.id,d.name,d.demandnum,d.demandtime,s.producttype,d.isallowed,d.demandstate,d.Applytime,d.otherdesc,d1.mobile,d.currentvisiblenum FROM `demandinfo` d ";
	$strSql.= " left join supplyproducttype s on d.demandtypeid=s.id ";
	$strSql.= " left join demanderinfo d1 on d.demanderid=d1.id ";
	$strSql.= " where d.id=$demandinfoid ";
	$needinfordetail = DBGetDataRow($strSql);
	
	$strSql = "select s2.name FROM `demandinfosubarea` s1";
	$strSql .= " left join subarea s2 on s1.subareaid=s2.id ";
	$strSql .= " where  s1.status=0 and s1.demandinfoid=$demandinfoid ";
	$subarea = DBGetDataRowsSimple($strSql);
	$needinfordetail["subarea"]=$subarea;
	
	$strSql = "select count(*) FROM `demandinfovisithistory` where demandinfoid=$demandinfoid ";
	$visitcount = DBGetDataRow($strSql);
	$needinfordetail["visitcount"]=$visitcount[0];
	
//推荐顾问
	$strSql = "select * FROM `supplierinfo` where id=12";
	$supplierdetail = DBGetDataRow($strSql);
	
	$strSql = "select s3.name FROM `supplierinfo` s1";
	$strSql .= " left join suppliersubarea s2 on s1.id=s2.supplierid ";
	$strSql .= " left join subarea s3 on s2.subareaid=s3.id ";
	$strSql .= " where  s2.status=0 and s1.id=12 ";
	$subarea = DBGetDataRowsSimple($strSql);
	$supplierdetail["subarea"]=$subarea;

//类似需求
	$strSql = "select d.id,d.name,d.demandnum,d.demandtime,s.producttype,d.isallowed,d.demandstate,d.Applytime,d.otherdesc,d1.mobile,d.currentvisiblenum FROM `demandinfo` d ";
	$strSql.= " left join supplyproducttype s on d.demandtypeid=s.id ";
	$strSql.= " left join demanderinfo d1 on d.demanderid=d1.id ";
	$strSql.= " order by d.Applytime desc ";
	$strSql.= " limit 0,3 ";
	$otherneedinfo = DBGetDataRowsSimple($strSql);
	
	for($i=0;$i<count($otherneedinfo);$i++){
		$demandinfoid=$otherneedinfo[$i]['id'];
		$strSql = "select s2.name FROM `demandinfosubarea` s1";
		$strSql .= " left join subarea s2 on s1.subareaid=s2.id ";
		$strSql .= " where  s1.status=0 and s1.demandinfoid=$demandinfoid ";
		$subarea = DBGetDataRowsSimple($strSql);
		$otherneedinfo[$i]["subarea"] = $subarea;
	}

/* echo json_encode($needinfordetail);	
echo json_encode($supplierdetail);
echo json_encode($otherneedinfo);
die(); */
	
	$smarty->assign("needinfordetail",$needinfordetail);
	$smarty->assign("supplierdetail",$supplierdetail);
	$smarty->assign("otherneedinfo",$otherneedinfo);
	$smarty->assign("viewright",$viewright);
	//$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);//启动缓存
	$smarty->display('smartyneed.new.tpl',$demandinfoid);
	include "smartyfooter.new.php";
?>