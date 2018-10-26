<?php
	include("../config.php");
	session_start();
	if(isset($_SESSION['objLogin'])){
	$html = '<option value="">--Select Student--</option>';
	if(isset($_GET['classid'])){
		$result = mysqli_query($link,"SELECT *,p.p_id from tbl_add_student s inner join tbl_add_parent p on p.p_id = s.parent_id where s_class_id = '" . (int)$_GET['classid'] . "' and s.parent_id = '" . $_SESSION['objLogin']['p_id'] . "' order by s.s_roll_no asc");
		while($rows = mysqli_fetch_array($result)){
			$html .= '<option value="'.$rows['s_id'].'">'.$rows['s_name']. '  ('.$rows['s_roll_no'].')' . '</option>';
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
