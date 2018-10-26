<?php
	include("../config.php");
	session_start();
	if(isset($_SESSION['objLogin'])){
	$html = '<option value="">--Select--</option>';
	if(isset($_GET['classid'])){
		$result = mysqli_query($link,"SELECT * from tbl_add_subject where sb_class_id = '" . (int)$_GET['classid'] . "' order by sb_name asc");
		while($rows = mysqli_fetch_array($result)){
			$html .= '<option value="'.$rows['sb_id'].'">'.$rows['sb_name'].'</option>';
		}
		echo $html;
		die();
	}
	
	echo '';
	die();
	}
	else{
		echo 'Invalid Access';
		die();
	}
?>