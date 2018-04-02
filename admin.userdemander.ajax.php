<?php
	include "paras.php";
	if(!CheckRights3("bguserinfo")){
		echo 123;
		die();
	}
	$perpage = 30;
	$mode = Get("mode");
	switch($mode){
		case "MoreResetPsw"://批量重置密码
			$data = json_decode(Get("data") , true);
			for($i=0;$i<count($data["demanderid"]);$i++){
				$r = DBUpdateField("demanderinfo" ,$data["demanderid"][$i]["id"], array("password") ,array("670b14728ad9902aecba32e22fa4f6bd"));
				if(!$r)
					die("-1");
			}
			echo 1;
			break;
		case "MoreSetBlackList"://批量加入黑名单
			$data = json_decode(Get("data") , true);
			DBBeginTrans();
			for($i=0;$i<count($data["demanderid"]);$i++){
				$infos = DBUpdateField("demanderinfo" , $data["demanderid"][$i]["id"], array("isblacklist") ,array($data["status"]));
				if(!$infos)
					DBRollbackTrans("-1");
				$arrFields = array("type","demanderid","operator","operattime","reason");
				$arrValues = array($data["status"],$data["demanderid"][$i]["id"],$_SESSION["uname"],$DB_FUNCTIONS["now"],$data["reason"]);
				$Id = DBInsertTableField("demanderblacklist" , $arrFields , $arrValues);
				if($Id<=0)
					AjaxRollBack('-9');
			}
			DBCommitTrans();
			//$smarty->clearCache('smartypage-sun.tpl');
			echo 1;
			break;
		case "ShowSupplierList":
			$strSql = " SELECT * FROM `demanderinfo` s ";
			$strSql .= " where s.isallowed=1 and s.isblacklist!=1 ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (s.username like '%" . $toLike . "%' or s.mobile like '%" . $toLike . "%')  ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM demanderinfo where isallowed=1 and isblacklist!=1 ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		case "ShowBlackList":
			$strSql = " SELECT * FROM `demanderinfo` s ";
			$strSql .= " where s.isallowed=1 and s.isblacklist=1 ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (s.username like '%" . $toLike . "%' or s.mobile like '%" . $toLike . "%')  ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM demanderinfo where isallowed=1 and isblacklist=1 ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		/* case "ShowSupplierList":
			$currentpage = Get("currentpage");
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;
			$strSql = " SELECT s.id,s.username,s.mobile,s.isblacklist FROM `demanderinfo` s ";
			$strSql .= " order by registtime desc ";
			$strSql .= " limit $p,$perpage ";
			$detail = DBGetDataRowsSimple($strSql);
		
			$strSql= "select  count(*) as total from demanderinfo Where isallowed=1 ";
			$result = DBGetDataRow($strSql);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
			break; */
		case "ShowSupplierDetail":
			$id = Get("id");
			$strSql = "Select * from demanderinfo ";
			$strSql.= " where id=$id ";
			$data = DBGetDataRow($strSql);
			echo json_encode($data);
			break;
		case "ResetPsw":
			$id = Get("id");
			$r = DBUpdateField("demanderinfo" , $id , array("password") ,array("670b14728ad9902aecba32e22fa4f6bd"));
			if($r)
				echo 1;
			else
				echo -1;
			break;
		case "SetBlackList":
			$id = Get("id");
			$type = Get("type");
			$reason = Get("reason");
			$arrFields = array("type","demanderid","operator","operattime","reason");
			$arrValues = array($type,$id,$_SESSION["uname"],$DB_FUNCTIONS["now"],$reason);
			DBBeginTrans();
			$r = DBUpdateField("demanderinfo" , $id , array("isblacklist") ,array($type));
			if(!$r)
				DBRollbackTrans("-1");
			$r = DBInsertTableField("demanderblacklist" , $arrFields ,$arrValues);
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