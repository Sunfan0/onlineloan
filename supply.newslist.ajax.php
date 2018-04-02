<?php
	include "paras.php";
	$perpage = 30;
	$mode = Get("mode");
	switch($mode){
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
			$info = DBGetDataRowByField("supplierinfo" , array("username"),array($_SESSION["suppliername"]));
			$supplierid=$info["id"];
			$strSql = " SELECT * FROM `newslist` s ";
			$search = Get("search");
			$toLike = $search["value"];
			if($newstype!=0){
				$strSql .= " where s.supplierid=$supplierid and s.newstypeid=$newstype ";
				$strSql .= "and (s.title like '%" . $toLike . "%') ";
			}else{
				$strSql .= "where s.supplierid=$supplierid and (s.title like '%" . $toLike . "%') ";
			}
			$sqlPara = GetPageParas();
			$columns = Get("columns");
			$orders = Get("order");
			$columnName = $columns[$orders[0]["column"]]["data"];
			$orderDir = $orders[0]["dir"];
		
			$strSqlDetail = $strSql .'order by s.isstick desc,' .$columnName."\n".$orderDir. $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
			if($newstype!=0){
				$strSqlCountAll = "Select count(*) FROM newslist where supplierid=$supplierid and newstypeid=$newstype ";
			}else{
				$strSqlCountAll = "Select count(*) FROM newslist where supplierid=$supplierid ";
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
			$strSql = "Select * from subarea ";
			$subarea = DBGetDataRowsSimple($strSql);
			echo json_encode($subarea);
			break;
		case "UpdateNews":
			$data = json_decode(Get("data") , true);
			//判断该供方当天是否已经达到可以发布产品的上限数量
			//用到的数据表supplierinfo,newslist
			$info = DBGetDataRowByField("supplierinfo" , array("username"),array($_SESSION["suppliername"]));
			//1,获取当前用户允许的最大数量
			$newsmaxnum=$info["newsmaxnum"];
			$supplierid=$info["id"];
			$checkdate = date("Y-m-d");
			$strSql = "Select * from wholeneedcheck ";
			$checkdata = DBGetDataRow($strSql);
			$checkresult=json_decode($checkdata["result"],true);
			$result=$checkresult["news"];
			if($result==1){//不需要审核
				/* $arrFields = array("image","title","titlecolor","content","newstypeid","allowreply","isstick","supplierid","isallowed","reason","operattime","operator");
				$arrValues = array($data["image"],$data["title"],$data["titlecolor"],$data["content"],$data["newstypeid"],$data["allowreply"],$data["isstick"],$info["id"],1,"系统默认审核通过",$DB_FUNCTIONS["now"],"系统默认审核通过"); */
				$arrFields = array("image","title","titlecolor","content","newstypeid","isstick","supplierid","isallowed","reason","operattime","operator");
				$arrValues = array($data["image"],$data["title"],$data["titlecolor"],$data["content"],$data["newstypeid"],$data["isstick"],$info["id"],1,"系统默认审核通过",$DB_FUNCTIONS["now"],"系统默认审核通过");
			}else{
				/* $arrFields = array("image","title","titlecolor","content","newstypeid","allowreply","isstick","supplierid");
				$arrValues = array($data["image"],$data["title"],$data["titlecolor"],$data["content"],$data["newstypeid"],$data["allowreply"],$data["isstick"],$info["id"]); */
				$arrFields = array("image","title","titlecolor","content","newstypeid","isstick","supplierid");
				$arrValues = array($data["image"],$data["title"],$data["titlecolor"],$data["content"],$data["newstypeid"],$data["isstick"],$info["id"]);
			}
			
			DBBeginTrans();
			if($data["flagid"]==""){//新增
				
				//2,得出当前用户当天实际发布的数量
					$strSql = "Select count(*) from supplyinfo where supplierid=$supplierid and createtime =$checkdate";
					$datacount = DBGetDataRow($strSql);
					//echo $datacount;
					if($datacount[0]>$newsmaxnum){
						die("-99");//当天发布数量达到上限
					}
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
				if($result==1){
					$arrFieldshistory = array("newsid","operator","isallowed","reason","operattime");
					$arrValueshistory = array($newsId,"系统默认审核通过",1,"系统默认审核通过",$DB_FUNCTIONS["now"]);
					$r = DBInsertTableField("newscheckhistory" , $arrFieldshistory ,$arrValueshistory);
					if($r<=0)
						DBRollbackTrans("-2");
				}
				DBCommitTrans();
				$smarty->clearCache('newlistdetail.tpl',$newsId);
			}else{//修改
		//
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