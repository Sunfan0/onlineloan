<?php	
	include "header.php";
	$newsId = Get("newsId");
?>

		<div id="Maincontainer" class="container" style="margin-top:50px;">
			<!--<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<form class="navbar-form navbar-right" role="search">
						<a class="btn btn-primary text-right" href="admin.newslist.php"><< 返回</a>
					</form>							
				</div>
			</nav>-->
			<form class="form-horizontal"  style="margin-left:-80px;">
				<div class="form-group">
					<label for="images" class="col-sm-2 control-label submitprompt">资讯头图<span>*</span></label>
					<div class="col-sm-4" style="text-align: left;">
						<input id="images" name="images[]" type="file" multiple data-min-file-count="1">
					</div>					
				</div>
				<div class="form-group">
					<label for="NewsTitle" class="col-sm-2 control-label submitprompt">资讯标题<span>*</span></label>
					<div class="col-sm-4">
						<input id="NewsTitle" type="text" class="form-control" >
					</div>
					<label for="NewsTitleColor" class="col-sm-3 control-label">标题颜色</label>
					<div class="col-sm-3">
						<input type="text" id="NewsTitleColor" class="form-control colorDemo" data-position="bottom right" value="#000000">
					</div>
				</div>
				<div class="form-group">
					<label for="NewsInfo" class="col-sm-2 control-label submitprompt">资讯信息<span>*</span></label>
					<div class="col-sm-10">
						<!--<button id="GoNewsInfo" class="btn btn-default  btn-block">︾&nbsp;&nbsp;&nbsp;展开</button>-->
						<div id="NewsInfo" type="text/plain" style="width:100%;height:400px;"></div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label submitprompt">资讯类型<span>*</span></label>
					<div class="col-sm-10">
						<select class="form-control" id="NewsColumn1"></select>
					</div>
				</div>
				<!--<div class="form-group">
					<label class="col-sm-2 control-label">二级栏目</label>
					<div class="col-sm-10">
						<select class="form-control" id="NewsColumn2" class="selectpicker show-tick form-control" multiple data-live-search="false"></select>
					</div>
				</div>-->
				<div class="form-group">
					<label class="col-sm-2 control-label submitprompt">资讯所属的子站<span>*</span></label>
					<div class="col-sm-10">
						<div class="checkbox" style="text-align:left;">
							<select id="NewsStation" class="selectpicker show-tick form-control" multiple data-live-search="false">
							</select>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label for="NewsLabel" class="col-sm-2 control-label">资讯标签</label>
					<div class="col-sm-10">
						<textarea id="NewsLabel"  class="form-control" rows="3"></textarea>
					</div>
					<!--<div class="col-sm-8">
						<select class="form-control" id="NewsLabel">
						</select>
					</div>
					<div class="col-sm-2">
						<a onclick="NewsCreateLabel();" class="btn btn-primary text-right">+ 新增标签</a>
					</div>-->
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">是否允许回复</label>
					<div class="col-sm-10">
						<div class="radio">
							<label class="checkbox-inline">
								<input type="radio" name="optionsRadios" class="NewsReply"  value="0">否
							</label>
							<label class="checkbox-inline">
								<input type="radio" name="optionsRadios" class="NewsReply" value="1">是
							</label>
						</div>
					</div>
				</div>
				<div class="form-group">
					<label class="col-sm-2 control-label">是否推荐</label>
					<div class="col-sm-10">
						<div class="radio">
							<label class="checkbox-inline">
								<input type="radio" name="optionsRadio" class="NewsRecommend"  value="0">否
							</label>
							<label class="checkbox-inline">
								<input type="radio" name="optionsRadio" class="NewsRecommend" value="1">是
							</label>
						</div>
					</div>
				</div>
				<div class="form-group" style="text-align: right;margin-right: 5px;">
					<div class="checkbox">
						<label>
							<input type="checkbox" id="NewsSetTop"> 将该资讯置顶
						</label>
					</div>
				</div>
				<div class="form-group text-right">
					<a id="deleteBtn" onclick="DeleteInfo();" class="btn btn-danger" style="margin-right:70%;">删除</a>
					<a href="admin.newslist.php" class="btn btn-default" style="margin-right:15px;">取消</a>
					<a onclick="SaveInfo();" class="btn btn-success" style="margin-right:18px;">保存</a>
				</div>
			</form>
		</div>
	</body>
	<?php	include "footer.php";	?>
	<script type="text/javascript">
		var Settings = {};
		Settings.image = "";
		var datasubareaall = new Array();

		window.onload = OnLoad;

		<?php $timestamp = time();?>
		
		var newsId = "<?php echo $newsId; ?>";
		
