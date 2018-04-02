<?php
	include "paras.php";
	$mode = Get("mode");
	if(!CheckRights3("bgset")){
		echo 123;
		die();
	}
	switch($mode){
		case "ShowFooterFixed":
			$strSql = "Select * from footerfixed order by createtime asc ";
			$datainfo = DBGetDataRow($strSql);
			echo json_encode($datainfo);
			break;
		case "UpdateFooterFixed":
			$id = (int)(Get("id"));
			$mobile = Get("mobile");
			$copyright = Get("copyright");
			/* $email = Get("email");
			$wxnum = Get("wxnum");
			$qqnum = Get("qqnum");
			$codeimg = Get("codeimg"); */
			
			/* $arrFields=array("telephone","copyright","email","wxnum","qqnum","codeimg");
			$arrValues=array($mobile,$copyright,$email,$wxnum,$qqnum,$codeimg); */
			$arrFields=array("telephone","copyright");
			$arrValues=array($mobile,$copyright);
			$r = DBUpdateField("footerfixed" , $id ,$arrFields, $arrValues);
			if($r)
				echo 1;
			else
				echo -1;
			break;	
		
	}
?>