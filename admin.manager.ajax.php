<?php
	include "paras.php";
	$mode = Get("mode");
	if(!CheckRights3("bgmanager")){
		echo 123;
		die();
	}
	switch($mode){
		case "subarealist":
			$strSql = "Select * from subarea ";
			$subarea = DBGetDataRowsSimple($strSql);
			echo json_encode($subarea);
			break;
		case "DeleteMore"://批量删除
			$data = json_decode(Get("data") , true);
			for($i=0;$i<count($data["managerid"]);$i++){
				$r = DBDeleteData("bgmanager" , $data["managerid"][$i]["id"]);
				if(!$r)
					die("-1");
			}
			echo 1;
			break;
		case "ShowAllBgmanager":
			$strSql = "Select b.id,b.loginname,b.rights,b.remarks from bgmanager b ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "where (b.loginname like '%" . $toLike . "%') or (b.remarks like '%" . $toLike . "%')  ";
			$sqlPara = GetPageParas();
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM bgmanager ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
	/* 	case "ShowAllBgmanager"://后台账号显示
			$strSql = "Select b.id,b.loginname,b.rights,b.remarks from bgmanager b ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data);
			break; */
		case "ShowOneBgmanager"://账号详细信息显示
			$id = Get("id");
			$strSql = "Select id,loginname,rights,remarks from bgmanager b ";
			$strSql.= " where id=$id ";
			$data = DBGetDataRow($strSql);
			if($data==null){
				echo json_encode($data);
				die();
			}
			$strSql = "Select * from bgmanagersubarea where managerid=$id and status=0 ";
			$subarea = DBGetDataRowsSimple($strSql);
			$subarealist = array();
			for($i=0;$i<count($subarea);$i++){
				$strSql = "Select * from subarea where id=".$subarea[$i]["subareaid"];
				$dataarea = DBGetDataRow($strSql);
				$row = array();
				$row["id"] = $dataarea["id"];
				$row["name"] = $dataarea["name"];
				array_push($subarealist,$row);
			}//子站
			$data["subarealist"]=$subarealist;
			echo json_encode($data);
			break;
		case "UpdateBgmanager"://更新账号信息
			/* $flagid = Get("flagid");//判断是更新还是新增
			$loginname = Get("username");
			$password = Get("password");
			$remarks = Get("remarks");
			$bgmanager = Get('bgmanager');//账号管理
			$bgaudit = Get('bgaudit');//审核管理
			$bgauditrecord = Get('bgauditrecord');//审核履历管理
			$bginformation = Get('bginformation');//资讯管理
			$bgcounter = Get('bgcounter');//贷款计算器管理
			$bgset = Get('bgset');//设置管理
			$bginteract = Get('bginteract');//互动详情管理
			$bgscore = Get('bgscore');//机构积分管理
			$bgnotice = Get('bgnotice');//站内通知管理
			$bguserinfo = Get('bguserinfo');//用户信息管理 */
			$data = json_decode(Get("data") , true);
			$userInfo = DBGetDataRowByField("bgmanager",array("loginname"),array($data["username"]));	
			$checksupplyname = DBGetDataRowByField("supplierinfo" , array("username"),array($data["username"]));
			$checkdemandname = DBGetDataRowByField("demanderinfo" , array("username"),array($data["username"]));
			$manager = array("bgmanager"=>$data["bgmanager"],"bgaudit"=>$data["bgaudit"],"bgauditrecord"=>$data["bgauditrecord"] ,"bginformation"=>$data["bginformation"] ,"bgcounter"=>$data["bgcounter"] ,"bgset"=>$data["bgset"],"bginteract"=>$data["bginteract"],"bgscore"=>$data["bgscore"],"bgnotice"=>$data["bgnotice"],"bguserinfo"=>$data["bguserinfo"]);
			$rights=json_encode($manager);
			if($data["password"]=='d41d8cd98f00b204e9800998ecf8427e'){
				$arrFields = array("remarks","loginname","rights");
				$arrValues = array($data["remarks"],$data["username"],$rights);
			}else{
				$arrFields = array("remarks","loginname","password","rights");
				$arrValues = array($data["remarks"],$data["username"],$data["password"],$rights);
			}
			DBBeginTrans();
			if($data["flagid"]==""){//新增
				if($userInfo!=null||$checksupplyname!=null||$checkdemandname!=null){
					die("-9");//用户名已经注册
				}
				$managerId = DBInsertTableField("bgmanager" , $arrFields ,$arrValues);
				if($managerId<=0)
					AjaxRollBack('-1');
				for($i=0;$i<count($data["subarea"]);$i++){//子站
					if($data["subarea"][$i]["status"]==1){
						$arrFields1 = array("managerid","subareaid");
						$arrValues1 = array($managerId,$data["subarea"][$i]["id"]);
						$Id = DBInsertTableField("bgmanagersubarea" , $arrFields1 , $arrValues1);
						if($Id<=0)
							AjaxRollBack('-9');
					}
				}
			}else{//修改
				$r = DBUpdateField("bgmanager" , $flagid ,$arrFields, $arrValues);
				if($r<=0)
					AjaxRollBack('-1');
				for($i=0;$i<count($data["subarea"]);$i++){//子站
					$data1 = DBGetDataRowByField("bgmanagersubarea" , array("managerid","subareaid"),array($data["flagid"],$data["subarea"][$i]["id"]));
					if($data1==null&&$data["subarea"][$i]["status"]==1){
						$arrFields1 = array("managerid","subareaid");
						$arrValues1 = array($data["flagid"],$data["subarea"][$i]["id"]);
						$Id = DBInsertTableField("bgmanagersubarea" , $arrFields1 , $arrValues1);
						if($Id<=0)
							AjaxRollBack('-7');
					}
					if($data1!=null&&$data["subarea"][$i]["status"]==0){//本次设置取消
						if($data1["status"]==0){//标记取消此次记录
							$r = DBUpdateField("bgmanagersubarea" , $data1["id"] ,array("status"), array(-1));
							if(!$r)
								AjaxRollBack('-8');
						}
					}
					if($data1!=null&&$data["subarea"][$i]["status"]==1){//重新选择
						if($data1["status"]==-1){
							$r = DBUpdateField("bgmanagersubarea" , $data1["id"] ,array("status"), array(0));
							if(!$r)
								AjaxRollBack('-6');
						}
					}
				}
			}
			DBCommitTrans();
			echo 1;
			break;
		case "DeleteBgmanager"://删除
			$id = Get("id");
			$r = DBDeleteData("bgmanager" , $id);
			if($r > 0){
				echo 1;
			} else {
				echo -1;
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