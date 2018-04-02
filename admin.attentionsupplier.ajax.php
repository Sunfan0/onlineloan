<?php
	include "paras.php";
	if(!CheckRights3("bginteract")){
		echo 123;
		die();
	}
	$perpage = 30;
	$mode = Get("mode");
	switch($mode){
		case "ShowSupplierList":
			$strSql = " SELECT * FROM `supplierinfo` d ";
			$strSql .= " Where d.isallowed =1 ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= " and  (d.username like '%" . $toLike . "%' or d.mobile like '%" . $toLike . "%') ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM supplierinfo Where isallowed =1 ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		/* case "ShowSupplierList"://供方列表
			$currentpage = Get("currentpage");
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;
			$strSql = " SELECT * FROM `supplierinfo` s ";
			$strSql .= " Where isallowed =1 ";
			$strSql .= " order by createtime desc ";
			$strSql .= " limit $p,$perpage ";
			$detail = DBGetDataRowsSimple($strSql);
		
			$strSql= "select  count(*) as total from supplierinfo Where isallowed =1 ";
			$result = DBGetDataRow($strSql);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
			break; */
		case "ShowDemanderList":
			$supplierid = Get("supplierid");
			$strSql = " SELECT s.focustime,d1.username,d1.mobile FROM `supplierfocushistory` s ";
			$strSql .= " left join demanderinfo d1 on s.demanderid=d1.id ";
			$strSql .= " where s.supplierid=$supplierid ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= " and  (d1.username like '%" . $toLike . "%' or d1.mobile like '%" . $toLike . "%') ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM supplierfocushistory Where supplierid=$supplierid  ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
	/* 	case "ShowDemanderList"://查看供方信息的需方
			$supplierid = Get("supplierid");
			$currentpage = Get("currentpage");
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;
			$strSql = " SELECT s.focustime,d1.username,d1.mobile FROM `supplierfocushistory` s ";
			$strSql .= " left join demanderinfo d1 on s.demanderid=d1.id ";
			$strSql .= " where s.supplierid=$supplierid ";
			$strSql .= " order by s.focustime asc ";
			$strSql .= " limit $p,$perpage ";
			$detail = DBGetDataRowsSimple($strSql);
		
			$strSql= "select  count(*) as total from supplierfocushistory Where supplierid=$supplierid ";
			$result = DBGetDataRow($strSql);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
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