// var newsId = "1";

		function OnLoad(){
			var ue = UE.getEditor('NewsInfo');
			BindEvents();
		}
		function BindEvents(){
			$("#images").fileinput('destroy');
				r = $("#images").fileinput({
				language: 'zh',
				uploadAsync: true,
				uploadUrl: 'bootstrap-fileinput-upload.php',
				// allowedFileExtensions : ['jpg', 'png','gif',"pdf"],
				uploadExtraData: function() {
					return {
						
					};
				},
				//initialPreview: data.files,
				initialPreviewAsData: true,
				overwriteInitial: false,
				showUpload: false,
				showDrag: false,
				//initialPreviewConfig: data.preview,
				maxFileSize:400
			}).on('fileselect', function(event, numFiles, label) {
				$('#images').fileinput('upload');
				
			}).on('fileuploaded', function(event, data, previewId, index) {//上传成功回调
				//alert(data.response.uploaded[0].file);
				// arrimg.push(data.response.uploaded[0].file);
				Settings.image = data.response.uploaded[0].file;
			});
			
			// $("#NewsColumn1").click(function(){
				// var column = $("#NewsColumn1").val();
				// if(column == null){return;}
				// ShowNewsColumn2(column);
			// })
			
			setTimeout(function(){
				if(newsId != ""){
					ModifyInfo();
					$("#deleteBtn").removeClass("hidden");
				}else{
					AddInfo();
					$("#deleteBtn").addClass("hidden");
				}
			},500)
			ShowNewsColumn1();			
		}
		function ShowNewsColumn1(){
			$("#NewsColumn1").html("");
			url = "admin.newslist.ajax.php?mode=newsfirsttypelist";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				if(json == null){return;}
				for(var i=0;i<json.length;i++){
					var strTbody = '<option value="'+json[i].id+'">'+json[i].name+'</option>';
					$("#NewsColumn1").append(strTbody);
				}
			});
		}
		/* function ShowNewsColumn2(c){
			$("#NewsColumn2").html("");
			url = "admin.newslist.ajax.php?mode=newssecondtypelist&parentid="+c;
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				if(json == null){return;}
				for(var i=0;i<json.length;i++){
					var strTbody = '<option value="'+json[i].id+'">'+json[i].name+'</option>';
					$("#NewsColumn2").append(strTbody);
					$('#NewsColumn2').selectpicker('refresh');
				}
			});
		} */
		function ShowSubarealist(){
			datasubareaall = new Array();
			$("#NewsStation").html("");
			url = "admin.newslist.ajax.php?mode=subarealist";
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				if(json == null){return;}
				for(var i=0;i<json.length;i++){
					var d={};
					d.id = json[i].id;
					d.status = 0;
					datasubareaall.push(d);
					var strTbody = '<option value="'+json[i].id+'">'+json[i].name+'</option>';
					$("#NewsStation").append(strTbody);
					$('#NewsStation').selectpicker('refresh');
				}
			});
		}
		
		function ModifyInfo(){
			ShowSubarealist();
			$('#images').fileinput('refresh', {initialPreview:""});
			$("#NewsTitle").val("");
			$("#NewsTitleColor").val("#000000");
			UE.getEditor('NewsInfo').setContent("");
			$("#NewsColumn1").val("");
			// $("#NewsColumn2").selectpicker('val','');
			$('#NewsStation').selectpicker('val','');
			$("#NewsLabel").val("");
			$(".NewsReply:eq(0)").attr("checked",'checked');
			$(".NewsRecommend:eq(0)").attr("checked",'checked');
			$("#NewsSetTop").prop("checked",false);
			
			url = "admin.newslist.ajax.php?mode=ShownewsDetail&id="+newsId;
			$.get(url,function(json,status){
				json = eval("("+json+")");
console.log(json);
				if(json == null){
					CommonJustTip('暂无数据。');
					return;
				}
				Settings.image = json.image;
				$('#images').fileinput('refresh', {initialPreview:[json.image]});
				$("#NewsTitle").val(json.title);
				$("#NewsTitleColor").val(json.titlecolor);
				UE.getEditor('NewsInfo').setContent(json.content);
				
				if(json.allowreply == "1"){$(".NewsReply:eq(1)").attr("checked",'checked'); }
				if(json.isrecommend == "1"){$(".NewsRecommend:eq(1)").attr("checked",'checked'); }
				if(json.isstick == "1"){$("#NewsSetTop").prop("checked",true);}
				$("#NewsColumn1").val(json.newstypeid);
				
				
				var dataStation = new Array();//所属子站
				if(json.subarealist == null)
					return;
				for(i=0;i<json.subarealist.length;i++){		
					dataStation.push(json.subarealist[i].id);
				}
				$('#NewsStation').selectpicker('val', dataStation);
				
				var strLabel = "";	//资讯标签
				if(json.newslabel == null)
					return;
				for(i=0;i<json.newslabel.length;i++){
					strLabel += json.newslabel[i].labeltext + ",";
				}
				$("#NewsLabel").val(strLabel);
				
				// ShowNewsColumn2(json.newstypeid);

				// var dataColumn2 = new Array();//二级栏目
				// if(json.secondnewstype == null)
					// return;
				// for(i=0;i<json.secondnewstype.length;i++){		
					// dataColumn2.push(json.secondnewstype[i].id);
				// }
				// setTimeout(function(){
					// $('#NewsColumn2').selectpicker('val', dataColumn2);
				// },500)
			});
			ShowColorDemo();
		}
		function AddInfo(){
			ShowSubarealist();
			$('#images').fileinput('refresh', {initialPreview:""});
			$("#NewsTitle").val("");
			$("#NewsTitleColor").val("#000000");
			UE.getEditor('NewsInfo').setContent("");
			$("#NewsColumn1").val("");
			// $("#NewsColumn2").selectpicker('val','');
			$('#NewsStation').selectpicker('val','');
			$("#NewsLabel").val("");
			$(".NewsReply:eq(0)").attr("checked",'checked');
			$(".NewsRecommend:eq(0)").attr("checked",'checked'); 
			$("#NewsSetTop").prop("checked",false);
			ShowColorDemo();
		}
		function SaveInfo(){
			var data = {};
			data.flagid = newsId;
			data.image = Settings.image;
			data.title = $("#NewsTitle").val();
			data.titlecolor = $("#NewsTitleColor").val();
			data.content = UE.getEditor('NewsInfo').getContent();
			data.newstypeid = $("#NewsColumn1").val();
			data.allowreply = $(".NewsReply:checked").val();
			data.isrecommend = $(".NewsRecommend:checked").val();
			data.isstick = 0;
			if($("#NewsSetTop").is(':checked')){data.isstick = 1;}
			
			if(data.image == ""){$("#images").focus();CommonWarning('资讯头图不能为空！');return;}
			if(data.title == ""){$("#NewsTitle").focus();CommonWarning('资讯标题不能为空！');return;}
			if(data.content == ""){$("#NewsInfo").focus();CommonWarning('资讯信息不能为空！');return;}
			if(data.newstypeid == null){$("#NewsColumn1").focus();CommonWarning('一级栏目不能为空！');return;}
			
			var station = $("#NewsStation").val();
			if(station == null){
				$("#NewsStation").focus();CommonWarning('资讯所属的子站不能为空！');return;
			}else{
				for(i=0;i<station.length;i++){
					var id = station[i];
					for(d=0;d<datasubareaall.length;d++){
						if(id == datasubareaall[d].id){
							datasubareaall[d].status = 1;
						}
					}
				}
			}
			data.subarea =  datasubareaall;
			data.label = $("#NewsLabel").val();
			if(data.label == ""){$("#NewsLabel").focus();CommonWarning('资讯标签不能为空！');return;}
console.log(data);
			url = "admin.newslist.ajax.php?mode=UpdateNews";
			$.post(url, {
				data : JSON.stringify(data)
			} ,function(json,status){
console.log(json);
				switch (json){
					case "1":
						window.location.href = "admin.newslist.php";
						break;
					default:
						CommonWarning("服务器忙，请稍候再试。");
				}
			});
		}
		function DeleteInfo(){
			$.confirm({
				title: '提示',
				content: '您确定删除该资讯？',
				confirmButton: '确定',
				cancelButton: '取消',
				confirm: function(){
					url = "admin.newslist.ajax.php?mode=Deletenews&id="+newsId;
					$.post(url,function(json,status){
console.log(json);
						switch (json){
							case "1":
								window.location.href = "admin.newslist.php";
								break;
							default:
								CommonWarning("服务器忙，请稍候再试。");
						}
					});
				},
				cancel: function(){
					return;
				}
			});
		}
		
		/* function NewsCreateLabel(){
			strTitle= '<h4>新增标签</h4>';
			strCreate = '<input id="NewsCreateText" type="text" class="form-control" >';
			$.confirm({
				title: strTitle,
				content: strCreate,
				confirmButton: '确定',
				cancelButton: '取消',
				confirm: function () {
					var newsCreateText = $("#NewsCreateText").val();
					
					if(newsCreateText != ""){
						// url = "ajax.php?mode=";
						// $.get(url,function(json,status){
							// console.log(json);
								// if(json == "1"){
									CommonJustTip('新增成功！');
									ShowNewsLabelList();
								// }else
									// CommonJustTip('新增失败！');
						// });
					}else
						CommonJustTip('新增失败！');

				},
				cancel: function(){
					return;
				}
			});
		} */
		/* function ShowNewsLabelList(){
			$("#NewsLabel").html("");

			// url = "ajax.php?mode=";
			// $.get(url,function(json,status){
				// json = eval("("+json+")");
				// console.log(json);
				// for(var i=0;i<json.length;i++){					
					// strTbody = '<option value="'+json[i].id+'">'+json[i].name+'</option>';
				for(var i=0;i<10;i++){	
					strTbody = '<option value="'+i+'">'+i+'标签</option>';
					$("#NewsLabel").append(strTbody);
				}
			// });
		} */
		function ShowColorDemo(){
			$('.colorDemo').each( function() {
				$(this).minicolors({
					control: $(this).attr('data-control') || 'hue',
					defaultValue: $(this).attr('data-defaultValue') || '',
					inline: $(this).attr('data-inline') === 'true',
					letterCase: $(this).attr('data-letterCase') || 'lowercase',
					opacity: $(this).attr('data-opacity'),
					position: $(this).attr('data-position') || 'bottom left',
					change: function(hex, opacity) {
						if( !hex ) return;
						if( opacity ) hex += ', ' + opacity;
						try {
							console.log(hex);
						} catch(e) {}
					},
					theme: 'bootstrap'
				}); 
			});
		}
   </script> 
</html>