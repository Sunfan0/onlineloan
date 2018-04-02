<?php
	include "paras.php";
	if(!CheckRights3("bgset")){
		echo 123;
		die();
	}
	$perpage = 30;
	$mode = Get("mode");
	switch($mode){
		case "DeleteMore"://批量删除
			$data = json_decode(Get("data") , true);
			for($i=0;$i<count($data["keywordid"]);$i++){
				$r = DBDeleteData("keywordwarn" , $data["keywordid"][$i]["id"]);
				if(!$r)
					die("-1");
			}
			echo 1;
			break;
		case "KeywordList":
			$strSql = " select * from keywordwarn s ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "where (s.keyword like '%" . $toLike . "%') ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM keywordwarn ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		/* case "KeywordList":
			$strSql = " select * from keywordwarn ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break; */
		case "DeleteKeyword":
			$id = Get("id");
			$r = DBDeleteData("keywordwarn" , $id);
			if($r > 0){
				echo 1;
			} else {
				echo -1;
			}
			break;
		case "UpdateKeyword":
			$flagid = Get("flagid");//判断是更新还是新增
			$keyword = Get("keyword");
			$arrFields = array("keyword");
			$arrValues = array($keyword);
			if($flagid==""){//新增
				$r = DBInsertTableField("keywordwarn" , $arrFields ,$arrValues);
				if($r > 0){
					echo 1;
				} else {
					echo -1;
				}
				die();
			}else{//修改
				$r = DBUpdateField("keywordwarn" , $flagid ,$arrFields, $arrValues);
				if($r){
					echo 1;
				}else{
					echo -1;
				}
				die();
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