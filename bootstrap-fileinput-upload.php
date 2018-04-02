<?php
include "paras.php";
if (empty($_FILES['images'])) {
    echo json_encode(['error'=>'No files found for upload.']); 
    return;
}
$images = $_FILES['images'];
//var_dump($images);
//die();
$studentNo = isset($_SESSION["sno"]) ? $_SESSION["sno"] : "";
$classId =isset($_SESSION["sno"]) ? $_SESSION["sno"] : "";

$lessonId = Get("lessonId");
$homeworkId = Get("homeworkId");
$teacherId = Get("teacherId");

// a flag to see if everything is ok
$success = null;

// file paths to store
$paths= [];

// get file names
$filenames = $images['name'];

// loop and process files
for($i=0; $i < count($filenames); $i++){
    $ext = explode('.', basename($filenames[$i]));
    $target = "uploads" . DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
    if(move_uploaded_file($images['tmp_name'][$i], $target)) {
        $success = true;
        $paths[] = array("file"=>$target,"size"=>$images['size'][$i],"filetype"=>$images['type'][$i],"name"=>$images["name"][$i]);
    } else {
        $success = false;
        break;
    }
}

if ($success === true) {//图片上传成功，更新数据
//插入图片表
	// $Id = DBInsertTableField("slideimg" , array("imgurl") ,array($target));
	// if($Id<=0)
		// die("-1"); 
    $output = ['uploaded' => $paths];
} elseif ($success === false) {
    $output = ['error'=>'Error while uploading images. Contact the system administrator , ' . $target];
    // delete any uploaded files
    foreach ($paths as $file) {
        unlink($file);
    }
} else {
    $output = ['error'=>'No files were processed.'];
}

// return a json encoded response for plugin to process successfully
echo json_encode($output);
?>