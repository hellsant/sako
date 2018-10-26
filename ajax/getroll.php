<?php
	include("../config.php");
	session_start();
	if(isset($_SESSION['objLogin'])){
	$html = '<option value="">--Select Roll--</option>';
	if(isset($_GET['rid'])){
		$result = mysqli_query($link,"SELECT * from tbl_add_student_charge where sc_class = '" . (int)$_GET['rid'] . "' order by charge_id asc");
		while($rows = mysqli_fetch_array($result)){
			$html .= '<option value="'.$rows['sc_roll'].'">'.$rows['sc_roll'].'</option>';
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