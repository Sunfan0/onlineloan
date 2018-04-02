	
	<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/craftpip/js/jquery-confirm.js"></script>
	<script src="js/kkpager-master/src/kkpager.min.js" charset="utf-8"></script>
	<script type="text/javascript" src="js/bootstrap-select.js"></script>
	<script src="js/bootstrap-fileinput.js" charset="utf-8"></script>
	<script src="js/bootstrap-fileinput.locale.zh.js" charset="utf-8"></script>
	<script src="js/ueditor/ueditor.config.js" charset="utf-8"></script>
	<script src="js/ueditor/ueditor.all.min.js" charset="utf-8"></script>
	<script type="text/javascript" src="js\DataTables-1.10.11\media\js\jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="http://cdn.datatables.net/plug-ins/28e7751dbec/integration/bootstrap/3/dataTables.bootstrap.js"></script>
	<script src="js/md5.min.js" charset="utf-8"></script>
	<script src="js/jquery-minicolors-master/jquery.minicolors.js" charset="utf-8"></script>
	<script type="text/javascript">
	
		strFooterText = '<div class="FooterText hidden" style="position: absolute;width:100%;text-align:center;">';
		strFooterText+= '<a style="color: gray;" href="http://wsestar.com/" target="_blank">技术支持：西安传睿</a></div>';
		$("body").append(strFooterText);
		
		setTimeout(function(){
			var scrollHeight = document.getElementById("Maincontainer").scrollHeight;
			$(".FooterText").css("top",(scrollHeight-50));
			$(".FooterText").removeClass("hidden");
		},1000)
		
		/*
		$('#Maincontainer').click(function(e) {
			e.stopPropagation();
		});
		*/
		
		$(".navBtn").each(function(){
			$(this).click(function(){
				if($(this).attr("id")==undefined){return;}
				window.location.href = $(this).attr("id") + ".php";
			})
		})
		
		var  filename=location.href;
		filename=filename.substr(filename.lastIndexOf('/')+1);
		filename=filename.substr(0,filename.lastIndexOf('.'));
		switch(filename){
			case 'admin.news':
				var navbtnobj = document.getElementById('admin.newslist');
				break;
			case 'supply.info':
				var navbtnobj = document.getElementById('supply.infolist');
				break;
			case 'supply.pay':
				var navbtnobj = document.getElementById('supply.myscore');
				break;
			case 'supply.news':
				var navbtnobj = document.getElementById('supply.newslist');
				break;
			case 'demand.info':
				var navbtnobj = document.getElementById('demand.infolist');
				break;
			default:
				var navbtnobj = document.getElementById(filename);
				break;
		}
		$(navbtnobj).addClass("active");
		if(navbtnobj != null){
			preobj=navbtnobj.parentNode.parentNode;
			$(preobj).addClass("active");	
			$(preobj).addClass("open");	
			$(".container").removeClass("active");
		}
		
		
		
		// $.alert('Content here', 'Title here');
		// $.confirm('A message', 'Title is optional');
		// $.dialog('Just to let you know');
		
		// $.confirm({
			// confirmButton: '确定',
			// cancelButton: '取消',
			// confirmButtonClass: 'btn-info',
			// cancelButtonClass: 'btn-danger'
		// });
		
		// CommonJustTip('暂无数据。');
		// CommonWarning('服务器忙，请稍候再试。');
		// CommonConfirm('您确定？','提示');
		
		
		
		function CommonJustTip(content,title){
			if(title == undefined){
				title = "";
			}
			$.confirm({				
				title: title,
				content: content,
				// confirmButton: '确定',
				confirmButton: false,
				cancelButton: false,
				backgroundDismiss: true,
				// autoClose: 'confirm|1000'
			});
		}
		
		
		function CommonWarning(content,title){
			if(title == undefined){
				title = "";
			}
			$.confirm({
				icon: 'fa fa-warning',
				closeIcon: true,
				title: title,
				content: content,
				confirmButton: '确定',
				cancelButton: '取消'
			});
		}
		
		function CommonConfirm(content,title){
			if(title == undefined){
				title = "";
			}
			$.confirm({
				// icon: 'glyphicon glyphicon-heart',
				title: title,
				content: content,
				confirmButton: '确定',
				cancelButton: '取消'
			});
		}	
		function CommonNopower(){
			$.confirm({
				title: '',
				content: '您没有该页面的访问权限！',
				confirmButton: '确定',
				cancelButton: false,
				backgroundDismiss: true,
				autoClose: 'confirm|1000'
			});
		}
		function LocationHref(page,id){
			if(page == "index"){
				window.location.href= page+'.php';
				return;
			}
			if(id == undefined){
				window.location.href= page+'.new.php';
				return;
			}
			var idname = "";
			switch(page){
				case "smartyproindex":
					idname="supplyinfoid";
					break;
				case "smartyproductsdetails":
					idname="supplyinfoid";
					break;
				case "smartyconsultantdetails":
					idname="supplierid";
					break;
				case "smartynews":
					idname="newsid";
					break;
				case "smartyneed":
					idname="demandinfoid";
					break;
				case "smartyfooterdetail":
					idname="footerid";
					break;
			}
			window.location.href= page+'.new.php?'+idname+'='+id;
		}
   </script> 