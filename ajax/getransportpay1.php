<?php
	include("../config.php");
	session_start();
	if(isset($_SESSION['objLogin'])){
	$html = '';
	if(isset($_GET['pid'])){
		$result = mysql_query("SELECT * from tbl_add_transport where transport_id = '" . (int)$_GET['pid'] . "' order by transport_id asc",$link);
		while($rows = mysql_fetch_array($result)){
			$html .= $rows['fare'];
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