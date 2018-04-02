<?php
	include "paras.php";
	include "sms.php";
	$mode = Get("mode");
	
	switch($mode){
		case "Login"://登录
			$loginName = Get("loginName");
			$loginPassword = Get("loginPassword");
			$supplierInfo = DBGetDataRowByField("supplierinfo","username",$loginName);
			if($supplierInfo==null){
				die("-9");//账号不存在，未注册
			}
			$_SESSION["suppliername"]=$loginName;
			$_SESSION["showname"]=$_SESSION["suppliername"];
			
			if($loginPassword != $supplierInfo["password"]){
				die("-1");//密码错误
			}
			echo 1;
			break;
		case "ShowAgreement"://显示协议内容
			$strSql = " Select * From agreementcontent order by createtime limit 0,1 ";
			$showdata = DBGetDataRow($strSql);
			echo json_encode($showdata);
			break;
		case "SendConfirmCode":
			$mobile = Get("mobile");//手机号码
			$type = Get("type");
//发送验证码的时候判断是否已经注册过			
			//1注册2忘记密码
			if($type==1){
				$checksupplymobile = DBGetDataRowByField("supplierinfo" , array("mobile"),array($mobile));
				$checkdemandmobile = DBGetDataRowByField("demanderinfo" , array("mobile"),array($mobile));
				if($checksupplymobile!=null||$checkdemandmobile!=null){
					die("-99");//手机号已被注册
				} 
			}

			if(!preg_match("/^1\d{10}$/",$mobile)){
				die("-2");
			}
			$confirmCodeInfo = DBGetDataRowByField("confirmcodehistory",array("mobile","isused"),array($mobile,0)," order by sendtime desc ");
			if($confirmCodeInfo!=null){
				$sendtime=$confirmCodeInfo["sendtime"];
				$sendtime=strtotime($sendtime);
				$timer=time()-$sendtime;
				if($timer<=60){//在60s之内
					die("-6");//不能频繁操作
				}
			}
			
			
			$strSql = " Update confirmcodehistory set isused = -1 where mobile = $mobile ";//废弃未用的验证码
			if(!DBExecute($strSql)){
				die("-5");
			}
			//调用短信验证码接口发送验证码
			$confirmCode = mt_rand(100000,999999);
			$r = SendSMS($mobile, $confirmCode);
			$arrFields = array("mobile", "confirmcode", "sendtime", "isused","sendresultall");
			$arrValues = array($mobile, $confirmCode, $DB_FUNCTIONS["now"], 0,$r);
			$id = DBInsertTableField("confirmcodehistory", $arrFields, $arrValues);
			if($id <= 0)
				echo -7;
			else
				echo 1;
			break;
		case "Regist"://注册
			$data = json_decode(Get("data") , true);
//判断当前验证码
			$confirmCodeInfo = DBGetDataRowByField("confirmcodehistory",array("mobile","isused"),array($data["mobile"],0)," order by sendtime desc ");
			$sendtime=$confirmCodeInfo["sendtime"];
			$sendtime=strtotime($sendtime);
			$timer=time()-$sendtime;
			if($timer>30*60){//超过60
				die("-7");//验证码过期
			}
			if($data["confirmcode"] != $confirmCodeInfo["confirmcode"])
				die("-99");//验证码有误
			if(!DBUpdateField("confirmcodehistory" , $confirmCodeInfo["id"] , array("isused") , array(1)))
				die("-5");//更新失败
				
			$checksupplymobile = DBGetDataRowByField("supplierinfo" , array("mobile"),array($data["mobile"]));
			$checkdemandmobile = DBGetDataRowByField("demanderinfo" , array("mobile"),array($data["mobile"]));
			if($checksupplymobile!=null||$checkdemandmobile!=null){
				die("-999");//手机号已被注册
			}
//判断用户名是否已经注册
			//$checkmanagename = DBGetDataRowByField("bgmanager" , array("loginname"),array($data["username"]));
			$checksupplyname = DBGetDataRowByField("supplierinfo" , array("username"),array($data["mobile"]));
			$checkdemandname = DBGetDataRowByField("demanderinfo" , array("username"),array($data["mobile"]));
			if($checksupplyname!=null||$checkdemandname!=null){
				die("-9");//用户名已被注册
			}
			
			$strSql = "Select * from wholeneedcheck ";
			$checkdata = DBGetDataRow($strSql);
			$checkresult=json_decode($checkdata["result"],true);
			$result=$checkresult["supplier"];
			
			$strSql = " Select * From scorerule order by createtime limit 0,1 ";
			$scoredata = DBGetDataRow($strSql);
			$registscore=$scoredata["registscore"]; 
			$productmaxnum=$scoredata["productmaxnum"]; 
			$newsmaxnum=$scoredata["newsmaxnum"]; 
			
			if($result==1){//不需要审核
				/* $arrFields = array("name","mobile","imgurl","username","password","company","sex","age","qqnum","wxnum","email","goodproduct","personalfeature","type","registtime","isallowed","reason","operattime","operator","productmaxnum","newsmaxnum");
				$arrValues = array($data["name"],$data["mobile"],$data["image"],$data["username"],$data["password"],$data["company"],$data["sex"],$data["age"],$data["qqnum"],$data["wxnum"],$data["email"],$data["goodproduct"],$data["personalfeature"],$data["type"],$DB_FUNCTIONS["now"],1,"系统默认审核通过",$DB_FUNCTIONS["now"],"系统默认审核通过",10,10); */
				$arrFields = array("score","name","mobile","username","password","registtime","isallowed","reason","operattime","operator","productmaxnum","newsmaxnum");
				$arrValues = array($registscore,$data["name"],$data["mobile"],$data["mobile"],$data["password"],$DB_FUNCTIONS["now"],1,"系统默认审核通过",$DB_FUNCTIONS["now"],"系统默认审核通过",$productmaxnum,$newsmaxnum);
			}else{
				/* $arrFields = array("name","mobile","imgurl","username","password","company","sex","age","qqnum","wxnum","email","goodproduct","personalfeature","type","registtime","productmaxnum","newsmaxnum");
				$arrValues = array($data["name"],$data["mobile"],$data["image"],$data["username"],$data["password"],$data["company"],$data["sex"],$data["age"],$data["qqnum"],$data["wxnum"],$data["email"],$data["goodproduct"],$data["personalfeature"],$data["type"],$DB_FUNCTIONS["now"],10,10); */
				$arrFields = array("score","name","mobile","username","password","registtime","productmaxnum","newsmaxnum");
				$arrValues = array($registscore,$data["name"],$data["mobile"],$data["mobile"],$data["password"],$DB_FUNCTIONS["now"],$productmaxnum,$newsmaxnum);
			}
			DBBeginTrans();
			$Id = DBInsertTableField("supplierinfo" , $arrFields , $arrValues);
			if($Id<=0)
				AjaxRollBack('-1');
			if($result==1){//不需要审核，插入履历数据
				$arrFieldshistory = array("supplierid","operator","isallowed","reason","operattime");
				$arrValueshistory = array($Id,"系统默认审核通过",1,"系统默认审核通过",$DB_FUNCTIONS["now"]);
				$r = DBInsertTableField("suppliercheckhistory" , $arrFieldshistory ,$arrValueshistory);
				if($r<=0)
					DBRollbackTrans("-2");
			}
			$arrFieldsscorehistory = array("supplierid","scoretype","changetype","beforescore","changescore","afterscore","reason","operattime");
			$arrValuesscorehistory = array($Id,1,9,0,$registscore,$registscore,'供方注册',$DB_FUNCTIONS["now"]);
			$r = DBInsertTableField("supplierscorehistory" , $arrFieldsscorehistory ,$arrValuesscorehistory);
			if($r<=0)
				DBRollbackTrans("-3"); 
			//
			for($i=0;$i<count($data["subarea"]);$i++){//子站
				if($data["subarea"][$i]["status"]==1){
					$arrFields1 = array("supplierid","subareaid");
					$arrValues1 = array($Id,$data["subarea"][$i]["id"]);
					$r = DBInsertTableField("suppliersubarea" , $arrFields1 , $arrValues1);
					if($r<=0)
						AjaxRollBack('-9');
				}
			}
			//
			DBCommitTrans();
			echo $Id;
			break;
		case "Finishinfo":
			$data = json_decode(Get("data") , true);
			
			$checkinfo = DBGetDataRowByField("supplierinfo" , array("id"),array($data["id"]));
			$_SESSION["suppliername"]=$checkinfo["username"];
			$_SESSION["showname"]=$_SESSION["suppliername"]; 
			
			$arrFields = array("imgurl","company","type");
			$arrValues = array($data["image"],$data["company"],$data["type"]);
			
			DBBeginTrans();
			$Id = DBUpdateField("supplierinfo" ,$data["id"], $arrFields , $arrValues);
			if(!$Id)
				AjaxRollBack('-1');
			for($i=0;$i<count($data["subarea"]);$i++){//子站
				$data1 = DBGetDataRowByField("suppliersubarea" , array("supplierid","subareaid"),array($data["id"],$data["subarea"][$i]["id"]));
				if($data1==null&&$data["subarea"][$i]["status"]==1){
					$arrFields1 = array("supplierid","subareaid");
					$arrValues1 = array($data["id"],$data["subarea"][$i]["id"]);
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
			echo 1;
			break;
		case "FinishOtherinfo":
			$data = json_decode(Get("data") , true);
			if($data["age"]==""){
				$data["age"]=0;
			}
			$arrFields = array("sex","age","qqnum","wxnum","email","goodproduct","personalfeature");
			$arrValues = array($data["sex"],$data["age"],$data["qqnum"],$data["wxnum"],$data["email"],$data["goodproduct"],$data["personalfeature"]);
			$r=DBUpdateField("supplierinfo" , $data["id"] , $arrFields , $arrValues);
			if(!$r)
				echo -1;
			else
				echo 1;
			break;
		case "subarealist":
			$strSql = "Select * from subarea ";
			$subarea = DBGetDataRowsSimple($strSql);
			echo json_encode($subarea);
			break;
		case "Resetpwd":
			$mobile = Get("mobile");
			$username = Get("username");
			$newpassword = Get("newpassword");
			$confirmcode = Get("confirmcode");
//判断当前验证码
			$confirmCodeInfo = DBGetDataRowByField("confirmcodehistory",array("mobile","isused"),array($mobile,0)," order by sendtime desc ");
			$sendtime=$confirmCodeInfo["sendtime"];
			$sendtime=strtotime($sendtime);
			$timer=time()-$sendtime;
			if($timer>60*30){//超过60
				die("-7");//验证码过期
			}
			if($confirmcode != $confirmCodeInfo["confirmcode"])
				die("99");//验证码有误
			if(!DBUpdateField("confirmcodehistory" , $confirmCodeInfo["id"] , array("isused") , array(1)))
				die("-5");//更新失败
			
			$checkinfo = DBGetDataRowByField("supplierinfo" , array("username","mobile"),array($username,$mobile));
			if($checkinfo==null){
				die("-9");//请核对账号和所留手机号
			}
			$r = DBUpdateField("supplierinfo" , $checkinfo["id"] ,array("password"), array($newpassword));
			if($r)
				echo 1;
			else 
				echo -1;
			break;
	}
?>