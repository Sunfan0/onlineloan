<?php
	include "paras.php";
	if(!CheckRights3("bginformation")){
		echo 123;
		die();
	}  
	$mode = Get("mode");
	switch($mode){
		/* case "test":
			$newsid = Get("newsid");
			$r=DBExecute(" UPDATE newslist SET clickcount=clickcount+1 WHERE id=$newsid ");
			if(!$r){
				echo -1;
			}else{	
				echo 1;
			} */
			/* $strSql = "Select * from newslist  ";
			$data = DBGetDataRowsSimple($strSql);
			echo json_encode($data); */
			//break; 
		case "DeleteMore"://批量删除
			$data = json_decode(Get("data") , true);
			DBBeginTrans();
			for($i=0;$i<count($data["newsid"]);$i++){
				$newsdata = DBGetDataRowByField("newslist" , array("id"),array($data["newsid"][$i]["id"]));
				$arrFields = array("newstypeid","isstick","clickcount","supplierid","publishname","title","titlecolor","image","content","allowreply","isallowed","reason","operator","operattime","recycletime");
				$arrValues = array($newsdata["newstypeid"],$newsdata["isstick"],$newsdata["clickcount"],$newsdata["supplierid"],$newsdata["publishname"],$newsdata["title"],$newsdata["titlecolor"],$newsdata["image"],$newsdata["content"],$newsdata["allowreply"],$newsdata["isallowed"],$newsdata["reason"],$newsdata["operator"],$newsdata["operattime"],$DB_FUNCTIONS["now"]);
				$Id = DBInsertTableField("newsrecyclebinlist" , $arrFields , $arrValues);
				if($Id<=0)
					AjaxRollBack('-1');
				$r = DBDeleteData("newslist" , $data["newsid"][$i]["id"]);
				if(!$r)
					AjaxRollBack("-2");
				DBCommitTrans();
				$smarty->clearCache('newlistdetail.tpl',$data["newsid"][$i]["id"]);
				$smarty->clearCache('newlist.tpl',$newsdata["newstypeid"]);
			}
			$smarty->clearCache('smartypage-sun.tpl');
			echo 1;
			break;
			
			
			
		case "ShowNewsList":
			$newstype = Get("newstype");//资讯类型id
			/* $checkuser = DBGetDataRowByField("bgmanager" , array("loginname"),array($_SESSION["uname"]));
			$managerid=$checkuser["id"];//当前登录站方id
			$strSql = "Select b.subareaid from bgmanagersubarea b ";
			$strSql .= "where b.managerid=$managerid and b.status=0  ";
			$datamanagersubarea = DBGetDataRowsSimple($strSql);//对应站方的地区id
			for($i=0;$i<count($datamanagersubarea);$i++){
				$data=$datamanagersubarea[];
				$strSql = " SELECT s.* FROM `newslist` s ";
				$strSql .= "left join newssubarea n on s.id=n.newsid ";
				$strSql .= "left join subarea s2 on n.subareaid=s2.id ";
				$strSql .= "where n.subareaid=$data and b.status=0  ";
			
			} */
			$strSql = " SELECT * FROM `newslist` s ";
			$search = Get("search");
			$toLike = $search["value"];
			if($newstype!=0){
				$strSql .= " where s.newstypeid=$newstype ";
				$strSql .= "and (s.title like '%" . $toLike . "%') ";
			}else{
				$strSql .= "where (s.title like '%" . $toLike . "%') ";
			}
			
			$sqlPara = GetPageParas();
			$columns = Get("columns");
			$orders = Get("order");
			$columnName = $columns[$orders[0]["column"]]["data"];
			$orderDir = $orders[0]["dir"];
		
			$strSqlDetail = $strSql .'order by s.isrecommend desc,s.isstick desc,' .$columnName."\n".$orderDir. $sqlPara["limit"]; 
			
			//echo $strSqlDetail;
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
			
			if($newstype!=0){
				$strSqlCountAll = "Select count(*) FROM newslist where newstypeid=$newstype ";
			}else{
				$strSqlCountAll = "Select count(*) FROM newslist ";
			}
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		
		case "ShownewsDetail":
			$id = (int)(Get("id"));
			$strSql = "Select * from newslist where id=$id ";//资讯的其他信息
			$datainfo = DBGetDataRow($strSql);
			if($datainfo==null){
				echo json_encode($datainfo);
				die();
			}
			$strSql = "Select * from newssubarea where newsid=$id and status=0 ";
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
			$strSql = "Select * from newstype where parentid=".$datainfo["newstypeid"];
			$secondnewstype = DBGetDataRowsSimple($strSql);
			$strSql = "Select * from newslabellist where newsid=$id  ";
			$newslabel = DBGetDataRowsSimple($strSql);
			
			$strSql = "Select * from newspic where newsid=$id ";
			$imgdata = DBGetDataRowsSimple($strSql);
			if($imgdata!=null){
				$datainfo["files"] = array();
				$datainfo["preview"] = array();
				 foreach($imgdata as $file){
					$arr = array();
					$arr["type"] = "image";
					$arr["key"] = $file["id"];
					$arr["extra"] = array("id"=>$file["id"]);
					$arr["url"] = "admin.newslist.ajax.php?mode=DeleteImg";
					array_push($datainfo["files"], $file["imgurl"]);
					
					array_push($datainfo["preview"],$arr);
				} 
			}
			$datainfo["subarealist"]=$subarealist;
			$datainfo["secondnewstype"]=$secondnewstype;
			$datainfo["newslabel"]=$newslabel;
			echo json_encode($datainfo);
			break;
		case "DeleteImg":
			$id =Get("id");
			if(!DBExecute("UPDATE `newslist` SET `imgurl`='' WHERE id=".$id))
				echo -1;
			break;
		case "newsfirsttypelist":
			$strSql = "Select * from newstype where parentid=0 and inuse=1 ";
			$newstype = DBGetDataRowsSimple($strSql);
			echo json_encode($newstype);
			break;
		case "newssecondtypelist":
			$parentid = Get("parentid");
			$strSql = "Select * from newstype where parentid=$parentid and inuse=1 ";
			$newstype = DBGetDataRowsSimple($strSql);
			echo json_encode($newstype);
			break;
		case "subarealist":
			/* $checkuser = DBGetDataRowByField("bgmanager" , array("loginname"),array($_SESSION["uname"]));
			$managerid=$checkuser["id"];
			$strSql = "Select s.id,s.name from bgmanagersubarea b ";
			$strSql .= "left join subarea s on b.subareaid=s.id ";
			$strSql .= "where b.managerid=$managerid and b.status=0  "; */
			$strSql = "Select * from subarea ";
			$subarea = DBGetDataRowsSimple($strSql);
			echo json_encode($subarea);
			break;
			
		case "UpdateNews":
	/*
		在list页面判断，supplierid!=0时出现设置是否拉黑发布者和扣除发布者积分的设置
	*/
			$data = json_decode(Get("data") , true);
			$arrFields = array("isrecommend","image","title","titlecolor","content","newstypeid","allowreply","isstick","publishname","isallowed","reason","operator","operattime");
			$arrValues = array($data["isrecommend"],$data["image"],$data["title"],$data["titlecolor"],$data["content"],$data["newstypeid"],$data["allowreply"],$data["isstick"],$_SESSION["uname"],1,"站方发布默认审核通过","站方发布默认审核通过",$DB_FUNCTIONS["now"]);
			DBBeginTrans();
			if($data["flagid"]==""){//新增
				$newsId = DBInsertTableField("newslist",$arrFields,$arrValues);
				if($newsId<=0)
					AjaxRollBack('-1');
				for($i=0;$i<count($data["subarea"]);$i++){//子站
					if($data["subarea"][$i]["status"]==1){
						$arrFields1 = array("newsid","subareaid");
						$arrValues1 = array($newsId,$data["subarea"][$i]["id"]);
						$Id = DBInsertTableField("newssubarea" , $arrFields1 , $arrValues1);
						if($Id<=0)
							AjaxRollBack('-9');
					}
				}
				$arrFieldsimg = array("newsid","imgurl");
				$arrValuesimg = array($newsId,$data["image"]);
				$Id = DBInsertTableField("newspic" , $arrFieldsimg , $arrValuesimg);
				if($Id<=0)
					AjaxRollBack('-09');
					
				$arr = explode(",",$data["label"]);
				$p = 0;					
				for($i=0;$i<count($arr);$i++){
					if($arr[$i]==""){
						array_splice($arr,$i,1);
					}
				}
				for($i=0;$i<count($arr);$i++){
					if($p == 0)
						$strSql = "Insert Into newslabellist (`newsid`,`labeltext`,`createtime`,`lastmodifytime`) Values ";
					$p++;
					$strSql .= " ('" . $newsId . "','".$arr[$i]."',".$DB_FUNCTIONS['now'].",".$DB_FUNCTIONS['now'].")";//拼接插入值

					if($p == count($arr)){
						$result = DBExecute($strSql);//插入操作
						if(!$result)
							AjaxRollBack("2");
					} else {
						$strSql .= " , ";
					}
				}
				$arrFieldshistory = array("newsid","operator","isallowed","reason","operattime");
				$arrValueshistory = array($newsId,"供方发布系统默认审核通过",1,"供方发布系统默认审核通过",$DB_FUNCTIONS["now"]);
				$r = DBInsertTableField("newscheckhistory" , $arrFieldshistory ,$arrValueshistory);
				if($r<=0)
					DBRollbackTrans("-2");
				DBCommitTrans();
				$smarty->clearCache('newlistdetail.tpl',$newsId);
				
			}else{//修改
//是否拉黑发布者
	//扣除发布者积分数目
	//只能对供方发布的处理
				
				$newsdata = DBGetDataRowByField("newslist" , array("id"),array($data["flagid"]));
				$supplierid=$newsdata["supplierid"];
				
				if($newsdata["isblack"]!=""&&$newsdata["changescore"]!=""){//进行拉黑，扣除
					//1拉黑发布者
					$arrFieldsblack = array("type","supplierid","operator","operattime","reason");
					$arrValuesblack = array($newsdata["isblack"],$supplierid,$_SESSION["uname"],$DB_FUNCTIONS["now"],'发布资讯内容不当');
					$r = DBUpdateField("supplierinfo" , $supplierid , array("isblacklist") ,array($newsdata["isblack"]));
					if(!$r)
						DBRollbackTrans("-1");
					$r = DBInsertTableField("supplierblacklist" , $arrFieldsblack ,$arrValuesblack);
					if($r<=0)
						DBRollbackTrans("-2");
					//2扣除积分,判断当前积分是否大于等于将要扣除的积分，积分履历
					$supplierInfo = DBGetDataRowByField("supplierinfo","id",$supplierid);
					if($data["changescore"]>$supplierInfo["score"]){
						die('-900');
					}
					$arrFieldsscore = array("supplierid","scoretype","changetype","beforescore","changescore","afterscore","reason","operator","operattime");
					$arrValuesscore = array($supplierid,-1,7,$supplierInfo["score"],$data["changescore"],$supplierInfo["score"]-$data["changescore"],'发布资讯内容不当',$_SESSION["uname"],$DB_FUNCTIONS["now"]);
					$r = DBInsertTableField("supplierscorehistory" , $arrFieldsscore ,$arrValuesscore);
					if($r<=0)
						AjaxRollBack("-3");
					$changescore=$data["changescore"];
					$r=DBExecute(" UPDATE supplierinfo SET score=score-$changescore WHERE id=$supplierid ");
					if(!$r)
						DBRollbackTrans("-4");
				} 
			
				$r = DBUpdateField("newslist" , $data["flagid"] ,$arrFields, $arrValues);
				if(!$r)
					AjaxRollBack('-3');
				for($i=0;$i<count($data["subarea"]);$i++){//子站
					$data1 = DBGetDataRowByField("newssubarea" , array("newsid","subareaid"),array($data["flagid"],$data["subarea"][$i]["id"]));
					if($data1==null&&$data["subarea"][$i]["status"]==1){
						$arrFields1 = array("newsid","subareaid");
						$arrValues1 = array($data["flagid"],$data["subarea"][$i]["id"]);
						$Id = DBInsertTableField("newssubarea" , $arrFields1 , $arrValues1);
						if($Id<=0)
							AjaxRollBack('-7');
					}
					if($data1!=null&&$data["subarea"][$i]["status"]==0){//本次设置取消
						if($data1["status"]==0){//标记取消此次记录
							$r = DBUpdateField("newssubarea" , $data1["id"] ,array("status"), array(-1));
							if(!$r)
								AjaxRollBack('-8');
						}
					}
					if($data1!=null&&$data["subarea"][$i]["status"]==1){//重新选择
						if($data1["status"]==-1){
							$r = DBUpdateField("newssubarea" , $data1["id"] ,array("status"), array(0));
							if(!$r)
								AjaxRollBack('-8');
						}
					}
				}
				
				if(!DBExecute("DELETE FROM `newspic` WHERE newsid=".$data["flagid"]))
					AjaxRollBack('-33');//删除
				$arrFieldsimg = array("newsid","imgurl");
				$arrValuesimg = array($data["flagid"],$data["image"]);
				$insertId = DBInsertTableField("newspic" , $arrFieldsimg , $arrValuesimg);
				if($insertId<=0)
					AjaxRollBack('-09');
				
				
				$arr = explode(",",$data["label"]);
				for($i=0;$i<count($arr);$i++){
					$data1 = DBGetDataRowByField("newslabellist" , array("newsid","labeltext"),array($data["flagid"],$arr[$i]));
					$arrFields1 = array("newsid","labeltext");
					$arrValues1 = array($data["flagid"],$arr[$i]);
					if($data1==null){//新添加的或者修改了之前的
						$Id = DBInsertTableField("newslabellist" , $arrFields1 , $arrValues1);
						if($Id<=0)
							AjaxRollBack('4');
					}else{//数据库中已经存在的
						$id = DBUpdateField("newslabellist" , $data1["id"] ,$arrFields1, $arrValues1);
						if(!$id)
							AjaxRollBack("5");
					}
				}
				DBCommitTrans();
				$smarty->clearCache('newlistdetail.tpl',$data["flagid"]);
			}
			$smarty->clearCache('newlist.tpl',$data["newstypeid"]);
			$smarty->clearCache('smartypage-sun.tpl');
			
			echo 1;
			break;	
		case "Deletenews":
			$id = Get("id");
			$newsdata = DBGetDataRowByField("newslist" , array("id"),array($id));
			$arrFields = array("newstypeid","isstick","clickcount","supplierid","publishname","title","titlecolor","image","content","allowreply","isallowed","reason","operator","operattime","recycletime");
			$arrValues = array($newsdata["newstypeid"],$newsdata["isstick"],$newsdata["clickcount"],$newsdata["supplierid"],$newsdata["publishname"],$newsdata["title"],$newsdata["titlecolor"],$newsdata["image"],$newsdata["content"],$newsdata["allowreply"],$newsdata["isallowed"],$newsdata["reason"],$newsdata["operator"],$newsdata["operattime"],$DB_FUNCTIONS["now"]);
			DBBeginTrans();
			$Id = DBInsertTableField("newsrecyclebinlist" , $arrFields , $arrValues);
			if($Id<=0)
				AjaxRollBack('-1');
			$r = DBDeleteData("newslist" , $id);
			if(!$r)
				AjaxRollBack("-2");
			DBCommitTrans();
			$smarty->clearCache('newlistdetail.tpl',$id);
			$smarty->clearCache('newlist.tpl',$newsdata["newstypeid"]);
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