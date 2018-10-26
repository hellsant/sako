<?php
	include("../config.php");
	session_start();
	if(isset($_SESSION['objLogin'])){
	$html = '<option value="">--Select Student--</option>';
	if(isset($_GET['classid'])){
		$result = mysqli_query($link,"SELECT * from tbl_add_student where s_class_id = '" . (int)$_GET['classid'] . "' order by s_name asc");
		while($rows = mysqli_fetch_array($result)){
			$html .= '<option value="'.$rows['s_id'].'">'.$rows['s_name'].'</option>';
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