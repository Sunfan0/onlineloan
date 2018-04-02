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
			for($i=0;$i<count($data["cooperatid"]);$i++){
				$r = DBDeleteData("cooperatagency" , $data["cooperatid"][$i]["id"]);
				if(!$r)
					die("-1");
			}
			echo 1;
			break;
		case "CooperationList":
			$strSql = " select * from cooperatagency s ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "where (s.name like '%" . $toLike . "%') or (s.descp like '%" . $toLike . "%') ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM cooperatagency ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		/* case "CooperationList":
			$strSql = " select * from cooperatagency order by createtime desc ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break; */
		case "DeleteCooperation":
			$id = Get("id");
			$r = DBDeleteData("cooperatagency" , $id);
			if($r > 0){
				echo 1;
			} else {
				echo -1;
			}
			break;
		case "ShowCooperation":
			$id = (int)(Get("id"));
			$strSql = "Select * from cooperatagency where id=$id ";
			$data = DBGetDataRow($strSql);
			$strSql = "Select * from cooperatpic where cooperatid=$id ";
			$imgdata = DBGetDataRowsSimple($strSql);
			if($imgdata!=null){
				$data["files"] = array();
				$data["preview"] = array();
				 foreach($imgdata as $file){
					$arr = array();
					$arr["type"] = "image";
					$arr["key"] = $file["id"];
					$arr["extra"] = array("id"=>$file["id"]);
					$arr["url"] = "admin.cooperation.ajax.php?mode=DeleteImg";
					array_push($data["files"], $file["imgurl"]);
					
					array_push($data["preview"],$arr);
				} 
			}
			echo json_encode($data);
			break;
		//上传文件从数据库读取数据显示
		case "DeleteImg":
			$id =Get("id");
			if(!DBExecute("UPDATE `cooperatagency` SET `imgurl`='' WHERE id=".$id))
				echo -1;
			break;
		case "UpdateCooperation":
			$flagid = Get("flagid");//判断是更新还是新增
			$name = Get("name");
			$imgurl = Get("imgurl");
			$descp = Get("descp");
			$linkurl = Get("linkurl");
			$arrFields = array("imgurl","name","descp","linkurl");
			$arrValues = array($imgurl,$name,$descp,$linkurl);
			DBBeginTrans();
			if($flagid==""){//新增
				$r = DBInsertTableField("cooperatagency", $arrFields ,$arrValues);
				if($r<=0)
					AjaxRollBack('-8');
				$arrFieldsimg = array("cooperatid","imgurl");
				$arrValuesimg = array($r,$imgurl);
				$Id = DBInsertTableField("cooperatpic" , $arrFieldsimg , $arrValuesimg);
				if($Id<=0)
					AjaxRollBack('-9');
			}else{//修改
				$r = DBUpdateField("cooperatagency" , $flagid ,$arrFields, $arrValues);
				if(!$r)
					AjaxRollBack('-3');
				if(!DBExecute("DELETE FROM `cooperatpic` WHERE cooperatid=".$flagid))
					AjaxRollBack('-33');//删除
				$arrFieldsimg = array("cooperatid","imgurl");
				$arrValuesimg = array($flagid,$imgurl);
				$insertId = DBInsertTableField("cooperatpic" , $arrFieldsimg , $arrValuesimg);
				if($insertId<=0)
					AjaxRollBack('-09');
			}
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