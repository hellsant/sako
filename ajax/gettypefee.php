<?php
	include("../config.php");
	session_start();
	if(isset($_SESSION['objLogin'])){
	$html = '';
	if(isset($_GET['fid'])){
		$result = mysqli_query($link,"SELECT * from tbl_add_fee_set where f_type_id = '" . (int)$_GET['fid'] . "' order by fs_id asc");
		while($rows = mysqli_fetch_array($result)){
			$html .= $rows['f_fee'];
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