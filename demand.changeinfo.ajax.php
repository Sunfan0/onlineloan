<?php
	include "paras.php";
	$mode = Get("mode");
	
	switch($mode){
		case "updateinfo"://修改信息
			$data = json_decode(Get("data") , true);
			$checkuser = DBGetDataRowByField("demanderinfo" , array("username"),array($_SESSION["demandername"]));
			if($checkuser==null){
				die("-9");
			}
			$arrFields = array("subareaid","name","mobile","sex","age","qqnum","email");
			$arrValues = array($data["subareaid"],$data["name"],$data["mobile"],$data["sex"],$data["age"],$data["qqnum"],$data["email"]);
			$Id = DBUpdateField("demanderinfo" ,$checkuser["id"], $arrFields , $arrValues);
			if($Id>0)
				echo 1;
			else
				echo -1;
			break;
		case "showinfo":
			$checkinfo = DBGetDataRowByField("demanderinfo" , array("username"),array($_SESSION["demandername"]));
			if($checkinfo==null){
				die("-9");
			}
			echo json_encode($checkinfo);
			break;
		case "subarealist":
			$strSql = "Select * from subarea ";
			$subarea = DBGetDataRowsSimple($strSql);
			echo json_encode($subarea);
			break;
	}
?>