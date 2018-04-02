 <!-- contanier 开始 -->
<div class='footer'>
					<div class='footer-top'>
						<div class='footer-top-1'>
							<div class='footer-top-1-table'>
								 <div class="footer-dl">
									{foreach $footervariedlist as $f}
										<dl><dt><i class="{$f.icon}"></i>{$f.name}</dt>
											{foreach $f.childfooter as $c}
												 <dd><a class='hoverpointer' onclick="LocationHref('smartyfooterdetail',{$c.id})">{$c.title}</a></dd>
											{foreachelse}
												<p>暂无数据</p>
											{/foreach}
										</dl>
									{foreachelse}
										<p>暂无数据</p>
									{/foreach}
								</div>
							</div>
							<div class='footer-top-tel'>
								<div class='footer-tel-left'>
									<img src='images/01_76.jpg'>
									<p>信贷网微信公众账号</p>
								</div>

								<div class='footer-tel-right'>
									<span>有问题咨询请投递</span><br>
									<span class='footer-span'>0000000@qq.com</span>
								</div>
								<div class='footer-tel-right footer-tel-right-2'>
									<span>摇一摇微信号 </span><br>
									<span class='footer-span'>0000000000</span>
								</div>
								<div class='footer-tel-right footer-tel-right-3'>
									<span>QQ随时在线</span><br>
									<span class='footer-span'>00000000</span>
								</div>

							</div>
						</div>
					</div>
					<div class='footer-buttom'>
						<div class='footer-buttom-1'>
							<div class='footer-buttom-left'>
								<div style="background:url(images/kf.png);margin-top: 20px;width:282px;height:64px;">
									<p style="padding-left: 75px;color: #dcdddd;font-size: 26px;">
										{$footerfixed.telephone}
									</p>
								</div>
							</div>

							<div class='footer-buttom-right'>
								<p>{$footerfixed.copyright}</p>
								<a href="http://wsestar.com/">技术支持：西安传睿数字技术有限公司</a>
							</div>
						</div>
					</div>
				</div>
<!-- contanier end -->
