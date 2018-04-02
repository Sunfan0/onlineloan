<?php
	include "paras.php";
	$mode = Get("mode");
	switch($mode){
		case "ShowSupplyList":
			$supplierdata = DBGetDataRowByField("supplierinfo",array("username"),array($_SESSION["suppliername"]));
			$supplierid=$supplierdata["id"];
			$strSql = " select s.id,s.productname,s.operattime,s.Featuresintroduce,IFNULL(d.cnt,0)as cnt from supplyinfo s";
			$strSql.= " left join (select count(*) as cnt,supplyinfoid from supplyinfovisithistory group by supplyinfoid )d on s.id = d.supplyinfoid ";
			$strSql.= " where s.supplierid=$supplierid ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (s.productname like '%" . $toLike . "%')";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM supplyinfo where supplierid=$supplierid ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break; 
		/* case"ShowSupplyList":
			$supplierdata = DBGetDataRowByField("supplierinfo",array("username"),array($_SESSION["suppliername"]));
			$supplierid=$supplierdata["id"];
			$strSql = " select s.id,s.productname,s.operattime,s.Featuresintroduce,IFNULL(d.cnt,0)as cnt from supplyinfo s";
			$strSql.= " left join (select count(*) as cnt,supplyinfoid from supplyinfovisithistory group by supplyinfoid )d on s.id = d.supplyinfoid ";
			$strSql.= " where s.supplierid=$supplierid";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break; */
			//
		case "ShowdamandList":
			$supplyinfoid = (int)(Get("id"));
			$strSql = "select d.username,s.visittime,s.staytime,d.mobile from supplyinfovisithistory s ";
			$strSql.= " left join demanderinfo d on s.demanderid=d.id ";
			$strSql.= " where s.supplyinfoid=$supplyinfoid ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (d.username like '%" . $toLike . "%') ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM supplyinfovisithistory where supplyinfoid=$supplyinfoid ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break; 
		/* case "ShowdamandList"://查看者列表
			$supplyinfoid = (int)(Get("id"));
			$strSql = "select d.username,s.visittime,s.staytime,d.mobile from supplyinfovisithistory s ";
			$strSql.= " left join demanderinfo d on s.demanderid=d.id ";
			$strSql.= " where s.supplyinfoid=$supplyinfoid ";
			$data = DBGetDataRowsSimple($strSql); 
			echo json_encode($data);
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
//
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