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
			for($i=0;$i<count($data["subareaid"]);$i++){
				$r = DBDeleteData("subarea" , $data["subareaid"][$i]["id"]);
				if(!$r)
					die("-1");
			}
			echo 1;
			break;
		case "SubareaList":
			$strSql = " select * from subarea s ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "where (s.name like '%" . $toLike . "%') or (s.firstletter like '%" . $toLike . "%') ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM subarea ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		/* case "SubareaList":
			$strSql = " select * from subarea order by createtime desc ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break; */
		case "DeleteSubarea":
			$id = Get("id");
			$r = DBDeleteData("subarea" , $id);
			if($r > 0){
				echo 1;
			} else {
				echo -1;
			}
			break;
		case "UpdateSubarea":
			$flagid = Get("flagid");//判断是更新还是新增
			$firstletter = Get("firstletter");
			$name = Get("name");
			$arrFields = array("name","firstletter");
			$arrValues = array($name,$firstletter);
			if($flagid==""){//新增
				$r = DBInsertTableField("subarea" , $arrFields ,$arrValues);
				if($r > 0){
					echo 1;
				} else {
					echo -1;
				}
				die();
			}else{//修改
				$r = DBUpdateField("subarea" , $flagid ,$arrFields, $arrValues);
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