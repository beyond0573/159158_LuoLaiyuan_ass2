<?php
	//Add the comment to database
	include "conn.php";
	$comment = $_GET['comment'];
	$com_pic_name = $_GET['com_pic_name'];
	$Com_userName = $_GET['username2'];
	$adminPicNum = $_SESSION["adminPicNum"];
	$usePicNum = $_SESSION["usePicNum"];
	$admi = $_SESSION["admin"];
	$timestamp = date("G:i:s M j Y");
	$allow_show = 0;
	//$we = empty($Com_userName);
	
	//if( !empty($Com_userName)){
		$INS="Insert Into tb_comment (username, admi, picName, comment, time) Values ('$Com_userName','$allow_show','$com_pic_name','$comment','$timestamp')";
	//} else {
		//$INS="Insert Into tb_comment (username, admi, picName, comment, time) Values ('visitor','$allow_show','$com_pic_name','$comment','$timestamp')";
	//}
	$do = mysql_query($INS, $mycon) or die('Error: ' . mysql_error());
	if($do){
		echo "1@@@".$adminPicNum."@@@".$usePicNum."@@@".$admi;
	} else{
		echo 0;
		echo "<script> alert('empty(Com_userName)' + $we);</script>";
	}
?>