<?php
	include "paras.php";
	$mode = Get("mode");
	
	switch($mode){
		case "updateinfo"://修改信息
			$data = json_decode(Get("data") , true);
			$checkuser = DBGetDataRowByField("supplierinfo" , array("username"),array($_SESSION["suppliername"]));
			if($checkuser==null){
				die("-9");
			}
			$arrFields = array("name","mobile","imgurl","company","sex","age","qqnum","wxnum","email","goodproduct","personalfeature");
			$arrValues = array($data["name"],$data["mobile"],$data["image"],$data["company"],$data["sex"],$data["age"],$data["qqnum"],$data["wxnum"],$data["email"],$data["goodproduct"],$data["personalfeature"]);
			DBBeginTrans();
			$Id = DBUpdateField("supplierinfo" ,$checkuser["id"], $arrFields , $arrValues);
			if(!$Id)
				AjaxRollBack('-1');
			for($i=0;$i<count($data["subarea"]);$i++){//子站
				$data1 = DBGetDataRowByField("suppliersubarea" , array("supplierid","subareaid"),array($checkuser['id'],$data["subarea"][$i]["id"]));
				if($data1==null&&$data["subarea"][$i]["status"]==1){
					$arrFields1 = array("supplierid","subareaid");
					$arrValues1 = array($checkuser["id"],$data["subarea"][$i]["id"]);
					$Id = DBInsertTableField("suppliersubarea" , $arrFields1 , $arrValues1);
					if($Id<=0)
						AjaxRollBack('-7');
				}
				if($data1!=null&&$data["subarea"][$i]["status"]==0){//本次设置取消
					if($data1["status"]==0){//标记取消此次记录
						$r = DBUpdateField("suppliersubarea" , $data1["id"] ,array("status"), array(-1));
						if(!$r)
							AjaxRollBack('-8');
					}
				}
				if($data1!=null&&$data["subarea"][$i]["status"]==1){//重新选择
					if($data1["status"]==-1){
						$r = DBUpdateField("suppliersubarea" , $data1["id"] ,array("status"), array(0));
						if(!$r)
							AjaxRollBack('-8');
					}
				}
			}
			DBCommitTrans();
			$smarty->clearCache('supplierdetail.tpl',$checkuser["id"]);
			$smarty->clearCache('smartypage-sun.tpl');
			echo 1;
			break;
		case "showinfo":
			$userinfo = DBGetDataRowByField("supplierinfo" , array("username"),array($_SESSION["suppliername"]));
			if($userinfo==null){
				die("-9");
			}
			$supplierid=$userinfo["id"];
			$strSql = " SELECT s1.id,s1.name FROM `suppliersubarea` s ";
			$strSql .= " left join subarea s1 on s.subareaid=s1.id ";
			$strSql .= " Where  s.supplierid=$supplierid and s.status = 0 ";
			$subarea = DBGetDataRowsSimple($strSql);
			$userinfo["subarea"]=$subarea;
			echo json_encode($userinfo);
			break;
		case "subarealist":
			$strSql = "Select * from subarea  ";
			$subarea = DBGetDataRowsSimple($strSql);
			echo json_encode($subarea);
			break;
		case "Refreshinfo":
			$checkuser = DBGetDataRowByField("supplierinfo" , array("username"),array($_SESSION["suppliername"]));
			$id=$checkuser["id"];
			$r = DBUpdateField("supplierinfo" , $id ,array("createtime"), array($DB_FUNCTIONS["now"]));
			if($r)
				echo 1;
			else
				echo -1;
			break;
	}
?>