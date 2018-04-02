<?php
	include "paras.php";
	if(!CheckRights3("bgaudit")){
		echo 123;
		die();
	}
	$mode = Get("mode");
	switch($mode){
		case "UpdateMoreSupplyinfo"://批量审核
			$data = json_decode(Get("data") , true);
			DBBeginTrans();
			for($i=0;$i<count($data["supplyinfoid"]);$i++){
				$infos = DBUpdateField("supplyinfo" , $data["supplyinfoid"][$i]["id"] , array("isallowed","reason","operattime","operator") ,array($data["status"],$data["reason"],$DB_FUNCTIONS["now"],$_SESSION["uname"]));
				if(!$infos)
					DBRollbackTrans("-1");
				$arrFields = array("supplyinfoid","operator","isallowed","reason","operattime");
				$arrValues = array($data["supplyinfoid"][$i]["id"],$_SESSION["uname"],$data["status"],$data["reason"],$DB_FUNCTIONS["now"]);
				$Id = DBInsertTableField("supplyinfocheckhistory" , $arrFields , $arrValues);
				if($Id<=0)
					AjaxRollBack('-9');
			}
			DBCommitTrans();
			$smarty->clearCache('smartypage-sun.tpl');
			echo 1;
			break;
		case "ShowSupplierList":
			$strSql = " SELECT * FROM `supplyinfo` s ";
			$strSql .= " Where s.isallowed = 0 ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "and (s.productname like '%" . $toLike . "%') ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM supplyinfo where isallowed=0 ";
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
			//显示字段不明确
			$strSql = " SELECT * FROM `supplyinfo` s ";
			$strSql .= " Where isallowed =0  ";
			$strSql .= " order by createtime desc ";
			$strSql .= " limit $p,$perpage ";
			$detail = DBGetDataRowsSimple($strSql);
		
			$strSql= "select  count(*) as total from supplyinfo Where isallowed =0 ";
			$result = DBGetDataRow($strSql);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
			break; */
		case "ShowSupplierDetail":
			$id = (int)(Get("id"));
	
			$strSql = "Select s.isstick,s.isallowed,s.productname,s.rate,s.paytime,s.paynum,s.needage,s.personalliushui,";
			$strSql .= "s.companyliushui,s.needindustry,s.lendtime,s.Featuresintroduce,s.allowreply,";
			$strSql .= "s1.id as producttype,s2.id as paytype,s3.id as worktime,s4.id as income, ";
			$strSql .= " s5.id as socialsecurity,s6.id as company,s7.id as property";
			$strSql .= " from supplyinfo s ";
			$strSql .= "left join supplyproducttype s1 on s.producttypeid=s1.id ";
			$strSql .= "left join supplypaytype s2 on s.paytypeid=s2.id ";
			$strSql .= "left join supplyneedworktime s3 on s.needworktimeid=s3.id ";
			$strSql .= "left join supplyneedincome s4 on s.needincomeid=s4.id ";
			$strSql .= "left join supplysocialsecurity s5 on s.socialsecurityid=s5.id ";
			$strSql .= "left join supplyneedcompany s6 on s.needcompanyid=s6.id ";
			$strSql .= "left join supplyneedproperty s7 on s.needpropertyid=s7.id ";
			$strSql .= "where s.id=$id ";
			$data = DBGetDataRow($strSql);

			$strSql = " SELECT s1.id,s1.professiontype FROM `supplyselectprofession` s ";//职业身份
			$strSql .= " left join professiontype s1 on s.professionid=s1.id ";
			$strSql .= " Where  s.supplyinfoid=$id and s.status = 0 ";
			$profession = DBGetDataRowsSimple($strSql);
			$data["profession"]=$profession;
			
			$strSql = " SELECT s1.id,s1.identity FROM `supplyselectidentity` s ";//身份要求
			$strSql .= " left join supplyneedidentity s1 on s.identityid=s1.id ";
			$strSql .= " Where  s.supplyinfoid=$id and s.status = 0 ";
			$identity = DBGetDataRowsSimple($strSql);
			$data["identity"]=$identity;
			
			$strSql = " SELECT s1.id,s1.credit FROM `supplyselectcredit` s ";//征信要求
			$strSql .= " left join needcredit s1 on s.creditid=s1.id ";
			$strSql .= " Where  s.supplyinfoid=$id and s.status = 0 ";
			$credit = DBGetDataRowsSimple($strSql);
			$data["credit"]=$credit;
		
			echo json_encode($data);
			break;
		/* case "ShowSupplierDetail":
			$id = Get("id");
			$strSql = "Select * from supplyinfo  ";
			$strSql.= " where id=$id ";
			$data = DBGetDataRow($strSql);
			echo json_encode($data);
			break; */
		case "UpdateSupplyinfo":
			$id = (int)(Get("id"));
			$status=Get("type");//1通过，-1拒绝
			$reason = Get("reason");
			$arrFields = array("supplyinfoid","operator","isallowed","reason","operattime");
			$arrValues = array($id,$_SESSION["uname"],$status,$reason,$DB_FUNCTIONS["now"]);
			DBBeginTrans();
			$infos = DBUpdateField("supplyinfo" , $id , array("isallowed","reason","operattime","operator") ,array($status,$reason,$DB_FUNCTIONS["now"],$_SESSION["uname"]));
			if(!$infos)
				DBRollbackTrans("-1");
			$r = DBInsertTableField("supplyinfocheckhistory" , $arrFields ,$arrValues);
			if($r<=0)
				DBRollbackTrans("-2");
			DBCommitTrans();
			$smarty->clearCache('smartypage-sun.tpl');
			echo 1;
			break;
		case "producttypelist":
			$strSql = "Select * from supplyproducttype ";
			$producttype = DBGetDataRowsSimple($strSql);
			echo json_encode($producttype);
			break;
		case "paytypelist":
			$strSql = "Select * from supplypaytype ";
			$paytype = DBGetDataRowsSimple($strSql);
			echo json_encode($paytype);
			break;
		case "worktimelist":
			$strSql = "Select * from supplyneedworktime ";
			$worktime = DBGetDataRowsSimple($strSql);
			echo json_encode($worktime);
			break;
		case "incomelist":
			$strSql = "Select * from supplyneedincome ";
			$income = DBGetDataRowsSimple($strSql);
			echo json_encode($income);
			break;
		case "professionlist":
			$strSql = "Select * from professiontype ";
			$profession = DBGetDataRowsSimple($strSql);
			echo json_encode($profession);
			break;
		case "identitylist":
			$strSql = "Select * from supplyneedidentity ";
			$identity = DBGetDataRowsSimple($strSql);
			echo json_encode($identity);
			break;
		case "companylist":
			$strSql = "Select * from supplyneedcompany ";
			$company = DBGetDataRowsSimple($strSql);
			echo json_encode($company);
			break;
		case "propertylist":
			$strSql = "Select * from supplyneedproperty ";
			$property = DBGetDataRowsSimple($strSql);
			echo json_encode($property);
			break;
		case "creditlist":
			$strSql = "Select * from needcredit ";
			$credit = DBGetDataRowsSimple($strSql);
			echo json_encode($credit);
			break;
		case "socialsecuritylist":
			$strSql = "Select * from supplysocialsecurity ";
			$socialsecurity = DBGetDataRowsSimple($strSql);
			echo json_encode($socialsecurity);
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