<?php
	include "paras.php";
	if(!CheckRights3("bgset")){
		echo 123;
		die();
	}
	$mode = Get("mode");
	switch($mode){
		case "UpdateType":
			$data = json_decode(Get("data") , true);
			$arrFields = array("parentid","inuse","name","sort");
			$arrValues = array($data["parentid"],1,$data["name"],0);
			if($data["id"] == "")
				$r = DBInsertTableField("newstype",$arrFields,$arrValues);
			else
				$r = DBUpdateField("newstype" , $data["id"] , $arrFields , $arrValues);
			if($r > 0 || $r === true)
				echo 1;
			else
				echo -1;
			break;
		case "UpdateSorttype":
			$data = json_decode(Get("data") , true);
			DBBeginTrans();
			foreach($data as $d){
				if(!DBUpdateField("newstype",$d["id"],"sort",$d["sort"]))
					AjaxRollBack();
			}
			DBCommitTrans();
			echo 1;
			break;
		case "showtype":
			$id = Get("id");
			$data = DBGetDataRowByField("newstype" , array("id"),array($id));
			echo json_encode($data);
			break;
		case "deletetype":
			$id = Get("id");
			$id = DBUpdateField("newstype" , $id , array("inuse") ,array(0));
			if($id > 0){
				echo 1;//更新成功
			} else {
				echo -1;//更新失败
			}
			break;
		case "gettypelist":
			$strSql = " SELECT p.id , p.parentid , p.sort ,p.name , \n";
			$strSql .= " c.id as cid , c.parentid as cparentid , c.sort as csort , c.name as cname \n";
			$strSql .= " FROM `newstype` p  \n";
			$strSql .= " left join `newstype` c on p.id = c.parentid \n";
			$strSql .= " WHERE p.parentid = 0 and p.inuse = 1 and IFNULL (c.inuse,1)=1 \n";
			$strSql .= "  order by p.sort , c.parentid , c.sort \n";
			$result = DBGetDataRows($strSql);
			if($result == null){
				echo -1;
				break;
			}
			$list = array();
			for($i=0;$i<count($result);$i++){
				if(!isset($list[$result[$i]["id"]])){
					$list[$result[$i]["id"]] = array();
					$list[$result[$i]["id"]]["id"] = $result[$i]["id"];
					$list[$result[$i]["id"]]["parentid"] = $result[$i]["parentid"];
					$list[$result[$i]["id"]]["sort"] = count($list);
					$list[$result[$i]["id"]]["name"] = $result[$i]["name"];
					$list[$result[$i]["id"]]["childtype"] = array();//里边又重新放置一个数组
				}
				if($result[$i]["cid"] == null)
					continue;
				$row = array();
				$row["id"] = $result[$i]["cid"];
				$row["parentid"] = $result[$i]["cparentid"];
				$row["sort"] = count($list[$result[$i]["id"]]["childtype"]) + 1;
				$row["name"] = $result[$i]["cname"];
  
				array_push($list[$result[$i]["id"]]["childtype"],$row);
			}
			$arr = array();
			
			foreach($list as $o){
				$arr[] = $o;
			}
			
			echo json_encode($arr);
			break;		
		
		
		
	}
?>