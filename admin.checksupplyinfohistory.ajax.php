<?php
	include "paras.php";
	if(!CheckRights3("bgauditrecord")){
		echo 123;
		die();
	}
	$mode = Get("mode");
	switch($mode){
		case "ShowSupplyinfoList":
			$strSql = " SELECT s1.id,s1.content,s1.Featuresintroduce,s1.createtime,s.isallowed,s.reason,s.operattime,s.operator FROM `supplyinfocheckhistory` s ";
			$strSql .= " left join supplyinfo s1 on s.supplyinfoid=s1.id ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "where (s1.productname like '%" . $toLike . "%')  ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM  supplyinfocheckhistory  ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		/* case "ShowSupplyinfoList":
			$currentpage = Get("currentpage");
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;

			$strSql = " SELECT s1.id,s1.content,s1.Featuresintroduce,s1.createtime,s.isallowed,s.reason,s.operattime,s.operator FROM `supplyinfocheckhistory` s ";
			$strSql .= " left join supplyinfo s1 on s.supplyinfoid=s1.id ";
			$strSql .= " order by s.operattime desc ";
			$strSql .= " limit $p,$perpage ";
			$detail = DBGetDataRowsSimple($strSql);
		
			$strSql= "select  count(*) as total from supplyinfocheckhistory ";
			$result = DBGetDataRow($strSql);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
			break; */
		
		case "ShowSupplyinfoDetail":
			$id = Get("id");
			$strSql = "Select * from supplyinfo ";
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