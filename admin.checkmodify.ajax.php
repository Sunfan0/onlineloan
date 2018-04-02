<?php
	include "paras.php";
	if(!CheckRights3("bgaudit")){
		echo 123;
		die();
	} 
	$perpage = 30;
	$mode = Get("mode");
	switch($mode){
		
		case "UpdateMoremodify"://批量审核
			$data = json_decode(Get("data") , true);
			DBBeginTrans();
			for($i=0;$i<count($data["modifyid"]);$i++){
				$modifyInfo = DBGetDataRowByField("supplieridentityconfirm","id",$data["modifyid"][$i]["id"]);	
				$infos = DBUpdateField("supplieridentityconfirm" , $data["modifyid"][$i]["id"] , array("isallowed","reason","operattime","operator") ,array($data["status"],$data["reason"],$DB_FUNCTIONS["now"],$_SESSION["uname"]));
				if(!$infos)
					DBRollbackTrans("-1");
				$Id = DBUpdateField("supplierinfo" , $modifyInfo["supplierid"] , array("ismodify") ,array($data["status"]));
				if($Id<=0)
					AjaxRollBack('-9');
			}
			DBCommitTrans();
			echo 1;
			break;
		case "ShowmodifyList":
			$strSql = " SELECT s.id,s.isallowed,s.createtime,s.operator,s.operattime,s1.username as name FROM `supplieridentityconfirm` s ";
			$strSql .= " left join supplierinfo s1 on s.supplierid=s1.id ";
			$strSql .= "Where s.isallowed = 0  ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (s1.username like '%" . $toLike . "%')  ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM  supplieridentityconfirm Where isallowed = 0  ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		/* case "ShowmodifyList":
			$currentpage = Get("currentpage");
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;
			$strSql = " SELECT * FROM `supplieridentityconfirm` s ";
			$strSql .= "Where s.isallowed = 0  ";
			$strSql .= " order by s.createtime desc ";
			$strSql .= " limit $p,$perpage ";
			$detail = DBGetDataRowsSimple($strSql);
		
			$strSql= "select  count(*) as total from supplieridentityconfirm Where isallowed = 0 ";
			$result = DBGetDataRow($strSql);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
			break; */
		case "ShowmodifyDetail":
			$id = Get("id");
			$strSql = "Select * from supplieridentityconfirm  ";
			$strSql.= " where id=$id ";
			$data = DBGetDataRow($strSql);
			echo json_encode($data);
			break;
		case "Updatemodify":
			$id = (int)(Get("id"));
			$status=Get("type");//1通过，-1拒绝
			$reason = Get("reason");
			$modifyInfo = DBGetDataRowByField("supplieridentityconfirm","id",$id);	
			DBBeginTrans();
			$infos = DBUpdateField("supplieridentityconfirm" , $id , array("isallowed","reason","operattime","operator") ,array($status,$reason,$DB_FUNCTIONS["now"],$_SESSION["uname"]));
			if(!$infos)
				DBRollbackTrans("-1");
			$infos = DBUpdateField("supplierinfo" , $modifyInfo["supplierid"] , array("ismodify") ,array($status));
			if(!$infos)
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