<?php
	include "paras.php";
	if(!CheckRights3("bgnotice")){
		echo 123;
		die();
	}
	$perpage=30;
	$mode = Get("mode");
	switch($mode){
	//1中介,2机构,0全部
		case "SupplierList"://供方
			$suppliertype=Get("suppliertype");
			$currentpage = Get("currentpage");
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;
			$strSql = " select id,username,type from supplierinfo  ";
			if($suppliertype==0){
				$strSql .= " where isallowed=1 ";
			}else{
				$strSql .= " where isallowed=1 and type=$suppliertype ";
			}
			$strSql .= " order by createtime asc ";
			$strSql .= " limit $p,$perpage ";
			$detail = DBGetDataRowsSimple($strSql);
			if($suppliertype==0){
				$strSql1= "select  count(*) as total from supplierinfo  where isallowed=1 ";
			}else{
				$strSql1= "select  count(*) as total from supplierinfo  where isallowed=1 and type=$suppliertype ";
			}
			$result = DBGetDataRow($strSql1);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
			break;
	//1中介1,2机构1,0全部需方
		case "DemanderList"://需方
			$demandertype=Get("demandertype");
			$currentpage = Get("currentpage");
			$currentpage=$currentpage-1;
			$p=$currentpage*$perpage;
			$strSql = " select id,username from demanderinfo  ";
			if($demandertype==0){
				$strSql .= " where isallowed=1 ";
			}else{
				$strSql .= " where isallowed=1 and type=$demandertype ";
			}
			$strSql .= " order by createtime asc ";
			$strSql .= " limit $p,$perpage ";
			$detail = DBGetDataRowsSimple($strSql);
			// if($suppliertype==0){
			if($demandertype==0){
				$strSql1= "select  count(*) as total from demanderinfo  where isallowed=1 ";
			}else{
				$strSql1= "select  count(*) as total from demanderinfo  where isallowed=1 and type=$demandertype ";
			}
			$result = DBGetDataRow($strSql1);
			$detailInfo['data']=$detail;
			$detailInfo['total']=$result['total'];
			$detailInfo["pagecount"]=ceil($detailInfo["total"]/$perpage);
			$detailInfo["perpage"]=$perpage;
			echo json_encode($detailInfo);
			break;
		case "SubmitSend":
			$data = json_decode(Get("data") , true);
			$arrFields = array("title","content","operator","sendtime");
			$arrValues = array($data["title"],$data["content"],$_SESSION["uname"],$DB_FUNCTIONS["now"]);
			DBBeginTrans();
			$noticeId = DBInsertTableField("websitenotice",$arrFields,$arrValues);
			if($noticeId<=0)
				AjaxRollBack('-1');
//选择的需方和供方分别放在$data["demander"]和$data["supplier"]（包含demanderid和supplierid）
//数据库receivertype(1供方2需方)		
			for($i=0;$i<count($data["supplier"]);$i++){
				$arrFields1 = array("noticeid","receiverid","receivertype");
				$arrValues1 = array($noticeId,$data["supplier"][$i]["supplierid"],1);
				$Id = DBInsertTableField("websitenoticehistory" , $arrFields1 , $arrValues1);
				if($Id<=0)
					AjaxRollBack('-2');
			}	
			for($i=0;$i<count($data["demander"]);$i++){
				$arrFields2 = array("noticeid","receiverid","receivertype");
				$arrValues2 = array($noticeId,$data["demander"][$i]["demanderid"],2);
				$Id = DBInsertTableField("websitenoticehistory" , $arrFields2 , $arrValues2);
				if($Id<=0)
					AjaxRollBack('-3');
			}
			DBCommitTrans();
			echo 1;
			break;
	}
?>