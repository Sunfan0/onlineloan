<?php
	include "paras.php";
	$mode = Get("mode");
	if(!CheckRights3("bgset")){
		echo 123;
		die();
	}
	switch($mode){
		case "Showpegeimg":
			$strSql = "Select * from showpageimg order by createtime asc ";
			$datainfo = DBGetDataRow($strSql);
			echo json_encode($datainfo);
			break;
		case "Updatepageimg":
			$id = (int)(Get("id"));
			$imgurl = Get("imgurl");
		
			$r = DBUpdateField("showpageimg" , $id ,array('imgurl'), array($imgurl));
			if($r)
				echo 1;
			else
				echo -1;
			break;	
		
	}
?>