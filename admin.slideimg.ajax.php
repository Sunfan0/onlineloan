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
			DBBeginTrans();
			for($i=0;$i<count($data["slideimgid"]);$i++){
				if(!DBExecute("DELETE FROM `slideimginfo` WHERE id=".$data["slideimgid"][$i]["id"]))
					AjaxRollBack('-1');//删除
				if(!DBExecute("DELETE FROM `slideimgpic` WHERE slideimgid=".$data["slideimgid"][$i]["id"]))
					AjaxRollBack('-2');//删除
				if(!DBExecute("DELETE FROM `slideimgsubarea` WHERE slideimgid=".$data["slideimgid"][$i]["id"]))
					AjaxRollBack('-3');//删除
			}
			DBCommitTrans();
			echo 1;
			break;
		case "slideimgList":
			$strSql = " select * from slideimginfo s ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "where (s.text like '%" . $toLike . "%') ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM slideimginfo ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		/* case "slideimgList":
			$strSql = " select * from slideimginfo order by createtime desc ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break; */
		case "Deleteslideimg":
			$id = Get("id");
			DBBeginTrans();
			if(!DBExecute("DELETE FROM `slideimginfo` WHERE id=".$id))
				AjaxRollBack('-1');//删除
			if(!DBExecute("DELETE FROM `slideimgpic` WHERE slideimgid=".$id))
				AjaxRollBack('-2');//删除
			if(!DBExecute("DELETE FROM `slideimgsubarea` WHERE slideimgid=".$id))
				AjaxRollBack('-3');//删除
			DBCommitTrans();
			echo 1;
			break;
		case "Showslideimg":
			$id = (int)(Get("id"));
			$strSql = "Select * from slideimginfo where id=$id ";
			$data = DBGetDataRow($strSql);
			$strSql = "Select s.id,s.name from slideimgsubarea s1  ";
			$strSql .= " left join subarea s on s1.subareaid=s.id ";
			$strSql .= " where s1.slideimgid=$id and s1.status=0 ";
			$subareadata = DBGetDataRowsSimple($strSql);
			$strSql = "Select * from slideimgpic where slideimgid=$id ";
			$imgdata = DBGetDataRowsSimple($strSql);
			if($imgdata!=null){
				$data["files"] = array();
				$data["preview"] = array();
				 foreach($imgdata as $file){
					$arr = array();
					$arr["type"] = "image";
					$arr["key"] = $file["id"];
					$arr["extra"] = array("id"=>$file["id"]);
					$arr["url"] = "admin.slideimg.ajax.php?mode=DeleteImg";
					array_push($data["files"], $file["imgurl"]);
					
					array_push($data["preview"],$arr);
				} 
			}
			$data["subarea"]=$subareadata;
			echo json_encode($data);
			break;
		case "DeleteImg":
			$id =Get("id");
			if(!DBExecute("UPDATE `slideimginfo` SET `imgurl`='' WHERE id=".$id))
				echo -1;
			break;
		case "subarealist":
			$strSql = "Select * from subarea ";
			$subarea = DBGetDataRowsSimple($strSql);
			echo json_encode($subarea);
			break;
		case "Updateslideimg":
			$data = json_decode(Get("data") , true);
			$arrFields = array("imgurl","text","linkurl");
			$arrValues = array($data["imgurl"],$data["text"],$data["linkurl"]);
			DBBeginTrans();
			if($data["flagid"]==""){//新增
				$r = DBInsertTableField("slideimginfo", $arrFields ,$arrValues);
				if($r<=0)
					AjaxRollBack('-8');
				$arrFieldsimg = array("slideimgid","imgurl");
				$arrValuesimg = array($r,$data["imgurl"]);
				$Id = DBInsertTableField("slideimgpic" , $arrFieldsimg , $arrValuesimg);
				if($Id<=0)
					AjaxRollBack('-9');
				for($i=0;$i<count($data["subarea"]);$i++){//子站
					if($data["subarea"][$i]["status"]==1){
						$arrFields1 = array("slideimgid","subareaid");
						$arrValues1 = array($r,$data["subarea"][$i]["id"]);
						$Id = DBInsertTableField("slideimgsubarea" , $arrFields1 , $arrValues1);
						if($Id<=0)
							AjaxRollBack('-9');
					}
				}
			}else{//修改
				$r = DBUpdateField("slideimginfo" , $data["flagid"] ,$arrFields, $arrValues);
				if(!$r)
					AjaxRollBack('-3');
				if(!DBExecute("DELETE FROM `slideimgpic` WHERE slideimgid=".$data["flagid"]))
					AjaxRollBack('-33');//删除
				$arrFieldsimg = array("slideimgid","imgurl");
				$arrValuesimg = array($data["flagid"],$data["imgurl"]);
				$insertId = DBInsertTableField("slideimgpic" , $arrFieldsimg , $arrValuesimg);
				if($insertId<=0)
					AjaxRollBack('-09');
				for($i=0;$i<count($data["subarea"]);$i++){//子站
					$data1 = DBGetDataRowByField("slideimgsubarea" , array("slideimgid","subareaid"),array($data["flagid"],$data["subarea"][$i]["id"]));
					if($data1==null&&$data["subarea"][$i]["status"]==1){
						$arrFields1 = array("slideimgid","subareaid");
						$arrValues1 = array($data["flagid"],$data["subarea"][$i]["id"]);
						$Id = DBInsertTableField("slideimgsubarea" , $arrFields1 , $arrValues1);
						if($Id<=0)
							AjaxRollBack('-7');
					}
					if($data1!=null&&$data["subarea"][$i]["status"]==0){//本次设置取消
						if($data1["status"]==0){//标记取消此次记录
							$r = DBUpdateField("slideimgsubarea" , $data1["id"] ,array("status"), array(-1));
							if(!$r)
								AjaxRollBack('-8');
						}
					}
				}
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