<?php
	include("../config.php");
	session_start();
	if(isset($_SESSION['objLogin'])){
		$html = '';
		if(isset($_GET['mid'])){
			$result = mysql_query("SELECT *,s.s_name,c.c_name from tbl_add_hostel_member hm inner join tbl_add_student s on s.s_id = hm.sid inner join tbl_add_class c on c.c_id = hm.cid where hm.hmid = '" . (int)$_GET['mid'] . "'",$link);
			if($rows = mysql_fetch_array($result)){
				$html .= $rows['hostel_name'] . '~' . $rows['hostel_category'] . '~' . $rows['s_name'] . '~' . $rows['c_name'];
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