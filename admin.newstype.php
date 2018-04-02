<?php include "header.php";?>
		
			<div id="Maincontainer" class="container" style="margin-top:30px;">
			<nav class="navbar navbar-default" role="navigation">
				<div class="container-fluid">
					<form class="navbar-form navbar-right col-sm-3" role="search">
						<button class="btn btn-primary text-right" onclick="ModifyType1('',''); return false;">+ 新增一级资讯栏目</button>
					</form>
				</div>
			</nav>
			<table id="ContentTable" class="table table-hover table-bordered">
				<thead>
					<tr>
						<th>一级栏目</th>
						<th>二级栏目</th>
						<th>操作</th>
					</tr>
				</thead>
				<tbody></tbody>
			</table>
		</div>
	</body>
	<?php	include "footer.php";	?>
	<script type="text/javascript">
		var Settings = {};
		var DataSortAll = new Array();
		
		window.onload = OnLoad;
		
		function OnLoad(){
			BindEvents();
			ShowNewsTypeList();
		}
		function BindEvents(){
			
		}

		function ShowNewsTypeList(){			
			DataSortAll = [];
			$("#ContentTable tbody").html("");
			url = "admin.newstype.ajax.php?mode=gettypelist";
			$.get(url,function(json,status){
				if(json == "123"){
					CommonNopower();
					$("#Maincontainer").addClass("hidden");
					return;
				}
				if(json == null){
					CommonJustTip('暂无数据。');
					return;
				}
				json = eval("("+json+")");
console.log(json);
				for(var i=0;i<json.length;i++){
					var strTbody = '';
					d = {};
					d.id = json[i].id;
					d.sort = json[i].sort;
					DataSortAll.push(d);
					if(json[i].childtype.length == 0){
						strTbody+= '<tr><td colspan="3" id="firsttype'+json[i].id+'">';
						strTbody+= ''+json[i].name+'&nbsp;&nbsp;&nbsp;';
						strTbody+= '<button onclick="MoveType(\'firsttype\',\'up\',' + json[i].id +',' + json[i].sort +','+json.length+')" class="btn btn-primary btn-sm">↑</button>&nbsp;';
						strTbody+= '<button onclick="MoveType(\'firsttype\',\'down\',' + json[i].id +',' + json[i].sort +','+json.length+')" class="btn btn-primary btn-sm">↓</button>&nbsp;&nbsp;&nbsp;';
						strTbody+= '<button onclick="ModifyType1(' + json[i].id +',\'' + json[i].name +'\')" class="btn btn-primary btn-sm">修改</button>&nbsp;';
						strTbody+= '<button onclick="DeletInfo(' + json[i].id +')" class="btn btn-danger btn-sm">删除</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
						strTbody+= '<button onclick="ModifyType2(' + json[i].id +',\'\',\'\')" class="btn btn-primary btn-sm">+ 新增二级栏目</button></td></tr>';
					}
					for(var c=0;c<json[i].childtype.length;c++){
						d = {};
						d.id = json[i].childtype[c].id;
						d.sort = json[i].childtype[c].sort;
						DataSortAll.push(d);
						if(c==0){
							strTbody+= '<tr><td rowspan="'+json[i].childtype.length+'" id="firsttype'+json[i].id+'">';
							strTbody+= ''+json[i].name+'&nbsp;&nbsp;&nbsp;';
							strTbody+= '<button onclick="MoveType(\'firsttype\',\'up\',' + json[i].id +',' + json[i].sort +','+json.length+')" class="btn btn-primary btn-sm">↑</button>&nbsp;';
							strTbody+= '<button onclick="MoveType(\'firsttype\',\'down\',' + json[i].id +',' + json[i].sort +','+json.length+')" class="btn btn-primary btn-sm">↓</button>&nbsp;&nbsp;&nbsp;';
							strTbody+= '<button onclick="ModifyType1(' + json[i].id +',\'' + json[i].name +'\')" class="btn btn-primary btn-sm">修改</button>&nbsp;';
							strTbody+= '<button onclick="DeletInfo(' + json[i].id +')" class="btn btn-danger btn-sm">删除</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
							strTbody+= '<button onclick="ModifyType2(' + json[i].id +',\'\',\'\')" class="btn btn-primary btn-sm">+ 新增二级栏目</button></td>';
							strTbody+= '<td id="secontype'+json[i].childtype[c].id+'">'+json[i].childtype[c].name+'</td>';
						}else{
							strTbody+= '<tr><td id="secontype'+json[i].childtype[c].id+'">'+json[i].childtype[c].name+'</td>';
						}					
						strTbody+= '<td><button onclick="MoveType(\'secontype\',\'up\',' + json[i].childtype[c].id +',' + json[i].childtype[c].sort +','+json[i].childtype.length+')" class="btn btn-primary btn-sm">↑</button>&nbsp;';
						strTbody+= '<button onclick="MoveType(\'secontype\',\'down\',' +json[i].childtype[c].id +',' + json[i].childtype[c].sort +','+json[i].childtype.length+')" class="btn btn-primary btn-sm">↓</button>&nbsp;&nbsp;&nbsp;';
						strTbody+= '<button onclick="ModifyType2(' + json[i].id +',' + json[i].childtype[c].id +',\'' +json[i].childtype[c].name+'\')" class="btn btn-primary btn-sm">修改</button>&nbsp;';
						strTbody+= '<button onclick="DeletInfo(' + json[i].childtype[c].id +')" class="btn btn-danger btn-sm">删除</button>&nbsp;&nbsp;&nbsp;</td></tr>';
					}
					$("#ContentTable tbody").append(strTbody);
				}
console.log(DataSortAll);
			});
		}
		function ModifyType1(id,name){//修改、新增一级栏目
			strcontent = '<p>请在下面输入一级栏目信息：</p>';
			strcontent+= '<input type="text" class="form-control" id="modifytext1" value="'+name+'">';
			$.confirm({
				title: '',
				content: strcontent,
				confirmButton: '确定',
				cancelButton: '取消',
				confirm: function(){
					name = $("#modifytext1").val();
					if(name == ""){
						return false;
					}
					UpdateType(0,id,name);
				},
				cancel: function(){
					return;
				}
			});		
		}
		function ModifyType2(parentid,id,name){//修改、新增二级栏目
console.log(name);
			strcontent = '<p>请在下面输入二级栏目信息：</p>';
			strcontent+= '<input type="text" class="form-control" id="modifytext2" value="'+name+'">';
			$.confirm({
				title: '',
				content: strcontent,
				confirmButton: '确定',
				cancelButton: '取消',
				confirm: function(){
					name = $("#modifytext2").val();
					if(name == ""){
						return false;
					}
					UpdateType(parentid,id,name);
				},
				cancel: function(){
					return;
				}
			});	
		}
		
		function MoveType(type,p,id,sort,sum){//移动二级栏目（判断可否上移或下移）
			var currentidname = $("#"+type+id).attr("id");
			var currentsort = sort;
			var datafirsttype = new Array();
			for(var f=0;f<$("[id^="+type+"]").length;f++){
				datafirsttype.push($("[id^="+type+"]")[f].id);
			}			
			if(p == "up"){
				if(currentidname == datafirsttype[0]){return;}
				for(var u=0;u<datafirsttype.length;u++){
					if(currentidname == datafirsttype[u]){
						var currentid = currentidname.substr(9,currentidname.length);
						var preidname = datafirsttype[(u-1)];
						var preid = preidname.substr(9,preidname.length);
						SetDataValue(currentid,preid);
					}
				}
			}
				
			if(p == "down"){
				if(currentidname == datafirsttype[(datafirsttype.length-1)]){return;}
				for(var u=0;u<datafirsttype.length;u++){
					if(currentidname == datafirsttype[u]){
						var currentid = currentidname.substr(9,currentidname.length);
						var nextidname = datafirsttype[(u+1)];
						var nextid = nextidname.substr(9,nextidname.length);
						SetDataValue(currentid,nextid);
					}
				}
			}
		}
		function SetDataValue(currentid,changeid){//改变DataSortAll数组相对的值
console.log(currentid,changeid);
			var indexid1,indexid2;
			for(var i=0;i<DataSortAll.length;i++){
				if(currentid == DataSortAll[i].id){
					indexid1 = i;
				}
				if(changeid == DataSortAll[i].id){
					indexid2 = i;
				}
			}
			var t = DataSortAll[indexid2].sort;
			DataSortAll[indexid2].sort = DataSortAll[indexid1].sort;
			DataSortAll[indexid1].sort = t;	
			UpdateSorttype();
		}
		
		function UpdateType(parentid,id,name){//新增、修改AJAX
			var data={};
			data.parentid = parentid;
			data.id = id;
			data.name = name;
			url = "admin.newstype.ajax.php?mode=UpdateType";
			$.get(url,{
				data : JSON.stringify(data)
			},function(json,status){
				json = eval("("+json+")");
console.log(json);
				switch (json){
					case 1:
						ShowNewsTypeList();
						break;
					default:
						CommonJustTip("服务器忙，请稍候再试。");
						break;
				}
			}); 
		}
		function UpdateSorttype(){//移动 AJAX 
			url = "admin.newstype.ajax.php?mode=UpdateSorttype";
			$.get(url,{
				data : JSON.stringify(DataSortAll)
			},function(json,status){
				json = eval("("+json+")");
console.log(json);
				switch (json){
					case 1:
						ShowNewsTypeList();
						break;
					default:
						CommonJustTip("服务器忙，请稍候再试。");
						break;
				}
			});
		}
		
		function DeletInfo(id){
			$.confirm({
				title: '提示',
				content: '您确定删除该资讯栏目？',
				confirmButton: '确定',
				cancelButton: '取消',
				confirm: function(){
					url = "admin.newstype.ajax.php?mode=deletetype&id="+id;
					$.get(url,function(json,status){
console.log(json);
						switch (json){
							case "1":
								ShowNewsTypeList();
								break;
							default:
								CommonWarning("服务器忙，请稍候再试。");
								break;
						}
					});
				},
				cancel: function(){
					return;
				}
			});
		}
	</script>
</html>

