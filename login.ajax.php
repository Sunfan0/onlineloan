<?php
	include "paras.php";
	include "sms.php";
	$mode = Get("mode");
	
	switch($mode){
		case "IndexLogin"://登录
			$loginName = Get("loginName");
			$loginPassword = Get("loginPassword");
			//$userInfo = DBGetDataRowByField("bgmanager",array("loginname"),array($data["username"]));	
			$checksupplyname = DBGetDataRowByField("supplierinfo" , array("username"),array($loginName));
			$checkdemandname = DBGetDataRowByField("demanderinfo" , array("username"),array($loginName));
			if($checksupplyname==null&&$checkdemandname==null){
				die("-9");//账号不存在，未注册
			}
			$_SESSION["showname"]=$loginName;
			$dataresult=array();
			if($checksupplyname==null){
				if($checkdemandname!=null){
					$_SESSION["demandername"]=$loginName;
					if($checkdemandname["isblacklist"]==1){
						die("-99");//不能登录并提示被拉入黑名单， 请联系管理员。
					}
					if($checkdemandname["isallowed"]==-1||$checkdemandname["isallowed"]==0){
						die("-999");//不能登录并提示审核未通过， 请联系管理员。
					}
					if($loginPassword != $checkdemandname["password"]){
						die("-1");//密码错误
					}
					$dataresult['type']=1;
					$dataresult['subareaid']=$checkdemandname["subareaid"];
					echo json_encode($dataresult);//需方登录
				}
			}else{
				$_SESSION["suppliername"]=$loginName;
				if($checksupplyname["isblacklist"]==1){
						die("-99");//不能登录并提示被拉入黑名单， 请联系管理员。
					}
				if($checksupplyname["isallowed"]==-1||$checksupplyname["isallowed"]==0){
					die("-999");//不能登录并提示审核未通过， 请联系管理员。
				}
				if($loginPassword != $checksupplyname["password"]){
					die("-1");//密码错误
				}
				$dataresult['type']=2;
				$supplierid=$checksupplyname["id"];
				$strSql = " SELECT s.subareaid	FROM `suppliersubarea` s ";
				$strSql .= " Where  s.supplierid=$supplierid and s.status = 0 ";
				$subarea = DBGetDataRow($strSql);
				$userinfo["subarea"]=$subarea;
				$dataresult['subareaid']=$subarea["subareaid"];
				echo json_encode($dataresult);//供方登录
			}
			break;
		case "SendConfirmCode"://发送验证码
			$mobile = Get("mobile");//手机号码
			$type = Get("type");
//发送验证码的时候判断是否已经注册过			
			//1注册
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
			$r = SendSMS($mobile, $confirmCode,$type);
			$arrFields = array("mobile", "confirmcode", "sendtime", "isused","sendresultall");
			$arrValues = array($mobile, $confirmCode, $DB_FUNCTIONS["now"], 0,$r);
			$id = DBInsertTableField("confirmcodehistory", $arrFields, $arrValues);
			if($id <= 0)
				echo -7;
			else
				echo 1;
			break;
		case "Resetpwd":
			$mobile = Get("mobile");
			//$username = Get("username");
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
			$checksupplyname = DBGetDataRowByField("supplierinfo" , array("mobile"),array($mobile));
			$checkdemandname = DBGetDataRowByField("demanderinfo" , array("mobile"),array($mobile));
			if($checksupplyname==null){
				if($checkdemandname!=null){
					/* $checkinfo = DBGetDataRowByField("demanderinfo" , array("mobile"),array($mobile));
					if($checkinfo==null){
						die("-9");//请核对账号和所留手机号
					} */
					$r = DBUpdateField("demanderinfo" , $checkdemandname["id"] ,array("password"), array($newpassword));
					if($r)
						echo 1;
					else 
						echo -1;
				}
			}else{
				/* $checkinfo = DBGetDataRowByField("supplierinfo" , array("username","mobile"),array($username,$mobile));
				if($checkinfo==null){
					die("-9");//请核对账号和所留手机号
				} */
				$r = DBUpdateField("supplierinfo" , $checksupplyname["id"] ,array("password"), array($newpassword));	
				if($r)
					echo 1;
				else 
					echo -1;
			}
			
			break;
	}
?>