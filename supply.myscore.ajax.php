<?php
	include "paras.php";
	$mode = Get("mode");
	switch($mode){
		case "getscore":
			$checkuser = DBGetDataRowByField("supplierinfo" , array("username"),array($_SESSION["suppliername"]));
			$score=$checkuser["score"];
			echo $score;
			break;
		
	}
?>