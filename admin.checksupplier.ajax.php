<?php
	include "paras.php";
	if(!CheckRights3("bgaudit")){
		echo 123;
		die();
	}
	$mode = Get("mode");
	switch($mode){
		case "UpdateMoreSupplier"://批量审核
			$data = json_decode(Get("data") , true);
			DBBeginTrans();
			for($i=0;$i<count($data["supplierid"]);$i++){
				// $infos = DBUpdateField("supplierinfo" , $data["supplierid"][$i]["id"] , array("isallowed","reason","operattime","operator") ,array($data["status"],$data["reason"],$DB_FUNCTIONS["now"],$_SESSION["uname"]));
				$infos = DBUpdateField("supplierinfo" , $data["supplierid"][$i]["id"] , array("isallowed","reason","operattime","operator") ,array($data["status"],$data["reason"],$DB_FUNCTIONS["now"],'admin'));
				if(!$infos)
					DBRollbackTrans("-1");
				$arrFields = array("supplierid","operator","isallowed","reason","operattime");
				// $arrValues = array($data["supplierid"][$i]["id"],$_SESSION["uname"],$data["status"],$data["reason"],$DB_FUNCTIONS["now"]);
				$arrValues = array($data["supplierid"][$i]["id"],'admin',$data["status"],$data["reason"],$DB_FUNCTIONS["now"]);
				$Id = DBInsertTableField("suppliercheckhistory" , $arrFields , $arrValues);
				if($Id<=0)
					AjaxRollBack('-9');
			}
			DBCommitTrans();
			$smarty->clearCache('smartypage-sun.tpl');
			echo 1;
			break;
		case "ShowSupplierList":
			$strSql = " SELECT * FROM `supplierinfo` s ";
			$strSql .= " Where s.isallowed = 0 ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (s.username like '%" . $toLike . "%') or (s.mobile like '%" . $toLike . "%')  ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM supplierinfo where isallowed=0 ";
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
			$strSql = " SELECT * FROM `supplierinfo` s ";
			$strSql .= " Where isallowed = 0 ";
			$strSql .= " order by createtime desc ";
			$strSql .= " limit $p,$perpage ";
			$detail = DBGetDataRowsSimple($strSql);
		
			$strSql= "select  count(*) as total from supplierinfo Where isallowed = 0  ";
			$result = DBGetDataRow($strSql);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
			break; */
		case "ShowSupplierDetail":
			$id = Get("id");
			$strSql = "Select * from supplierinfo  ";
			$strSql.= " where id=$id ";
			$data = DBGetDataRow($strSql);
			echo json_encode($data);
			break;
		case "UpdateSupplier":
			$id = (int)(Get("id"));
			$status=Get("type");//1通过，-1拒绝
			$reason = Get("reason");
			$arrFields = array("supplierid","operator","isallowed","reason","operattime");
			$arrValues = array($id,$_SESSION["uname"],$status,$reason,$DB_FUNCTIONS["now"]);
			DBBeginTrans();
			$infos = DBUpdateField("supplierinfo" , $id , array("isallowed","reason","operattime","operator") ,array($status,$reason,$DB_FUNCTIONS["now"],$_SESSION["uname"]));
			if(!$infos)
				DBRollbackTrans("-1");
			$r = DBInsertTableField("suppliercheckhistory" , $arrFields ,$arrValues);
			if($r<=0)
				DBRollbackTrans("-2");
			DBCommitTrans();
			$smarty->clearCache('smartypage-sun.tpl');
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