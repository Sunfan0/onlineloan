<?php
	if(!defined("APPID"))
		define("APPID","wx7fa6fd4b94f47973");
	if(!defined("APPSECRET"))
		define("APPSECRET","bd7ec0f1b39c565d46f4082c27fb6400");
	if(!defined("APPNAME"))
		define("APPNAME","wsestarservice");

	/* if(!defined("APPID"))
		define("APPID","wxd15f2060944c23ba");
	if(!defined("APPSECRET"))
		define("APPSECRET","743defb56a6a64852961ce1452a1139d");
	if(!defined("APPNAME"))
		define("APPNAME","mzone029service"); */
		
	if(!defined("SMARTY_DIR"))
		define('SMARTY_DIR', 'D:\smarty-3.1.30\libs/');
	
	
require_once(SMARTY_DIR . 'Smarty.class.php');
$smarty = new Smarty();

$smarty->setTemplateDir('E:\xampp\htdocs\test\test.works\onlineloan\smarty\templates/');
$smarty->setCompileDir('E:\xampp\htdocs\test\test.works\onlineloan\smarty\templates_c/');
$smarty->setConfigDir('E:\xampp\htdocs\test\test.works\onlineloan\smarty\configs/');
$smarty->setCacheDir('E:\xampp\htdocs\test\test.works\onlineloan\smarty\cache/');
	
	if(!defined("DB"))
		define("DB"," ");
	if(!defined("URL_BASE"))
		define("URL_BASE","http://www.wsestar.com/test/onlineloan/");
	if(!defined("PATH_FUNCTION"))
		define("PATH_FUNCTION","functions.V4.php");
		//define("PATH_FUNCTION","../../common/functions.V4.php");
	if(!defined("PATH_DBACCESS"))
		define("PATH_DBACCESS","dbaccess.v5.php");
		//define("PATH_DBACCESS","../../common/dbaccess.v5.php");
	if(!defined("DEBUG"))
		define("DEBUG",false);
	
	date_default_timezone_set('Asia/Shanghai');

	include PATH_FUNCTION;
	include PATH_DBACCESS;

	
	$dbms='mysql';     //数据库类型
	$host='localhost'; //数据库主机名
	$dbName='onlineloan';    //使用的数据库
	$dbUser='root';      //数据库连接用户名
	// $dbPass='lim1hou';          //对应的密码
	$dbPass='';  

//供方，需方，站方登录时账号，密码的核验，以及站方账号对应的权限（传参数判断）
	function CheckRights1(){//供方判断用户名和密码
		if(!isset($_SESSION["uname1"]))
			return -10;
		
		if($_SESSION["uname1"] == "admin")
			return true;

		$provideInfo = DBGetDataRowByField("provideuserinfo","username",$_SESSION["uname1"]);
		if($provideInfo == null)
			return -9;
		else{
			if($provideInfo["password"]!=$_SESSION["pwd1"])
				return -8;
			else
			   return $provideInfo["id"];
		}
	}
	function CheckRights2(){//供方判断用户名和密码
		if(!isset($_SESSION["uname2"]))
			return -10;
		
		if($_SESSION["uname2"] == "admin")
			return true;

		$requireInfo = DBGetDataRowByField("requireuserinfo","username",$_SESSION["uname2"]);
		if($requireInfo == null)
			return -9;
		else{
			if($requireInfo["password"]!=$_SESSION["pwd2"])
				return -8;
			else
			   return $requireInfo["id"];
		}
	}
	function CheckRights3($formName = null){//站方
		if(!isset($_SESSION["uname"]))
			return -10;
		
		if($_SESSION["uname"] == "admin")
			return true;

		$managerInfo = DBGetDataRowByField("bgmanager","loginname",$_SESSION["uname"]);
		if($managerInfo == null)
			return -9;
	
		if($managerInfo["rights"] == "")
			return -7;
		
		if($formName == null)
			return $managerInfo["id"];
			
		$rights = json_decode($managerInfo["rights"],true);
		if(isset($rights[$formName]))
			return $rights[$formName];
		else
			return -7;
	}
//主键设置有几个表未设置，正式开始动手之前重新替换一下
//供方和需方注册，发布信息时进行敏感关键字检验，
	function CheckKeyWord($KeyWord){
	//like查找，查询可能有问题
		$strSql = " Select * from keywordwarn ";
		$strSql .= " where (keyword like '%" . $KeyWord . "%') ";
		$keyInfo = DBGetDataRows($strSql);
		if($keyInfo == null)
			return 1;
		else
			return $keyInfo["keyword"];//提示修改关键字再进行操作
	}
	
	
//数据表的字段名称，数据表的名字重新取名（一个名称在一个数据库中通常只代表一种含义）	
//有些细节的内容遗漏掉了	
	
	
	
?>