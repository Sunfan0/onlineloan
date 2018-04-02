<?php
	include "paras.php";
	$mode = Get("mode");
	if(!CheckRights3("bgscore")){
		echo 123;
		die();
	} 
	switch($mode){
 		case "SupplierScore":
			$strSql = "Select c.id,c.username,c.score as afterscore,IFNULL(c1.getscore,0) as getscore,IFNULL(c2.changescore,0) as changescore from supplierinfo c ";
			$strSql .= " left join (select supplierid,sum(changescore) as getscore from supplierscorehistory where changetype=1 group by supplierid ) c1 on c.id=c1.supplierid ";
			$strSql .= " left join (select supplierid,sum(changescore) as changescore from  supplierscorehistory where changetype=-1 group by supplierid ) c2 on c.id=c2.supplierid ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "where c.username like '%" . $toLike . "%' ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRows($strSqlDetail);
			$strSqlCountAll = " Select count(*) FROM supplierinfo where isallowed=1 ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		case "SupplierScoreDetail":
			$supplierid = Get("supplierid");
			$strSql = "Select beforescore,changescore,afterscore,reason,operator,operattime from supplierscorehistory  ";
			$strSql .= " where supplierid=$supplierid and operator!='' ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break;			
		case "ShowSupplierInfo":
			$supplierid = Get("supplierid");
			$custInfo = DBGetDataRowByField("supplierinfo","id",$supplierid);
			echo json_encode($custInfo);
			break;
//调整积分数据更新
		case "UpdateSupplierScore":
			$supplierid = Get("supplierid");
			$type = Get("type");
			$scorenum = Get("scorenum");
			$scorereason = Get("scorereason");
			$supplierInfo = DBGetDataRowByField("supplierinfo","id",$supplierid);
	//更新当前用户的积分
			DBBeginTrans();
	//更新履历表
			$arrFields = array("supplierid","changetype","beforescore","changescore","afterscore","reason","operator","operattime");
			if($type==-1){
				// $arrValues = array($supplierid,$type,$supplierInfo["score"],$scorenum,$supplierInfo["score"]-$scorenum,$scorereason,$_SESSION["uname"],$DB_FUNCTIONS["now"]);
				$arrValues = array($supplierid,$type,$supplierInfo["score"],$scorenum,$supplierInfo["score"]-$scorenum,$scorereason,'sun',$DB_FUNCTIONS["now"]);
			}
			if($type==1){
				// $arrValues = array($supplierid,$type,$supplierInfo["score"],$scorenum,$supplierInfo["score"]+$scorenum,$scorereason,$_SESSION["uname"],$DB_FUNCTIONS["now"]);
				$arrValues = array($supplierid,$type,$supplierInfo["score"],$scorenum,$supplierInfo["score"]+$scorenum,$scorereason,'sun',$DB_FUNCTIONS["now"]);
			}
			$r = DBInsertTableField("supplierscorehistory" , $arrFields ,$arrValues);
			if($r<=0)
				AjaxRollBack("-1");
			if($type==-1){
				$strSql = " Update supplierinfo Set score = score-$scorenum Where id = $supplierid ";
			}
			if($type==1){
				$strSql = " Update supplierinfo Set score = score+$scorenum Where id = $supplierid ";
			}
			if(!DBExecute($strSql))
				AjaxRollBack("-2");
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
				$strWhere = " order by $columnName $orderDir ";
			}
		}
		$strLimit = " limit $start , $length ";
		
		return array("where" => $strWhere , "limit" => $strLimit);
	} 
?>