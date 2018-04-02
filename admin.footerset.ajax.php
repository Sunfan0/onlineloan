<?php
	include "paras.php";
	if(!CheckRights3("bgset")){
		echo 123;
		die();
	}
	$perpage = 30;
	$mode = Get("mode");
	switch($mode){
		case "DeleteMore"://批量删除
			$data = json_decode(Get("data") , true);
			for($i=0;$i<count($data["footerid"]);$i++){
				$r = DBDeleteData("footervaried" , $data["footerid"][$i]["id"]);
				if(!$r)
					die("-1");
			}
			echo 1;
			break;
		case "FooterList":
			$strSql = " select * from footervaried f ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "where (f.title like '%" . $toLike . "%') ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM footervaried ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		/*case "FooterList":
			$strSql = " select * from footervaried order by createtime desc ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break;*/ 
		case "ShowFooter":
			$id = Get("id");
			$strSql = " select f1.id,f1.title,f1.content,f.id as typeid,f.name from footervaried f1 ";
			$strSql .= " left join  footertype f on f1.footertypeid=f.id";
			$strSql .= " where f1.id= $id ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break;
		case "FootertypeList":
			$strSql = " select * from footertype order by createtime desc ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break;
		case "DeleteFooter":
			$id = Get("id");
			$r = DBDeleteData("footervaried" , $id);
			if($r > 0){
				echo 1;
			} else {
				echo -1;
			}
			break;
		case "UpdateFooter":
			$data = json_decode(Get("data") , true);
			$arrFields = array("title","content","footertypeid");
			$arrValues = array($data["title"],$data["content"],$data["typeid"]);
			if($data["flagid"]==""){//新增
				$r = DBInsertTableField("footervaried" , $arrFields ,$arrValues);
				if($r > 0){
					$smarty->clearCache('smartypage-sun.tpl');
					echo 1;
				} else {
					echo -1;
				}
				die();
			}else{//修改
				$r = DBUpdateField("footervaried" , $data["flagid"] ,$arrFields, $arrValues);
				if($r){
					$smarty->clearCache('smartypage-sun.tpl');
					echo 1;
				}else{
					echo -1;
				}
				die();
			}
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