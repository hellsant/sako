<?php
	include("../config.php");
	session_start();
	if(isset($_SESSION['objLogin'])){
	if(isset($_POST['mark'])){
		$exam_id = $_POST['ddlExam'];
		$class_id = $_POST['dllStClassId'];
		$student_id = $_POST['dllStNameId'];
		foreach($_POST['mark'] as $value){
			$sql = mysqli_query($link,"UPDATE `tbl_student_marks` set `marks` = '".$value['number']."' where smid= '" . $value['id'] . "'");	
			mysqli_query($sql,$link);
		}
		echo "Update Student Mark Successfully";
		die();
	}
	}
	else{
		echo 'Invalid Access';
		die();
	}
?>