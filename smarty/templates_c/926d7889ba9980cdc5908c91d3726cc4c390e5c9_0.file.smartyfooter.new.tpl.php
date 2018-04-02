<?php
/* Smarty version 3.1.30, created on 2017-06-13 15:50:51
  from "E:\xampp\htdocs\test\test.works\onlineloan\smarty\templates\smartyfooter.new.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_593f995b800144_38360422',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '926d7889ba9980cdc5908c91d3726cc4c390e5c9' => 
    array (
      0 => 'E:\\xampp\\htdocs\\test\\test.works\\onlineloan\\smarty\\templates\\smartyfooter.new.tpl',
      1 => 1497337330,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_593f995b800144_38360422 (Smarty_Internal_Template $_smarty_tpl) {
?>
 <!-- contanier 开始 -->
<div class='footer'>
					<div class='footer-top'>
						<div class='footer-top-1'>
							<div class='footer-top-1-table'>
								 <div class="footer-dl">
									<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['footervariedlist']->value, 'f');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['f']->value) {
?>
										<dl><dt><i class="<?php echo $_smarty_tpl->tpl_vars['f']->value['icon'];?>
"></i><?php echo $_smarty_tpl->tpl_vars['f']->value['name'];?>
</dt>
											<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['f']->value['childfooter'], 'c');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['c']->value) {
?>
												 <dd><a class='hoverpointer' onclick="LocationHref('smartyfooterdetail',<?php echo $_smarty_tpl->tpl_vars['c']->value['id'];?>
)"><?php echo $_smarty_tpl->tpl_vars['c']->value['title'];?>
</a></dd>
											<?php
}
} else {
?>

												<p>暂无数据</p>
											<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

										</dl>
									<?php
}
} else {
?>

										<p>暂无数据</p>
									<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

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
										<?php echo $_smarty_tpl->tpl_vars['footerfixed']->value['telephone'];?>

									</p>
								</div>
							</div>

							<div class='footer-buttom-right'>
								<p><?php echo $_smarty_tpl->tpl_vars['footerfixed']->value['copyright'];?>
</p>
								<a href="http://wsestar.com/">技术支持：西安传睿数字技术有限公司</a>
							</div>
						</div>
					</div>
				</div>
<!-- contanier end -->
<?php }
}
