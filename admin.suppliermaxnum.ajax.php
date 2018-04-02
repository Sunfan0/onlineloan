<?php
	include "paras.php";
	if(!CheckRights3("bgset")){
		echo 123;
		die();
	}
	$mode = Get("mode");
	switch($mode){
		case "SetMaxnum":
			$id = Get("id");
			$productmaxnum = Get("productmaxnum");
			$newsmaxnum = Get("newsmaxnum");
			$r=DBUpdateField("scorerule",$id,array("productmaxnum","newsmaxnum"),array($productmaxnum,$newsmaxnum));
			if($r)
				echo 1;
			else
				echo -1;
			break;
		case "ShowSupplierList":
			$strSql = " SELECT s.*,if(s.type=1,'中介','机构') as type FROM `supplierinfo` s ";
			$strSql .= " where s.isallowed=1 ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (s.username like '%" . $toLike . "%' or s.mobile like '%" . $toLike . "%')  ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM supplierinfo where isallowed=1 ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		case "ShowSupplierDetail":
			$id = Get("id");
			$strSql = "Select id, productmaxnum,newsmaxnum from supplierinfo ";
			$strSql.= " where id=$id ";
			$data = DBGetDataRow($strSql);
			echo json_encode($data);
			break;
		case "UpdateMaxnum"://更新每日可发布的最大数量
			$id = Get("id");
			$productmaxnum = Get("productmaxnum");
			$newsmaxnum = Get("newsmaxnum");
			$r=DBUpdateField("supplierinfo",$id,array("productmaxnum","newsmaxnum"),array($productmaxnum,$newsmaxnum));
			if($r)
				echo 1;
			else
				echo -1;
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