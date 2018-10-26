<?php
	include("../config.php");
	session_start();
	if(isset($_SESSION['objLogin'])){
	$html = '<option value="">--Select hostel--</option>';
	if(isset($_GET['hid'])){
		$result = mysql_query("SELECT *,h.h_name from tbl_add_hostel_member hm inner join tbl_add_hostel h on h.h_id = hm.hostel_name where hm.hmid = '" . (int)$_GET['hid'] . "' order by hm.hmid asc",$link);
		while($rows = mysql_fetch_array($result)){
			$html .= '<option value="'.$rows['hmid'].'">'.$rows['h_name'].'</option>';
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