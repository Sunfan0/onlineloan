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
			for($i=0;$i<count($data["bannerid"]);$i++){
				$r = DBDeleteData("banner" , $data["bannerid"][$i]["id"]);
				if(!$r)
					die("-1");
			}
			echo 1;
			break;
		case "BannerList":
			$strSql = " select * from banner b ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "where (b.text like '%" . $toLike . "%') or (b.shortdesc like '%" . $toLike . "%') ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM banner ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		/* case "BannerList":
			$strSql = " select * from banner order by createtime desc ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break; */
		case "DeleteBanner":
			$id = Get("id");
			$r = DBDeleteData("banner" , $id);
			if($r > 0){
				echo 1;
			} else {
				echo -1;
			}
			break;
		case "ShowBanner":
			$id = (int)(Get("id"));
			$strSql = "Select * from banner where id=$id ";
			$data = DBGetDataRow($strSql);
			$strSql = "Select * from bannerpic where bannerid=$id ";
			$imgdata = DBGetDataRowsSimple($strSql);
			if($imgdata!=null){
				$data["files"] = array();
				$data["preview"] = array();
				 foreach($imgdata as $file){
					$arr = array();
					$arr["type"] = "image";
					$arr["key"] = $file["id"];
					$arr["extra"] = array("id"=>$file["id"]);
					$arr["url"] = "admin.banner.ajax.php?mode=DeleteImg";
					array_push($data["files"], $file["imgurl"]);
					
					array_push($data["preview"],$arr);
				} 
			}
			echo json_encode($data);
			break;
		case "DeleteImg":
			$id =Get("id");
			if(!DBExecute("UPDATE `banner` SET `imgurl`='' WHERE id=".$id))
				echo -1;
			break;
		case "UpdateBanner":
			$flagid = Get("flagid");//判断是更新还是新增
			$text = Get("text");
			$imgurl = Get("imgurl");
			$shortdesc = Get("shortdesc");
			$linkurl = Get("linkurl");
			$arrFields = array("imgurl","text","shortdesc","linkurl");
			$arrValues = array($imgurl,$text,$shortdesc,$linkurl);
			DBBeginTrans();
			if($flagid==""){//新增
				$r = DBInsertTableField("banner", $arrFields ,$arrValues);
				if($r<=0)
					AjaxRollBack('-8');
				$arrFieldsimg = array("bannerid","imgurl");
				$arrValuesimg = array($r,$imgurl);
				$Id = DBInsertTableField("bannerpic" , $arrFieldsimg , $arrValuesimg);
				if($Id<=0)
					AjaxRollBack('-9');
			}else{//修改
				$r = DBUpdateField("banner" , $flagid ,$arrFields, $arrValues);
				if(!$r)
					AjaxRollBack('-3');
				if(!DBExecute("DELETE FROM `bannerpic` WHERE bannerid=".$flagid))
					AjaxRollBack('-33');//删除
				$arrFieldsimg = array("bannerid","imgurl");
				$arrValuesimg = array($flagid,$imgurl);
				$insertId = DBInsertTableField("bannerpic" , $arrFieldsimg , $arrValuesimg);
				if($insertId<=0)
					AjaxRollBack('-09');
			}
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