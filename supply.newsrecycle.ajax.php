<?php
	include "paras.php";
	if(!CheckRights3("bginformation")){
		echo 123;
		die();
	}
	$mode = Get("mode");
	switch($mode){	
		case "MoreNewsRecover"://批量移出回收站
			$data = json_decode(Get("data") , true);
			DBBeginTrans();
			for($i=0;$i<count($data["newsid"]);$i++){
				$newsdata = DBGetDataRowByField("newsrecyclebinlist" , array("id"),array($data["newsid"][$i]["id"]));
				$arrFields = array("newstypeid","isstick","supplierid","publishname","title","titlecolor","image","content","allowreply","isallowed","reason","operator","operattime");
				$arrValues = array($newsdata["newstypeid"],$newsdata["isstick"],$newsdata["supplierid"],$newsdata["publishname"],$newsdata["title"],$newsdata["titlecolor"],$newsdata["image"],$newsdata["content"],$newsdata["allowreply"],$newsdata["isallowed"],$newsdata["reason"],$newsdata["operator"],$newsdata["operattime"]);
				$Id = DBInsertTableField("newslist" , $arrFields , $arrValues);
				if($Id<=0)
					AjaxRollBack('-1');
				$r = DBDeleteData("newsrecyclebinlist" , $data["newsid"][$i]["id"]);
				if(!$r)
					AjaxRollBack("-2");
			}
			DBCommitTrans();
			echo 1;
			break;
		case "ShownewsList"://回收站资讯列表,距离现在一周之内
			$strSql = " SELECT * FROM `newsrecyclebinlist` s ";
			$strSql .= " where date_sub(curdate(), INTERVAL 7 DAY) <= date(`recycletime`)";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (s.title like '%" . $toLike . "%') ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM newsrecyclebinlist where date_sub(curdate(), INTERVAL 7 DAY) <= date(`recycletime`) ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		case "Shownewsdetail"://资讯重要信息显示
			$id = Get("id");
			$strSql = " SELECT * FROM `newsrecyclebinlist` where id=$id ";
			$result = DBGetDataRow($strSql);
			echo json_encode($result);
			break;
		case "NewsRecover"://移出回收站，
			/*
			1先插入newslist数据表
			2删除回收列表中的数据
			*/
			$id = Get("id");
			$newsdata = DBGetDataRowByField("newsrecyclebinlist" , array("id"),array($id));
			$arrFields = array("newstypeid","isstick","supplierid","publishname","title","titlecolor","image","content","allowreply","isallowed","reason","operator","operattime");
			$arrValues = array($newsdata["newstypeid"],$newsdata["isstick"],$newsdata["supplierid"],$newsdata["publishname"],$newsdata["title"],$newsdata["titlecolor"],$newsdata["image"],$newsdata["content"],$newsdata["allowreply"],$newsdata["isallowed"],$newsdata["reason"],$newsdata["operator"],$newsdata["operattime"]);
			DBBeginTrans();
			$Id = DBInsertTableField("newslist" , $arrFields , $arrValues);
			if($Id<=0)
				AjaxRollBack('-1');
			$r = DBDeleteData("newsrecyclebinlist" , $id);
			if(!$r)
				AjaxRollBack("-2");
			DBCommitTrans();
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