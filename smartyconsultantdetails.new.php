<?php
	include "paras.php";
	include "smartyheader.new.php";
	$supplierid = Get("supplierid");
	//$_SESSION["pageurl"]="smartyconsultantdetails.new.php?supplierid=".$supplierid;
	$strSql = "select * FROM `supplierinfo` where id=$supplierid";
	$supplierdetail = DBGetDataRow($strSql);
	
	$strSql = "select s2.name FROM `suppliersubarea` s1";
	$strSql .= " left join subarea s2 on s1.subareaid=s2.id ";
	$strSql .= " where  s1.status=0 and s1.supplierid=$supplierid ";
	$subarea = DBGetDataRowsSimple($strSql);
	$supplierdetail["subarea"]=$subarea;
	
	//该中介发布的所有产品
	$perpage=20;
	$currentpage = 1;
	$currentpage=$currentpage-1;
	$p=$currentpage*$perpage;
	
	$strSql = "select s1.id,s1.productname,s1.rate,s1.createtime,  ";
	$strSql .= " s2.worktime,s3.mobile,s4.income  ";//电话中间4位*号，点击后查看全部
	$strSql .= "FROM `supplyinfo` s1 ";
	$strSql .= "left join supplyneedworktime s2 on s1.needworktimeid=s2.id ";
	$strSql .= "left join supplierinfo s3 on s1.supplierid=s3.id ";
	$strSql .= "left join supplyneedincome s4 on s1.needincomeid=s4.id ";
	$strSql .= "where s1.supplierid=$supplierid and s1.isallowed=1 order by s1.lastmodifytime desc ";
	$strSql .= " limit $p,$perpage ";
	//echo $strSql;
	$detail = DBGetDataRowsSimple($strSql);
	$strSql= "select  count(*) as total from supplyinfo  where isallowed=1 and supplierid=$supplierid  ";
	$result = DBGetDataRow($strSql);
	
	$supplyinfolist['data']=$detail;
	$supplyinfolist['total']=$result['total'];
	$supplyinfolist["pagecount"]=ceil($supplyinfolist["total"]/$perpage);
	$supplyinfolist["perpage"]=$perpage;

	/* $strSql = "select * FROM `supplyinfo` where supplierid=$supplierid";
	$supply = DBGetDataRow($strSql); */
	
/* echo json_encode($supply);
echo json_encode($supplierdetail);
echo json_encode($supplyinfolist);		
die();  */
	
	$smarty->assign("supplierdetail",$supplierdetail);
	$smarty->assign("supplyinfolist",$supplyinfolist);
	
	//$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);//启动缓存
	$smarty->display('smartyconsultantdetails.new.tpl',$supplierid);
	
	include "smartyfooter.new.php";
?>