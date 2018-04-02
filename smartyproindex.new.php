<?php
	include "paras.php";
	include "smartyheader.new.php";
	$supplyinfoid = Get("supplyinfoid");
	
	$viewright=0;//未登录
	if(isset($_SESSION["demandername"])){
		if($_SESSION["demandername"]!=""){
			$viewright=1;//需方登录
		}
	}
	if(isset($_SESSION["suppliername"])){
		if($_SESSION["suppliername"]!=""){
			$viewright=2;//供方登录
		}
	}
	
	//$_SESSION["pageurl"]="smartyproindex.new.php?supplyinfoid=".$supplyinfoid;
//产品列表
	$strSql = "select s1.id,s1.supplierid,s1.productname,s1.paynum,s1.rate,s1.createtime,  ";
	$strSql .= " s2.property,s3.paytype,s4.worktime,s5.mobile ";//电话中间4位*号，点击后查看全部
	$strSql .= "FROM `supplyinfo` s1 ";
	$strSql .= "left join supplyneedproperty s2 on s1.needpropertyid=s2.id ";
	$strSql .= "left join supplypaytype s3 on s1.paytypeid=s3.id ";
	$strSql .= "left join supplyneedworktime s4 on s1.needworktimeid=s4.id ";
	$strSql .= "left join supplierinfo s5 on s1.supplierid=s5.id ";
	$strSql .= "where  s1.isallowed=1 order by s1.lastmodifytime desc ";
	$strSql .= " limit 0,7 ";
	$supplyinfolist = DBGetDataRowsSimple($strSql);
	for($i=0;$i<count($supplyinfolist);$i++){
		$supplierid=$supplyinfolist[$i]['supplierid'];
		$strSql = "select s2.name FROM `suppliersubarea` s1";
		$strSql .= " left join subarea s2 on s1.subareaid=s2.id ";
		$strSql .= " where s1.supplierid=$supplierid and s1.status=0 ";
		$subarea1 = DBGetDataRowsSimple($strSql);
		
		$supplyinfolist[$i]["subarea"] = $subarea1;
	} 
	/* $strSql = "select * FROM `suppliersubarea` s1";
	$subarea22 = DBGetDataRowsSimple($strSql); */
	//贷款列表
	$strSql = "select d.id,d.name,if(d.aptitude=1,'有车',if(d.aptitude=2,'有房','有车,有房')) as aptitude ,d.demandnum,s.producttype,d.isallowed,d.demandstate,d.Applytime,d.otherdesc,d1.mobile,d.createtime FROM `demandinfo` d ";
	$strSql.= " left join supplyproducttype s on d.demandtypeid=s.id ";
	$strSql.= " left join demanderinfo d1 on d.demanderid=d1.id ";
	$strSql.= " where d.isallowed=1 and demandstate=1 ";
	$strSql.= " order by d.Applytime desc ";
	$strSql.= " limit 0,7 ";
	$needinfolist = DBGetDataRowsSimple($strSql);
	
	for($i=0;$i<count($needinfolist);$i++){
		$demandinfoid=$needinfolist[$i]['id'];
		$strSql = "select s2.name FROM `demandinfosubarea` s1";
		$strSql .= " left join subarea s2 on s1.subareaid=s2.id ";
		$strSql .= " where  s1.status=0 and s1.demandinfoid=$demandinfoid ";
		$subarea2 = DBGetDataRowsSimple($strSql);
		$needinfolist[$i]["subarea"] = $subarea2;
	}
	/* $strSql = "select * FROM `demandinfosubarea` s1";
	$subarea22 = DBGetDataRowsSimple($strSql); */
