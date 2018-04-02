<?php 
	$strSql = "select * FROM `footerfixed` order by createtime desc ";//页脚固定显示
	$footerfixed = DBGetDataRow($strSql);
	
	$strSql = "select f.id,f.name,f1.id as cid,f1.title,f1.content FROM `footervaried` f1  ";//页脚信息内容
	$strSql .= "left join footertype f on f1.footertypeid=f.id ";
	$result = DBGetDataRowsSimple($strSql);
	if($result == null){
		echo -8;
		break;
	}
	$footerlist = array();
	for($i=0;$i<count($result);$i++){
		if(!isset($footerlist[$result[$i]["id"]])){
			$footerlist[$result[$i]["id"]] = array();
			$footerlist[$result[$i]["id"]]["id"] = $result[$i]["id"];
			$footerlist[$result[$i]["id"]]["name"] = $result[$i]["name"];
			$footerlist[$result[$i]["id"]]["childfooter"] = array();
		}
		if($result[$i]["cid"] == null)
			continue;
		$row = array();
		$row["id"] = $result[$i]["cid"];
		$row["title"] = $result[$i]["title"];
		$row["content"] = $result[$i]["content"];
		array_push($footerlist[$result[$i]["id"]]["childfooter"],$row);
	}
	$footervariedlist = array();
	
	foreach($footerlist as $o){
		$footervariedlist[] = $o;
	}
	
	$smarty->assign("footerfixed",$footerfixed);
	$smarty->assign("footervariedlist",$footervariedlist);
	
	$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);//启动缓存
	$smarty->display('smartyfooter.tpl');
?>