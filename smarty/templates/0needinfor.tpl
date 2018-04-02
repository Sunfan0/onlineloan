{include file="file:smartyheader.tpl"}
        <!-- 需求信息列表 开始 -->
        <div class="needdetail">
            <div class="detailcontent">
                <div class="title">
                    <h3>需求信息</h3>
                </div>
                <div class="detail">
                    <div class="list">
                        <table border="1">
                            <thead>
                                <tr>
                                    <th>姓名</th>
                                    <th>身份</th>
                                    <th>申请额度</th>
                                    <th>抵押物</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            {foreach $needinforlist as $list}
                                <tr>
                                    <td>{$list.name}</td>
                                    
									{if $list.profession eq "1"}
									<td >公务员</td>
									{elseif $list.profession eq "2"}
										<td >上班族</td>
									{elseif $list.profession eq "3"}
										<td >自由职业</td>
									{elseif $list.profession eq "4"}
										<td >个体</td>
									{else}
										<td >？？？？？</td>
									{/if}
								
                                    <td>{$list.demandnum}</td>
                                    {if $list.aptitude eq "1"}
                                        <td>车</td>
                                    {elseif $list.aptitude eq "2"}
                                        <td>房</td>
                                    {elseif $list.aptitude eq "3"}
                                        <td>车、房</td>
                                    {/if}
                                    <td><a href="needinfordetail.php?demandinfoid={$list.id}">查看</a></td>
                                </tr>
                            {/foreach}

                            </tbody>
                        </table>
                    </div>
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