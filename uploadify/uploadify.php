<?php

// Define a destination
include "../paras.php";
//session_start();
// $targetFolder = $uploadpath.'uploadphotos'; // Relative to the root
$targetFolder = 'upload';
$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$targetPath = dirname(__FILE__).'/' . $targetFolder;
	
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
$targetFileName = session_id() . "_" . md5(time()) . "_" . mt_rand(10000000,99999999) . "." . substr($_FILES['Filedata']['name'], strrpos($_FILES['Filedata']['name'], '.')+1);;
$targetFile = rtrim($targetPath,'/') . '/' . $targetFileName;


	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo $targetFileName;
	} else {
		echo "Invalid file type.";
	}
}
?>