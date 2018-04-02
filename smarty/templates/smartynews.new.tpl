
		<!--主体部分-->
		<div class="contanier">
			<!--当前位置-->
			<div class="loaciton"><img src="images/location.png" alt="" />您当前的位置：
				<a class="hoverpointer" onclick="LocationHref('index')">首页</a> >
				<a class="hoverpointer" onclick="LocationHref('smartynewslist')">信贷资讯</a> >
				<a href="#">正文</a>
			</div>
			<div class="content clearfix" style='margin-bottom: 20px;'>
				<div class="contleft">
					<div class="newscont bgborder" style="padding: 0px 20px 20px;">
						<div class="newstitle">
							<h2>{$newsinfo.title}</h2>
							<span>发布时间：{$newsinfo.createtime} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;来源：贷款信息网</span>														
						</div>
						<p><img src="{$newsinfo.image}" alt="" /></p>
						<p>{$newsinfo.content}</p>
						{if {$newsafterinfo} eq ''}
							
						{else}
							<div class="next"><span>下一篇：</span><a href="smartynews.new.php?newsid={$newsafterinfo.id}">{$newsafterinfo.title}</a></div>
						{/if}
						{if {$newsbeforeinfo} eq ''}
					
						{else}
							<div class="prev"><span>上一篇：</span><a href="smartynews.new.php?newsid={$newsbeforeinfo.id}">{$newsbeforeinfo.title}</a></div>			
						{/if}
					</div>
					<div class="newscont bgborder" style="padding:20px;border-top:0px;">
						<textarea id="input_comment" style="height:23px;width:99%;margin-bottom: 5px;padding: 5px 2px 5px 6px;word-wrap: break-word; line-height: 18px;border:1px #cccccc solid;box-shadow: 0px 0px 3px 0px rgba(0,0,0,0.15) inset;overflow: hidden;border-radius: 4px;-moz-border-radius: 4px;-webkit-border-radius: 4px;position: relative;z-index:500;behavior: url(style/PIE.htc);"></textarea>
						<p style="text-align:right;padding:0;">
							<button id="submit_comment" style="height:30px;width:60px;color: #fff;background-color: #67bcd8;cursor: pointer; border: 0;border-radius: 4px;-moz-border-radius: 4px;-webkit-border-radius: 4px;position: relative;z-index:500;behavior: url(style/PIE.htc);">留言</button>
						</p>
						
						<div id="All_comment" style="border-top: 1px #cccccc solid;margin: 10px 0;">
							<!--<div class="con_comment" style="margin:10px;">
								<span style="color:#67bcd8;">名字</span>&nbsp;：
								<span>
								留言留言留言，留言留言留言留言留言留言留言。
								留言留言留言留言留言留言，留言留言留言留言留言。
								留言留言，留言留言留言留言留言留言留言留言。
								</span>
								<span style="display:block;color:#808080;font-size:12px;">6月19日 07:58</span>
							</div>-->
						</div>
					</div>
				</div>
				<div class="contright">

					<!--常用工具-->
					<div class='xindaidaixun-right'>
						<div class='xindaidaixun-right-top'>
							<div class='xindaidaixun-right-top-2'>
								<div class='div3-8'>
								</div>
								<span class='span3-5'>常用工具</span>
							</div>
						</div>
						<div class='xindaidaixun-right-buttom'>
							<div class='xindaidaixun-right-buttom-1'>
								<img src="images/01_34.jpg" alt="" onclick="LocationHref('fangdai')"/>
								<p>
									<span class='xindaidaixun-right-buttom-1-1' onclick="LocationHref('fangdai')">房贷计算器</span>
								</p>
							</div>

							<div class='xindaidaixun-right-buttom-1'>
								<img src="images/01_36.jpg" alt="" onclick="LocationHref('chedai')"/>
								<p>
									<span class='xindaidaixun-right-buttom-1-2' onclick="LocationHref('chedai')">车代计算器</span>
								</p>
							</div>

							<div class='xindaidaixun-right-buttom-1'>
								<img src="images/01_40.jpg" alt="" onclick="LocationHref('ershoufang')"/>
								<p>
									<span class='xindaidaixun-right-buttom-1-3' onclick="LocationHref('ershoufang')">二手房贷计算器</span>
								</p>
							</div>

							<div class='xindaidaixun-right-buttom-1'>
								<img src="images/01_42.jpg" alt="" onclick="LocationHref('gongjijin')"/>
								<p>
									<span class='xindaidaixun-right-buttom-1-4' onclick="LocationHref('gongjijin')">公积金贷款计算器</span>
								</p>
							</div>
						</div>
					</div>
					<!--快速贷款信息-->
					<div class='img2-form bgborder'>
						<p>快速贷款通道</p>
						<div class='img2-form-1'>
							<form>
								<input id="apply_money" type="text" placeholder="贷款金额（万元）" class='form-1-1' />
								<input id="apply_surname" type="text" placeholder="您的姓氏" class='form-1-2' />
								<select id="apply_sex" name="" id="" value='请选择' class='form-1-3'>
									<option value="1"><img src='images/men.jpg'>男</option>
									<option value="2">女</option>
								</select>
								<input id="apply_mobile" type="tel" placeholder="联系手机" class='form-1-4' />
								<input id="apply_code" type="text" placeholder="图片验证码" class='form-1-5' />
								<div id="apply_img" class='yanzhengma'></div>
								<input id="apply_mcode" type="text" placeholder="验证码" class='form-1-6' />
								<input id="apply_mcodebtn" type="button" value='获取验证码' class='button-1-1' />
								<input id="apply_submitbtn" type="button" value='提交贷款' class='button-1-2' />
							</form>
						</div>
					</div>			
				</div>
			</div>			
		</div>		
		<!--主体部分 end-->
		<script type="text/javascript">
		console.log({json_encode($newsinfo)});
		console.log({json_encode($newsafterinfo)});
		console.log({json_encode($newsbeforeinfo)});
		console.log({json_encode($viewright)});
	
		window.onload = OnLoad;
		function OnLoad(){
			BindEvents();
			Showcomment();
			ShowTitlecon("{$newsinfo.title}");
		}
		function BindEvents(){
			$("#submit_comment").click(function(){
				Submitcomment();
			});
		}
		function Showcomment(){
			$("#All_comment").html("");
			url= "ajax.php?mode=newsinforeplyreplylist&newsid={$newsinfo.id}";
			$.get(url,function(json,status){
				if(json==""||json=="null"){
					return;
				}
				json = eval("(" +json+ ")")
console.log(json);
				for(var i=0;i<json.length;i++){
					var strcomment = "<div class='con_comment' style='margin:10px;'><span style='color:#67bcd8;'>"+json[i].username+"</span>&nbsp;：<span>";
					strcomment+= ""+json[i].content+"</span><span style='display:block;color:#808080;font-size:12px;'>"+json[i].createtime+"</span></div>";
					$("#All_comment").append(strcomment);
				}
			});	
		}
		function Submitcomment(){
			var replytext = $("#input_comment").val();
			if(replytext==""){
				CommonJustTip("留言内容不能为空！","提示");
				return;
			}
			Common_MobileView({$viewright},'123',"ajax.php?mode=newsinforeply&newsid={$newsinfo.id}&replytext="+replytext,function(){
				$("#input_comment").val("");
				Showcomment();
			},false,"留言")
		}
   </script>
	</body>
</html>