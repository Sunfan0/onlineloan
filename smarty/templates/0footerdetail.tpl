{include file="file:smartyheader.tpl"}
        <!-- 分类资讯 开始 -->
        <div class="message">
            <div class="piccontent">
                <div class="title">
                    <h3>{$footerinfo.title}</h3>
                </div>
                <div class="list">
                    <ul>
                        <li style="border-bottom:0;">
                            {$footerinfo.content}
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        <!-- 分类资讯 结束 -->
        <script type="text/javascript">
		 function checkLeave(){
			AccessRecord('关闭页脚信息页面','页脚信息页面','页脚信息页面');
		}
        </script>
    </body>
</html>