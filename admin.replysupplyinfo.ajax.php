<?php
	include "paras.php";
	if(!CheckRights3("bginteract")){
		echo 123;
		die();
	}
	$perpage = 30;
	$mode = Get("mode");
	switch($mode){
		case "UpdateMorereply"://批量屏蔽或者取消屏蔽
			$data = json_decode(Get("data") , true);
			DBBeginTrans();
			for($i=0;$i<count($data["replyid"]);$i++){
				$infos = DBUpdateField("supplyinforeply" , $data["replyid"][$i]["id"], array("isstop") ,array($data["status"]));
				if(!$infos)
					DBRollbackTrans("-1");
				$arrFields = array("replyid","operator","isstop","reason","operattime");
				$arrValues = array($data["replyid"][$i]["id"],$_SESSION["uname"],$data["status"],$data["reason"],$DB_FUNCTIONS["now"]);
				$Id = DBInsertTableField("supplyinforeplystophistory" , $arrFields , $arrValues);
				if($Id<=0)
					AjaxRollBack('-9');
			}
			DBCommitTrans();
			//$smarty->clearCache('smartypage-sun.tpl');
			echo 1;
			break;
		case "ShowSupplierList":
			$strSql = " SELECT * FROM `supplyinfo` d ";
			$strSql .= " Where d.isallowed =1 ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= " and  (d.productname like '%" . $toLike . "%') ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM supplyinfo Where isallowed =1 ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		case "replylist":
			$supplyinfoid = (int)(Get("id"));//资讯id
			$strSql= " Select d.username,b.id,b.content,b.replytime,b.isstop from supplyinforeply b ";
			$strSql.=" left join demanderinfo d on b.demanderid=d.id ";
			$strSql.=" where b.supplyinfoid=$supplyinfoid ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (d.username like '%" . $toLike . "%')";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM supplyinforeply where supplyinfoid=$supplyinfoid ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break; 
		case "Updatereply":
			$id = (int)(Get("id"));
			$status=Get("type");//1通过，-1拒绝
			$reason=Get("reason");
			$arrFields = array("replyid","operator","isstop","reason","operattime");
			$arrValues = array($id,$_SESSION["uname"],$status,$reason,$DB_FUNCTIONS["now"]);
			DBBeginTrans();
			$infos = DBUpdateField("supplyinforeply" , $id , array("isstop") ,array($status));
			if(!$infos)
				DBRollbackTrans("-1");
			$r = DBInsertTableField("supplyinforeplystophistory" , $arrFields ,$arrValues);
			if($r<=0)
				DBRollbackTrans("-2");
			DBCommitTrans();
			echo 1;
			break;
		/* case "ShowSupplierList"://供方产品列表
			$currentpage = Get("currentpage");
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;
			$strSql = " SELECT * FROM `supplyinfo` s ";
			$strSql .= " order by createtime desc ";
			$strSql .= " limit $p,$perpage ";
			$detail = DBGetDataRowsSimple($strSql);
		
			$strSql= "select  count(*) as total from supplyinfo Where isallowed =1 ";
			$result = DBGetDataRow($strSql);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
			break; */
		/* case "ShowreplyList"://查看供方信息的回复
			$supplyinfoid = Get("supplyinfoid");
			$currentpage = Get("currentpage");
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;
			$strSql = " SELECT s.focustime,d1.username,d1.mobile FROM `supplyinfofocushistory` s ";
			$strSql .= " left join demanderinfo d1 on d.demanderid=d1.id ";
			$strSql .= " where s.supplyinfoid=$supplyinfoid ";
			$strSql .= " order by s.focustime asc ";
			$strSql .= " limit $p,$perpage ";
			$detail = DBGetDataRowsSimple($strSql);
		
			$strSql= "select  count(*) as total from supplyinfofocushistory Where supplyinfoid=$supplyinfoid ";
			$result = DBGetDataRow($strSql);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
			break;  */
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