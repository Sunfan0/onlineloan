<?php
	include "paras.php";
	$mode = Get("mode");
	switch($mode){
		case "UpdateMorereply"://批量屏蔽或者取消屏蔽
			$data = json_decode(Get("data") , true);
			DBBeginTrans();
			for($i=0;$i<count($data["replyid"]);$i++){
				$infos = DBUpdateField("newsreplylist" , $data["replyid"][$i]["id"], array("isstop") ,array($data["status"]));
				if(!$infos)
					DBRollbackTrans("-1");
				$arrFields = array("replyid","operator","isstop","reason","operattime");
				$arrValues = array($data["replyid"][$i]["id"],$_SESSION["uname"],$data["status"],$data["reason"],$DB_FUNCTIONS["now"]);
				$Id = DBInsertTableField("newsreplystophistory" , $arrFields , $arrValues);
				if($Id<=0)
					AjaxRollBack('-9');
			}
			DBCommitTrans();
			//$smarty->clearCache('smartypage-sun.tpl');
			echo 1;
			break;
		case "NewsList":
			$supplierdata = DBGetDataRowByField("supplierinfo",array("username"),array($_SESSION["suppliername"]));
			$supplierid=$supplierdata["id"];
			$strSql = "Select d.id,d.title,d.content,d.createtime,IFNULL(s.username,d.publishname) as publishname,IF(d.supplierid=0,'站方','供方') as identity,IFNULL(f.cnt,0) as cnt ,f.replyid ";
			$strSql .=" from newslist d ";
			$strSql .= " left join supplierinfo s on d.supplierid=s.id ";
			$strSql .= " left join (select count(*) as cnt,newsid,id as replyid from newsreplylist  group by newsid ) f on d.id=f.newsid ";
			$strSql .= " where d.supplierid=$supplierid ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and  (d.title like '%" . $toLike . "%' or d.publishname like '%" . $toLike . "%' or s.username like '%" . $toLike . "%')   ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM newslist where supplierid=$supplierid ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		/* case "NewsList"://资讯列表显示
			$supplierdata = DBGetDataRowByField("supplierinfo",array("username"),array($_SESSION["suppliername"]));
			$supplierid=$supplierdata["id"];
			$strSql = "Select d.id,d.title,d.content,d.createtime,s.username,d.publishname,IFNULL(f.cnt,0) as cnt ";
			$strSql .=" from newslist d ";
			$strSql .= " left join supplierinfo s on d.supplierid=s.id ";
			$strSql .= " left join (select count(*) as cnt,newsid from newsreplylist  group by newsid ) f on d.id=f.newsid ";
			$strSql .= " where d.supplierid=$supplierid ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break; */
		case "replylist":
			$newsid = (int)(Get("id"));//资讯id
			$strSql= " Select b1.loginname as zname,d.username as dname,s.username as sname,b.id,b.content,b.replytime,b.isstop from newsreplylist b ";
			$strSql.=" left join supplierinfo s on b.replierid=s.id ";
			$strSql.=" left join demanderinfo d on b.replierid=d.id ";
			$strSql.=" left join bgmanager b1 on b.replierid=b1.id ";
			$strSql.=" where b.newsid=$newsid ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (b.content like '%" . $toLike . "%' or s.username like '%" . $toLike . "%' ) ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM newsreplylist where newsid=$newsid ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		/* case "replylist":
			$newsid = (int)(Get("id"));//资讯id
			$strSql= " Select b1.loginname as zname,d.username as dname,s.username as sname,s.id,b.content,b.replytime,b.isstop from newsreplylist b ";
			$strSql.=" left join supplierinfo s on b.replierid=s.id ";
			$strSql.=" left join demanderinfo d on b.replierid=d.id ";
			$strSql.=" left join bgmanager b1 on b.replierid=b1.id ";
			$strSql.="where b.newsid=$newsid ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break; */
		case "Updatereply":
			$id = (int)(Get("id"));
			$status=Get("type");//1通过，-1拒绝
			$reason=Get("reason");
			$arrFields = array("replyid","operator","isstop","reason","operattime");
			$arrValues = array($id,$_SESSION["suppliername"],$status,$reason,$DB_FUNCTIONS["now"]);
			DBBeginTrans();
			$infos = DBUpdateField("newsreplylist" , $id , array("isstop") ,array($status));
			if(!$infos)
				DBRollbackTrans("-1");
			$r = DBInsertTableField("newsreplystophistory" , $arrFields ,$arrValues);
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