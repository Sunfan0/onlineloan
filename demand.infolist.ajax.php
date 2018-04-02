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
				$smarty->clearCache('needinfordetail.tpl',$data["demandinfoid"][$i]["id"]);
			}
			$smarty->clearCache('needinfor.tpl');
			$smarty->clearCache('smartypage-sun.tpl');
			echo 1;
			break;
		case "ShowdemandinfoList":
			$checkuser = DBGetDataRowByField("demanderinfo" , array("username"),array($_SESSION["demandername"]));
			$demanderid=$checkuser["id"];
			$strSql = " SELECT * FROM `demandinfo` s ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "where (s.title like '%" . $toLike . "%') and s.demanderid=$demanderid ";
			
			$sqlPara = GetPageParas();
			/* $columns = Get("columns");
			$orders = Get("order");
			$columnName = $columns[$orders[0]["column"]]["data"];
			$orderDir = $orders[0]["dir"];
		
			$strSqlDetail = $strSql .'order by s.isstick desc,' .$columnName."\n".$orderDir. $sqlPara["limit"]; */
			$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM demandinfo where demanderid=$demanderid ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		/* case "ShowdemandinfoList"://所有的需方信息列表
			$currentpage = Get("currentpage");
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;
			$strSql = " SELECT * FROM `demandinfo`  ";
			$strSql .= " order by createtime desc ";
			$strSql .= " limit $p,$perpage ";
			$detail = DBGetDataRowsSimple($strSql);
		
			$strSql= "select  count(*) as total from demandinfo ";
			$result = DBGetDataRow($strSql);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
			break; */
		
		case "ShowdemandinfoDetail":
			$id = (int)(Get("id"));
			//$strSql = "Select s.demandtypeid, s.isstick,s.title,s.titlecolor,s.name,s.demandnum,s.houseproperty,s.carproperty,s.personalliushui,";
			$strSql = "Select s.isstick,s.name,s.demandnum,s.houseproperty,s.carproperty,s.personalliushui,";
			$strSql .= "s.companyliushui,s.age,s.creditcardinfo,s.marriage,s.children,s.needcompanyid,s.demandstate,s.otherloans,";
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
		case "DeleteImg":
			$id =Get("id");
			if(!DBExecute("UPDATE `demandinfo` SET `aptitudeimg`='' WHERE id=".$id))
				echo -1;
			break;
		case "Updatedemandinfo":
			$data = json_decode(Get("data") , true);
			$strSql = "Select * from wholeneedcheck ";
			$checkdata = DBGetDataRow($strSql);
			$checkresult=json_decode($checkdata["result"],true);
			$result=$checkresult["demandinfo"];
			$checkusername = DBGetDataRowByField("demanderinfo" , array("username"),array($_SESSION["demandername"]));
			$userid=$checkusername["id"];
			if($result==1){
				/* $arrFields = array("demanderid","demandtypeid","title","titlecolor","isstick","showright","maxvisible","demandstate","name","demandnum","houseproperty","carproperty","socialsecurityid","age","marriage","children","needcompanyid","companyliushui","personalliushui","otherloans","demandtime","otherdesc","Applytime","aptitude","aptitudeimg","isallowed","reason","operattime","operator");
				$arrValues = array($userid,$data["demandtype"],$data["title"],$data["titlecolor"],$data["isstick"],$data["showright"],$data["maxvisible"],$data["demandstate"],$data["name"],$data["demandnum"],$data["houseproperty"],$data["carinfo"],$data["socialsecurity"],$data["age"],$data["marriage"],$data["children"],$data["company"],$data["companyrun"],$data["personalrun"],$data["otherloans"],$data["demandtime"],$data["otherdesc"],$DB_FUNCTIONS["now"],$data["aptitude"],$data["aptitudeimg"],1,"系统默认审核通过",$DB_FUNCTIONS["now"],"系统默认审核通过"); */
				$arrFields = array("issecure","demanderid","creditcardinfo","isstick","maxvisible","demandstate","name","demandnum","houseproperty","carproperty","socialsecurityid","age","marriage","children","needcompanyid","companyliushui","personalliushui","otherloans","demandtime","otherdesc","Applytime","aptitude","aptitudeimg","isallowed","reason","operattime","operator");
				$arrValues = array($data["issecure"],$userid,$data["creditcardinfo"],$data["isstick"],$data["maxvisible"],$data["demandstate"],$data["name"],$data["demandnum"],$data["houseproperty"],$data["carinfo"],$data["socialsecurity"],$data["age"],$data["marriage"],$data["children"],$data["company"],$data["companyrun"],$data["personalrun"],$data["otherloans"],$data["demandtime"],$data["otherdesc"],$DB_FUNCTIONS["now"],$data["aptitude"],$data["aptitudeimg"],1,"系统默认审核通过",$DB_FUNCTIONS["now"],"系统默认审核通过");
			}else{
				/* $arrFields = array("demanderid","demandtypeid","title","titlecolor","isstick","showright","maxvisible","demandstate","name","demandnum","houseproperty","carproperty","socialsecurityid","age","marriage","children","needcompanyid","companyliushui","personalliushui","otherloans","demandtime","otherdesc","Applytime","aptitude","aptitudeimg");
				$arrValues = array($userid,$data["demandtype"],$data["title"],$data["titlecolor"],$data["isstick"],$data["showright"],$data["maxvisible"],$data["demandstate"],$data["name"],$data["demandnum"],$data["houseproperty"],$data["carinfo"],$data["socialsecurity"],$data["age"],$data["marriage"],$data["children"],$data["company"],$data["companyrun"],$data["personalrun"],$data["otherloans"],$data["demandtime"],$data["otherdesc"],$DB_FUNCTIONS["now"],$data["aptitude"],$data["aptitudeimg"]);
				*/
				$arrFields = array("issecure","demanderid","creditcardinfo","isstick","maxvisible","demandstate","name","demandnum","houseproperty","carproperty","socialsecurityid","age","marriage","children","needcompanyid","companyliushui","personalliushui","otherloans","demandtime","otherdesc","Applytime","aptitude","aptitudeimg");
				$arrValues = array($data["issecure"],$userid,$data["creditcardinfo"],$data["isstick"],$data["maxvisible"],$data["demandstate"],$data["name"],$data["demandnum"],$data["houseproperty"],$data["carinfo"],$data["socialsecurity"],$data["age"],$data["marriage"],$data["children"],$data["company"],$data["companyrun"],$data["personalrun"],$data["otherloans"],$data["demandtime"],$data["otherdesc"],$DB_FUNCTIONS["now"],$data["aptitude"],$data["aptitudeimg"]);
			}
			
			DBBeginTrans();
			if($data["flagid"]==""){//新增
				$infoid = DBInsertTableField("demandinfo", $arrFields ,$arrValues);
				if($infoid<=0)
					AjaxRollBack('-8');
				$arrFieldsimg = array("demandinfoid","imgurl");
				$arrValuesimg = array($infoid,$data["aptitudeimg"]);
				$Id = DBInsertTableField("demandinfopic" , $arrFieldsimg , $arrValuesimg);
				if($Id<=0)
					AjaxRollBack('-9');
				if($result==1){
					$arrFieldshistory = array("demandinfoid","operator","isallowed","reason","operattime");
					$arrValueshistory = array($infoid,"系统默认审核通过",1,"系统默认审核通过",$DB_FUNCTIONS["now"]);
					$r = DBInsertTableField("demandinfocheckhistory" , $arrFieldshistory ,$arrValueshistory);
					if($r<=0)
						DBRollbackTrans("-2");
				}
				for($i=0;$i<count($data["Professioninfo"]);$i++){//职业身份
					if($data["Professioninfo"][$i]["status"]==1){
						$arrFields1 = array("demandinfoid","professionid");
						$arrValues1 = array($infoid,$data["Professioninfo"][$i]["id"]);
						$r = DBInsertTableField("demandselectprofession" , $arrFields1 , $arrValues1);
						if($r<=0)
							AjaxRollBack('-7');
					}
				}
				for($i=0;$i<count($data["creditinfo"]);$i++){//征信要求
					if($data["creditinfo"][$i]["status"]==1){
						$arrFields2 = array("demandinfoid","creditid");
						$arrValues2 = array($infoid,$data["creditinfo"][$i]["id"]);
						$r = DBInsertTableField("demandselectcredit" , $arrFields2 , $arrValues2);
						if($r<=0)
							AjaxRollBack('-9');
					}
				}
				for($i=0;$i<count($data["subarea"]);$i++){//子站
					if($data["subarea"][$i]["status"]==1){
						$arrFields3 = array("demandinfoid","subareaid");
						$arrValues3 = array($infoid,$data["subarea"][$i]["id"]);
						$r = DBInsertTableField("demandinfosubarea" , $arrFields3 , $arrValues3);
						if($r<=0)
							AjaxRollBack('-9');
					}
				}
				DBCommitTrans();
				$smarty->clearCache('needinfordetail.tpl',$Id);
			}else{//修改
				$r = DBUpdateField("demandinfo" , $data["flagid"] ,$arrFields, $arrValues);
				if(!$r)
					AjaxRollBack('-3');
				if(!DBExecute("DELETE FROM `demandinfopic` WHERE demandinfoid=".$data["flagid"]))
					AjaxRollBack('-33');//删除
				$arrFieldsimg = array("demandinfoid","imgurl");
				$arrValuesimg = array($data["flagid"],$data["aptitudeimg"]);
				$insertId = DBInsertTableField("demandinfopic" , $arrFieldsimg , $arrValuesimg);
				if($insertId<=0)
					AjaxRollBack('-09');
				for($i=0;$i<count($data["Professioninfo"]);$i++){//职业身份
					$data1 = DBGetDataRowByField("demandselectprofession" , array("demandinfoid","professionid"),array($data["flagid"],$data["Professioninfo"][$i]["id"]));
					if($data1==null&&$data["Professioninfo"][$i]["status"]==1){
						$arrFieldsu1 = array("demandinfoid","Professionid");
						$arrValuesu1 = array($data["flagid"],$data["Professioninfo"][$i]["id"]);
						$Id = DBInsertTableField("demandselectprofession" , $arrFieldsu1 , $arrValuesu1);
						if($Id<=0)
							AjaxRollBack('-7');
					}
					if($data1!=null&&$data["Professioninfo"][$i]["status"]==0){//本次设置取消
						if($data1["status"]==0){//标记取消此次记录
							$r = DBUpdateField("demandselectprofession" , $data1["id"] ,array("status"), array(-1));
							if(!$r)
								AjaxRollBack('-8');
						}
					}
					if($data1!=null&&$data["Professioninfo"][$i]["status"]==1){//重新选择
						if($data1["status"]==-1){
							$r = DBUpdateField("demandselectprofession" , $data1["id"] ,array("status"), array(0));
							if(!$r)
								AjaxRollBack('-8');
						}
					}
				}
				for($i=0;$i<count($data["creditinfo"]);$i++){//征信要求
					$data3 = DBGetDataRowByField("demandselectcredit" , array("demandinfoid","creditid"),array($data["flagid"],$data["creditinfo"][$i]["id"]));
					if($data3==null&&$data["creditinfo"][$i]["status"]==1){
						$arrFieldsu2 = array("demandinfoid","creditid");
						$arrValuesu2 = array($data["flagid"],$data["creditinfo"][$i]["id"]);
						$Id = DBInsertTableField("demandselectcredit" , $arrFieldsu2 , $arrValuesu2);
						if($Id<=0)
							AjaxRollBack('-7');
					}
					if($data3!=null&&$data["creditinfo"][$i]["status"]==0){//本次设置取消
						if($data3["status"]==0){//标记取消此次记录
							$r = DBUpdateField("demandselectcredit" , $data3["id"] ,array("status"), array(-1));
							if(!$r)
								AjaxRollBack('-8');
						}
					}
					if($data3!=null&&$data["creditinfo"][$i]["status"]==1){//重新选择
						if($data3["status"]==-1){
							$r = DBUpdateField("demandselectcredit" , $data3["id"] ,array("status"), array(0));
							if(!$r)
								AjaxRollBack('-8');
						}
					}
				}
				for($i=0;$i<count($data["subarea"]);$i++){//子站
					$data2 = DBGetDataRowByField("demandinfosubarea" , array("demandinfoid","subareaid"),array($data["flagid"],$data["subarea"][$i]["id"]));
					if($data2==null&&$data["subarea"][$i]["status"]==1){
						$arrFieldsu2 = array("demandinfoid","subareaid");
						$arrValuesu2 = array($data["flagid"],$data["subarea"][$i]["id"]);
						$Id = DBInsertTableField("demandinfosubarea" , $arrFieldsu2 , $arrValuesu2);
						if($Id<=0)
							AjaxRollBack('-7');
					}
					if($data2!=null&&$data["subarea"][$i]["status"]==0){//本次设置取消
						if($data2["status"]==0){//标记取消此次记录
							$r = DBUpdateField("demandinfosubarea" , $data2["id"] ,array("status"), array(-1));
							if(!$r)
								AjaxRollBack('-8');
						}
					}
					if($data2!=null&&$data["subarea"][$i]["status"]==1){//重新选择
						if($data2["status"]==-1){
							$r = DBUpdateField("demandinfosubarea" , $data2["id"] ,array("status"), array(0));
							if(!$r)
								AjaxRollBack('-8');
						}
					}
				}
					
					
				DBCommitTrans();
				$smarty->clearCache('needinfordetail.tpl',$data["flagid"]);
			}
			
			$smarty->clearCache('needinfor.tpl');
			$smarty->clearCache('smartypage-sun.tpl');
			echo 1;
			break;	
		case "Deletedemandinfo":
			$id = Get("id");
			$r = DBDeleteData("demandinfo" , $id);
			if($r > 0){
				echo 1;
			} else {
				echo -1;
			}
			$smarty->clearCache('needinfordetail.tpl',$id);
			$smarty->clearCache('needinfor.tpl');
			$smarty->clearCache('smartypage-sun.tpl');
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
		case "demandersubarea":
			$checkusername = DBGetDataRowByField("demanderinfo" , array("username"),array($_SESSION["demandername"]));
			$subareaid=$checkusername["subareaid"];
			echo $subareaid;
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