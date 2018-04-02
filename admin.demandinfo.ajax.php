<?php
	include "paras.php";
	$perpage = 30;
	$mode = Get("mode");
	switch($mode){
		case "DeleteMore"://批量删除
			$data = json_decode(Get("data") , true);
			for($i=0;$i<count($data["demandinfoid"]);$i++){
				$r = DBDeleteData("demandinfo" , $data["demandinfoid"][$i]["id"]);
				if(!$r)
					die("-1");
				//$smarty->clearCache('needinfordetail.tpl',$data["demandinfoid"][$i]["id"]);
			}
			/* $smarty->clearCache('needinfor.tpl');
			$smarty->clearCache('smartypage-sun.tpl'); */
			echo 1;
			break;
		case "ShowdemandinfoList":
			/* $checkuser = DBGetDataRowByField("demanderinfo" , array("username"),array($_SESSION["demandername"]));
			$demanderid=$checkuser["id"]; */
			$strSql = " SELECT * FROM `demandinfo` s ";
			$search = Get("search");
			$toLike = $search["value"];
			//$strSql .= "where (s.title like '%" . $toLike . "%') and s.demanderid=$demanderid ";
			$strSql .= "where (s.title like '%" . $toLike . "%') ";
			
			$sqlPara = GetPageParas();
			/* $columns = Get("columns");
			$orders = Get("order");
			$columnName = $columns[$orders[0]["column"]]["data"];
			$orderDir = $orders[0]["dir"];
		
			$strSqlDetail = $strSql .'order by s.isstick desc,' .$columnName."\n".$orderDir. $sqlPara["limit"]; */
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			//$strSqlCountAll = "Select count(*) FROM demandinfo where demanderid=$demanderid ";
			$strSqlCountAll = "Select count(*) FROM demandinfo  ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		
		
		case "ShowdemandinfoDetail":
			$id = (int)(Get("id"));
			//$strSql = "Select s.demandtypeid, s.isstick,s.title,s.titlecolor,s.name,s.demandnum,s.houseproperty,s.carproperty,s.personalliushui,";
			$strSql = "Select s.isstick,s.name,s.demandnum,s.houseproperty,s.carproperty,s.personalliushui,";
			$strSql .= "s.companyliushui,s.age,s.marriage,s.children,s.needcompanyid,s.demandstate,s.otherloans,";
			//$strSql .= " s.demandtime,s.otherdesc,s.Applytime,s.aptitude,s.aptitudeimg,s.showright,s.maxvisible, ";
			$strSql .= " s.demandtime,s.otherdesc,s.Applytime,s.aptitude,s.aptitudeimg,s.maxvisible, ";
			$strSql .= " s1.id as socialsecurity ";
			$strSql .= " from demandinfo s ";
			$strSql .= "left join supplysocialsecurity s1 on s.socialsecurityid=s1.id ";
			$strSql .= "where s.id=$id ";
			//echo $strSql;
			$data = DBGetDataRow($strSql);
			$strSql = " SELECT s1.id,s1.professiontype FROM `demandselectprofession` s ";//职业身份
			$strSql .= " left join professiontype s1 on s.professionid=s1.id ";
			$strSql .= " Where  s.demandinfoid=$id and s.status = 0 ";
			$profession = DBGetDataRowsSimple($strSql);
			$data["profession"]=$profession;
			$strSql = " SELECT s1.id,s1.credit FROM `demandselectcredit` s ";//征信要求
			$strSql .= " left join needcredit s1 on s.creditid=s1.id ";
			$strSql .= " Where  s.demandinfoid=$id and s.status = 0 ";
			$credit = DBGetDataRowsSimple($strSql);
			$data["credit"]=$credit;
			$strSql = " SELECT s1.id,s1.name FROM `demandinfosubarea` s ";//子站
			$strSql .= " left join subarea s1 on s.subareaid=s1.id ";
			$strSql .= " Where s.demandinfoid=$id and s.status = 0 ";
			//echo $strSql;
			$subarea = DBGetDataRowsSimple($strSql);
			$data["subarea"]=$subarea;
			/* $strSql = "Select * from demandinfopic where demandinfoid=$id ";
			$imgdata = DBGetDataRowsSimple($strSql);
			if($imgdata!=null){
				$data["files"] = array();
				$data["preview"] = array();
				 foreach($imgdata as $file){
					$arr = array();
					$arr["type"] = "image";
					$arr["key"] = $file["id"];
					$arr["extra"] = array("id"=>$file["id"]);
					$arr["url"] = "demand.infolist.ajax.php?mode=DeleteImg";
					array_push($data["files"], $file["imgurl"]);
					
					array_push($data["preview"],$arr);
				} 
			} */
			echo json_encode($data);
			break;
	
		
		case "Deletedemandinfo":
			$id = Get("id");
			$r = DBDeleteData("demandinfo" , $id);
			if($r > 0){
				echo 1;
			} else {
				echo -1;
			}
			/* $smarty->clearCache('needinfordetail.tpl',$id);
			$smarty->clearCache('needinfor.tpl');
			$smarty->clearCache('smartypage-sun.tpl'); */
			break;
		case "Refreshdemandinfo":
			$id = Get("id");
			$r = DBUpdateField("demandinfo" , $id ,array("createtime"), array($DB_FUNCTIONS["now"]));
			if($r)
				echo 1;
			else
				echo -1;
			break;
		case "professionlist":
			$strSql = "Select * from professiontype ";
			$profession = DBGetDataRowsSimple($strSql);
			echo json_encode($profession);
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
		case "subarealist":
			$strSql = "Select * from subarea ";
			$subarea = DBGetDataRowsSimple($strSql);
			echo json_encode($subarea);
			break;
		case "producttypelist":
			$strSql = "Select * from supplyproducttype ";
			$producttype = DBGetDataRowsSimple($strSql);
			echo json_encode($producttype);
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