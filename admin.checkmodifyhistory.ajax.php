<?php
	include "paras.php";
	if(!CheckRights3("bgauditrecord")){
		echo 123;
		die();
	}
	$mode = Get("mode");
	switch($mode){
		case "ShowmodifyList":
			$strSql = " SELECT s.id,s.isallowed,s.createtime,s.operator,s.operattime,s1.username as name FROM `supplieridentityconfirm` s ";
			$strSql .= " left join supplierinfo s1 on s.supplierid=s1.id ";
			$strSql .= " Where s.isallowed!=0 ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (s1.username like '%" . $toLike . "%')  ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			//echo $strSqlDetail;
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM  supplieridentityconfirm Where isallowed!=0  ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		/* case "ShowmodifyList":
			$currentpage = Get("currentpage");
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;
			$strSql = " SELECT * FROM `supplieridentityconfirm` s ";
			$strSql .= "Where s.isallowed!=0  ";
			$strSql .= " order by s.createtime desc ";
			$strSql .= " limit $p,$perpage ";
			$detail = DBGetDataRowsSimple($strSql);
		
			$strSql= "select  count(*) as total from supplieridentityconfirm Where isallowed!=0 ";
			$result = DBGetDataRow($strSql);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
			break; */
		case "ShowmodifyDetail":
			$id = Get("id");
			$strSql = "Select * from supplieridentityconfirm  ";
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