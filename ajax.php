<?php
	include "paras.php";
	$mode = Get("mode");
	switch($mode){
		case "Action":
			$username='当前登录名';
			$action = Get("action");
			$page = Get("page");
			$currenturl = GetRefferPage();
			$openid = 'initopenid';
			$memo = Get("memo");
			$visitid = -1;
			if($action == ""){
				echo "para error";
				die();
			}
			ActionHistory3($page , $currenturl , $action , $memo , $visitid , $openid,$username);
			break;
		case "supplyinforeply"://产品回复
			$demanderinfo = DBGetDataRowByField("demanderinfo" , array("username"),array($_SESSION["showname"]));
			$demanderid=$demanderinfo["id"];
			$supplyinfoid= Get("supplyinfoid");
			$replytext= Get("replytext");
			$r=DBInsertTableField("supplyinforeply",array("supplyinfoid","demanderid","content","replytime"),array($supplyinfoid,$demanderid,$replytext,$DB_FUNCTIONS["now"]));
			if($r>0){
				echo 1;
			}else{
				echo -1;
			}
			break;
		case "supplyinforeplylist"://产品回复列表（content内容，username名字，replytime时间）
			$supplyinfoid= Get("supplyinfoid");
			$strSql = " SELECT s.*,s1.username FROM `supplyinforeply` s ";
			$strSql .= " left join demanderinfo s1 on s.demanderid=s1.id ";
			$strSql .= " where s.supplyinfoid=$supplyinfoid and isstop=0 ";
			$strSql .= " order by s.isstick desc,s.replytime desc";
			$dataDetail = DBGetDataRowsSimple($strSql);
			echo json_encode($dataDetail);
			break;
		case "newsinforeplyreplylist"://资讯回复列表（content内容，username名字，replytime时间）
			$newsid= Get("newsid");
			$strSql = " SELECT s.*,IF(s.repliertype=1,s1.username,s2.username) as username FROM `newsreplylist` s ";
			$strSql .= " left join demanderinfo s1 on s.replierid=s1.id ";
			$strSql .= " left join supplierinfo s2 on s.replierid=s2.id ";
			$strSql .= " where s.newsid=$newsid and isstop=0 ";
			$strSql .= " order by s.isstick desc,s.replytime desc";
			$dataDetail = DBGetDataRowsSimple($strSql);
			echo json_encode($dataDetail);
			break;
		case "newsinforeply"://资讯回复
			$demanderinfo = DBGetDataRowByField("demanderinfo" , array("username"),array($_SESSION["showname"]));
			if($demanderinfo==null){
				$supplierinfo = DBGetDataRowByField("supplierinfo" , array("username"),array($_SESSION["showname"]));
				$replierid=$supplierinfo["id"];
				$repliertype=2;
			}else{
				$replierid=$demanderinfo["id"];
				$repliertype=1;
			}
			$newsid= Get("newsid");
			$replytext= Get("replytext");
			$r=DBInsertTableField("newsreplylist",array("newsid","repliertype","replierid","content","replytime"),array($newsid,$repliertype,$replierid,$replytext,$DB_FUNCTIONS["now"]));
			if($r>0){
				echo 1;
			}else{
				echo -1;
			}
			break;
		//关注供方
		case "Attentionsupplier":
			$demanderinfo = DBGetDataRowByField("demanderinfo" , array("username"),array($_SESSION["showname"]));
			$demanderid=$demanderinfo["id"];
			//$demanderid = Get("demanderid");//未登录的时候不存在
			$supplierid = Get("supplierid");
			$r=DBInsertTableField("supplierfocushistory",array("demanderid","supplierid","focustime"),array($demanderid,$supplierid,$DB_FUNCTIONS["now"]));
			if($r>0){
				echo 1;
			}else{
				echo -1;
			}
			break;
		case "IsAttentionsupplier"://返回该需方是否关注该供方
			$demanderinfo = DBGetDataRowByField("demanderinfo" , array("username"),array($_SESSION["showname"]));
			$demanderid=$demanderinfo["id"];
			$supplierid = Get("supplierid");
			$attenioninfo=DBGetDataRowByField("supplierfocushistory" , array("demanderid","supplierid"),array($demanderid,$supplierid));
			if($attenioninfo==null){
				echo -1;
			}else{
				echo 1;
			}
			break;
		case "IsAttentionsupplyinfo":
			$demanderinfo = DBGetDataRowByField("demanderinfo" , array("username"),array($_SESSION["showname"]));
			$demanderid=$demanderinfo["id"];
			$supplyinfoid = Get("supplyinfoid");
			$attenioninfo=DBGetDataRowByField("supplyinfofocushistory" , array("demanderid","supplyinfoid"),array($demanderid,$supplyinfoid));
			if($attenioninfo==null){
				echo -1;//未关注
			}else{
				echo 1;//已关注
			}
			break;
		//关注供方产品
		case "Attentionsupplyinfo":
			$demanderinfo = DBGetDataRowByField("demanderinfo" , array("username"),array($_SESSION["showname"]));
			$demanderid=$demanderinfo["id"];
			//$demanderid = Get("demanderid");//未登录的时候不存在
			$supplyinfoid = Get("supplyinfoid");
			$r=DBInsertTableField("supplyinfofocushistory",array("demanderid","supplyinfoid","focustime"),array($demanderid,$supplyinfoid,$DB_FUNCTIONS["now"]));
			if($r>0){
				echo 1;
			}else{
				echo -1;
			}
			break;
		case "SupplyinfodetailView"://没登录的记录id=0,登录的供方记录id=-1,正常登陆的需方记录id
			if($_SESSION["showname"]==""){
				$viewid=0;
			}else{
				$demanderinfo = DBGetDataRowByField("demanderinfo" , array("username"),array($_SESSION["showname"]));
				if($demanderinfo==null){
					$supplierinfo = DBGetDataRowByField("supplierinfo" , array("username"),array($_SESSION["showname"]));
					if($supplierinfo==null){
						$viewid=0;
					}else{
						$viewid=-1;
					}
				}else{
					$viewid=$demanderinfo["id"];
				}
			}
			/* echo $viewid;
			die(); */
			$supplyinfoid = Get("supplyinfoid");
			//$staytime = Get("staytime");
			//$r=DBInsertTableField("supplyinfovisithistory",array("demanderid","supplyinfoid","staytime","visittime"),array($demanderid,$supplyinfoid,$staytime,$DB_FUNCTIONS["now"]));
			$r=DBInsertTableField("supplyinfovisithistory",array("demanderid","supplyinfoid","visittime"),array($viewid,$supplyinfoid,$DB_FUNCTIONS["now"]));
			if($r>0){
				echo 1;
			}else{
				echo -1;
			}
			break;
		case "SupplierdetailView"://查看供方联系方式
			if($_SESSION["showname"]==""){
				$viewid=0;
			}else{
				$demanderinfo = DBGetDataRowByField("demanderinfo" , array("username"),array($_SESSION["showname"]));
				if($demanderinfo==null){
					$supplierinfo = DBGetDataRowByField("supplierinfo" , array("username"),array($_SESSION["showname"]));
					if($supplierinfo==null){
						$viewid=0;
					}else{
						$viewid=-1;
					}
				}else{
					$viewid=$demanderinfo["id"];
				}
			}
		
			$supplierid = Get("supplierid");
			//$staytime = Get("staytime");
			//$r=DBInsertTableField("suppliervisithistory",array("demanderid","supplierid","staytime","visittime"),array($demanderid,$supplyinfoid,$staytime,$DB_FUNCTIONS["now"]));
			$r=DBInsertTableField("suppliervisithistory",array("demanderid","supplierid","visittime"),array($viewid,$supplierid,$DB_FUNCTIONS["now"]));
			if($r>0){
				echo 1;
			}else{
				echo -1;
			}
			break;
		case "updatenewsclick":
			$newsid = Get("newsid");
			$r=DBExecute(" UPDATE newslist SET clickcount=clickcount+1 WHERE id=$newsid ");
			if(!$r){
				echo -1;
			}else{	
				echo 1;
			}
			break;
		case "IsReportDemander"://是否已经举报
			$demandinfoid = Get("demandinfoid");
			$demandinfo = DBGetDataRowByField("demandinfo","id",$demandinfoid);
			$demanderid=$demandinfo["demanderid"];
			$supplierinfo = DBGetDataRowByField("supplierinfo" , array("username"),array($_SESSION["showname"]));
			$supplierid=$supplierinfo["id"];
			$viewinfo=DBGetDataRowByField("supplierscorehistory" , array("demanderid","supplierid","changetype"),array($demanderid,$supplierid,4));//是否查看过联系方式
			if($viewinfo==null){
				die("-9");//未查看联系方式
			}
			$info=DBGetDataRowByField("demanderreporthistory" , array("demanderid","supplierid","isallowed"),array($demanderid,$supplierid,0));//是否已经举报过此用户
			if($info==null){
				echo -1;
			}else{
				echo 1;
			}
			break;
			
		case "ReportDemander"://举报需方,只有登录的供方可以举报
			$demandinfoid = Get("demandinfoid");
			$demandinfo = DBGetDataRowByField("demandinfo","id",$demandinfoid);
			$demanderid=$demandinfo["demanderid"];
			$supplierinfo = DBGetDataRowByField("supplierinfo" , array("username"),array($_SESSION["showname"]));
			$supplierid=$supplierinfo["id"];
			$r=DBInsertTableField("demanderreporthistory",array("demanderid","supplierid","reporttime"),array($demanderid,$supplierid,$DB_FUNCTIONS["now"]));
			if($r>0){
				echo 1;
			}else{
				echo -1;
			}
			break;
		case "IsCollectSupplier"://是否已经收藏该顾问
			$supplierid = Get("supplierid");
			$demanderinfo = DBGetDataRowByField("demanderinfo" , array("username"),array($_SESSION["showname"]));
			if($demanderinfo==null){
				$supplierinfo = DBGetDataRowByField("supplierinfo" , array("username"),array($_SESSION["showname"]));
				if($supplierinfo!=null){
					$type=2;//供方
					$collectid=$supplierinfo["id"];
				}
			}else{
				$type=1;//需方
				$collectid=$demanderinfo["id"];
			}
			$info=DBGetDataRowByField("suppliercollecthistory" , array("type","collectid","supplierid"),array($type,$collectid,$supplierid));//是否已经收藏
			if($info==null){
				echo -1;
			}else{
				echo 1;
			}
			break;
		case "CollectSupplier"://收藏顾问,登录的供方和需方都可以收藏
			$supplierid = Get("supplierid");
			$demanderinfo = DBGetDataRowByField("demanderinfo" , array("username"),array($_SESSION["showname"]));
			if($demanderinfo==null){
				$supplierinfo = DBGetDataRowByField("supplierinfo" , array("username"),array($_SESSION["showname"]));
				if($supplierinfo!=null){
					$type=2;//供方
					$collectid=$supplierinfo["id"];
				}
			}else{
				$type=1;//需方
				$collectid=$demanderinfo["id"];
			}
			$r=DBInsertTableField("suppliercollecthistory",array("type","collectid","supplierid"),array($type,$collectid,$supplierid));
			if($r>0){
				echo 1;
			}else{
				echo -1;
			}
			break;
		case "DemandinfodetailView"://没登录的，登陆的需方，正常登陆的供方
			if($_SESSION["showname"]==""){
				$viewid=0;
			}else{
				$supplierinfo = DBGetDataRowByField("supplierinfo" , array("username"),array($_SESSION["showname"]));
				if($supplierinfo==null){
					$demanderinfo = DBGetDataRowByField("demanderinfo" , array("username"),array($_SESSION["showname"]));
					if($demanderinfo==null){
						$viewid=0;
					}else{
						$viewid=-1;
					}
				}else{
					$viewid=$supplierinfo["id"];
				}
			}
			$demandinfoid = Get("demandinfoid");
			//$staytime = Get("staytime");
			//DBBeginTrans();
			//$r=DBInsertTableField("demandinfovisithistory",array("demanderid","supplierid","staytime","visittime"),array($demanderid,$supplyinfoid,$staytime,$DB_FUNCTIONS["now"]));
			$r=DBInsertTableField("demandinfovisithistory",array("demandinfoid","supplierid","visittime"),array($demandinfoid,$viewid,$DB_FUNCTIONS["now"]));
			if($r>0){
				echo 1;
			}else{
				echo -1;
			}
			/*if($r<=0)
				DBRollbackTrans('-1');
			 $maxnumdata = DBGetDataRowByField("demandinfo","id",$demandinfoid);
			if($maxnumdata["currentvisiblenum"]<$maxnumdata["maxvisible"]){
				$r=DBExecute(" UPDATE demandinfo SET currentvisiblenum=currentvisiblenum+1 WHERE id=$demandinfoid ");
				if(!$r)
					DBRollbackTrans('-2');
			}else{	
				die("-99");//已经达到最大可见数量
			} 
			//扣除对应的供方查看者积分
			DBCommitTrans();
			echo 1;*/
			break;
		case "DropLogin":
			$_SESSION["showname"]="";
			$_SESSION["demandername"]="";
			$_SESSION["suppliername"]="";
			break;
		case "DropPageurl":
			$_SESSION["pageurl"]="";
			break;
		
		case "CheckMaxvisibleNum":
			$demandinfoid = Get("demandinfoid");
			
			$strSql = " Select viewcount from demandinfoviewnumhistory where viewdate = date_format(now(),'%Y-%m-%d') and demandinfoid=$demandinfoid  ";//判断当天次数
			$viewcount = DBGetDataRow($strSql);
			if($viewcount==null){
				$r=DBInsertTableField("demandinfoviewnumhistory",array("demandinfoid","viewcount","viewdate"),array($demandinfoid,1,date('Y-m-d')));
				if($r<=0){
					die('-1');
				}
			} 
			$viewcount=$viewcount["viewcount"];
			$maxnumdata = DBGetDataRowByField("demandinfo","id",$demandinfoid);
			$demanderid=$maxnumdata["demanderid"];
			
			$supplierinfo = DBGetDataRowByField("supplierinfo" , array("username"),array($_SESSION["showname"]));
			$supplierid=$supplierinfo["id"];
			$beforescore=$supplierinfo["score"];
			
			$info=DBGetDataRowByField("supplierscorehistory" , array("demanderid","supplierid","changetype"),array($demanderid,$supplierid,4));
			
			$strSql = " Select * From scorerule order by createtime limit 0,1 ";
			$scoredata = DBGetDataRow($strSql);
			$lookcontactneed=$scoredata["lookcontactneed"]; 
			
			if($viewcount<$maxnumdata["maxvisible"]){
			/* echo $maxnumdata["currentvisiblenum"];
			echo $maxnumdata["maxvisible"];
			die(); */
			//if($maxnumdata["currentvisiblenum"]<$maxnumdata["maxvisible"]){
				DBBeginTrans();
				if($info==null){//没查看过
					if($beforescore<$lookcontactneed){
						die("-9");//积分不足
					}
					$r=DBExecute(" UPDATE demandinfo SET currentvisiblenum=currentvisiblenum+1 WHERE id=$demandinfoid ");
					if(!$r)
						DBRollbackTrans('-1');
					$arrFieldsscorehistory = array("demanderid","supplierid","scoretype","changetype","beforescore","changescore","afterscore","reason","operattime");
					$arrValuesscorehistory = array($demanderid,$supplierid,-1,4,$beforescore,$lookcontactneed,$beforescore-$lookcontactneed,'查看联系方式',$DB_FUNCTIONS["now"]);
					$r = DBInsertTableField("supplierscorehistory" , $arrFieldsscorehistory ,$arrValuesscorehistory);
					if($r<=0)
						DBRollbackTrans("-2");
					$r=DBExecute(" UPDATE supplierinfo SET score=score-$lookcontactneed  WHERE id=$supplierid ");
					if(!$r)
						DBRollbackTrans('-3');
						
					$getCountInfo = DBGetDataRowByField("demandinfoviewnumhistory",array("demandinfoid","viewdate"),array($demandinfoid,date('Y-m-d')));
					if(!DBUpdateField("demandinfoviewnumhistory",$getCountInfo["id"],array("viewcount"),array($getCountInfo["viewcount"]+1)))
						DBRollbackTrans('-4');
				}
				
				DBCommitTrans();
				echo 1; 
			}else{	
				die("-99");//已经达到最大可见数量
			}
			break;
			
		case "SearchCity":
			$firstletter = Get("firstletter");
			$strSql = "select * FROM `subarea` where firstletter='".$firstletter."' order by createtime desc ";
			$subareainfo = DBGetDataRowsSimple($strSql);
			echo json_encode($subareainfo);
			break;
			
		case "SubmitDemand":
			$demandnum = Get("demandnum");
			$name = Get("name");
			$sex = Get("sex");
			$mobile = Get("mobile");
			/* $demandnum = '20w';
			$name ='ww';
			$sex = 1;
			$mobile = '131455652'; */
			$arrFields = array("type","mobile","username","password","sex","registtime","isallowed","reason","operattime","operator");
			$arrValues = array(1,$mobile,'fastadmin','21232f297a57a5a743894a0e4a801fc3',$sex,$DB_FUNCTIONS["now"],1,"快速贷款审核通过",$DB_FUNCTIONS["now"],"快速贷款审核通过");
			DBBeginTrans();
			$Id = DBInsertTableField("demanderinfo" , $arrFields , $arrValues);
			if($Id<=0)
				DBRollbackTrans('-1');
			$arrFields1= array("demanderid","title","titlecolor","isstick","showright","maxvisible","demandstate","name","demandnum","houseproperty","carproperty","socialsecurityid","marriage","children","needcompanyid","otherloans","demandtime","otherdesc","Applytime","isallowed","reason","operattime","operator");
			$arrValues1 = array($Id,"快速贷款","#000000",1,1,10,1,$name,$demandnum,1,1,1,1,1,1,1,1,'快速贷款通道',$DB_FUNCTIONS["now"],1,"快速贷款审核通过",$DB_FUNCTIONS["now"],"快速贷款审核通过");
			$infoid = DBInsertTableField("demandinfo", $arrFields1 ,$arrValues1);
			if($infoid<=0)
				DBRollbackTrans('-8');
			$arrFieldshistory = array("demandinfoid","operator","isallowed","reason","operattime");
			$arrValueshistory = array($infoid,"快速贷款审核通过",1,"快速贷款审核通过",$DB_FUNCTIONS["now"]);
			$r = DBInsertTableField("demandinfocheckhistory" , $arrFieldshistory ,$arrValueshistory);
			if($r<=0)
				DBRollbackTrans("-2");
			DBCommitTrans();
			$smarty->clearCache('smartypage.new.tpl');
			echo 1;
			break;
		
		case "SearchList"://找贷款，找产品，找顾问列表
			$data = json_decode(Get("data") , true);
			switch($data["typeid"]){
				case 1://找贷款//
					$strSql = "select DISTINCT(d.id),d.name,d.demandnum,d.demandtime,s.producttype,d.isallowed,d.demandstate,d.Applytime,d.otherdesc,d1.mobile FROM `demandinfo` d ";
					$strSql.= " left join supplyproducttype s on d.demandtypeid=s.id ";
					$strSql.= " left join demanderinfo d1 on d.demanderid=d1.id ";
					$strSql.= " left join demandselectprofession s5 on d.id=s5.demandinfoid ";
					//$strSql.= " left join professiontype s6 on s5.professionid=s6.id ";
					$strSql .= " left join demandselectcredit s7 on d.id=s7.demandinfoid ";
					//$strSql .= " left join needcredit s8 on s7.creditid=s8.id ";
					$strSql .= " left join demandinfosubarea s3 on d.id=s3.demandinfoid ";
					//$strSql .= " left join subarea s4 on s3.subareaid=s4.id ";
					$strSql .= " where d.isallowed=1 ";
				//echo count($data["datavalue"]);
					if(count($data["datavalue"])!=0){
						for($i=0;$i<count($data["datavalue"]);$i++){
							switch($data["datavalue"][$i]["nameid"]){
								case 1://贷款金额
									//echo count($data["datavalue"][$i]["field"]);
									if(count($data["datavalue"][$i]["field"])!=0){
										for($j=0;$j<count($data["datavalue"][$i]["field"]);$j++){
											if($j==0){
												$strSql .= " and ( d.demandnum like '%" . $data["datavalue"][$i]["field"][$j]["value"] . "%' ";
											}else{
												$strSql .= " or d.demandnum like '%" . $data["datavalue"][$i]["field"][$j]["value"] . "%' ";
											}
											if($j==count($data["datavalue"][$i]["field"])-1){
												$strSql .= " )";
											}
										}
									}
									break;
								case 2://贷款类型
									if(count($data["datavalue"][$i]["field"])!=0){
										for($j=0;$j<count($data["datavalue"][$i]["field"]);$j++){
											$value=$data['datavalue'][$i]['field'][$j]['value'];
											/* if($value==0){
												//$strSql .= " ";
												break;
											}else{ */
											if($value!=0){
												if($j==0){
													$strSql .= " and ( s.id= $value ";
												}else{
													$strSql .= " or s.id= $value ";
												}
												if($j==count($data["datavalue"][$i]["field"])-1){
													$strSql .= " )";
												}
											}
											//}
										}
									}
									break;
								case 3://职业身份
									if(count($data["datavalue"][$i]["field"])!=0){
										for($j=0;$j<count($data["datavalue"][$i]["field"]);$j++){
											$value=$data['datavalue'][$i]['field'][$j]['value'];
											if($value==0){
												$strSql .= " and s5.status=0 ";
											}else{
												if($j==0){
													$strSql .= " and s5.status=0 and ( s5.professionid=$value  ";
												}else{
													$strSql .= " or s5.professionid=$value ";
												}
												if($j==count($data["datavalue"][$i]["field"])-1){
													$strSql .= "  )";
												}
											}
										}
									}
									break;
								case 4://房产类型
									if(count($data["datavalue"][$i]["field"])!=0){
										for($j=0;$j<count($data["datavalue"][$i]["field"]);$j++){
											$value=$data['datavalue'][$i]['field'][$j]['value'];
											if($value!=0){
											
												if($j==0){
													$strSql .= " and (d.houseproperty = $value ";
												}else{
													$strSql .= " or d.houseproperty = $value ";
												}
												if($j==count($data["datavalue"][$i]["field"])-1){
													$strSql .= "  )";
												}
											}
										}
									}
									break;
								case 5://是否有车
									if(count($data["datavalue"][$i]["field"])!=0){
										for($j=0;$j<count($data["datavalue"][$i]["field"]);$j++){
											$value=$data['datavalue'][$i]['field'][$j]['value'];
											if($value!=0){
												if($j==0){
													$strSql .= " and (d.carproperty = $value ";
												}else{
													$strSql .= " or d.carproperty = $value ";
												}
												if($j==count($data["datavalue"][$i]["field"])-1){
													$strSql .= "  )";
												}
											}
										}
									}
									break;
								case 6://信用情况
									if(count($data["datavalue"][$i]["field"])!=0){
										for($j=0;$j<count($data["datavalue"][$i]["field"]);$j++){
											$value=$data['datavalue'][$i]['field'][$j]['value'];
											if($value==0){
												$strSql .= " and s7.status=0 ";
											}else{
												if($j==0){
													$strSql .= " and s7.status=0 and ( s7.creditid=$value  ";
												}else{
													$strSql .= " or s7.creditid=$value ";
												}
												if($j==count($data["datavalue"][$i]["field"])-1){
													$strSql .= "  )";
												}
											}
										}
									}
									break;
								case 7://所在省份
									if(count($data["datavalue"][$i]["field"])!=0){
										for($j=0;$j<count($data["datavalue"][$i]["field"]);$j++){
											$value=$data['datavalue'][$i]['field'][$j]['value'];
											if($value==0){
												$strSql .= " and s3.status=0 ";
												break;
											}else{
												if($j==0){
													$strSql .= " and s3.status=0 and ( s3.subareaid=$value  ";
												}else{
													$strSql .= " or s3.subareaid=$value ";
												}
												if($j==count($data["datavalue"][$i]["field"])-1){
													$strSql .= "  )";
												}
											} 
										}
									}
									break;
							}
						}
					}
					
					$strSql.= " order by d.Applytime desc ";
					$strSql.= " limit 7 ";
//echo $strSql;
//die();
					$infolist = DBGetDataRowsSimple($strSql);
					for($i=0;$i<count($infolist);$i++){
						$demandinfoid=$infolist[$i]['id'];
						$strSql = "select s2.name FROM `demandinfosubarea` s1";
						$strSql .= " left join subarea s2 on s1.subareaid=s2.id ";
						$strSql .= " where  s1.status=0 and s1.demandinfoid=$demandinfoid ";
						$subarea1 = DBGetDataRowsSimple($strSql);
						$infolist[$i]["subarea"] = $subarea1;
					}
					break;
				case 2://找产品
					$strSql = "select DISTINCT(s1.id),s1.supplierid,s1.productname,s1.paynum,s1.rate,s1.createtime,  ";
					$strSql .= " s2.property,s3.paytype,s4.worktime,d.mobile ";//电话中间4位*号，点击后查看全部
					$strSql .= "FROM `supplyinfo` s1 ";
					$strSql .= "left join supplyneedproperty s2 on s1.needpropertyid=s2.id ";
					$strSql .= "left join supplypaytype s3 on s1.paytypeid=s3.id ";
					$strSql .= "left join supplyneedworktime s4 on s1.needworktimeid=s4.id ";
					$strSql .= "left join supplierinfo d on s1.supplierid=d.id ";
					$strSql .= " left join supplyselectprofession s5 on s1.id=s5.supplyinfoid ";
					//$strSql .= " left join professiontype s6 on s5.professionid=s6.id ";
					$strSql .= " left join supplyselectcredit s7 on s1.id=s7.supplyinfoid ";
					//$strSql .= " left join needcredit s8 on s7.creditid=s8.id ";
					$strSql .= " left join suppliersubarea s9 on d.id=s9.supplierid ";
					//$strSql .= " left join subarea s10 on s9.subareaid=s10.id ";
					$strSql .= " where s1.isallowed=1 ";
					if(count($data["datavalue"])!=0){
						for($i=0;$i<count($data["datavalue"]);$i++){
							switch($data["datavalue"][$i]["nameid"]){
								case 1://贷款金额
									if(count($data["datavalue"][$i]["field"])!=0){
										for($j=0;$j<count($data["datavalue"][$i]["field"]);$j++){
											if($j==0){
												$strSql .= " and ( s1.paynum like '%" . $data["datavalue"][$i]["field"][$j]["value"] . "%' ";
											}else{
												$strSql .= " or s1.paynum like '%" . $data["datavalue"][$i]["field"][$j]["value"] . "%' ";
											}
											if($j==count($data["datavalue"][$i]["field"])-1){
												$strSql .= " )";
											}
										}
									}
									break;
								case 2://贷款期限
									if(count($data["datavalue"][$i]["field"])!=0){
										for($j=0;$j<count($data["datavalue"][$i]["field"]);$j++){
											if($j==0){
												$strSql .= " and (  s1.paytime like '%" . $data["datavalue"][$i]["field"][$j]["value"] . "%' ";
											}else{
												$strSql .= " or  s1.paytime like '%" . $data["datavalue"][$i]["field"][$j]["value"] . "%' ";
											}
											if($j==count($data["datavalue"][$i]["field"])-1){
												$strSql .= " )";
											}
										}
									}
									break;
								case 3://产品类型
									if(count($data["datavalue"][$i]["field"])!=0){
										for($j=0;$j<count($data["datavalue"][$i]["field"]);$j++){
											$value=$data['datavalue'][$i]['field'][$j]['value'];
											if($value!=0){
											
												if($j==0){
													$strSql .= " and (s3.id = $value ";
												}else{
													$strSql .= " or s3.id = $value ";
												}
												if($j==count($data["datavalue"][$i]["field"])-1){
													$strSql .= "  )";
												}
											}
										}
									}
									break;
								case 4://职业身份
									if(count($data["datavalue"][$i]["field"])!=0){
										for($j=0;$j<count($data["datavalue"][$i]["field"]);$j++){
											$value=$data['datavalue'][$i]['field'][$j]['value'];
											if($value==0){
												$strSql .= " and s5.status=0 ";
											}else{
												if($j==0){
													$strSql .= " and s5.status=0 and (s5.professionid=$value ";
												}else{
													$strSql .= " or s5.professionid=$value ";
												}
												if($j==count($data["datavalue"][$i]["field"])-1){
													$strSql .= "  )";
												}
											}
										}
									}
									break;
								case 5://资产要求
									if(count($data["datavalue"][$i]["field"])!=0){
										for($j=0;$j<count($data["datavalue"][$i]["field"]);$j++){
											$value=$data['datavalue'][$i]['field'][$j]['value'];
											if($value!=0){
												
												if($j==0){
													$strSql .= " and (s1.needpropertyid = $value ";
												}else{
													$strSql .= " or s1.needpropertyid = $value ";
												}
												if($j==count($data["datavalue"][$i]["field"])-1){
													$strSql .= "  )";
												}
											}
										}
									}
									break;
								case 6://信用情况
									if(count($data["datavalue"][$i]["field"])!=0){
										for($j=0;$j<count($data["datavalue"][$i]["field"]);$j++){
											$value=$data['datavalue'][$i]['field'][$j]['value'];
											if($value==0){
												$strSql .= " and s7.status=0 ";
											}else{
												if($j==0){
													$strSql .= " and s7.status=0 and (s7.creditid=$value  ";
												}else{
													$strSql .= " or s7.creditid=$value ";
												}
												if($j==count($data["datavalue"][$i]["field"])-1){
													$strSql .= "  )";
												}
											}
										}
									}
									break;
								case 7://所在省份
									if(count($data["datavalue"][$i]["field"])!=0){
										for($j=0;$j<count($data["datavalue"][$i]["field"]);$j++){
											$value=$data['datavalue'][$i]['field'][$j]['value'];
											if($value==0){
												$strSql .= " and s9.status=0 ";
												break;
											}else{
												if($j==0){
													$strSql .= " and s9.status=0 and ( s9.subareaid=$value  ";
												}else{
													$strSql .= " or s9.subareaid=$value ";
												}
												if($j==count($data["datavalue"][$i]["field"])-1){
													$strSql .= "  )";
												}
											}
										}
									}
									break;
							}
					}	}
					$strSql .= " order by s1.lastmodifytime desc ";
					$strSql .= " limit 0,7 ";
					$infolist = DBGetDataRowsSimple($strSql);
					for($i=0;$i<count($infolist);$i++){
						$supplierid=$infolist[$i]['supplierid'];
						$strSql = "select s2.name FROM `suppliersubarea` s1";
						$strSql .= " left join subarea s2 on s1.subareaid=s2.id ";
						$strSql .= " where s1.supplierid=$supplierid and s1.status=0 ";
						$subarea2 = DBGetDataRowsSimple($strSql);
						$infolist[$i]["subarea"] = $subarea2;
					} 
					break;
				case 3://找顾问
					$strSql = "select DISTINCT(s1.id),s1.* from supplierinfo s1 ";
					$strSql .= " left join suppliersubarea s3 on s1.id=s3.supplierid ";
					//$strSql .= " left join subarea s4 on s3.subareaid=s4.id ";
					$strSql .= " where s1.isallowed=1 ";
					if(count($data["datavalue"])!=0){
						for($i=0;$i<count($data["datavalue"]);$i++){
							switch($data["datavalue"][$i]["nameid"]){
								case 1://供方类型
									if(count($data["datavalue"][$i]["field"])!=0){
										for($j=0;$j<count($data["datavalue"][$i]["field"]);$j++){
											$value=$data['datavalue'][$i]['field'][$j]['value'];
											if($value!=0){
												
												if($j==0){
													$strSql .= " and ( s1.type=$value ";
												}else{
													$strSql .= " or  s1.type=$value ";
												}
												if($j==count($data["datavalue"][$i]["field"])-1){
													$strSql .= " )";
												}
											}
										}
									}
									break;
								case 2://地区
									if(count($data["datavalue"][$i]["field"])!=0){
										for($j=0;$j<count($data["datavalue"][$i]["field"]);$j++){
											$value=$data['datavalue'][$i]['field'][$j]['value'];
											if($value==0){
													$strSql .= " and s3.status=0 ";
													break;
											}else{
												if($j==0){
													$strSql .= " and s3.status=0 and ( s3.subareaid=$value  ";
												}else{
													$strSql .= " or s3.subareaid=$value ";
												}
												if($j==count($data["datavalue"][$i]["field"])-1){
													$strSql .= "  )";
												}
											}
										}
									}
									break;
							}
						}
					}
					$strSql .= " order by s1.lastmodifytime desc ";
					$strSql .= " limit 0,7 ";
//echo $strSql;
//die();
					$infolist = DBGetDataRowsSimple($strSql);
					for($i=0;$i<count($infolist);$i++){
						$supplierid=$infolist[$i]['id'];
						$strSql = "select s2.name FROM `suppliersubarea` s1";
						$strSql .= " left join subarea s2 on s1.subareaid=s2.id ";
						$strSql .= " where s1.supplierid=$supplierid and s1.status=0 ";
						$subarea3 = DBGetDataRowsSimple($strSql);
						$infolist[$i]["subarea"] = $subarea3;
					}
					break;
			}
			echo json_encode($infolist);
			break;
	}
?>