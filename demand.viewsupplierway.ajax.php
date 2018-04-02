<?php
	include "paras.php";
	$perpage = 30;
	$mode = Get("mode");
	switch($mode){
		case "ShowSupplierList":
			$demanderdata = DBGetDataRowByField("demanderinfo",array("username"),array($_SESSION["demandername"]));
			$demanderid=$demanderdata["id"];
			$strSql = " SELECT s.visittime,s.supplierid,s1.name,s1.type,s1.mobile FROM `suppliervisithistory` s ";
			$strSql .= " left join supplierinfo s1 on s.supplierid=s1.id ";
			$strSql .= " Where s.demanderid=$demanderid ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (s1.name like '%" . $toLike . "%') ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM suppliervisithistory  where demanderid=$demanderid ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		/* case "ShowSupplierList"://当前需方查看的所有的供方列表
			$currentpage = Get("currentpage");
			$demanderdata = DBGetDataRowByField("demanderinfo",array("username"),array($_SESSION["demandername"]));
			$demanderid=$demanderdata["id"];
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;
			$strSql = " SELECT s.visittime,s.supplierid,s1.username,s1.type,s1.mobile FROM `suppliervisithistory` s ";
			$strSql .= " left join supplierinfo s1 on s.supplierid=s1.id ";
			$strSql .= " Where s.demanderid=$demanderid ";
			$strSql .= " order by s.visittime desc ";
			$strSql .= " limit $p,$perpage ";
			$detail = DBGetDataRowsSimple($strSql);
		//
			$strSql= "select  count(*) as total from suppliervisithistory Where demanderid =$demanderid ";
			$result = DBGetDataRow($strSql);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
			break; */
		case "ShowSupplierinfoDetail"://供方详细信息
			$supplierid = Get("supplierid");
			$strSql = " SELECT  * FROM `supplierinfo` where id=$supplierid ";
			$detailInfo = DBGetDataRow($strSql);
			echo json_encode($detailInfo);
			break;
		case "ShowSupplyinfoList":
			$demanderdata = DBGetDataRowByField("demanderinfo",array("username"),array($_SESSION["demandername"]));
			$demanderid=$demanderdata["id"];
			$strSql = " SELECT d1.username,d1.mobile,d2.productname,d2.createtime FROM `suppliervisithistory` d ";
			$strSql .= " left join supplierinfo d1 on d.supplierid=d1.id ";
			$strSql .= " left join supplyinfo d2 on d1.id=d2.supplierid ";
			$strSql .= " where d.demanderid=$demanderid ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (d2.productname like '%" . $toLike . "%') ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM suppliervisithistory  where demanderid=$demanderid ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		/* case "ShowSupplyinfoList"://需方查看的供方发的所有的产品
			$demanderdata = DBGetDataRowByField("demanderinfo",array("username"),array($_SESSION["demandername"]));
			$demanderid=$demanderdata["id"];
			$currentpage = Get("currentpage");
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;
			$strSql = " SELECT d.visittime,d1.username,d1.mobile,d2.productname,d2.createtime FROM `suppliervisithistory` d ";
			$strSql .= " left join supplierinfo d1 on d.supplierid=d1.id ";
			$strSql .= " left join supplyinfo d2 on d1.id=d2.supplierid ";
			$strSql .= " where d.demanderid=$demanderid ";
			$strSql .= " order by d.visittime asc ";
			$strSql .= " limit $p,$perpage ";
			$detail = DBGetDataRowsSimple($strSql);
		
			$strSql= "select  count(*) as total from suppliervisithistory Where demanderid=$demanderid ";
			$result = DBGetDataRow($strSql);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
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