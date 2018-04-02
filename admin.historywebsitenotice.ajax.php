<?php
	include "paras.php";
	if(!CheckRights3("bgnotice")){
		echo 123;
		die();
	}
	$mode = Get("mode");
	switch($mode){
		//添加身份,分组
		case "ShowSendNoticeList"://receiverid,receivetype
			$strSql = " SELECT w.id,w.isread,w.readtime,w1.operator,w1.content,w1.sendtime,if(w.receivertype=1,s.username,d.username) as username, if(w.receivertype=1,'供方','需方') as modify,if(d.type=0,if(s.type=1 ,'中介1','机构1'),if(d.type=1 ,'中介','机构') )as usertype FROM `websitenoticehistory` w ";
			$strSql .= " left join websitenotice w1 on w.noticeid=w1.id ";
			$strSql .= " left join demanderinfo d on w.receiverid=d.id ";
			$strSql .= " left join supplierinfo s on w.receiverid=s.id ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= " where  s.username like '%" . $toLike . "%' or d.username like '%" . $toLike . "%' ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "	Select count(*) FROM websitenoticehistory  ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		/* case "ShowSendNoticeList":
			$currentpage = Get("currentpage");
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;
			$strSql = " SELECT w.id,w.isread,w.readtime,w1.operator,w1.content,w1.sendtime,d.username  FROM `websitenoticehistory` w ";
			$strSql .= " left join websitenotice w1 on w.noticeid=w1.id ";
			$strSql .= " left join demanderinfo d on w.demanderid=d.id ";
			$strSql .= " order by w1.sendtime desc ";
			$strSql .= " limit $p,$perpage ";
			$detail = DBGetDataRowsSimple($strSql);
		
			$strSql= "select  count(*) as total from websitenoticehistory ";
			$result = DBGetDataRow($strSql);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
			break; */
		//
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