//顾问列表
	$perpage=7;
	$currentpage = 1;
	$currentpage=$currentpage-1;
	$p=$currentpage*$perpage;
	
	$strSql = "select * from supplierinfo s1 ";
	$strSql .= "where  s1.isallowed=1 and s1.imgurl!='' and isblacklist!=1 order by s1.lastmodifytime desc ";
	$strSql .= " limit $p,$perpage ";
	//echo $strSql;
	$detail = DBGetDataRowsSimple($strSql);
	for($i=0;$i<count($detail);$i++){
		$supplierid=$detail[$i]['id'];
		$strSql = "select s2.name FROM `suppliersubarea` s1";
		$strSql .= " left join subarea s2 on s1.subareaid=s2.id ";
		$strSql .= " where s1.supplierid=$supplierid and s1.status=0 ";
		$subarea3 = DBGetDataRowsSimple($strSql);
		
		$detail[$i]["subarea"] = $subarea3;
	}
	
	$strSql= "select  count(*) as total from supplierinfo  where isallowed=1 ";
	$result = DBGetDataRow($strSql);
	
	$supplierlist['data']=$detail;
	$supplierlist['total']=$result['total'];
	$supplierlist["pagecount"]=ceil($supplierlist["total"]/$perpage);
	$supplierlist["perpage"]=$perpage;
//最新资讯
	$strSql = " select * FROM `newslist` order by createtime limit 0,9 ";
	$newslist = DBGetDataRowsSimple($strSql);
	
//找产品
//贷款金额
	$strSql = "Select distinct(paynum) from supplyinfo where isallowed=1 and paynum!='' ";
	$paynum = DBGetDataRowsSimple($strSql);
//贷款期限
	$strSql = "Select distinct(paytime) from supplyinfo where isallowed=1 and paytime!='' ";
	$paytime = DBGetDataRowsSimple($strSql);
//职业身份
	$strSql = "Select * from professiontype ";
	$profession = DBGetDataRowsSimple($strSql);
//资产类型
	$strSql = "Select * from supplyneedproperty ";
	$property = DBGetDataRowsSimple($strSql);
//信用情况
	$strSql = "Select * from needcredit ";
	$credit = DBGetDataRowsSimple($strSql);
//所在省份（现在数据库里都是市）
	$strSql = "select * FROM `subarea` where isshow=1 order by sort asc ";
	$subarea = DBGetDataRowsSimple($strSql);
//产品类型
	$strSql = "Select * from supplyproducttype ";
	$producttype = DBGetDataRowsSimple($strSql);
//找贷款
//贷款金额
	$strSql = "Select distinct(demandnum) from demandinfo where isallowed=1 and demandnum!='' ";
	$demandnum = DBGetDataRowsSimple($strSql);
//职业身份。同上
//房产类型，是否有车（页面写的选项）
//信用情况，同上
//所在省份，同上
//找顾问
//echo json_encode($needinfolist);
/* echo json_encode($profession);
echo json_encode($property);
echo json_encode($credit);
echo json_encode($subarea);
echo json_encode($producttype);
echo json_encode($supplyinfolist);
echo json_encode($needinfolist);
echo json_encode($supplierlist);
echo json_encode($newslist);
die(); */ 

	$smarty->assign("paytime",$paytime);
	$smarty->assign("paynum",$paynum);
	$smarty->assign("demandnum",$demandnum);
	
	$smarty->assign("profession",$profession);
	$smarty->assign("property",$property);
	$smarty->assign("credit",$credit);
	$smarty->assign("subarea",$subarea);
	$smarty->assign("producttype",$producttype);
	$smarty->assign("supplyinfolist",$supplyinfolist);
	$smarty->assign("needinfolist",$needinfolist);
	$smarty->assign("supplierlist",$supplierlist);
	$smarty->assign("newslist",$newslist);
	$smarty->assign("supplyinfoid",$supplyinfoid);
	$smarty->assign("viewright",$viewright);
	
	$smarty->clearCache('smartyproindex.new.tpl');
	//$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);//启动缓存
	$smarty->display('smartyproindex.new.tpl');
	include "smartyfooter.new.php";

?>