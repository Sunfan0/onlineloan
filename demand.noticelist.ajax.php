<?php
	include "paras.php";
	$mode = Get("mode");
	switch($mode){
		case "ShowList":
			$demanderdata = DBGetDataRowByField("demanderinfo",array("username"),array($_SESSION["demandername"]));
			$demanderid=$demanderdata["id"];
			$strSql = " select s1.id,s2.title,s2.operator,s2.sendtime,s1.isread from websitenoticehistory s1 ";
			$strSql.= " left join websitenotice s2 on s1.noticeid = s2.id ";
			$strSql.= " where s1.receivertype=2 and s1.receiverid=$demanderid ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (s2.title like '%" . $toLike . "%') ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM websitenoticehistory  where receivertype=2 and receiverid=$demanderid ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		/* case"ShowList":
			$strSql = " select s1.id,s1.title,s1.operator,s1.sendtime,s2.isread from websitenotice s1 ";
			$strSql.= " left join websitenoticehistory s2 on s1.id = s2.noticeid ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break; */
		case "ShowOneNews"://单条信息点开后，就算做已读
			$id = Get("id");
			DBUpdateField("websitenoticehistory",$id,array("isread","readtime"),array(1,$DB_FUNCTIONS["now"]));
			$usedata = DBGetDataRowByField("websitenoticehistory",array("id"),array($id));
			if($usedata==null)
				die("-7");
			$data = DBGetDataRowByField("websitenotice",array("id"),array($usedata["noticeid"]));
			echo json_encode($data);
			break;
		//
		case "IsreadMore"://批量标记为已读
			$data = json_decode(Get("data") , true);
			for($i=0;$i<count($data["noticeid"]);$i++){
				$r = DBUpdateField("websitenoticehistory",$data["noticeid"][$i]["id"],array("isread","readtime"),array(1,$DB_FUNCTIONS["now"]));
				if(!$r)
					die("-1");
			}
			echo 1;
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