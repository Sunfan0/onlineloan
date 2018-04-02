<?php
	include "paras.php";
	$mode = Get("mode");
	// if(!CheckRights("bgset")){
	if(!CheckRights3("bgset")){
		echo 123;
		die();
	}
	switch($mode){
		case "ShowStandardScore"://通用的积分规则
			$strSql = "Select * from scorerule ";
			$datainfo = DBGetDataRow($strSql);
			echo json_encode($datainfo);
			break;
		case "UpdateStandardScore"://编辑通用的积分规则
			$id = (int)(Get("id"));
			$publishgoodsscore = Get("publishgoodsscore");
			$goodsmaxscore = Get("goodsmaxscore");
			$publishinfoscore = Get("publishinfoscore");
			$infomaxscore = Get("infomaxscore");
			$lookcontactneed = Get("lookcontactneed");
			$infostick = Get("infostick");
			$inforecommended = Get("inforecommended");
			$registscore = Get("registscore");
			
			$arrFields=array("publishgoodsscore","goodsmaxscore","publishinfoscore","infomaxscore","lookcontactneed","infostick","inforecommended","registscore");
			$arrValues=array($publishgoodsscore,$goodsmaxscore,$publishinfoscore,$infomaxscore,$lookcontactneed,$infostick,$inforecommended,$registscore);
			$r = DBUpdateField("scorerule" , $id ,$arrFields, $arrValues);
			if($r)
				echo 1;
			else
				echo -1;
			break;	
		
	}
?>