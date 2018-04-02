<?php
	include "paras.php";
	$newstype = Get("newstype");
	$strSql = "select n1.title,n1.id as cid,n1.content,n.name,n.id FROM `newslist` n1  ";
	$strSql .= "left join newstype n on n1.newstypeid=n.id ";
	$strSql .= " where n.id=$newstype and n1.isallowed=1 ";
	$result = DBGetDataRowsSimple($strSql);
	if($result == null){
		echo -1;
		break;
	}
	$list = array();
	for($i=0;$i<count($result);$i++){
		if(!isset($list[$result[$i]["id"]])){
			$list[$result[$i]["id"]] = array();
			$list[$result[$i]["id"]]["id"] = $result[$i]["id"];
			$list[$result[$i]["id"]]["name"] = $result[$i]["name"];
			$list[$result[$i]["id"]]["childnews"] = array();
		}
		if($result[$i]["cid"] == null)
			continue;
		$row = array();
		$row["id"] = $result[$i]["cid"];
		$row["title"] = $result[$i]["title"];
		$row["content"] = $result[$i]["content"];
		array_push($list[$result[$i]["id"]]["childnews"],$row);
	}
	$newsinfoarr = array();//输出这个
	
	foreach($list as $o){
		$newsinfoarr[] = $o;
	}
	/* echo json_encode($newsinfoarr);
	die();  */
	
	$smarty->assign("newsinfoarr",$newsinfoarr);
	$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);//启动缓存
	$smarty->display('newlist.tpl',$newstype);
	
	include "smartyfooter.php"; 
?>