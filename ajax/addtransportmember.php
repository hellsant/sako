<?php
	include("../config.php");
	session_start();
	if(isset($_SESSION['objLogin'])){
	$sid = $_GET['sid'];
	$cid = $_GET['cid'];
	if(isset($_GET['sid']) && isset($_GET['sid'])){
		$sql = "INSERT INTO `tbl_add_tp_member`(sid,cid) VALUES('$sid','$cid')";
		mysql_query($sql,$link);
		echo mysql_insert_id();
	}
	echo '';
	}
	else{
		echo 'Invalid Access';
		die();
	}
?>