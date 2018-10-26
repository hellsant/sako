<?php
	include("../config.php");
	session_start();
	if(isset($_SESSION['objLogin'])){
		$html = '';
		if(isset($_GET['tid'])){
			$result = mysql_query("SELECT s.s_name,c.c_name,t.destination,t.fare from tbl_add_tp_member tm inner join tbl_add_student s on s.s_id = tm.sid inner join tbl_add_class c on c.c_id = tm.cid inner join tbl_add_transport t on t.transport_id = tm.tpm_destination where tm.tpm_id = '" . (int)$_GET['tid'] . "'",$link);
			if($rows = mysql_fetch_array($result)){
				$html .= $rows['s_name'] . '~' . $rows['c_name'] . '~' . $rows['destination'] . '~' . $rows['fare'];
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