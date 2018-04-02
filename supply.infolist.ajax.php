<?php
	include "paras.php";
	$mode = Get("mode");
	switch($mode){
		case "CheckRights":
			$supplierinfo = DBGetDataRowByField("supplierinfo" , array("username"),array($_SESSION["suppliername"]));
			//imgurl,地区，company，type
			if($supplierinfo["imgurl"]=''){
				die('-9');
			}else{
				die('1');
			}
			
			break;
		case "DeleteMore"://批量删除
			$data = json_decode(Get("data") , true);
			for($i=0;$i<count($data["supplyinfoid"]);$i++){
				$r = DBDeleteData("supplyinfo" , $data["supplyinfoid"][$i]["id"]);
				if(!$r)
					die("-1");
				$smarty->clearCache('supplyinfodetail.tpl',$data["supplyinfoid"][$i]["id"]);
			}
			echo 1;
			$smarty->clearCache('smartypage-sun.tpl');
			break;
		case "ShowsupplyinfoList":
			$supplierinfo = DBGetDataRowByField("supplierinfo" , array("username"),array($_SESSION["suppliername"]));
			$supplierid=$supplierinfo["id"];
			$strSql = " SELECT * FROM supplyinfo s ";
			$search = Get("search");
			$toLike = $search["value"];
			$strSql .= "where s.supplierid=$supplierid  and (s.productname like '%" . $toLike . "%' or s.Featuresintroduce like '%" . $toLike . "%') ";
			//$strSql .= "where  (s.productname like '%" . $toLike . "%' or s.Featuresintroduce like '%" . $toLike . "%') ";
			
			$sqlPara = GetPageParas();
			$columns = Get("columns");
			$orders = Get("order");
			$columnName = $columns[$orders[0]["column"]]["data"];
			$orderDir = $orders[0]["dir"];
		
			$strSqlDetail = $strSql .'order by s.isstick desc,s.createtime desc,' .$columnName."\n".$orderDir. $sqlPara["limit"];
			
			
			//$strSqlDetail = $strSql . $sqlPara["where"] . $sqlPara["limit"];
			$dataDetail = DBGetDataRowsSimple($strSqlDetail);
		
			$strSqlCountAll = "Select count(*) FROM supplyinfo where supplierid=$supplierid ";
			//$strSqlCountAll = "Select count(*) FROM supplyinfo  ";
			$dataCountAll = DBGetDataRow($strSqlCountAll);

			$result["data"] = $dataDetail;
			$result["draw"] = Get("draw");
			$result["recordsFiltered"] = $dataCountAll[0];
			$result["recordsTotal"] = $dataCountAll[0];
			echo json_encode($result);
			break;
		/* case "ShowsupplyinfoList"://所有的供方产品列表
			$currentpage = Get("currentpage");
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;
			$strSql = " SELECT * FROM `supplyinfo`  ";
			$strSql .= " order by createtime desc ";
			$strSql .= " limit $p,$perpage ";
			$detail = DBGetDataRowsSimple($strSql);
		
			$strSql= "select  count(*) as total from supplyinfo ";
			$result = DBGetDataRow($strSql);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
			break; */
		
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
			
			
		case "Updatesupplyinfo":
			$data = json_decode(Get("data") , true);
			//判断该供方当天是否已经达到可以发布产品的上限数量
			//用到的数据表supplierinfo,supplyinfo
			$supplierinfo = DBGetDataRowByField("supplierinfo" , array("username"),array($_SESSION["suppliername"]));
			//1,获取当前用户允许的最大数量
			$productmaxnum=$supplierinfo["productmaxnum"];
			$supplierid=$supplierinfo["id"];
			$beforescore=$supplierinfo["score"];
			$checkdate = date("Y-m-d");
			$strSql = "Select * from wholeneedcheck ";
			$checkdata = DBGetDataRow($strSql);
			$checkresult=json_decode($checkdata["result"],true);
			$result=$checkresult["supplyinfo"];
			if($result==1){//不需要审核
				$arrFields = array("supplierid","allowreply","producttypeid","isstick","productname","rate","paytypeid","paytime","paynum","needworktimeid","needincomeid","needage","socialsecurityid","needcompanyid","companyliushui","personalliushui","needindustry","needpropertyid","lendtime","Featuresintroduce","isallowed","reason","operattime","operator");
				$arrValues = array($supplierid,$data["allowreply"],$data["producttype"],$data["isstick"],$data["productname"],$data["rate"],$data["paytype"],$data["paytime"],$data["paynum"],$data["needyear"],$data["needincome"],$data["needage"],$data["socialrequest"],$data["needcompany"],$data["companyliushui"],$data["personalliushui"],$data["worktype"],$data["needproperty"],$data["needtime"],$data["Featuresintroduce"],1,"系统默认审核通过",$DB_FUNCTIONS["now"],"系统默认审核通过");
			}else{
				$arrFields = array("supplierid","allowreply","producttypeid","isstick","productname","rate","paytypeid","paytime","paynum","needworktimeid","needincomeid","needage","socialsecurityid","needcompanyid","companyliushui","personalliushui","needindustry","needpropertyid","lendtime","Featuresintroduce");
				//$arrFields = array("supplierid","allowreply","producttype","loannum","isstick","productname","rate","paytype","paytime","paynum","needyear","needincome","needage","worktype","nationality","needcompany","needliushui","needprofession","needproperty","needcredit","needtime","Featuresintroduce");
				//$arrValues = array($supplierid,$data["allowreply"],$data["producttype"],$data["loannum"],$data["isstick"],$data["productname"],$data["rate"],$data["paytype"],$data["paytime"],$data["paynum"],$data["needyear"],$data["needincome"],$data["needage"],$data["worktype"],$data["nationality"],$data["needcompany"],$data["needliushui"],$data["needprofession"],$data["needproperty"],$data["needcredit"],$data["needtime"],$data["Featuresintroduce"]);
				$arrValues = array($supplierid,$data["allowreply"],$data["producttype"],$data["isstick"],$data["productname"],$data["rate"],$data["paytype"],$data["paytime"],$data["paynum"],$data["needyear"],$data["needincome"],$data["needage"],$data["socialrequest"],$data["needcompany"],$data["companyliushui"],$data["personalliushui"],$data["worktype"],$data["needproperty"],$data["needtime"],$data["Featuresintroduce"]);
			}
			$strSql = " Select * From scorerule order by createtime limit 0,1 ";
			$scoredata = DBGetDataRow($strSql);
			$publishgoodsscore=$scoredata["publishgoodsscore"];
			
			DBBeginTrans();
			if($data["flagid"]==""){//新增
				//2,得出当前用户当天实际发布的数量
					$strSql = "Select count(*) from supplyinfo where supplierid=$supplierid and createtime =$checkdate";
				
					$datacount = DBGetDataRow($strSql);
	
					if($datacount[0]>$productmaxnum){
						die("-99");//当天发布数量达到上限
					}
					
				$infoid = DBInsertTableField("supplyinfo", $arrFields ,$arrValues);
				if($infoid<=0)
					AjaxRollBack('-1');
				if($result==1){//不需要审核，插入履历
					$arrFieldshistory = array("supplyinfoid","operator","isallowed","reason","operattime");
					$arrValueshistory = array($infoid,"系统默认审核通过",1,"系统默认审核通过",$DB_FUNCTIONS["now"]);
					$pr = DBInsertTableField("supplyinfocheckhistory" , $arrFieldshistory ,$arrValueshistory);
					if($pr<=0)
						DBRollbackTrans("-3");
				}
				
				$dr=DBExecute(" UPDATE supplierinfo SET score=score+$publishgoodsscore  WHERE id=$supplierid ");
				if(!$dr)
					AjaxRollBack('-3');
					
				$arrFieldsscorehistory = array("supplierid","scoretype","changetype","beforescore","changescore","afterscore","reason","operattime");
				$arrValuesscorehistory = array($supplierid,1,1,$beforescore,$publishgoodsscore,$publishgoodsscore+$beforescore,'发布产品',$DB_FUNCTIONS["now"]);
				$r = DBInsertTableField("supplierscorehistory" , $arrFieldsscorehistory ,$arrValuesscorehistory);
				if($r<=0)
					DBRollbackTrans("-31");
				
				for($i=0;$i<count($data["Professioninfo"]);$i++){//职业身份
					if($data["Professioninfo"][$i]["status"]==1){
						$arrFields1 = array("supplyinfoid","professionid");
						$arrValues1 = array($infoid,$data["Professioninfo"][$i]["id"]);
						$r = DBInsertTableField("supplyselectprofession" , $arrFields1 , $arrValues1);
						if($r<=0)
							AjaxRollBack('-7');
					}
				}
				for($i=0;$i<count($data["identityinfo"]);$i++){//身份要求
					if($data["identityinfo"][$i]["status"]==1){
						$arrFields2 = array("supplyinfoid","identityid");
						$arrValues2 = array($infoid,$data["identityinfo"][$i]["id"]);
						$r = DBInsertTableField("supplyselectidentity" , $arrFields2 , $arrValues2);
						if($r<=0)
							AjaxRollBack('-8');
					}
				}
				for($i=0;$i<count($data["needcredit"]);$i++){//征信要求
					if($data["needcredit"][$i]["status"]==1){
						$arrFields2 = array("supplyinfoid","creditid");
						$arrValues2 = array($infoid,$data["needcredit"][$i]["id"]);
						$r = DBInsertTableField("supplyselectcredit" , $arrFields2 , $arrValues2);
						if($r<=0)
							AjaxRollBack('-9');
					}
				}
				DBCommitTrans();
				$smarty->clearCache('supplyinfodetail.tpl',$r);
			}else{//修改
				$r = DBUpdateField("supplyinfo" , $data["flagid"] ,$arrFields, $arrValues);
				if(!$r)
					AjaxRollBack('-2');
				
				for($i=0;$i<count($data["Professioninfo"]);$i++){//职业身份
					$data1 = DBGetDataRowByField("supplyselectprofession" , array("supplyinfoid","professionid"),array($data["flagid"],$data["Professioninfo"][$i]["id"]));
					if($data1==null&&$data["Professioninfo"][$i]["status"]==1){
						$arrFieldsu1 = array("supplyinfoid","Professionid");
						$arrValuesu1 = array($data["flagid"],$data["Professioninfo"][$i]["id"]);
						$Id = DBInsertTableField("supplyselectprofession" , $arrFieldsu1 , $arrValuesu1);
						if($Id<=0)
							AjaxRollBack('-7');
					}
					if($data1!=null&&$data["Professioninfo"][$i]["status"]==0){//本次设置取消
						if($data1["status"]==0){//标记取消此次记录
							$r = DBUpdateField("supplyselectprofession" , $data1["id"] ,array("status"), array(-1));
							if(!$r)
								AjaxRollBack('-8');
						}
					}
					if($data1!=null&&$data["Professioninfo"][$i]["status"]==1){//重新选择
						if($data1["status"]==-1){
							$r = DBUpdateField("supplyselectprofession" , $data1["id"] ,array("status"), array(0));
							if(!$r)
								AjaxRollBack('-8');
						}
					}
				}
				for($i=0;$i<count($data["identityinfo"]);$i++){//身份要求
					$data2 = DBGetDataRowByField("supplyselectidentity" , array("supplyinfoid","identityid"),array($data["flagid"],$data["identityinfo"][$i]["id"]));
					if($data2==null&&$data["identityinfo"][$i]["status"]==1){
						$arrFieldsu2 = array("supplyinfoid","identityid");
						$arrValuesu2 = array($data["flagid"],$data["identityinfo"][$i]["id"]);
						$Id = DBInsertTableField("supplyselectidentity" , $arrFieldsu2 , $arrValuesu2);
						if($Id<=0)
							AjaxRollBack('-7');
					}
					if($data2!=null&&$data["identityinfo"][$i]["status"]==0){//本次设置取消
						if($data2["status"]==0){//标记取消此次记录
							$r = DBUpdateField("supplyselectidentity" , $data2["id"] ,array("status"), array(-1));
							if(!$r)
								AjaxRollBack('-8');
						}
					}
					if($data2!=null&&$data["identityinfo"][$i]["status"]==1){//重新选择
						if($data2["status"]==-1){
							$r = DBUpdateField("supplyselectidentity" , $data2["id"] ,array("status"), array(0));
							if(!$r)
								AjaxRollBack('-8');
						}
					}
				}
				for($i=0;$i<count($data["needcredit"]);$i++){//征信要求
					$data3 = DBGetDataRowByField("supplyselectcredit" , array("supplyinfoid","creditid"),array($data["flagid"],$data["needcredit"][$i]["id"]));
					if($data3==null&&$data["needcredit"][$i]["status"]==1){
						$arrFieldsu2 = array("supplyinfoid","creditid");
						$arrValuesu2 = array($data["flagid"],$data["needcredit"][$i]["id"]);
						$Id = DBInsertTableField("supplyselectcredit" , $arrFieldsu2 , $arrValuesu2);
						if($Id<=0)
							AjaxRollBack('-7');
					}
					if($data3!=null&&$data["needcredit"][$i]["status"]==0){//本次设置取消
						if($data3["status"]==0){//标记取消此次记录
							$r = DBUpdateField("supplyselectcredit" , $data3["id"] ,array("status"), array(-1));
							if(!$r)
								AjaxRollBack('-8');
						}
					}
					if($data3!=null&&$data["needcredit"][$i]["status"]==1){//重新选择
						if($data3["status"]==-1){
							$r = DBUpdateField("supplyselectcredit" , $data3["id"] ,array("status"), array(0));
							if(!$r)
								AjaxRollBack('-8');
						}
					}
				}
				
				DBCommitTrans();
				$smarty->clearCache('supplyinfodetail.tpl',$data["flagid"]);
			}
			$smarty->clearCache('smartypage-sun.tpl');
			echo 1;
			break;	
		case "Deletesupplyinfo":
			$id = Get("id");
			$r = DBDeleteData("supplyinfo" , $id);
			if($r > 0){
				echo 1;
			} else {
				echo -1;
			}
			$smarty->clearCache('supplyinfodetail.tpl',$id);
			$smarty->clearCache('smartypage-sun.tpl');
			break;
		case "CheckRefreshNum"://提示刷新次数，超出扣除积分
			$id = Get("id");
			$supplierinfo = DBGetDataRowByField("supplierinfo" , array("username"),array($_SESSION["suppliername"]));
			$supplierid=$supplierinfo["id"];
			
			$strSql = " Select * From scorerule order by createtime limit 0,1 ";
			$showdata = DBGetDataRow($strSql);
			$refreshproductmaxnum=$showdata["refreshproductmaxnum"];
			$refreshproducttakescore=$showdata["refreshproducttakescore"];
			
			$strSql = " Select refreshcount from refreshsupplyinfohistory where refreshday = date_format(now(),'%Y-%m-%d') and supplierid=$supplierid  ";//判断当天刷新次数
			$refreshcount = DBGetDataRow($strSql);
			if($refreshcount==null){
				$r=DBInsertTableField("refreshsupplyinfohistory",array("supplierid","refreshday"),array($supplierid,date('Y-m-d')));
				if($r<=0){
					die('-1');
				}
			}
			$result=array();
			$result['leavenum']=$refreshproductmaxnum-$refreshcount["refreshcount"];
			$result['needscore']=$refreshproducttakescore;
			//页面上可能需要判断$result['leavenum']的值分别调用不同的ajax
			//$result['leavenum']<=0(Refreshneedscore)//超出次数
			//$result['leavenum']>0(Refreshfree)//未超出
			//$result['needscore']//超出扣除积分
			echo json_encode($result);
			break;
			
		case "Refreshfree"://未达到最大上限，增加次数，刷新产品
			$id = Get("id");//产品id
			$supplierinfo = DBGetDataRowByField("supplierinfo" , array("username"),array($_SESSION["suppliername"]));
			$supplierid=$supplierinfo["id"];
			DBBeginTrans();
			$getCountInfo = DBGetDataRowByField("refreshsupplyinfohistory",array("supplierid","refreshday"),array($supplierid,date('Y-m-d')));
			if(!DBUpdateField("refreshsupplyinfohistory",$getCountInfo["id"],array("refreshcount"),array($getCountInfo["refreshcount"]+1)))
				AjaxRollBack('-4');
			$r = DBUpdateField("supplyinfo" , $id ,array("createtime"), array($DB_FUNCTIONS["now"]));
			if(!$r){
				AjaxRollBack('-2');
			}
			DBCommitTrans();
			echo 1;
			break;
		case "RefreshNeedScore"://超出需要积分
			$id = Get("id");//产品id
			$supplierinfo = DBGetDataRowByField("supplierinfo" , array("username"),array($_SESSION["suppliername"]));
			$supplierid=$supplierinfo["id"];
			$beforescore=$supplierinfo["score"];
			
			$strSql = " Select * From scorerule order by createtime limit 0,1 ";
			$showdata = DBGetDataRow($strSql);
			$refreshproductmaxnum=$showdata["refreshproductmaxnum"];
			$refreshproducttakescore=$showdata["refreshproducttakescore"];
			
			DBBeginTrans();
			//超出限制次数，扣积分
			if($beforescore<$refreshproducttakescore){
				die('-9');//积分不足
			}
			$arrFieldsscorehistory = array("supplierid","scoretype","changetype","beforescore","changescore","afterscore","reason","operattime");
			$arrValuesscorehistory = array($supplierid,-1,10,$beforescore,$refreshproducttakescore,$beforescore-$refreshproducttakescore,'刷新产品信息',$DB_FUNCTIONS["now"]);
			$r = DBInsertTableField("supplierscorehistory" , $arrFieldsscorehistory ,$arrValuesscorehistory);
			if($r<=0)
				AjaxRollBack("-2");
			$r=DBExecute(" UPDATE supplierinfo SET score=score-$refreshproducttakescore  WHERE id=$supplierid ");
			if(!$r)
				AjaxRollBack('-3');
			$r = DBUpdateField("supplyinfo" , $id ,array("createtime"), array($DB_FUNCTIONS["now"]));
			if(!$r){
				AjaxRollBack('-2');
			}
			DBCommitTrans();
			echo 1;
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