{include file="file:smartyheader.tpl"}
        <!-- 需求信息详情页 开始 -->
        <div class="picdetail">
            <div class="piccontent">
                <div class="title">
                    <h3>需求信息详情</h3>
                </div>
                <div class="detail">
                    <ul>
                        <li>
                            <table border="1">
                                <tbody>
                                    <tr>
                                        <th>名字</th>
                                        <td>{$needinfordetail.name}</td>
                                    </tr>
                                    <tr>
                                        <th>身份</th>
										{if $needinfordetail.profession eq "1"}
										<td style="color:{$d.titlecolor};">公务员</td>
										{elseif $needinfordetail.profession eq "2"}
											<td >上班族</td>
										{elseif $needinfordetail.profession eq "3"}
											<td >自由职业</td>
										{elseif $needinfordetail.profession eq "4"}
											<td >个体</td>
										{else}
											<td >？？？？？</td>
										{/if}
                                    </tr>
                                    <tr>
                                        <th>需求金额</th>
                                        <td>{$needinfordetail.demandnum}</td>
                                    </tr>
                                    <tr>
                                        <th>抵押物</th>
										{if $needinfordetail.aptitude eq "1"}
										<td >车</td>
										{elseif $needinfordetail.aptitude eq "2"}
											<td >房</td>
										{elseif $needinfordetail.aptitude eq "3"}
											<td >车、房</td>
										{else}
											<td >？？？？？</td>
										{/if}
                                    </tr>
									<tr>
                                        <th>需求时间</th>
										{if $needinfordetail.demandtime eq "1"}
										<td >加急</td>
										{elseif $needinfordetail.demandtime eq "2"}
											<td >一周</td>
										{elseif $needinfordetail.demandtime eq "3"}
											<td >两周</td>
										{elseif $needinfordetail.demandtime eq "4"}
											<td >三周</td>
										{elseif $needinfordetail.demandtime eq "5"}
											<td >一个月</td>
										{/if}
                                        
                                    </tr>
									<tr>
                                        <th>其他说明</th>
                                        <td>{$needinfordetail.otherdesc}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- 需求信息详情页 结束 -->
        <script type="text/javascript">
		function checkLeave(){
			AccessRecord('关闭需求信息页面','需求信息页面','需求信息页面');
		}
        </script>
    </body>
</html>