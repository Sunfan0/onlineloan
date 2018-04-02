<?php 
	$strSql = "select * FROM `footerfixed` order by createtime desc ";//页脚固定显示
	$footerfixed = DBGetDataRow($strSql);
	
	$showname=$_SESSION["showname"];
	$viewright=0;
	$ismodify=0;
	if($showname!=""){//登录
		
		$supplierinfo = DBGetDataRowByField("supplierinfo" , array("username"),array($showname));
		
		if($supplierinfo==null){//需方
			$demanderinfo = DBGetDataRowByField("demanderinfo" , array("username"),array($showname));
			if($demanderinfo!=null){
				$viewright=1;
				$ismodify=1;//需方
			}
		}else{//供方
			$viewright=2;
			$ismodify=2;//供方
		}
	}
	$_SESSION["pageurl"]=$_SERVER['REQUEST_URI'];
	
	$strurl=$_SESSION["subareaurl"];
	//(/index.php?subareaid=6)
	$subareaid=strstr($strurl,"=");
	$subareaid=substr($subareaid,1);
	if($subareaid==""){
		$subareaname='全国';
	}else{
		$subarealist = DBGetDataRowByField("subarea" , array("id"),array($subareaid));
		$subareaname=$subarealist["name"]; 
	}
	
	$smarty->assign("subareaname",$subareaname);
	$smarty->assign("viewright",$viewright);
	$smarty->assign("ismodify",$ismodify);
	$smarty->assign("showname",$showname);
	$smarty->assign("footerfixed",$footerfixed);
	
	$smarty->clearCache('smartyheader.new.tpl');
	//$smarty->setCaching(Smarty::CACHING_LIFETIME_CURRENT);//启动缓存
	$smarty->display('smartyheader.new.tpl');
?>