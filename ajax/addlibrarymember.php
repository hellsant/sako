<?php
	include("../config.php");
	session_start();
	if(isset($_SESSION['objLogin'])){
	$sid = $_GET['sid'];
	$cid = $_GET['cid'];
	if(isset($_GET['sid']) && isset($_GET['sid'])){
		$sql = mysqli_query($link,"INSERT INTO `tbl_library_member`(sid,cid) VALUES('$sid','$cid')");
		mysqli_query($link,$sql);
		echo mysql_insert_id();
	}
	echo '';
	}
	else{
		echo 'Invalid Access';
		die();
	}
?>