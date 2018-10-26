<?php
	include("../config.php");
	session_start();
	if(isset($_SESSION['objLogin'])){
	$html = '<option value="">--Select--</option>';
	if(isset($_GET['aid'])){
		$result = mysql_query("SELECT * from tbl_book_setup where bk_id = '" . (int)$_GET['aid'] . "' order by bk_name asc",$link);
		while($rows = mysql_fetch_array($result)){
			$html .= '<option value="'.$rows['bk_id'].'">'.$rows['bk_author'].'</option>';
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