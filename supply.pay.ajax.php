<?php
	include "paras.php";
	$mode = Get("mode");
	switch($mode){
		case "ScoreList":
			$strSql = " select * from rechargerule s ";
			//cashnum充值金额，score积分，giftscore获赠积分
			$strSql .= " order by s.cashnum asc ";
			$result = DBGetDataRowsSimple($strSql);
			echo json_encode($result);
			break;
			//小于100，就只有等额的积分，无赠送积分
			//100-500,等额积分，赠送10%积分
			//大于500,等额积分，赠送20%积分
	}
?>