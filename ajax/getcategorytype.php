<?php
	include("../config.php");
	session_start();
	if(isset($_SESSION['objLogin'])){
	$html = '';
	if(isset($_GET['hostelid'])){
		$result = mysql_query("SELECT * from tbl_hostel_category where hostel_id = '" . (int)$_GET['hostelid'] . "' order by hostel_category asc",$link);
		while($rows = mysql_fetch_array($result)){
			$html .= $rows['hostel_category'];
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