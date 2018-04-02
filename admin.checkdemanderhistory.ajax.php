<?php
	include "paras.php";
	if(!CheckRights3("bgauditrecord")){
		echo 123;
		die();
	}
	$mode = Get("mode");
	switch($mode){
		case "ShowdemanderList":
			$strSql = " SELECT d1.id,d1.registtime,d1.username,d.isallowed,d.reason,d.operattime,d.operator FROM `demandercheckhistory` d ";
			$strSql .= " left join demanderinfo d1 on d.demanderid=d1.id ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "where (d1.username like '%" . $toLike . "%') or (d1.mobile like '%" . $toLike . "%') ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM  demandercheckhistory  ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		/* case "ShowdemanderList":
			$currentpage = Get("currentpage");
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;

			$strSql = " SELECT d1.id,d1.registtime,d1.username,d.isallowed,d.reason,d.operattime,d.operator FROM `demandercheckhistory` d ";
			$strSql .= " left join demanderinfo d1 on d.demanderid=d1.id ";
			$strSql .= " order by d.operattime desc ";
			$strSql .= " limit $p,$perpage ";
			$detail = DBGetDataRowsSimple($strSql);
		
			$strSql= "select  count(*) as total from demandercheckhistory ";
			$result = DBGetDataRow($strSql);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
			break; */
		case "ShowdemanderDetail":
			$id = Get("id");
			$strSql = "Select * from demanderinfo ";
			$strSql.= " where id=$id ";
			$data = DBGetDataRow($strSql);
			echo json_encode($data);
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