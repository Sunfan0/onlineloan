<?php
	include "paras.php";
	$mode = Get("mode");
	if(!CheckRights3("bgset")){
		echo 123;
		die();
	}
	switch($mode){
		case "DeleteMore"://批量删除
			$data = json_decode(Get("data") , true);
			for($i=0;$i<count($data["announceid"]);$i++){
				$r = DBDeleteData("webannounce" , $data["announceid"][$i]["id"]);
				if(!$r)
					die("-1");
			}
			echo 1;
			break;
		case "ShowList":
			$strSql = " select * from webannounce s ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "where (s.content like '%" . $toLike . "%') ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM webannounce ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		/* case "ShowList":
			$strSql = "select * from webannounce ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break; */
		case "ShowdetailInfo":
			$id = Get("id");
			$data = DBGetDataRowByField("webannounce",array("id"),array($id));
			echo json_encode($data);
			break;
		case "DeleteRow":
			$id = Get("id");
			$deleteRow = DBDeleteData("webannounce","$id");
			if($deleteRow){
				echo 1;
			}else{
				echo -1;
			}
			break;
		case "UpdateInfo":
			$content = Get("content");
			$isstick = Get("isstick");
			$flagid = Get("flagid");
			if($flagid==""){
				$addData = DBInsertTableField("webannounce",array("content","isstick"),array($content,$isstick));
				if($addData>0){
					echo 1;
					$smarty->clearCache('smartypage-sun.tpl');
				}else{
					echo -1;
				}
			}else{
				$r = DBUpdateField("webannounce" , $flagid ,array("content","isstick"), array($content,$isstick));
				if($r){
					echo 1;
					$smarty->clearCache('smartypage-sun.tpl');
				}else{
					echo -1;
				}
			}
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