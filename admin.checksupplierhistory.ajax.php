<?php
	include "paras.php";
	if(!CheckRights3("bgauditrecord")){
		echo 123;
		die();
	}
	$mode = Get("mode");
	switch($mode){
		case "ShowSupplierList":
			$strSql = " SELECT s1.id,s1.registtime,s1.username,s1.type,s.isallowed,s.reason,s.operattime,s.operator FROM `suppliercheckhistory` s ";
			$strSql .= " left join supplierinfo s1 on s.supplierid=s1.id ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "where (s1.username like '%" . $toLike . "%') or (s1.mobile like '%" . $toLike . "%') ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM  suppliercheckhistory  ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		/* case "ShowSupplierList":
			$currentpage = Get("currentpage");
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;

			$strSql = " SELECT s1.id,s1.registtime,s1.username,s1.type,s.isallowed,s.reason,s.operattime,s.operator FROM `suppliercheckhistory` s ";
			$strSql .= " left join supplierinfo s1 on s.supplierid=s1.id ";
			$strSql .= " order by s.operattime desc ";
			$strSql .= " limit $p,$perpage ";
			$detail = DBGetDataRowsSimple($strSql);
		
			$strSql= "select  count(*) as total from suppliercheckhistory ";
			$result = DBGetDataRow($strSql);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
			break; */
		case "ShowSupplierDetail":
			$id = Get("id");
			$strSql = "Select * from supplierinfo ";
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