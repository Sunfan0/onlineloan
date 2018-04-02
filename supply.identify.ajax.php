<?php
	include "paras.php";
	$mode = Get("mode");
	switch($mode){
		case "applystate":
			$checkuser = DBGetDataRowByField("supplierinfo" , array("username"),array($_SESSION["suppliername"]));
			$state=$checkuser["ismodify"];
			echo $state;
			break;
		case "ShowDetail":
			$checkuser = DBGetDataRowByField("supplierinfo" , array("username"),array($_SESSION["suppliername"]));
			$supplierid=$checkuser["id"];
			$check = DBGetDataRowByField("supplieridentityconfirm" , array("supplierid"),array($supplierid));
			$id=$check["id"];
			$strSql = "Select * from supplieridentityconfirm where id=$id ";
			$data = DBGetDataRow($strSql);
			$strSql = "Select * from supplieridentityjobpic where identityinfoid=$id ";
			$jobimgdata = DBGetDataRowsSimple($strSql);
			if($jobimgdata!=null){
				$data["jobfiles"] = array();
				$data["jobpreview"] = array();
				 foreach($jobimgdata as $file){
					$arr = array();
					$arr["type"] = "image";
					$arr["key"] = $file["id"];
					$arr["extra"] = array("id"=>$file["id"]);
					$arr["url"] = "supply.identify.ajax.php?mode=DeletejobImg";
					array_push($data["jobfiles"], $file["imgurl"]);
					
					array_push($data["jobpreview"],$arr);
				} 
			}
			$strSql = "Select * from supplieridentityidpic where identityinfoid=$id ";
			$idimgdata = DBGetDataRowsSimple($strSql);
			if($idimgdata!=null){
				$data["idfiles"] = array();
				$data["idpreview"] = array();
				 foreach($idimgdata as $file){
					$arr = array();
					$arr["type"] = "image";
					$arr["key"] = $file["id"];
					$arr["extra"] = array("id"=>$file["id"]);
					$arr["url"] = "supply.identify.ajax.php?mode=DeleteidImg";
					array_push($data["idfiles"], $file["imgurl"]);
					
					array_push($data["idpreview"],$arr);
				} 
			}
			echo json_encode($data);
			break;
		case "DeletejobImg":
			$id =Get("id");
			if(!DBExecute("UPDATE `supplieridentityconfirm` SET `employeecard`='' WHERE id=".$id))
				echo -1;
			break;
		case "DeleteidImg":
			$id =Get("id");
			if(!DBExecute("UPDATE `supplieridentityconfirm` SET `copyofidcard`='' WHERE id=".$id))
				echo -1;
			break;
		case "applyidentify"://实名认证
			$idimg = Get("idimg");
			$jobimg = Get("jobimg");
			$otherinfo = Get("otherinfo");
			$checkuser = DBGetDataRowByField("supplierinfo" , array("username"),array($_SESSION["suppliername"]));
			$supplierid=$checkuser["id"];
			$arrFields = array("supplierid","isallowed","copyofidcard","employeecard","otherinfo");
			$arrValues = array($supplierid,0,$idimg,$jobimg,$otherinfo);
			DBBeginTrans();
			$r = DBUpdateField("supplierinfo" , $supplierid ,array("ismodify"), array(-9));
			if(!$r)
				AjaxRollBack('-3');
			$check = DBGetDataRowByField("supplieridentityconfirm" , array("supplierid"),array($supplierid));
			if($check==null){
				
				$r= DBInsertTableField("supplieridentityconfirm" , $arrFields , $arrValues);
				if($r<=0)
					AjaxRollBack('-1');
				$arrFieldsjobimg = array("identityinfoid","imgurl");
				$arrValuesjobimg = array($r,$jobimg);
				$Id = DBInsertTableField("supplieridentityjobpic" , $arrFieldsjobimg , $arrValuesjobimg);
				if($Id<=0)
					AjaxRollBack('-9');
				$arrFieldsidimg = array("identityinfoid","imgurl");
				$arrValuesidimg = array($r,$idimg);
				$Id = DBInsertTableField("supplieridentityidpic" , $arrFieldsidimg , $arrValuesidimg);
				if($Id<=0)
					AjaxRollBack('-9');
			}else{
				$r = DBUpdateField("supplieridentityconfirm" , $check["id"] ,$arrFields, $arrValues);
				if(!$r)
					AjaxRollBack('-3');
				if(!DBExecute("DELETE FROM `supplieridentityjobpic` WHERE identityinfoid=".$check["id"]))
					AjaxRollBack('-33');//删除
				$arrFieldsjobimg = array("identityinfoid","imgurl");
				$arrValuesjobimg = array($check["id"],$jobimg);
				$insertId = DBInsertTableField("supplieridentityjobpic" , $arrFieldsjobimg , $arrValuesjobimg);
				if($insertId<=0)
					AjaxRollBack('-09');
				if(!DBExecute("DELETE FROM `supplieridentityidpic` WHERE identityinfoid=".$check["id"]))
					AjaxRollBack('-33');//删除
				$arrFieldsidimg = array("identityinfoid","imgurl");
				$arrValuesidimg = array($check["id"],$idimg);
				$insertId = DBInsertTableField("supplieridentityidpic" , $arrFieldsidimg , $arrValuesidimg);
				if($insertId<=0)
					AjaxRollBack('-09');
	
			}
			DBCommitTrans();
			echo 1;
			break;
	}
?>