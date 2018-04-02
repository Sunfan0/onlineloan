<?php
	include "paras.php";
	$perpage = 30;
	$mode = Get("mode");
	switch($mode){
		case "ShowList":
			$strSql = "select * from supplyinfo s ";
			$strSql .="  where s.isallowed=1 ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (s.productname like '%" . $toLike . "%') ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM supplyinfo  where isallowed=1 ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		/* case"ShowList"://供方产品列表
			$currentpage = Get("currentpage");
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;
			$strSql = "select * from supplyinfo  where isallowed=1 order by createtime desc ";
			$strSql .= " limit $p,$perpage ";
			$detail = DBGetDataRowsSimple($strSql);
			$strSql= "select  count(*) as total from supplyinfo Where isallowed=1 ";
			$result = DBGetDataRow($strSql);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
			break; */
		case "ShowreplyDetail":
			$supplyinfoid = Get("supplyinfoid");
			$demanderdata = DBGetDataRowByField("demanderinfo",array("username"),array($_SESSION["demandername"]));
			$demanderid=$demanderdata["id"];
			$strSql = " SELECT * FROM `supplyinforeply`  s ";
			$strSql .="  where s.supplyinfoid=$supplyinfoid and s.demanderid=$demanderid ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (s.content like '%" . $toLike . "%') ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM supplyinforeply  where supplyinfoid=$supplyinfoid and demanderid=$demanderid ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
	/* 	case "ShowreplyDetail"://回复列表
			$supplyinfoid = Get("supplyinfoid");
			$demanderdata = DBGetDataRowByField("demanderinfo",array("username"),array($_SESSION["demandername"]));
			$demanderid=$demanderdata["id"];
			$strSql = " SELECT * FROM `supplyinforeply` where supplyinfoid=$supplyinfoid and demanderid=$demanderid order by replytime";
			$detailInfo = DBGetDataRowsSimple($strSql);
			echo json_encode($detailInfo);
			break; */
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
				$strWhere = "  order by $columnName $orderDir ";
			}
		}
		$strLimit = " limit $start , $length ";
		
		return array("where" => $strWhere , "limit" => $strLimit);
	}
?>