{include file="file:smartyheader.tpl"}
        <div class="picdetail">
            <div class="piccontent">
                <div class="title">
                    <h3>咨询专家</h3>
                </div>
                <div class="detail">
                    <ul>
                        <li>
                            <table border="1">
                                <tbody>
									 <tr>
                                        <th>用户名</th>
                                        <td>{$supplierdetail.username}</td>
                                    </tr>
									<tr>
                                        <th>身份</th>
										{if $supplierdetail.type eq "1"}
										<td >中介</td>
										{elseif $supplierdetail.type eq "2"}
										<td>机构</td>
										{/if}
                                    </tr>
                                    <tr>
                                        <th>头像</th>
                                        <td><img src="{$supplierdetail.imgurl}" height="80" width="80" alt=""></td>
                                    </tr>
                                    <tr>
                                        <th>所属公司</th>
                                        <td>{$supplierdetail.company}</td>
                                    </tr>
                                    <tr>
                                        <th>个人特色</th>
                                        <td>{$supplierdetail.personalfeature}</td>
                                    </tr>
                                    <tr>
                                        <th>最新产品</th>
                                        <td>{$supplierdetail.goodproduct}</td>
                                    </tr>
									<tr>
                                        <th>邮箱</th>
                                        <td>{$supplierdetail.email}</td>
                                    </tr>
									<tr>
                                        <th>微信号</th>
                                        <td>{$supplierdetail.wxnum}</td>
                                    </tr>
                                    <tr>
                                        <th>联系电话</th>
                                        <td>{$supplierdetail.mobile}</td>
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
</body>
		<script type="text/javascript" src="js/index.js"></script>
		 <script type="text/javascript">
			var start;
			var end;
			var duration = 0;
			start = new Date();
			$(window).bind('beforeunload', function(e){
				end = new Date();//用户退出时间
				duration = end.getTime() - start.getTime();
				duration = duration/1000;//取的是秒
				//ajax更新数据库
				console.log(duration);//停留的时间单位是秒
				url = "ajax.php?";
				url += "mode=SupplierdetailStaytime";
				url += "&supplierid={$supplierdetail.id}";
				url += "&staytime="+duration;
				$.get(url,function(json,status){
					AccessRecord('关闭贷款咨询页面','贷款咨询页面{$supplierdetail.username}','贷款咨询页面{$supplierdetail.username}');
				});
			});
			//
			window.onload=function(){
				AccessRecord('进入贷款咨询页面{$supplierdetail.username}','贷款咨询页面{$supplierdetail.username}','贷款咨询页面{$supplierdetail.username}');
				$("#AttentionBtn").click(function(){
					url = "ajax.php?";
					url += "mode=Attentionsupplier";
					url += "&supplierid={$supplierdetail.id}";
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
				AccessRecord('关闭贷款咨询页面','贷款咨询页面{$supplierdetail.username}','贷款咨询页面{$supplierdetail.username}');
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