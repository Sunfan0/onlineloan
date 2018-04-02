<?php
	include "paras.php";
	if(!CheckRights3("bgaudit")){
		echo 123;
		die();
	}
	$perpage = 30;
	$mode = Get("mode");
	switch($mode){
		case "UpdateMoreDemander"://批量审核
			$data = json_decode(Get("data") , true);
			DBBeginTrans();
			for($i=0;$i<count($data["demanderid"]);$i++){
				$infos = DBUpdateField("demanderinfo" , $data["demanderid"][$i]["id"] , array("isallowed","reason","operattime","operator") ,array($data["status"],$data["reason"],$DB_FUNCTIONS["now"],$_SESSION["uname"]));
				if(!$infos)
					DBRollbackTrans("-1");
				$arrFields = array("demanderid","operator","isallowed","reason","operattime");
				$arrValues = array($data["demanderid"][$i]["id"],$_SESSION["uname"],$data["status"],$data["reason"],$DB_FUNCTIONS["now"]);
				$Id = DBInsertTableField("demandercheckhistory" , $arrFields , $arrValues);
				if($Id<=0)
					AjaxRollBack('-9');
			}
			DBCommitTrans();
			$smarty->clearCache('smartypage-sun.tpl');
			echo 1;
			break;
		case "ShowDemanderList":
			$strSql = " SELECT * FROM `demanderinfo` d ";
			$strSql .= " Where d.isallowed = 0 ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (d.username like '%" . $toLike . "%') or (d.mobile like '%" . $toLike . "%') ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM demanderinfo where isallowed=0 ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		/* case "ShowDemanderList":
			$currentpage = Get("currentpage");
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;
			$strSql = " SELECT * FROM `demanderinfo` d ";
			$strSql .= " Where isallowed = 0 ";
			$strSql .= " order by createtime desc ";
			$strSql .= " limit $p,$perpage ";
			$detail = DBGetDataRowsSimple($strSql);
		
			$strSql= "select  count(*) as total from demanderinfo Where isallowed = 0 ";
			$result = DBGetDataRow($strSql);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
			break; */
		case "ShowDemanderDetail":
			$id = Get("id");
			$strSql = "Select * from demanderinfo  ";
			$strSql.= " where id=$id ";
			$data = DBGetDataRow($strSql);
			echo json_encode($data);
			break;
		case "UpdateDemander":
			$id = (int)(Get("id"));
			$status=Get("type");//1通过，-1拒绝
			$reason = Get("reason");
			$arrFields = array("demanderid","operator","isallowed","reason","operattime");
			$arrValues = array($id,$_SESSION["uname"],$status,$reason,$DB_FUNCTIONS["now"]);
			DBBeginTrans();
			$infos = DBUpdateField("demanderinfo" , $id , array("isallowed","reason","operattime","operator") ,array($status,$reason,$DB_FUNCTIONS["now"],$_SESSION["uname"]));
			if(!$infos)
				DBRollbackTrans("-1");
			$r = DBInsertTableField("demandercheckhistory" , $arrFields ,$arrValues);
			if($r<=0)
				DBRollbackTrans("-2");
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