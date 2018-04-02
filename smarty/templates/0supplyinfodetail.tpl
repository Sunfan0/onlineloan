{include file="file:smartyheader.tpl"}
        <!-- 热门贷款产品链接详情内容 开始 -->
        <div class="picdetail">
            <div class="piccontent">
                <div class="title">
                    <h3>热门产品</h3>
                </div>
                <div class="detail">
                    <ul>
                        <li>
                            <table border="1">
                                <tbody>
                                    <tr>
                                        <th>产品名称</th>
                                        <td>{$supplyinfodetail.productname}</td>
                                    </tr>
                                    <tr>
                                        <th>产品类型</th>
										{if $supplyinfodetail.producttype eq "1"}
										<td>房产抵押</td>
										{elseif $supplyinfodetail.producttype eq "2"}
										<td>信用贷款</td>
										{/if}
                                    </tr>
									 <tr>
                                        <th>贷款成数</th>
										{if $supplyinfodetail.loannum eq "1"}
										<td>房产7层</td>
										{elseif $supplyinfodetail.loannum eq "2"}
										<td>按揭50倍</td>
										{/if}
                                    </tr>
									 <tr>
                                        <th>还款方式</th>
										{if $supplyinfodetail.paytype eq "1"}
										<td>等额本金</td>
										{elseif $supplyinfodetail.paytype eq "2"}
										<td>等额本息</td>
										{/if}
                                    </tr>
									 <tr>
                                        <th>贷款期限</th>
										{if $supplyinfodetail.paytime eq "1"}
										<td>1-5年</td>
										{elseif $supplyinfodetail.paytime eq "2"}
										<td>5-10年</td>
										{elseif $supplyinfodetail.paytime eq "3"}
										<td>10-15年</td>
										{elseif $supplyinfodetail.paytime eq "4"}
										<td>15年以上</td>
										{/if}
                                    </tr>
									<tr>
                                        <th>可贷金额</th>
										{if $supplyinfodetail.paynum eq "1"}
										<td>1-10万</td>
										{elseif $supplyinfodetail.paynum eq "2"}
										<td>10-20万</td>
										{elseif $supplyinfodetail.paynum eq "3"}
										<td>20-30万</td>
										{elseif $supplyinfodetail.paynum eq "4"}
										<td>30-40万</td>
										{/if}
                                    </tr>
                                    <tr>
                                        <th>收入要求</th>
                                        {if $supplyinfodetail.needincome eq "1"}
										<td>3000-5000</td>
										{elseif $supplyinfodetail.needincome eq "2"}
										<td>5000-10000</td>
										{elseif $supplyinfodetail.needincome eq "3"}
										<td>10000以上</td>
										{/if}
                                    </tr>
									<tr>
                                        <th>公司要求</th>
                                        {if $supplyinfodetail.needcompany eq "1"}
										<td>无公司</td>
										{elseif $supplyinfodetail.needcompany eq "2"}
										<td>有公司</td>
										{elseif $supplyinfodetail.needcompany eq "3"}
										<td>股东</td>
										{/if}
                                    </tr>
                                    <tr>
                                        <th>特色介绍</th>
                                        <td>{$supplyinfodetail.Featuresintroduce}</td>
                                    </tr>
									<tr >
                                        <td colspan='2' style='text-align:center'><button id="AttentionBtn"  >关注</button></td>
                                    </tr>
                                </tbody>
                            </table>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- 热门贷款产品链接详情内容 结束 -->
      
    </body>
		<script type="text/javascript" src="js/index.js"></script>
		<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
		 <script type="text/javascript">
			var start;
			var end;
			var duration = 0;
			start = new Date();
			$(window).bind('beforeunload', function(e) {
				end = new Date();//用户退出时间
				duration = end.getTime() - start.getTime();
				duration = duration/1000;//取的是秒
				//ajax更新数据库
				console.log(duration);//停留的时间单位是秒
				url = "ajax.php?";
				url += "mode=SupplyinfodetailStaytime";
				url += "&supplyinfoid={$supplyinfodetail.id}";
				url += "&staytime="+duration;
				$.get(url,function(json,status){
					AccessRecord('关闭贷款产品{$supplyinfodetail.productname}页面','贷款产品{$supplyinfodetail.productname}页面','贷款产品{$supplyinfodetail.productname}页面');
				});
			});
			window.onload=function(){
				AccessRecord('进入贷款产品{$supplyinfodetail.productname}页面','贷款产品{$supplyinfodetail.productname}页面','贷款产品{$supplyinfodetail.productname}页面');
				$("#AttentionBtn").click(function(){
					url = "ajax.php?";
					url += "mode=Attentionsupplyinfo";
					url += "&supplyinfoid={$supplyinfodetail.id}";
					$.get(url,function(json,status){
						data = eval("("+json+")");
console.log(data);
						if(data == null||data == 'null'||data == ""){
							CommonJustTip('暂无数据。');
							return;
						}
						switch(data){
							case 1:
								CommonJustTip('关注成功');
								break;
							case -1:
								CommonJustTip('系统错误，请重试');
								break;
						}
					});
				})
			}
			function checkLeave(){
				AccessRecord('关闭贷款产品{$supplyinfodetail.productname}页面','贷款产品{$supplyinfodetail.productname}页面','贷款产品{$supplyinfodetail.productname}页面');
			}
			function CommonJustTip(content,title){
				if(title == undefined){
					title = "";
				}
				$.confirm({
					title: title,
					content: content,
					cancelButton: false,
					confirmButton: false,
					backgroundDismiss: true,
					closeIcon: false
				});
			}
        </script>
</html>