<?php
	include "paras.php";
	$mode = Get("mode");
	switch($mode){
		case "DeleteMore"://批量删除
			$data = json_decode(Get("data") , true);
			for($i=0;$i<count($data["supplyinfoid"]);$i++){
				$r = DBDeleteData("supplyinfo" , $data["supplyinfoid"][$i]["id"]);
				if(!$r)
					die("-1");
				//$smarty->clearCache('supplyinfodetail.tpl',$data["supplyinfoid"][$i]["id"]);
			}
			echo 1;
			//$smarty->clearCache('smartypage-sun.tpl');
			break;
		case "ShowsupplyinfoList":
			/* $supplierinfo = DBGetDataRowByField("supplierinfo" , array("username"),array($_SESSION["suppliername"]));
			$supplierid=$supplierinfo["id"]; */
			$strSql = " SELECT * FROM supplyinfo s ";
			$search = Get("search");
			$toLike = $search["value"];
			//$strSql .= "where s.supplierid=$supplierid  and (s.productname like '%" . $toLike . "%' or s.Featuresintroduce like '%" . $toLike . "%') ";
			$strSql .= "where  (s.productname like '%" . $toLike . "%' or s.Featuresintroduce like '%" . $toLike . "%') ";
			
			$sqlPara = GetPageParas();
			$columns = Get("columns");
			$orders = Get("order");
			$columnName = $columns[$orders[0]["column"]]["data"];
			$orderDir = $orders[0]["dir"];
		
			$strSqlDetail = $strSql .'order by s.isstick desc,' .$columnName."\n".$orderDir. $sqlPara["limit"]; 
			
			
			
			//$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			//$strSqlCountAll = "Select count(*) FROM supplyinfo where supplierid=$supplierid ";
			$strSqlCountAll = "Select count(*) FROM supplyinfo  ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		
		case "ShowsupplyinfoDetail":
			$id = (int)(Get("id"));
	
			$strSql = "Select s.isstick,s.productname,s.rate,s.paytime,s.paynum,s.needage,s.personalliushui,";
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
		
		case "Deletesupplyinfo":
			$id = Get("id");
			$r = DBDeleteData("supplyinfo" , $id);
			if($r > 0){
				echo 1;
			} else {
				echo -1;
			}
			/* $smarty->clearCache('supplyinfodetail.tpl',$id);
			$smarty->clearCache('smartypage-sun.tpl'); */
			break;
		case "Refreshsupplyinfo":
			$id = Get("id");
			$r = DBUpdateField("supplyinfo" , $id ,array("createtime"), array($DB_FUNCTIONS["now"]));
			if($r)
				echo 1;
			else
				echo -1;
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