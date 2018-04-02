<?php
	include "paras.php";
	include "sms.php";
	$mode = Get("mode");
	
	switch($mode){
		case "Login"://登录
			$loginName = Get("loginName");
			$loginPassword = Get("loginPassword");
			$demanderInfo = DBGetDataRowByField("demanderinfo","username",$loginName);
			if($demanderInfo==null){
				die("-9");//账号不存在，未注册
			}
			$_SESSION["demandername"]=$loginName;
			$_SESSION["showname"]=$_SESSION["demandername"];
			if($loginPassword != $demanderInfo["password"]){
				die("-1");//密码错误
			}
			echo 1;
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
			if($timer>60*30){//超过60
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
			$result=$checkresult["demander"];
			
			if($result==1){//不需要审核
				/* $arrFields = array("type","mobile","username","password","sex","age","qqnum","email","registtime","isallowed","reason","operattime","operator");
				$arrValues = array($data["type"],$data["mobile"],$data["username"],$data["password"],$data["sex"],$data["age"],$data["qqnum"],$data["email"],$DB_FUNCTIONS["now"],1,"系统默认审核通过",$DB_FUNCTIONS["now"],"系统默认审核通过"); */
				$arrFields = array("type","mobile","username","password","registtime","isallowed","reason","operattime","operator");
				$arrValues = array($data["type"],$data["mobile"],$data["mobile"],$data["password"],$DB_FUNCTIONS["now"],1,"系统默认审核通过",$DB_FUNCTIONS["now"],"系统默认审核通过");
			}else{
				/* $arrFields = array("type","mobile","username","password","sex","age","qqnum","email","registtime");
				$arrValues = array($data["type"],$data["mobile"],$data["username"],$data["password"],$data["sex"],$data["age"],$data["qqnum"],$data["email"],$DB_FUNCTIONS["now"]); */
				$arrFields = array("type","mobile","username","password","registtime");
				$arrValues = array($data["type"],$data["mobile"],$data["mobile"],$data["password"],$DB_FUNCTIONS["now"]);
			}
			DBBeginTrans();
			$Id = DBInsertTableField("demanderinfo" , $arrFields , $arrValues);
			if($Id<=0)
				AjaxRollBack('-1');
			if($result==1){//插入审核履历
				$arrFieldshistory = array("demanderid","operator","isallowed","reason","operattime");
				$arrValueshistory = array($Id,"系统默认审核通过",1,"系统默认审核通过",$DB_FUNCTIONS["now"]);
				$r = DBInsertTableField("demandercheckhistory" , $arrFieldshistory ,$arrValueshistory);
				if($r<=0)
					DBRollbackTrans("-2");
			}
			DBCommitTrans();
			echo 1;
			break;
		case "subarealist":
			$strSql = "Select * from subarea ";
			$subarea = DBGetDataRowsSimple($strSql);
			echo json_encode($subarea);
			break;
		case "FinishOtherinfo":
			$data = json_decode(Get("data") , true);
			if($data["age"]==""){
				$data["age"]=0;
			}
			//需要增加地区（subareaid）
			/* $checkinfo = DBGetDataRowByField("demanderinfo" , array("id"),array($data["id"]));
			$_SESSION["demandername"]=$checkinfo["username"];
			$_SESSION["showname"]=$_SESSION["demandername"]; */
			$arrFields = array("subareaid","sex","age","qqnum","email");
			$arrValues = array($data["subareaid"],$data["sex"],$data["age"],$data["qqnum"],$data["email"]);
			$r=DBUpdateField("demanderinfo" , $data["id"] , $arrFields , $arrValues);
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
			//
			if($confirmcode != $confirmCodeInfo["confirmcode"])
				die("-99");//验证码有误
			if(!DBUpdateField("confirmcodehistory" , $confirmCodeInfo["id"] , array("isused") , array(1)))
				die("-5");//更新失败
			//
			$checkinfo = DBGetDataRowByField("demanderinfo" , array("username","mobile"),array($username,$mobile));
			if($checkinfo==null){
				die("-9");//请核对账号和所留手机号
			}
			$r = DBUpdateField("demanderinfo" , $checkinfo["id"] ,array("password"), array($newpassword));
			if($r)
				echo 1;
			else 
				echo -1;
			break;
	}
?>