<?php
	include "paras.php";
	$mode = Get("mode");
	switch($mode){
		case "ShowList":
			$supplierdata = DBGetDataRowByField("supplierinfo",array("username"),array($_SESSION["suppliername"]));
			$supplierid=$supplierdata["id"];
			$strSql = " select b.supplierid as id,b.createtime,s.username,d.username as uname,d.mobile from suppliervisithistory b left join demanderinfo s on b.demanderid = s.id ";
			$strSql.= " left join supplierinfo d on b.supplierid = d.id";
			$strSql.= " where b.supplierid=$supplierid ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (s.username like '%" . $toLike . "%' or d.username like '%" . $toLike . "%' )";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			//echo $strSqlDetail;
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM suppliervisithistory where supplierid=$supplierid ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break; 
		/* case "ShowList":
			$supplierdata = DBGetDataRowByField("supplierinfo",array("username"),array($_SESSION["suppliername"]));
			$supplierid=$supplierdata["id"];
			$strSql = " select b.demanderid,b.createtime,s.username,d.username as uname,d.mobile from suppliervisithistory b left join demanderinfo s on b.demanderid = s.id ";
			$strSql.= " left join supplierinfo d on b.supplierid = d.id";
			$strSql.= " where b.supplierid=$supplierid";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break; */
		case "ShowdemandList":
			$demanderid = (int)(Get("id"));
			$strSql = "Select n.username,d.content,d.title,d.createtime,d.otherdesc from demandinfo d ";
			$strSql.= " left join demanderinfo n on d.demanderid = n.id ";
			$strSql.= " where d.demanderid=$demanderid ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (d.title like '%" . $toLike . "%') ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM demandinfo where demanderid=$demanderid ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break; 
		/* case "ShowdemandList":
			$demanderid = (int)(Get("id"));
			$strSql = "Select n.username,d.content,d.createtime,d.otherdesc from demandinfo d ";
			$strSql.= " left join demanderinfo n on d.demanderid = n.id where demanderid=$demanderid";
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