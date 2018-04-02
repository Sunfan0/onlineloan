<?php

	//include "paras.php";
	
	//SendSMS("18709287840", "113355");

	function SendSMS($mobile,  $confirmCode){
		$url = "http://139.224.36.226:1082/wgws/OrderServlet";
		$url = "http://139.224.36.226:1082/wgws/OrderServlet";
		$url = "http://139.224.36.226:4082/wgws/OrderServlet";
		
		$userId = "HZTZ001";
		$passWd = "HZTZ001";
		
		$arr = array();
		$arr["apName"] = $userId;
		$arr["apPassword"] = $passWd;
		//$arr = json_encode($arr);
		$arr = "apName=$userId";
		$arr .= "&apPassword=$passWd";
		
		$arr .= "&srcId=";
		$arr .= "&ServiceId=";
		$arr .= "&calledNumber=$mobile";
		// $arr .= "&content=【贷款信息网】您正在注册成为贷款信息网会员，您的验证码是：" . $confirmCode . "。验证码有效期30分钟。如果不是您本人操作，请无视。";
		$arr .= "&content=【贷款信息网】您的验证码是：" . $confirmCode . "。验证码有效期30分钟。如果不是您本人操作，请无视。";
		$arr .= "&sendTime=";
		
		$r = GetContent($url, $arr, 1082);
		
		return $r;
		/* echo "<br><br>";
		echo "var_dump : ";
		var_dump($r);
		
		echo "<br><br>";
		echo "print_r : ";
		print_r($r);
		
		echo "<br><br>";
		echo "echo : ";
		echo($r);
		
		echo $r; */
	}
	//【贷款信息网】您正在注册成为贷款信息网会员，您的验证码是：123456。验证码有效期30分钟。如果不是您本人操作，请无视。
	
	function GetContent($url,$posts = "",$port = 80) {
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); 
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); 
		if(strpos($url,"https") !== false)
			$port = 443;
		curl_setopt($ch, CURLOPT_PORT, $port);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $posts);
		curl_setopt($ch, CURLOPT_REFERER, GetCurrentURLNoPara());
/*
		echo "var_dump ";
		var_dump($posts);
		echo "<br>";
		
		echo "print_r ";
		print_r($posts);
		echo "<br>";*/
//die();
		$r =  curl_exec($ch); 

		return $r;
	}
?>