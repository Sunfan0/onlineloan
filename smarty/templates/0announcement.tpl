{include file="file:smartyheader.tpl"}
        <!-- 公告信息 开始 -->
        <div class="picdetail">
            <div class="piccontent">
                <div class="title">
                    <h3>公告</h3>
                </div>
                <div class="detail">
                    <ul>
                        {foreach $announcementlist as $annlist}
                        <li style="display: flex;justify-content: space-between;">
						<span class="content">{$annlist.content}</span>
						<span class="time" style="color: #9E9E9E;">{$annlist.createtime}</span></li>
                        {/foreach}
                    </ul>
                </div>
            </div>
        </div>
        <!-- 公告信息 结束 -->
        <script type="text/javascript">
			function checkLeave(){
				AccessRecord('关闭公告页面','公告页面','公告页面');
			}
        </script>
    </body>
</html>