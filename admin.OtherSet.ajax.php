<?php
	include "paras.php";
	$mode = Get("mode");
	if(!CheckRights3("bgset")){
		echo 123;
		die();
	}
	switch($mode){
		case "ShowStandard"://设置数值显示
			$strSql = " Select * From scorerule order by createtime limit 0,1 ";
			$showdata = DBGetDataRow($strSql);
			echo json_encode($showdata);
			break;
		case "UpdateStandard"://编辑
			$id = (int)(Get("id"));
			$refreshinfomaxnum = Get("refreshinfomaxnum");
			$refreshinfotakescore = Get("refreshinfotakescore");
			$refreshproductmaxnum = Get("refreshproductmaxnum");
			$refreshproducttakescore = Get("refreshproducttakescore");
			$newsallowreply = Get("newsallowreply");
			$arrFields=array("newsallowreply","refreshinfomaxnum","refreshinfotakescore","refreshproductmaxnum","refreshproducttakescore");
			$arrValues=array($newsallowreply,$refreshinfomaxnum,$refreshinfotakescore,$refreshproductmaxnum,$refreshproducttakescore,);
			$r = DBUpdateField("scorerule" , $id ,$arrFields, $arrValues);
			if($r)
				echo 1;
			else
				echo -1;
			break;	
		
	}
?>