<?php
	include "paras.php";
	include "smartyheader.new.php";
	$supplyinfoid = Get("supplyinfoid");
	
	$viewright=0;//未登录
	if($_SESSION["demandername"]!=""){
		$viewright=1;//需方登录
	}
	if($_SESSION["suppliername"]!=""){
		$viewright=2;//供方登录
	}
	//$_SESSION["pageurl"]="smartyproductsdetails.new.php?supplyinfoid=".$supplyinfoid;
	
	$strSql = "select s1.supplierid,s1.productname,s1.paynum,s1.rate,s1.needage,s1.needindustry,s1.Featuresintroduce, ";
	$strSql .= " s2.income,s3.worktime ";
	$strSql .= " FROM `supplyinfo` s1 ";
	$strSql .= "left join supplyneedincome s2 on s1.needincomeid=s2.id ";
	$strSql .= "left join supplyneedworktime s3 on s1.needworktimeid=s3.id ";
	$strSql .= " where s1.id=$supplyinfoid ";
//echo $strSql;
	$supplyinfodetail = DBGetDataRow($strSql);
	$strSql = "select s4.name FROM `supplyinfo` s1";
	$strSql .= " left join supplierinfo s2 on s1.supplierid=s2.id ";
	$strSql .= " left join suppliersubarea s3 on s2.id=s3.supplierid ";
	$strSql .= " left join subarea s4 on s3.subareaid=s4.id ";
	$strSql .= " where s1.id=$supplyinfoid and  s1.isallowed=1 and s3.status=0 ";
//echo $strSql;
	$subarea = DBGetDataRowsSimple($strSql);//地点
	$supplyinfodetail["subarea"]=$subarea;
	$strSql = "select s3.identity FROM `supplyinfo` s1";
	$strSql .= " left join supplyselectidentity s2 on s1.id=s2.supplyinfoid ";
	$strSql .= " left join supplyneedidentity s3 on s2.identityid=s3.id ";
	$strSql .= " where s1.id=$supplyinfoid and  s1.isallowed=1 and s2.status=0 ";
	//echo $strSql;
	$identity = DBGetDataRowsSimple($strSql);
	$supplyinfodetail["identity"]=$identity;//身份要求

	//该中介发布的所有产品
	$perpage=20;
	$currentpage = 1;
	$currentpage=$currentpage-1;
	$p=$currentpage*$perpage;
	$supplierid=$supplyinfodetail["supplierid"];
	
	$strSql = "select s1.id,s1.productname,s1.paynum,s1.rate,s1.createtime,  ";
	$strSql .= " s2.property,s3.paytype,s4.worktime,s5.mobile ";//电话中间4位*号，点击后查看全部
	$strSql .= "FROM `supplyinfo` s1 ";
	$strSql .= "left join supplyneedproperty s2 on s1.needpropertyid=s2.id ";
	$strSql .= "left join supplypaytype s3 on s1.paytypeid=s3.id ";
	$strSql .= "left join supplyneedworktime s4 on s1.needworktimeid=s4.id ";
	$strSql .= "left join supplierinfo s5 on s1.supplierid=s5.id ";
	$strSql .= "where s1.supplierid=$supplierid and s1.id!=$supplyinfoid and s1.isallowed=1 order by s1.lastmodifytime desc ";
	$strSql .= " limit $p,$perpage ";
	//echo $strSql;
	$detail = DBGetDataRowsSimple($strSql);
	$strSql= "select  count(*) as total from supplyinfo  where isallowed=1 and supplierid=$supplierid and id!=$supplyinfoid ";
	$result = DBGetDataRow($strSql);
	
	$strSql = "select s4.name FROM `supplyinfo` s1";
	$strSql .= " left join supplierinfo s2 on s1.supplierid=s2.id ";
	$strSql .= " left join suppliersubarea s3 on s2.id=s3.supplierid ";
	$strSql .= " left join subarea s4 on s3.subareaid=s4.id ";
	$strSql .= " where  s1.isallowed=1 and s3.status=0 and s1.id=$supplyinfoid and s2.id=$supplierid ";
	$subarea = DBGetDataRowsSimple($strSql);
	$supplyinfolist["subarea"]=$subarea;
	$supplyinfolist['data']=$detail;
	$supplyinfolist['total']=$result['total'];
	$supplyinfolist["pagecount"]=ceil($supplyinfolist["total"]/$perpage);
	$supplyinfolist["perpage"]=$perpage;



	$strSql = "select * FROM `supplierinfo` where id=$supplierid";
	$supplierdetail = DBGetDataRow($strSql);
	
	$strSql = "select s3.name FROM `supplierinfo` s1";
	$strSql .= " left join suppliersubarea s2 on s1.id=s2.supplierid ";
	$strSql .= " left join subarea s3 on s2.subareaid=s3.id ";
	$strSql .= " where  s2.status=0 and s1.id=$supplierid";
	$subarea = DBGetDataRowsSimple($strSql);
	$supplierdetail["subarea"]=$subarea;

/* echo json_encode($supplyinfolist);
echo json_encode($supplyinfodetail);
echo json_encode($supplierdetail);
die(); */ 
	$smarty->assign("viewright",$viewright);
	$smarty->assign("supplierdetail",$supplierdetail);
	$smarty->assign("supplyinfolist",$supplyinfolist);
	$smarty->assign("supplyinfodetail",$supplyinfodetail);
	
	$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);//启动缓存
	$smarty->display('smartyproductsdetails.new.tpl',$supplyinfoid);
	include "smartyfooter.new.php";

?>