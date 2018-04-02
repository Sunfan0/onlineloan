<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>UploadiFive Test</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="jquery.uploadify.min.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="uploadify.css">
<style type="text/css">
body {
	font: 13px Arial, Helvetica, Sans-serif;
}
</style>
</head>

<body>
	<h1>Uploadify Demo</h1>
	<form>
		<div id="queue"></div>
		<!--<input id="file_upload" name="file_upload" type="file" multiple="true">-->
		<tr>
			<td align='center' width="25%">头像</td>
			<td align='center'>
				<input type="file" id="addidcardfrontbutton" type="file" name="idcardfrontbutton" multiple>
				<img id="addidcardfrontimage" style="width:100px;">
				<input type="hidden" id="addidcardfront" name="idcardfront">
			</td>
		</tr>

	</form>

	<script type="text/javascript">
		<?php $timestamp = time();?>
		// $(function() {
			// $('#file_upload').uploadify({
				// 'formData'     : {
					// 'timestamp' : '<?php //echo $timestamp;?>',
					// 'token'     : '<?php //echo md5('unique_salt' . $timestamp);?>'
				// },
				// 'swf'      : 'uploadify.swf',
				// 'uploader' : 'uploadify.php'
			// });
			$('#addidcardfrontbutton').uploadify ({ //以下参数均是可选  
				'formData'     : {
					'timestamp' : '<?php echo $timestamp;?>',
					'token'     : '<?php echo md5('unique_salt' . $timestamp);?>'
				},
				'swf'		: 'uploadify/uploadify.swf',   //指定上传控件的主体文件，默认‘uploader.swf’  
				'uploader'	: 'uploadify.php',       //指定服务器端上传处理文件，默认‘upload.php’  
				'auto'		: true,               //选定文件后是否自动上传，默认false  
				'folder'	: 'upload',         //要上传到的服务器路径，默认‘/’  
				'multi'		: false,               //是否允许同时上传多文件，默认false  
				'fileTypeDesc' : 'Image Files',
				'fileTypeExts' : '*.gif; *.jpg; *.png',  
				'fileSizeLimit' : '200KB',
				'onUploadSuccess' : function(file, data, response) {
					$("#addidcardfrontimage").removeClass('hidden');
					$("#addidcardfrontimage").css("display","block");
					$("#addidcardfrontimage").attr("src",'upload/'+data);
					$("#addidcardfront").val(data);
				}
			});

		// });
	</script>
</body>
</html>