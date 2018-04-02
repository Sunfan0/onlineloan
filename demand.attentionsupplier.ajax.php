<?php
	include "paras.php";
	$perpage = 30;
	$mode = Get("mode");
	switch($mode){
		case "ShowSupplierList":
			$demanderdata = DBGetDataRowByField("demanderinfo",array("username"),array($_SESSION["demandername"]));
			$demanderid=$demanderdata["id"];
			$strSql = " SELECT s1.id,s.focustime,s.supplierid,s1.username,s1.mobile,s1.type ";
			$strSql .= "  FROM `supplierfocushistory` s";
			$strSql .= " left join supplierinfo s1 on s.supplierid=s1.id ";
			$strSql .= " Where s.demanderid= $demanderid ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (s1.username like '%" . $toLike . "%' or s1.mobile like '%" . $toLike . "%') ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM supplierfocushistory where demanderid= $demanderid ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		/* case "ShowSupplierList"://当前需方关注的供方信息
			$currentpage = Get("currentpage");
			$demanderdata = DBGetDataRowByField("demanderinfo",array("username"),array($_SESSION["demandername"]));
			$demanderid=$demanderdata["id"];
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;
			$strSql = " SELECT s.focustime,s.supplierid,s1.username,s1.mobile,s1.type ";
			$strSql .= "  FROM `supplierfocushistory` s";
			$strSql .= " left join supplierinfo s1 on s.supplierid=s1.id ";
			$strSql .= " Where s.demanderid= $demanderid ";
			$strSql .= " order by s.focustime desc ";
			$strSql .= " limit $p,$perpage ";
			$detail = DBGetDataRowsSimple($strSql);
		
			$strSql= "select  count(*) as total from supplierfocushistory Where demanderid =$demanderid ";
			$result = DBGetDataRow($strSql);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
			break; */
		case "ShowSupplierDetail"://关注的供方详情
			$supplierid = Get("supplierid");
			$strSql = " SELECT * FROM `supplierinfo` where id=$supplierid ";
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