<?php
	include "paras.php";
	$mode = Get("mode");
	$perpage = 30;
	if(!CheckRights3("bgscore")){
		echo 123;
		die();
	}
	switch($mode){
 		case "SupplierScore":
			$strSql = "Select c.id,c.username,c.score as afterscore,IFNULL(c1.getscore,0) as getscore,IFNULL(c2.changescore,0) as changescore from supplierinfo c ";
			$strSql .= " left join (select supplierid,sum(changescore) as getscore from supplierscorehistory where changetype=1 group by supplierid ) c1 on c.id=c1.supplierid ";
			$strSql .= " left join (select supplierid,sum(changescore) as changescore from  supplierscorehistory where changetype=-1 group by supplierid ) c2 on c.id=c2.supplierid ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "where c.username like '%" . $toLike . "%' ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRows($strSqlDetail);
			$strSqlCountAll = " Select count(*) FROM supplierinfo where isallowed=1 ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		case "SupplierScoreDetail":
			$supplierid = Get("supplierid");
			$currentpage = Get("currentpage");
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;
			$strSql = "Select c.beforescore,c.changescore,c.afterscore,c.reason,c.operattime from supplierscorehistory c  ";
			$strSql .= " where c.supplierid=$supplierid ";
			$strSql .= " limit $p,$perpage";
			$detail = DBGetDataRowsSimple($strSql);
			$strSql= "select  count(*) as total from supplierscorehistory WHERE supplierid=$supplierid ";//
			$result = DBGetDataRow($strSql);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
			break; 
	}
	function GetPageParas(){
		$start = Get("start");
		$length = Get("length");
		$search = Get("search[value]");
		$columns = Get("columns");
		$orders = Get("order");
		$strWhere = "";
//myecho(count($orders));
		if(count($orders) > 0){
			if($orders[0]["column"] != ""){
				$columnName = $columns[$orders[0]["column"]]["data"];
				$orderDir = $orders[0]["dir"];
				$strWhere = " order by $columnName $orderDir ";
			}
		}
		$strLimit = " limit $start , $length ";
		
		return array("where" => $strWhere , "limit" => $strLimit);
	} 
?>