<?php
	include "paras.php";
	/* if(!CheckRights3("bguserinfo")){
		echo 123;
		die();
	} */
	$perpage = 30;
	$mode = Get("mode");
	switch($mode){
		case "MoreResetPsw"://批量重置密码
			$data = json_decode(Get("data") , true);
			for($i=0;$i<count($data["supplierid"]);$i++){
				$r = DBUpdateField("supplierinfo" ,$data["supplierid"][$i]["id"], array("password") ,array("670b14728ad9902aecba32e22fa4f6bd"));
				if(!$r)
					die("-1");
			}
			echo 1;
			break;
		case "MoreSetBlackList"://批量加入黑名单
			$data = json_decode(Get("data") , true);
			DBBeginTrans();
			for($i=0;$i<count($data["supplierid"]);$i++){
				$infos = DBUpdateField("supplierinfo" , $data["supplierid"][$i]["id"], array("isblacklist") ,array($data["status"]));
				if(!$infos)
					DBRollbackTrans("-1");
				$arrFields = array("type","supplierid","operator","operattime","reason");
				$arrValues = array($data["status"],$data["supplierid"][$i]["id"],$_SESSION["uname"],$DB_FUNCTIONS["now"],$data["reason"]);
				$Id = DBInsertTableField("supplierblacklist" , $arrFields , $arrValues);
				if($Id<=0)
					AjaxRollBack('-9');
			}
			DBCommitTrans();
			//$smarty->clearCache('smartypage-sun.tpl');
			echo 1;
			break;
		case "ShowSupplierList":
			$checkuser = DBGetDataRowByField("bgmanager" , array("loginname"),array($_SESSION["uname"]));
			$managerid=$checkuser["id"];//当前登录站方id
			$strSql = "Select b.subareaid from bgmanagersubarea b ";
			$strSql .= "where b.managerid=$managerid and b.status=0  ";
			$datamanagersubarea = DBGetDataRowsSimple($strSql);//对应站方的地区id
			
			$strSql = " SELECT distinct(s.id),s.*,if(s.type=1,'中介','机构') as type FROM `supplierinfo` s ";
			$strSql .= "left join suppliersubarea n on s.id=n.supplierid ";
			$strSql .= "left join subarea s2 on n.subareaid=s2.id ";
			for($i=0;$i<count($datamanagersubarea);$i++){
				$data=$datamanagersubarea[$i]["subareaid"];
				if($i==0){
					$strSql .= "where (n.subareaid=$data ";
				}else{
					$strSql .= "or n.subareaid=$data ";
				}
				if($i==count($datamanagersubarea)-1){
					$strSql .= " )";
				}
			} 
			$strSql .= "and s.isallowed = 1 and n.status=0 and s.isblacklist!=1 ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (s.username like '%" . $toLike . "%' or s.mobile like '%" . $toLike . "%')  ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
			
			$strSqlCountAll = " SELECT count(distinct s.id) FROM `supplierinfo` s ";
			$strSqlCountAll .= "left join suppliersubarea n on s.id=n.supplierid ";
			$strSqlCountAll .= "left join subarea s2 on n.subareaid=s2.id ";
			for($i=0;$i<count($datamanagersubarea);$i++){
				$data=$datamanagersubarea[$i]["subareaid"];
				if($i==0){
					$strSqlCountAll .= "where (n.subareaid=$data ";
				}else{
					$strSqlCountAll .= "or n.subareaid=$data ";
				}
				if($i==count($datamanagersubarea)-1){
					$strSqlCountAll .= " )";
				}
			} 
			$strSqlCountAll .= "and s.isallowed = 1 and n.status=0 and s.isblacklist!=1  ";
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
			$strSql = " SELECT s.id,s.username,s.type,s.mobile FROM `supplierinfo` s ";
			$strSql .= " order by registtime desc ";
			$strSql .= " limit $p,$perpage ";
			$detail = DBGetDataRowsSimple($strSql);
		
			$strSql= "select  count(*) as total from supplierinfo Where isallowed=1 ";
			$result = DBGetDataRow($strSql);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
			break; */
		case "ShowSupplierDetail":
			$id = Get("id");
			$strSql = "Select * from supplierinfo ";
			$strSql.= " where id=$id ";
			$data = DBGetDataRow($strSql);
			echo json_encode($data);
			break;
		case "ResetPsw":
			$id = Get("id");
			$r = DBUpdateField("supplierinfo" , $id , array("password") ,array("670b14728ad9902aecba32e22fa4f6bd"));
			if($r)
				echo 1;
			else
				echo -1;
			break;
		case "SetBlackList":
			$id = Get("id");
			$type = Get("type");
			$reason = Get("reason");
			$arrFields = array("type","supplierid","operator","operattime","reason");
			$arrValues = array($type,$id,$_SESSION["uname"],$DB_FUNCTIONS["now"],$reason);
			DBBeginTrans();
			$r = DBUpdateField("supplierinfo" , $id , array("isblacklist") ,array($type));
			if(!$r)
				DBRollbackTrans("-1");
			$r = DBInsertTableField("supplierblacklist" , $arrFields ,$arrValues);
			if($r<=0)
				DBRollbackTrans("-2");
			DBCommitTrans();	
			echo 1;
			break;
		case "ShowBlackList":
			$checkuser = DBGetDataRowByField("bgmanager" , array("loginname"),array($_SESSION["uname"]));
			$managerid=$checkuser["id"];//当前登录站方id
			$strSql = "Select b.subareaid from bgmanagersubarea b ";
			$strSql .= "where b.managerid=$managerid and b.status=0  ";
			$datamanagersubarea = DBGetDataRowsSimple($strSql);//对应站方的地区id
			
			$strSql = " SELECT distinct(s.id),s.*,if(s.type=1,'中介','机构') as type FROM `supplierinfo` s ";
			$strSql .= "left join suppliersubarea n on s.id=n.supplierid ";
			$strSql .= "left join subarea s2 on n.subareaid=s2.id ";
			for($i=0;$i<count($datamanagersubarea);$i++){
				$data=$datamanagersubarea[$i]["subareaid"];
				if($i==0){
					$strSql .= "where (n.subareaid=$data ";
				}else{
					$strSql .= "or n.subareaid=$data ";
				}
				if($i==count($datamanagersubarea)-1){
					$strSql .= " )";
				}
			} 
			$strSql .= "and s.isallowed = 1 and n.status=0 and s.isblacklist=1 ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (s.username like '%" . $toLike . "%' or s.mobile like '%" . $toLike . "%')  ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
			
			$strSqlCountAll = " SELECT count(distinct s.id) FROM `supplierinfo` s ";
			$strSqlCountAll .= "left join suppliersubarea n on s.id=n.supplierid ";
			$strSqlCountAll .= "left join subarea s2 on n.subareaid=s2.id ";
			for($i=0;$i<count($datamanagersubarea);$i++){
				$data=$datamanagersubarea[$i]["subareaid"];
				if($i==0){
					$strSqlCountAll .= "where (n.subareaid=$data ";
				}else{
					$strSqlCountAll .= "or n.subareaid=$data ";
				}
				if($i==count($datamanagersubarea)-1){
					$strSqlCountAll .= " )";
				}
			} 
			$strSqlCountAll .= "and s.isallowed = 1 and n.status=0 and s.isblacklist=1  ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
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