<?php
	include "paras.php";
	if(!CheckRights3("bgaudit")){
		echo 123;
		die();
	}
	$perpage = 30;
	$mode = Get("mode");
	switch($mode){
		case "UpdateMoreNews"://批量审核	
			$data = json_decode(Get("data") , true);
			DBBeginTrans();
			for($i=0;$i<count($data["newsid"]);$i++){
				$infos = DBUpdateField("newslist" , $data["newsid"][$i]["id"] , array("isallowed","reason","operattime","operator") ,array($data["status"],$data["reason"],$DB_FUNCTIONS["now"],$_SESSION["uname"]));
				if(!$infos)
					DBRollbackTrans("-1");
				$arrFields = array("newsid","operator","isallowed","reason","operattime");
				$arrValues = array($data["newsid"][$i]["id"],$_SESSION["uname"],$data["status"],$data["reason"],$DB_FUNCTIONS["now"]);
				$Id = DBInsertTableField("newscheckhistory" , $arrFields , $arrValues);
				if($Id<=0)
					AjaxRollBack('-9');
			}
			DBCommitTrans();
			$smarty->clearCache('smartypage-sun.tpl');
			echo 1;
			break;
		case "ShowNewsList":
			$strSql = " SELECT s.username,n.createtime,n.id,n.title,n.content FROM `newslist` n ";
			$strSql .= " left join supplierinfo s on n.supplierid=s.id ";
			$strSql .= " where n.supplierid!=0 and n.isallowed=0 ";//供方发布
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (n.title like '%" . $toLike . "%')  ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM  newslist Where supplierid!=0 and isallowed=0 ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		/* case "ShowNewsList":
			$currentpage = Get("currentpage");
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;
	
			$strSql = " SELECT s.username,n.createtime,n.id,n.title,n.content FROM `newslist` n ";
			$strSql .= " left join supplierinfo s on n.supplierid=s.id ";
			$strSql .= " where n.supplierid!=0 and n.isallowed=0 ";//供方发布
			$strSql .= " order by n.createtime desc ";
			$strSql .= " limit $p,$perpage ";
			$detail = DBGetDataRowsSimple($strSql);
		
			$strSql= "select  count(*) as total from newslist Where supplierid!=0 and isallowed=0 ";
			$result = DBGetDataRow($strSql);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
			break; */
		case "ShownewsDetail":
			$id = Get("id");
			$strSql = "Select n.id, n.title,n.content,n1.name,n2.name as cname from newslist n  ";
			$strSql.= " left join newstype n1 on n.newstypeid=n1.id ";
			$strSql .= " left join `newstype` n2 on n1.id = n2.parentid ";
			$strSql.= " where n.id=$id ";
			$strSql .= " and n1.parentid = 0 and n1.inuse = 1 and IFNULL (n2.inuse,1)=1";
			$result = DBGetDataRows($strSql);
			$list = array();
			for($i=0;$i<count($result);$i++){
				if(!isset($list[$result[$i]["id"]])){
					$list[$result[$i]["id"]] = array();
					$list[$result[$i]["id"]]["title"] = $result[$i]["title"];
					$list[$result[$i]["id"]]["content"] = $result[$i]["content"];
					$list[$result[$i]["id"]]["name"] = $result[$i]["name"];
					$list[$result[$i]["id"]]["childtype"] = array();//里边又重新放置一个数组
				}
				$row = array();
				$row["name"] = $result[$i]["cname"];
  
				array_push($list[$result[$i]["id"]]["childtype"],$row);
			}
			$arr = array();
			
			foreach($list as $o){
				$arr[] = $o;
			}
			echo json_encode($arr);
			break;
		case "Updatenews":
			$id = (int)(Get("id"));
			$status=Get("type");//1通过，-1拒绝
			$reason = Get("reason");
			$arrFields = array("newsid","operator","isallowed","reason","operattime");
			$arrValues = array($id,$_SESSION["uname"],$status,$reason,$DB_FUNCTIONS["now"]);
			DBBeginTrans();
			$infos = DBUpdateField("newslist" , $id , array("isallowed","reason","operattime","operator") ,array($status,$reason,$DB_FUNCTIONS["now"],$_SESSION["uname"]));
			if(!$infos)
				DBRollbackTrans("-1");
			$r = DBInsertTableField("newscheckhistory" , $arrFields ,$arrValues);
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