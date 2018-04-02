 <!-- contanier 开始 -->
<div id="container">
    <div class="content">
        <!-- footer start -->
        <div class="footer">
            <div class="hot-pohone">
                <a href="#"><img src="images/1.png" height="107" width="180" alt=""></a>
                <p style="font-size: 25px;color: #E7141A;margin-left: 70px; font-weight: 600;">{$footerfixed.telephone}</p>
            </div>
            <div class="call-our">
                {foreach $footervariedlist as $f}
                    <dl><dt><i class="fa fa-user"></i>{$f.name}</dt>
                        {foreach $f.childfooter as $c}
                             <dd><a href="footerdetail.php?footerid={$c.id}" onclick="AccessRecord('点击页脚信息','详情页面','页脚信息');">{$c.title}</a></dd>
                        {foreachelse}
                            <p>暂无数据</p>
                        {/foreach}
                    </dl>
                {foreachelse}
                    <p>暂无数据</p>
                {/foreach}
            </div>
        </div>
        <div class="hint">
            <p style="line-height: 20px;margin-top:10px;">{$footerfixed.copyright}</p>
            <a style="line-height: 20px;text-align: center; display: block;"  href="http://wsestar.com/">西安传睿数字技术有限公司技术支持</a>
        </div>
        <!-- footer end -->
    </div>
</div>
<!-- contanier end -->
