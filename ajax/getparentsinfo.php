<?php
	include("../config.php");
	session_start();
	if(isset($_SESSION['objLogin'])){
	if(isset($_GET['term'])){
		$row_set = array();
		$result = mysql_query('SELECT * FROM tbl_add_parent WHERE p_father_name LIKE "%'.$_GET['term'].'%"',$link);
		while($rows = mysql_fetch_array($result)){
			$new_row['label']=htmlentities(stripslashes($rows['p_father_name']));
			$new_row['value']=htmlentities(stripslashes($rows['p_father_name']));
			$new_row['id']=htmlentities(stripslashes($rows['p_id']));
			$new_row['description']=htmlentities(stripslashes($rows['n_card']));
			$new_row['image']=htmlentities(stripslashes($rows['p_image']));
			$row_set[] = $new_row;
		}
		echo json_encode($row_set);
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