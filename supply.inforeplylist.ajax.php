<?php
	include "paras.php";
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
			$smarty->clearCache('smartypage-sun.tpl');
			echo 1;
			break;
		case "ShowList":
			$supplierdata = DBGetDataRowByField("supplierinfo",array("username"),array($_SESSION["suppliername"]));
			$supplierid=$supplierdata["id"];
			$strSql = "select s2.id,s2.productname,s2.Featuresintroduce,s1.username,s2.createtime,IFNULL(f.cnt,0)as cnt ";
			$strSql.= " from supplyinfo s2 ";
			$strSql.= " left join supplierinfo s1 on s2.supplierid = s1.id ";
			$strSql.= " left join ( select count(*) as cnt,supplyinfoid from supplyinforeply  group by supplyinfoid)f on s2.id = f.supplyinfoid ";
			$strSql.= " where s2.supplierid=$supplierid ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (s2.productname like '%" . $toLike . "%' or s1.username like '%" . $toLike . "%')";
			$sqlPara = GetPageParas();
			
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			//echo $strSqlDetail;
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "	Select count(*) FROM supplyinfo where supplierid=$supplierid ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break; 
		/* case"ShowList":
			$supplierdata = DBGetDataRowByField("supplierinfo",array("username"),array($_SESSION["suppliername"]));
			$supplierid=$supplierdata["id"];
			$strSql = "select s2.id,s2.productname,s2.Featuresintroduce,s1.username,s2.createtime,IFNULL(f.cnt,0)as cnt ";
			$strSql.= " from supplyinfo s2 ";
			$strSql.= " left join supplierinfo s1 on s2.supplierid = s1.id ";
			$strSql.= " left join ( select count(*) as cnt,supplyinfoid from supplyinforeply  group by supplyinfoid)f on s2.id = f.supplyinfoid ";
			$strSql.= " where s2.supplierid=$supplierid";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break; */
		case "showReplyList":
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
		/* case"showReplyList":
			$supplyinfoid = (int)(Get("id"));
			$strSql = "select s1.username,s2.content,s2.replytime from supplyinforeply s2 ";
			$strSql.= " left join demanderinfo s1 on s1.id = s2.demanderid ";
			$strSql.= " where s2.supplyinfoid=$supplyinfoid";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break; */
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