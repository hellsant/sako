
<?php
	include("../config.php");
	session_start();
	if(isset($_SESSION['objLogin'])){
	if(isset($_POST['attendance'])){
		$class_id = $_POST['dllStClassId'];
		$sdate = $_POST['txtDate'];
		$amonth = date('m');
		$ayear = date('Y');
		$sql = mysql_query($link,"Delete from tbl_student_attendance where added_date = '" . (string)$sdate . "' and cid = '" . (int)$class_id . "' and a.a_month = '".date('F')."' and a.a_year = '".date('Y')."'");
		foreach($_POST['attendance'] as $key => $value){
			$sql = mysqli_query($link,"INSERT INTO `tbl_student_attendance`(sid,cid,attendance,roll_no,added_date,a_month,a_year) VALUES('$key','$class_id','1',$value,'$sdate','$amonth','$ayear')");
			mysqli_query($sql,$link);
		}
		echo "Added Attendance Successfully";
		die();
	}
	}
	else{
		echo 'Invalid Access';
		die();
	}
?>