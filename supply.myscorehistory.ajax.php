<?php
	include "paras.php";
	$mode = Get("mode");
	switch($mode){
		case "ShowList":
			$supplierdata = DBGetDataRowByField("supplierinfo",array("username"),array('weilina'));
			$supplierid=$supplierdata["id"];
			$strSql	="select * from supplierscorehistory s";
			$strSql .= " where s.supplierid=$supplierid ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (s.reason like '%" . $toLike . "%')";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM supplierscorehistory where supplierid=$supplierid ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break; 
		/* case"ShowList":
			$pagenow=Get("page");
			$prevpage=$pagenow-1;
			$pagesize=10;
			$supplierdata = DBGetDataRowByField("supplierinfo",array("username"),array($_SESSION["suppliername"]));
			$supplierid=$supplierdata["id"];
			$start= $prevpage*$pagesize;
			$strSql = "select count(*) as id from supplierscorehistory where supplierid=$supplierid";
			$result = DBGetDataRow($strSql);
			$datanum= $result["id"];
			$pagecount =ceil($datanum/$pagesize);
			$strSqls="select reason,beforescore,changescore,afterscore,operator,operattime from supplierscorehistory";
			$strSqls .= " where supplierid=$supplierid";
			$strSqls .= " limit $start,$pagesize";
			$datas = DBGetDataRowsSimple($strSqls);
			$dataInfo["data"]=$datas;
			$dataInfo["datanum"]=$datanum;
			$dataInfo["pagecount"]=$pagecount;
			echo json_encode($dataInfo);
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