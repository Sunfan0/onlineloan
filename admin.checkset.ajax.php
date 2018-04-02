<?php
	include "paras.php";
	$mode = Get("mode");
	if(!CheckRights3("bgset")){
		echo 123;
		die();
	}
	switch($mode){
		case "ShowAlldata"://审核总开关页面显示
			$strSql = "Select * from wholeneedcheck ";
			$data = DBGetDataRow($strSql);
			echo json_encode($data);
			break;
		case "UpdateCheck"://更新审核信息
			$id = (int)(Get("id"));
			$supplier = Get('supplier');//供方注册
			$supplyinfo = Get('supplyinfo');//产品发布
			$demander = Get('demander');//需方注册
			$demandinfo = Get('demandinfo');//需求信息发布
			$news = Get('news');//资讯发布
			$modify = Get('modify');//供方实名认证
			$result = array("supplier"=>$supplier,"supplyinfo"=>$supplyinfo,"demander"=>$demander ,"demandinfo"=>$demandinfo ,"news"=>$news ,"modify"=>$modify);
			$result=json_encode($result);
			$arrFields = array("result","operator","operattime");
			$arrValues = array($result,'weilina',$DB_FUNCTIONS["now"]);
			DBBeginTrans();//$_SESSION["uname"]
			$r = DBUpdateField("wholeneedcheck" , $id ,array("result"),array($result));
			if(!$r)
				AjaxRollBack('-1');
			$Id = DBInsertTableField("wholeneedcheckhistory" , $arrFields , $arrValues);
			if($Id<=0)
				AjaxRollBack('-7');	
			DBCommitTrans();
			echo 1;	
			break;
	}
?>