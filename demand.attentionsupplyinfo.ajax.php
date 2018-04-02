<?php
	include "paras.php";
	$perpage = 30;
	$mode = Get("mode");
	switch($mode){
		case "ShowSupplyinfoList":
			$demanderdata = DBGetDataRowByField("demanderinfo",array("username"),array($_SESSION["demandername"]));
			$demanderid=$demanderdata["id"];
			$strSql = " SELECT s.focustime,s.supplyinfoid,s1.productname,s2.username,s1.producttype ";
			$strSql .= "  FROM `supplyinfofocushistory` s";
			$strSql .= " left join supplyinfo s1 on s.supplyinfoid=s1.id ";
			$strSql .= " left join supplierinfo s2 on s1.supplierid=s2.id  ";
			$strSql .= " Where s.demanderid= $demanderid ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (s1.productname like '%" . $toLike . "%' or s2.username like '%" . $toLike . "%') ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM supplyinfofocushistory where demanderid= $demanderid ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		/* case "ShowSupplyinfoList"://当前需方关注的供方产品信息
			$currentpage = Get("currentpage");
			$demanderdata = DBGetDataRowByField("demanderinfo",array("username"),array($_SESSION["demandername"]));
			$demanderid=$demanderdata["id"];
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;
			$strSql = " SELECT s.focustime,s.supplyinfoid,s1.productname,s2.username,s1.producttype ";
			$strSql .= "  FROM `supplyinfofocushistory` s";
			$strSql .= " left join supplyinfo s1 on s.supplyinfoid=s1.id ";
			$strSql .= " left join supplierinfo s2 on s1.supplierid=s2.id  ";
			$strSql .= " Where s.demanderid= $demanderid ";
			$strSql .= " order by s.focustime desc ";
			$strSql .= " limit $p,$perpage ";
			$detail = DBGetDataRowsSimple($strSql);
		
			$strSql= "select  count(*) as total from supplyinfofocushistory Where demanderid =$demanderid ";
			$result = DBGetDataRow($strSql);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
			
			break; */
		case "ShowSupplyinfoDetail"://关注的产品详情
			$supplyinfoid = Get("supplyinfoid");
			$strSql = " SELECT * FROM `supplyinfo` where id=$supplyinfoid ";
			$detailInfo = DBGetDataRow($strSql);
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
				$strWhere = "  order by $columnName $orderDir ";
			}
		}
		$strLimit = " limit $start , $length ";
		
		return array("where" => $strWhere , "limit" => $strLimit);
	}
?>